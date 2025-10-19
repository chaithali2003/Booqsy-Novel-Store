<?php
session_start();
require __DIR__ . '/db_connection.php';

$action = $_GET['action'] ?? '';
$bookId = (int)($_GET['book_id'] ?? 0);

if ($bookId <= 0) {
    exit('invalid_book');
}

// Only proceed if user is logged in
if (!isset($_SESSION['user_id'])) {
    exit('not_logged_in');
}

if ($action === 'add') {
    // Check if already in wishlist
    $check = $conn->prepare("SELECT id FROM wishlist WHERE user_id = ? AND book_id = ?");
    $check->bind_param("ii", $_SESSION['user_id'], $bookId);
    $check->execute();
    
    if ($check->get_result()->num_rows === 0) {
        $insert = $conn->prepare("INSERT INTO wishlist (user_id, book_id) VALUES (?, ?)");
        $insert->bind_param("ii", $_SESSION['user_id'], $bookId);
        if ($insert->execute()) {
            exit('added');
        } else {
            exit('failed');
        }
    } else {
        exit('already_exists');
    }
} elseif ($action === 'remove') {
    $delete = $conn->prepare("DELETE FROM wishlist WHERE user_id = ? AND book_id = ?");
    $delete->bind_param("ii", $_SESSION['user_id'], $bookId);
    if ($delete->execute()) {
        exit('removed');
    } else {
        exit('failed');
    }
} else {
    exit('invalid_action');
}
?>