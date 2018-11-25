<?php
session_start();

use ScienceHook\Security\CSRF\CSRF;
use ScienceHook\Security\CSRF\Exception as Issues;

require_once 'vendor/autoload.php';

$csrf = new CSRF('test_form');

try {
    $csrf->createToken();
    $field = $csrf->createHiddenField();
} catch (Issues\SessionNotActiveException $e) {
    echo $e->getMessage();
    die();
} catch (Issues\SessionValueNotSet $e) {
    echo $e->getMessage();
    die();
} catch (\Exception $e) {
    echo 'Unknown error occurred.';
    // Log exception
    die();
} catch (TypeError $e) {
    echo 'Method parameter type mismatch. Please recheck all the passing parameters.';
    die();
} catch (\Error $e) {
    echo 'Unknown error occurred.';
    // Log error
    die();
}

?>

<!doctype html>
<html>
<body>
<form id="test_form" name="test_form" action="form_validation.php" method="get">
    <label for="name">Name</label>
    <input type="text" id="name" name="name">
    <?php
    echo $field;
    ?>
    <input type="submit" value="Submit">
</form>
</body>
</html>