<?php

/**
 * @file
 * Contains Drupal\mespronos\Tests\MespronosLeagueTest.
 */

namespace Drupal\media_entity_bulk_upload\Tests;

use Drupal\media_entity_bulk_upload\Utility\FieldUtility;
use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the mespronos module.
 * @group mespronos
 */
class GetFieldsTest extends WebTestBase {

	/**
	 * {@inheritdoc}
	 */
	public static function getInfo() {
		return array(
			'name' => "Field utility functionality",
			'description' => 'Test drupal returning suitable data.',
			'group' => 'media_entity_bulk_upload',
		);
	}

	static public $modules = array(
		'media_entity_bulk_upload',
	);

	/**
	 * {@inheritdoc}
	 */
	protected function setUp() {
		parent::setUp();
	}

	public function testGetFields() {
		$media_bundles = FieldUtility::getMediaFieldBundles();
		$this->assertTrue(is_array($media_bundles), 'File created');
	}

}