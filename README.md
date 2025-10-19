# Booqsy – Novel Store Web Application

**Booqsy** is a dynamic and user-friendly web application designed for browsing and purchasing novels online. Built using PHP and MySQL, the platform offers features such as genre-based browsing, advanced search functionality, and a shopping cart system, all within a responsive and intuitive interface.

---

## 📂 Project Structure

```
Booqsy-Novel-Store/
├── assets/              # Images, stylesheets, and scripts
├── includes/            # Reusable PHP components (e.g., header, footer)
├── about.php            # About page
├── cart.php             # Shopping cart page
├── cart_action.php      # Handles cart actions (add/remove)
├── contact.php          # Contact page
├── genre_books.php      # Displays books by genre
├── index.php            # Homepage
├── search_books.php     # Search results page
├── wishlist.php         # User's wishlist
├── wishlist_action.php  # Handles wishlist actions
└── booqsy_db.sql        # MySQL database schema
```

---

## 🚀 Features

* **Genre-Based Browsing:** Explore novels categorized by genre.
* **Advanced Search:** Filter books by title, author, and genre.
* **Shopping Cart:** Add, remove, and manage items in your cart.
* **Wishlist:** Save favorite books for future reference.
* **Responsive Design:** Optimized for both desktop and mobile devices.

---

## 🛠️ Technologies Used

* **Backend:** PHP
* **Database:** MySQL
* **Frontend:** HTML5, CSS3
* **Others:** JavaScript (for dynamic interactions)

---

## ⚙️ Setup Instructions

### Prerequisites

* PHP 7.4 or higher
* MySQL 5.7 or higher
* A web server (e.g., Apache or Nginx)
* A local development environment (e.g., XAMPP, WAMP, or MAMP)

### Steps to Run

1. **Clone the Repository:**

   ```bash
   git clone https://github.com/chaithali2003/Booqsy-Novel-Store.git
   cd Booqsy-Novel-Store
   ```

2. **Set Up the Database:**

   * Import the `booqsy_db.sql` file into your MySQL server to create the necessary database and tables.

3. **Configure Database Connection:**

   * Update the database connection details in your PHP files to match your MySQL setup.

4. **Run the Application:**

   * Place the project folder in your web server's root directory (e.g., `htdocs` for XAMPP).
   * Access the application via `http://localhost/Booqsy-Novel-Store/` in your web browser.


This project is licensed under the MIT License – see the [LICENSE](LICENSE) file for details.
