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

if(isset($_SESSION["e_user"])){
	$e_user=$_SESSION["e_user"];
	$_SESSION["msgRcv"]=$e_user;
}

$sql = "SELECT * FROM employer WHERE username='$e_user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		$name=$row["Name"];
		$email=$row["email"];
		$contactNo=$row["contact_no"];
		$gender=$row["gender"];
		$birthdate=$row["birthdate"];
		$address=$row["address"];
		$company=$row["company"];
		$profile_sum=$row["profile_sum"];
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
	<title>Employer Profile</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
	<style>
		body { padding-top: 3%; margin: 0; }
		.card { box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19); background: #fff; }
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
						<i class="fas fa-user"></i> <?php echo $username; ?>
					</a>
					<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="<?php echo $linkPro; ?>"><i class="fas fa-home"></i> View Profile</a></li>
						<li><a class="dropdown-item" href="<?php echo $linkEditPro; ?>"><i class="fas fa-edit"></i> Edit Profile</a></li>
						<li><a class="dropdown-item" href="message.php"><i class="fas fa-envelope"></i> Messages</a></li>
						<li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>
<!--End Navbar-->

<!--Main body-->
<div class="container mt-5">
	<div class="row">

		<!--Column 1-->
		<div class="col-lg-3">

			<!--Main profile card-->
			<div class="card mb-4">
				<img src="image/img10.jpg" class="card-img-top" alt="Profile Image">
				<div class="card-body text-center">
					<h5 class="card-title"><?php echo $name; ?></h5>
					<p class="card-text"><i class="fas fa-user"></i> <?php echo $e_user; ?></p>
					<a href="sendMessage.php" class="btn btn-info"><i class="fas fa-envelope"></i> Send Message</a>
				</div>
			</div>
			<!--End Main profile card-->

			<!--Contact Information-->
			<div class="card mb-4">
				<div class="card-header bg-success text-white"><h6>Contact Information</h6></div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item"><strong>Email:</strong> <?php echo $email; ?></li>
					<li class="list-group-item"><strong>Mobile:</strong> <?php echo $contactNo; ?></li>
					<li class="list-group-item"><strong>Address:</strong> <?php echo $address; ?></li>
				</ul>
			</div>
			<!--End Contact Information-->

			<!--Reputation-->
			<div class="card mb-4">
				<div class="card-header bg-warning text-dark"><h6>Reputation</h6></div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item"><strong>Reviews:</strong> Nothing to show</li>
					<li class="list-group-item"><strong>Ratings:</strong> Nothing to show</li>
				</ul>
			</div>
			<!--End Reputation-->

		</div>
		<!--End Column 1-->

		<!--Column 2-->
		<div class="col-lg-7">

			<!--Employer Profile Details-->
			<div class="card mb-4">
				<div class="card-header bg-primary text-white"><h5>Employer Profile Details</h5></div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item"><strong>Company Name:</strong> <h6><?php echo $company; ?></h6></li>
					<li class="list-group-item"><strong>Previously Hired Freelancers:</strong> <h6><?php echo $e_user; ?></h6></li>
					<li class="list-group-item"><strong>Profile Summary:</strong> <h6><?php echo $profile_sum; ?></h6></li>
				</ul>
			</div>
			<!--End Employer Profile Details-->

		</div>
		<!--End Column 2-->

		<!--Column 3-->
		<div class="col-lg-2">

			<!--Social Network Profiles-->
			<div class="card mb-4">
				<div class="card-header bg-info text-white"><h5>Social Network Profiles</h5></div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item"><i class="fab fa-facebook-square text-primary"></i> Facebook</li>
					<li class="list-group-item"><i class="fab fa-google-plus-square text-danger"></i> Google</li>
					<li class="list-group-item"><i class="fab fa-twitter-square text-info"></i> Twitter</li>
					<li class="list-group-item"><i class="fab fa-linkedin text-primary"></i> Linkedin</li>
				</ul>
			</div>
			<!--End Social Network Profiles-->

		</div>
		<!--End Column 3-->

	</div>
</div>
<!--End Main body-->

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
</body>
</html>

