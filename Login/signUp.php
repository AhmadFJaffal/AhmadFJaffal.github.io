<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="signUp.css">

    <!----===== Iconscout CSS ===== -->
    <title>IDS/Registeration</title>
    <link href="../img/logo.png" rel="icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body>
    <div class="container">
        <header>Registration</header>
        <form action="signUp.php" method="POST" enctype="multipart/form-data">
            <div class="form first">
                <div class="details personal">
                    <span class="title">Personal Details</span>
                    <div class="fields">
                        <div class="input-field">
                            <label>Email</label>
                            <input type="email" name='email' placeholder="Enter your email" required>
                        </div>
                        <div class="input-field">
                            <label>Password</label>
                            <input type="password" name='password' placeholder="Enter your password" required>
                        </div>
                        <div class="input-field">
                            <label>Confirm Password</label>
                            <input type="password" name='Cpassword' placeholder="Enter the password Again" required>
                        </div>
                        <div class="input-field">
                            <label>Full Name</label>
                            <input type="text" name='fName' placeholder="Enter your name" required>
                        </div>
                        <div class="input-field">
                            <label>Graduation Date</label>
                            <input type="date" name='GradDate' placeholder="Enter Graduation date" required>
                        </div>
                        <div class="input-field">
                            <label>Mobile Number</label>
                            <input type="number" name='mobile' placeholder="Enter mobile number" required>
                        </div>
                        <div class="input-field">
                            <label>University</label>
                            <select name='university' id='universityDropdown' placeholder="Select Your University" required>
                                <option value="" disabled selected>Select Your University</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label>Major</label>
                            <select name='major' id='majorDropdown' placeholder="Select Your Major" required>
                                <option value="" disabled selected>Select Your Major</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label for="cvUpload">CV:</label>
                            <input type="file" id="cvUpload" name="cvUpload" accept=".pdf">
                        </div>
                        <div>
                            <a href="login.php" style="display: inline-block; padding: 10px 20px; color: white; background-color: #4070f4; text-decoration: none; border-radius: 5px;">
                                Back
                            </a>
                            &nbsp; <!-- This is to give a small space between the buttons -->
                            <button style="display: inline-block; padding: 10px 20px; color: white; background-color: #4070f4; border: none; border-radius: 5px; cursor: pointer;">
                                Submit
                            </button>
                        </div>

                    </div>
                </div>

        </form> <!-- Close the form tag here -->
    </div> <!-- Close the container div tag here -->
    <!--<script src="script.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <?php
    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 2. Sanitize Inputs

        // Sanitize email
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        // Sanitize string inputs using htmlspecialchars and strip_tags
        $fName = htmlspecialchars(strip_tags($_POST['fName']));
        $university = htmlspecialchars(strip_tags($_POST['university']));
        $major = htmlspecialchars(strip_tags($_POST['major']));
        $password = htmlspecialchars(strip_tags($_POST['password']));
        $Cpassword = htmlspecialchars(strip_tags($_POST['Cpassword']));

        // Sanitize mobile number
        $mobile = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_NUMBER_INT);

        // File validation and gathering 
        $cvContent = '';
        if (isset($_FILES['cvUpload']) && $_FILES['cvUpload']['error'] == 0) {
            // Read the content of the file
            $cvContent = file_get_contents($_FILES['cvUpload']['tmp_name']);
        }
        $data = [
            'fName' => $fName,
            'password' => $password,
            'GradDate' => $_POST['GradDate'],
            'email' => $email,
            'mobile' => $mobile,
            'university' => $university,
            'major' => $major,
            'cvUpload' => $cvContent
        ];

        // Set up the API endpoint
        $api_url = 'http://localhost/IDS/api/intern/add';
        // Initialize cURL session
        $ch = curl_init($api_url);
        if ($ch === false) {
            die('Failed to initialize cURL.');
        }

        // Set the options for the cURL session
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        // Execute the cURL session and get the response
        $response = curl_exec($ch);

        // Close the cURL session
        curl_close($ch);

        if ($response === false) {
            // Handle the cURL error here
            die('Failed to get response from API.');
        }

        // Decode the response (assuming your API sends back JSON)
        $result = json_decode($response, true);

        if (isset($result['success'])) {
            echo "<script successFlag></script>";
        }
    }

    // Include the form HTML (or redirect, etc.)
    // ... your HTML form code here ...
    ?>

    <script>
        if (document.querySelector('script[successFlag]')) {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Registeration Successful!',
                showConfirmButton: false,
                timer: 2000 // 2 seconds
            }).then(() => {
                window.location.href = 'login.php';
            });
        }

        document.querySelector('form').addEventListener('submit', function(e) {
            var email = document.querySelector('[name="email"]').value;
            var password = document.querySelector('[name="password"]').value;
            var confirmPassword = document.querySelector('[name="Cpassword"]').value;
            var mobile = document.querySelector('[name="mobile"]').value;
            var gradDateInput = document.querySelector('[name="GradDate"]').value;
            var gradDate = new Date(gradDateInput);
            var today = new Date();
            today.setHours(0, 0, 0, 0); // Resets time to midnight for comparison

            if (!email.includes('@') || !email.includes('.')) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid email format!'
                });
                e.preventDefault();
                return;
            }

            if (password.length < 8 || password.length > 30) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password length should be between 8 to 30 characters!'
                });
                e.preventDefault();
                return;
            }

            if (password !== confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Passwords do not match!'
                });
                e.preventDefault();
                return;
            }

            if (!/^[0-9]{8}$/.test(mobile)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid mobile number!'
                });
                e.preventDefault();
                return;
            }


            if (gradDate <= today) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'The graduation date must be in the future!'
                });
                e.preventDefault();
            }

        });
        $(document).ready(function() {
            const lookupURL = "http://localhost/IDS/api/lookup/listLookups";

            $.getJSON(lookupURL, function(data) {
                // Filter and sort universities
                let universities = data.lookupItems.filter(item => item.ParentID === 1)
                    .sort((a, b) => a.Priority - b.Priority);

                // Populate university dropdown
                universities.forEach(function(uni) {
                    $("#universityDropdown").append(`<option value="${uni.Name}">${uni.Name}</option>`);
                });

                // Filter and sort majors
                let majors = data.lookupItems.filter(item => item.ParentID === 2)
                    .sort((a, b) => a.Priority - b.Priority);

                // Populate major dropdown
                majors.forEach(function(maj) {
                    $("#majorDropdown").append(`<option value="${maj.Name}">${maj.Name}</option>`);
                });
            });
        });
    </script>



</body>

</html>