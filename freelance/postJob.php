<?php include('server.php');
if(isset($_SESSION["Username"])){
	$username=$_SESSION["Username"];
}
else{
    $username="";
	//header("location: index.php");
}

if(isset($_POST["postJob"])){
    $title=test_input($_POST["title"]);
    $type=test_input($_POST["type"]);
    $description=test_input($_POST["description"]);
    $budget=test_input($_POST["budget"]);
    $skills=test_input($_POST["skills"]);
    $special_skill=test_input($_POST["special_skill"]);
    

    $sql = "INSERT INTO job_offer (title, type, description, budget, skills, special_skill, e_username, valid) VALUES ('$title', '$type', '$description','$budget','$skills','$special_skill','$username',1)";
    
    $result = $conn->query($sql);
    if($result==true){
        $_SESSION["job_id"] = $conn->insert_id;
        header("location: jobDetails.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Post a Job</title>
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

		.form-control {
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

<div class="container mt-5">
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<div class="card">
				<div class="card-header text-center">
					<h2>Post A Job Offer</h2>
				</div>
				<div class="card-body">
					<form id="registrationForm" method="post" class="needs-validation" novalidate>
						<div class="mb-3">
							<label for="title" class="form-label">Job Title</label>
							<input type="text" class="form-control" id="title" name="title" required>
							<div class="invalid-feedback">
								The title is required and cannot be empty.
							</div>
						</div>

						<div class="mb-3">
							<label for="type" class="form-label">Job Type</label>
							<input type="text" class="form-control" id="type" name="type" required>
							<div class="invalid-feedback">
								The type is required and cannot be empty.
							</div>
						</div>

						<div class="mb-3">
							<label for="description" class="form-label">Job Description</label>
							<textarea class="form-control" id="description" name="description" rows="3" required></textarea>
							<div class="invalid-feedback">
								The description is required and cannot be empty.
							</div>
						</div>

						<div class="mb-3">
							<label for="budget" class="form-label">Budget</label>
							<input type="text" class="form-control" id="budget" name="budget" required>
							<div class="invalid-feedback">
								The budget is required and cannot be empty.
							</div>
						</div>

						<div class="mb-3">
							<label for="skills" class="form-label">Required Skills</label>
							<input type="text" class="form-control" id="skills" name="skills" required>
							<div class="invalid-feedback">
								The skills are required and cannot be empty.
							</div>
						</div>

						<div class="mb-3">
							<label for="special_skill" class="form-label">Special Requirement</label>
							<input type="text" class="form-control" id="special_skill" name="special_skill">
						</div>

						<div class="mb-3 text-center">
							<button type="submit" name="postJob" class="btn btn-info btn-lg">Post</button>
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
