<?php

namespace Drupal\media_entity_bulk_upload\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\media_entity_bulk_upload\Repo\TaxonomyRepo;

class BulkForm extends ConfigFormBase {

	public function getFormId()
	{
		return 'media_entity_bulk_upload_form';
	}

	protected function getEditableConfigNames()
	{
	    return [
	      'media_entity_bulk_upload.settings',
	    ];
	  }

	public function buildForm(array $form, FormStateInterface $form_state)
	{

		$form = parent::buildForm($form, $form_state);

		$form['tid'] = array(
	      '#type' => 'select',
	      '#title' => $this->t('Folder'),
	      '#description' => $this->t('The foler to save in drupal of image'),
	      '#empty_option' => sprintf('- %s -', $this->t('Please select')),
	      '#required' => TRUE,
	      '#options' => TaxonomyRepo::GetFolders(),
	    );

		$form['path'] = array(
	      '#type' => 'textfield',
	      '#title' => $this->t('Path'),
	      '#default_value' => "/upload",
	      '#description' => $this->t('The local path to look for images in')
	    );

	    return $form;
	}

	public function submitForm(array &$form, FormStateInterface $form_state)
	{
		$upload_service = \Drupal::service('media_entity_bulk_upload.bulk_upload');

		$upload_service->setPath($form_state->getValue('path'));
		$upload_service->setTid($form_state->getValue('tid'));

		$upload_service->Start();

	    parent::submitForm($form, $form_state);
  	}
}
