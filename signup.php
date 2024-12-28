<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Arial', sans-serif;
        }

        .registration-form {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: bold;
        }

        .profile-preview {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-top: 10px;
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
                <div class="registration-form">
                    <h2 class="text-center mb-4">Sign Up</h2>
                    <?php
                    if (!empty($error)) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                    ?>
                    <form action="request.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="mb-3 col-md-full col">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required minlength="3" maxlength="50" pattern="^[a-zA-Z0-9_]+$">
                                <div class="invalid-feedback">Username must be 3-50 characters long and contain only letters, numbers, or underscores.</div>
                            </div>
                            <div class="mb-3 col-md-full col">
                                <label for="useremail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="useremail" name="useremail" required>
                                <div class="invalid-feedback">Please enter a valid email address.</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-full col">
                                <label for="phoneno" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phoneno" name="phoneno" required pattern="[0-9]{10}">
                                <div class="invalid-feedback">Please enter a 10-digit phone number.</div>
                            </div>
                            <div class="mb-3 col-md-full col">
                                <label for="profile_picture" class="form-label">Profile Picture</label>
                                <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*" onchange="previewImage(event)" required>
                                <img id="preview" class="profile-preview d-none" alt="Profile Preview">
                                <div class="invalid-feedback">Please upload a profile picture (Max: 2MB, Format: JPG, PNG).</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="profession" class="form-label">Profession</label>
                            <select class="form-select" id="profession" name="profession" required>
                                <option value="" selected disabled>Choose...</option>
                                <option value="working_professional">Working Professional</option>
                                <option value="student">Student</option>
                            </select>
                            <div class="invalid-feedback">Please select your profession.</div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-full col">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                                <div class="invalid-feedback">Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one number.</div>
                            </div>
                            <div class="mb-3 col-md-full col">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                <div class="invalid-feedback">Passwords do not match.</div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-2">
                            <h5>Social Links (Optional)</h5>
                            <div class="mb-3 col-md-full col">
                                <label for="github" class="form-label">GitHub Profile</label>
                                <input type="url" class="form-control" id="github" name="github">
                            </div>
                            <div class="mb-3 col-md-full col">
                                <label for="linkedin" class="form-label">LinkedIn Profile</label>
                                <input type="url" class="form-control" id="linkedin" name="linkedin">
                            </div>
                            <div class="mb-3 col-md-full col">
                                <label for="instagram" class="form-label">Instagram Profile</label>
                                <input type="url" class="form-control" id="instagram" name="instagram">
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="signup" class="btn btn-primary">Register</button>
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

            // Fetch all the forms to apply custom Bootstrap validation styles
            var forms = document.querySelectorAll('.needs-validation');

            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }

                        // Check if passwords match
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

            // Add event listener for password confirmation
            document.getElementById('confirm_password').addEventListener('input', function() {
                if (this.value !== document.getElementById('password').value) {
                    this.setCustomValidity("Passwords do not match");
                } else {
                    this.setCustomValidity("");
                }
            });
        })();

        // Preview profile picture
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
                    preview.classList.remove('d-none');
                };

                reader.readAsDataURL(file);
            }
        }
    </script>
    <?php include 'includes/footer.php'; ?>
</body>

</html>
