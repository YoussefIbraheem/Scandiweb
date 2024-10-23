<?php

namespace App\Session;

use App\Singleton;

/**
 * Class Session
 *
 * Manages user session data in the application.
 *
 * This class provides methods to set, get, delete, and manage session variables,
 * ensuring that session management is handled efficiently.
 *
 * @package App\Session
 */
class Session
{
    /**
     * Session constructor.
     *
     * Initializes a new session or resumes the existing one.
     * This constructor checks if a session is already started; if not, it starts a new session.
     */
    public function __construct()
    {
        // Start the session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Sets a session variable.
     *
     * @param string $key The key for the session variable.
     * @param mixed $value The value to set for the session variable.
     */
    public function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Retrieves a session variable.
     *
     * @param string $key The key for the session variable.
     * 
     * @return mixed|null The value of the session variable, or null if it does not exist.
     */
    public function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }

    /**
     * Deletes a session variable.
     *
     * @param string $key The key for the session variable to delete.
     */
    public function delete(string $key): void
    {
        unset($_SESSION[$key]);
    }

    /**
     * Destroys the current session.
     *
     * This method ends the session and clears the session array.
     */
    public function destroy(): void
    {
        session_destroy();
        $_SESSION = []; // Clear the session array
    }

    /**
     * Checks if a session variable exists.
     *
     * @param string $key The key for the session variable.
     * 
     * @return bool True if the session variable exists, false otherwise.
     */
    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }
}
