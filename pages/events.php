<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../config/database.php';

$page_title = 'Events - Kampala University';
$db = getDB();
$events = [];
if ($db) {
    $events = $db->query('SELECT * FROM events ORDER BY start_date ASC')->fetchAll();
}

include __DIR__ . '/../includes/header.php';
?>

<div class="container py-5">
    <div class="page-hero">
        <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?auto=format&fit=crop&w=1200&q=80" alt="University event atmosphere">
        <div class="page-hero-body">
            <h2><i class="fas fa-calendar-alt"></i> Upcoming Events</h2>
            <p>Explore academic, cultural, and community events designed to inspire connection and growth.</p>
        </div>
    </div>

    <div class="mb-4">
        <h2><i class="fas fa-calendar-alt"></i> Upcoming Events</h2>
        <p class="text-muted mb-0">Join us for academic, cultural, and community events throughout the year.</p>
    </div>

    <div class="row g-4">
        <?php if (empty($events)): ?>
            <div class="col-12">
                <div class="content-card">
                    <p class="mb-0 text-muted">No events have been published yet.</p>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($events as $event): ?>
                <div class="col-12">
                    <div class="content-card">
                        <h4><?php echo htmlspecialchars($event['title']); ?></h4>
                        <p class="text-muted mb-2"><i class="fas fa-calendar"></i> <?php echo formatDateTime($event['start_date']); ?></p>
                        <p><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($event['venue']); ?></p>
                        <p><?php echo htmlspecialchars($event['description'] ?? 'More details coming soon.'); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
