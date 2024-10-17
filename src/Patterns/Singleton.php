<?php 
 namespace App\Patterns;

class Singleton
{
    private static $instances = [];

    protected function __construct() { }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }

    public static function getInstances()
    {
        $subclass = static::class;

        if(!isset(self::$instances[$subclass]))
        {
            self::$instances[$subclass] = new static();
        }

        return self::$instances[$subclass];
    }


}




?>