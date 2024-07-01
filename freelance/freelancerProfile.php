<?php 
include('server.php');
if (isset($_SESSION["Username"])) {
    $username = $_SESSION["Username"];
} else {
    $username = "";
    //header("location: index.php");
}

if (isset($_POST["jid"])) {
    $_SESSION["job_id"] = $_POST["jid"];
    header("location: jobDetails.php");
}

if (isset($_POST["e_user"])) {
    $_SESSION["e_user"] = $_POST["e_user"];
    header("location: viewEmployer.php");
}

if (isset($_POST["uploadProfileImage"])) {
    $target_dir = "uploads/";
    // Create the directory if it doesn't exist
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            $sql = "UPDATE freelancer SET profile_image='$target_file' WHERE username='$username'";
            $conn->query($sql);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }
}

$sql = "SELECT * FROM freelancer WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row["Name"];
        $email = $row["email"];
        $contactNo = $row["contact_no"];
        $gender = $row["gender"];
        $birthdate = $row["birthdate"];
        $address = $row["address"];
        $prof_title = $row["prof_title"];
        $skills = $row["skills"];
        $profile_sum = $row["profile_sum"];
        $education = $row["education"];
        $experience = $row["experience"];
        $profile_image = isset($row["profile_image"]) ? $row["profile_image"] : 'image/img09.jpg';
    }
} else {
    echo "0 results";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancer Profile</title>
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

        .profile-image-container {
            position: relative;
            width: 100%;
            cursor: pointer;
        }

        .profile-image-container img {
            width: 100%;
            height: auto;
        }

        .profile-image-container .overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            transition: .5s ease;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-image-container:hover .overlay {
            opacity: 1;
        }

        .overlay i {
            color: white;
            font-size: 50px;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .list-group-item-info {
            background-color: #e9ecef;
            color: #495057;
        }

        .list-group-item-info:hover {
            background-color: #ced4da;
            color: #495057;
        }

        .card-header {
            font-weight: bold;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        footer {
            background: #222;
            color: #fff;
            padding: 20px 0;
        }

        footer a {
            color: #fff;
        }

        footer a:hover {
            text-decoration: underline;
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

    <!--main body-->
    <div class="container" style="padding-top: 2rem;">
        <div class="row">
            <!--Column 1-->
            <div class="col-lg-3">
                <!--Main profile card-->
                <div class="card mb-4">
                    <div class="profile-image-container">
                        <img src="<?php echo htmlspecialchars($profile_image); ?>" alt="Profile Image">
                        <div class="overlay">
                            <label for="profileImageInput" style="cursor: pointer;">
                                <i class="fas fa-pencil-alt"></i>
                            </label>
                        </div>
                    </div>
                    <form id="profileImageForm" method="post" enctype="multipart/form-data" style="display: none;">
                        <input type="file" id="profileImageInput" name="profile_image" accept="image/*" onchange="document.getElementById('profileImageForm').submit();">
                        <input type="hidden" name="uploadProfileImage" value="1">
                    </form>
                    <div class="card-body text-center">
                        <h2><?php echo htmlspecialchars($name); ?></h2>
                        <p><i class="fas fa-user"></i> <?php echo htmlspecialchars($username); ?></p>
                        <ul class="list-group list-group-flush">
                            <a href="editFreelancer.php" class="list-group-item list-group-item-action list-group-item-info">Edit Profile</a>
                            <a href="message.php" class="list-group-item list-group-item-action list-group-item-info">Messages</a>
                            <a href="logout.php" class="list-group-item list-group-item-action list-group-item-info">Logout</a>
                        </ul>
                    </div>
                </div>
                <!--End Main profile card-->

                <!--Contact Information-->
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h4>Contact Information</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                        <p><strong>Mobile:</strong> <?php echo htmlspecialchars($contactNo); ?></p>
                        <p><strong>Address:</strong> <?php echo htmlspecialchars($address); ?></p>
                    </div>
                </div>
                <!--End Contact Information-->

                <!--Reputation-->
                <div class="card mb-4">
                    <div class="card-header bg-warning text-white">
                        <h4>Reputation</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Reviews:</strong> Nothing to show</p>
                        <p><strong>Ratings:</strong> Nothing to show</p>
                    </div>
                </div>
                <!--End Reputation-->
            </div>
            <!--End Column 1-->

            <!--Column 2-->
            <div class="col-lg-7">
                <!--Freelancer Profile Details-->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h3>Freelancer Profile Details</h3>
                    </div>
                    <div class="card-body">
                        <h4>Professional Title</h4>
                        <p><?php echo htmlspecialchars($prof_title); ?></p>
                        <h4>Skills</h4>
                        <p><?php echo htmlspecialchars($skills); ?></p>
                        <h4>Profile Summary</h4>
                        <p><?php echo htmlspecialchars($profile_sum); ?></p>
                        <h4>Education</h4>
                        <p><?php echo htmlspecialchars($education); ?></p>
                        <h4>Experience</h4>
                        <p><?php echo htmlspecialchars($experience); ?></p>
                        <h4>Current Jobs</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Job Id</th>
                                    <th>Title</th>
                                    <th>Employer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM job_offer,selected WHERE job_offer.job_id=selected.job_id AND selected.f_username='$username' AND selected.valid=1 ORDER BY job_offer.timestamp DESC";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $job_id = $row["job_id"];
                                        $title = $row["title"];
                                        $e_username = $row["e_username"];
                                        $timestamp = $row["timestamp"];

                                        echo '
                                <form action="employerProfile.php" method="post">
                                <input type="hidden" name="jid" value="' . htmlspecialchars($job_id) . '">
                                    <tr>
                                    <td>' . htmlspecialchars($job_id) . '</td>
                                    <td><input type="submit" class="btn btn-link btn-lg" value="' . htmlspecialchars($title) . '"></td>
                                    </form>
                                    <form action="employerProfile.php" method="post">
                                    <input type="hidden" name="e_user" value="' . htmlspecialchars($e_username) . '">
                                    <td><input type="submit" class="btn btn-link btn-lg" value="' . htmlspecialchars($e_username) . '"></td>
                                    <td>' . htmlspecialchars($timestamp) . '</td>
                                    </tr>
                                </form>';
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>Nothing to show</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <h4>Previous Works</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Job Id</th>
                                    <th>Title</th>
                                    <th>Employer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM job_offer,selected WHERE job_offer.job_id=selected.job_id AND selected.f_username='$username' AND selected.valid=0 ORDER BY job_offer.timestamp DESC";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $job_id = $row["job_id"];
                                        $title = $row["title"];
                                        $e_username = $row["e_username"];
                                        $timestamp = $row["timestamp"];

                                        echo '
                                    <form action="freelancerProfile.php" method="post">
                                    <input type="hidden" name="jid" value="' . htmlspecialchars($job_id) . '">
                                        <tr>
                                        <td>' . htmlspecialchars($job_id) . '</td>
                                        <td><input type="submit" class="btn btn-link btn-lg" value="' . htmlspecialchars($title) . '"></td>
                                        </form>
                                        <form action="freelancerProfile.php" method="post">
                                        <input type="hidden" name="e_user" value="' . htmlspecialchars($e_username) . '">
                                        <td><input type="submit" class="btn btn-link btn-lg" value="' . htmlspecialchars($e_username) . '"></td>
                                        <td>' . htmlspecialchars($timestamp) . '</td>
                                        </tr>
                                    </form>';
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>Nothing to show</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--End Freelancer Profile Details-->
            </div>
            <!--End Column 2-->

            <!--Column 3-->
            <div class="col-lg-2">
                <!--My Wallet-->
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h3>My Wallet</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Balance: $0.0</li>
                            <li class="list-group-item">Hourly Rate: $3.0</li>
                            <li class="list-group-item">Payment Method: </li>
                            <li class="list-group-item">Withdraw</li>
                        </ul>
                    </div>
                </div>
                <!--End My Wallet-->

                <!--Social Network Profiles-->
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h3>Social Network Profiles</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><i class="fab fa-facebook-square" style="color:#3B579D;"></i> Facebook</li>
                            <li class="list-group-item"><i class="fab fa-google-plus-square" style="color:#D34438;"></i> Google</li>
                            <li class="list-group-item"><i class="fab fa-twitter-square" style="color:#2CAAE1;"></i> Twitter</li>
                            <li class="list-group-item"><i class="fab fa-linkedin" style="color:#0274B3;"></i> Linkedin</li>
                        </ul>
                    </div>
                </div>
                <!--End Social Network Profiles-->
            </div>
            <!--End Column 3-->
        </div>
    </div>
    <!--End main body-->

    <!--Footer-->
    <footer class="text-center text-white bg-dark py-4">
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

</body>

</html>
