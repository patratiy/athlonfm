<?php

namespace App\Helpers;

use Config\Paths;

class Utils
{
    private static $pathLogInfo = null;
    private static $pathLogError = null;

    private static function configure(): void
    {
        $paths = new Paths();
        self::$pathLogInfo = $paths->writableDirectory . '/logs/custom_info.log';
        self::$pathLogError = $paths->writableDirectory . '/logs/custom_error.log';
    }

    /**
     * @param mixed $data
     */
    public static function logError($data): void
    {
        self::configure();
        file_put_contents(self::$pathLogError, self::dataFormatter($data) . PHP_EOL, FILE_APPEND);
    }

    /**
     * @param mixed $data
     */
    public static function logInfo($data): void
    {
        self::configure();
        file_put_contents(self::$pathLogInfo, self::dataFormatter($data) . PHP_EOL, FILE_APPEND);
    }

    /**
     * @param mixed $data
     * @return string
     */
    private static function dataFormatter($data): string
    {
        ob_start();
        var_dump($data);
        return ob_get_clean();
    }
}