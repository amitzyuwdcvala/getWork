<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GetWork</title>
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
<footer class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>About getWork</h5>
                    <p>getWork is a platform connecting freelancers with businesses and individuals who need work done.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Home</a></li>
                        <li><a href="#" class="text-white">Browse Work</a></li>
                        <li><a href="#" class="text-white">Post Work</a></li>
                        <li><a href="#" class="text-white">About Us</a></li>
                        <li><a href="#" class="text-white">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Newsletter</h5>
                    <p>Stay updated with the latest opportunities.</p>
                    <form>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Enter your email" aria-label="Enter your email" aria-describedby="button-addon2">
                            <button class="btn btn-custom" type="button" id="button-addon2">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="bg-light">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p>&copy; 2023 getWork. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="text-white"><i class="fab fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="text-white"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>