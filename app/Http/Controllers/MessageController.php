<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\MessageSentEvent;


class MessageController extends Controller
{
  public function fetch()
  {
    return Message::with('user')->get();
  }

  public function sentMessage(Request $request)
  {
    $user = \Auth::user();

    $message = Message::create([
      'message' => $request->message,
      'user_id' => \Auth::user()->id,
    ]);

    broadcast(new MessageSentEvent($user, $message))->toOthers();
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('chat.chat');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Message  $message
   * @return \Illuminate\Http\Response
   */
  public function show(Message $message)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Message  $message
   * @return \Illuminate\Http\Response
   */
  public function edit(Message $message)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Message  $message
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Message $message)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Message  $message
   * @return \Illuminate\Http\Response
   */
  public function destroy(Message $message)
  {
    //
  }
}
