<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendMailClass;
use Mail;

class SendMailController extends Controller
{
    /**
     * Show the application sendMail.
     * @return \Illuminate\Http\Response
     */
   
    public function sendMail($content,$sendToEmail)
    {

    	return Mail::to($sendToEmail)->send(new SendMailClass($content));

    	dd('mail send successfully');
    }
}
