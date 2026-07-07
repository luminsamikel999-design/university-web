<?php
$base_url = '/mike/';
?>
    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h5><i class="fas fa-university"></i> Kampala University</h5>
                    <p class="mb-0">Excellence in Education, Research, and Innovation</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo $base_url; ?>admissions/apply.php">Apply Now</a></li>
                        <li><a href="<?php echo $base_url; ?>pages/faculties.php">Faculties</a></li>
                        <li><a href="<?php echo $base_url; ?>pages/news.php">News & Events</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact</h5>
                    <p><i class="fas fa-phone"></i> +256-XXX-XXX-XXX</p>
                    <p><i class="fas fa-envelope"></i> info@kampalauniversity.ac.ug</p>
                    <p><i class="fas fa-map-marker-alt"></i> Kampala, Uganda</p>
                </div>
            </div>
            <div class="text-center mt-4">
                <p class="mb-0">&copy; <?php echo date('Y'); ?> Kampala University. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $base_url; ?>assets/js/script.js"></script>
</body>
</html>