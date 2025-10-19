<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_url'] = 'wishlist.php';
    header("Location: login.php");
    exit();
}

require __DIR__ . '/includes/db_connection.php';
require __DIR__ . '/includes/header.php';
?>

<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Your Wishlist</h2>
            
            <?php
            // Fetch wishlist items for the current user
            $userId = $_SESSION['user_id'];
            $query = "SELECT b.* FROM wishlist w 
                     JOIN books b ON w.book_id = b.id 
                     WHERE w.user_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0): ?>
                <div class="row">
                    <?php while ($book = $result->fetch_assoc()): ?>
                    <div class="col-md-3 mb-4">
                        <div class="book-card">
                            <div class="wishlist active" onclick="toggleWishlist(<?= $book['id'] ?>)">
                                <i class="bi bi-heart-fill"></i>
                            </div>
                            <img src="assets/images/books/<?= htmlspecialchars($book['image']) ?>" 
                                 alt="<?= htmlspecialchars($book['title']) ?>">
                            <div class="book-details">
                                <h5><?= htmlspecialchars($book['title']) ?></h5>
                                <p class="author">by <?= htmlspecialchars($book['author']) ?></p>
                                <p class="price">₹<?= number_format($book['price'], 2) ?></p>
                                <button class="add-to-cart" onclick="addToCart(<?= $book['id'] ?>)">
                                    Add to Cart
                                </button>
                                <button class="btn btn-outline-danger mt-2" 
                                        onclick="removeFromWishlist(<?= $book['id'] ?>)">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <div class="alert" style="background-color: #e1d0e4ff; color: #36123eff;">
                    Your wishlist is empty. Start adding books!
                </div>
                <a href="index.php" class="btn" style="background: #754a7f; color: white;">Browse Books</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
function removeFromWishlist(bookId) {
    fetch('wishlist_action.php?action=remove&book_id=' + bookId)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        });
}
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>