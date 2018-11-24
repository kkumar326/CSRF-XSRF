<?php
namespace ScienceHook\Security\CSRF\Dependency\SessionHandler;

use ScienceHook\Security\CSRF\Exception as Issues;

/**
 * Class SessionHandler
 *
 * @package ScienceHook\Security\Dependency\SessionHandler
 * @author Kshitij Kumar
 */
class SessionHandler
{
    /**
     * Checks whether SESSION is active or not
     *
     * @return object
     * @throws Issues\SessionNotActiveException
     */
    private function &checkSessionStatus(): object
    {
        // If SESSION is not active throw Exception
        if (session_status() !== PHP_SESSION_ACTIVE) {
            throw new Issues\SessionNotActiveException(
                'Session is not active. Please run session_start()
                on top of your file.'
            );
        }

        return $this;
    }

    /**
     * Checks if SESSION value is set
     *
     * @param  string $session_variable Session value to be verified
     * @return bool
     * @throws Issues\SessionValueNotSet
     */
    private function isSessionValueSet(string $session_variable): bool
    {
        if (!isset($session_variable)) {
            throw new Issues\SessionValueNotSet(
                'Token value is empty. Please refresh your page
                and try submitting form again.'
            );
        }

        return true;
    }

    /**
     * Sets SESSION value
     *
     * @param string $form_name                  Form identifier e.g. name or id
     * @param string $token_prefix               Token Prefix
     * @param string $time_token_prefix          Time Token Prefix
     * @param int $byte_length                   Byte length for random_bytes
     * @throws Issues\SessionNotActiveException
     * @throws \Exception
     * @throws \TypeError
     * @throws \Error
     */
    public function setSessionValue(
        string $form_name,
        string $token_prefix,
        string $time_token_prefix,
        int $byte_length
    ) {
        $this->checkSessionStatus();

        // random_bytes can throw Exceptions or Errors
        $_SESSION[$token_prefix . $form_name] = bin2hex(random_bytes($byte_length));

        // Set current time with the token
        $_SESSION[$time_token_prefix . $form_name] = time();
    }

    /**
     * Returns session value
     *
     * @param string $form_name
     * @param string $prefix
     * @return mixed
     * @throws Issues\SessionNotActiveException
     * @throws Issues\SessionValueNotSet
     */
    public function getSessionValue(string $form_name, string $prefix)
    {
        $this->checkSessionStatus()->isSessionValueSet($_SESSION[$prefix . $form_name]);

        return $_SESSION[$prefix . $form_name];
    }

    /**
     * Unsets both token SESSIONs for the Form
     *
     * @param string $form_name
     * @param string $token_prefix
     * @param string $time_token_prefix
     * @throws Issues\SessionNotActiveException
     * @throws Issues\SessionValueNotSet
     */
    public function unsetSession(
        string $form_name,
        string $token_prefix,
        string $time_token_prefix
    ) {
        // Unsets SESSION if tokens are found
        if ($this->checkSessionStatus()->isSessionValueSet($_SESSION[$token_prefix .
        $form_name])) {
            unset($_SESSION[$token_prefix . $form_name]);
        }

        if ($this->checkSessionStatus()->isSessionValueSet($_SESSION[$time_token_prefix
        . $form_name])) {
            unset($_SESSION[$time_token_prefix . $form_name]);
        }
    }
}
