<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use PDF;

class SendMailClass extends Mailable
{
   // public $fileContents;
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;   
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

     PDF::loadFile(public_path().'/pdfContent.html')->save(storage_path().'/quotePdfFiles/stored_file.pdf')->stream('download.pdf');
           
        return $this->markdown('emails.html.mailContent')->with('content',$this->content)
        ->attach(storage_path().'/quotePdfFiles/stored_file.pdf', [
            'as' => 'pdf_file.pdf',
            'mime' => 'application/pdf',
        ]);
    }
}
?>
