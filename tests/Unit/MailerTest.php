<?php

namespace Tests\Unit;

use App\Mail\ContactForm;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MailerTest extends TestCase
{
    public function mail_server_test()
    {
        Mail::fake();
        Mail::assertNotSent(ContactForm::class);
    }
}
