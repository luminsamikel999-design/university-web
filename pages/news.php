<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../config/database.php';

$page_title = 'News - Kampala University';
$db = getDB();
$news = [];
if ($db) {
    $news = $db->query('SELECT * FROM news WHERE is_published = 1 ORDER BY created_at DESC')->fetchAll();
}

include __DIR__ . '/../includes/header.php';
?>

<div class="container py-5">
    <div class="page-hero">
        <img src="https://images.unsplash.com/photo-1495020689067-958852a7765e?auto=format&fit=crop&w=1200&q=80" alt="University news and student activities">
        <div class="page-hero-body">
            <h2><i class="fas fa-newspaper"></i> University News</h2>
            <p>Stay up to date with achievements, announcements, and campus stories from Kampala University.</p>
        </div>
    </div>

    <div class="mb-4">
        <h2><i class="fas fa-newspaper"></i> University News</h2>
        <p class="text-muted mb-0">Stay informed about achievements, events, and updates from Kampala University.</p>
    </div>

    <div class="row g-4">
        <?php if (empty($news)): ?>
            <div class="col-12">
                <div class="content-card">
                    <p class="mb-0 text-muted">No published news is available yet.</p>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($news as $item): ?>
                <div class="col-12">
                    <div class="content-card">
                        <h4><?php echo htmlspecialchars($item['title']); ?></h4>
                        <p class="text-muted"><i class="fas fa-calendar-alt"></i> <?php echo formatDate($item['created_at']); ?></p>
                        <p><?php echo htmlspecialchars(substr(strip_tags($item['content']), 0, 220)); ?>...</p>
                        <a href="news_detail.php?id=<?php echo $item['id']; ?>" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
