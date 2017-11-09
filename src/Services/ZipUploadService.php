<?php

namespace Drupal\media_entity_bulk_upload\Services;

use Drupal\file\Entity\File;
use Drupal\media_entity\Entity\Media;
use \Drupal\Core\File\FileSystem\FileSystemInterface;
use \Drupal\Archiver\Zip;

class ZipUploadService {

	protected $fileSystem;

	protected $unzipped;

	function __construct(FileSystemInterface $file_system) {
		$this->$fileSystem = $file_system;
	}

	protected getTempPath() {
		return file_directory_temp();
	}

	// protected getPublicPath() {
	// 	return $this->$fileSystem->realpath(file_default_scheme() . "://");
	// }

	protected function Unzip($zip_file) {
		$this->unzipped = $this->getTempPath() . date('Y-m-d-H-m-s');
		Zip::extract($this->unzipped , $this->getTempPath() . $zip_file);
	}

	public function Upload($zip_file) {
		$this->Unzip($zip_file);
		$upload_path = DRUPAL_ROOT . $this->path;
		$dir_r = new \DirectoryIterator($this->unzipped);
		foreach ($dir_r as $fileinfo) {

		}
	}






	// public function Upload() {
	// 	$upload_path = DRUPAL_ROOT . $this->path;
	// 	$intended_place = $this->getPublicPath();
	// 	$dir_r = new \DirectoryIterator($upload_path);
	// 	foreach ($dir_r as $fileinfo) {
	// 	    if (!$fileinfo->isDot()) {
	// 	    	$file_name = $fileinfo->getFilename();
	// 	    	$alt = $file_name;
	// 	    	if(file_exists($intended_place . $file_name)) {
	// 	    		do {
	//       				$file_name = date('Y-m-d-H-m-s') . '_' . $file_name;
	// 				} while(file_exists($intended_place . $file_name));
	// 	    	}
	// 	    	$file = File::create([
	// 			  'uid' => 1,
	// 			  'filename' => $file_name,
	// 			  'uri' => 'public://' . $file_name,
	// 			  'status' => 1,
	// 			]);
	// 			$dir = drupal_realpath($file->getFileUri());
	// 			copy($fileinfo->getpathName(), $dir);
	// 			$file->save();
	// 			$image_media = Media::create([
	// 		      'bundle' => 'image',
	// 		      'uid' => '1',
	// 		      'langcode' => 'en',
	// 		      'status' => Media::PUBLISHED,
	// 		      'field_image' => [
	// 		        'target_id' => $file->id(),
	// 		        'alt' => $alt
	// 		      ]
	// 		    ]);
	// 		    $image_media->save();
	// 	    }
	// 	}

	// }

}
