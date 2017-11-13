<?php

namespace Drupal\media_entity_bulk_upload\Services;

use Drupal\file\Entity\File;
use Drupal\media_entity\Entity\Media;
use Drupal\Core\File\FileSystem;
use Drupal\Core\Archiver\ArchiverManager;
use Drupal\Core\Language\LanguageDefault;

class ZipUploadService {

	protected $fileSystem;

	protected $archiver;

	protected $zip_file;

	protected $unzipped;

	protected $language;

	function __construct(FileSystem $file_system, ArchiverManager $archiver, LanguageDefault $language) {
		$this->fileSystem = $file_system;
		$this->archiver = $archiver;
		$this->language = $language;
	}

	protected function Unzip() {
		$zip = $this->archiver->getInstance(['filepath' => $this->zip_file]);
		$success = $zip->extract($this->unzipped);
	}

	public function Upload($base_path, $zip_file, $bundle, $field) {
		$uploaded_files = array();
		$this->zip_file = $this->fileSystem->realpath($zip_file->getFileUri());
		$this->unzipped = $this->fileSystem->realpath($base_path . date('Y-m-d-H-m-s'));
		$this->Unzip();
		$dir_r = new \DirectoryIterator($this->unzipped);
		foreach ($dir_r as $fileinfo) {
			if (!$fileinfo->isDot()) {
				$file_name = $fileinfo->getFilename();
				$handle = fopen($fileinfo->getPathname(), 'r');
				$file = file_save_data($handle, 'public://' . $file_name);
				fclose($handle);
				if($file !== FALSE) {
					$image_media = Media::create([
			      'bundle' => $bundle,
			      'uid' => \Drupal::currentUser()->id(),
			      'langcode' => $this->language->get()->getId(),
			      'status' => Media::PUBLISHED,
			      $field => [
			        'target_id' => $file->id(),
			        'alt' => $file_name
			      ]
			    ]);
			    $image_media->save();
			    array_push($uploaded_files, $image_media);
				}
			}
		}
		file_unmanaged_delete_recursive($base_path);
		return $uploaded_files;
	}

}
