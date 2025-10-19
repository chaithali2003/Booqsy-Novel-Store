<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_url'] = 'cart.php';
    header("Location: login.php");
    exit();
}

require __DIR__ . '/includes/db_connection.php';
require __DIR__ . '/includes/header.php';

// Handle quantity updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
    foreach ($_POST['quantities'] as $bookId => $quantity) {
        $quantity = max(1, min(10, (int)$quantity)); // Limit 1-10
        $stmt = $conn->prepare("UPDATE cart SET quantity = ? 
                               WHERE user_id = ? AND book_id = ?");
        $stmt->bind_param("iii", $quantity, $_SESSION['user_id'], $bookId);
        $stmt->execute();
    }
}

// Calculate total
$total = 0;
?>

<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Your Shopping Cart</h2>
            
            <form method="POST" action="cart.php">
                <div class="row">
                    <?php
                    // Fetch cart items for the current user
                    $userId = $_SESSION['user_id'];
                    $query = "SELECT b.*, c.quantity FROM cart c 
                             JOIN books b ON c.book_id = b.id 
                             WHERE c.user_id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $userId);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0): ?>
                        <?php while ($item = $result->fetch_assoc()): 
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        ?>
                        <div class="col-md-6 mb-4">
                            <div class="card cart-item">
                                <div class="row g-0">
                                    <div class="col-md-3">
                                        <img src="assets/images/books/<?= htmlspecialchars($item['image']) ?>" 
                                             class="img-fluid rounded-start" 
                                             alt="<?= htmlspecialchars($item['title']) ?>">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= htmlspecialchars($item['title']) ?></h5>
                                            <p class="card-text">by <?= htmlspecialchars($item['author']) ?></p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="quantity-selector">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" 
                                                            onclick="this.nextElementSibling.stepDown(); updateTotal()">-</button>
                                                    <input type="number" name="quantities[<?= $item['id'] ?>]" 
                                                           value="<?= $item['quantity'] ?>" min="1" max="10" 
                                                           class="form-control text-center" style="width: 50px;">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" 
                                                            onclick="this.previousElementSibling.stepUp(); updateTotal()">+</button>
                                                </div>
                                                <div class="price">
                                                    ₹<?= number_format($subtotal, 2) ?>
                                                </div>
                                                <button type="button" class="btn btn-outline-danger btn-sm" 
                                                        onclick="removeFromCart(<?= $item['id'] ?>)">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                        
                        <div class="col-12 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h5>Total:</h5>
                                        <h5 id="cart-total">₹<?= number_format($total, 2) ?></h5>
                                    </div>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                                        <button type="submit" name="update_cart" 
                                                class="btn btn-outline-primary me-md-2">
                                            Update Cart
                                        </button>
                                        <a href="checkout.php" class="btn btn-primary">
                                            Proceed to Checkout
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="alert" style="background-color: #e1d0e4ff; color: #36123eff;">
                                Your cart is empty. Start shopping now!
                            </div>
                            <a href="index.php" class="btn" style="background: #754a7f; color: white;">Browse Books</a>
                        </div>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function removeFromCart(bookId) {
    if (confirm('Remove this item from your cart?')) {
        fetch('cart_action.php?action=remove&book_id=' + bookId)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            });
    }
}

function updateTotal() {
    // Client-side total update logic can be added here
}
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>