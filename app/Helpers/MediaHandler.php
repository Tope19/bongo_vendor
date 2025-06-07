<?php

namespace App\Helpers;

use App\Models\File as FileModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MediaHandler
{

    public $moveFile = true;
    public $fileName = null;
    public $fileModel;
    public function __construct()
    {
        $this->fileModel = new FileModel;
    }

    public function setMoveFile($value)
    {
        $this->moveFile = $value;
        return $this;
    }

    public function setFilename($value)
    {
        $this->fileName = $value;
        return $this;
    }



    public function save($filepath, $type, $file_id = null, $user_id = null)
    {

        $info = pathinfo($filepath);
        $mime = $info["extension"];
        $filename = uniqid() . "." . $mime;
        $path = "app/media/$type";
        $full_path = storage_path($path);

        withDir($full_path);

        if ($this->moveFile) {
            File::move($filepath, "$full_path/$filename");
        } else {
            File::copy($filepath, "$full_path/$filename");
        }

        $path_to_store =  "$path/$filename";

        // Permanent file path
        $fileFullPath = storage_path($path_to_store);

        $file_size = filesize($fileFullPath);
        $meta_info = [
            "name" => $this->fileName,
            "size" => $file_size,
            "formatted_size" => bytesToHuman($file_size)
        ];

        if (in_array(trim($mime), ["jpg", "jpeg", "png"])) {
            $image_info = getimagesize($fileFullPath);
            $meta_info["width"] = $image_info[0];
            $meta_info["height"] = $image_info[1];
            $meta_info["length"] = null;
        }

        // if (in_array(trim($mime), ["avi", "mp4", "mkv"])) {
        //     $video_info = VideoProcessor::videoDimensions($fileFullPath);
        //     $meta_info["width"] = $video_info["width"];
        //     $meta_info["height"] = $video_info["height"];
        //     $meta_info["length"] = VideoProcessor::mediaLength($fileFullPath);
        // }

        // if (in_array(trim($mime), ["mp3", "m4a"])) {
        //     $meta_info["length"] = VideoProcessor::mediaLength($fileFullPath);
        // }

        $file = $this->fileModel->find($file_id);
        if (!empty($file_id) && !empty($file)) {
            $this->fileModel->cleanDelete($file_id, false);
            $file->update(
                array_merge(
                    [
                        "path" => $path_to_store,
                        "mime_type" => $mime,
                    ],
                    $meta_info,
                )
            );
        } else {
            $file = $this->fileModel->create(
                array_merge(
                    [
                        "user_id" => $user_id,
                        "file_group" => $type,
                        "path" => $path_to_store,
                        "mime_type" => $mime,
                    ],
                    $meta_info,
                )
            );
        }

        return $file;
    }


    public function saveFromFilePath($filepath, $type, $file_id = null, $user_id = null)
    {
        return $this->save($filepath, $type, $file_id, $user_id);
    }
}
