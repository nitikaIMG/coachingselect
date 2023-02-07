<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $content;
    public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content, $subject = '', $template = '')
    {
        $this->content = $content;
        $this->subject = $subject;
        
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        if( !empty($this->template) ) {
                
            return $this
                    ->subject( 
                        !empty($this->subject) ?
                        $this->subject :
                        'Hello there!'
                    )
                    ->view('mails.'.$this->template);
        } else {
                
            return $this
                    ->subject( 
                        !empty($this->subject) ?
                        $this->subject :
                        'Hello there!'
                    )
                    ->view('mails.commonmail');
        }
    }
}
