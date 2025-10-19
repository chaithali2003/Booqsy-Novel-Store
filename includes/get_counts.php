<?php
session_start();
require __DIR__ . '/db_connection.php';

if (!isset($_SESSION['user_id'])) {
    exit('0'); // Return 0 if not logged in
}

$userId = $_SESSION['user_id'];

// Get cart count
$cartCount = 0;
$cartQuery = $conn->prepare("SELECT SUM(quantity) AS total FROM cart WHERE user_id = ?");
$cartQuery->bind_param("i", $userId);
$cartQuery->execute();
$cartResult = $cartQuery->get_result();
if ($cartResult->num_rows > 0) {
    $cartCount = $cartResult->fetch_assoc()['total'] ?? 0;
}

// Get wishlist count
$wishlistCount = 0;
$wishlistQuery = $conn->prepare("SELECT COUNT(*) AS total FROM wishlist WHERE user_id = ?");
$wishlistQuery->bind_param("i", $userId);
$wishlistQuery->execute();
$wishlistResult = $wishlistQuery->get_result();
if ($wishlistResult->num_rows > 0) {
    $wishlistCount = $wishlistResult->fetch_assoc()['total'] ?? 0;
}

// Return counts separated by comma (cart,wishlist)
echo "$cartCount,$wishlistCount";
?>