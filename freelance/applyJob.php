<?php
include('server.php');
if (isset($_SESSION["Username"])) {
    $username = $_SESSION["Username"];
} else {
    $username = "";
    //header("location: index.php");
}

if (isset($_SESSION["job_id"])) {
    $job_id = $_SESSION["job_id"];
} else {
    $job_id = "";
    //header("location: index.php");
}

$sql = "SELECT * FROM apply WHERE job_id='$job_id' and f_username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $msg = "You have already applied for this job. You cannot apply again.";
} else {
    $msg = "";
}

if (isset($_POST["apply"]) && $msg == "") {
    $cover = test_input($_POST["cover"]);
    $bid = test_input($_POST["bid"]);

    // Handle file upload
    $file_path = "";
    $errors = [];
    if (isset($_FILES['resume'])) {
        $file_name = $_FILES['resume']['name'];
        $file_tmp = $_FILES['resume']['tmp_name'];
        $file_type = $_FILES['resume']['type'];
        $file_size = $_FILES['resume']['size'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        $extensions = array("pdf", "doc", "docx");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "Extension not allowed, please choose a PDF or DOC/DOCX file.";
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size must be less than 2 MB';
        }

        if (empty($errors)) {
            $upload_directory = "uploads/";
            if (!is_dir($upload_directory)) {
                mkdir($upload_directory, 0755, true);
            }
            $file_path = $upload_directory . basename($file_name);
            if (move_uploaded_file($file_tmp, $file_path)) {
                // Successfully uploaded
            } else {
                $errors[] = "Failed to move uploaded file.";
            }
        } else {
            print_r($errors);
        }
    }

    if (empty($errors)) {
        $sql = "INSERT INTO apply (f_username, job_id, bid, cover_letter, resume) VALUES ('$username', '$job_id', '$bid', '$cover', '$file_path')";
        $result = $conn->query($sql);

        if ($result == true) {
            header("location: allJob.php");
        } else {
            echo "Error: " . $conn->error; // Debugging line
        }
    } else {
        print_r($errors); // Debugging line
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Job</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            padding-top: 3%;
            margin: 0;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
            background: #fff;
        }
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

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="page-header">
                    <h2>Apply for Job</h2>
                </div>

                <form id="registrationForm" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <?php echo $msg; ?>
                    <div class="mb-3">
                        <label for="cover" class="form-label">Write A Cover Letter</label>
                        <textarea class="form-control" id="cover" name="cover" rows="6" required></textarea>
                        <div class="invalid-feedback">
                            The cover letter is required.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="bid" class="form-label">Place a bid</label>
                        <input type="text" class="form-control" id="bid" name="bid" required>
                        <div class="invalid-feedback">
                            The bid is required and must be a valid number.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="resume" class="form-label">Upload Your Resume (PDF, DOC, DOCX...)</label>
                        <input type="file" class="form-control" id="resume" name="resume" accept=".pdf,.doc,.docx" required>
                        <div class="invalid-feedback">
                            The resume is required and must be a valid file.
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" name="apply" class="btn btn-info btn-lg">Submit</button>
                    </div>
                </form>
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
        (function() {
            'use strict'

            var forms = document.querySelectorAll('.needs-validation')

            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
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