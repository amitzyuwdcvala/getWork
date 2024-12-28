

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Arial', sans-serif;
        }

        .signin-form {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="signin-form">
                    <h2 class="text-center mb-4">Sign In</h2>
                    <?php
                    if (!empty($error)) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                    ?>
                    <form action="request.php" method="post" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label class="form-label">Sign In With:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="signin_option" id="signin_username" value="username" checked>
                                <label class="form-check-label" for="signin_username">Username</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="signin_option" id="signin_email" value="email">
                                <label class="form-check-label" for="signin_email">Email</label>
                            </div>
                        </div>

                        <div class="mb-3" id="username_field">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" minlength="3" maxlength="50" pattern="^[a-zA-Z0-9_]+$">
                            <div class="invalid-feedback">Please enter a valid username (3-50 characters, only letters, numbers, or underscores).</div>
                        </div>

                        <div class="mb-3 d-none" id="email_field">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                            <div class="invalid-feedback">Please enter a valid email address.</div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <div class="invalid-feedback">Please enter your password.</div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" name="signin" class="btn btn-primary">Sign In</button>
                        </div>
                        <div class="text-danger">
                            <?php if ($_SESSION['invalid-password'] ?? '') : ?>
                                <span>Invalid password...</span>
                            <?php elseif ($_SESSION['invalid-credentials'] ?? ''): ?>
                                <span>Invalid credentials...</span>
                            <?php endif; ?>
                        </div>
                        <?php
                                unset($_SESSION['invalid-password']);
    unset($_SESSION['invalid-credentials']);
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function() {
            'use strict';

            // Toggle visibility between username and email fields
            const usernameField = document.getElementById('username_field');
            const emailField = document.getElementById('email_field');

            document.getElementById('signin_username').addEventListener('change', function() {
                usernameField.classList.remove('d-none');
                emailField.classList.add('d-none');
            });

            document.getElementById('signin_email').addEventListener('change', function() {
                emailField.classList.remove('d-none');
                usernameField.classList.add('d-none');
            });

            // Bootstrap form validation
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