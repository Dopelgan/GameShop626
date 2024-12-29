<?php
namespace App\Services;

use App\Log;

class LogService
{
    public static function write(string $level, string $message, array $context = [])
    {
        Log::create([
            'level' => $level,
            'message' => $message,
            'context' => $context,
        ]);
    }
}
