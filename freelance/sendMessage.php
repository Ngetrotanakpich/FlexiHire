<?php include('server.php');
if(isset($_SESSION["Username"])){
    $username=$_SESSION["Username"];
    if ($_SESSION["Usertype"]==1) {
        $linkPro="freelancerProfile.php";
        $linkEditPro="editFreelancer.php";
        $linkBtn="applyJob.php";
        $textBtn="Apply for this job";
    }
    else{
        $linkPro="employerProfile.php";
        $linkEditPro="editEmployer.php";
        $linkBtn="editJob.php";
        $textBtn="Edit the job offer";
    }
}
else{
    $username="";
    //header("location: index.php");
}

if(isset($_SESSION["msgRcv"])){
    $msgRcv=$_SESSION["msgRcv"];
}

if(isset($_POST["send"])){
    $msgTo=$_POST["msgTo"];
    $msgBody=$_POST["msgBody"];
    $sql = "INSERT INTO message (sender, receiver, msg) VALUES ('$username', '$msgTo', '$msgBody')";
    $result = $conn->query($sql);
    if($result==true){
        header("location: message.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Message</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { padding-top: 3%; margin: 0; }
        .card { box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19); background: #fff; }
    </style>
</head>
<body>

<!--Navbar menu-->
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
                        <i class="fas fa-user"></i> <?php echo $username; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo $linkPro; ?>"><i class="fas fa-home"></i> View profile</a></li>
                        <li><a class="dropdown-item" href="<?php echo $linkEditPro; ?>"><i class="fas fa-edit"></i> Edit Profile</a></li>
                        <li><a class="dropdown-item" href="message.php"><i class="fas fa-envelope"></i> Messages</a></li>
                        <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--End Navbar menu-->

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="page-header mb-4">
                <h2>Write Message</h2>
            </div>

            <form id="messageForm" method="post" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="msgTo" class="form-label">To</label>
                    <input type="text" class="form-control" id="msgTo" name="msgTo" value="<?php echo $msgRcv; ?>" required>
                    <div class="invalid-feedback">
                        This is required and cannot be empty.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="msgBody" class="form-label">Message Body</label>
                    <textarea class="form-control" id="msgBody" rows="12" name="msgBody" required></textarea>
                    <div class="invalid-feedback">
                        This is required and cannot be empty.
                    </div>
                </div>

                <div class="mb-3 text-end">
                    <button type="submit" name="send" class="btn btn-info btn-lg">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Footer-->
<footer class="bg-dark text-white text-center py-4 mt-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="index.php" class="text-white">Home</a></li>
                    <li><a href="allJob.php" class="text-white">Browse all jobs</a></li>
                    <li><a href="allFreelancer.php" class="text-white">Browse Freelancers</a></li>
                    <li><a href="allEmployer.php" class="text-white">Browse Employers</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h5>About Us</h5>
                <p>LyHeng Long</p>
                <p>Sovisal Lim</p>
                <p>RatanakPich Nget</p>
                <p>&copy 2024</p>
            </div>
            <div class="col-lg-3">
                <h5>Contact Us</h5>
                <p>Email: llong@paragoniu.edu.kh</p>
                <p>FlexiHire Freelance</p>
                <p>&copy CUET 2024</p>
            </div>
            <div class="col-lg-3">
                <h5>Social Contact</h5>
                <p><i class="fab fa-facebook-square text-primary" style="font-size:20px;"></i> Facebook</p>
                <p><i class="fab fa-google-plus-square text-danger" style="font-size:20px;"></i> Google</p>
                <p><i class="fab fa-twitter-square text-info" style="font-size:20px;"></i> Twitter</p>
                <p><i class="fab fa-linkedin text-primary" style="font-size:20px;"></i> LinkedIn</p>
            </div>
        </div>
    </div>
</footer>
<!--End Footer-->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict'
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>

</body>
</html>
