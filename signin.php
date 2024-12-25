<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
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

        .signin-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .signin-container::before {
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

        .form-control {
            border: 2px solid var(--secondary-color);
            border-radius: 10px;
            padding: 12px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(105, 0, 196, 0.25);
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

        .signin-options {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .signin-option {
            background: var(--secondary-color);
            color: var(--primary-color);
            border: none;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .signin-option.active {
            background: var(--primary-color);
            color: white;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .invalid-feedback {
            color: #ff4757;
        }

        .text-danger {
            color: #ff4757 !important;
        }

        @media (max-width: 768px) {
            .signin-container {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="signin-container">
                    <h2 class="text-center mb-4" style="color: var(--primary-color);">Welcome Back</h2>
                    <?php
                    if (!empty($error)) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                    ?>
                    <form action="request.php" method="post" class="needs-validation" novalidate>
                        <div class="signin-options mb-4">
                            <button type="button" class="signin-option active" id="signin_username_btn">
                                <i class="fas fa-user me-2"></i>Username
                            </button>
                            <button type="button" class="signin-option" id="signin_email_btn">
                                <i class="fas fa-envelope me-2"></i>Email
                            </button>
                        </div>

                        <div class="mb-3" id="username_field">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" id="username" name="username" minlength="3" maxlength="50" pattern="^[a-zA-Z0-9_]+$">
                            </div>
                            <div class="invalid-feedback">Please enter a valid username (3-50 characters, only letters, numbers, or underscores).</div>
                        </div>

                        <div class="mb-3 d-none" id="email_field">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="invalid-feedback">Please enter a valid email address.</div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="invalid-feedback">Please enter your password.</div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
                            <label class="form-check-label" for="remember_me">Remember me</label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" name="signin" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt me-2"></i>Sign In
                            </button>
                        </div>

                        <div class="text-danger mt-3">
                            <?php if ($_SESSION['invalid-password'] ?? '') : ?>
                                <span><i class="fas fa-exclamation-circle me-2"></i>Invalid password...</span>
                            <?php elseif ($_SESSION['invalid-credentials'] ?? ''): ?>
                                <span><i class="fas fa-exclamation-circle me-2"></i>Invalid credentials...</span>
                            <?php endif; ?>
                        </div>
                        <?php
                            unset($_SESSION['invalid-password']);
                            unset($_SESSION['invalid-credentials']);
                        ?>

                        <div class="text-center mt-3">
                            <a href="#" class="text-decoration-none" style="color: var(--primary-color);">Forgot Password?</a>
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

            const usernameField = document.getElementById('username_field');
            const emailField = document.getElementById('email_field');
            const usernameBtn = document.getElementById('signin_username_btn');
            const emailBtn = document.getElementById('signin_email_btn');

            usernameBtn.addEventListener('click', function() {
                usernameField.classList.remove('d-none');
                emailField.classList.add('d-none');
                usernameBtn.classList.add('active');
                emailBtn.classList.remove('active');
            });

            emailBtn.addEventListener('click', function() {
                emailField.classList.remove('d-none');
                usernameField.classList.add('d-none');
                emailBtn.classList.add('active');
                usernameBtn.classList.remove('active');
            });

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
    </script>
    <?php include 'includes/footer.php'; ?>
</body>

</html>

