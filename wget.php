#!/usr/bin/php
<?php

// PGET = Minimal cross-platform WGET implementation in PHP

// Get URL from first argument 
$url = $argv[1];

$contents = file_get_contents($url);

file_put_contents(basename($url), $contents);
