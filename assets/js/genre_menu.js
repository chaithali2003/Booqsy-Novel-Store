// Initialize dropdown
const genreDropdown = new bootstrap.Dropdown(document.getElementById('genreDropdown'));

// Keep menu open when hovering
document.getElementById('genreDropdown').addEventListener('mouseenter', () => {
    genreDropdown.show();
});

document.querySelector('.genre-dropdown').addEventListener('mouseleave', () => {
    setTimeout(() => {
        if (!document.querySelector('.genre-dropdown:hover')) {
            genreDropdown.hide();
        }
    }, 200);
});