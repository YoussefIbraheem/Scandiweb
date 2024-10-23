<?php 

namespace App\Http;

/**
 * Class Request
 *
 * Handles HTTP request data.
 *
 * This class provides methods for retrieving data from 
 * various request superglobals like $_GET, $_POST, and $_REQUEST.
 * It also provides a method to retrieve the request path.
 *
 * @package App\Http
 */
class Request
{
    /**
     * Retrieves a value from the $_GET superglobal.
     *
     * @param string $key The key of the value to retrieve.
     * 
     * @return mixed|null The value from $_GET or null if the key does not exist.
     */
    public function get(string $key)
    {
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }

    /**
     * Retrieves a value from the $_POST superglobal.
     *
     * @param string $key The key of the value to retrieve.
     * 
     * @return mixed|null The value from $_POST or null if the key does not exist.
     */
    public function post(string $key)
    {
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }

    /**
     * Retrieves all values from the $_REQUEST superglobal.
     *
     * @return array An associative array of all request data.
     */
    public function all(): array
    {
        return $_REQUEST;
    }

    /**
     * Retrieves the request path from the server's request URI.
     *
     * @return array The parsed request URI.
     */
    public function getPath(): array
    {
        return parse_url($_SERVER['REQUEST_URI'] ?? '/');
    }
}
