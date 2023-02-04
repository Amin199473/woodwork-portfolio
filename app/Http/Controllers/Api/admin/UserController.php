<?php

namespace App\Http\Controllers\Api\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function GetUsers()
    {
        $users = User::latest()->get();
        return response()->json(["users" => $users], 200);
    }

    public function GetUserById($id)
    {
        $user = User::findOrFail($id);
        return response()->json(["user" => $user], 200);
    }

    public function AddUserByAdmin(UserRequest $request){

        $user = new User();
        if ($request->avatar) {
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
        $user->password =Hash::make($request->password);
        $user->bio = $request->bio;
        $user->birthDate = $request->birthDate;
        $user->avatar = isset($image_url) ? '/' . $image_url : $user->avatar;
        $user->save();

        return response()->json(["message" => "کاربر با باموفقیت اضافه شد"], 200);
    }

    public function UpdateUser(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
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
}
