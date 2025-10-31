    <!-- Footer -->
    <footer class="bg-dark text-light py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>CA Associates</h5>
                    <p>Professional Chartered Accountancy services with 15+ years of experience serving businesses in Mumbai.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="about.php" class="text-light">About Us</a></li>
                        <li><a href="services.php" class="text-light">Services</a></li>
                        <li><a href="contact.php" class="text-light">Contact</a></li>
                        <li><a href="privacy.php" class="text-light">Privacy Policy</a></li>
                        <li><a href="terms.php" class="text-light">Terms & Conditions</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Info</h5>
                    <p><i class="fas fa-map-marker-alt"></i> 123 Business Tower, Mumbai</p>
                    <p><i class="fas fa-phone"></i> +91-7796846847</p>
                    <p><i class="fas fa-envelope"></i> info@caassociates.com</p>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p>&copy; 2025 CA Associates. All Rights Reserved DESIGNED BY JIVAJI SHIVANE.</p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Float -->
    <a href="https://wa.me/917796846847" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Form validation
        function validateForm() {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const mobile = document.getElementById('mobile').value;
            
            if (name.length < 2) {
                alert('Please enter a valid name');
                return false;
            }
            
            if (!email.includes('@')) {
                alert('Please enter a valid email');
                return false;
            }
            
            if (mobile.length < 10) {
                alert('Please enter a valid mobile number');
                return false;
            }
            
            return true;
        }
    </script>
</body>
</html>