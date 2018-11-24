<?php
if (session_status() === PHP_SESSION_NONE) session_start();

use ScienceHook\Security\CSRF\Dependency\SessionHandler\SessionHandler;

class DependencyTest extends \PHPUnit\Framework\TestCase
{
    private $session_handler;

    public function setUp()
    {
        $this->session_handler = new SessionHandler;
    }

    public function testSetSessionValue()
    {
        $this->session_handler->setSessionValue('test_form', 'token_', 'token_time_', 32);
        $this->assertTrue(!empty($_SESSION['token_test_form']));
        $this->assertTrue(!empty($_SESSION['token_time_test_form']));
    }

    public function testGetSessionValue()
    {
        $this->assertTrue(!empty($_SESSION['token_test_form']));
        $this->assertTrue(!empty($_SESSION['token_time_test_form']));
    }

    public function testUnsetSession()
    {
        $this->session_handler->unsetSession('test_form', 'token_', 'token_time_');
        $this->assertTrue(empty($_SESSION['token_test_form']));
        $this->assertTrue(empty($_SESSION['token_time_test_form']));
    }
}