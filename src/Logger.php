<?php

namespace App;

class Logger extends Singleton
{
    public const EMERGENCY = 'emergency';
    public const ALERT = 'alert';
    public const CRITICAL = 'critical';
    public const ERROR = 'error';
    public const WARNING = 'warning';
    public const NOTICE = 'notice';
    public const INFO = 'info';
    public const DEBUG = 'debug';
    
    private $logFilePath;

    public function __construct($filePath = __DIR__ . '/logs/errors.txt')
    {
        $this->logFilePath = $filePath;

        if (!file_exists($this->logFilePath)) {
            file_put_contents($this->logFilePath, "");
        }
    }

    public function log($level, $message, array $context = [])
    {
        $timestamp = date('Y-m-d H:i:s');
        $formattedMessage = "[{$timestamp}] - [{$level}] - {$message}";

        if (!empty($context)) {
            $formattedMessage .= ' ' . json_encode($context);
        }

        $formattedMessage .= "\n";

        error_log($formattedMessage, 3, $this->logFilePath);
    }
}
