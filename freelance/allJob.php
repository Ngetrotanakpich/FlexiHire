<?php
include('server.php');
if (isset($_SESSION["Username"])) {
	$username = $_SESSION["Username"];
	if ($_SESSION["Usertype"] == 1) {
		$linkPro = "freelancerProfile.php";
		$linkEditPro = "editFreelancer.php";
		$linkBtn = "applyJob.php";
		$textBtn = "Apply for this job";
	} else {
		$linkPro = "employerProfile.php";
		$linkEditPro = "editEmployer.php";
		$linkBtn = "editJob.php";
		$textBtn = "Edit the job offer";
	}
} else {
	$username = "";
	//header("location: index.php");
}

if (isset($_POST["jid"])) {
	$_SESSION["job_id"] = $_POST["jid"];
	header("location: jobDetails.php");
}

$sql = "SELECT * FROM job_offer WHERE valid=1 ORDER BY timestamp DESC";
$result = $conn->query($sql);

if (isset($_POST["search"])) {
	$search = $conn->real_escape_string($_POST["search"]);
	$sql = "SELECT * FROM job_offer WHERE (title LIKE '%$search%' OR type LIKE '%$search%' OR e_username LIKE '%$search%' OR job_id LIKE '%$search%') AND valid=1";
	$result = $conn->query($sql);
}

if (isset($_POST["recentJob"])) {
	$sql = "SELECT * FROM job_offer WHERE valid=1 ORDER BY timestamp DESC";
	$result = $conn->query($sql);
}

if (isset($_POST["oldJob"])) {
	$sql = "SELECT * FROM job_offer WHERE valid=1";
	$result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>All Job Offers</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<style>
		body {
			padding-top: 3%;
			margin: 0;
			font-family: Arial, sans-serif;
		}

		.card {
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
			background: #fff;
			margin-bottom: 20px;
		}

		.card-header {
			background: #007BFF;
			color: white;
		}

		.table th,
		.table td {
			vertical-align: middle;
		}

		.footer {
			background: #222;
			color: white;
			padding: 20px 0;
			margin-top: auto;
		}

		.footer a {
			color: white;
		}

		.footer a:hover {
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
	<div class="container mt-5">
		<div class="row">

			<!--Column 1-->
			<div class="col-lg-9">

				<!--Job Offers Table-->
				<div class="card mb-4">
					<div class="card-header">
						<h3>All Job Offers</h3>
					</div>
					<div class="card-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Job Id</th>
									<th>Title</th>
									<th>Type</th>
									<th>Budget</th>
									<th>Employer</th>
									<th>Posted on</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if ($result->num_rows > 0) {
									while ($row = $result->fetch_assoc()) {
										$job_id = $row["job_id"];
										$title = $row["title"];
										$type = $row["type"];
										$budget = $row["budget"];
										$e_username = $row["e_username"];
										$timestamp = $row["timestamp"];

										echo '
                                    <form action="allJob.php" method="post">
                                        <input type="hidden" name="jid" value="' . $job_id . '">
                                        <tr>
                                            <td>' . $job_id . '</td>
                                            <td><button type="submit" class="btn btn-link btn-lg">' . $title . '</button></td>
                                            <td>' . $type . '</td>
                                            <td>' . $budget . '</td>
                                            <td>' . $e_username . '</td>
                                            <td>' . $timestamp . '</td>
                                        </tr>
                                    </form>
                                    ';
									}
								} else {
									echo "<tr><td colspan='6'>Nothing to show</td></tr>";
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<!--End Job Offers Table-->

			</div>
			<!--End Column 1-->

			<!--Column 2-->
			<div class="col-lg-3">

				<!--Search and Filter Forms-->
				<div class="card mb-4">
					<div class="card-body">
						<form action="allJob.php" method="post" class="mb-3">
							<div class="input-group">
								<input type="text" class="form-control" name="search" placeholder="Search by Title, Type, Employer, Job ID">
								<button class="btn btn-info" type="submit">Search</button>
							</div>
						</form>

						<form action="allJob.php" method="post" class="mb-3">
							<button type="submit" name="recentJob" class="btn btn-warning w-100">See all recent posted jobs first</button>
						</form>

						<form action="allJob.php" method="post">
							<button type="submit" name="oldJob" class="btn btn-warning w-100">See all older posted jobs first</button>
						</form>
					</div>
				</div>
				<!--End Search and Filter Forms-->

			</div>
			<!--End Column 2-->
		</div>
	</div>
	<!--End main body-->

	<!--Footer-->
	<footer class="footer bg-dark text-white text-center py-4 mt-4">
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
					<p>&copy; 2024</p>
				</div>
				<div class="col-lg-3">
					<h5>Contact Us</h5>
					<p>Email: llong@paragoniu.edu.kh</p>
					<p>FlexiHire Freelance</p>
					<p>&copy; CUET 2024</p>
				</div>
				<div class="col-lg-3">
					<h5>Social Contact</h5>
					<p><a href="#" class="text-white"><i class="fab fa-facebook-square text-primary" style="font-size:20px;"></i> Facebook</a></p>
					<p><a href="#" class="text-white"><i class="fab fa-google-plus-square text-danger" style="font-size:20px;"></i> Google</a></p>
					<p><a href="#" class="text-white"><i class="fab fa-twitter-square text-info" style="font-size:20px;"></i> Twitter</a></p>
					<p><a href="#" class="text-white"><i class="fab fa-linkedin text-primary" style="font-size:20px;"></i> LinkedIn</a></p>
				</div>
			</div>
		</div>
	</footer>
	<!--End Footer-->

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>

</html>