<?php
// admissions/application_list.php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../config/database.php';

$page_title = 'My Applications - Kampala University';

if (!isLoggedIn()) {
    redirect('../auth/login.php');
}

$applications = getApplicationByUser($_SESSION['user_id']);
$db = getDB();

include __DIR__ . '/../includes/header.php';
?>

<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-file-alt"></i> My Applications</h2>
                <a href="apply.php" class="btn btn-primary">
                    <i class="fas fa-plus"></i> New Application
                </a>
            </div>
            
            <?php if (empty($applications)): ?>
                <div class="alert alert-info">
                    <p>You haven't submitted any applications yet.</p>
                    <a href="apply.php" class="btn btn-primary">Apply Now</a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Application #</th>
                                <th>Program</th>
                                <th>Course</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($applications as $app): ?>
                                <tr>
                                    <td><strong><?php echo $app['application_number']; ?></strong></td>
                                    <td><?php echo ucfirst($app['program_type']); ?></td>
                                    <td><?php echo $app['department_id'] ? getDepartment($app['department_id'])['name'] : 'N/A'; ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo getStatusBadge($app['status']); ?>">
                                            <?php echo ucfirst($app['status']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo formatDate($app['submitted_date']); ?></td>
                                    <td>
                                        <a href="application_detail.php?id=<?php echo $app['id']; ?>" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <?php if ($app['status'] === 'pending'): ?>
                                            <a href="payment.php?application_id=<?php echo $app['id']; ?>" class="btn btn-sm btn-success">
                                                <i class="fas fa-credit-card"></i> Pay Fee
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>