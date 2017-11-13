<?php

namespace Drupal\media_entity_bulk_upload\Utility;

class FieldUtility {

  public static function GetMediaFieldBundles() {
    $field_map = \Drupal::entityManager()->getFieldMap();
    $media_field_map = $field_map['media'];
    $bundle_array = array();
    foreach ($media_field_map as $field_key => $field) {
      if(isset($field['bundles'])) {
        foreach ($field['bundles'] as $bundle_name) {
          $bundle_array[$bundle_name] = $bundle_name;
        }
      }
    }
    return $bundle_array;
  }

  public static function GetMediaImageFields() {
    $field_map = \Drupal::entityManager()->getFieldMap();
    $media_field_map = $field_map['media'];
    $field_array = array();
    foreach ($media_field_map as $field_key => $field) {
      if(isset($field['type']) && $field['type'] === "image" && $field_key !== "thumbnail") {
        $field_array[$field_key] = $field_key;
      }
    }
    return $field_array;
  }

}
