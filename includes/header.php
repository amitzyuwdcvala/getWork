<?php
session_start();

$user_logged_in = isset($_SESSION["user"]) && !empty($_SESSION["user"]);

$profile_img = $user_logged_in && isset($_SESSION["user"]["profile_image"])
    ? $_SESSION["user"]["profile_image"]
    : "default-profile.jpg";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GetWork</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4fvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
            background: linear-gradient(135deg, var(--secondary-color), #ffffff);
            font-family: 'Arial', sans-serif;
            color: var(--dark-color);
        }

        .profile-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 50px;
            position: relative;
            overflow: hidden;
        }

        .profile-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, var(--primary-color) 0%, transparent 70%);
            opacity: 0.1;
            z-index: -1;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 5px solid var(--secondary-color);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .card {
            border: none;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #ffffff, var(--secondary-color));
            border-radius: 15px;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .social-icons a {
            font-size: 24px;
            color: var(--primary-color);
            margin-right: 20px;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: var(--dark-color);
        }

        .btn-edit {
            background: linear-gradient(135deg, var(--primary-color), var(--dark-color));
            color: white;
            border: none;
            padding: 10px 30px;
            border-radius: 30px;
            font-weight: bold;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-edit:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .profession-badge {
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 30px;
            display: inline-block;
            margin-bottom: 15px;
        }

        .working_professional {
            background: linear-gradient(135deg, #007bff, #00c6ff);
            color: white;
        }

        .student {
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            color: white;
        }

        h2,
        h5 {
            color: var(--primary-color);
        }

        .card-head{
            display: flex;
            align-items: center;
            gap: 15px;
            width: 100%;
        }

        .card-body{
            height: 190px;
            position: relative;
        }

        .work-btn{
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: linear-gradient(135deg, var(--primary-color), var(--dark-color));
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 30px;
            font-weight: bold;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .deadline{
            position: absolute;
            bottom: 13px;
            font-size: 12px;
            left: 10px;
            background: linear-gradient(135deg,rgba(255, 30, 30, 0.36),rgba(255, 77, 77, 0.43));
            border: 0.5px solid rgb(255, 71, 71);
            color: white;
            padding: 5px 15px;
            border-radius: 30px;
            font-weight: bold;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .status{
            font-weight: bold;
            background: linear-gradient(135deg,rgb(57, 255, 116),rgb(22, 129, 40));
            color: white;
            width: 90px;
            display: flex;
            justify-content: center;
            padding-bottom: 5px;
            padding: 0;
            height: 25px;
            align-items: center;
            border-radius: 30px;
        }

        .budget-tag{
            background: linear-gradient(135deg,rgb(255, 209, 113),rgb(255, 168, 11));
            color: white;
            padding: 4px 15px;
            border-radius: 8px;
            font-weight: 700;
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="./">getWork</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="browse_work.php">Browse Work</a>
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

                <?php if ($user_logged_in && isset($_SESSION["user"]["user_type"]) && $_SESSION["user"]["user_type"] === "working_professional"): ?>
                    <a href="post_work.php" class="btn btn-primary me-2"><i class="bi bi-pencil-square"></i> Post Work</a>
                <?php endif; ?>

                <?php if ($user_logged_in): ?>
                    <div class="d-flex align-items-center">
                        <a href="profile.php" class="btn btn-sm btn-outline-primary"><img src="<?php echo htmlspecialchars($profile_img); ?>" alt="Profile" class=" rounded-circle me-2" width="30" height="30">Profile</a>
                        <a href="logout.php" class="btn btn-sm btn-outline-danger ms-2 p-2">Logout</a>
                        
                    </div>

                <?php else: ?>
                    <a href="signin.php" class="btn btn-outline-primary me-2">Login</a>
                    <a href="signup.php" class="btn btn-primary">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Bootstrap Bundle Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>