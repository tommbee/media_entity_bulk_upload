<?php

namespace Drupal\Tests\media_entity_bulk_upload\Unit;

use Drupal\media_entity_bulk_upload\Utility\FieldUtility;
use Drupal\Tests\UnitTestCase;

class FieldEntityTest extends UnitTestCase {

	public function testReturnBundlesArray() {
		$bundles = FieldUtility::getMediaFieldBundles();
		$this->assertTrue(is_array($bundles));
	}

}
