<?php

/**
 * @file
 * Contains Drupal\media_entity_bulk_upload\Tests\FieldBundleTest.
 */

namespace Drupal\media_entity_bulk_upload\Tests;

use Drupal\media_entity_bulk_upload\Utility\FieldUtility;
use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the media_entity_bulk_upload module.
 * @group media_entity_bulk_upload
 */
class FieldBundleTest extends WebTestBase {

	/**
	 * {@inheritdoc}
	 */
	public static function getInfo() {
		return array(
			'name' => "Media Bundles Test",
			'description' => 'Test media bundles are returned.',
			'group' => 'media_entity_bulk_upload',
		);
	}

	static public $modules = array(
		'media_entity_bulk_upload',
	);

	public function testMediaFieldBundles() {
		$bundles = FieldUtility::getMediaFieldBundles();
		$this->assertTrue(is_array($bundles));
	}
}
