<?php

namespace Drupal\media_entity_bulk_upload\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use \Drupal\media_entity_bulk_upload\Services\ZipUploadService;
use Drupal\file\Entity\File;

class BulkForm extends ConfigFormBase {

  /**
   * The upload service.
   *
   * @var \Drupal\media_entity_bulk_upload\Services\ZipUploadService
   */
  protected $upload_service;

  public function __construct(ConfigFactoryInterface $config_factory, ZipUploadService $upload_service) {
    $this->setConfigFactory($config_factory);
    $this->$upload_service = $upload_service;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get(['config.factory']),
      $container->get(['media_entity_bulk_upload.bulk_upload']),
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
    $form['zip'] = array(
        '#type' => 'managed_file',
        '#title' => t('Upload Zip File'),
        '#upload_location' => 'temporary://bulk_upload/',
        '#description' => t('The zip file containing image files')
        ),
    );
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $fid = $form_state->getValue(['zip', 0]);
    if (!empty($fid)) {
      $file = File::load($fid);
      $this->upload_service->Upload($file->getFilename());
      // $file = File::load($fid);
      // $file->setPermanent();
      // $file->save();
    }
    parent::submitForm($form, $form_state);
  }

}
