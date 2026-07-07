<?php
// admissions/apply.php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../config/database.php';

$page_title = 'Apply - Kampala University';

if (!isLoggedIn()) {
    $_SESSION['message'] = 'Please login to apply';
    $_SESSION['message_type'] = 'warning';
    redirect('../auth/login.php');
}

$user_id = $_SESSION['user_id'];
$db = getDB();

// Check if user already has a pending application
$stmt = $db->prepare("SELECT id FROM applications WHERE user_id = ? AND status IN ('pending', 'reviewing')");
$stmt->execute([$user_id]);
if ($stmt->rowCount() > 0) {
    $_SESSION['message'] = 'You already have a pending application';
    $_SESSION['message_type'] = 'warning';
    redirect('application_list.php');
}

$courses = getAllDepartments();
$program_types = getProgramTypes();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'user_id' => $user_id,
        'application_number' => generateApplicationNumber(),
        'program_type' => sanitize($_POST['program_type']),
        'department_id' => sanitize($_POST['course_id']),
        'first_name' => sanitize($_POST['first_name']),
        'last_name' => sanitize($_POST['last_name']),
        'date_of_birth' => sanitize($_POST['date_of_birth']),
        'nationality' => sanitize($_POST['nationality']),
        'gender' => sanitize($_POST['gender']),
        'phone' => sanitize($_POST['phone']),
        'email' => sanitize($_POST['email']),
        'address' => sanitize($_POST['address']),
        'previous_institution' => sanitize($_POST['previous_institution']),
        'previous_degree' => sanitize($_POST['previous_degree']),
        'graduation_year' => sanitize($_POST['graduation_year']),
        'gpa' => sanitize($_POST['gpa']),
        'statement_of_purpose' => sanitize($_POST['statement_of_purpose']),
        'work_experience' => sanitize($_POST['work_experience']),
        'status' => 'pending'
    ];
    
    // Handle file uploads
    $upload_dir = '../uploads/applications/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $files = ['transcript', 'certificate', 'passport_photo', 'recommendation_letter'];
    foreach ($files as $file) {
        if (isset($_FILES[$file]) && $_FILES[$file]['error'] === UPLOAD_ERR_OK) {
            $uploaded = uploadFile($_FILES[$file], $upload_dir);
            if ($uploaded) {
                $data[$file] = $uploaded;
            }
        }
    }
    
    // Insert application
    $columns = implode(', ', array_keys($data));
    $placeholders = ':' . implode(', :', array_keys($data));
    
    $stmt = $db->prepare("INSERT INTO applications ($columns) VALUES ($placeholders)");
    foreach ($data as $key => $value) {
        $stmt->bindValue(':' . $key, $value);
    }
    
    if ($stmt->execute()) {
        $_SESSION['message'] = 'Application submitted successfully! Your application number is ' . $data['application_number'];
        $_SESSION['message_type'] = 'success';
        redirect('application_list.php');
    } else {
        $_SESSION['message'] = 'Application submission failed. Please try again.';
        $_SESSION['message_type'] = 'danger';
    }
}

include __DIR__ . '/../includes/header.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3><i class="fas fa-pencil-alt"></i> Application Form</h3>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <h5>Program Information</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="program_type" class="form-label">Program Type</label>
                                <select class="form-select" id="program_type" name="program_type" required>
                                    <option value="">Select Program</option>
                                    <?php foreach ($program_types as $key => $value): ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="course_id" class="form-label">Course</label>
                                <select class="form-select" id="course_id" name="course_id" required>
                                    <option value="">Select Course</option>
                                    <?php foreach ($courses as $course): ?>
                                        <option value="<?php echo $course['id']; ?>"><?php echo $course['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <h5 class="mt-4">Personal Information</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                            </div>
                            <div class="col-md-4">
                                <label for="nationality" class="form-label">Nationality</label>
                                <input type="text" class="form-control" id="nationality" name="nationality" required>
                            </div>
                            <div class="col-md-4">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="">Select</option>
                                    <?php foreach (getGenderOptions() as $key => $value): ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <h5 class="mt-4">Contact Information</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email'] ?? ''; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="2" required></textarea>
                        </div>
                        
                        <h5 class="mt-4">Academic Information</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="previous_institution" class="form-label">Previous Institution</label>
                                <input type="text" class="form-control" id="previous_institution" name="previous_institution" required>
                            </div>
                            <div class="col-md-6">
                                <label for="previous_degree" class="form-label">Previous Degree</label>
                                <input type="text" class="form-control" id="previous_degree" name="previous_degree" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="graduation_year" class="form-label">Graduation Year</label>
                                <input type="number" class="form-control" id="graduation_year" name="graduation_year" required>
                            </div>
                            <div class="col-md-6">
                                <label for="gpa" class="form-label">GPA (if applicable)</label>
                                <input type="number" step="0.01" class="form-control" id="gpa" name="gpa">
                            </div>
                        </div>
                        
                        <h5 class="mt-4">Documents</h5>
                        <div class="mb-3">
                            <label for="transcript" class="form-label">Transcript (PDF, DOC, DOCX)</label>
                            <input type="file" class="form-control" id="transcript" name="transcript" required>
                        </div>
                        <div class="mb-3">
                            <label for="certificate" class="form-label">Certificate (PDF, DOC, DOCX)</label>
                            <input type="file" class="form-control" id="certificate" name="certificate" required>
                        </div>
                        <div class="mb-3">
                            <label for="passport_photo" class="form-label">Passport Photo (JPG, JPEG, PNG)</label>
                            <input type="file" class="form-control" id="passport_photo" name="passport_photo" required>
                        </div>
                        <div class="mb-3">
                            <label for="recommendation_letter" class="form-label">Recommendation Letter (optional)</label>
                            <input type="file" class="form-control" id="recommendation_letter" name="recommendation_letter">
                        </div>
                        
                        <h5 class="mt-4">Additional Information</h5>
                        <div class="mb-3">
                            <label for="statement_of_purpose" class="form-label">Statement of Purpose</label>
                            <textarea class="form-control" id="statement_of_purpose" name="statement_of_purpose" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="work_experience" class="form-label">Work Experience (if any)</label>
                            <textarea class="form-control" id="work_experience" name="work_experience" rows="3"></textarea>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane"></i> Submit Application
                            </button>
                            <a href="../index.php" class="btn btn-secondary btn-lg">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>