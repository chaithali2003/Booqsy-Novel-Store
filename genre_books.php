<?php
require __DIR__ . '/includes/header.php';

// Database connection
require __DIR__ . '/includes/db_connection.php';

// Get the selected genre
$selectedGenre = $_GET['genre'] ?? '';

// Validate genre against allowed values
$allowedGenres = ['fiction', 'mystery', 'romance', 'sci-fi', 'fantasy', 'biography', 'history', 'thriller', 'horror'];
if (!in_array($selectedGenre, $allowedGenres)) {
    header("Location: index.php");
    exit();
}

// Get genre display name
$genreNames = [
    'fiction' => 'Fiction',
    'mystery' => 'Mystery',
    'romance' => 'Romance',
    'sci-fi' => 'Sci-Fi',
    'fantasy' => 'Fantasy',
    'biography' => 'Biography',
    'history' => 'History',
    'thriller' => 'Thriller',
    'horror' => 'Horror'
];
$genreDisplayName = $genreNames[$selectedGenre] ?? 'Books';
?>

<section class="bookshelf-section">
    <div class="container">
        <div class="section-heading">
            <h2><?= htmlspecialchars($genreDisplayName) ?> Collection</h2>
            <p>Discover our <?= htmlspecialchars($genreDisplayName) ?> books</p>
        </div>

        <div class="row">
            <?php
            // Fetch books for the selected genre
            $stmt = $conn->prepare("SELECT * FROM books WHERE genre = ?");
            $stmt->bind_param("s", $selectedGenre);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0):
                while ($book = $result->fetch_assoc()):
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
                endwhile;
            else:
            ?>
            <div class="col-12">
                <div class="alert alert-info">No books found in this genre.</div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
require __DIR__ . '/includes/footer.php';
?>