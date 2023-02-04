<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Http\Requests\ContactUsRequest;
class ContactUsController extends Controller
{
    public function ContactUs(ContactUsRequest $request)
    {

        dd($request);
        $contactUs = new ContactUs();
        $contactUs->name = $request->form['name'];
        $contactUs->email = $request->form['email'];
        $contactUs->phone = $request->form['phone'];
        $contactUs->subject = $request->form['subject'];
        $contactUs->message = $request->form['message'];
        $contactUs->save();
        return response()->json(['message' => " .با تشکر،پیام شما با موفقیت ثبت شد"], 200);
    }
}
