<?php
// Database connection
require __DIR__ . '/db_connection.php';
?>

<!-- Bookshelf Section -->
<section id="bookshelf" class="bookshelf-section">
    <div class="container">
        <div class="section-heading">
            <h2>Our Book Collection</h2>
            <p>Discover your next favorite read</p>
        </div>

        <?php
        $query = "SELECT * FROM books ORDER BY RAND() LIMIT 16";
        $result = $conn->query($query);
        
        if ($result->num_rows > 0) {
            $books = $result->fetch_all(MYSQLI_ASSOC);
            
            for ($row = 0; $row < 4; $row++) {
                echo '<div class="row book-row">';
                for ($col = 0; $col < 4; $col++) {
                    $book = $books[($row * 4 + $col)];
                    $isInWishlist = isset($_SESSION['user_id']) ? checkInWishlist($book['id'], $conn) : false;
                    
                    // Prepare class and icon based on wishlist status
                    $wishlistClass = $isInWishlist ? 'active' : '';
                    $heartIcon = $isInWishlist ? 'bi-heart-fill' : 'bi-heart';
                    
                    echo '
                    <div class="col-md-3 book-col">
                        <div class="book-card">
                            <div class="wishlist '.$wishlistClass.'" 
                                 onclick="return toggleWishlist('.$book['id'].', this)">
                                <i class="bi '.$heartIcon.'"></i>
                            </div>
                            <img src="assets/images/books/'.$book['image'].'" alt="'.$book['title'].'">
                            <div class="book-details">
                                <h5>'.$book['title'].'</h5>
                                <p class="author">by '.$book['author'].'</p>
                                <p class="price">₹'.$book['price'].'</p>
                                <button class="add-to-cart" onclick="return addToCart('.$book['id'].', event)">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>';
                }
                echo '</div>';
            }
        } else {
            echo '<p class="text-center">No books found in our collection.</p>';
        }
        
        // Helper function to check if book is in wishlist
        function checkInWishlist($bookId, $conn) {
            $stmt = $conn->prepare("SELECT id FROM wishlist 
                                  WHERE user_id = ? AND book_id = ?");
            $stmt->bind_param("ii", $_SESSION['user_id'], $bookId);
            $stmt->execute();
            return $stmt->get_result()->num_rows > 0;
        }
        ?>
    </div>
</section>