<?php
session_start();

use ScienceHook\Security\CSRF\CSRF;
use ScienceHook\Security\CSRF\Exception as Issues;

require_once 'vendor/autoload.php';

// Splitting token in form_name and token value
$token_data = explode(':', $_GET['token']);

$csrf = new CSRF($token_data[0]);

try {
    $valid = $csrf->checkValid($token_data[1]);
} catch (Issues\SessionNotActiveException $e) {
    echo $e->getMessage();
    die();
} catch (Issues\SessionValueNotSet $e) {
    echo $e->getMessage();
    die();
}

if (!$valid) {
    $csrf->showInvalidError();
    die();
} else {
    echo 'It\'s working';
}

/* your code */