<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (isset($_SESSION["user"]) ?? $_SESSION["user"]) {
    $user_logged_in = true;
} else {
    $user_logged_in = false;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('resource/hero.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 100px 0;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        :root {
    --primary-color: rgb(105, 0, 196);
    --secondary-color: rgb(238, 220, 255);
    --dark-color: rgb(20, 2, 37);
}
body {
    font-family: 'Poppins', sans-serif;
    color: var(--dark-color);
    background-color: var(--secondary-color);
}
.navbar {
    background: linear-gradient(135deg, var(--primary-color), var(--dark-color));
}
.navbar-brand, .nav-link {
    color: var(--secondary-color) !important;
}
.hero-section {
    background: linear-gradient(135deg, var(--primary-color), var(--dark-color));
    color: var(--secondary-color);
    padding: 100px 0;
}
.category-card {
    transition: transform 0.3s;
    background: linear-gradient(135deg, var(--secondary-color), white);
}
.category-card:hover {
    transform: translateY(-10px);
}
.how-it-works {
    background: linear-gradient(135deg, var(--secondary-color), white);
}
.testimonial-card {
    background: linear-gradient(135deg, var(--secondary-color), white);
    border: none;
    border-radius: 15px;
    overflow: hidden;
}
.cta-section {
    background: linear-gradient(135deg, var(--primary-color), var(--dark-color));
    color: var(--secondary-color);
}
.footer {
    background: var(--dark-color);
    color: var(--secondary-color);
}
.btn-custom {
    background-color: var(--primary-color);
    color: var(--secondary-color);
    border: none;
}
.btn-custom:hover {
    background-color: var(--dark-color);
    color: var(--secondary-color);
}
    </style>
    <title>GetWork</title>
</head>

<body>
    <!-- Header -->

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="./">getWork</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="./">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Browse Work</a>
                    </li>
                    <?php if ($user_logged_in): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">My Tasks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">Profile</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <?php if ($user_logged_in): ?>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="path/to/profile-picture.jpg" alt="Profile" class="rounded-circle" width="30" height="30">
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="signin.php" class="btn btn-outline-light me-2">Login</a>
                    <a href="signup.php" class="btn btn-custom">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>