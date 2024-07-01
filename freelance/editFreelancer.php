<?php 
include('server.php');
if(isset($_SESSION["Username"])){
    $username=$_SESSION["Username"];
} else {
    $username="";
    //header("location: index.php");
}

$sql = "SELECT * FROM freelancer WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $name=$row["Name"];
        $email=$row["email"];
        $contactNo=$row["contact_no"];
        $gender=$row["gender"];
        $birthdate=$row["birthdate"];
        $address=$row["address"];
        $prof_title=$row["prof_title"];
        $skills=$row["skills"];
        $profile_sum=$row["profile_sum"];
        $education=$row["education"];
        $experience=$row["experience"];
    }
} else {
    echo "0 results";
}

if(isset($_POST["editFreelancer"])){
    $name=test_input($_POST["name"]);
    $email=test_input($_POST["email"]);
    $contactNo=test_input($_POST["contactNo"]);
    $gender=test_input($_POST["gender"]);
    $birthdate=test_input($_POST["birthdate"]);
    $address=test_input($_POST["address"]);
    $prof_title=test_input($_POST["prof_title"]);
    $skills=test_input($_POST["skills"]);
    $profile_sum=test_input($_POST["profile_sum"]);
    $education=test_input($_POST["education"]);
    $experience=test_input($_POST["experience"]);

    $sql = "UPDATE freelancer SET Name='$name',email='$email',contact_no='$contactNo', address='$address', gender='$gender',prof_title='$prof_title',profile_sum='$profile_sum',education='$education',experience='$experience', birthdate='$birthdate', skills='$skills' WHERE username='$username'";

    $result = $conn->query($sql);
    if($result==true){
        header("location: freelancerProfile.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Freelancer Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { padding-top: 3%; margin: 0; }
        .card { box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19); background: #fff; }
        .navbar { box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .form-section { margin-top: 100px; }
        .form-header { background-color: #007BFF; color: white; padding: 15px; border-radius: 10px 10px 0 0; }
        .form-control { border-radius: 10px; padding: 10px; }
        .btn-custom { border-radius: 50px; padding: 10px 20px; }
        footer { background: #222; color: #fff; padding: 20px 0; margin-top: auto; }
        footer a { color: #fff; }
        footer a:hover { text-decoration: underline; }
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
                        <i class="fas fa-user"></i> <?php echo htmlspecialchars($username); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="freelancerProfile.php"><i class="fas fa-home"></i> View profile</a></li>
                        <li><a class="dropdown-item" href="editFreelancer.php"><i class="fas fa-edit"></i> Edit Profile</a></li>
                        <li><a class="dropdown-item" href="message.php"><i class="fas fa-envelope"></i> Messages</a></li>
                        <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--End Navbar menu-->

<div class="container form-section">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="form-header text-center">
                    <h2>Edit Profile</h2>
                </div>
                <div class="card-body">
                    <form id="registrationForm" method="post" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                            <div class="invalid-feedback">The name is required and cannot be empty.</div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                            <div class="invalid-feedback">The email address is required and cannot be empty.</div>
                        </div>

                        <div class="mb-3">
                            <label for="contactNo" class="form-label">Contact no.</label>
                            <input type="text" class="form-control" id="contactNo" name="contactNo" value="<?php echo htmlspecialchars($contactNo); ?>" required>
                            <div class="invalid-feedback">The contact number is required.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="genderMale" name="gender" value="male" <?php if (isset($gender) && $gender=="male") echo "checked";?> required>
                                    <label class="form-check-label" for="genderMale">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="genderFemale" name="gender" value="female" <?php if (isset($gender) && $gender=="female") echo "checked";?> required>
                                    <label class="form-check-label" for="genderFemale">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="genderOther" name="gender" value="other" <?php if (isset($gender) && $gender=="other") echo "checked";?> required>
                                    <label class="form-check-label" for="genderOther">Other</label>
                                </div>
                            </div>
                            <div class="invalid-feedback">The gender is required.</div>
                        </div>

                        <div class="mb-3">
                            <label for="birthdate" class="form-label">Date of birth</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" required>
                            <div class="invalid-feedback">The date of birth is required.</div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" required>
                            <div class="invalid-feedback">The address is required.</div>
                        </div>

                        <div class="mb-3">
                            <label for="prof_title" class="form-label">Professional Title</label>
                            <input type="text" class="form-control" id="prof_title" name="prof_title" value="<?php echo htmlspecialchars($prof_title); ?>" required>
                            <div class="invalid-feedback">The professional title is required.</div>
                        </div>

                        <div class="mb-3">
                            <label for="skills" class="form-label">Skills</label>
                            <input type="text" class="form-control" id="skills" name="skills" value="<?php echo htmlspecialchars($skills); ?>" required>
                            <div class="invalid-feedback">The skills are required.</div>
                        </div>

                        <div class="mb-3">
                            <label for="profile_sum" class="form-label">Profile Summary</label>
                            <textarea class="form-control" id="profile_sum" name="profile_sum" rows="3" required><?php echo htmlspecialchars($profile_sum); ?></textarea>
                            <div class="invalid-feedback">The profile summary is required.</div>
                        </div>

                        <div class="mb-3">
                            <label for="education" class="form-label">Education</label>
                            <input type="text" class="form-control" id="education" name="education" value="<?php echo htmlspecialchars($education); ?>" required>
                            <div class="invalid-feedback">The education field is required.</div>
                        </div>

                        <div class="mb-3">
                            <label for="experience" class="form-label">Experience</label>
                            <input type="text" class="form-control" id="experience" name="experience" value="<?php echo htmlspecialchars($experience); ?>" required>
                            <div class="invalid-feedback">The experience field is required.</div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" name="editFreelancer" class="btn btn-info btn-lg btn-custom">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Footer-->
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
            <p><a href="#" class="text-white"><i class="fab fa-linkedin"></i> Linkedin</a></p>
        </div>
    </div>
</footer>
<!--End Footer-->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
    (function () {
        'use strict'

        var forms = document.querySelectorAll('.needs-validation')

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
    })();
</script>

</body>
</html>
