<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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

        .signup-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            padding: 40px;
            margin-top: 50px;
            margin-bottom: 50px;
            position: relative;
            overflow: hidden;
        }

        .signup-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, var(--primary-color) 0%, transparent 70%);
            opacity: 0.1;
            z-index: -1;
            animation: pulse 15s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
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
            .signup-container {
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
                <div class="signup-container">
                    <h2 class="text-center mb-4" style="color: var(--primary-color);">Create Your Account</h2>
                    <?php
                    if (!empty($error)) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                    ?>
                    <form action="request.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <div class="profile-preview-container mb-4">
                            <img id="preview" class="profile-preview" src="path/to/default-avatar.jpg" alt="Profile Preview">
                            <div class="profile-preview-overlay">
                                <i class="fas fa-camera"></i>
                            </div>
                            <input type="file" class="form-control d-none" id="profile_picture" name="profile_picture" accept="image/*" onchange="previewImage(event)" required>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="username" name="username" required minlength="3" maxlength="50" pattern="^[a-zA-Z0-9_]+$">
                                </div>
                                <div class="invalid-feedback">Username must be 3-50 characters long and contain only letters, numbers, or underscores.</div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="useremail" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="useremail" name="useremail" required>
                                </div>
                                <div class="invalid-feedback">Please enter a valid email address.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="phoneno" class="form-label">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="tel" class="form-control" id="phoneno" name="phoneno" required pattern="[0-9]{10}">
                                </div>
                                <div class="invalid-feedback">Please enter a 10-digit phone number.</div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="profession" class="form-label">Profession</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                    <select class="form-select" id="profession" name="profession" required>
                                        <option value="" selected disabled>Choose...</option>
                                        <option value="working_professional">Working Professional</option>
                                        <option value="student">Student</option>
                                    </select>
                                </div>
                                <div class="invalid-feedback">Please select your profession.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" required minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                                </div>
                                <div class="invalid-feedback">Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one number.</div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                </div>
                                <div class="invalid-feedback">Passwords do not match.</div>
                            </div>
                        </div>

                        <hr>
                        <h5 class="mt-4 mb-3" style="color: var(--primary-color);">Social Links (Optional)</h5>
                        <div class="row">
                            <div class="mb-3 col-md-4 social-input">
                                <label for="github" class="form-label">GitHub Profile</label>
                                <i class="fab fa-github"></i>
                                <input type="url" class="form-control" id="github" name="github">
                            </div>
                            <div class="mb-3 col-md-4 social-input">
                                <label for="linkedin" class="form-label">LinkedIn Profile</label>
                                <i class="fab fa-linkedin"></i>
                                <input type="url" class="form-control" id="linkedin" name="linkedin">
                            </div>
                            <div class="mb-3 col-md-4 social-input">
                                <label for="instagram" class="form-label">Instagram Profile</label>
                                <i class="fab fa-instagram"></i>
                                <input type="url" class="form-control" id="instagram" name="instagram">
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" name="signup" class="btn btn-primary">
                                <i class="fas fa-user-plus me-2"></i>Create Account
                            </button>
                        </div>
                    </form>
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

                        var password = document.getElementById('password');
                        var confirmPassword = document.getElementById('confirm_password');
                        if (password.value !== confirmPassword.value) {
                            confirmPassword.setCustomValidity("Passwords do not match");
                        } else {
                            confirmPassword.setCustomValidity("");
                        }

                        form.classList.add('was-validated');
                    }, false);
                });

            document.getElementById('confirm_password').addEventListener('input', function() {
                if (this.value !== document.getElementById('password').value) {
                    this.setCustomValidity("Passwords do not match");
                } else {
                    this.setCustomValidity("");
                }
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

