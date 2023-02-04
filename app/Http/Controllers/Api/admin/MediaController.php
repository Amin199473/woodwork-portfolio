<?php

namespace App\Http\Controllers\Api\admin;

use App\Models\Media;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MediaRequest;
use Intervention\Image\Facades\Image;

class MediaController extends Controller
{

    public function UploadImage(MediaRequest $request)
    {
        if ($request->image) {
            $image = $request->file('image');
            $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->image)->resize(800, 600);
            $upload_path = 'upload/media/';
            $image_url = $upload_path . $name;
            $img->save($image_url);
        }

        $base_url = env('APP_URL');
        $media = new Media();
        $media->name = $request->name;
        $media->image_path = $base_url . $image_url;
        $media->save();
        return response()->json(["message" => "اپلود با موفقیت انجام شد"], 200);
    }


    public function getImages()
    {
        $images = Media::latest()->whereNotNull('image_path')->get();
        return response()->json(["images" => $images], 200);
    }

    public function deleteImage($id)
    {
        $media = Media::find($id);
        if ($media) {
            $base_url = env('APP_URL');
            $realPath = Str::replace($base_url, '', $media->image_path);
            @unlink($realPath);
            $media->delete();
        }

        return response()->json(['message' => ".حذف با موفقیت انجام شد"], 200);
    }
}
