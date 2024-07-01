<?php include('server.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlexiHire - Login/Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f3f3f3, #e2e2e2);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            background: #333;
            color: #fff;
            padding: 15px 20px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .navbar a {
            color: #fff;
            margin-right: 15px;
            text-decoration: none;
        }

        .navbar-brand {
            font-weight: 700;
        }

        .container {
            max-width: 900px;
            background: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
            margin-top: 100px;
            padding: 30px;
        }

        .form-section {
            padding: 30px;
        }

        .form-section h2 {
            margin-bottom: 20px;
            font-weight: 700;
            color: #333;
        }

        .form-divider {
            border-right: 1px solid #e2e2e2;
        }

        .footer {
            background: #222;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            margin-top: auto;
        }

        .footer a {
            color: #fff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .btn-primary,
        .btn-success {
            border-radius: 50px;
            padding: 10px 20px;
            font-weight: bold;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px;
        }

        .form-check-label {
            margin-left: 5px;
        }

        .custom-shadow {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .input-group-text {
            background-color: #fff;
            border-right: 0;
        }

        .alert {
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="container-fluid">
            <a href="index.php" class="navbar-brand">FlexiHire</a>
            <div class="d-flex">
                <a href="index.php">Home</a>
                <a href="#loginSection">Login</a>
                <a href="#registerSection">Register</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row g-0">
            <div class="col-md-6 form-divider" id="loginSection">
                <div class="form-section">
                    <h2>Login</h2>
                    <form id="loginForm" method="post">
                        <?php if (!empty($errorMsg)) : ?>
                            <div class="alert alert-danger">
                                <p><?php echo htmlspecialchars($errorMsg); ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control custom-shadow" id="loginUsername" name="username" placeholder="Username" required />
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control custom-shadow" id="loginPassword" name="password" placeholder="Password" required />
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('loginPassword')">Show/Hide</button>
                        </div>
                        <div class="form-group mb-3">
                            <label>Usertype</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="usertype" id="loginFreelancer" value="freelancer" required>
                                    <label class="form-check-label" for="loginFreelancer">Freelancer</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="usertype" id="loginEmployer" value="employer" required>
                                    <label class="form-check-label" for="loginEmployer">Employer</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6" id="registerSection">
                <div class="form-section">
                    <h2>Register</h2>
                    <form id="registrationForm" method="post" action="server.php">
                        <?php if (!empty($errorMsg2)) : ?>
                            <div class="alert alert-danger">
                                <p><?php echo htmlspecialchars($errorMsg2); ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control custom-shadow" id="registerName" name="name" value="<?php echo htmlspecialchars($name); ?>" placeholder="Name" required />
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control custom-shadow" id="registerUsername" name="username" value="<?php echo htmlspecialchars($username); ?>" placeholder="Username" required />
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control custom-shadow" id="registerEmail" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Email address" required />
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control custom-shadow" id="registerPassword" name="password" placeholder="Password" required />
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('registerPassword')">Show/Hide</button>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control custom-shadow" id="registerRePassword" name="repassword" placeholder="Retype Password" required />
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('registerRePassword')">Show/Hide</button>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                            <input type="text" class="form-control custom-shadow" id="registerContactNo" name="contact_no" value="<?php echo htmlspecialchars($contactNo); ?>" placeholder="Contact no." required />
                        </div>
                        <div class="form-group mb-3">
                            <label>Gender</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="genderMale" value="male" required>
                                    <label class="form-check-label" for="genderMale">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="female" required>
                                    <label class="form-check-label" for="genderFemale">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="genderOther" value="other" required>
                                    <label class="form-check-label" for="genderOther">Other</label>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                            <input type="date" class="form-control custom-shadow" id="registerBirthdate" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" required />
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-house"></i></span>
                            <input type="text" class="form-control custom-shadow" id="registerAddress" name="address" value="<?php echo htmlspecialchars($address); ?>" placeholder="Address" required />
                        </div>
                        <div class="form-group mb-3">
                            <label>Usertype</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="usertype" id="registerFreelancer" value="freelancer" required>
                                    <label class="form-check-label" for="registerFreelancer">Freelancer</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="usertype" id="registerEmployer" value="employer" required>
                                    <label class="form-check-label" for="registerEmployer">Employer</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="register" class="btn btn-success w-100">Sign up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="row">
            <div class="col-lg-3">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#loginSection">Login</a></li>
                    <li><a href="#registerSection">Register</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h5>Contact Us</h5>
                <p>Email: info@flexihire.com</p>
                <p>Phone: +1 234 567 890</p>
            </div>
            <div class="col-lg-6">
                <h5>About FlexiHire</h5>
                <p>FlexiHire is a platform connecting freelancers and employers. We aim to provide a seamless experience for job seekers and recruiters alike.</p>
            </div>
        </div>
        <p class="mt-3">&copy; 2024 FlexiHire. All rights reserved.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
            loginForm.addEventListener('submit', function(event) {
                const username = document.getElementById('loginUsername').value;
                const password = document.getElementById('loginPassword').value;
                if (!username || !password) {
                    event.preventDefault();
                    alert('Please fill out all fields in the login form.');
                }
            });

            const registrationForm = document.getElementById('registrationForm');
            registrationForm.addEventListener('submit', function(event) {
                const name = document.getElementById('registerName').value;
                const username = document.getElementById('registerUsername').value;
                const email = document.getElementById('registerEmail').value;
                const password = document.getElementById('registerPassword').value;
                const repassword = document.getElementById('registerRePassword').value;
                if (!name || !username || !email || !password || !repassword) {
                    event.preventDefault();
                    alert('Please fill out all fields in the registration form.');
                } else if (password !== repassword) {
                    event.preventDefault();
                    alert('Passwords do not match.');
                }
            });
        });

        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }
    </script>
</body>

</html>