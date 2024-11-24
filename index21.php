<?php
session_start();
$username = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Literacy Training Platform</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles7.css">
    
    <style>
        /* Hide Google Translate element initially */
        #google_translate_element {
            display: none;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Digital Literacy Training</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#home" onclick="showSection('home')">Home</a>
                </li>
                <!-- Learning Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="learningDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Learning
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="learningDropdown">
                        <a class="dropdown-item" href="index1.php" onclick="showSection('skillAssessment')">Skill Assessment</a>
                        <a class="dropdown-item" href="course.html" onclick="showSection('content')">Content</a>
                        <a class="dropdown-item" href="course1.html" onclick="showSection('content')">Notes</a>
                        <a class="dropdown-item" href="pt.html" onclick="showSection('progressTracking')">Progress Tracking</a>
                    </div>
                </li>
                <!-- Hands-On Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="handsOnDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Hands-On
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="handsOnDropdown">
                        <a class="dropdown-item" href="http://localhost:3000/" onclick="showSection('quizzes')">Quizzes</a>
                        <a class="dropdown-item" href="td.html" onclick="showSection('challenges')">Strategize your work</a>
                    </div>
                </li>
                
                <!-- Accessibility Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="accessibilityDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Accessibility
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accessibilityDropdown">
                        <a class="dropdown-item" href="javascript:void(0);" onclick="showSection('multiLanguage')">Multi-Language Support</a>
                        <a class="dropdown-item" href="https://cdn.botpress.cloud/webchat/v2.2/shareable.html?configUrl=https://files.bpcontent.cloud/2024/11/18/18/20241118183539-OVX1UWN4.json" onclick="showSection('offlineSupport')">Offline Support</a>
                    </div>
                </li>
                <!-- Feedback and Support Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="feedbackSupportDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Help Desk
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="feedbackSupportDropdown">
                        <a class="dropdown-item" href="faq.html" onclick="showSection('customerService')">Frequently Asked Questions</a>
                        <a class="dropdown-item" href="fb.html" onclick="showSection('mentorship')">Feedback and Support</a>
                    </div>
                </li>
                <!-- Login and Sign Up -->
                
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        <h1>Welcome to digital literacy platform, <?php echo htmlspecialchars($username); ?>!</h1>
       
    </div>
    <div id="google_translate_element"></div>
    <!-- Main Content with Background Image -->
    <div class="main-content">
        <!-- Book Your Free Session Form -->
        
    </div>
            

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
     <!-- Google Translate Script -->
     <script type="text/javascript">
        // Initialize Google Translate
        function googleTranslateElementInit() {
            new google.translate.TranslateElement(
                {pageLanguage: 'en'},
                'google_translate_element'
            );
        }

        // Show the Google Translate widget when 'Multi-Language Support' is clicked
        function showSection(section) {
            if (section === 'multiLanguage') {
                // Show Google Translate Widget
                document.getElementById('google_translate_element').style.display = 'block';
            } else {
                // You can hide or show other sections based on the 'section' argument
                console.log(section); // For now, this just logs the section clicked
            }
        }
    </script>
    
    <!-- Google Translate API -->
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <script src="script.js"></script>
    
</body>
</html>
   