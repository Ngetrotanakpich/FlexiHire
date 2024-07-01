<?php include('server.php');
if (isset($_SESSION["Username"])) {
    $username = $_SESSION["Username"];
} else {
    $username = "";
    //header("location: index.php");
}

$sql = "SELECT * FROM employer WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row["Name"];
        $email = $row["email"];
        $contactNo = $row["contact_no"];
        $gender = $row["gender"];
        $birthdate = $row["birthdate"];
        $address = $row["address"];
        $profile_sum = $row["profile_sum"];
        $company = $row["company"];
    }
} else {
    echo "0 results";
}

if (isset($_POST["editEmployer"])) {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $contactNo = test_input($_POST["contactNo"]);
    $gender = test_input($_POST["gender"]);
    $birthdate = test_input($_POST["birthdate"]);
    $address = test_input($_POST["address"]);
    $profile_sum = test_input($_POST["profile_sum"]);
    $company = test_input($_POST["company"]);

    $sql = "UPDATE employer SET Name='$name',email='$email',contact_no='$contactNo', address='$address', gender='$gender', profile_sum='$profile_sum', birthdate='$birthdate', company='$company' WHERE username='$username'";

    $result = $conn->query($sql);
    if ($result == true) {
        header("location: employerProfile.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            padding-top: 5rem;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
            background: #fff;
            border: none;
            border-radius: 1rem;
        }

        .navbar-brand {
            font-weight: bold;
            color: #fff !important;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control,
        .form-select {
            border-radius: 0.5rem;
        }

        .btn-info {
            background-color: #17a2b8;
            border: none;
            border-radius: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: bold;
            color: #fff;
        }

        .btn-info:hover {
            background-color: #138496;
        }

        .card-header {
            background-color: #343a40;
            color: #fff;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }

        .footer-link {
            color: #fff;
            text-decoration: none;
        }

        .footer-link:hover {
            color: #17a2b8;
        }
    </style>
</head>

<body>

<!--Navbar-->
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
                        <i class="fas fa-user"></i> <?php echo htmlspecialchars($username); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="employerProfile.php"><i class="fas fa-home"></i> View Profile</a></li>
                        <li><a class="dropdown-item" href="editEmployer.php"><i class="fas fa-edit"></i> Edit Profile</a></li>
                        <li><a class="dropdown-item" href="message.php"><i class="fas fa-envelope"></i> Messages</a></li>
                        <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--End Navbar-->

<div class="container mt-5">
    <div class="justify-content-center">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Edit Profile</h2>
                </div>
                <div class="card-body">
                    <form id="registrationForm" method="post">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contact no.</label>
                            <input type="text" class="form-control" name="contactNo" value="<?php echo htmlspecialchars($contactNo); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="male" <?php if (isset($gender) && $gender == "male") echo "checked"; ?> required>
                                    <label class="form-check-label">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="female" <?php if (isset($gender) && $gender == "female") echo "checked"; ?> required>
                                    <label class="form-check-label">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="other" <?php if (isset($gender) && $gender == "other") echo "checked"; ?> required>
                                    <label class="form-check-label">Other</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Date of birth</label>
                            <input type="date" class="form-control" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" value="<?php echo htmlspecialchars($address); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Company Name</label>
                            <input type="text" class="form-control" name="company" value="<?php echo htmlspecialchars($company); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Profile Summary</label>
                            <textarea class="form-control" name="profile_sum" rows="3" required><?php echo htmlspecialchars($profile_sum); ?></textarea>
                        </div>

                        <div class="mb-3 text-center">
                            <button type="submit" name="editEmployer" class="btn btn-info">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
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
                    <li><a href="index.php" class="footer-link">Home</a></li>
                    <li><a href="allJob.php" class="footer-link">Browse all jobs</a></li>
                    <li><a href="allFreelancer.php" class="footer-link">Browse Freelancers</a></li>
                    <li><a href="allEmployer.php" class="footer-link">Browse Employers</a></li>
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
document.addEventListener('DOMContentLoaded', function () {
    const registrationForm = document.getElementById('registrationForm');
    registrationForm.addEventListener('submit', function (event) {
        const name = document.getElementsByName('name')[0].value.trim();
        const email = document.getElementsByName('email')[0].value.trim();
        const contactNo = document.getElementsByName('contactNo')[0].value.trim();
        const gender = document.querySelector('input[name="gender"]:checked');
        const birthdate = document.getElementsByName('birthdate')[0].value.trim();
        const address = document.getElementsByName('address')[0].value.trim();
        const company = document.getElementsByName('company')[0].value.trim();
        const profile_sum = document.getElementsByName('profile_sum')[0].value.trim();

        if (name === '' || email === '' || contactNo === '' || !gender || birthdate === '' || address === '' || company === '' || profile_sum === '') {
            event.preventDefault();
            alert('Please fill in all the fields.');
        }
    });
});
</script>

</body>

</html>