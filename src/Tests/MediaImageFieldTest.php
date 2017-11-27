<?php

/**
 * @file
 * Contains Drupal\media_entity_bulk_upload\Tests\MediaImageFieldTest.
 */

namespace Drupal\media_entity_bulk_upload\Tests;

use Drupal\media_entity_bulk_upload\Utility\FieldUtility;
use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the media_entity_bulk_upload module.
 * @group media_entity_bulk_upload
 */
class MediaImageFieldTest extends WebTestBase {

	/**
	 * {@inheritdoc}
	 */
	public static function getInfo() {
		return array(
			'name' => "Media Image Field Test",
			'description' => 'Test media image fields are returned.',
			'group' => 'media_entity_bulk_upload',
		);
	}

	static public $modules = array(
		'media_entity_bulk_upload',
	);

	public function testMediaFieldBundles() {
		$fields = FieldUtility::getMediaImageFields();
		$this->assertTrue(is_array($fields));
	}
}
