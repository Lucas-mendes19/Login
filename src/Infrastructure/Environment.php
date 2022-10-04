<?php

namespace Project\System\Infrastructure;

class Environment
{
    public static function load(string $dir)
    {
        if (!file_exists($dir))
            return;

        $lines = file($dir.'/.env');
        foreach ($lines as $line) {
            if (trim($line))
                putenv(trim($line));
        }
    }
}