<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lxis Company</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: #343a40;
            /* Dark background */
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #ffffff;
            /* White text */
            font-weight: bold;
        }

        .navbar-custom .nav-link:hover {
            color: #f8f9fa;
            /* Lighter text on hover */
            background-color: #495057;
            /* Darker background on hover */
            border-radius: 5px;
        }

        .navbar-brand img {
            height: 40px;
        }

        .btn-custom {
            background-color: #ffc107;
            /* Yellow button */
            color: #212529;
            /* Dark text */
            border-radius: 20px;
        }

        .btn-custom:hover {
            background-color: #e0a800;
            /* Darker yellow on hover */
        }

        .btn-login {
            background-color: #76d881;
            /* Yellow button */
            color: #212529;
            /* Dark text */
            border-radius: 20px;
        }

        .btn-login:hover {
            background-color: #86da62;
            /* Darker yellow on hover */
        }

        .hero-section {
            background-color: #007bff;
            height: 70vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 4rem;
        }

        .services-section {
            padding: 60px 0;
        }

        .services-section .card {
            transition: transform 0.3s;
            background-color: #f8f9fa;
        }

        .services-section .card:hover {
            transform: translateY(-10px);
        }

        .contact-section {
            padding: 60px 0;
            background-color: #f9f9f9;
        }

        .img-3d {
            width: 100%;
            height: auto;
            border-radius: 15px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <h1 class="text-white">Laxis</h1>

            <div class="ml-5 collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/customer">Customers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/products-ajax-crud">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/resourceStudents">RsourceStudents</a>
                    </li>
                    <li class="nav-item">
                    </li>
                </ul>
            </div>
            <a href="/login" class="btn btn-login ms-lg-3 float-left mr-3">Login</a>

            <a href="/register" class="btn btn-custom ms-lg-3 float-left mr-3">Sign Up</a>

            <div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-danger btn btn-custom ms-lg-3 float-left">Logout</button>
                </form>
            </div>

        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <h1>Welcome to Lxis</h1>
        <p>Innovating the future</p>
    </div>




    <section id="about" class="about-section text-center">
        <div class="container">
            <h2>About Us</h2>
            <p>Information about Lxis company, its mission, vision, and values.</p>
        </div>
    </section>

    <section id="contact" class="contact-section text-center">
        <div class="container">
            <h2>Contact Us</h2>
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" placeholder="Your Name">
                    </div>
                    <div class="form-group col-md-6">
                        <input type="email" class="form-control" placeholder="Your Email">
                    </div>
                </div>
                <div class="form-group">
                    <textarea class="form-control" rows="4" placeholder="Your Message"></textarea>
                </div>
                <button type="submit" class="btn btn-outline-primary">Send Message</button>
            </form>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
