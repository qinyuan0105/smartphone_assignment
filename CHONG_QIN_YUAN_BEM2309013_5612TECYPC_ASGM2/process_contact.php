<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';
    
    // Store the message in a JSON file
    $contact = [
        'timestamp' => date('Y-m-d H:i:s'),
        'name' => $name,
        'email' => $email,
        'subject' => $subject,
        'message' => $message
    ];
    
    $messages = [];
    if (file_exists('data/contact_messages.json')) {
        $messages = json_decode(file_get_contents('data/contact_messages.json'), true);
    }
    
    $messages[] = $contact;
    file_put_contents('data/contact_messages.json', json_encode($messages, JSON_PRETTY_PRINT));
    
    // Redirect back with success message
    header('Location: contact.php?status=success');
    exit;
}

header('Location: contact.php?status=error');
exit;
