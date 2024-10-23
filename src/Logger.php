<?php

namespace App;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Stringable;

class Logger extends Singleton implements LoggerInterface
{
    private $logFilePath;

    /**
     * Class constructor.
     *
     * Initializes the logger and creates the log file if it doesn't exist.
     *
     * @param string $filePath The file path for the log file. Defaults to '/logs/errors.txt'.
     */
    public function __construct($filePath = __DIR__ . '/logs/errors.txt')
    {
        $this->logFilePath = $filePath;

        if (!file_exists($this->logFilePath)) {
            file_put_contents($this->logFilePath, "");
        }
    }

    /**
     * Logs an emergency message (system is unusable).
     *
     * @param Stringable|string $message The log message.
     * @param array $context Additional context for the log.
     * @return void
     */
    public function emergency(Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * Logs an alert message (action must be taken immediately).
     *
     * @param Stringable|string $message The log message.
     * @param array $context Additional context for the log.
     * @return void
     */
    public function alert(Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }

    /**
     * Logs a critical message (critical conditions).
     *
     * @param Stringable|string $message The log message.
     * @param array $context Additional context for the log.
     * @return void
     */
    public function critical(Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * Logs an error message (error conditions).
     *
     * @param Stringable|string $message The log message.
     * @param array $context Additional context for the log.
     * @return void
     */
    public function error(Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    /**
     * Logs a warning message (exceptional occurrences that are not errors).
     *
     * @param Stringable|string $message The log message.
     * @param array $context Additional context for the log.
     * @return void
     */
    public function warning(Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }

    /**
     * Logs a notice message (normal but significant events).
     *
     * @param Stringable|string $message The log message.
     * @param array $context Additional context for the log.
     * @return void
     */
    public function notice(Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    /**
     * Logs an informational message.
     *
     * @param Stringable|string $message The log message.
     * @param array $context Additional context for the log.
     * @return void
     */
    public function info(Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    /**
     * Logs a debug message (detailed debug information).
     *
     * @param Stringable|string $message The log message.
     * @param array $context Additional context for the log.
     * @return void
     */
    public function debug(Stringable|string $message, array $context = []): void
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level The log level (e.g., LogLevel::ERROR).
     * @param Stringable|string $message The log message.
     * @param array $context Additional context for the log.
     * @return void
     */
    public function log($level, Stringable|string $message, array $context = []): void
    {
        $message = $this->interpolate($message, $context);
        $timestamp = date('Y-m-d H:i:s');
        $formattedMessage = "[{$timestamp}] - [{$level}] - {$message}\n";
        
        if (!empty($context)) {
            $formattedMessage .= ' ' . json_encode($context);
        }
    
        $formattedMessage .= "\n";
        
        @error_log($formattedMessage, 3, $this->logFilePath);
    }

    /**
     * Interpolates context values into the message placeholders.
     *
     * Replaces placeholders in the message with the corresponding context values.
     *
     * @param Stringable|string $message The log message with placeholders.
     * @param array $context The context values to replace placeholders.
     * @return string The message with placeholders replaced by context values.
     */
    private function interpolate(Stringable|string $message, array $context = []): string
    {
        $replace = [];
        foreach ($context as $key => $value) {
            $replace['{' . $key . '}'] = $value;
        }

        return strtr($message, $replace);
    }
}
