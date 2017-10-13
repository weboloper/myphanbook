<?php

namespace App\Test\Unit\Library;

use App\Test\Module\UnitTest;

class MailTest extends UnitTest
{
    public function testMail()
    {
        $mail = $this->di->get('mail');

        //it work if a config mail is correct, to do search free email smtp for that
        //$this->assertEquals(1, $mail->sendTest('hello@phanbook.com'));
        $this->assertEquals('hello@phanbook.com', $mail->getToMailTest('hello@phanbook.com'));
    }
}
