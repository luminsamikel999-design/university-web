<?php
// admissions/payment.php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../config/database.php';

$page_title = 'Payment - Kampala University';

if (!isLoggedIn()) {
    redirect('../auth/login.php');
}

$application_id = $_GET['application_id'] ?? 0;
$application = getApplication($application_id);

if (!$application || $application['user_id'] != $_SESSION['user_id']) {
    $_SESSION['message'] = 'Application not found';
    $_SESSION['message_type'] = 'danger';
    redirect('application_list.php');
}

$fee = getApplicationFee($application['program_type']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = getDB();
    $transaction_id = 'TXN' . time() . rand(1000, 9999);
    
    $stmt = $db->prepare("INSERT INTO payments (application_id, amount, transaction_id, payment_method, is_verified) 
                          VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$application_id, $fee, $transaction_id, 'Online', 1])) {
        // Update application status
        $stmt = $db->prepare("UPDATE applications SET status = 'reviewing' WHERE id = ?");
        $stmt->execute([$application_id]);
        
        $_SESSION['message'] = 'Payment of ' . number_format($fee, 2) . ' UGX processed successfully!';
        $_SESSION['message_type'] = 'success';
        redirect('application_detail.php?id=' . $application_id);
    } else {
        $_SESSION['message'] = 'Payment failed. Please try again.';
        $_SESSION['message_type'] = 'danger';
    }
}

include __DIR__ . '/../includes/header.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4><i class="fas fa-credit-card"></i> Payment</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h5>Application: <?php echo $application['application_number']; ?></h5>
                        <p><strong>Program:</strong> <?php echo ucfirst($application['program_type']); ?></p>
                        <p><strong>Amount:</strong> <?php echo number_format($fee, 2); ?> UGX</p>
                    </div>
                    
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <select class="form-select" name="payment_method" required>
                                <option value="mobile_money">Mobile Money</option>
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="credit_card">Credit/Debit Card</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number (for Mobile Money)</label>
                            <input type="text" class="form-control" name="phone" placeholder="+256XXXXXXXXX">
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-check"></i> Pay Now
                        </button>
                    </form>
                    
                    <p class="mt-3 text-center">
                        <a href="application_detail.php?id=<?php echo $application_id; ?>">Cancel and go back</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>