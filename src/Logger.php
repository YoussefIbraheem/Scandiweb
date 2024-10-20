<?php

namespace App;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class Logger extends Singleton implements LoggerInterface
{
    private $logFilePath;

    public function __construct($filePath = __DIR__ . '/logs/errors.txt')
    {
        $this->logFilePath = $filePath;

        if (!file_exists($this->logFilePath)) {
            file_put_contents($this->logFilePath, "");
        }
    }

    // PSR-3 required methods for each log level
    public function emergency($message, array $context = [])
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    public function alert($message, array $context = [])
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }

    public function critical($message, array $context = [])
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    public function error($message, array $context = [])
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    public function warning($message, array $context = [])
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }

    public function notice($message, array $context = [])
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    public function info($message, array $context = [])
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    public function debug($message, array $context = [])
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }

    // PSR-3 log method that accepts level and handles context interpolation
    public function log($level, $message, array $context = [])
    {
        $message = $this->interpolate($message, $context);
        $timestamp = date('Y-m-d H:i:s');
        $formattedMessage = "[{$timestamp}] - [{$level}] - {$message}\n";
        
        error_log($formattedMessage, 3, $this->logFilePath);
    }

    // Interpolates context values into the message placeholders.
    private function interpolate($message, array $context = [])
    {
        // Build a replacement array with braces around context keys.
        $replace = [];
        foreach ($context as $key => $value) {
            $replace['{' . $key . '}'] = $value;
        }

        // Interpolate replacement values into the message and return.
        return strtr($message, $replace);
    }
}
