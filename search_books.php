<?php
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/db_connection.php';
require __DIR__ . '/includes/auth_modal.php';


$searchQuery = $_GET['query'] ?? '';
$searchQuery = trim($searchQuery);

if (empty($searchQuery)) {
    header("Location: index.php");
    exit();
}

// Search for exact matches first
$stmt = $conn->prepare("SELECT * FROM books 
                       WHERE title LIKE CONCAT('%', ?, '%') 
                       OR author LIKE CONCAT('%', ?, '%')");
$stmt->bind_param("ss", $searchQuery, $searchQuery);
$stmt->execute();
$result = $stmt->get_result();
?>

<section class="bookshelf-section">
    <div class="container">
        <div class="section-heading">
            <h2>Search Results for "<?= htmlspecialchars($searchQuery) ?>"</h2>
            
            <?php if ($result->num_rows > 0): ?>
                <p><?= $result->num_rows ?> book(s) found</p>
            <?php else: ?>
                <p>No exact matches found for "<?= htmlspecialchars($searchQuery) ?>"</p>
            <?php endif; ?>
        </div>

        <div class="row">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($book = $result->fetch_assoc()): ?>
                <div class="col-md-3 mb-4">
                    <div class="book-card">
                        <div class="wishlist" onclick="toggleWishlist(<?= $book['id'] ?>)">
                            <i class="bi bi-heart"></i>
                        </div>
                        <img src="assets/images/books/<?= htmlspecialchars($book['image']) ?>" alt="<?= htmlspecialchars($book['title']) ?>">
                        <div class="book-details">
                            <h5><?= htmlspecialchars($book['title']) ?></h5>
                            <p class="author">by <?= htmlspecialchars($book['author']) ?></p>
                            <p class="price">₹<?= number_format($book['price'], 2) ?></p>
                            <button class="add-to-cart" onclick="addToCart(<?= $book['id'] ?>)">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <!-- Show related books if no exact matches found -->
                <div class="col-12 mb-4">
                    <h4>You might be interested in:</h4>
                </div>
                <?php
                // Get related books (search individual words)
                $words = explode(' ', $searchQuery);
                $relatedBooks = [];
                
                foreach ($words as $word) {
                    if (strlen($word) > 2) { // Only search for words longer than 2 characters
                        $stmt = $conn->prepare("SELECT * FROM books 
                                              WHERE title LIKE CONCAT('%', ?, '%') 
                                              OR author LIKE CONCAT('%', ?, '%')
                                              LIMIT 4");
                        $stmt->bind_param("ss", $word, $word);
                        $stmt->execute();
                        $relatedResult = $stmt->get_result();
                        
                        while ($book = $relatedResult->fetch_assoc()) {
                            if (!in_array($book['id'], array_column($relatedBooks, 'id'))) {
                                $relatedBooks[] = $book;
                            }
                        }
                    }
                }
                
                if (!empty($relatedBooks)):
                    foreach ($relatedBooks as $book):
                ?>
                <div class="col-md-3 mb-4">
                    <div class="book-card">
                        <div class="wishlist" onclick="toggleWishlist(<?= $book['id'] ?>)">
                            <i class="bi bi-heart"></i>
                        </div>
                        <img src="assets/images/books/<?= htmlspecialchars($book['image']) ?>" alt="<?= htmlspecialchars($book['title']) ?>">
                        <div class="book-details">
                            <h5><?= htmlspecialchars($book['title']) ?></h5>
                            <p class="author">by <?= htmlspecialchars($book['author']) ?></p>
                            <p class="price">₹<?= number_format($book['price'], 2) ?></p>
                            <button class="add-to-cart" onclick="addToCart(<?= $book['id'] ?>)">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <?php
                    endforeach;
                else:
                ?>
                <div class="col-12">
                <div class="alert" style="background-color: #e1d0e4ff; color: #36123eff;">No related books found.</div>
                </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
require __DIR__ . '/includes/footer.php';
?>