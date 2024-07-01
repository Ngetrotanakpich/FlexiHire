<?php 
include('server.php');
if (isset($_SESSION["Username"])) {
    $username = $_SESSION["Username"];
    if ($_SESSION["Usertype"] == 1) {
        header("location: freelancerProfile.php");
    } else {
        header("location: employerProfile.php");
    }
} else {
    $username = "";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlexiHire Freelance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .hero-section {
            background: linear-gradient(rgba(0, 123, 255, 0.7), rgba(0, 123, 255, 0.7)), url('image/computer.jpg') no-repeat center center/cover;
            color: white;
            padding: 100px 0;
        }

        .hero-section h1 {
            font-size: 3.5rem;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 10px;
        }

        .header2 {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border-radius: 10px 10px 0 0;
        }

        .carousel-inner img {
            width: 100%;
            height: 100%;
        }

        .footer {
            background-color: #222;
            color: white;
            padding: 20px 0;
        }

        .footer a {
            color: white;
        }

        .btn-custom {
            background-color: #007BFF;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #0056b3;
            color: white;
        }

        .faq-header {
            background-color: #007BFF;
            color: white;
            padding: 15px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">FlexiHire</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#how">How it works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#faq">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="loginReg.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-info btn-custom" href="loginReg.php">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Hero Section -->
    <div class="hero-section text-center d-flex align-items-center">
        <div class="container">
            <h1>FlexiHire - Get Work Done with Freedom and Flexibility</h1>
            <p>Remember, time is money. Use it properly. Do not waste your time thinking when others are getting things done here.</p>
            <a href="loginReg.php" class="btn btn-warning btn-lg">It's Free! Join Now!</a>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Main Content -->
    <div class="container my-5">
        <!-- Register Tips -->
        <div class="row">
            <div class="col-md-6">
                <div class="card text-center p-4">
                    <h2>Need work done?</h2>
                    <p>Post a job and receive competitive bids from freelancers within minutes. Whatever your needs, there will be a freelancer to get it done.</p>
                    <a href="loginReg.php" class="btn btn-success btn-lg">Get Started</a>
                </div>
            </div>
            <div class="col-md-6 mt-4 mt-md-0">
                <div class="card text-center p-4">
                    <h2>Looking for work?</h2>
                    <p>Join our platform and start working on projects. It's easy, secure, and a great way to showcase your skills.</p>
                    <a href="loginReg.php" class="btn btn-primary btn-lg">Get Started</a>
                </div>
            </div>
        </div>
        <!-- End Register Tips -->

        <!-- Popular Categories -->
        <div class="my-5 text-center">
            <h2 class="header2">Popular Categories</h2>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card p-4">
                        <a href="loginReg.php">
                            <i class="fas fa-laptop-code fa-3x"></i>
                            <h3>Web Developer</h3>
                            <p>Login to browse our web developers</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 mt-4 mt-md-0">
                    <div class="card p-4">
                        <a href="loginReg.php">
                            <i class="fas fa-mobile-alt fa-3x"></i>
                            <h3>Mobile Developer</h3>
                            <p>Login to browse our mobile developers</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 mt-4 mt-md-0">
                    <div class="card p-4">
                        <a href="loginReg.php">
                            <i class="fas fa-palette fa-3x"></i>
                            <h3>Graphic Designer</h3>
                            <p>Login to browse our graphic designers</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Popular Categories -->

        <!-- How It Works -->
        <div class="my-5">
            <h2 class="header2 text-center" id="how">How It Works</h2>
            <div class="row mt-4">
                <div class="col-md-6 mb-4">
                    <img src="image/howitwork.jpeg" class="img-fluid" alt="How it works">
                </div>
                <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h5>1. Post a job</h5>
                            <p>Post a job you need completed and receive competitive bids from freelancers within minutes.</p>
                        </li>
                        <li class="list-group-item">
                            <h5>2. Choose freelancers</h5>
                            <p>Whatever your needs, there will be a freelancer to get it done: from web design, mobile app development, virtual assistants, product manufacturing, and graphic design (and a whole lot more).</p>
                        </li>
                        <li class="list-group-item">
                            <h5>3. Pay safely</h5>
                            <p>With secure payments and thousands of reviewed professionals to choose from, FlexiHire is the simplest and safest way to get work done online.</p>
                        </li>
                        <li class="list-group-item">
                            <h5>4. We’re here to help</h5>
                            <p>Our talented team of recruiters can help you find the best freelancer for the job and our technical co-pilots can even manage the project for you.</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End How It Works -->

        <!-- FAQ -->
        <div id="faq" class="my-5">
            <h2 class="header2 text-center">Frequently Asked Questions</h2>
            <div class="accordion" id="accordionFAQ">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            How do I get started?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionFAQ">
                        <div class="accordion-body">
                            Getting started is easy. Just click on the Register button and follow the instructions to create your account.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            How do I pay freelancers?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFAQ">
                        <div class="accordion-body">
                            We offer several payment options including PayPal, credit card, and direct bank transfer.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Is my payment safe?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionFAQ">
                        <div class="accordion-body">
                            Absolutely. We use secure payment methods to ensure your funds are protected.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End FAQ -->

    </div>

    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <p>&copy; 2024 FlexiHire. All Rights Reserved.</p>
            <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- Bootstrap and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
