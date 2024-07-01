<?php 
include('server.php');
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
} else {
    $username="";
	//header("location: index.php");
}

$sql = "SELECT * FROM message WHERE receiver='$username' ORDER BY timestamp DESC";
$result = $conn->query($sql);
$f=0;

if(isset($_POST["sr"])){
	$t=$_POST["sr"];
	$sql = "SELECT * FROM freelancer WHERE username='$t'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$_SESSION["f_user"]=$t;
		header("location: viewFreelancer.php");
	} else {
	    $sql = "SELECT * FROM employer WHERE username='$t'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$_SESSION["e_user"]=$t;
			header("location: viewEmployer.php");
		}
	}
}

if(isset($_POST["s_inbox"])){
	$t=$_POST["s_inbox"];
	$sql = "SELECT * FROM message WHERE receiver='$username' and sender='$t' ORDER BY timestamp DESC";
	$result = $conn->query($sql);
	$f=0;
}

if(isset($_POST["s_sm"])){
	$t=$_POST["s_sm"];
	$sql = "SELECT * FROM message WHERE sender='$username' and receiver='$t' ORDER BY timestamp DESC";
	$result = $conn->query($sql);
	$f=1;
}

if(isset($_POST["inbox"])){
	$sql = "SELECT * FROM message WHERE receiver='$username' ORDER BY timestamp DESC";
	$result = $conn->query($sql);
	$f=0;
}

if(isset($_POST["sm"])){
	$sql = "SELECT * FROM message WHERE sender='$username' ORDER BY timestamp DESC";
	$result = $conn->query($sql);
	$f=1;
}

if(isset($_POST["rep"])){
	$_SESSION["msgRcv"]=$_POST["rep"];
	header("location: sendMessage.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Messages</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<style>
		body { padding-top: 3%; margin: 0; }
		.card { box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19); background: #fff; }
		.navbar { box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
		.footer { background: #222; color: #fff; padding: 20px 0; margin-top: auto; }
		.footer a { color: #fff; }
		.footer a:hover { text-decoration: underline; }
		.btn-custom { border-radius: 50px; padding: 10px 20px; }
		.table th, .table td { vertical-align: middle; }
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

<!--Main body-->
<div class="container mt-5">
	<div class="row">

		<!--Column 1-->
		<div class="col-lg-9">

			<!--Messages-->
			<div class="card mb-4">
				<div class="card-header bg-success text-white">
					<h3>All Messages</h3>
				</div>
				<div class="card-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Message</th>
								<th>Username</th>
								<th>Action</th>
								<th>Timestamp</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									$sender = $row["sender"];
									$receiver = $row["receiver"];
									$msg = $row["msg"];
									$timestamp = $row["timestamp"];

									if ($f == 0) {
										$sr = $sender;
									} else {
										$sr = $receiver;
									}

									echo '
									<tr>
										<td>'.htmlspecialchars($msg).'</td>
										<td>
											<form action="message.php" method="post" style="display:inline;">
												<input type="hidden" name="sr" value="'.htmlspecialchars($sr).'">
												<button type="submit" class="btn btn-link btn-lg">'.htmlspecialchars($sr).'</button>
											</form>
										</td>
										<td>
											<form action="message.php" method="post" style="display:inline;">
												<input type="hidden" name="rep" value="'.htmlspecialchars($sr).'">
												<button type="submit" class="btn btn-link btn-lg">Reply</button>
											</form>
										</td>
										<td>'.htmlspecialchars($timestamp).'</td>
									</tr>
									';
								}
							} else {
								echo "<tr><td colspan='4'>Nothing to show</td></tr>";
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<!--End Messages-->

		</div>
		<!--End Column 1-->

		<!--Column 2-->
		<div class="col-lg-3">

			<!--Search and Filters-->
			<div class="card mb-4">
				<div class="card-body">
					<form action="message.php" method="post" class="mb-3">
						<div class="mb-3">
							<input type="text" class="form-control" name="s_inbox" placeholder="Search Inbox">
						</div>
						<button type="submit" class="btn btn-info w-100 btn-custom">Search Inbox</button>
					</form>

					<form action="message.php" method="post" class="mb-3">
						<div class="mb-3">
							<input type="text" class="form-control" name="s_sm" placeholder="Search Sent Messages">
						</div>
						<button type="submit" class="btn btn-info w-100 btn-custom">Search Sent Messages</button>
					</form>

					<form action="message.php" method="post" class="mb-3">
						<button type="submit" name="inbox" class="btn btn-warning w-100 btn-custom">Inbox Messages</button>
					</form>

					<form action="message.php" method="post" class="mb-3">
						<button type="submit" name="sm" class="btn btn-warning w-100 btn-custom">Sent Messages</button>
					</form>
				</div>
			</div>
			<!--End Search and Filters-->

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
