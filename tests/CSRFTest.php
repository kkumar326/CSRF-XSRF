<?php

if (session_status() === PHP_SESSION_NONE) session_start();

use ScienceHook\Security\CSRF;

class CSRFTest extends \PHPUnit\Framework\TestCase
{
    private $csrf;

    public function setUp()
    {
        $this->csrf = new CSRF\CSRF('test_form');
    }

    public function testCreateToken()
    {
        $this->csrf->createToken();
        $this->assertTrue(!empty($_SESSION['token_test_form']));
        $this->assertTrue(!empty($_SESSION['token_time_test_form']));
    }

    public function testCheckValid()
    {
        $value = $this->csrf->checkValid($_SESSION['token_test_form']);
        $this->assertTrue($value);

        $value = $this->csrf->checkValid('random_text');
        $this->assertFalse($value);

        $value = $this->csrf->checkValid($_SESSION['token_test_form'], -400);
        $this->assertFalse($value);
    }
}