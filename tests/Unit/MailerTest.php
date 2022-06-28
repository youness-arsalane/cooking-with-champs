<?php

namespace Tests\Unit;

use App\Mail\ContactForm;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MailerTest extends TestCase
{
    public function test_mail_server()
    {
        Mail::fake();
        Mail::assertNotSent(ContactForm::class);
        self::assertTrue(true);
    }
}
