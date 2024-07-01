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

if(isset($_SESSION["job_id"])){
    $job_id=$_SESSION["job_id"];
}
else{
    $job_id="";
    //header("location: index.php");
}

if(isset($_POST["f_user"])){
    $_SESSION["f_user"]=$_POST["f_user"];
    header("location: viewFreelancer.php");
}

if(isset($_POST["c_letter"])){
    $_SESSION["c_letter"]=$_POST["c_letter"];
    header("location: coverLetter.php");
}

if(isset($_POST["f_hire"])){
    $f_hire=$_POST["f_hire"];
    $f_price=$_POST["f_price"];
    $sql = "INSERT INTO selected (f_username, job_id, e_username, price, valid) VALUES ('$f_hire', '$job_id', '$username','$f_price',1)";
    
    $result = $conn->query($sql);
    if($result==true){
        $sql = "DELETE FROM apply WHERE job_id='$job_id'";
        $result = $conn->query($sql);
        if($result==true){
            $sql = "UPDATE job_offer SET valid=0 WHERE job_id='$job_id'";
            $result = $conn->query($sql);
            if($result==true){
                header("location: jobDetails.php");
            }
        }
    }
}

if(isset($_POST["f_done"])){
    $f_done=$_POST["f_done"];
    $sql = "UPDATE selected SET valid=0 WHERE job_id='$job_id'";
    $result = $conn->query($sql);
    if($result==true){
        header("location: jobDetails.php");
    }
}

$sql = "SELECT * FROM job_offer WHERE job_id='$job_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $e_username=$row["e_username"];
		$title=$row["title"];
        $type=$row["type"];
        $description=$row["description"];
        $budget=$row["budget"];
        $skills=$row["skills"];
        $special_skill=$row["special_skill"];
        $timestamp=$row["timestamp"];
        $jv=$row["valid"];
        
    }
} else {
    echo "0 results";
}

$_SESSION["msgRcv"]=$e_username;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details</title>
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

<!--main body-->
<div class="container" style="padding-top: 2rem;">
    <div class="row">
        <!--Column 1-->
        <div class="col-lg-7">

            <!--Job Offer Details-->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h3>Job Offer Details</h3>
                </div>
                <div class="card-body">
                    <h4>Job Title</h4>
                    <p><?php echo $title; ?></p>
                    <h4>Job Type</h4>
                    <p><?php echo $type; ?></p>
                    <h4>Job Description</h4>
                    <p><?php echo $description; ?></p>
                    <h4>Budget</h4>
                    <p><?php echo $budget; ?></p>
                    <h4>Required Skills</h4>
                    <p><?php echo $skills; ?></p>
                    <h4>Special Requirement</h4>
                    <p><?php echo $special_skill; ?></p>
                  
                    
                    <a href="<?php echo $linkBtn; ?>" id="applybtn" class="btn btn-warning btn-lg"><?php echo $textBtn; ?></a>
                </div>
            </div>
            <!--End Job Offer Details-->

            <!--Applicants for this job-->
            <div id="applicant" class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h3>Applicants for this job</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Applicant's username</th>
                                <th>Bid</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $sql = "SELECT * FROM apply WHERE job_id='$job_id' ORDER BY bid";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $f_username = $row["f_username"];
                                    $bid = $row["bid"];
                                    $cover_letter = $row["cover_letter"];

                                    echo '
                                    <tr>
                                        <td>
                                            <form action="jobDetails.php" method="post" style="display:inline;">
                                                <input type="hidden" name="f_user" value="'.$f_username.'">
                                                <button type="submit" class="btn btn-link btn-lg">'.$f_username.'</button>
                                            </form>
                                        </td>
                                        <td>'.$bid.'</td>
                                        <td>
                                            <form action="jobDetails.php" method="post" style="display:inline;">
                                                <input type="hidden" name="c_letter" value="'.$cover_letter.'">
                                                <button type="submit" class="btn btn-link">Cover Letter</button>
                                            </form>
                                            <form action="jobDetails.php" method="post" style="display:inline;">
                                                <input type="hidden" name="f_hire" value="'.$f_username.'">
                                                <input type="hidden" name="f_price" value="'.$bid.'">
                                                <button type="submit" class="btn btn-link">Hire</button>
                                            </form>
                                        </td>
                                    </tr>';
                                }
                            } else {
                                $sql = "SELECT * FROM selected WHERE job_id='$job_id'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $f_username = $row["f_username"];
                                        $bid = $row["price"];
                                        $v = $row["valid"];

                                        if ($v == 0) {
                                            $tc = "Job ended";
                                            $tv = "";
                                        } else {
                                            $tc = "End Job";
                                            $tv = "f_done";
                                        }

                                        echo '
                                        <tr>
                                            <td>
                                                <form action="jobDetails.php" method="post" style="display:inline;">
                                                    <input type="hidden" name="f_user" value="'.$f_username.'">
                                                    <button type="submit" class="btn btn-link btn-lg">'.$f_username.'</button>
                                                </form>
                                            </td>
                                            <td>'.$bid.'</td>
                                            <td>
                                                <form action="jobDetails.php" method="post" style="display:inline;">
                                                    <input type="hidden" name="'.$tv.'" value="'.$f_username.'">
                                                    <button type="submit" class="btn btn-link">'.$tc.'</button>
                                                </form>
                                            </td>
                                        </tr>';
                                    }
                                } else {
                                    echo "<tr><td colspan='3'>Nothing to show</td></tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--End Applicants for this job-->

        </div>
        <!--End Column 1-->

        <?php 
        $sql = "SELECT * FROM employer WHERE username='$e_username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $e_Name = $row["Name"];
                $email = $row["email"];
                $contact_no = $row["contact_no"];
                $address = $row["address"];
            }
        } else {
            echo "0 results";
        }
        ?>

        <!--Column 2-->
        <div class="col-lg-3">

            <!--Main profile card-->
            <div class="card mb-4">
                <img src="image/img09.jpg" class="card-img-top" alt="Profile Image">
                <div class="card-body text-center">
                    <h2><?php echo $e_Name; ?></h2>
                    <p><i class="fas fa-user"></i> <?php echo $e_username; ?></p>
                    <a href="sendMessage.php"
					class="btn btn-info"><i class="fas fa-envelope"></i> Send Message</a>
                </div>
            </div>
            <!--End Main profile card-->

            <!--Contact Information-->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h4>Contact Information</h4>
                </div>
                <div class="card-body">
                    <p><strong>Email:</strong> <?php echo $email; ?></p>
                    <p><strong>Mobile:</strong> <?php echo $contact_no; ?></p>
                    <p><strong>Address:</strong> <?php echo $address; ?></p>
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
        <!--End Column 2-->

        <!--Column 3-->
        <div class="col-lg-2">

            <!--Related jobs-->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h3>Related job offers</h3>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Related job 1</li>
                    <li class="list-group-item">Related job 2</li>
                    <li class="list-group-item">Related job 3</li>
                    <li class="list-group-item">Related job 4</li>
                </ul>
            </div>
            <!--End Related jobs-->

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

<?php 

if($e_username != $username && $_SESSION["Usertype"] != 1){
    echo "<script>document.getElementById('applybtn').style.display = 'none';</script>";
} 

if($_SESSION["Usertype"] == 1 && $jv == 0){
    echo "<script>document.getElementById('applybtn').style.display = 'none';</script>";
} 

if($e_username != $username){
    echo "<script>document.getElementById('applicant').style.display = 'none';</script>";
}

?>

</body>
</html>


