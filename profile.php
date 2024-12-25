<?php
session_start();

include("database/db.php");
$db = new Database();
$conn = $db->getConnection();

$row = null;

if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    $user = $_SESSION['user']['email'];

    $query = "SELECT * FROM users WHERE email='$user'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Error fetching data from the database.";
    }
} else {
    echo "No user is logged in.";
    header("Location: signin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: rgb(105, 0, 196);
            --secondary-color: rgb(238, 220, 255);
            --dark-color: rgb(20, 2, 37);
        }

        body {
            background: linear-gradient(135deg, var(--secondary-color), #ffffff);
            font-family: 'Poppins', sans-serif;
            color: var(--dark-color);
            min-height: 100vh;
        }

        .profile-container {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            padding: 50px;
            margin-top: 50px;
            position: relative;
            overflow: hidden;
        }

        .profile-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, var(--primary-color) 0%, transparent 70%);
            opacity: 0.05;
            z-index: -1;
            animation: pulse 15s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .profile-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .profile-picture {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            border: 8px solid var(--secondary-color);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .profile-picture:hover {
            transform: scale(1.05);
        }

        .username {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .profession-badge {
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 30px;
            display: inline-block;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }

        .working_professional {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
        }

        .student {
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            color: white;
        }

        .info-card {
            background: linear-gradient(135deg, #ffffff, var(--secondary-color));
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .info-card h5 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 1.2rem;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .social-icons a {
            font-size: 24px;
            color: var(--primary-color);
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .social-icons a:hover {
            color: var(--dark-color);
            transform: scale(1.2);
        }

        .btn-edit {
            background: linear-gradient(135deg, var(--primary-color), var(--dark-color));
            color: white;
            border: none;
            padding: 12px 35px;
            border-radius: 30px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-edit:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .contact-info p {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .contact-info i {
            margin-right: 10px;
            color: var(--primary-color);
            font-size: 1.2rem;
        }

        @media (max-width: 768px) {
            .profile-container {
                padding: 30px;
            }

            .username {
                font-size: 2rem;
            }

            .profile-picture {
                width: 150px;
                height: 150px;
            }
        }
    </style>
</head>

<body>

    <?php include('./includes/header.php'); ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <?php if ($row): ?>
                    <div class="profile-container">
                        <div class="profile-header">
                            <img src="<?= $row['profile_picture'] ?: 'default-profile.png'; ?>"
                                alt="Profile Picture" class="profile-picture">
                            <h1 class="username"><?= htmlspecialchars($row['username']); ?></h1>
                            <span class="profession-badge <?= $row['profession'] === 'working_professional' ? 'working_professional' : 'student'; ?>">
                                <?= ucwords(str_replace('_', ' ', htmlspecialchars($row['profession']))); ?>
                            </span>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-card">
                                    <h5><i class="bi bi-person-lines-fill me-2"></i>Contact Details</h5>
                                    <div class="contact-info">
                                        <p><i class="bi bi-envelope"></i><?= htmlspecialchars($row['email']); ?></p>
                                        <p><i class="bi bi-telephone"></i><?= htmlspecialchars($row['phone_number']); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-card">
                                    <h5><i class="bi bi-globe me-2"></i>Social Profiles</h5>
                                    <div class="social-icons">
                                        <a href="<?= htmlspecialchars($row['github_profile'] ?? '#'); ?>" target="_blank" title="GitHub"><i class="bi bi-github"></i></a>
                                        <a href="<?= htmlspecialchars($row['linkedin_profile'] ?? '#'); ?>" target="_blank" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                                        <a href="<?= htmlspecialchars($row['instagram_profile'] ?? '#'); ?>" target="_blank" title="Instagram"><i class="bi bi-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="info-card mt-4">
                            <h5><i class="bi bi-person-badge me-2"></i>About Me</h5>
                            <p><?= htmlspecialchars($row['about'] ?? 'No details provided.'); ?></p>
                        </div>

                        <div class="text-center mt-4">
                            <form method="POST" action="edit_profile.php?id=<?= $row['id'] ?>">
                                <button class="btn btn-edit text-white">Edit Profile</button>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning text-center mt-5">
                        User details not found.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include('./includes/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

