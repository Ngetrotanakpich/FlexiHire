<?php 
include('server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
} else {
	$username="";
	//header("location: index.php");
}

if(isset($_POST["jid"])){
	$_SESSION["job_id"]=$_POST["jid"];
	header("location: jobDetails.php");
}

if(isset($_POST["f_user"])){
	$_SESSION["f_user"]=$_POST["f_user"];
	header("location: viewFreelancer.php");
}

$sql = "SELECT * FROM employer WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
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

$sql = "SELECT * FROM job_offer WHERE e_username='$username' and valid=1 ORDER BY timestamp DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Employer Profile</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<style>
		body {
			padding-top: 3%;
			margin: 0;
			background-color: #f8f9fa;
			font-family: Arial, sans-serif;
		}

		.card {
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			background: #fff;
			border: none;
			border-radius: 10px;
			margin-bottom: 20px;
		}

		.card-header {
			background: #007bff;
			color: white;
			border-radius: 10px 10px 0 0;
		}

		.list-group-item {
			border: none;
			border-bottom: 1px solid #f0f0f0;
		}

		.navbar {
			background: #343a40;
		}

		.navbar-brand {
			font-weight: bold;
		}

		.nav-item a {
			color: white !important;
		}

		.footer {
			background: #343a40;
			color: white;
			padding: 20px 0;
		}

		.footer a {
			color: white;
		}

		.footer a:hover {
			text-decoration: underline;
		}

		.btn-link {
			color: #007bff;
		}
	</style>
</head>
<body>

