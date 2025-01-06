<?php

namespace Jemer\PebbleCms\Loggers;

class ErrorLog
{
    // The log file path
    private static $logFile = __DIR__ . '/../../Logs/error.log';

    /**
     * Log an error message to the error log file.
     *
     * @param string $message The error message to log.
     * @param string|null $context Optional context for the error (e.g., function name, file name).
     */
    public static function log(string $message, ?string $context = null)
    {
        // Format the log entry
        $dateTime = new \DateTime();
        $logMessage = "[" . $dateTime->format('Y-m-d H:i:s') . "] ERROR: " . $message;

        // If context is provided, add it to the log message
        if ($context) {
            $logMessage .= " | Context: {$context}";
        }

        $logMessage .= PHP_EOL;

        // Write the log message to the file
        file_put_contents(self::$logFile, $logMessage, FILE_APPEND);
    }
}

?>
