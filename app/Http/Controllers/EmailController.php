<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function send(Request $request)
    {
      $email = $request->email;
      $name = $request->name;
      $bodyMessage = $request->bodyMessage;

      Mail::send('emails.send', ['email' => $email, 'name' => $name, 'bodyMessage' => $bodyMessage], function ($message) {
        $message->to('eumlcastro@gmail.com');
      });

      dd('Mail send');

      return response()->json(['message' => 'Request completed']);
    }
}
