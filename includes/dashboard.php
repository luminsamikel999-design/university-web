<?php
// admin/dashboard.php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../config/database.php';

if (!isLoggedIn() || !isAdmin()) {
    redirect('../index.php');
}

$page_title = 'Admin Dashboard - Kampala University';
$db = getDB();

// Get statistics
$stats = [
    'applications' => $db->query("SELECT COUNT(*) FROM applications")->fetchColumn(),
    'pending_applications' => $db->query("SELECT COUNT(*) FROM applications WHERE status = 'pending'")->fetchColumn(),
    'accepted_applications' => $db->query("SELECT COUNT(*) FROM applications WHERE status = 'accepted'")->fetchColumn(),
    'rejected_applications' => $db->query("SELECT COUNT(*) FROM applications WHERE status = 'rejected'")->fetchColumn(),
    'news_count' => $db->query("SELECT COUNT(*) FROM news")->fetchColumn(),
    'events_count' => $db->query("SELECT COUNT(*) FROM events")->fetchColumn(),
    'users_count' => $db->query("SELECT COUNT(*) FROM users")->fetchColumn(),
    'departments_count' => $db->query("SELECT COUNT(*) FROM departments")->fetchColumn(),
];

include __DIR__ . '/../includes/header.php';
?>

<div class="container py-5">
    <h2><i class="fas fa-chart-bar"></i> Admin Dashboard</h2>
    
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Applications</h5>
                    <h2><?php echo $stats['applications']; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5>Pending</h5>
                    <h2><?php echo $stats['pending_applications']; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Accepted</h5>
                    <h2><?php echo $stats['accepted_applications']; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5>Rejected</h5>
                    <h2><?php echo $stats['rejected_applications']; ?></h2>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5><i class="fas fa-users"></i> Users</h5>
                    <h3><?php echo $stats['users_count']; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5><i class="fas fa-newspaper"></i> News</h5>
                    <h3><?php echo $stats['news_count']; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5><i class="fas fa-calendar-alt"></i> Events</h5>
                    <h3><?php echo $stats['events_count']; ?></h3>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-12">
            <h4>Recent Applications</h4>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Application #</th>
                            <th>Applicant</th>
                            <th>Program</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $db->query("SELECT a.*, u.full_name as applicant_name 
                                           FROM applications a 
                                           LEFT JOIN users u ON a.user_id = u.id 
                                           ORDER BY a.submitted_date DESC LIMIT 5");
                        while ($app = $stmt->fetch()):
                        ?>
                        <tr>
                            <td><?php echo $app['application_number']; ?></td>
                            <td><?php echo $app['applicant_name'] ?? 'N/A'; ?></td>
                            <td><?php echo ucfirst($app['program_type']); ?></td>
                            <td>
                                <span class="badge bg-<?php echo getStatusBadge($app['status']); ?>">
                                    <?php echo ucfirst($app['status']); ?>
                                </span>
                            </td>
                            <td><?php echo formatDate($app['submitted_date']); ?></td>
                            <td>
                                <a href="../admissions/application_detail.php?id=<?php echo $app['id']; ?>" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>