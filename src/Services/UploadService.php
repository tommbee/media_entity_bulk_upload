<?php

namespace Drupal\media_entity_bulk_upload\Services;

use Drupal\file\Entity\File;
use Drupal\media_entity\Entity\Media;
use Drupal\Core\Language\Language;

class UploadService {

	protected $path;
	protected $tid;

	public function setPath($path)
	{
		$this->path = $path;
	}

	public function setTid($tid)
	{
		$this->tid = $tid;
	}

	public function Start()
	{
		$upload_path = DRUPAL_ROOT . $this->path;
		$dir_r = new \DirectoryIterator($upload_path);
		foreach ($dir_r as $fileinfo) {
		    if (!$fileinfo->isDot()) {
		    	$file_name = $fileinfo->getFilename();
		    	$alt = $file_name;
		    	$intended_place = DRUPAL_ROOT . "/sites/default/files/";
		    	if(file_exists($intended_place . $file_name)) {
		    		do {
	      				$file_name = date('Y-m-d-H-m-s') . '_' . $file_name;
					} while(file_exists($intended_place . $file_name));
		    	}
		    	$file = File::create([
				  'uid' => 1,
				  'filename' => $file_name,
				  'uri' => 'public://' . $file_name,
				  'status' => 1,
				]);
				$dir = drupal_realpath($file->getFileUri());
				copy($fileinfo->getpathName(), $dir);
				$file->save();

				$image_media = Media::create([
			      'bundle' => 'image',
			      'uid' => '1',
			      'langcode' => 'en',
			      'status' => Media::PUBLISHED,
			      'field_image' => [
			        'target_id' => $file->id(),
			        'alt' => $alt
			      ],
			      'field_folder' => $this->tid
			    ]);

			    $image_media->save();

		    }
		}

	}

}
