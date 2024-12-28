<?php 
include('includes/header.php');
include('includes/loadcards.php');
?>

<div class="container py-5">
    <h1 class="text-center mb-5">Available Work Opportunities</h1>
    <div class="row g-4">
        <?php foreach ($results as $work) : ?>
            <div class="col-12">
                <div class="card shadow-sm hover-card border-0 rounded-3 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-3 bg-light d-flex flex-column justify-content-center align-items-center p-3">
                            <img src="<?php echo htmlspecialchars($work['profile_picture']); ?>" 
                                 alt="<?php echo htmlspecialchars($work['username']); ?>'s profile" 
                                 class="rounded-circle mb-3" 
                                 width="80" 
                                 height="80">
                            <h5 class="mb-1 fw-bold text-center">@<?php echo htmlspecialchars($work['username']); ?></h5>
                            <small class="text-muted text-center"><?php echo htmlspecialchars($work['email']); ?></small>
                        </div>
                        <div class="col-md-9">
                            <div class="card-body d-flex flex-column h-100">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title fw-bold text-primary mb-0"><?php echo htmlspecialchars($work['title']); ?></h5>
                                    <span class="badge bg-<?php echo getStatusColor($work['status']); ?> rounded-pill px-3 py-2">
                                        <?php echo htmlspecialchars($work['status']); ?>
                                    </span>
                                </div>
                                <p class="card-text flex-grow-1"><?php echo nl2br(htmlspecialchars($work['description'])); ?></p>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="text-muted">
                                            <i class="bi bi-calendar-event me-2"></i>
                                            Deadline: <?php echo date('M d, Y', strtotime($work['deadline'])); ?>
                                        </span>
                                        <span class="fw-bold text-success">
                                            <i class="bi bi-cash-stack me-2"></i>
                                            ₹<?php echo number_format($work['budget']); ?>
                                        </span>
                                    </div>
                                    <a href="work_details.php?id=<?php echo $work['id']; ?>" class="btn btn-primary w-100">
                                        <i class="bi bi-eye me-2"></i>View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include('includes/footer.php') ?>

<style>
    .hover-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    .card-title {
        color: #2d3748;
        line-height: 1.4;
    }

    .btn-primary {
        background-color: #4F46E5;
        border-color: #4F46E5;
    }

    .btn-primary:hover {
        background-color: #4338CA;
        border-color: #4338CA;
    }

    .text-primary {
        color: #4F46E5 !important;
    }

    .badge {
        font-weight: 500;
        font-size: 0.85rem;
    }

    @media (max-width: 767.98px) {
        .card-body {
            padding-top: 1rem;
        }
    }
</style>

<?php
function getStatusColor($status) {
    switch (strtolower($status)) {
        case 'open':
            return 'success';
        case 'in progress':
            return 'warning';
        case 'completed':
            return 'info';
        case 'closed':
            return 'secondary';
        default:
            return 'primary';
    }
}
?>