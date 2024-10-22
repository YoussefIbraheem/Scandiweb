<?php

namespace App\Session;

use App\Singleton;

class Session
{
    public function __construct()
    {
        // Start the session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function delete($key)
    {
        unset($_SESSION[$key]);
    }

    public function destroy()
    {
        session_destroy();
        $_SESSION = []; // Clear the session array
    }

    public function has($key)
    {
        return isset($_SESSION[$key]);
    }
}
