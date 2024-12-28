<?php include('includes/header.php') ?>
<div class="container mt-5">
    <h1 class="mb-4">Post a New Work</h1>

    <!-- Success/Error Message -->
    <?php if (!empty($success_message)): ?>
        <div class="alert alert-success"><?php echo $success_message; ?></div>
    <?php elseif (!empty($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form method="POST" action="request.php">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" id="category" name="category" required>
                <option value="" disabled selected>Select a category</option>
                <option value="IT">IT</option>
                <option value="Design">Design</option>
                <option value="Writing">Writing</option>
                <option value="Marketing">Marketing</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="budget" class="form-label">Budget (₹)</label>
            <input type="number" class="form-control" id="budget" name="budget" required>
        </div>
        <div class="mb-3">
            <label for="deadline" class="form-label">Deadline</label>
            <input type="date" class="form-control" id="deadline" name="deadline">
        </div>
        <button type="submit" name="upload-work" class="btn btn-primary">Post Work</button>
    </form>
</div>
<?php include('includes/footer.php') ?>