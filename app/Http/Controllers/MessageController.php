<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Events\MessageSent;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('chats.contacts', [
            'contacts' => User::whereNot('id', Auth::id())->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }

    public function showMessages($contactId)
    {
        $messages = Message::where(function ($query) use ($contactId) {
            $query->where('from_user_id', Auth::id())
                    ->where('to_user_id', $contactId);
        })->orWhere(function($query) use ($contactId){
            $query->where('from_user_id', $contactId)
                   ->where('to_user_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        $contact = User::find($contactId);

        return view('chats.chat-show', compact('messages', 'contactId', 'contact'));
    }
    public function sendMessage(Request $request, $contactId)
    {
        $message = new Message();
        $message->from_user_id = Auth::id();
        $message->to_user_id = $contactId;
        $message->message = $request->message;
        $message->save();

        broadcast(new MessageSent($message));
  
        return back();
    }
}
