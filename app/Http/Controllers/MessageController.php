<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
	{
		$messages = Message::where('user_id', auth()->id())->orderBy('is_read', 'asc')->orderBy('id', 'desc')->get();
		return view('user.messages.index', compact('messages'));
	}

	public function read($id)
	{
		$message = Message::where('user_id', auth()->id())->where('id', $id)->firstOrFail();
		$message->is_read = true;
		$message->save();

		return redirect()->route('user.messages.index')->with('success', 'Message marked as read.');
	}

	public function unread($id)
	{
		$message = Message::where('user_id', auth()->id())->where('id', $id)->firstOrFail();
		$message->is_read = false;
		$message->save();

		return redirect()->route('user.messages.index')->with('success', 'Message marked as unread.');
	}
}
