<?php

$user_logged_in = isset($_SESSION['user_id']);
include('includes/loadcards.php');
?>

    
    <!-- Header -->
    <?php include_once('includes/header.php');
    ?>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 mb-4">Find Work. Get Paid. Grow Your Skills.</h1>
            <!-- <form class="mb-4">
                <div class="input-group">
                    <input type="text" class="form-control form-control-lg" placeholder="Search for work...">
                    <button class="btn btn-primary btn-lg" type="submit">Search</button>
                </div>
            </form> -->
            <div>
                <a href="#" class="btn btn-primary btn-lg me-2">Find Work</a>
                <a href="#" class="btn btn-outline-light btn-lg">Post Work</a>
            </div>
        </div>
    </section>

    <!-- Featured Work Categories -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Featured Work Categories</h2>
            <div class="row">
                <?php foreach ($work_categories as $category): ?>
                <div class="col-md-4 mb-4">
                    <div class="card category-card text-center">
                        <div class="card-body">
                            <i class="fas fa-<?php echo $category['icon']; ?> fa-3x mb-3"></i>
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
    <section class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4">How It Works</h2>
            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    <i class="fas fa-user-plus fa-3x mb-3"></i>
                    <h4>Create an Account</h4>
                    <p>Sign up and complete your profile to get started.</p>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <i class="fas fa-search fa-3x mb-3"></i>
                    <h4>Find or Post Work</h4>
                    <p>Browse available jobs or post your own work.</p>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <i class="fas fa-check-circle fa-3x mb-3"></i>
                    <h4>Complete Tasks</h4>
                    <p>Finish tasks and get paid for your work.</p>
                </div>
            </div>
            <div class="text-center">
                <a href="#" class="btn btn-primary btn-lg">Get Started</a>
            </div>
        </div>
    </section>

    <!-- Latest Work Listings -->
    <section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4 fw-bold">Latest Work Listings</h2>
        <div class="row g-4">
            <?php foreach ($results as $work): ?>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm hover-card border-0 rounded-3 overflow-hidden">
                    <!-- Card Header with User Info -->
                    <div class="card-header bg-white border-0 pt-3 pb-0">
                        <div class="d-flex align-items-center">
                            <img src="<?php echo htmlspecialchars($work['profile_picture'] ?? 'assets/images/default-avatar.png'); ?>" 
                                 class="rounded-circle me-2" 
                                 width="40" 
                                 height="40"
                                 alt="Profile">
                            <div>
                                <h6 class="mb-0 fw-semibold"><?php echo htmlspecialchars($work['username']); ?></h6>
                                <small class="text-muted"><?php echo htmlspecialchars($work['email']); ?></small>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="mb-2">
                            <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                                <?php echo htmlspecialchars($work['category']); ?>
                            </span>
                        </div>

                        <h5 class="card-title fw-bold mb-3">
                            <?php echo htmlspecialchars($work['title']); ?>
                        </h5>
                        <p class="card-text text-muted">
                            <?php echo htmlspecialchars(substr($work['description'], 0, 100)) . '...'; ?>
                        </p>

                        <div class="d-flex justify-content-between align-items-center mt-3 mb-2">
                            <div class="text-muted small">
                                <i class="bi bi-clock me-1"></i>
                                <?php echo date('M d, Y', strtotime($work['created_at'])); ?>
                            </div>
                            <?php if (isset($work['budget'])): ?>
                            <div class="text-primary fw-semibold">
                                <i class="bi bi-cash me-1"></i>
                                ₹<?php echo htmlspecialchars($work['budget']); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>


                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5">
            <a href="browse_work.php" class="btn btn-primary btn-lg px-5 rounded-pill">
                <i class="bi bi-grid me-2"></i>View All Work
            </a>
        </div>
    </div>
</section>
    <section class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4">What Our Users Say</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="path/to/user1.jpg" alt="User 1" class="rounded-circle mb-3" width="80" height="80">
                            <h5 class="card-title">John Doe</h5>
                            <p class="card-text">"getWork has been a game-changer for my freelance career. I've found amazing opportunities here!"</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="path/to/user2.jpg" alt="User 2" class="rounded-circle mb-3" width="80" height="80">
                            <h5 class="card-title">Jane Smith</h5>
                            <p class="card-text">"As a business owner, I've found reliable freelancers for my projects through getWork. Highly recommended!"</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
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
    <section class="bg-primary text-white py-5">
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
    