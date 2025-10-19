<?php
// Database connection
require __DIR__ . '/db_connection.php';

$genres = [
    'Fiction' => ['slug' => 'fiction', 'icon' => 'fa-book'],
    'Mystery' => ['slug' => 'mystery', 'icon' => 'fa-search'],
    'Romance' => ['slug' => 'romance', 'icon' => 'fa-heart'],
    'Sci-Fi' => ['slug' => 'sci-fi', 'icon' => 'fa-rocket'],
    'Fantasy' => ['slug' => 'fantasy', 'icon' => 'fa-dragon'],
    'Biography' => ['slug' => 'biography', 'icon' => 'fa-user'],
    'History' => ['slug' => 'history', 'icon' => 'fa-landmark'],
    'Thriller' => ['slug' => 'thriller', 'icon' => 'fa-mask'],
    'Horror' => ['slug' => 'horror', 'icon' => 'fa-ghost'],
];
?>

<div class="container-fluid p-3">
    <div class="row">
        <?php foreach (array_chunk($genres, 3, true) as $genreGroup): ?>
        <div class="col-md-3 px-2">
            <div class="genre-group">
                <?php foreach ($genreGroup as $name => $details): ?>
                <a href="genre_books.php?genre=<?= $details['slug'] ?>" class="genre-item">
                    <div class="genre-icon">
                        <i class="fas <?= $details['icon'] ?>"></i>
                    </div>
                    <span class="genre-name"><?= $name ?></span>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>