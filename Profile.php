<?php
// Assuming you've already stored the user's Gmail and Password in session variables
session_start();
$internID = $_SESSION['InternID'];
$fullName = $_SESSION['FullName'];
$mobile = $_SESSION['Mobile'];
$email = $_SESSION['Email'];
$Mobile = $_SESSION['Mobile'];
$University = $_SESSION['University'];
$GradDate = $_SESSION['GradDate'];
$Major = $_SESSION['Major'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>IDS Academy</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/logo.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->



    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="Home.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary">
                <img src="img\idsLogo.jpg" alt="IDS Academy Logo" class="me-3" style="width: 50px;; height:auto;">
                IDS Academy
            </h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0" id="dynamicNav">
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) : ?>
                    <!-- Link for the intern user type -->
                    <a href="Profile.php" class="nav-item nav-link active">Profile</a>
                <?php endif; ?>
                <!-- Dynamic links will be injected here -->
            </div>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) : ?>
                <a href="Login\logout.php" class="btn btn-danger py-4 px-lg-5 d-none d-lg-block">Logout<i class="fa fa-arrow-right ms-3"></i></a>
            <?php else : ?>
                <a href="Login\login.php" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Login<i class="fa fa-arrow-right ms-3"></i></a>
            <?php endif; ?>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Profile Section</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="Home.php">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="Profile.php">Profile</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-graduation-cap text-primary mb-4"></i>
                            <h5 class="mb-3">Name</h5>
                            <p><?= $fullName; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                            <h5 class="mb-3">Email</h5>
                            <p><?= $email; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-globe text-primary mb-4"></i>
                            <h5 class="mb-3">Mobile</h5>
                            <p><?= $mobile; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-book-open text-primary mb-4"></i>
                            <h5 class="mb-3">University</h5>
                            <p><?= $University; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-graduation-cap text-primary mb-4"></i>
                            <h5 class="mb-3">Major</h5>
                            <p><?= $Major; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-graduation-cap text-primary mb-4"></i>
                            <h5 class="mb-3">Graduation Date</h5>
                            <p><?= $GradDate; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-book text-primary mb-4"></i>
                            <h5 class="mb-3">Programs Joined</h5>
                            <p id="programsJoined"></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-book-open text-primary mb-4"></i>
                            <h5 class="mb-3">Certificate</h5>
                            <p>Click Here to Download your Certificate</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-6">

                    <h1 class="mb-4">Forgot Your Passowrd?</h1>
                    <!--<p class="mb-4">Click below to get a link by mail to change password</p>-->
                    <a class="btn btn-primary rounded-pill py-3 px-5" href="">Change Password</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6 col-md-6">
                    <h4 class="text-white mb-3">Quick Link</h4>
                    <a class="btn btn-link" href="about.php">About Us</a>
                    <a class="btn btn-link" href="contact.php">Contact Us</a>
                    <a class="btn btn-link" href="Home.php">Privacy Policy</a>
                    <a class="btn btn-link" href="Home.php">Terms & Condition</a>
                    <a class="btn btn-link" href="Home.php">FAQs & Help</a>
                </div>
                <div class="col-lg-6 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Beirut, Bir Hasan, United Nations Street.
                        Al Zahraa Building. Ground Floor</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+961-01-859-501</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@ids.com.lb</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href="Home.php"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href="Home.php"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href="Home.php"><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href="Home.php"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="Home.php">IDS Academy</a>, All Right Reserved.

                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="https://www.ids.com.lb/">IDS</a>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="Home.php">Home</a>
                            <a href="Home.php">Cookies</a>
                            <a href="contact.php">Help</a>
                            <a href="contact.php">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
        function fetchInternPrograms(internID, callback) {
            $.ajax({
                url: 'http://localhost/IDS/api/intern/programAssociations',
                method: 'POST',
                dataType: 'json',
                success: function(data) {
                    if (data && data[internID] && data[internID].length > 0) {
                        var programsList = data[internID].join(", ");
                        callback(programsList);
                    } else {
                        callback("No programs joined");
                    }
                },
                error: function(error) {
                    console.error("Error fetching programs for intern ID:", internID, error);
                    callback("Error fetching programs");
                }
            });
        }

        $(document).ready(function() {
            $.ajax({
                url: 'http://localhost/IDS/api/page/listPages',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    let links = '';

                    // Filter out inactive pages and sort by priority
                    const sortedActivePages = data.pages.filter(page => page.Active === 1).sort((a, b) => a.Priority - b.Priority);

                    // Get the current page's filename
                    const currentPageFilename = getCurrentPageFilename();

                    sortedActivePages.forEach(function(page) {
                        let href = getFilenameForPageTitle(page.Title);
                        // Add 'active' class if href matches the current page filename
                        let isActive = href === currentPageFilename ? 'active' : '';
                        links += `<a href="${href}" class="nav-item nav-link ${isActive}">${page.Title}</a>`;
                    });

                    $("#dynamicNav").append(links);
                }
            });
        });

        function getFilenameForPageTitle(title) {
            const filenameMapping = {
                'Home': 'Home.php',
                'About Us': 'about.php',
                'Internship Programs': 'Programs.php',
                'Contact Us': 'contact.php'
            };

            return filenameMapping[title] || title.toLowerCase().replace(/\s+/g, '') + '.php';
        }

        function getCurrentPageFilename() {
            return window.location.pathname.split('/').pop();
        }
        // Assuming the intern's ID is stored in a session. If not, you might need another way to fetch it.
        var internId = <?php echo json_encode($internID); ?>;

        fetchInternPrograms(internId, function(programsList) {
            $("#programsJoined").text(programsList);
        });
    </script>
</body>

</html>