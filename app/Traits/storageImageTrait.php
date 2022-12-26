<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

trait storageImageTrait
{
    /**
     * storageTraitUpload
     *
     * @param  Request $request
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
            $path = $file->storeAs(
                'public/' . $folderName,
                $fileNameHash,
                [
                    'visibility' => 'public',
                    'directory_visibility' => 'public'
                ]
            );
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($path)
            ];
            Storage::setVisibility($path, 'public');
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
        $path = $file->storeAs('public/' . $folderName, $fileNameHash);
        $dataUploadTrait = [
            'file_name' => $fileNameOrigin,
            'file_path' => Storage::url($path)
        ];
        Storage::setVisibility($path, 'public');
        return $dataUploadTrait;
    }
}
