<?php 
include('server.php');
if(isset($_SESSION["Username"])){
    $username=$_SESSION["Username"];
} else {
    $username="";
    //header("location: index.php");
}

if(isset($_SESSION["c_letter"])){
    $c_letter=$_SESSION["c_letter"];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cover Letter</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { margin: 0; padding-top: 3%; display: flex; flex-direction: column; min-height: 100vh; }
        .container { flex: 1; }
        footer { background: #222; color: #fff; padding: 20px 0; }
        .card { box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); background: #fff; }
        .navbar-nav .nav-link { color: #fff; }
        .navbar-nav .nav-link:hover { color: #ddd; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Freelance Marketplace</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="allJob.php">Browse all jobs</a></li>
                <li class="nav-item"><a class="nav-link" href="allFreelancer.php">Browse Freelancers</a></li>
                <li class="nav-item"><a class="nav-link" href="allEmployer.php">Browse Employers</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fas fa-user"></span> <?php echo htmlspecialchars($username); ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="employerProfile.php"><span class="fas fa-home"></span> View profile</a></li>
                        <li><a class="dropdown-item" href="editEmployer.php"><span class="fas fa-edit"></span> Edit Profile</a></li>
                        <li><a class="dropdown-item" href="message.php"><span class="fas fa-envelope"></span> Messages</a></li>
                        <li><a class="dropdown-item" href="logout.php"><span class="fas fa-sign-out-alt"></span> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container my-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Cover Letter</h2>
                    <p class="card-text"><?php echo nl2br(htmlspecialchars($c_letter)); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="text-center text-white bg-dark py-4 mt-5">
    <div class="row">
        <div class="col-lg-3">
            <h3>Quick Links</h3>
            <p><a href="index.php" class="text-white">Home</a></p>
            <p><a href="allJob.php" class="text-white">Browse all jobs</a></p>
            <p><a href="allFreelancer.php" class="text-white">Browse Freelancers</a></p>
            <p><a href="allEmployer.php" class="text-white">Browse Employers</a></p>
        </div>
        <div class="col-lg-3">
            <h3>About Us</h3>
            <p>LyHeng Long</p>
            <p>Sovisal Lim</p>
            <p>RatanakPich Nget</p>
            <p>&copy; 2024</p>
        </div>
        <div class="col-lg-3">
            <h3>Contact Us</h3>
            <p>llong@paragoniu.edu.kh</p>
            <p>FlexiHire Freelance</p>
            <p>&copy; CUET 2024</p>
        </div>
        <div class="col-lg-3">
            <h3>Social Contact</h3>
            <p><a href="#" class="text-white"><i class="fab fa-facebook-square"></i> Facebook</a></p>
            <p><a href="#" class="text-white"><i class="fab fa-google-plus-square"></i> Google</a></p>
            <p><a href="#" class="text-white"><i class="fab fa-twitter-square"></i> Twitter</a></p>
            <p><a href="#" class="text-white"><i class="fab fa-linkedin"></i> LinkedIn</a></p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>
