<?php
// index.php
require_once 'includes/functions.php';
require_once 'config/database.php';

$page_title = 'Home - Kampala University';
$db = getDB();

$news = [];
$events = [];
$faculties = [];

if ($db) {
    $news = $db->query("SELECT * FROM news WHERE is_published = 1 ORDER BY created_at DESC LIMIT 5")->fetchAll();
    $events = $db->query("SELECT * FROM events WHERE start_date >= NOW() ORDER BY start_date ASC LIMIT 5")->fetchAll();
    $faculties = $db->query("SELECT * FROM faculties LIMIT 4")->fetchAll();
}

include 'includes/header.php';
?>

<div class="hero-section">
    <div class="container text-center">
        <span class="hero-badge">Admissions Open • 2026/2027</span>
        <h1 class="display-3 fw-bold">Welcome to Kampala University</h1>
        <p class="lead">A vibrant learning community committed to academic excellence, meaningful research, and student success.</p>
        <div class="hero-actions">
            <a href="admissions/apply.php" class="btn btn-accent btn-lg">
                <i class="fas fa-pencil-alt"></i> Apply Now
            </a>
            <a href="pages/about.php" class="btn btn-outline-light btn-lg">
                Explore More
            </a>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="feature-card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-graduation-cap fa-3x"></i>
                    <h3 class="mt-3">Academic Excellence</h3>
                    <p>World-class education with diverse programs across multiple disciplines.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-flask fa-3x"></i>
                    <h3 class="mt-3">Research & Innovation</h3>
                    <p>Cutting-edge research and innovation hub for future leaders.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-users fa-3x"></i>
                    <h3 class="mt-3">Global Community</h3>
                    <p>Diverse international student community with global perspective.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 g-4">
        <div class="col-12">
            <div class="content-card reveal">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
                    <div>
                        <h2 class="mb-1"><i class="fas fa-camera"></i> Campus Life in Focus</h2>
                        <p class="text-muted mb-0">A glimpse of the learning spaces, community spirit, and opportunities that shape student life.</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="photo-card">
                            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=900&q=80" alt="Students learning in a modern classroom">
                            <div class="photo-card-body">
                                <h5>Modern Learning Spaces</h5>
                                <p>Bright classrooms and collaborative environments designed for active learning.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="photo-card">
                            <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=900&q=80" alt="Students studying together on campus">
                            <div class="photo-card-body">
                                <h5>Student Community</h5>
                                <p>Supportive peer networks, mentorship, and shared success across campus.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="photo-card">
                            <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=900&q=80" alt="University graduation or event atmosphere">
                            <div class="photo-card-body">
                                <h5>Campus Events & Growth</h5>
                                <p>From seminars to celebrations, every moment builds confidence and connection.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 g-4 align-items-stretch reveal">
        <div class="col-lg-7">
            <div class="content-card h-100">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-start gap-2 mb-3">
                    <div>
                        <h2 class="mb-1"><i class="fas fa-bolt"></i> Why Students Choose Kampala University</h2>
                        <p class="text-muted mb-0">A balanced campus experience built around quality teaching, mentorship, and real-world opportunity.</p>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="info-pill">
                            <i class="fas fa-book-open"></i>
                            <div>
                                <h5>Flexible Learning</h5>
                                <p>Innovative teaching approaches that support both traditional and modern learners.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-pill">
                            <i class="fas fa-laptop-code"></i>
                            <div>
                                <h5>Future-Ready Skills</h5>
                                <p>Practical programs shaped around technology, leadership, and career growth.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-pill">
                            <i class="fas fa-handshake"></i>
                            <div>
                                <h5>Supportive Community</h5>
                                <p>Mentorship, student services, and a welcoming campus culture from day one.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-pill">
                            <i class="fas fa-globe-africa"></i>
                            <div>
                                <h5>Global Perspective</h5>
                                <p>Programs and partnerships designed to prepare students for a connected world.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="content-card h-100">
                <h2><i class="fas fa-chart-line"></i> Campus At a Glance</h2>
                <div class="stats-grid">
                    <div class="stat-card">
                        <span class="stat-number" data-target="1200">0</span>
                        <p>Students Enrolled</p>
                    </div>
                    <div class="stat-card">
                        <span class="stat-number" data-target="35">0</span>
                        <p>Academic Programs</p>
                    </div>
                    <div class="stat-card">
                        <span class="stat-number" data-target="18">0</span>
                        <p>Years of Service</p>
                    </div>
                </div>
                <a href="admissions/apply.php" class="btn btn-accent mt-3">Start Your Application</a>
            </div>
        </div>
    </div>

    <div class="row mt-5 g-4">
        <div class="col-lg-6">
            <div class="content-card h-100 reveal">
                <h2><i class="fas fa-newspaper"></i> Latest News</h2>
                <?php if (empty($news)): ?>
                    <p class="text-muted mb-0">No news available at the moment.</p>
                <?php else: ?>
                    <?php foreach ($news as $item): ?>
                        <div class="news-item">
                            <h5><a href="pages/news_detail.php?id=<?php echo $item['id']; ?>">
                                <?php echo $item['title']; ?>
                            </a></h5>
                            <small class="text-muted">
                                <i class="fas fa-calendar-alt"></i> <?php echo formatDate($item['created_at']); ?>
                            </small>
                            <p><?php echo substr(strip_tags($item['content']), 0, 140) . '...'; ?></p>
                            <a href="pages/news_detail.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-primary">
                                Read More
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="content-card h-100">
                <h2><i class="fas fa-calendar-alt"></i> Upcoming Events</h2>
                <?php if (empty($events)): ?>
                    <p class="text-muted mb-0">No upcoming events yet. Please check back soon.</p>
                <?php else: ?>
                    <?php foreach ($events as $event): ?>
                        <div class="news-item">
                            <h5><?php echo $event['title']; ?></h5>
                            <p><i class="fas fa-calendar"></i> <?php echo formatDateTime($event['start_date']); ?></p>
                            <p><i class="fas fa-map-marker-alt"></i> <?php echo $event['venue']; ?></p>
                            <a href="pages/events.php" class="btn btn-sm btn-primary">View Details</a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
                    <div>
                        <h2 class="mb-1"><i class="fas fa-university"></i> Our Faculties</h2>
                        <p class="text-muted mb-0">Programs designed to prepare students for meaningful careers and impact.</p>
                    </div>
                    <a href="pages/faculties.php" class="btn btn-primary">View All Faculties</a>
                </div>
                <div class="row g-4">
                    <?php if (empty($faculties)): ?>
                        <div class="col-12">
                            <p class="text-muted mb-0">Faculty profiles will appear here once the admissions records are available.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($faculties as $faculty): ?>
                            <div class="col-md-3">
                                <div class="faculty-card h-100">
                                    <i class="fas fa-school fa-2x"></i>
                                    <h5 class="mt-3"><?php echo $faculty['name']; ?></h5>
                                    <p class="text-muted mb-3"><?php echo $faculty['code']; ?></p>
                                    <a href="pages/faculty_detail.php?id=<?php echo $faculty['id']; ?>" class="btn btn-sm btn-primary">
                                        Learn More
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>