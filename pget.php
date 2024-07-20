#!/usr/bin/php
<?php

// PGET = Minimal cross-platform WGET implementation in PHP

// Check if URL argument is provided
if ($argc < 2) {
    echo "Usage: pget <URL>\n";
    exit(1);
}

// Get URL from first argument
$url = $argv[1];

// If URL has no scheme, prepend https://
if (strpos($url, '://') === false) {
    $url = 'https://'.$url;
}

// Validate URL
if (! filter_var($url, FILTER_VALIDATE_URL)) {
    echo "Error: Invalid URL provided.\n";
    exit(1);
}

echo "Downloading from: $url\n";

// Attempt to get contents with error handling
try {
    $contents = @file_get_contents($url);

    if ($contents === false) {
        throw new Exception('Failed to download the file.');
    }

    $filename = basename($url);

    // Attempt to save file with error handling
    if (file_put_contents($filename, $contents) === false) {
        throw new Exception('Failed to save the file.');
    }

    echo "File downloaded successfully: $filename\n";
    echo 'File size: '.strlen($contents)." bytes\n";
} catch (Exception $exception) {
    echo 'Error: '.$exception->getMessage()."\n";
    exit(1);
}
