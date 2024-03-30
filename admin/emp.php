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
                    <li><a href="emp.php" class="active"><span>Employee Management</span></a></li>
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
                            <h2 class="left">Employees</h2>
                            <div class="right">
                                <label for="searchInput">search</label>
                                <input type="text" id="searchInput" class="field small-field" />
                            </div>


                        </div>
                        <!-- Table Start -->
                        <div class="table">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="employeesTable">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Major</th>
                                        <th>Assigned Programs</th>
                                        <th>Creation Date</th>
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
                    <div class="box-head">
                        <h2>Assign Employee to a Program</h2>
                    </div>
                    <!-- End Box Head -->
                    <form id="assignmentForm">
                        <div class="dropdown-container">
                            <label for="employee">Employee</label>
                            <select id="Employee" name="employee">
                                <option value="" disabled selected>Select the Employee</option>
                                <!-- Dropdown options populated using JavaScript -->
                            </select>

                            <label for="program">Program</label>
                            <select id="Program" name="program">
                                <option value="" disabled selected>Select the Program</option>
                                <!-- Dropdown options populated using JavaScript -->
                            </select>

                            <!-- Submission button -->
                            <button type="submit" class="submit-button-1">Assign</button>
                        </div>
                    </form>
                    <!-- End Box -->
                    <!-- Box -->
                    <div class="box">
                        <!-- Box Head -->
                        <div class="box-head">
                            <h2>Add New Employee</h2>
                        </div>
                        <!-- End Box Head -->
                        <form id="employeeForm">
                            <!-- Full Name -->
                            <div class="form-group">
                                <label for="fName">Full Name <span></span></label>
                                <input type="text" id="fName" class="field size1" required />
                            </div>

                            <!-- Major -->
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

                            <!-- Role -->
                            <div class="form-group">
                                <label for="role">Role <span></span></label>
                                <input type="text" id="role" class="field size1" required />
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
        $(document).ready(function() {


            // Assuming PHP has echo'ed this value into the JS script
            var isSuperAdmin = <?php echo json_encode($sAdmin); ?>;

            function fetchDropdownData() {
                // Fetching employees data
                $.ajax({
                    url: 'http://localhost/IDS/api/user/list',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {

                        $.each(data, function(index, employee) {
                            $("#Employee").append(new Option(employee.Fname, employee.EmpID));
                        });
                    },
                    error: function(error) {
                        console.error("Error fetching employee data:", error);
                    }
                });

                // Fetching programs data
                $.ajax({
                    url: 'http://localhost/IDS/api/program/list',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {

                        $.each(data, function(index, program) {
                            $("#Program").append(new Option(program.Title, program.ProgID));
                        });
                    },
                    error: function(error) {
                        console.error("Error fetching program data:", error);
                    }
                });
            }
            const lookupURL = "http://localhost/IDS/api/lookup/listLookups";

            $.getJSON(lookupURL, function(data) {
                // Filter and sort majors
                let majors = data.lookupItems.filter(item => item.ParentID === 2)
                    .sort((a, b) => a.Priority - b.Priority);

                // Populate major dropdown
                majors.forEach(function(maj) {
                    $("#majorDropdown").append(`<option value="${maj.Name}">${maj.Name}</option>`);
                });
            });

            function fetchAssignedPrograms() {
                // Loop through each employee row in the table
                $("#employeesTable tbody tr").each(function(index, row) {
                    var employeeId = $(row).data("id");

                    // Make an AJAX request to fetch assigned programs for the employee
                    $.ajax({
                        url: 'http://localhost/IDS/api/user/getEmployeePrograms/' + employeeId,
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            var assignedPrograms = data.programTitles && data.programTitles.length > 0 ? data.programTitles.join(', ') : 'No assigned programs';

                            // Update the cell in the table with the assigned programs
                            $(row).find('td:eq(4)').text(assignedPrograms);
                        },
                        error: function(error) {
                            console.error("Error fetching assigned programs:", error);
                        }
                    });
                });
            }

            // Form submission logic for assignment
            $('#assignmentForm').on('submit', function(e) {
                e.preventDefault();
                if (!isSuperAdmin) {
                    Swal.fire({
                        icon: 'error',
                        text: 'You do not have permission to do this!'
                    });
                    return;
                }

                const employeeId = $('#Employee').val();
                const programId = $('#Program').val();

                $.post('http://localhost/IDS/api/program/assignEmployeeToProgram', {
                    empID: employeeId,
                    programID: programId
                }, function(response) {
                    if (response.success) {
                        // Use SweetAlert for success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Employee assigned successfully!',
                        });
                    } else {
                        // Use SweetAlert for error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to assign employee: ' + response.error,
                        });
                    }
                });
            });

            $("#searchInput").on("input", function() {
                var searchValue = $(this).val().toLowerCase();

                $("#employeesTable tbody tr").each(function() {
                    var row = $(this);
                    var nameCellText = row.find("td:eq(0)").text().toLowerCase();
                    var emailCellText = row.find("td:eq(1)").text().toLowerCase();

                    if (nameCellText.includes(searchValue) || emailCellText.includes(searchValue)) {
                        row.show();
                    } else {
                        row.hide();
                    }
                });
            });

            function fetchPrograms(callback) {
                $.ajax({
                    url: 'http://localhost/IDS/api/program/list',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        callback(null, data);
                    },
                    error: function(error) {
                        console.error("Error fetching programs:", error);
                        callback(error);
                    }
                });
            }

            fetchPrograms(function(err, programs) {
                if (!err) {
                    programs.forEach(function(program) {
                        $('.assign-program-dropdown').append($('<option>', {
                            value: program.ProgID,
                            text: program.Title
                        }));
                    });
                }
            });
            $(document).on('change', '.assign-program-dropdown', function() {


                var empID = $(this).closest("tr").data("id");
                var selectedProgramID = $(this).val();

                $.ajax({
                    url: 'http://localhost/IDS/api/employee/assignEmployeeToProgram',
                    method: 'POST',
                    data: {
                        empID: empID,
                        programID: selectedProgramID
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) { // Assuming your API sends back a 'success' attribute in the JSON response
                            Swal.fire({
                                icon: 'success',
                                text: 'Program assigned successfully!'
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: 'Failed to assign program! ' + (data.message || '')
                            });
                        }
                    },
                    error: function(error) {
                        Swal.fire({
                            icon: 'error',
                            text: 'Failed to assign program to the employee due to a technical error!'
                        });
                        console.error("Error while assigning program:", error);
                    }
                });
            });


            function deleteEmployee(empID, callback) {
                $.ajax({
                    url: 'http://localhost/IDS/api/user/deleteEmp',
                    method: 'POST',
                    data: {
                        EmpID: empID
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
                var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                return regex.test(email);
            }

            function fetchEmployees() {
                $.ajax({
                    url: 'http://localhost/IDS/api/user/list',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $("#employeesTable tbody").empty();

                        $.each(data, function(index, employee) {
                            $("#employeesTable tbody").append(
                                '<tr data-id="' + employee.EmpID + '">' +
                                '<td>' + employee.Fname + '</td>' +
                                '<td>' + employee.email + '</td>' +
                                '<td>' + employee.Role + '</td>' +
                                '<td>' + employee.Major + '</td>' +
                                '<td>Assigned Programs</td>' +
                                '<td>' + employee.CreationDate + '</td>' +
                                '<td><a href="#" class="ico del">Delete</a></td>' +
                                '</tr>'
                            );
                        });

                        // Now that we've added employees to the table, fetch their assigned programs
                        fetchAssignedPrograms();
                    },
                    error: function(error) {
                        console.error("Error fetching data:", error);
                    }
                });
            }

            $("#employeesTable").on("click", ".del", function(event) {
                event.preventDefault();
                if (!isSuperAdmin) {
                    Swal.fire({
                        icon: 'error',
                        text: 'You do not have permission to delete!'
                    });
                    return;
                }
                var row = $(this).closest("tr");
                var empID = row.data("id");

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
                        deleteEmployee(empID, function(err, response) {
                            if (err) {
                                Swal.fire({
                                    icon: 'error',
                                    text: 'Error deleting employee!'
                                });
                                console.error("Error deleting employee:", err);
                            } else {
                                row.remove();
                                Swal.fire({
                                    icon: 'success',
                                    text: 'Employee deleted successfully!'
                                });
                            }
                        });
                    }
                });
            });


            $('#employeeForm').submit(function(event) {
                event.preventDefault();

                if (!isSuperAdmin) {
                    Swal.fire({
                        icon: 'error',
                        text: 'You do not have permission to add a new employee!'
                    });
                    return;
                }

                var email = $('#email').val();
                if (!isValidEmail(email)) {
                    Swal.fire({
                        icon: 'error',
                        text: 'Invalid email format!'
                    });
                    return;
                }

                $.ajax({
                    url: 'http://localhost/IDS/api/user/addEmployee',
                    method: 'POST',
                    data: {
                        fName: $('#fName').val(),
                        email: email,
                        password: $('#password').val(),
                        role: $('#role').val(),
                        major: $('#majorDropdown').val(),
                        CreationDate: new Date().toISOString().slice(0, 10)
                    },
                    dataType: 'json',
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            text: 'Employee added successfully!'
                        });
                        $('form')[0].reset();
                        fetchEmployees();
                    },
                    error: function(error) {
                        Swal.fire({
                            icon: 'error',
                            text: 'Error adding employee! Check for Duplicate Email or other issues.'
                        });
                        console.error("Error adding employee:", error);
                    }
                });
            });
            fetchDropdownData();
            fetchEmployees();
        });
    </script>
</body>

</html>