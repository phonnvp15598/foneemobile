<?php 
namespace App\UploadImage;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
/**
 * 
 */
trait UploadImage
{
    public function uploadOne($request, $fieldName){
        if($request->hasFile($fieldName)){
            $file = $request->$fieldName;
            // $fileNameOriginal = $file->getClientOriginalName();
            $fileNameHash =Str::random(4).$file->getClientOriginalName();
            $filePath = $request->file($fieldName)->move('public/uploads/product',$fileNameHash);
            $dataUploadTrait = [
                'file_name'=> $fileNameHash,
                'file_path'=> Storage::url($filePath) 
            ];
            return $dataUploadTrait;
        }
        return null;      
    }
    public function uploadMulti($file){
      
        // $fileNameOriginal = $file->getClientOriginalName();
        $fileNameHash =Str::random(4).$file->getClientOriginalName();
        $filePath = $file->move('public/uploads/product/',$fileNameHash);
        $dataUploadTrait = [
            'file_name'=> $fileNameHash,
            'file_path'=> Storage::url($filePath) 
         ];
        return $dataUploadTrait;  
    }
}

?>