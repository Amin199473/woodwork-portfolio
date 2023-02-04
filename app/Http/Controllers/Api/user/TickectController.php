<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TickectController extends Controller
{
    public function AddTicket(Request $request)
    {
        if ($request->parent_id != null) {
            $ticket = Ticket::find($request->parent_id);
            $ticket->reply_status = "answered";
            $ticket->save();
        }
        $ticket = new Ticket();
        $ticket->user_id = $request->user_id;
        $ticket->admin_id = $request->admin_id;
        $ticket->parent_id = $request->parent_id;
        $ticket->subject = $request->subject;
        $ticket->message = $request->message;
        $ticket->status = $request->status;
        $ticket->reply_status = $request->reply_status;
        $ticket->save();
        return response()->json(["message" => "تیکت با موفقیت ارسال شد در انتظار پاسخ بمانید"], 200);
    }

    public function AllTickets()
    {
        $tickets = Ticket::with(['user'])->where('parent_id', null)->get();
        return response()->json(['tickets' => $tickets], 200);
    }

    public function TicketView($id)
    {
        $ticket = Ticket::with(['user'])->where('id', $id)->first();
        $user_id = $ticket->user_id;
        $subject = $ticket->subject;
        $tickets = Ticket::with(['replies', 'user', 'admin'])->where('user_id', $user_id)->where('subject', $subject)->orderBy("id", "ASC")->get();
        return response()->json(['tickets' => $tickets], 200);
    }

    public function getTicketReplies($user_id, $subject)
    {
        $subject = str_replace("-", " ", $subject);
        $replies = Ticket::with(['replies', 'admin', 'user'])->where('user_id', $user_id)->where('subject', $subject)->orderBy("id", "ASC")->get();
        return response()->json(['myTickets' => $replies], 200);
    }

    public function MyTickets($user_id)
    {
        $myTickets = Ticket::where('user_id', $user_id)->where('parent_id', null)->orderBy("id", "ASC")->get();
        return response()->json(['myTickets' => $myTickets], 200);
    }

    public function CloseTicket(Request $request)
    {
        $user_id = $request->user_id;
        $subject = $request->subject;
        $tickets = Ticket::where('user_id', $user_id)->where('subject', $subject)->get();
        foreach ($tickets as $ticket) {
            $ticket->status = "close";
            $ticket->save();
        }
        return response()->json(['message' => "تیکت با موفقیت بسته شد"], 200);
    }
}
