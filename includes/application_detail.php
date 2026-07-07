<?php
// admissions/application_detail.php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../config/database.php';

$page_title = 'Application Details - Kampala University';

if (!isLoggedIn()) {
    redirect('../auth/login.php');
}

$id = $_GET['id'] ?? 0;
$application = getApplication($id);

if (!$application || $application['user_id'] != $_SESSION['user_id']) {
    $_SESSION['message'] = 'Application not found';
    $_SESSION['message_type'] = 'danger';
    redirect('application_list.php');
}

$department = getDepartment($application['department_id']);
$fee = getApplicationFee($application['program_type']);

include __DIR__ . '/../includes/header.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4>Application Details</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Application Number:</strong>
                            <span class="badge bg-info"><?php echo $application['application_number']; ?></span>
                        </div>
                        <div class="col-md-6">
                            <strong>Status:</strong>
                            <span class="badge bg-<?php echo getStatusBadge($application['status']); ?>">
                                <?php echo ucfirst($application['status']); ?>
                            </span>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Personal Information</h6>
                            <p><strong>Name:</strong> <?php echo $application['first_name'] . ' ' . $application['last_name']; ?></p>
                            <p><strong>Date of Birth:</strong> <?php echo formatDate($application['date_of_birth']); ?></p>
                            <p><strong>Gender:</strong> <?php echo getGenderOptions()[$application['gender']] ?? $application['gender']; ?></p>
                            <p><strong>Nationality:</strong> <?php echo $application['nationality']; ?></p>
                        </div>
                        <div class="col-md-6">
                            <h6>Contact Information</h6>
                            <p><strong>Email:</strong> <?php echo $application['email']; ?></p>
                            <p><strong>Phone:</strong> <?php echo $application['phone']; ?></p>
                            <p><strong>Address:</strong> <?php echo $application['address']; ?></p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Program Information</h6>
                            <p><strong>Program Type:</strong> <?php echo ucfirst($application['program_type']); ?></p>
                            <p><strong>Course:</strong> <?php echo $department ? $department['name'] : 'N/A'; ?></p>
                            <p><strong>Previous Institution:</strong> <?php echo $application['previous_institution']; ?></p>
                            <p><strong>Previous Degree:</strong> <?php echo $application['previous_degree']; ?></p>
                            <p><strong>Graduation Year:</strong> <?php echo $application['graduation_year']; ?></p>
                            <?php if ($application['gpa']): ?>
                                <p><strong>GPA:</strong> <?php echo $application['gpa']; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Statement of Purpose</h6>
                            <p><?php echo nl2br($application['statement_of_purpose']); ?></p>
                        </div>
                    </div>
                    
                    <?php if ($application['work_experience']): ?>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h6>Work Experience</h6>
                                <p><?php echo nl2br($application['work_experience']); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <h6>Documents</h6>
                            <div class="list-group">
                                <?php if ($application['transcript']): ?>
                                    <a href="../uploads/applications/<?php echo $application['transcript']; ?>" class="list-group-item list-group-item-action" target="_blank">
                                        <i class="fas fa-file-pdf"></i> Transcript
                                    </a>
                                <?php endif; ?>
                                <?php if ($application['certificate']): ?>
                                    <a href="../uploads/applications/<?php echo $application['certificate']; ?>" class="list-group-item list-group-item-action" target="_blank">
                                        <i class="fas fa-file-pdf"></i> Certificate
                                    </a>
                                <?php endif; ?>
                                <?php if ($application['passport_photo']): ?>
                                    <a href="../uploads/applications/<?php echo $application['passport_photo']; ?>" class="list-group-item list-group-item-action" target="_blank">
                                        <i class="fas fa-image"></i> Passport Photo
                                    </a>
                                <?php endif; ?>
                                <?php if ($application['recommendation_letter']): ?>
                                    <a href="../uploads/applications/<?php echo $application['recommendation_letter']; ?>" class="list-group-item list-group-item-action" target="_blank">
                                        <i class="fas fa-file-pdf"></i> Recommendation Letter
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="application_list.php" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Applications
                        </a>
                        <?php if ($application['status'] === 'pending'): ?>
                            <a href="payment.php?application_id=<?php echo $application['id']; ?>" class="btn btn-success">
                                <i class="fas fa-credit-card"></i> Pay Application Fee (<?php echo number_format($fee, 2); ?> UGX)
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>