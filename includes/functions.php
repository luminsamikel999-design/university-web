<?php
// includes/functions.php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function redirect($url) {
    header("Location: $url");
    exit();
}

function sanitize($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

function generateApplicationNumber() {
    return 'KU' . rand(10000, 99999) . date('Y');
}

function uploadFile($file, $target_dir, $allowed_types = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png']) {
    if ($file['error'] === UPLOAD_ERR_OK) {
        $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($file_ext, $allowed_types)) {
            return false;
        }
        $filename = time() . '_' . uniqid() . '.' . $file_ext;
        $target_path = $target_dir . $filename;
        if (move_uploaded_file($file['tmp_name'], $target_path)) {
            return $filename;
        }
    }
    return false;
}

function getStatusBadge($status) {
    $badges = [
        'pending' => 'warning',
        'reviewing' => 'info',
        'accepted' => 'success',
        'rejected' => 'danger',
        'waitlisted' => 'secondary'
    ];
    return $badges[$status] ?? 'secondary';
}

function getProgramTypes() {
    return [
        'undergraduate' => 'Undergraduate',
        'graduate' => 'Graduate',
        'diploma' => 'Diploma',
        'certificate' => 'Certificate'
    ];
}

function getGenderOptions() {
    return [
        'M' => 'Male',
        'F' => 'Female',
        'O' => 'Other'
    ];
}

function formatDate($date) {
    return date('M d, Y', strtotime($date));
}

function formatDateTime($date) {
    return date('M d, Y H:i', strtotime($date));
}

function getApplicationFee($program_type) {
    $db = getDB();
    $stmt = $db->prepare("SELECT amount FROM application_fees WHERE program_type = ?");
    $stmt->execute([$program_type]);
    $result = $stmt->fetch();
    return $result ? $result['amount'] : 0;
}

function getDepartment($id) {
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM departments WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function getFaculty($id) {
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM faculties WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function getNews($id) {
    $db = getDB();
    $stmt = $db->prepare("SELECT n.*, u.full_name as author_name FROM news n 
                           LEFT JOIN users u ON n.author_id = u.id 
                           WHERE n.id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function getEvent($id) {
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM events WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function getApplication($id) {
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM applications WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function getApplicationByUser($user_id) {
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM applications WHERE user_id = ? ORDER BY submitted_date DESC");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll();
}

function getApplicationsByStatus($status) {
    $db = getDB();
    $stmt = $db->prepare("SELECT a.*, u.full_name as applicant_name, d.name as department_name 
                          FROM applications a 
                          LEFT JOIN users u ON a.user_id = u.id 
                          LEFT JOIN departments d ON a.department_id = d.id 
                          WHERE a.status = ? 
                          ORDER BY a.submitted_date DESC");
    $stmt->execute([$status]);
    return $stmt->fetchAll();
}

function getAllApplications() {
    $db = getDB();
    $stmt = $db->query("SELECT a.*, u.full_name as applicant_name, d.name as department_name 
                        FROM applications a 
                        LEFT JOIN users u ON a.user_id = u.id 
                        LEFT JOIN departments d ON a.department_id = d.id 
                        ORDER BY a.submitted_date DESC");
    return $stmt->fetchAll();
}

function getAllNews() {
    $db = getDB();
    $stmt = $db->query("SELECT n.*, u.full_name as author_name 
                        FROM news n 
                        LEFT JOIN users u ON n.author_id = u.id 
                        WHERE n.is_published = 1 
                        ORDER BY n.created_at DESC");
    return $stmt->fetchAll();
}

function getAllEvents() {
    $db = getDB();
    $stmt = $db->query("SELECT * FROM events ORDER BY start_date ASC");
    return $stmt->fetchAll();
}

function getAllFaculties() {
    $db = getDB();
    $stmt = $db->query("SELECT * FROM faculties ORDER BY name");
    return $stmt->fetchAll();
}

function getAllDepartments() {
    $db = getDB();
    $stmt = $db->query("SELECT * FROM departments ORDER BY name");
    return $stmt->fetchAll();
}

function getFacultyDepartments($faculty_id) {
    $db = getDB();
    $stmt = $db->prepare("SELECT d.* FROM departments d 
                          INNER JOIN faculty_departments fd ON d.id = fd.department_id 
                          WHERE fd.faculty_id = ?");
    $stmt->execute([$faculty_id]);
    return $stmt->fetchAll();
}
?>