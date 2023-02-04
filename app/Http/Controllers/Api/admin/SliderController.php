<?php

namespace App\Http\Controllers\Api\admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{

    public function index()
    {
        $sliders = Slider::latest()->get();
        return response()->json(["sliders" => $sliders], 200);
    }

    public function store(SliderRequest $request)
    {
        if ($request->image) {
            $image = $request->file('image');
            $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();;
            $img = Image::make($request->image)->resize(800, 600);
            $upload_path = 'upload/slider/';
            $image_url =  $upload_path . $name;
            $img->save($image_url);
        }
        $slider = new Slider();
        $slider->image = "/" . $image_url;
        $slider->subtitle = $request->subtitle;
        $slider->button = $request->button;
        $slider->link_button = $request->link_button;
        $slider->status = $request->status;
        $slider->title = $request->title;
        $slider->save();

        return response()->json(["message"=>"اسلایدر با موفقیت اضافه شد"]);
    }

    public function show(Slider $slider)
    {
        return response()->json(["slider"=>$slider],200);
    }


    public function editSlider(SliderRequest $request, $id)
    {
        $slider = Slider::findOrFail($id);

        if ($request->image) {
            $path =  ltrim($slider->image, "/");
            @unlink(public_path($path));
            $image = $request->file('image');
            $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->image)->resize(800, 600);
            $upload_path = 'upload/slider/';
            $image_url =  $upload_path . $name;
            $img->save($image_url);
        }

        $slider->image = "/" . $image_url;
        $slider->subtitle = $request->subtitle;
        $slider->button = $request->button;
        $slider->link_button = $request->link_button;
        $slider->status = $request->status;
        $slider->title = $request->title;
        $slider->save();

        return response()->json(["message"=>"اسلایدر با موفقیت ویرایش شد"]);
    }


    public function destroy(Slider $slider)
    {
        $path =  ltrim($slider->image, "/");
        @unlink(public_path($path));
        $slider->delete();
        return response()->json(["message" => "حذف با موفقیت انجام شد"], 200);
    }
}
