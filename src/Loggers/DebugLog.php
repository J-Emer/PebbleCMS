<?php

namespace Jemer\PebbleCms\Loggers;

class DebugLog
{
    // The log file path for debug messages
    private static $logFile = __DIR__ . '/../../Logs/debug.log';

    /**
     * Log a debug message to the debug log file.
     *
     * @param string $message The debug message to log.
     * @param string|null $context Optional context for the debug message (e.g., function name, file name).
     */
    public static function log(string $message, ?string $context = null)
    {
        // Format the log entry
        $dateTime = new \DateTime();
        $logMessage = "[" . $dateTime->format('Y-m-d H:i:s') . "] DEBUG: " . $message;

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
