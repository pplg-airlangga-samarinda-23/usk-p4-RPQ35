<?php

function loadEnv($path)
{
    if (!file_exists($path)) {
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Skip comments (lines starting with #)
        if (strpos(trim($line), '#') === 0) continue;

        // Split by the first '=' found
        list($name, $value) = explode('=', $line, 2);

        $name = trim($name);
        $value = trim($value);

        // Remove quotes if they exist (e.g., "my value" -> my value)
        $value = trim($value, '"\'');

        // Set the environment variable
        $_ENV[$name] = $value;
        putenv("$name=$value");
    }
}

loadEnv(__DIR__ . '/.env');

// var_dump($_ENV);


$connect = new Pdo("mysql:host=localhost;dbname=$_ENV[DB_NAME]", "$_ENV[DB_USERNAME]", "$_ENV[DB_PASSWORD]");

try {
    $connect->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
    define('$db_con', $connect);
} catch (PDOException $e) {
    echo $e;
}


if (session_status() === PHP_SESSION_NONE) {
    session_start();
};
