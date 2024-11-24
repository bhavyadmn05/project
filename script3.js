

document.addEventListener("DOMContentLoaded", () => {
    // Get the signup form element
    const signupForm = document.getElementById("signup-form");

    // Add event listener for form submission
    signupForm.addEventListener("submit", (e) => {
        // Prevent form submission
        e.preventDefault();

        // Get input values
        const name = document.getElementById("signup-name").value.trim();
        const email = document.getElementById("signup-email").value.trim();
        const password = document.getElementById("signup-password").value;

        // Validate Name
        if (name.length < 3) {
            alert("Name must be at least 3 characters long.");
            return;
        }

        // Validate Email
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            alert("Please enter a valid email address.");
            return;
        }

        // Validate Password (minimum 8 characters, at least one letter and one number)
        const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
        if (!passwordPattern.test(password)) {
            alert(
                "Password must be at least 8 characters long and contain at least one letter and one number."
            );
            return;
        }

        // If validation passes, submit the form
        alert("Sign Up Successful!");
        signupForm.submit();
    });
});

