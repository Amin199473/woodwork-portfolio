<?php

namespace App\Http\Controllers\Api\admin;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use Intervention\Image\Facades\Image;

class TeamMembersController extends Controller
{
    function index()
    {
        $members = Member::latest()->get();
        return response()->json(["members" => $members], 200);
    }



    public function store(MemberRequest $request)
    {
        if ($request->image) {
            $image = $request->file('image');
            $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();;
            $img = Image::make($request->image)->resize(800, 600);
            $upload_path = 'upload/member-avatar/';
            $image_url =  $upload_path . $name;
            $img->save($image_url);
        }
        $member = new Member();
        $member->name = $request->name;
        $member->age = $request->age;
        $member->skills = $request->skills;
        $member->level = $request->level;
        $member->exprience = $request->exprience;
        $member->bio = $request->bio;
        $member->avatar = "/" . $image_url;
        $member->save();

        return response()->json(["message" => "عضو جدید با موفقیت اضافه شد"], 200);
    }


    public function show(Member $member)
    {
        return response()->json(["member" => $member], 200);
    }



    public function editMember(MemberRequest $request,  $id)
    {
        $member = Member::findOrFail($id);

        if ($request->image) {
            $path =  ltrim($member->avatar, "/");
            @unlink(public_path($path));
            $image = $request->file('image');
            $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();;
            $img = Image::make($request->image)->resize(800, 600);
            $upload_path = 'upload/member-avatar/';
            $image_url =  $upload_path . $name;
            $img->save($image_url);
        }
        $member->name = $request->name;
        $member->age = $request->age;
        $member->skills = $request->skills;
        $member->level = $request->level;
        $member->exprience = $request->exprience;
        $member->bio = $request->bio;
        $member->avatar = isset($image_url)? "/" . $image_url: $member->avatar;
        $member->save();

        return response()->json(["message" => "عضو جدید با موفقیت ویرایش شد"], 200);
    }


    public function destroy(Member $member)
    {
        //
    }
}
