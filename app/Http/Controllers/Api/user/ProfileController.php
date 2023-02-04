<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function UpdateUserProfile(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        if ($request->avatar) {
            if ($user->avatar) {
                $path = ltrim($user->avatar, "/");
                @unlink(public_path($path));
            }
            $avatar = $request->file('avatar');
            $name = hexdec(uniqid()) . '.' . $avatar->getClientOriginalExtension();
            $img = Image::make($request->avatar)->resize(600, 480);
            $upload_path = 'upload/userAvatar/';
            $image_url = $upload_path . $name;
            $img->save($image_url);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->age = $request->age;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->bio = $request->bio;
        $user->birthDate = $request->birthDate;
        $user->avatar = isset($image_url) ? '/' . $image_url : $user->avatar;
        $user->save();

        return response()->json(["message" => "ویرایش باموفقیت انجام شد"], 200);
    }

    public function UpdateAdminProfile(Request $request,$adminId)
    {
        $admin = Admin::findOrFail($adminId);
        if ($request->avatar) {
            if ($admin->avatar) {
                $path = ltrim($admin->avatar, "/");
                @unlink(public_path($path));
            }
            $avatar = $request->file('avatar');
            $name = hexdec(uniqid()) . '.' . $avatar->getClientOriginalExtension();
            $img = Image::make($request->avatar)->resize(600, 480);
            $upload_path = 'upload/adminAvatar/';
            $image_url = $upload_path . $name;
            $img->save($image_url);
        }
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->age = $request->age;
        $admin->mobile = $request->mobile;
        $admin->address = $request->address;
        $admin->gender = $request->gender;
        $admin->bio = $request->bio;
        $admin->birthDate = $request->birthDate;
        $admin->avatar = isset($image_url) ? '/' . $image_url : $admin->avatar;
        $admin->save();

        return response()->json(["message" => "ویرایش باموفقیت انجام شد"], 200);
    }
}
