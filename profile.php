<?php
include('./includes/header.php');
include("database/db.php");
$db = new Database();
$conn = $db->getConnection();

$row = null;

if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    // Use prepared statement instead of direct variable interpolation for security
    $user = $_SESSION['user']['email'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Error fetching data from the database.";
    }
} else {
    $_SESSION['error'] = "Please login to access your profile.";
    header("Location: signin.php");
    exit;
}
?>



<body>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php if ($row): ?>
                    <div class="profile-card text-center">
                        <img src="<?= $row['profile_picture'] ?: 'default-profile.png'; ?>"
                            alt="Profile Picture" class="profile-picture">
                        <h2 class="mb-3"><?= htmlspecialchars($row['username']); ?></h2>
                        <span class="profession-badge <?= $row['profession'] === 'working_professional' ? 'working_professional' : 'student'; ?>">
                            <?= ucwords(str_replace('_', ' ', htmlspecialchars($row['profession']))); ?>
                        </span>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Contact Details</h5>
                                        <p class="card-text"><i class="bi bi-envelope me-2"></i><?= htmlspecialchars($row['email']); ?></p>
                                        <p class="card-text"><i class="bi bi-telephone me-2"></i><?= htmlspecialchars($row['phone_number']); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Social Profiles</h5>
                                        <div class="social-icons">
                                            <?php if($row['github_profile']) : ?>
                                                <a href="<?= htmlspecialchars($row['github_profile'] ?? '#'); ?>" target="_blank" title="GitHub"><i class="bi bi-github"></i></a>
                                            <?php endif; ?>
                                            <?php if($row['linkedin_profile']) :?>
                                                <a href="<?= htmlspecialchars($row['linkedin_profile'] ?? '#'); ?>" target="_blank" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                                            <?php endif; ?>
                                            <?php if($row['instagram_profile']) :?>
                                                <a href="<?= htmlspecialchars($row['instagram_profile'] ?? '#'); ?>" target="_blank" title="Instagram"><i class="bi bi-instagram"></i></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">About Me</h5>
                                <p class="card-text"><?= htmlspecialchars($row['about'] ?? 'No details provided.'); ?></p>
                            </div>
                        </div>

                        <form method="POST" action="edit_profile.php?id=<?= $row['id'] ?>">
                            <button class="btn btn-edit mt-4 text-white">Edit Profile</button>
                            <button class="btn btn-edit mt-4 text-white">Password reset</button>
                        </form>
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
