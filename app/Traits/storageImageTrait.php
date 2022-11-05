<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

trait storageImageTrait
{
    /**
     * storageTraitUpload
     *
     * @param  mixed $request
     * @param  mixed $filedName
     * @param  mixed $folderName
     * @return void
     */
    public function storageTraitUpload($request, $filedName, $folderName)
    {
        if ($request->hasFile($filedName)) {
            $file = $request->file($filedName);
            $fileNameOrigin  = $file->getClientOriginalName();
            $fileNameHash = Str::random('20') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/' . $folderName . '/' . Auth::id(), $fileNameHash);

            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($path)
            ];
            return $dataUploadTrait;
        }
        return null;
    }

    /**
     * storageTraitUploadMutiple
     *
     * @param  mixed $file
     * @param  mixed $folderName
     * @return void
     */
    public function storageTraitUploadMutiple($file, $folderName)
    {
        $fileNameOrigin  = $file->getClientOriginalName();
        $fileNameHash = Str::random('20') . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/' . $folderName . '/' . Auth::id(), $fileNameHash);
        $dataUploadTrait = [
            'file_name' => $fileNameOrigin,
            'file_path' => Storage::url($path)
        ];
        return $dataUploadTrait;
    }
}
