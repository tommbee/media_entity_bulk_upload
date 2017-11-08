<?php

namespace Drupal\media_entity_bulk_upload\Repo;

class TaxonomyRepo
{

	public static function GetFolders()
	{
		$terms = \Drupal::entityManager()->getStorage('taxonomy_term')->loadTree('media_type');

		$tag_array = array();

		foreach ($terms as $key => $term) {
			$tag_array[$term->tid] = $term->name;
		}

		return $tag_array;
	}
}
