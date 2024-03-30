<?php session_start();
$fullName = $_SESSION['EmpName'];
$sAdmin = $_SESSION['SuperAdmin'];
$EmpID = $_SESSION['EmpID'];
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
                    <li><a href="prog.php"><span>Program Management</span></a></li>
                    <li><a href="page.php"><span>Page Management</span></a></li>
                    <li><a href="lookup.php" class="active"><span>Lookup Management</span></a></li>
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
                            <h2 class="left">Lookups</h2>
                            <div class="right">
                                <label for="searchInput">search</label>
                                <input type="text" id="searchInput" class="field small-field" />
                            </div>
                        </div>
                        <!-- End Box Head -->
                        <!-- Table Start -->
                        <div class="table">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="lookupTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Code</th>
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
                            <h2>Add New Lookup</h2>
                        </div>
                        <!-- End Box Head -->
                        <form action="#" method="post">
                            <!-- Form Start -->
                            <!-- Full Name -->
                            <div class="form-group">
                                <label for="Name">Name<span></span></label>
                                <input type="text" id="Name" class="field size1" required />
                            </div>
                            <!-- Mobile Number -->
                            <!--<div class="form-group">
                                <label for="Code">Code<span></span></label>
                                <input type="number" id="Code" class="field size1" required />
                            </div>-->
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
                <div id="content">
                    <!-- Box -->
                    <div class="box">
                        <!-- Box Head -->
                        <div class="box-head">
                            <h2 class="left">Lookup Items</h2>
                            <div class="right">
                                <label for="searchInput">search</label>
                                <input type="text" id="searchInput" class="field small-field" />
                            </div>
                        </div>
                        <!-- End Box Head -->
                        <!-- Table Start -->
                        <div class="table">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="lookupItemTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Lookup Code</th>
                                        <th>Priority</th>
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
                            <h2>Add New Lookup Item</h2>
                        </div>
                        <!-- End Box Head -->
                        <form action="#" method="post">
                            <!-- Form Start -->
                            <!-- Full Name -->
                            <div class="form-group">
                                <label for="LName">Name<span></span></label>
                                <input type="text" id="LName" class="field size1" required />
                            </div>

                            <!-- Mobile Number -->
                            <!--<div class="form-group">
                                <label for="Code">Code<span></span></label>
                                <input type="number" id="LCode" class="field size1" required />
                            </div>-->

                            <!-- Graduation Date -->
                            <div class="form-group">
                                <label for="ParentId">Lookup code</label>
                                <input type="number" id="ParentId" class="field size1" />
                            </div>

                            <!-- University -->
                            <div class="form-group">
                                <label for="Priority">Priority <span></span></label>
                                <input type="number" id="Priority" class="field size1" required />
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
            </div>
            <!-- Main -->
        </div>
    </div>
    <!-- End Container -->
    <!-- Footer -->

    <!-- End Footer -->
    <script>
        $(document).ready(function() {
            // Fetch and populate Lookup Infos on page load
            $.ajax({
                url: 'http://localhost/IDS/api/lookup/listLookups',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    const lookupInfos = response.lookupInfos;
                    lookupInfos.forEach(function(info) {
                        $('#lookupTable tbody').append(
                            `<tr>
                            <td>${info.name}</td>
                            <td>${info.InfoCode}</td>
                            <td><a href="#" class="ico del" data-infocode="${info.InfoCode}">Delete</a></td> +
                        </tr>`
                        );
                    });
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong fetching the data!'
                    });
                }
            });
            $.ajax({
                url: 'http://localhost/IDS/api/lookup/listLookups', // Replace with the correct endpoint if different
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    const lookupItems = response.lookupItems; // Assuming the data returned has a key called lookupItems
                    lookupItems.forEach(function(item) {
                        $('#lookupItemTable tbody').append(
                            `<tr>
                            <td>${item.Name}</td>
                            <td>${item.ItemCode}</td>
                            <td>${item.ParentID}</td>
                            <td>${item.Priority}</td>
                            <td><a href="#" class="ico del" data-itemcode="${item.ItemCode}">Delete</a></td>
                        </tr>`
                        );
                    });
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong fetching the data for lookup items!'
                    });
                }
            });
            // Implement the "Add New Lookup" form
            $('form:first').on('submit', function(e) {
                e.preventDefault();
                
                const name = $(this).find('#Name').val();
                const EmpID = <?= $EmpID ?>;

                $.ajax({
                    url: 'http://localhost/IDS/api/lookup/addLookup',
                    method: 'POST',
                    data: {
                        name: name,
                        employeeID:EmpID
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire(
                                'Added!',
                                'Lookup has been added.',
                                'success'
                            );
                            // Refresh the table or add to the table without refreshing
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message || 'Something went wrong!'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Failed to add the lookup!'
                        });
                    }
                });
            });
            $('#lookupTable').on('click', '.ico.del', function(e) {
                e.preventDefault();
                let infoCode = $(this).data('infocode');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'http://localhost/IDS/api/lookup/deleteLookup',
                            method: 'POST',
                            dataType: 'json',
                            data: JSON.stringify({
                                infoCode: infoCode
                            }), // Sending infoCode in the request body
                            contentType: 'application/json', // Setting content type as JSON
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted',
                                        text: response.message
                                    });
                                    $(e.target).closest('tr').remove();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: response.error
                                    });
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!'
                                });
                            }
                        });
                    }
                });
            });

            $('#lookupItemTable').on('click', '.ico.del', function(e) {
                e.preventDefault();
                let itemCode = $(this).data('itemcode'); // Ensure you have a 'data-itemcode' attribute on your delete button

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'http://localhost/IDS/api/lookup/deleteLookupItem',
                            method: 'POST',
                            dataType: 'json',
                            data: JSON.stringify({
                                ItemCode: itemCode // Ensure you're using the correct capitalization as the server expects
                            }),
                            contentType: 'application/json',
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted',
                                        text: response.message
                                    });
                                    $(e.target).closest('tr').remove();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: response.error
                                    });
                                }
                            },
                            error: function(jqXHR) {
                                let errorMessage = jqXHR.responseJSON?.error || 'Something went wrong!'; // Extract the error message from the server response
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: errorMessage
                                });
                            }
                        });
                    }
                });
            });

            // Implement the "Add New Lookup Item" form
            $('form:last').on('submit', function(e) {
                e.preventDefault();
                const name = $(this).find('#LName').val();
                const parentId = $(this).find('#ParentId').val();
                const priority = $(this).find('#Priority').val();

                $.ajax({
                    url: 'http://localhost/IDS/api/lookup/addLookupItem',
                    method: 'POST',
                    data: {
                        name: name,
                        parentID: parentId,
                        priority: priority
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire(
                                'Added!',
                                'Lookup item has been added.',
                                'success'
                            );
                            // Refresh the table or add to the table without refreshing
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message || 'Something went wrong!'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Failed to add the lookup item!\nDouble Check the Lookup Code'
                        });
                    }
                });
            });

        });
    </script>
</body>

</html>