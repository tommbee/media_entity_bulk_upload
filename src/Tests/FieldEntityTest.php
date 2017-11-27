<?php

/**
 * @file
 * Contains Drupal\media_entity_bulk_upload\Tests\FieldEntityTest.
 */

namespace Drupal\media_entity_bulk_upload\Tests;

use Drupal\media_entity_bulk_upload\Utility\FieldUtility;
use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the mespronos module.
 * @group mespronos
 */
class MespronosBetPointsTest extends WebTestBase {

	/**
	 * {@inheritdoc}
	 */
	public static function getInfo() {
		return array(
			'name' => "Field Utility functionality",
			'description' => 'Test return types are correct.',
			'group' => 'media_entity_bulk_upload',
		);
	}

	static public $modules = array(
		'media_entity_bulk_upload',
	);

	public function testBettingsPointsOnTeam2Winning() {
		$bundles = FieldUtility::getMediaFieldBundles();
		$this->assertTrue(is_array($bundles));
	}
}