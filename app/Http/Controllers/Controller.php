<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Intervention\Image\Image;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function backWithError($message)
    {
        $notification = [
            'message' => $message,
            'alert-type' => 'error'
        ];
        return back()->with($notification);
    }

    public function backWithSuccess($message)
    {
        $notification = [
            'message' => $message,
            'alert-type' => 'success'
        ];
        return back()->with($notification);
    }

    public function backWithWarning($message)
    {
        $notification = [
            'message' => $message,
            'alert-type' => 'warning'
        ];
        return back()->with($notification);
    }

    public function redirectBackWithWarning($message, $route)
    {
        $notification = [
            'message' => $message,
            'alert-type' => 'warning'
        ];
        return redirect()->route($route)->with($notification);
    }

    public function redirectBackWithError($message, $route)
    {
        $notification = [
            'message' => $message,
            'alert-type' => 'error'
        ];
        return redirect()->route($route)->with($notification);
    }

    public function redirectBackWithSuccess($message, $route)
    {
        $notification = [
            'message' => $message,
            'alert-type' => 'success'
        ];
        return redirect()->route($route)->with($notification);
    }

    public function urlRedirectBack($message, $url, $alertType)
    {
        $notification = [
            'message' => $message,
            'alert-type' => $alertType
        ];
        return redirect($url)->with($notification);
    }

    function photoUpload($photoData,$folderName,$width=null,$height=null)
    {
        $photoOrgName = $photoData->getClientOriginalName();
        $photoType = $photoData->getClientOriginalExtension();
        $fileName = substr($photoOrgName, 0, -4) . date('d-m-Y-i-s') . '.' . $photoType;
        $path2 = $folderName . date('/Y/m/d/');
        if (!is_dir(public_path($path2))) {
            mkdir(public_path($path2), 0777, true);
        }
        $photoData->move(public_path($path2), $fileName);
        if ($width != null && $height != null) {

            $img = Image::make(public_path($path2 . $fileName));
            $img->encode('webp', 75)->resize($width, $height);
            $img->save(public_path($path2 . $fileName));
            return $photoUploadedPath = $path2 . $fileName;

        } elseif ($width != null) {

            $img = Image::make(public_path($path2 . $fileName));
            $img->encode('webp', 75)->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path($path2 . $fileName));
            return $photoUploadedPath = $path2 . $fileName;
        } else {
            $img = Image::make(public_path($path2 . $fileName));
            $img->save(public_path($path2 . $fileName));
            return $photoUploadedPath = $path2 . $fileName;
        }
    }

    function fileInfo($file)
    {
        if(isset($file)){
            return array(
                'name' => $file->getClientOriginalName(),
                'type' => $file->getClientMimeType(),
                'size' => $file->getSize(),
                'width' => isset(getimagesize($file)[0]) ? getimagesize($file)[0] : 0,
                'height' => isset(getimagesize($file)[1]) ? getimagesize($file)[1] : 0,
                'extension' => $file->getClientOriginalExtension(),
            );
        }else{
            return array(
                'name' => '',
                'type' => '',
                'size' => '',
                'width' => '',
                'height' => '',
                'extension' => '',
            );
        }
    }

    function fileUpload($filedata,$folderName){

        $fileType = $filedata->getClientOriginalExtension();
        $fileName = rand(1, 1000) . date('dmyhis') . "." . $fileType;
        $path2 = $folderName;
        if (!file_exists(public_path($path2))) {
            mkdir(public_path($path2), 0777, true);
        }
        $img =$filedata->move(public_path($path2),$fileName);
        return $photoUploadedPath=$path2 .'/'. $fileName;
    }
}
