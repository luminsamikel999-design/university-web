<?php
$base_url = '/mike/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Kampala University'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php echo $base_url; ?>index.php">
                <i class="fas fa-university"></i> Kampala University
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?php echo $base_url; ?>index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $base_url; ?>pages/faculties.php">Faculties</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $base_url; ?>pages/news.php">News</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $base_url; ?>pages/about.php">About</a></li>

                    <?php if (isLoggedIn()): ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $base_url; ?>admissions/application_list.php">
                            <i class="fas fa-file-alt"></i> My Applications
                        </a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $base_url; ?>admissions/apply.php">
                            <i class="fas fa-pencil-alt"></i> Apply Now
                        </a></li>
                        <?php if (isAdmin()): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-cog"></i> Admin
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>admin/dashboard.php">Dashboard</a></li>
                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>admin/applications.php">Applications</a></li>
                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>admin/news_manage.php">Manage News</a></li>
                                    <li><a class="dropdown-item" href="<?php echo $base_url; ?>admin/events_manage.php">Manage Events</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $base_url; ?>auth/profile.php">
                            <i class="fas fa-user"></i> <?php echo $_SESSION['full_name'] ?? 'Profile'; ?>
                        </a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $base_url; ?>auth/logout.php">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $base_url; ?>auth/login.php">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $base_url; ?>auth/register.php">Register</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="container mt-3">
                <div class="alert alert-<?php echo $_SESSION['message_type'] ?? 'info'; ?> alert-dismissible fade show">
                    <?php
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                        unset($_SESSION['message_type']);
                    ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        <?php endif; ?>