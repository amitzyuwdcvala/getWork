<?php
// require_once 'config.php';
// require_once 'work.php';

// $latest_works = getAllWork(5); // Assuming you've modified this function to accept a limit
// $work_categories = getWorkCategories(); // You'll need to implement this function
$user_logged_in = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>getWork - Find and Post Work</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
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
</head>
<body>

    <!-- Header -->
    <?php include_once('includes/header.php');
    ?>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 mb-4">Find Work. Get Paid. Grow Your Skills.</h1>
            <form class="mb-4">
                <div class="input-group">
                    <input type="text" class="form-control form-control-lg" placeholder="Search for work...">
                    <button class="btn btn-custom btn-lg" type="submit">Search</button>
                </div>
            </form>
            <div>
                <a href="#" class="btn btn-custom btn-lg me-2">Find Work</a>
                <a href="#" class="btn btn-outline-light btn-lg">Post Work</a>
            </div>
        </div>
    </section>

    <!-- Featured Work Categories -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Featured Work Categories</h2>
            <div class="row">
                <?php foreach ($work_categories as $category): ?>
                <div class="col-md-4 mb-4">
                    <div class="card category-card text-center h-100">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <i class="fas fa-<?php echo $category['icon']; ?> fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title"><?php echo htmlspecialchars($category['name']); ?></h5>
                            <p class="card-text"><?php echo $category['job_count']; ?> jobs available</p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works py-5">
        <div class="container">
            <h2 class="text-center mb-5">How It Works</h2>
            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    <div class="bg-white p-4 rounded-3 shadow-sm h-100">
                        <i class="fas fa-user-plus fa-3x mb-3 text-primary"></i>
                        <h4>Create an Account</h4>
                        <p>Sign up and complete your profile to get started.</p>
                    </div>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="bg-white p-4 rounded-3 shadow-sm h-100">
                        <i class="fas fa-search fa-3x mb-3 text-primary"></i>
                        <h4>Find or Post Work</h4>
                        <p>Browse available jobs or post your own work.</p>
                    </div>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="bg-white p-4 rounded-3 shadow-sm h-100">
                        <i class="fas fa-check-circle fa-3x mb-3 text-primary"></i>
                        <h4>Complete Tasks</h4>
                        <p>Finish tasks and get paid for your work.</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="#" class="btn btn-custom btn-lg">Get Started</a>
            </div>
        </div>
    </section>

    <!-- Latest Work Listings -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Latest Work Listings</h2>
            <div class="row">
                <?php foreach ($latest_works as $work): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($work['title']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars(substr($work['description'], 0, 100)) . '...'; ?></p>
                            <p class="card-text"><small class="text-muted">Type: <?php echo htmlspecialchars($work['work_type']); ?></small></p>
                            <p class="card-text"><small class="text-muted">By: <?php echo htmlspecialchars($work['uploader_name']); ?></small></p>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <a href="work_details.php?id=<?php echo $work['id']; ?>" class="btn btn-outline-primary">View Details</a>
                            <?php if ($user_logged_in && $_SESSION['user_type'] == 'end_user'): ?>
                            <form action="add_to_task.php" method="post" class="d-inline">
                                <input type="hidden" name="work_id" value="<?php echo $work['id']; ?>">
                                <button type="submit" class="btn btn-custom">Add to Task</button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-4">
                <a href="browse_work.php" class="btn btn-custom btn-lg">View All Work</a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">What Our Users Say</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <div class="card-body text-center">
                            <img src="path/to/user1.jpg" alt="User 1" class="rounded-circle mb-3" width="80" height="80">
                            <h5 class="card-title">John Doe</h5>
                            <p class="card-text">"getWork has been a game-changer for my freelance career. I've found amazing opportunities here!"</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <div class="card-body text-center">
                            <img src="path/to/user2.jpg" alt="User 2" class="rounded-circle mb-3" width="80" height="80">
                            <h5 class="card-title">Jane Smith</h5>
                            <p class="card-text">"As a business owner, I've found reliable freelancers for my projects through getWork. Highly recommended!"</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <div class="card-body text-center">
                            <img src="path/to/user3.jpg" alt="User 3" class="rounded-circle mb-3" width="80" height="80">
                            <h5 class="card-title">Mike Johnson</h5>
                            <p class="card-text">"The variety of work available on getWork is impressive. I've been able to diversify my skills and income."</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call-to-Action -->
    <section class="cta-section py-5">
        <div class="container text-center">
            <h2 class="mb-4">Ready to Get Started?</h2>
            <p class="lead mb-4">Join our community of freelancers and businesses today!</p>
            <a href="#" class="btn btn-light btn-lg me-2">Find Work</a>
            <a href="#" class="btn btn-outline-light btn-lg">Post Work</a>
        </div>
    </section>

    <!-- Footer -->
     <?php include_once('includes/footer.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>