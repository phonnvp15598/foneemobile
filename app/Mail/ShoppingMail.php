<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShoppingMail extends Mailable
{
    use Queueable, SerializesModels;
    private $order;
    private $orderdetail = [];
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $orderdetail)
    {
        $this->order = $order;
        $this->orderdetail = $orderdetail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.shoppingmail')->with('dataorder', $this->order)->with('dataorderdetail', $this->orderdetail);
    }
}
