<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>IDS/Programs</title>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                    <a href="Profile.php" class="nav-item nav-link">Profile</a>
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
                    <h1 class="display-3 text-white animated slideInDown">Programs</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="Home.php">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="Programs.php">Internship
                                    Programs</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Internship Programs</h6>
                <h1 class="mb-5">Explore Below</h1>
            </div>
            <!-- First Row of Courses -->
            <div class="row g-4 justify-content-center mb-4">
                <!-- First Course -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="course-item bg-light">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="img\php.jpeg" alt="">
                            <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                <a href="ProgDetails/fsPhp.php" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end">Read More</a>
                            </div>
                        </div>
                        <div class="text-center p-4 pb-0">
                            <h3 class="mb-0">Full Stack-PHP</h3>
                            <h5 class="mb-4">Tech Stack: WAMP,HTML,CSS & More</h5>
                            <h7 class="mb-4">Status: Open</h7>
                        </div>
                        <div class="d-flex border-top">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>Suha Mneimneh</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>2 Months</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-user text-primary me-2"></i>30
                                Participants</small>
                            <!--<small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>Closed</small>-->
                        </div>
                    </div>
                </div>
                <!-- Second Course -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="course-item bg-light">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="img\net.jpg" alt="">
                            <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                <a href="ProgDetails/net.php" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end">Read More</a>
                            </div>
                        </div>
                        <div class="text-center p-4 pb-0">
                            <h3 class="mb-0">ASP.NET Core</h3>
                            <h5 class="mb-4">Tech Stack: C#,.NET5 & More</h5>
                            <h7 class="mb-4">Status: Closed</h7>
                        </div>
                        <div class="d-flex border-top">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>Sarah Merhi</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>2 month</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>30
                                Participants</small>
                        </div>
                    </div>
                </div>
                <!-- Third Course -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="course-item bg-light">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="img/react.jpg" alt="">
                            <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                <a href="ProgDetails/react.php" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end">Read More</a>
                            </div>
                        </div>
                        <div class="text-center p-4 pb-0">
                            <h3 class="mb-0">React.js</h3>
                            <h5 class="mb-4">Tech Stack: JavaScript & React.js</h5>
                            <h7 class="mb-4">Status: Closed</h7>
                        </div>
                        <div class="d-flex border-top">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>Sarah Merhi</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>1 month</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>30
                                Participants</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Row of Courses -->
            <div class="row g-4 justify-content-center">
                <!-- Fourth Course -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="course-item bg-light">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="img\node.jpg" alt="">
                            <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                <a href="ProgDetails/fsNode.php" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end">Read More</a>
                            </div>
                        </div>
                        <div class="text-center p-4 pb-0">
                            <h3 class="mb-0">Full Stack-Node.js</h3>
                            <h5 class="mb-4">Tech Stack: Node.js, MySQL & More</h5>
                            <h7 class="mb-4">Status: Closed</h7>
                        </div>
                        <div class="d-flex border-top">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>Hussein Jawad</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>2 month</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>30
                                Participants</small>
                        </div>
                    </div>
                </div>
                <!-- Fifth Course -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="course-item bg-light">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="img/angular.jpg" alt="">
                            <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                <a href="ProgDetails/angular.php" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end">Read More</a>
                            </div>
                        </div>
                        <div class="text-center p-4 pb-0">
                            <h3 class="mb-0">Angular</h3>
                            <h5 class="mb-4">Tech Stack: JS, TypeScript & More</h5>
                            <h7 class="mb-4">Status: Closed</h7>
                        </div>
                        <div class="d-flex border-top">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>Sarah Merhi</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>2 month</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>30
                                Participants</small>
                        </div>
                    </div>
                </div>
                <!-- Sixth Course -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="course-item bg-light">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="img/python.jpg" alt="">
                            <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                <a href="ProgDetails/python.php" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end">Read More</a>
                            </div>
                        </div>
                        <div class="text-center p-4 pb-0">
                            <h3 class="mb-0">Python</h3>
                            <h5 class="mb-4">Tech Stack: Django & Flask</h5>
                            <h7 class="mb-4">Status: Closed</h7>
                        </div>
                        <div class="d-flex border-top">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>Rabih Nehme</small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>2 month</small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>30
                                Participants</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title bg-white text-center text-primary px-3">Testimonial</h6>
                <h1 class="mb-5">Our Students Say!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="https://media.licdn.com/dms/image/D4E03AQGwTZ7FpPHLYA/profile-displayphoto-shrink_400_400/0/1692909081736?e=1700092800&v=beta&t=Hzz4-rGhAsGBFA7Aus9tLz7PiuIFSV0FqPGetsmrw_w" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Ahmad Jaffal</h5>
                    <p>Senior Computer Engineering Student</p>
                    <div class="testimonial-text bg-light text-center p-4">
                        <p class="mb-0">"This internship transformed the way I see the professional world. The hands-on
                            experience was invaluable. Highly recommend!"</p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="https://media.licdn.com/dms/image/D5603AQE48yChVzRqbw/profile-displayphoto-shrink_400_400/0/1678214681994?e=1700092800&v=beta&t=416gXKdIkfOe7Z1cviK4pl0CpUOF9FUgiyV8_YKgugQ" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Abbass Yassine</h5>
                    <p>Senior Computer Engineering Student</p>
                    <div class="testimonial-text bg-light text-center p-4">
                        <p class="mb-0">"The mentors here are incredible. They not only guided me through the projects
                            but also gave insights about the industry."</p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="data:image/jpeg;base64,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" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Mohammad Hazeem</h5>
                    <p>Junior Software Developer</p>
                    <div class="testimonial-text bg-light text-center p-4">
                        <p class="mb-0">"I always felt supported and challenged in this program. It's the perfect
                            balance for anyone looking to grow in their career."</p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="data:image/jpeg;base64,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" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Mohammad Mostafa</h5>
                    <p>Front End Developer</p>
                    <div class="testimonial-text bg-light text-center p-4">
                        <p class="mb-0">"From theory to practical application, this internship covered it all. Grateful
                            for the skills I've gained and the connections I've made."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

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
    </script>

</body>

</html>