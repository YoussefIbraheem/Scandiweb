<?php

namespace App;

class Logger extends Singleton
{
    private $logFilePath;

    public function __construct($filePath = __DIR__ . '/logs/errors.txt')
    {
        $this->logFilePath = $filePath;

        if (!file_exists($this->logFilePath)) {
            file_put_contents($this->logFilePath, "");
        }
    }

    public function log($message)
    {
        $timestamp = date('Y-m-d H:i:s');
        $formattedMessage = "[{$timestamp}] - {$message}\n";

        error_log($formattedMessage, 3, $this->logFilePath);
    }
}
