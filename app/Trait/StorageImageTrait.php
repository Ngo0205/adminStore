<?php

namespace App\Trait;

use Illuminate\Support\Facades\Storage;

trait StorageImageTrait
{
    public function storageTraitUpLoad($request, $fieldName, $folderName){
        if($request->hasFile($fieldName)){
            $file = $request->$fieldName;
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = bin2hex(random_bytes(20)) .'.'.$file->getClientOriginalExtension();
            $filePath = $request->file($fieldName)->storeAs('public/'.$folderName.'/'.auth()->id(),$fileNameHash);
            return [
                'file_name'=> $fileNameOrigin,
                'file_path'=>Storage::url($filePath)
            ];
        }
        else return null;

    }

    public function storageTraitUpLoadImageDetail($file, $folderName){

            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = bin2hex(random_bytes(20)) .'.'.$file->getClientOriginalExtension();
            $filePath = $file->storeAs('public/'.$folderName.'/'.auth()->id(),$fileNameHash);
            return [
                'file_name'=> $fileNameOrigin,
                'file_path'=>Storage::url($filePath)
            ];
    }

}
