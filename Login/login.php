<?php session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars(strip_tags($_POST['password']));

    // Prepare the data to send
    $data = [
        'email' => $email,
        'password' => $password
    ];

    // Set up the API endpoint
    $api_url = 'http://localhost/IDS/api/user/login';

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


    curl_close($ch);


    // Decode the response (assuming your API sends back JSON)
    $result = json_decode($response, true);

    if (isset($result['status']) && isset($result['userType'])) {
        if ($result['status'] === 'success') {
            if ($result['userType'] === 'employee') {
                // For employees, you can redirect to a different page, e.g., admin.html
                session_start();
                // Check if the employee is a super admin and set a session variable accordingly
                $_SESSION['SuperAdmin'] = $result['SuperAdmin'];
                $_SESSION['EmpName'] = $result['EmpName'];
                $_SESSION['EmpID'] = $result['EmpID'];
                header('Location: ../admin/intern.php');
                exit();
            } elseif ($result['userType'] === 'interns') {
                // Set a session variable to store the intern's name
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['InternID'] = $result['InternID'];
                $_SESSION['FullName'] = $result['FullName'];
                $_SESSION['FullName'] = $result['FullName'];
                $_SESSION['Email'] = $result['Email'];
                $_SESSION['Mobile'] = $result['Mobile'];
                $_SESSION['GradDate'] = $result['GradDate'];
                $_SESSION['University'] = $result['University'];
                $_SESSION['Major'] = $result['Major'];


                // Redirect the intern to the home page (index.php) or any other desired page
                header('Location: ../Profile.php');
                exit();
            }
        } else {
            $errorMessage = $result['message'];
        }
    } else {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid Email or Password',
                    confirmButtonText: 'Try again'
                });
            });
        </script>
        ";
    }
}
?>
<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>IDS/login</title>
    <link rel="stylesheet" href="login.css">
    <link href="../img/logo.png" rel="icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>

    <div class="wrapper">
        <!-- Login Form -->
        <div id="Form">
            <div class="title">
                Login Form
            </div>
            <?php if (isset($errorMessage)) : ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '<?php echo $errorMessage; ?>',
                        confirmButtonText: 'Try again'
                    });
                </script>
            <?php endif; ?>
            <form action="login.php" method="post" id="loginForm">

                <div class="field">
                    <input type="text" name='email' required>
                    <label>Email Address</label>
                </div>
                <div class="field">
                    <input type="password" name='password' required>
                    <label>Password</label>
                </div>
                <div class="content">
                </div>
                <div class="field">
                    <input type="submit" value="Login">
                </div>
                <div class="field">
                    <a href="../Home.php" class="btn">Back</a>
                </div>
                <div class="signup-link">
                    Not a member? <a href="signUp.php" onclick="toggleForms()">Signup now</a>
                </div>
            </form>
        </div>
    </div>



</body>

</html>