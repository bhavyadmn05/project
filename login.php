<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Digital Literacy</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Login Form -->
                <div id="login-form" class="form-container">
                    <h2 class="form-heading">Login</h2>
                    <p class="form-description">Welcome back! Please login to continue.</p>
                    <form action="login_handler.php" method="POST">
                        <div class="form-group">
                            <label for="login-email">Email</label>
                            <input type="email" id="login-email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="login-password">Password</label>
                            <input type="password" id="login-password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                        <p class="text-center mt-3">
                            Don't have an account? <a href="signup.html" class="form-link">Sign Up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Login Validation Script -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Get the login form element
            const loginForm = document.getElementById("loginForm");

            // Add event listener for form submission
            loginForm.addEventListener("submit", (e) => {
                // Prevent form submission to perform validation
                e.preventDefault();

                // Get input values
                const email = document.getElementById("login-email").value.trim();
                const password = document.getElementById("login-password").value.trim();

                let formIsValid = true;

                // Validate Email
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(email)) {
                    alert("Please enter a valid email address.");
                    formIsValid = false;
                }

                // Validate Password (just checking if it's not empty)
                if (password.length === 0) {
                    alert("Password is required.");
                    formIsValid = false;
                }

                // If all validations pass, submit the form
                if (formIsValid) {
                    loginForm.submit();  // Submit the form after validation passes
                }
            });
        });
    </script>
</body>
</html>

    
</body>
</html>