<!--Navbar menu-->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
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
						<li><a class="dropdown-item" href="employerProfile.php"><i class="fas fa-home"></i> View profile</a></li>
						<li><a class="dropdown-item" href="editEmployer.php"><i class="fas fa-edit"></i> Edit Profile</a></li>
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
<div class="container mt-5">
	<div class="row">

		<!--Column 1-->
		<div class="col-lg-3">

			<!--Main profile card-->
			<div class="card mb-4">
				<div class="card-body text-center">
					<img src="image/img10.jpg" class="rounded-circle img-fluid" alt="Profile Image">
					<h2><?php echo htmlspecialchars($name); ?></h2>
					<p><i class="fas fa-user"></i> <?php echo htmlspecialchars($username); ?></p>
					<ul class="list-group">
						<a href="postJob.php" class="list-group-item list-group-item-action">Post a job offer</a>
						<a href="editEmployer.php" class="list-group-item list-group-item-action">Edit Profile</a>
						<a href="message.php" class="list-group-item list-group-item-action">Messages</a>
						<a href="logout.php" class="list-group-item list-group-item-action">Logout</a>
					</ul>
				</div>
			</div>
			<!--End Main profile card-->

			<!--Contact Information-->
			<div class="card mb-4">
				<div class="card-header">
					<h4>Contact Information</h4>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item"><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></li>
					<li class="list-group-item"><strong>Mobile:</strong> <?php echo htmlspecialchars($contactNo); ?></li>
					<li class="list-group-item"><strong>Address:</strong> <?php echo htmlspecialchars($address); ?></li>
				</ul>
			</div>
			<!--End Contact Information-->

			<!--Reputation-->
			<div class="card mb-4">
				<div class="card-header bg-warning text-dark">
					<h4>Reputation</h4>
				</div>
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
				<div class="card-header">
					<h3>Employer Profile Details</h3>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item"><strong>Company Name:</strong> <h4><?php echo htmlspecialchars($company); ?></h4></li>
					<li class="list-group-item"><strong>Profile Summary:</strong> <h4><?php echo htmlspecialchars($profile_sum); ?></h4></li>
				</ul>
			</div>
			<!--End Employer Profile Details-->

			<!--Current Job Offerings-->
			<div class="card mb-4">
				<div class="card-header">
					<h4>Current Job Offerings</h4>
				</div>
				<div class="card-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Job Id</th>
								<th>Title</th>
								<th>Posted on</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									$job_id = $row["job_id"];
									$title = $row["title"];
									$timestamp = $row["timestamp"];

									echo '
									<form action="employerProfile.php" method="post">
										<input type="hidden" name="jid" value="'.$job_id.'">
										<tr>
											<td>'.htmlspecialchars($job_id).'</td>
											<td><button type="submit" class="btn btn-link btn-lg">'.htmlspecialchars($title).'</button></td>
											<td>'.htmlspecialchars($timestamp).'</td>
										</tr>
									</form>
									';
								}
							} else {
								echo "<tr><td colspan='3'>Nothing to show</td></tr>";
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<!--End Current Job Offerings-->

			<!--Previous Job Offerings-->
			<div class="card mb-4">
				<div class="card-header">
					<h4>Previous Job Offerings</h4>
				</div>
				<div class="card-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Job Id</th>
								<th>Title</th>
								<th>Posted on</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$sql = "SELECT * FROM job_offer WHERE e_username='$username' and valid=0 ORDER BY timestamp DESC";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									$job_id = $row["job_id"];
									$title = $row["title"];
									$timestamp = $row["timestamp"];

									echo '
									<form action="employerProfile.php" method="post">
										<input type="hidden" name="jid" value="'.htmlspecialchars($job_id).'">
										<tr>
											<td>'.htmlspecialchars($job_id).'</td>
											<td><button type="submit" class="btn btn-link btn-lg">'.htmlspecialchars($title).'</button></td>
											<td>'.htmlspecialchars($timestamp).'</td>
										</tr>
									</form>
									';
								}
							} else {
								echo "<tr><td colspan='3'>Nothing to show</td></tr>";
							}
							?>
					</tbody>
				</table>
			</div>
		</div>
		<!--End Previous Job Offerings-->

		<!--Currently Hired Freelancers-->
		<div class="card mb-4">
			<div class="card-header">
				<h4>Currently Hired Freelancers</h4>
			</div>
			<div class="card-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Job Id</th>
							<th>Title</th>
							<th>Freelancer</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$sql = "SELECT * FROM job_offer,selected WHERE job_offer.job_id=selected.job_id AND selected.e_username='$username' AND selected.valid=1 ORDER BY job_offer.timestamp DESC";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								$job_id = $row["job_id"];
								$title = $row["title"];
								$f_username = $row["f_username"];
								$timestamp = $row["timestamp"];

								echo '
								<form action="employerProfile.php" method="post">
									<input type="hidden" name="jid" value="'.htmlspecialchars($job_id).'">
									<tr>
										<td>'.htmlspecialchars($job_id).'</td>
										<td><button type="submit" class="btn btn-link btn-lg">'.htmlspecialchars($title).'</button></td>
									</form>
									<form action="employerProfile.php" method="post">
										<input type="hidden" name="f_user" value="'.htmlspecialchars($f_username).'">
										<td><button type="submit" class="btn btn-link btn-lg">'.htmlspecialchars($f_username).'</button></td>
										<td>'.htmlspecialchars($timestamp).'</td>
									</tr>
								</form>
								';
							}
						} else {
							echo "<tr><td colspan='3'>Nothing to show</td></tr>";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<!--End Currently Hired Freelancers-->

		<!--Previously Hired Freelancers-->
		<div class="card mb-4">
			<div class="card-header">
				<h4>Previously Hired Freelancers</h4>
			</div>
			<div class="card-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Job Id</th>
							<th>Title</th>
							<th>Freelancer</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$sql = "SELECT * FROM job_offer,selected WHERE job_offer.job_id=selected.job_id AND selected.e_username='$username' AND selected.valid=0 ORDER BY job_offer.timestamp DESC";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								$job_id = $row["job_id"];
								$title = $row["title"];
								$f_username = $row["f_username"];
								$timestamp = $row["timestamp"];

								echo '
								<form action="employerProfile.php" method="post">
									<input type="hidden" name="jid" value="'.htmlspecialchars($job_id).'">
									<tr>
										<td>'.htmlspecialchars($job_id).'</td>
										<td><button type="submit" class="btn btn-link btn-lg">'.htmlspecialchars($title).'</button></td>
									</form>
									<form action="employerProfile.php" method="post">
										<input type="hidden" name="f_user" value="'.htmlspecialchars($f_username).'">
										<td><button type="submit" class="btn btn-link btn-lg">'.htmlspecialchars($f_username).'</button></td>
										<td>'.htmlspecialchars($timestamp).'</td>
									</tr>
								</form>
								';
							}
						} else {
							echo "<tr><td colspan='3'>Nothing to show</td></tr>";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<!--End Previously Hired Freelancers-->

	</div>
	<!--End Column 2-->

	<!--Column 3-->
	<div class="col-lg-2">
		<!--My Wallet-->
		<div class="card mb-4">
			<div class="card-header bg-info text-white">
				<h4>My Wallet</h4>
			</div>
			<ul class="list-group list-group-flush">
				<li class="list-group-item">Balance: $0.0</li>
				<li class="list-group-item">Payment Method:</li>
				<li class="list-group-item">Deposit</li>
			</ul>
		</div>
		<!--End My Wallet-->

		<!--Social Network Profiles-->
		<div class="card mb-4">
			<div class="card-header bg-info text-white">
				<h4>Social Network Profiles</h4>
			</div>
			<ul class="list-group list-group-flush">
				<li class="list-group-item"><i class="fab fa-facebook-square text-primary" style="font-size:20px;"></i> Facebook</li>
				<li class="list-group-item"><i class="fab fa-google-plus-square text-danger" style="font-size:20px;"></i> Google</li>
				<li class="list-group-item"><i class="fab fa-twitter-square text-info" style="font-size:20px;"></i> Twitter</li>
				<li class="list-group-item"><i class="fab fa-linkedin text-primary" style="font-size:20px;"></i> LinkedIn</li>
			</ul>
		</div>
		<!--End Social Network Profiles-->

	</div>
	<!--End Column 3-->

</div>
</div>
<!--End main body-->

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
