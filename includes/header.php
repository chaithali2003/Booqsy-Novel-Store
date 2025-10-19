<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booqsy</title>
    <link rel="icon" href="images/booqsy-logo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/index_styles.css">
    <link rel="stylesheet" href="assets/css/genre_menu_styles.css">
    <link rel="stylesheet" href="assets/css/bookshelf_styles.css">
    <link rel="stylesheet" href="assets/css/login_signup_styles.css">
    <link rel="stylesheet" href="assets/css/about_contact_styles.css">
    <link rel="stylesheet" href="assets/css/footer_styles.css">
    
</head>

<body class="<?php echo isset($_SESSION['user_id']) ? 'logged-in' : ''; ?>">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
        <div class="container align-items-center">
            <div class="d-flex align-items-center">
                <div class="icon-group d-flex flex-column">
                    <span class="navbar-brand d-flex align-items-center mb-0">
                        <img src="assets/images/booqsy-logo.png" alt="Booqsy Logo" style="height: 40px;" class="me-2">
                        <span class="blade-animate">BOOQSY</span>
                    </span>
                </div>
            </div>

            <form class="d-flex mx-auto search-form" role="search" action="search_books.php" method="GET">
    <input class="form-control search-input" type="search" name="query" placeholder="Search by title or author..." aria-label="Search" required>
    <button class="btn search-icon" type="submit"><i class="fas fa-search"></i></button>
</form>

            <div class="icon-group d-flex align-items-center">
    <a href="<?php echo isset($_SESSION['user_id']) ? 'wishlist.php' : '#'; ?>" 
   onclick="<?php echo !isset($_SESSION['user_id']) ? 'showLoginAlert(); return false;' : ''; ?>" 
   class="me-3">
    <i class="fas fa-heart"></i>
    <span class="wishlist-badge d-none" id="wishlist-count">0</span>
</a>

<!-- cart -->
<a href="<?php echo isset($_SESSION['user_id']) ? 'cart.php' : '#'; ?>" 
   onclick="<?php echo !isset($_SESSION['user_id']) ? 'showLoginAlert(); return false;' : ''; ?>" 
   class="me-3">
    <i class="fas fa-shopping-cart"></i>
    <span class="cart-badge d-none" id="cart-count">0</span>
</a>
<script>
function showLoginAlert() {
    alert('Please login to access this feature');
}
</script>
    <!-- profile/logout -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <span class="me-2">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
        <a href="#" onclick="return confirmLogout()" class="me-3" title="Logout">
    <i class="fas fa-sign-out-alt"></i>
</a>

<script>
function confirmLogout() {
    if (confirm("Are you sure you want to logout?")) {
        window.location.href = "includes/logout.php";
    }
    return false; // Prevent default link behavior
}
</script>
    <?php else: ?>
        <a href="#" class="me-3" data-bs-toggle="modal" data-bs-target="#loginSignupModal">
            <i class="fas fa-user"></i>
        </a>
    <?php endif; ?>
</div>
        </div>
    </nav>

    <!-- Menu -->
    <div class="bg-basic py-2">
        <div class="container">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php">
                        <i class="fas fa-home me-1"></i> Home
                    </a>
                </li>
                <li class="nav-item dropdown">
    <a class="nav-link text-white dropdown-toggle" href="#" id="genreDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-book-open me-1"></i> Genre
    </a>
    <div class="dropdown-menu genre-dropdown p-0" aria-labelledby="genreDropdown">
        <?php include 'includes/genre_menu.php'; ?>
    </div>
</li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="about.php">
                        <i class="fas fa-info-circle me-1"></i> About
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="contact.php">
                        <i class="fas fa-envelope me-1"></i> Contact
                    </a>
                </li>
            </ul>
        </div>
    </div>
<!-- Success Toast -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
    <div id="successToast" class="toast align-items-center text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="toastMessage"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>