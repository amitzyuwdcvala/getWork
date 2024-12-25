<!-- request.php -->

<?php
include('./database/db.php');

session_start();

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {

    // Sanitize inputs
    $username = htmlspecialchars(trim($_POST['username']));
    $useremail = filter_var(trim($_POST['useremail']), FILTER_VALIDATE_EMAIL);
    $phoneno = htmlspecialchars(trim($_POST['phoneno']));
    $profession = htmlspecialchars(trim($_POST['profession']));
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    $github_link = filter_var(trim($_POST['github']), FILTER_SANITIZE_URL);
    $linked_link = filter_var(trim($_POST['linkedin']), FILTER_SANITIZE_URL);
    $instagram_link = filter_var(trim($_POST['instagram']), FILTER_SANITIZE_URL);

    $profile_img = null; // Default to null if no image is uploaded

    // Handle file upload
    if ($_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'assets/profileimg/';
        $temp_name = $_FILES['profile_picture']['tmp_name'];
        $image_name = uniqid() . '_' . basename($_FILES['profile_picture']['name']);
        $upload_path = $upload_dir . $image_name;

        if (move_uploaded_file($temp_name, $upload_path)) {
            $profile_img = $upload_path;
        } else {
            die('Error uploading the profile picture. Please try again.');
        }
    }

    // Validate required fields
    if (!$username || !$useremail || !$phoneno || !$profession || !$password) {
        die('Please fill in all required fields.');
    }

    // Insert data into database
    $sql = "INSERT INTO users (username, email, phone_number, profile_picture, profession, password, github_profile, linkedin_profile, instagram_profile) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssssssss", $username, $useremail, $phoneno, $profile_img, $profession, $password, $github_link, $linked_link, $instagram_link);

        if ($stmt->execute()) {
            $_SESSION['user'] = ["username" => $username, "email" => $useremail, "user_type" => $profession ?? null];
            echo "Registration successful!";
            header("Location: index.php");
        } else {
            die("Error: " . $stmt->error);
        }

        $stmt->close();
    } else {
        die("Error preparing statement: " . $conn->error);
    }

    $conn->close();
}
elseif (isset($_POST['signin'])) {

    $username = trim($_POST['username']) ?? null;
    $useremail = trim($_POST['email']) ?? null;
    $password = $_POST['password'] ?? null;

    // Validate input
    if (!$password || (!$username && !$useremail)) {
        $_SESSION['invalid-credentials'] = true;
        exit;
    }

    // Prepare SQL statement based on input
    if ($username) {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
    } elseif ($useremail) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $useremail);
    }

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION["user"] = [
                "username" => $user['username'],
                "email" => $user['email'],
                "user_type" => $user['profession'] ?? null
            ];
            header("Location: index.php");
            exit;
        } else {
            $_SESSION["invalid-password"] = true; 
            header("Location: signin.php");
            exit;
        }
    } else {
        $_SESSION["invalid-credentials"] = true;
        header("Location: signin.php");
        exit;
    }

    $conn->close();

}
elseif (isset($_POST['update_profile'])) {
    $id = intval($_POST['id']);
    $username = htmlspecialchars(trim($_POST['username']));
    $useremail = filter_var(trim($_POST['useremail']), FILTER_VALIDATE_EMAIL);
    $phoneno = htmlspecialchars(trim($_POST['phoneno']));
    $profession = htmlspecialchars(trim($_POST['profession']));
    $github_link = filter_var(trim($_POST['github']), FILTER_SANITIZE_URL);
    $linkedin_link = filter_var(trim($_POST['linkedin']), FILTER_SANITIZE_URL);
    $instagram_link = filter_var(trim($_POST['instagram']), FILTER_SANITIZE_URL);

    $profile_img = null;

    // Handle file upload
    if ($_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'assets/profileimg/';
        $temp_name = $_FILES['profile_picture']['tmp_name'];
        $image_name = uniqid() . '_' . basename($_FILES['profile_picture']['name']);
        $upload_path = $upload_dir . $image_name;

        if (move_uploaded_file($temp_name, $upload_path)) {
            $profile_img = $upload_path;
        } else {
            die('Error uploading the profile picture. Please try again.');
        }
    }

    // Database connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    try {
        if ($profile_img) {
            $sql = "UPDATE users SET username = ?, email = ?, phone_number = ?, profile_picture = ?, profession = ?, github_profile = ?, linkedin_profile = ?, instagram_profile = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }
            $stmt->bind_param(
                'ssssssssi',
                $username, $useremail, $phoneno, $profile_img,
                $profession, $github_link, $linkedin_link, $instagram_link, $id
            );
        } else {
            $sql = "UPDATE users SET username = ?, email = ?, phone_number = ?, profession = ?, github_profile = ?, linkedin_profile = ?, instagram_profile = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }
            $stmt->bind_param(
                'sssssssi',
                $username, $useremail, $phoneno, $profession,
                $github_link, $linkedin_link, $instagram_link, $id
            );
        }

        if ($stmt->execute()) {
            echo 'Profile updated successfully!';
            header("Location: profile.php");
        } else {
            echo 'Error: ' . $stmt->error;
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    $stmt->close();
    $conn->close();
}
?>
