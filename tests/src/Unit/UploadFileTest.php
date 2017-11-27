<?php

/**
 * @file
 *
 * Contains \Drupal\Tests\test_example\Unit\TestExampleConversionsTest.
 */

namespace Drupal\Tests\media_entity_bulk_upload\Unit;

use Drupal\media_entity_bulk_upload\Utility\FieldUtility;
use Drupal\Tests\UnitTestCase;

/**
 * Demonstrates how to write tests.
 *
 * @group test_example
 */
class UploadFileTest extends UnitTestCase {

	/**
	 * A simple test that tests our celsiusToFahrenheit() function.
	 */
	public function testOneConversion() {
		// Confirm that 0C = 32F.
		$this->assertEquals(32, FieldUtility::getMediaFieldBundles());
	}

}