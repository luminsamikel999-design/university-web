<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../config/database.php';

$page_title = 'About Us - Kampala University';
include __DIR__ . '/../includes/header.php';
?>

<div class="container py-5">
    <div class="page-hero">
        <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1200&q=80" alt="Campus life at Kampala University">
        <div class="page-hero-body">
            <h2><i class="fas fa-university"></i> About Kampala University</h2>
            <p>We blend academic excellence, personal support, and modern facilities to help every student thrive.</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <h2><i class="fas fa-university"></i> About Kampala University</h2>
                <p>Kampala University is a dynamic institution focused on academic excellence, practical innovation, and student-centered learning. We offer a wide range of undergraduate and postgraduate programs designed to prepare graduates for real-world leadership and service.</p>
                <p>Our campus culture encourages curiosity, entrepreneurship, and ethical citizenship. From admissions to graduation, we provide students with the tools and guidance needed to thrive.</p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="content-card">
                <h4>Why Choose Us?</h4>
                <ul class="mb-0">
                    <li>Experienced faculty</li>
                    <li>Flexible study pathways</li>
                    <li>Modern academic facilities</li>
                    <li>Supportive student services</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
