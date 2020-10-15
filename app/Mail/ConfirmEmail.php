<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmEmail extends Mailable
{
	use Queueable, SerializesModels;

	public $data;

	public function __construct($data)
	{
		$this->data = $data;
	}

	public function build()
	{
		$address = $_ENV['MAIL_FROM_ADDRESS'];
		$name = $_ENV['MAIL_FROM_NAME'];
		$subject = 'Your booking';

		return $this->view('emails.confirm_booking')
			->from($address, $name)
			->replyTo($address, $name)
			->subject($subject)
			->with([ 'data' => $this->data, 'subject' => $subject ]);
	}
}
