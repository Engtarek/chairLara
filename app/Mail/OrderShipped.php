<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use PDF;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
      public function __construct($customer,$order_pdf,$order){
          $this->customer = $customer;
          $this->order_pdf = $order_pdf;
          $this->order = $order;
      }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
      return $this->view('mail')->with(['customer' => $this->customer,'order'=>$this->order])->attachData($this->order_pdf, 'name.pdf', ['mime' => 'application/pdf']);
    }
}
