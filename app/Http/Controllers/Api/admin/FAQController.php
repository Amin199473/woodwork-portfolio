<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function getAllFAQ()
    {
        $allFAQ = FAQ::latest()->get();
        return response()->json(['FAQ' => $allFAQ], 200);

    }
    public function GetFAQ($id){
        $FAQ = FAQ::findOrFail($id);
        return response()->json(['FAQ' => $FAQ], 200);

    }
    public function AddFAQ(Request $request)
    {
        $FAQ = new FAQ();
        $FAQ->question = $request->question;
        $FAQ->reply = $request->reply;
        $FAQ->save();
        return response()->json(['message' => "سوالات متداول با موفقیت اضافه شد"], 200);
    }

    public function EditFAQ(Request $request, $id){
        $FAQ = FAQ::findOrFail($id);
        $FAQ->question = $request->question;
        $FAQ->reply = $request->reply;
        $FAQ->save();
        return response()->json(['message' => "سوالات متداول با موفقیت ویرایش شد"], 200);

    }
    public function DeleteFAQ($id){
        $FAQ = FAQ::findOrFail($id);
        $FAQ->delete();
        return response()->json(['message' => "سوالات متداول با موفقیت حذف شد"], 200);

    }
}
