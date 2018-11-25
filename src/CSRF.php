<?php
namespace ScienceHook\Security\CSRF;

use ScienceHook\Security\CSRF\Exception as Issues;
use ScienceHook\Security\CSRF\Dependency\SessionHandler\SessionHandler;

/**
 * Class CSRF
 *
 * @package ScienceHook\Security\CSRF
 * @author Kshitij Kumar
 */
class CSRF
{
    /**
     * Stores form_name to store CSRF token value in SESSION
     *
     * @var string
     */
    private $form_name;

    /**
     * Byte length for random_bytes
     *
     * @var int
     */
    private $length;

    /**
     * SessionHandler object to manage SESSION operations
     *
     * @var SessionHandler
     */
    private $session_handler;

    /**
     * Token prefix for Form
     *
     * @var string
     */
    private $token_prefix;

    /**
     * Time token prefix
     *
     * @var string
     */
    private $time_token_prefix;

    /**
     * CSRF constructor
     *
     * @param  string $form_name         Value for form_name param
     * @param  int $length               Byte length value for length param
     * @param string $token_prefix       User preferred token prefix
     * @param string $time_token_prefix  User preferred time token prefix
     */
    public function __construct(
        string $form_name,
        int $length = 32,
        string $token_prefix = 'token_',
        string $time_token_prefix = 'token_time_'
    ) {
        $this->form_name = $form_name;
        $this->length = $length;
        $this->token_prefix = $token_prefix;
        $this->time_token_prefix = $time_token_prefix;
        $this->session_handler = new SessionHandler();
    }

    /**
     * Creates SESSION with token and time token value
     *
     * @throws Issues\SessionNotActiveException
     * @throws \Exception
     * @throws \TypeError
     * @throws \Error
     */
    public function createToken()
    {
        $this->session_handler->setSessionValue(
            $this->form_name,
            $this->token_prefix,
            $this->time_token_prefix,
            $this->length
        );
    }

    /**
     * Returns token value (Not Time Token) from SESSION
     *
     * @return string
     * @throws Issues\SessionNotActiveException
     * @throws Issues\SessionValueNotSet
     */
    private function getTokenValue(): string
    {
        return $this->session_handler->getSessionValue(
            $this->form_name,
            $this->token_prefix
        );
    }

    /**
     * Returns time token value from SESSION
     *
     * @return string
     * @throws Issues\SessionNotActiveException
     * @throws Issues\SessionValueNotSet
     */
    private function getTimeTokenValue(): string
    {
        return $this->session_handler->getSessionValue(
            $this->form_name,
            $this->time_token_prefix
        );
    }

    /**
     * @param string $token    Token passed in form validation for verification
     * @param int $time        Token expiry time
     * @return bool
     * @throws Issues\SessionNotActiveException
     * @throws Issues\SessionValueNotSet
     */
    public function checkValid(string $token, int $time = 300): bool
    {
        // Compares hash values of token, not time one
        $is_valid = hash_equals(
            $token,
            $this->session_handler->getSessionValue(
                $this->form_name,
                $this->token_prefix
            )
        );

        // Checks if the token is expired
        $is_expired = $this->checkExpired($time);
        return $is_valid && !$is_expired;
    }

    /**
     * Checks token expiry based on user's time input in checkValid()
     *
     * @param int $time
     * @return bool
     * @throws Issues\SessionNotActiveException
     * @throws Issues\SessionValueNotSet
     */
    private function checkExpired(int $time): bool
    {
        $token_age = time() - $this->getTimeTokenValue();

        if ($token_age >= $time) {
            // Deletes the tokens in session for this person
            $this->session_handler->unsetSession(
                $this->form_name,
                $this->token_prefix,
                $this->time_token_prefix
            );
            return true;
        } else {
            return false;
        }
    }

    /**
     * Creates hidden field for forms
     *
     * @return string
     * @throws Issues\SessionNotActiveException
     * @throws Issues\SessionValueNotSet
     */
    public function createHiddenField(): string
    {
        // creates the HTML for a hidden text field with the token
        // form_name is being passed along with the token
        // You can override this method to include more parameters as per your needs
        // or in case of inconsistent token prefixes or byte length for random_bytes

        $field = '<input type="hidden" id="token" name="token" value="' . $this->form_name . ':' .
            $this->getTokenValue() . '">';
        return $field;
    }

    /**
     * Echos token expiry message
     */
    public function showInvalidError()
    {
        echo '* Your token has expired. Please refresh the page and try again.';
    }
}
