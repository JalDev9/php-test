<?php
require_once __DIR__ . '/vendor/autoload.php'; // Include Composer autoload

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/model/SubscriberModel.php';
require_once __DIR__ . '/controller/SubscriberController.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Database connection using PDO
$config = include(__DIR__ . '/config/database.php');
try {
    $conn = new PDO("mysql:host={$config['servername']};dbname={$config['dbname']}", $config['username'], $config['password']);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Initialize SubscriberModel and SubscriberController
$model = new SubscriberModel($conn);
$controller = new SubscriberController($model);

// Handle incoming POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $controller->handlePostRequest($data);
}

// Handle incoming GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $pageSize = isset($_GET['limit']) ? intval($_GET['limit']) : 10;

    $controller->handleGetRequest($page, $pageSize);
}

// Close the database connection
$conn = null;
