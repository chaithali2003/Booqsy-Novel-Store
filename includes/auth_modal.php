<?php
// Form processing at the TOP of the file
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login_email'])) {
        // Login processing
        $email = $conn->real_escape_string($_POST['login_email']);
        $password = $_POST['login_password'];
        
        $sql = "SELECT id, name, email, password FROM users WHERE email = '$email'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                
                echo '<script>
                    alert("Login successful!");
                    var modal = bootstrap.Modal.getInstance(document.getElementById("loginSignupModal"));
                    modal.hide();
                    window.location.reload();
                </script>';
                exit();
            } else {
                echo '<script>alert("Invalid email or password");</script>';
            }
        } else {
            echo '<script>alert("Invalid email or password");</script>';
        }
    } elseif (isset($_POST['signup_name'])) {
        // Signup processing
        $name = $conn->real_escape_string($_POST['signup_name']);
        $email = $conn->real_escape_string($_POST['signup_email']);
        $password = $_POST['signup_password'];
        $confirm_password = $_POST['signup_confirm_password'];
        
        // Validation
        $errors = [];
        
        if (empty($name)) {
            $errors[] = "Name is required";
        }
        
        if (empty($email)) {
            $errors[] = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Valid email is required";
        }
        
        if (empty($password)) {
            $errors[] = "Password is required";
        } elseif (strlen($password) < 6) {
            $errors[] = "Password must be at least 6 characters";
        }
        
        if ($password !== $confirm_password) {
            $errors[] = "Passwords do not match";
        }
        
        if (empty($errors)) {
            $check_email = $conn->query("SELECT id FROM users WHERE email = '$email'");
            if ($check_email->num_rows > 0) {
                $errors[] = "Email already registered";
            }
        }
        
        if (!empty($errors)) {
            echo '<script>alert("'.implode("\\n", $errors).'");</script>';
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
            
            if ($conn->query($sql)) {
                echo '<script>
                    alert("Registration successful! Please login.");
                    toggleMode();
                </script>';
            } else {
                echo '<script>alert("Error: '.$conn->error.'");</script>';
            }
        }
    }
}
?>

<div class="modal fade" id="loginSignupModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content p-0 border-0 bg-transparent">
            <div class="container-wrapper" id="formContainer">
                <!-- Login -->
                <div class="form-panel left">
                    <div class="panel-logo icon-group">
                        <img src="images/booqsy-logo.png" alt="Booqsy Logo" style="height: 20px;" class="me-2">
                        <span class="blade-animate">BOOQSY</span>
                    </div>
                    <h3>Log In</h3>
                    <form method="POST" action="">
                        <div class="input-group">
                            <input type="email" class="form-control" name="login_email" placeholder="Email" required>
                            <i class="fas fa-envelope input-icon"></i>
                        </div>
                        <div class="input-group">
                            <input type="password" class="form-control" name="login_password" placeholder="Password" required>
                            <i class="fas fa-lock input-icon"></i>
                        </div>
                        <center><button type="submit" class="btn btn-custom">LOG IN</button></center>
                    </form>
                </div>

                <!-- Sign Up -->
                <div class="form-panel right">
                    <div class="panel-logo icon-group">
                        <img src="images/booqsy-logo.png" alt="Booqsy Logo" style="height: 20px;" class="me-2">
                        <span class="blade-animate">BOOQSY</span>
                    </div>
                    <h3>Sign Up</h3>
                    <form method="POST" action="">
                        <div class="input-group">
                            <input type="text" class="form-control" name="signup_name" placeholder="Full Name" required>
                            <i class="fas fa-user input-icon"></i>
                        </div>
                        <div class="input-group">
                            <input type="email" class="form-control" name="signup_email" placeholder="Email" required>
                            <i class="fas fa-envelope input-icon"></i>
                        </div>
                        <div class="input-group">
                            <input type="password" class="form-control" name="signup_password" placeholder="Password" required>
                            <i class="fas fa-lock input-icon"></i>
                        </div>
                        <div class="input-group">
                            <input type="password" class="form-control" name="signup_confirm_password" placeholder="Confirm Password" required>
                            <i class="fas fa-check input-icon"></i>
                        </div>
                        <center><button type="submit" class="btn btn-custom">SIGN UP</button><center>
                    </form>
                </div>

                <!-- Switch Panel -->
                <div class="switch-panel container text-center py-4" id="switchPanel">
                    <div id="switchContent">
                        <img src="images/girl-book.png" alt="Welcome to Booqsy" class="img-fluid mb-3" style="max-height: 250px;">
                        <h2 class="fw-bold">New to Booqsy?</h2>
                        <p>Click below to explore Booqsy.</p>
                        <button type="button" class="btn btn-outline-light" onclick="toggleMode()">SIGN UP</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Improved toggle function
function toggleMode() {
    const container = document.getElementById('formContainer');
    container.classList.toggle('active');
    
    // Update switch panel content
    const switchContent = document.getElementById('switchContent');
    if (container.classList.contains('active')) {
        switchContent.innerHTML = `
            <img src="images/girl-book.png" alt="Welcome back" class="img-fluid mb-3" style="max-height: 250px;">
            <h2 class="fw-bold">Welcome back!</h2>
            <p>Continue your reading journey</p>
            <button type="button" class="btn btn-outline-light" onclick="toggleMode()">LOG IN</button>
        `;
    } else {
        switchContent.innerHTML = `
            <img src="images/girl-book.png" alt="Welcome to Booqsy" class="img-fluid mb-3" style="max-height: 250px;">
            <h2 class="fw-bold">New to Booqsy?</h2>
            <p>Start your reading journey with us</p>
            <button type="button" class="btn btn-outline-light" onclick="toggleMode()">SIGN UP</button>
        `;
    }
}
</script>