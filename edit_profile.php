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
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

        .edit-profile-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            padding: 40px;
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary-color);
        }

        .form-control, .form-select {
            border: 2px solid var(--secondary-color);
            border-radius: 10px;
            padding: 12px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(105, 0, 196, 0.25);
        }

        .profile-preview-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto 20px;
        }

        .profile-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid var(--primary-color);
            transition: all 0.3s ease;
        }

        .profile-preview-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(105, 0, 196, 0.7);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .profile-preview-container:hover .profile-preview-overlay {
            opacity: 1;
        }

        .profile-preview-overlay i {
            color: white;
            font-size: 24px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), #8e44ad);
            border: none;
            border-radius: 10px;
            padding: 12px 24px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(105, 0, 196, 0.4);
        }

        .social-input {
            position: relative;
        }

        .social-input i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: var(--primary-color);
        }

        .social-input input {
            padding-left: 40px;
        }

        @media (max-width: 768px) {
            .edit-profile-container {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="edit-profile-container">
                    <h2 class="text-center mb-4" style="color: var(--primary-color);">Edit Your Profile</h2>
                    <?php
                    if (!empty($error)) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                    ?>
                    <?php if ($row): ?>
                        <form action="request.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            
                            <div class="profile-preview-container mb-4">
                                <img id="preview" class="profile-preview" src="<?= !empty($row['profile_picture']) ? htmlspecialchars($row['profile_picture']) : 'path/to/default-avatar.jpg' ?>" alt="Profile Preview">
                                <div class="profile-preview-overlay">
                                    <i class="fas fa-camera"></i>
                                </div>
                                <input type="file" class="form-control d-none" id="profile_picture" name="profile_picture" accept="image/*" onchange="previewImage(event)">
                            </div>
                            
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" value="<?= $row['username'] ?>" class="form-control" id="username" name="username" required minlength="3" maxlength="50" pattern="^[a-zA-Z0-9_]+$">
                                    <div class="invalid-feedback">Username must be 3-50 characters long and contain only letters, numbers, or underscores.</div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="useremail" class="form-label">Email</label>
                                    <input type="email" value="<?= $row['email'] ?>" class="form-control" id="useremail" name="useremail" required>
                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="phoneno" class="form-label">Phone Number</label>
                                    <input type="tel" value="<?= $row['phone_number'] ?>" class="form-control" id="phoneno" name="phoneno" required pattern="[0-9]{10}">
                                    <div class="invalid-feedback">Please enter a 10-digit phone number.</div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="profession" class="form-label">Profession</label>
                                    <select class="form-select" id="profession" name="profession" required>
                                        <option value="" disabled <?= empty($row['profession']) ? 'selected' : '' ?>>Choose...</option>
                                        <option value="working_professional" <?= $row['profession'] === 'working_professional' ? 'selected' : '' ?>>Working Professional</option>
                                        <option value="student" <?= $row['profession'] === 'student' ? 'selected' : '' ?>>Student</option>
                                    </select>
                                    <div class="invalid-feedback">Please select your profession.</div>
                                </div>
                            </div>
                            
                            <hr>
                            <h5 class="mb-3" style="color: var(--primary-color);">Social Links (Optional)</h5>
                            
                            <div class="mb-3 social-input">
                                <label for="github" class="form-label">GitHub Profile</label>
                                <i class="fab fa-github"></i>
                                <input type="text" value="<?= $row['github_profile'] ?? '' ?>" class="form-control" id="github" name="github">
                            </div>
                            
                            <div class="mb-3 social-input">
                                <label for="linkedin" class="form-label">LinkedIn Profile</label>
                                <i class="fab fa-linkedin"></i>
                                <input type="url" value="<?= $row['linkedin_profile'] ?? '' ?>" class="form-control" id="linkedin" name="linkedin">
                            </div>
                            
                            <div class="mb-3 social-input">
                                <label for="instagram" class="form-label">Instagram Profile</label>
                                <i class="fab fa-instagram"></i>
                                <input type="url" value="<?= $row['instagram_profile'] ?? '' ?>" class="form-control" id="instagram" name="instagram">
                            </div>
                            
                            <div class="d-grid mt-4">
                                <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
                            </div>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-warning">No user data found.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function() {
            'use strict';

            var forms = document.querySelectorAll('.needs-validation');

            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
        })();

        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                const file = input.files[0];

                if (file.size > 2 * 1024 * 1024) {
                    alert('File size must be less than 2MB');
                    input.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }

        document.querySelector('.profile-preview-container').addEventListener('click', function() {
            document.getElementById('profile_picture').click();
        });
    </script>

    <?php include 'includes/footer.php'; ?>
</body>

</html>

