<?php

namespace Jemer\PebbleCms\Loggers;

class ScreenLog
{
    /**
     * Display a message on the screen.
     *
     * @param string $message The message to display on the screen.
     * @param string|null $context Optional context for the message (e.g., function name, file name).
     * @param string $type The type of message (e.g., 'info', 'warning', 'error'). Default is 'info'.
     */
    public static function log(string $message, ?string $context = null, string $type = 'info')
    {
        // Format the message
        $formattedMessage = self::formatMessage($message, $context, $type);

        // Display the message on the screen
        echo $formattedMessage;
    }

    /**
     * Format the log message.
     *
     * @param string $message The message to format.
     * @param string|null $context Optional context for the message.
     * @param string $type The type of message (e.g., 'info', 'warning', 'error').
     * @return string The formatted log message.
     */
    private static function formatMessage(string $message, ?string $context, string $type): string
    {
        // Define the color for each type of message
        $colors = [
            'info' => 'color: blue;',
            'warning' => 'color: orange;',
            'error' => 'color: red;',
        ];

        // Use default color if the type is unknown
        $color = $colors[$type] ?? 'color: black;';

        // Add context if provided
        $contextMessage = $context ? " [Context: {$context}]" : '';

        // Format the message with an HTML style
        return "<div style='{$color}'>[{$type}] {$message}{$contextMessage}</div>";
    }
}

?>
