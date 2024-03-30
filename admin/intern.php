<?php session_start();
$fullName = $_SESSION['EmpName'];
$sAdmin = $_SESSION['SuperAdmin'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>IDS/Admin</title>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <link href="../img/logo.png" rel="icon">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

  <!-- Load your stylesheet after the SweetAlert2 stylesheet -->
  <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
</head>


<body>


  <!-- Header -->
  <div id="header">
    <div class="shell">
      <!-- Logo + Top Nav -->
      <div id="top">
        <h1><a href="#">Control Panel</a></h1>
        <div id="top-navigation"> Welcome <a href="#"><strong>
              <?= $fullName ?></strong></a> <span>|</span> <a href="../Home.php">Log out</a> </div>
      </div>
      <!-- End Logo + Top Nav -->
      <!-- Main Nav -->
      <div id="navigation">
        <ul>
          <li><a href="intern.php" class="active"><span>Intern Management</span></a></li>
          <li><a href="emp.php"><span>Employee Management</span></a></li>
          <li><a href="prog.php"><span>Program Management</span></a></li>
          <li><a href="page.php"><span>Page Management</span></a></li>
          <li><a href="lookup.php"><span>Lookup Management</span></a></li>
        </ul>
      </div>
      <!-- End Main Nav -->
    </div>
  </div>
  <!-- End Header -->
  <!-- Container -->
  <div id="container">
    <div class="shell">
      <!-- Small Nav -->
      <div class="small-nav"> <a href="#">Dashboard</a>
      </div>
      <!-- End Message Error -->
      <br />
      <!-- Main -->
      <div id="main">
        <div class="cl">&nbsp;</div>
        <!-- Content -->
        <div id="content">
          <!-- Box -->
          <div class="box">
            <!-- Box Head -->
            <div class="box-head">
              <h2 class="left">Interns</h2>
              <div class="right">
                <label for="searchInput">search</label>
                <input type="text" id="searchInput" class="field small-field" />
              </div>


            </div>
            <!-- End Box Head -->
            <!-- Table Start -->
            <div class="table">
              <table width="100%" border="0" cellspacing="0" cellpadding="0" id="internsTable">
                <thead>
                  <tr>

                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Major</th>
                    <th>University</th>
                    <th>Graduation Date</th>
                    <th>Programs Joined</th>
                    <th width="110" class="ac">Content Control</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>

              <!-- Pagging -->
              <div class="pagging">
                <div class="left">Showing 1 of 1</div>
                <div class="right">
                  <a href="#">Previous</a>
                  <a href="#">Next</a>
                </div>
              </div>
              <!-- End Pagging -->
            </div>
            <!-- Table End -->

          </div>
          <!-- End Box -->
          <!-- Box -->
          <div class="box">
            <!-- Box Head -->
            <div class="box-head">
              <h2>Add New Intern</h2>
            </div>
            <!-- End Box Head -->
            <form action="#" method="post">
              <!-- Form Start -->
              <!-- Full Name -->
              <div class="form-group">
                <label for="fullName">Full Name <span></span></label>
                <input type="text" id="fullName" class="field size1" required />
              </div>

              <!-- Mobile Number -->
              <div class="form-group">
                <label for="mobileNumber">Mobile Number <span></span></label>
                <input type="tel" id="mobileNumber" class="field size1" required />
              </div>

              <!-- Graduation Date -->
              <div class="form-group">
                <label for="graduationDate">Graduation Date</label>
                <input type="date" id="graduationDate" class="field size1" />
              </div>

              <div class="form-group">
                <label for="University">University</label>
                <select id="universityDropdown" name="University" class="field size1">
                  <option value="" disabled selected>Select the University</option>
                </select>
              </div>

              <div class="form-group">
                <label for="Major">Major</label>
                <select id="majorDropdown" name="Major" class="field size1">
                  <option value="" disabled selected>Select the Major</option>
                </select>
              </div>
              <!-- Email -->
              <div class="form-group">
                <label for="email">Email <span></span></label>
                <input type="email" id="email" class="field size1" required />
              </div>

              <!-- Password -->
              <div class="form-group">
                <label for="password">Password <span></span></label>
                <input type="password" id="password" class="field size1" required />
              </div>
              <!-- Form Buttons -->
              <div class="buttons">
                <input type="submit" class="button" value="Submit" />
              </div>
            </form>
            <!-- Form End -->

          </div>
          <!-- End Box -->
        </div>
        <!-- End Content -->
        <div class="cl">&nbsp;</div>
      </div>
      <!-- Main -->
    </div>
  </div>
  <!-- End Container -->
  <!-- Footer -->
  <div id="footer">
    <div class="shell"> <span class="left">&copy;IDS Academy</span> <span class="right">All Right Reserved</span> </div>
  </div>
  <!-- End Footer -->
  <script>
    $("#searchInput").on("input", function() {
      // Get the value from the search input.
      var searchValue = $(this).val().toLowerCase();

      // Loop through all the rows of the table.
      $("#internsTable tbody tr").each(function() {
        var row = $(this);
        var nameCellText = row.find("td:eq(0)").text().toLowerCase(); // Assuming the name is in the first cell
        var emailCellText = row.find("td:eq(1)").text().toLowerCase(); // Assuming the email is in the second cell

        // Check if the row's text contains the search value in the name or email columns
        if (nameCellText.includes(searchValue) || emailCellText.includes(searchValue)) {
          row.show(); // If it does, show this row
        } else {
          row.hide(); // Otherwise, hide this row
        }
      });
    });

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

    function deleteIntern(internID, callback) {
      $.ajax({
        url: 'http://localhost/IDS/api/intern/deleteIntern', // Change this to the API endpoint for deletion
        method: 'POST',
        data: {
          InternID: internID
        },
        dataType: 'json',
        success: function(data) {
          callback(null, data);
        },
        error: function(error) {
          callback(error);
        }
      });
    }

    function isValidEmail(email) {
      var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
      return pattern.test(email);
    }

    function containsMaliciousContent(str) {
      var patterns = [/\<script\>/i, /eval\(/i, /javascript\:/i];
      for (var i = 0; i < patterns.length; i++) {
        if (patterns[i].test(str)) {
          return true;
        }
      }
      return false;
    }

    $(document).ready(function() {
      // Assuming PHP has echo'ed this value into the JS script
      var isSuperAdmin = <?php echo json_encode($sAdmin); ?>;

      function fetchInternsData() {
        $.ajax({
          url: 'http://localhost/IDS/api/intern/list',
          method: 'GET',
          dataType: 'json',
          success: function(data) {
            $("#internsTable tbody").empty();

            $.each(data, function(index, intern) {
              $("#internsTable tbody").append(
                '<tr data-id="' + intern.InternID + '">' +
                '<td><h3><a href="#">' + intern.FullName + '</a></h3></td>' +
                '<td>' + intern.Email + '</td>' +
                '<td>' + intern.Mobile + '</td>' +
                '<td>' + intern.Major + '</td>' +
                '<td>' + intern.University + '</td>' +
                '<td>' + intern.GradDate + '</td>' +
                '<td class="programsJoined">Loading...</td>' +
                '<td><a href="#" class="ico del">Delete</a></td>' +
                '</tr>'
              );

              fetchInternPrograms(intern.InternID, function(programsList) {
                $('tr[data-id="' + intern.InternID + '"] .programsJoined').text(programsList);
              });
            });
          },
          error: function(error) {
            console.error("Error fetching data:", error);
          }
        });
      }
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
      $("#internsTable").on("click", ".del", function(event) {
        event.preventDefault();

        if (!isSuperAdmin) {
          Swal.fire({
            icon: 'error',
            text: 'You do not have permission to delete!'
          });
          return;
        }

        var row = $(this).closest("tr");
        var internID = row.data("id");

        // Confirm before deletion
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, cancel!'
        }).then((result) => {
          if (result.value) {
            // Only delete if the user confirms
            deleteIntern(internID, function(err, response) {
              if (err) {
                console.error("Error deleting intern:", err);
                Swal.fire({
                  icon: 'error',
                  text: 'Error deleting intern!'
                });
              } else {
                row.remove();
                Swal.fire({
                  icon: 'success',
                  text: 'Intern deleted successfully!'
                });
              }
            });
          }
        });
      });


      fetchInternsData();
      $('form').submit(function(event) {
        event.preventDefault();

        // Do the sanitization checks here
        var email = $('#email').val();
        if (!isValidEmail(email) || containsMaliciousContent(email)) {
          Swal.fire({
            icon: 'error',
            text: 'Invalid email format or malicious content detected!'
          });
          return;
        }

        // ... (do the same for other fields)

        // Then, if all checks pass, send the data to your server using an AJAX request
        $.ajax({
          url: 'http://localhost/IDS/api/intern/add', // Set the URL to your backend API endpoint for intern registration
          method: 'POST',
          data: {
            // Include the rest of your form data here...
            fName: $('#fullName').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            mobile: $('#mobileNumber').val(),
            GradDate: $('#graduationDate').val(),
            university: $('#universityDropdown').val(),
            major: $('#majorDropdown').val(),
            // ... (other fields)
          },
          dataType: 'json',
          success: function(response) {
            Swal.fire({
              icon: 'success',
              text: 'Intern added successfully!'
            });
            $('form')[0].reset();
            fetchInternsData(); // To refresh the table with the new data
          },
          error: function(error) {
            Swal.fire({
              icon: 'error',
              text: 'Error adding intern! \n Check for Duplicate Email'
            });
            console.error("Error adding intern:", error);
          }
        });
      });
    });
  </script>
</body>

</html>