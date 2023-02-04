<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function getSiteSetting()
    {
        $setting = Setting::find(1);
        return response()->json(["setting" => $setting], 200);
    }
    public function saveSiteSetting(Request $request)
    {
        $setting = Setting::find(1);
        if ($request->logo) {
            if (isset($setting)) {
                $path = ltrim($setting->logo, "/");
                @unlink(public_path($path));
            }
            $logo = $request->file('logo');
            $name = hexdec(uniqid()) . '.' . $logo->getClientOriginalExtension();
            $img = Image::make($request->logo)->resize(600, 480);
            $upload_path = 'upload/site-logo/';
            $logo_url = $upload_path . $name;
            $img->save($logo_url);
        }
        $setting = Setting::updateOrCreate(
            ['id' => '1'],
            [
                'telegram' => $request->telegram,
                'instagram' => $request->instagram,
                'facebook' => $request->facebook,
                'whatsapp' => $request->whatsapp,
                'linkedin' => $request->linkedin,
                'address' => $request->address,
                'phone_number_1' => $request->phone_number_1,
                'phone_number_2' => $request->phone_number_2,
                'email' => $request->email,
                'title' => $request->title,
                'logo' => isset($logo_url) ? '/' . $logo_url : $setting->logo,
            ]
        );

        return response()->json(["setting" => $setting, "message" => "تنظیمات با موفقیت ذخیره شد"], 200);
    }
}
