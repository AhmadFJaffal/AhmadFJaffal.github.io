<?php session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $internID = $_SESSION['InternID'];
}
$programID = 101;  // Hardcoding the programID
$ch = curl_init();

$url = "http://localhost/IDS/api/program/getDetails"; // replace with your API endpoint

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1); // this is a POST request
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['programID' => $programID])); // Encode data
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$error = curl_error($ch);

curl_close($ch);

if ($error) {
    die("CURL Error: " . $error);
}

// Decode the JSON response to an associative array
$programDetails = json_decode($response, true);

$title = $programDetails['Title'] ?? 'N/A';  // Assuming the key is 'title' in your API's response
$description = $programDetails['Description'] ?? 'N/A'; // Same for 'description'
$startDate = $programDetails['StartDate'] ?? 'N/A';  // Assuming the key is 'start_date'
$endDate = $programDetails['EndDate'] ?? 'N/A';  // Assuming the key is 'end_date'
$maxCapacity = $programDetails['MaxCapacity'] ?? 'N/A';  // Assuming the key is 'max_capacity'
$currentCapacity = $programDetails['CurrentCapacity'] ?? 'N/A';  // Assuming the key is 'current_capacity'
// Fetch employees related to the program
$chEmp = curl_init();
$urlEmp = "http://localhost/IDS/api/program/getEmployeesByProgram?programID=" . $programID;
curl_setopt($chEmp, CURLOPT_URL, $urlEmp);
curl_setopt($chEmp, CURLOPT_RETURNTRANSFER, true);

$responseEmp = curl_exec($chEmp);
$errorEmp = curl_error($chEmp);

curl_close($chEmp);

if ($errorEmp) {
    die("CURL Error while fetching employees: " . $errorEmp);
}

// Decode the JSON response to an associative array
$employeesDetails = json_decode($responseEmp, true);
$employeeCount = count($employeesDetails);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>IDS/Programs</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="../img/logo.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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
                <img src="../img/logo.png" alt="IDS Academy Logo" class="me-3" style="width: 50px;; height:auto;">
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
                    <a href="../Profile.php" class="nav-item nav-link">Profile</a>
                <?php endif; ?>
                <!-- Dynamic links will be injected here -->
            </div>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) : ?>
                <a href="../Login/logout.php" class="btn btn-danger py-4 px-lg-5 d-none d-lg-block">Logout<i class="fa fa-arrow-right ms-3"></i></a>
            <?php else : ?>
                <a href="../Login/login.php" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Login<i class="fa fa-arrow-right ms-3"></i></a>
            <?php endif; ?>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Programs</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="../Home.php">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="../Programs.php">Internship
                                    Programs</a></li>
                            <!--<li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>-->
                            <li class="breadcrumb-item"><a class="text-white" href="fsPhp.php"><?= htmlspecialchars($title) ?> </a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="../img/php.jpeg" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">Program Overview</h6>
                    <h1 class="mb-4"><?= htmlspecialchars($title) ?></h1>
                    <p class="mb-4"><?= htmlspecialchars($description) ?>
                    </p>
                    <p class="mb-4">
                        Instructors:
                        <?php
                        if ($employeeCount > 0) :
                            $instructorNames = [];
                            foreach ($employeesDetails as $employee) :
                                $instructorNames[] = htmlspecialchars($employee['Fname']); // Adjusting to 'Fname' key.
                            endforeach;
                            echo implode(", ", $instructorNames);
                        else :
                            echo "None assigned.";
                        endif;
                        ?>
                        <br>Start Date: <?= htmlspecialchars($startDate) ?><br>
                        End Date: <?= htmlspecialchars($endDate) ?><br>
                    </p>
                    <div class="row gy-2 gx-4 mb-4">
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Max Capacity: <?= htmlspecialchars($maxCapacity) ?></p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Current Capacity: <?= htmlspecialchars($currentCapacity) ?>
                            </p>
                        </div>
                    </div>
                    <form action="http://localhost/IDS/api/intern/ProgReg" method="POST" id="registrationForm">
                        <input type="hidden" name="programID" value="101">
                        <input type="hidden" name="InternID" value="51">
                        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) : ?>
                            <input type="hidden" name="programID" value="<?= $programID ?>">
                            <input type="hidden" name="InternID" value="<?= $internID ?>">
                            <button type="button" id="applyBtn" class="btn btn-primary py-3 px-5 mt-2">Apply!</button>
                        <?php else : ?>
                            <button type="button" class="btn btn-primary py-3 px-5 mt-2">Login or Register to Apply</button>
                        <?php endif; ?>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            var programID = <?= $programID; ?>;

            // Check the program's capacity before letting the user apply.
            $.post("http://localhost/IDS/api/program/getDetails", {
                programID: programID
            }, function(response) {
                var currentCapacity = response.CurrentCapacity;
                var maxCapacity = response.MaxCapacity;

                if (currentCapacity >= maxCapacity) {
                    // Disable the apply button and change its text
                    $("#applyBtn").prop("disabled", true);
                    $("#applyBtn").text("Program is Full");
                }
            });

            $("#applyBtn").click(function(event) {
                event.stopPropagation();

                // Continue with the registration attempt
                $.post("http://localhost/IDS/api/intern/ProgReg", $("#registrationForm").serialize(), function(response) {
                    if (response.status == 'success') {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Successfully registered for the program!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    } else if (response.status == 'already_registered') {
                        Swal.fire({
                            title: 'Already Registered!',
                            text: 'You are already registered for this program!',
                            icon: 'info',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to register for the program. Please try again later.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6 col-md-6">
                    <h4 class="text-white mb-3">Quick Link</h4>
                    <a class="btn btn-link" href="../about.php">About Us</a>
                    <a class="btn btn-link" href="../contact.php">Contact Us</a>
                    <a class="btn btn-link" href="../Home.php">Privacy Policy</a>
                    <a class="btn btn-link" href="../Home.php">Terms & Condition</a>
                    <a class="btn btn-link" href="../Home.php">FAQs & Help</a>
                </div>
                <div class="col-lg-6 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Beirut, Bir Hasan, United Nations Street.
                        Al Zahraa Building. Ground Floor</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+961-01-859-501</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@ids.com.lb</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href="../Home.php"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href="../Home.php"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href="../Home.php"><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href="../Home.php"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="../Home.php">IDS Academy</a>, All Right Reserved.

                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="https://www.ids.com.lb/">IDS</a>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="../Home.php">Home</a>
                            <a href="../Home.php">Cookies</a>
                            <a href="../contact.php">Help</a>
                            <a href="../contact.php">FQAs</a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/wow/wow.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
    <script>
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
                'Home': '../Home.php',
                'About Us': '../about.php',
                'Internship Programs': '../Programs.php',
                'Contact Us': '../contact.php'
            };

            return filenameMapping[title] || '../' + title.toLowerCase().replace(/\s+/g, '') + '.php';
        }


        function getCurrentPageFilename() {
            return window.location.pathname.split('/').pop();
        }
    </script>
</body>

</html>