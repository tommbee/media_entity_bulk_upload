<?php

namespace Drupal\Tests\media_entity_bulk_upload\Unit;

use Drupal\media_entity_bulk_upload\Utility\FieldUtility;
use PHPUnit\Framework\TestCase;

class FieldEntityTest extends TestCase {

	public function testTrueIsTrue() {
		$bundles = FieldUtility::getMediaFieldBundles();
		$this->assertTrue(is_array($bundles));
	}

}
