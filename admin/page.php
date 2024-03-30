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
          <li><a href="prog.php"><span>Program Management</span></a></li>
          <li><a href="page.php" class="active"><span>Page Management</span></a></li>
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
              <h2 class="left">Pages</h2>
              <div class="right">
                <label for="searchInput">search</label>
                <input type="text" id="searchInput" class="field small-field" />
              </div>


            </div>
            <!-- End Box Head -->
            <!-- Table Start -->
            <div class="table">
              <table width="100%" border="0" cellspacing="0" cellpadding="0" id="PagesTable">
                <thead>
                  <tr>

                    <th>Title</th>
                    <th>Body</th>
                    <th>Page Status</th>
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
              <h2>Add New Page</h2>
            </div>
            <!-- End Box Head -->
            <form action="#" method="post">
              <!-- Form Start -->
              <div class="form-group">
                <label for="Title">Title<span></span></label>
                <input type="text" id="Title" class="field size1" required />
              </div>
              <div class="form-group">
                <label for="Body">Body<span></span></label>
                <input type="text" id="Body" class="field size1" required />
              </div>
              <div class="form-group">
                <label for="Active">Page Status</label>
                <select id="Active" name="Active" class="field size1">
                  <option value="" disabled selected>Select the Page Status</option>
                  <option value="true">Active</option>
                  <option value="false">Inactive</option>
                </select>
              </div>
              <div class="form-group">
                <label for="Priority">Priority<span></span></label>
                <input type="number" id="Priority" class="field size1" required />
              </div>
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
      const isSuperAdmin = <?php echo $sAdmin ? 'true' : 'false'; ?>;

      // Load all pages
      function loadPages() {
        $.ajax({
          url: 'http://localhost/IDS/api/page/listPages',
          method: 'GET',
          dataType: 'json',
          success: function(data) {
            renderTableData(data.pages);
          }
        });
      }

      function renderTableData(pages) {
        let rows = '';
        pages.forEach(function(page) {
          rows += `
            <tr>
                <td>${page.Title}</td>
                <td>${page.Body}</td>
                <td>${page.Active ? 'Active' : 'Inactive'}</td>
                <td>${page.Priority}</td>
                <td><a href="#" class="ico del" data-pageid="${page.PageID}">Delete</a></td>
            </tr>
          `;
        });
        $("#PagesTable tbody").html(rows);
      }

      function addPage(title, body, active, priority) {
        if (!isSuperAdmin) {
          Swal.fire('Not Authorized', 'You are not authorized to add a page.', 'warning');
          return;
        }

        $.ajax({
          url: 'http://localhost/IDS/api/page/addPage',
          method: 'POST',
          data: {
            Title: title,
            Body: body,
            Active: active,
            Priority: priority
          },
          success: function() {
            Swal.fire('Success', 'Page added successfully!', 'success');
            loadPages();
          },
          error: function() {
            Swal.fire('Error', 'Failed to add page.', 'error');
          }
        });
      }

      function deletePage(pageID) {
        if (!isSuperAdmin) {
          Swal.fire('Not Authorized', 'You are not authorized to delete this page.', 'warning');
          return;
        }

        $.ajax({
          url: 'http://localhost/IDS/api/page/deletePage',
          method: 'POST',
          data: JSON.stringify({
            PageID: pageID
          }),
          contentType: "application/json; charset=utf-8",
          dataType: "json",
          success: function() {
            Swal.fire('Deleted!', 'The page has been deleted.', 'success');
            loadPages();
          },
          error: function() {
            Swal.fire('Error', 'Failed to delete the page.', 'error');
          }
        });
      }

      $('form').on('submit', function(e) {
        e.preventDefault();
        if (!isSuperAdmin) {
                    Swal.fire({
                        icon: 'error',
                        text: 'You do not have permission to do this!'
                    });
                    return;
                }
        addPage(
          $('#Title').val(),
          $('#Body').val(),
          $('#Active').val(),
          $('#Priority').val()
        );
      });

      $("#PagesTable").on("click", ".del", function(e) {
        e.preventDefault();
        if (!isSuperAdmin) {
                    Swal.fire({
                        icon: 'error',
                        text: 'You do not have permission to do this!'
                    });
                    return;
                }
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            deletePage($(this).data("pageid"));
          }
        });
      });

      $('#searchInput').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $("#PagesTable tbody tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
      });

      loadPages();
    });
  </script>


</body>

</html>