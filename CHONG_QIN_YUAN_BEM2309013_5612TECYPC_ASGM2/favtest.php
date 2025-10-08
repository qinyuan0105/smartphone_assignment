<?php
header('Content-Type: application/json');
session_start();

// Validate user session
if (!isset($_SESSION['userID']) || empty($_SESSION['userID'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$userId = $_SESSION['userID'];

// Validate input
if (!isset($_POST['item_id']) || empty($_POST['item_id'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid item ID']);
    exit;
}

$itemId = (string)$_POST['item_id'];
$action = isset($_POST['action']) ? $_POST['action'] : 'add';

// File path
$filePath = 'data/fav.json';

// Read existing data
$favorites = [];
if (file_exists($filePath)) {
    $jsonData = file_get_contents($filePath);
    $favorites = json_decode($jsonData, true) ?: [];
}

// Initialize user's favorites if not exists
if (!isset($favorites[$userId])) {
    $favorites[$userId] = [];
}

// Add or remove favorite
if ($action === 'add') {
    if (!in_array($itemId, $favorites[$userId])) {
        $favorites[$userId][] = $itemId;
    }
} else {
    $index = array_search($itemId, $favorites[$userId]);
    if ($index !== false) {
        array_splice($favorites[$userId], $index, 1);
    }
}

// Update session variable
$_SESSION['favsmartphone'] = $favorites[$userId];

// Save back to file
if (file_put_contents($filePath, json_encode($favorites, JSON_PRETTY_PRINT))) {
    echo json_encode(['success' => true, 'favsmartphone' => $_SESSION['favsmartphone']]);
} else {
    echo json_encode(['success' => false, 'message' => 'Could not save favorites']);
}
?>