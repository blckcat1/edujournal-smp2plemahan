<?php

// Vercel serverless environment adjustments
if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL']) || getenv('VERCEL')) {
    $viewPath = '/tmp/views';
    if (!is_dir($viewPath)) {
        @mkdir($viewPath, 0755, true);
    }
    putenv("VIEW_COMPILED_PATH={$viewPath}");
    
    // Set standard stdout/stderr for logging on serverless
    putenv('LOG_CHANNEL=stderr');
}

// Forward to standard Laravel public/index.php
require __DIR__ . '/../public/index.php';
