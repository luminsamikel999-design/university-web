<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../config/database.php';

$page_title = 'News Detail - Kampala University';
$db = getDB();
$id = (int)($_GET['id'] ?? 0);
$item = null;
if ($db && $id) {
    $stmt = $db->prepare('SELECT * FROM news WHERE id = ? AND is_published = 1');
    $stmt->execute([$id]);
    $item = $stmt->fetch();
}

include __DIR__ . '/../includes/header.php';
?>

<div class="container py-5">
    <div class="page-hero">
        <img src="https://images.unsplash.com/photo-1516321497487-e288fb19713f?auto=format&fit=crop&w=1200&q=80" alt="Featured news story at the university">
        <div class="page-hero-body">
            <h2><i class="fas fa-newspaper"></i> News Story</h2>
            <p>Read the latest story, updates, and highlights from campus life and academic progress.</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="content-card">
                <?php if ($item): ?>
                    <h2><?php echo htmlspecialchars($item['title']); ?></h2>
                    <p class="text-muted"><i class="fas fa-calendar-alt"></i> <?php echo formatDate($item['created_at']); ?></p>
                    <p><?php echo nl2br(htmlspecialchars($item['content'])); ?></p>
                    <a href="news.php" class="btn btn-primary">Back to News</a>
                <?php else: ?>
                    <div class="alert alert-warning">The requested news item could not be found.</div>
                    <a href="news.php" class="btn btn-primary">Back to News</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
