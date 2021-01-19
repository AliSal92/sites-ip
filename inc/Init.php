<?php
namespace SitesIP;

use SitesIP\Services\Download;
use SitesIP\Services\ServiceInterface;

final class Init
{
    /**
     * Store all the classes inside an array
     * @return array Full list of classes
     */
    public static function getServices()
    {
        return [
            Download::class
        ];
    }

    /**
     * Loop through the classes, initialize them,
     * and call the register() method if it exists
     * @return void
     */
    public static function registerServices()
    {
        foreach (self::getServices() as $class) {
            $service = self::instantiate($class);
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }

    /**
     * Initialize the class
     * @param  string $class    class from the services array
     * @return ServiceInterface instance new instance of the class
     */
    private static function instantiate($class)
    {
        return new $class();
    }
}
