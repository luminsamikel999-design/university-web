<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/faculty_profile.php';

$page_title = 'Faculties - Kampala University';
$db = getDB();
$faculties = [];
if ($db) {
    $faculties = $db->query('SELECT * FROM faculties ORDER BY name')->fetchAll();
}

include __DIR__ . '/../includes/header.php';
?>

<div class="container py-5">
    <div class="page-hero">
        <img src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=1200&q=80" alt="Academic faculties and study environment">
        <div class="page-hero-body">
            <h2><i class="fas fa-school"></i> Our Faculties</h2>
            <p>Discover the academic units that shape the university experience through research, teaching, and innovation.</p>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2><i class="fas fa-school"></i> Our Faculties</h2>
            <p class="text-muted mb-0">Explore academic units that shape the university experience.</p>
        </div>
        <a href="../admissions/apply.php" class="btn btn-primary">Apply Now</a>
    </div>

    <div class="row g-4">
        <?php if (empty($faculties)): ?>
            <div class="col-12">
                <div class="content-card">
                    <p class="mb-0 text-muted">Faculty records will appear here once they are available in the database.</p>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($faculties as $faculty): ?>
                <?php $profile = getFacultyProfile($faculty); ?>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card h-100">
                        <h4><?php echo htmlspecialchars($faculty['name']); ?></h4>
                        <p class="text-muted mb-3"><strong>Code:</strong> <?php echo htmlspecialchars($faculty['code']); ?></p>
                        <p><?php echo htmlspecialchars($faculty['description'] ?? $profile['summary']); ?></p>
                        <ul class="small text-muted">
                            <li><?php echo htmlspecialchars($profile['focus']); ?></li>
                            <li><?php echo htmlspecialchars($profile['programs'][0]); ?></li>
                        </ul>
                        <a href="faculty_detail.php?id=<?php echo $faculty['id']; ?>" class="btn btn-sm btn-primary">Learn More</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
