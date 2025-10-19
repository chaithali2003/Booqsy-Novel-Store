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
    // Check if book exists
    $bookCheck = $conn->prepare("SELECT id FROM books WHERE id = ?");
    $bookCheck->bind_param("i", $bookId);
    $bookCheck->execute();
    
    if ($bookCheck->get_result()->num_rows === 0) {
        exit('book_not_found');
    }

    // Check if already in cart
    $cartCheck = $conn->prepare("SELECT quantity FROM cart WHERE user_id = ? AND book_id = ?");
    $cartCheck->bind_param("ii", $_SESSION['user_id'], $bookId);
    $cartCheck->execute();
    $result = $cartCheck->get_result();
    
    if ($result->num_rows > 0) {
        // Update quantity
        $current = $result->fetch_assoc();
        $newQuantity = min(10, $current['quantity'] + 1);
        
        $update = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND book_id = ?");
        $update->bind_param("iii", $newQuantity, $_SESSION['user_id'], $bookId);
        if ($update->execute()) {
            exit('quantity_updated');
        } else {
            exit('update_failed');
        }
    } else {
        // Add new item
        $insert = $conn->prepare("INSERT INTO cart (user_id, book_id, quantity) VALUES (?, ?, 1)");
        $insert->bind_param("ii", $_SESSION['user_id'], $bookId);
        if ($insert->execute()) {
            exit('added');
        } else {
            exit('add_failed');
        }
    }
} else {
    exit('invalid_action');
}
?>