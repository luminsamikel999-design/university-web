<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../config/database.php';

$page_title = 'Profile - Kampala University';

if (!isLoggedIn()) {
    redirect('login.php');
}

$db = getDB();
$stmt = $db->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

include __DIR__ . '/../includes/header.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3><i class="fas fa-user-circle"></i> My Profile</h3>
                </div>
                <div class="card-body">
                    <?php if ($user): ?>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <h5>Personal Details</h5>
                                <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['full_name']); ?></p>
                                <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                            </div>
                            <div class="col-md-6">
                                <h5>Account Status</h5>
                                <p><strong>Role:</strong> <?php echo ucfirst($user['role'] ?? 'student'); ?></p>
                                <p><strong>Member Since:</strong> <?php echo formatDate($user['created_at'] ?? date('Y-m-d')); ?></p>
                                <a href="logout.php" class="btn btn-outline-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning">Profile information is unavailable right now.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
