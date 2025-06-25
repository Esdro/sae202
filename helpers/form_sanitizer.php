<?php

function sanitizeInput( string $data): string {
    // Trim whitespace from the beginning and end of the string
    $data = trim($data);
    // Remove backslashes
    $data = stripslashes($data);
    // Convert special characters to HTML entities to prevent XSS attacks
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}


function sanitizeArray(array $data): array {
    // Sanitize each element in the array
    return array_map('sanitizeInput', $data);
}

function sanitizeDate(string $date): string {
    $date = sanitizeInput($date);
    $timestamp = strtotime($date);
    
    if ($timestamp === false) {
        return '';
    }

    $year = date('Y', $timestamp);
    $currentYear = date('Y');
    $minYear = 1900;
    $maxYear = $currentYear - 10;

    if ($year < $minYear || $year > $maxYear) {
        return '';
    }

    return date('Y-m-d', $timestamp);
}