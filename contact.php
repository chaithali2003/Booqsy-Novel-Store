<?php include 'includes/header.php'; ?>

<!-- Contact Page Content -->
<div class="contact-page">
    <div class="contact-hero">
        <div class="container">
            <h1>Get In Touch</h1>
            <p>We'd love to hear from you</p>
        </div>
    </div>

    <div class="container contact-container">
        <div class="contact-methods">
            <div class="contact-card">
                <div class="contact-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <h3>Email Us</h3>
                <p>chaithalis471@gmail.com</p>
                <p>Response time: 24 hours</p>
            </div>
            
            <div class="contact-card">
                <div class="contact-icon">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <h3>Call Us</h3>
                <p>+91 9164044335</p>
                <p>Mon-Fri: 9AM-6PM</p>
            </div>
            
            <div class="contact-card">
                <div class="contact-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3>Visit Us</h3>
                <p>Darbe, Puttur</p>
                <p>DK, Karnataka 574202</p>
            </div>
        </div>

        <div class="contact-form-wrapper">
            <h2 class="text-center">Send a Message</h2>
            <form class="contact-form">
                <div class="form-row">
                    <div class="form-group">
                        <input type="text" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="Your Email" required>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Subject">
                </div>
                <div class="form-group">
                    <textarea placeholder="Your Message" rows="5" required></textarea>
                </div>
                <button type="submit" class="submit-btn">Send Message</button>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>