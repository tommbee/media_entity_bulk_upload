<?php

namespace Drupal\media_entity_bulk_upload\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\media_entity_bulk_upload\Services\ZipUploadService;
use Drupal\file\Entity\File;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\media_entity_bulk_upload\Utility\FieldUtility;

class BulkForm extends ConfigFormBase {

  /**
   * The upload service.
   *
   * @var \Drupal\media_entity_bulk_upload\Services\ZipUploadService
   */
  protected $upload_service;

  public function __construct(ConfigFactoryInterface $config_factory, ZipUploadService $upload_service) {
    $this->setConfigFactory($config_factory);
    $this->upload_service = $upload_service;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('media_entity_bulk_upload.bulk_upload')
    );
  }

  public function getFormId() {
    return 'media_entity_bulk_upload_form';
  }

  protected function getEditableConfigNames() {
    return [
      'media_entity_bulk_upload.settings',
    ];
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $form['target_field'] = array(
        '#type' => 'select',
        '#title' => $this->t('Field'),
        '#description' => $this->t('The target image field of your media entitiy'),
        '#empty_option' => sprintf('- %s -', $this->t('Please select')),
        '#required' => TRUE,
        '#options' => FieldUtility::GetMediaImageFields(),
    );
    $form['target_bundle'] = array(
        '#type' => 'select',
        '#title' => $this->t('Bundle'),
        '#description' => $this->t('The target media bundle of your entity'),
        '#empty_option' => sprintf('- %s -', $this->t('Please select')),
        '#required' => TRUE,
        '#options' => FieldUtility::GetMediaFieldBundles(),
    );
    $form['zip'] = array(
        '#type' => 'managed_file',
        '#title' => t('Upload Zip File'),
        '#upload_location' => 'temporary://' . $this->getFormId() . '/',
        '#description' => t('The .ZIP containing image files'),
        '#upload_validators' => array(
          'file_validate_extensions' => array('zip')
        ),
    );
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $fid = $form_state->getValue(['zip', 0]);
    $field = $form_state->getValue('target_field');
    $bundle = $form_state->getValue('target_bundle');
    if (!empty($fid)) {
      $file = File::load($fid);
      try {
        $media = $this->upload_service->Upload('temporary://' . $this->getFormId() . '/', $file, $bundle, $field);
        drupal_set_message($this->t('Success. Saved ' . sizeof($media) . ' media entities.'));
      } catch (Exception $e) {
        drupal_set_message($e->getMessage());
      }
    }
  }

}
