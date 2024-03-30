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
                    <li><a href="intern.php"><span>Intern Management</span></a></li>
                    <li><a href="emp.php"><span>Employee Management</span></a></li>
                    <li><a href="prog.php" class="active"><span>Program Management</span></a></li>
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
                            <h2 class="left">Programs</h2>
                            <div class="right">
                                <label for="searchInput">search</label>
                                <input type="text" id="searchInput" class="field small-field" />
                            </div>


                        </div>
                        <!-- End Box Head -->
                        <!-- Table Start -->
                        <div class="table">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="ProgTable">
                                <thead>
                                    <tr>

                                        <th>Title</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Max Capacity</th>
                                        <th>Current Capacity</th>
                                        <th>Google Classroom Code</th>
                                        <th>Assessment Exam Links</th>
                                        <th>Instructors</th>
                                        <th>Interns Joined</th>
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
                            <h2>Add New Program</h2>
                        </div>
                        <!-- End Box Head -->
                        <form id="ProgForm">
                            <!-- Full Name -->
                            <div class="form-group">
                                <label for="programTitle">Title</label>
                                <input type="text" name="programTitle" id="programTitle" class="field size1" required />
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" name="description" id="description" class="field size1" required />
                            </div>

                            <!-- Start Date -->
                            <div class="form-group">
                                <label for="startDate">Start Date</label>
                                <input type="date" name="startDate" id="startDate" class="field size1" required />
                            </div>

                            <!-- End Date -->
                            <div class="form-group">
                                <label for="endDate">End Date</label>
                                <input type="date" name="endDate" id="endDate" class="field size1" />
                            </div>

                            <!-- Max Capacity -->
                            <div class="form-group">
                                <label for="maxCapacity">Max Capacity</label>
                                <input type="number" name="maxCapacity" id="maxCapacity" class="field size1" required />
                            </div>

                            <!-- Current Capacity -->
                            <div class="form-group">
                                <label for="currentCapacity">Current Capacity</label>
                                <input type="number" name="currentCapacity" id="currentCapacity" class="field size1" required />
                            </div>

                            <!-- Google Classroom Code -->
                            <div class="form-group">
                                <label for="googleClassroomCode">Google Classroom Code</label>
                                <input type="text" name="googleClassroomCode" id="googleClassroomCode" class="field size1" required />
                            </div>

                            <!-- Assessment Exam Links -->
                            <div class="form-group">
                                <label for="examLinks">Assessment Exam Links</label>
                                <input type="text" name="examLinks" id="examLinks" class="field size1" required />
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
            $("#ProgTable tbody tr").each(function() {
                var row = $(this);
                var nameCellText = row.find("td:eq(0)").text().toLowerCase(); // Assuming the name is in the first cell

                // Check if the row's text contains the search value in the name or email columns
                if (nameCellText.includes(searchValue)) {
                    row.show(); // If it does, show this row
                } else {
                    row.hide(); // Otherwise, hide this row
                }
            });
        });
        // Call the function after you populate the table:
        $(document).ready(function() {
            var isSuperAdmin = <?php echo json_encode($sAdmin); ?>;

            function fetchAssignedInstructors() {
                // Loop through each program row in the table
                $("#ProgTable tbody tr").each(function(index, row) {
                    var progID = $(row).data("id");

                    // Make an AJAX request to fetch instructors assigned to this program
                    $.ajax({
                        url: 'http://localhost/IDS/api/program/getEmployeesByProgram?programID=' + progID,
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            var instructorNames = data.map(function(employee) {
                                return employee.Fname;
                            });

                            var instructorsText = instructorNames.length > 0 ?
                                instructorNames.join(', ') :
                                'N/A'; // Changed from 'No instructors assigned' to 'N/A'

                            $(row).find('td:eq(7)').text(instructorsText);
                        },

                        error: function(error) {
                            console.error("Error fetching instructors for program:", error);
                        }
                    });
                });
            }

            function fetchJoinedInterns() {
                // Loop through each program row in the table
                $("#ProgTable tbody tr").each(function(index, row) {
                    var progID = $(row).data("id");

                    // Make an AJAX request to fetch instructors assigned to this program
                    $.ajax({
                        url: 'http://localhost/IDS/api/intern/getInternsByProgram?programID=' + progID,
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            var internNames = data.map(function(interns) {
                                return interns.FullName;
                            });

                            var internText = internNames.length > 0 ?
                                internNames.join(', ') :
                                'N/A'; // Changed from 'No instructors assigned' to 'N/A'

                            $(row).find('td:eq(8)').text(internText);

                        },

                        error: function(error) {
                            console.error("Error fetching interns for program:", error);
                        }
                    });
                });
            }


            function fetchPrograms() {
                $.ajax({
                    url: 'http://localhost/IDS/api/program/list',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $("#ProgTable tbody").empty();
                        $.each(data, function(index, program) {
                            $("#ProgTable tbody").append(
                                '<tr data-id="' + program.ProgID + '">' +
                                '<td>' + program.Title + '</td>' +
                                '<td>' + program.StartDate + '</td>' +
                                '<td>' + program.EndDate + '</td>' +
                                '<td>' + program.MaxCapacity + '</td>' +
                                '<td>' + program.CurrentCapacity + '</td>' +
                                '<td>' + program.ClassCode + '</td>' +
                                '<td>' + program.ExamLink + '</td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td><a href="#" class="ico del">Delete</a></td>' +
                                '</tr>'
                            );
                        });
                        fetchAssignedInstructors();
                        fetchJoinedInterns();

                    },
                    error: function(error) {
                        console.error("Error fetching data:", error);
                    }
                });
            }

            function deleteProgram(progID) {
                $.ajax({
                    url: 'http://localhost/IDS/api/program/deleteProg',
                    method: 'POST',
                    data: {
                        ProgID: progID
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                text: 'Program deleted successfully!'
                            });
                            fetchPrograms();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: data.message || 'Error deleting program!'
                            });
                        }
                    },
                    error: function(error) {
                        Swal.fire({
                            icon: 'error',
                            text: 'Error deleting program!'
                        });
                    }
                });
            }
            // Handle delete program button click
            $("#ProgTable").on("click", ".del", function(event) {
                event.preventDefault();

                if (!isSuperAdmin) {
                    Swal.fire({
                        icon: 'error',
                        text: 'You do not have permission to delete!'
                    });
                    return;
                }

                var row = $(this).closest("tr");
                var progID = row.data("id");

                // Confirm before deletion
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Once deleted, you won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.value) {
                        // Only delete if the user confirms
                        deleteProgram(progID, function(err, response) {
                            if (err) {
                                console.error("Error deleting program:", err);
                                Swal.fire({
                                    icon: 'error',
                                    text: 'Error deleting the program!'
                                });
                            } else {
                                row.remove();
                                Swal.fire({
                                    icon: 'success',
                                    text: 'Program deleted successfully!'
                                });
                            }
                        });
                    }
                });
            });

            $('#ProgForm').submit(function(event) {
                event.preventDefault();

                if (!isSuperAdmin) {
                    Swal.fire({
                        icon: 'error',
                        text: 'You do not have permission to add a new program!'
                    });
                    return;
                }
                $.ajax({
                    url: 'http://localhost/IDS/api/program/addProgram',
                    method: 'POST',
                    data: {
                        title: $('#programTitle').val(),
                        description: $('#description').val(),
                        startDate: $('#startDate').val(),
                        endDate: $('#endDate').val(),
                        maxCapacity: $('#maxCapacity').val(),
                        currentCapacity: $('#currentCapacity').val(),
                        classCode: $('#googleClassroomCode').val(),
                        examLink: $('#examLinks').val(),
                    },
                    dataType: 'json',
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            text: 'Program added successfully!'
                        });
                        $('form')[0].reset();

                    },
                    error: function(error) {
                        Swal.fire({
                            icon: 'error',
                            text: 'Error adding Program!'
                        });
                        console.error("Error adding Program:", error);
                    }
                });
            });
            fetchPrograms();
        });
    </script>
</body>

</html>