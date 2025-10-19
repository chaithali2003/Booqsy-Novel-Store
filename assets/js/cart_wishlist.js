// Initialize toast when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize toast
    window.successToast = new bootstrap.Toast(document.getElementById('successToast'));
    
    // Load counts based on login status
    if (document.body.classList.contains('logged-in')) {
        updateCartCount();
        updateWishlistCount();
    } else {
        updateGuestCartCount();
        updateGuestWishlistCount();
    }
});

function handleWishlistClick(bookId, element, event) {
    event.preventDefault();
    event.stopPropagation();
    
    if (!document.body.classList.contains('logged-in')) {
        showLoginAlert();
        return false;
    }
    
    toggleWishlist(bookId, element);
    return false;
}

function handleCartClick(bookId, element, event) {
    event.preventDefault();
    event.stopPropagation();
    
    if (!document.body.classList.contains('logged-in')) {
        showLoginAlert();
        return false;
    }
    
    addToCart(bookId, event);
    return false;
}

async function addToCart(bookId, event) {
    try {
        const response = await fetch(`cart_action.php?action=add&book_id=${bookId}`);
        const result = await response.text();
        
        if (result === 'added' || result === 'quantity_updated') {
            if (event && event.target) {
                event.target.textContent = 'Added!';
                event.target.disabled = true;
                setTimeout(() => {
                    event.target.textContent = 'Add to Cart';
                    event.target.disabled = false;
                }, 2000);
            }
            updateCartCount();
            showToast('Added to cart successfully!');
        } else if (result === 'not_logged_in') {
            showLoginAlert();
        } else {
            showToast('Failed to add to cart');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('Error adding to cart');
    }
}

async function toggleWishlist(bookId, element) {
    const isActive = element.classList.contains('active');
    
    try {
        const response = await fetch(`wishlist_action.php?action=${isActive ? 'remove' : 'add'}&book_id=${bookId}`);
        const result = await response.text();
        
        if (result === 'added' || result === 'removed') {
            element.classList.toggle('active');
            const heartIcon = element.querySelector('i');
            if (heartIcon) {
                heartIcon.classList.toggle('bi-heart');
                heartIcon.classList.toggle('bi-heart-fill');
            }
            updateWishlistCount();
            showToast(isActive ? 'Removed from wishlist' : 'Added to wishlist');
        } else if (result === 'not_logged_in') {
            showLoginAlert();
        } else {
            showToast('Operation failed');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('Operation failed');
    }
}

function showLoginAlert() {
    alert('Please login to use this feature');
    // Optional: Open login modal
    // var modal = new bootstrap.Modal(document.getElementById('loginSignupModal'));
    // modal.show();
}

// Update guest cart count
function updateGuestCartCount() {
    const guestCart = JSON.parse(sessionStorage.getItem('guestCart') || {});
    const count = Object.values(guestCart).reduce((sum, qty) => sum + qty, 0);
    const badge = document.getElementById('cart-count');
    if (badge) {
        badge.textContent = count || 0;
        badge.classList.toggle('d-none', count <= 0);
    }
}

// Update guest wishlist count
function updateGuestWishlistCount() {
    const guestWishlist = JSON.parse(sessionStorage.getItem('guestWishlist') || {});
    const count = Object.keys(guestWishlist).length;
    const badge = document.getElementById('wishlist-count');
    if (badge) {
        badge.textContent = count || 0;
        badge.classList.toggle('d-none', count <= 0);
    }
}

// Update database cart count
function updateCartCount() {
    fetch('get_counts.php')
        .then(response => response.text())
        .then(data => {
            const counts = data.split(',');
            const badge = document.getElementById('cart-count');
            if (badge && counts.length === 2) {
                badge.textContent = counts[0] || 0;
                badge.classList.toggle('d-none', !counts[0] || counts[0] <= 0);
            }
        });
}

// Update database wishlist count
function updateWishlistCount() {
    fetch('get_counts.php')
        .then(response => response.text())
        .then(data => {
            const counts = data.split(',');
            const badge = document.getElementById('wishlist-count');
            if (badge && counts.length === 2) {
                badge.textContent = counts[1] || 0;
                badge.classList.toggle('d-none', !counts[1] || counts[1] <= 0);
            }
        });
}

// Show toast message
function showToast(message) {
    const toastMessage = document.getElementById('toastMessage');
    if (toastMessage && window.successToast) {
        toastMessage.textContent = message;
        window.successToast.show();
        setTimeout(() => window.successToast.hide(), 3000);
    }
}