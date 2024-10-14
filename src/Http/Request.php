<?php 
namespace App\Http;

class Request
{
    public function get($key)
    {
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }

    public function post($key)
    {
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }

    public function all()
    {
        return $_REQUEST;
    }
}
