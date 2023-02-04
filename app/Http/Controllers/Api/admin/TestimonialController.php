<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialRequest;
use App\Models\Testimonial;
use Intervention\Image\Facades\Image;

class TestimonialController extends Controller
{

    public function index()
    {
        $testimonials = Testimonial::latest()->get();

        return response()->json(["testimonials" => $testimonials], 200);
    }

    public function store(TestimonialRequest $request)
    {
        if ($request->image) {
            $image = $request->file('image');
            $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->image)->resize(800, 600);
            $upload_path = 'upload/testimonial/';
            $image_url = $upload_path . $name;
            $img->save($image_url);
        }

        $testimonial = new Testimonial();
        $testimonial->customer_name = $request->customer_name;
        $testimonial->description = $request->description;
        $testimonial->image = "/" . $image_url;
        $testimonial->save();

        return response()->json(["message" => "گواهی با موفقیت صادر شد"], 200);
    }

    public function show(Testimonial $testimonial)
    {
        return response()->json(["testimonial" => $testimonial], 200);
    }

    public function editTestimonial(TestimonialRequest $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        if ($request->image) {
            $path = ltrim($testimonial->image, "/");
            @unlink($path);
            $image = $request->file('image');
            $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = Image::make($request->image)->resize(800, 600);
            $upload_path = 'upload/testimonial/';
            $image_url = $upload_path . $name;
            $img->save($image_url);
        }

        $testimonial->customer_name = $request->customer_name;
        $testimonial->description = $request->description;
        $testimonial->image = isset($image_url) ? "/" . $image_url : $testimonial->image;
        $testimonial->save();

        return response()->json(["message" => "گواهینامه با موفقیت ویرایش شد"], 200);
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial) {
            $path = ltrim($testimonial->image, "/");
            @unlink($path);
            $testimonial->delete();
        }
        return response()->json(["message" => "حذف با موفقیت انجام شد"], 200);
    }
}
