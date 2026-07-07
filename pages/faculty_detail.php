<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/faculty_profile.php';

$page_title = 'Faculty Detail - Kampala University';
$db = getDB();
$id = (int)($_GET['id'] ?? 0);
$faculty = null;
if ($db && $id) {
    $stmt = $db->prepare('SELECT * FROM faculties WHERE id = ?');
    $stmt->execute([$id]);
    $faculty = $stmt->fetch();
}

include __DIR__ . '/../includes/header.php';
?>

<div class="container py-5">
    <div class="page-hero">
        <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=1200&q=80" alt="Faculty learning environment">
        <div class="page-hero-body">
            <h2><i class="fas fa-school"></i> Faculty Profile</h2>
            <p>Learn more about the programs, opportunities, and career pathways linked to this faculty.</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="content-card">
                <?php if ($faculty): ?>
                    <?php $profile = getFacultyProfile($faculty); ?>
                    <h2><i class="fas fa-school"></i> <?php echo htmlspecialchars($faculty['name']); ?></h2>
                    <p class="text-muted">Faculty Code: <?php echo htmlspecialchars($faculty['code']); ?></p>
                    <p><?php echo htmlspecialchars($faculty['description'] ?? $profile['summary']); ?></p>

                    <div class="row g-4 mt-3">
                        <div class="col-md-6">
                            <div class="feature-card h-100">
                                <h5>Our Focus</h5>
                                <p class="mb-0"><?php echo htmlspecialchars($profile['focus']); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card h-100">
                                <h5>Popular Programs</h5>
                                <ul class="mb-0">
                                    <?php foreach ($profile['programs'] as $program): ?>
                                        <li><?php echo htmlspecialchars($program); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 mt-1">
                        <div class="col-md-6">
                            <div class="feature-card h-100">
                                <h5>Highlights</h5>
                                <ul class="mb-0">
                                    <?php foreach ($profile['highlights'] as $highlight): ?>
                                        <li><?php echo htmlspecialchars($highlight); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card h-100">
                                <h5>Career Paths</h5>
                                <ul class="mb-0">
                                    <?php foreach ($profile['careers'] as $career): ?>
                                        <li><?php echo htmlspecialchars($career); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info mt-4 mb-0">
                        <strong>Admission Note:</strong> <?php echo htmlspecialchars($profile['admission']); ?>
                    </div>
                    <a href="faculties.php" class="btn btn-primary mt-4">Back to Faculties</a>
                <?php else: ?>
                    <div class="alert alert-warning">The requested faculty could not be found.</div>
                    <a href="faculties.php" class="btn btn-primary">Back to Faculties</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
