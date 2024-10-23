<?php 
namespace App;

/**
 * Class Singleton
 *
 * Implements the Singleton design pattern to ensure a class has only one instance 
 * and provides a global access point to that instance.
 */
class Singleton
{
    /**
     * @var array Holds the instances of the subclasses.
     */
    private static $instances = [];

    /**
     * Protected constructor to prevent creating a new instance of the class.
     * This ensures the Singleton pattern is followed.
     */
    protected function __construct() { }

    /**
     * Protected clone method to prevent cloning of the instance.
     */
    protected function __clone() { }

    /**
     * Prevents unserializing an instance of the class.
     * 
     * @throws \Exception if attempting to unserialize the singleton.
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }

    /**
     * Retrieves the single instance of the subclass.
     *
     * Checks if the subclass instance exists in the instances array, and if not, creates it.
     * Ensures that only one instance per subclass is created.
     *
     * @return static The instance of the subclass.
     */
    public static function getInstance()
    {
        $subclass = static::class;

        if (!isset(self::$instances[$subclass])) {
            self::$instances[$subclass] = new static();
        }

        return self::$instances[$subclass];
    }
}
