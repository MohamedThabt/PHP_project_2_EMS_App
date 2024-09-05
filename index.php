<?php
session_start();



$connect = mysqli_connect('localhost','root','','ems');

// check connection 
if(!$connect){
    echo "connection faild" . mysqli_connect_error($connect);
}
  //  view data (tasks)
  $sql = "SELECT id, name, email, phone FROM employee";

$result= mysqli_query($connect,$sql);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="Assets/style.css">
    <link rel="shortcut icon" href="Assets/management.png" type="image/x-icon">
      <script>
        function showAlert(message, type) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `custom-alert custom-alert-${type} alert alert-dismissible fade`;
            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
            document.body.appendChild(alertDiv);

            // Trigger reflow to enable transition
            alertDiv.offsetHeight;

            alertDiv.classList.add('show');

            setTimeout(() => {
                alertDiv.classList.remove('show');
                setTimeout(() => {
                    alertDiv.remove();
                }, 300);
            }, 2000);
        }

        window.onload = function() {
            <?php // you can add name of user in alert
            if (isset($_SESSION['add'])) {
                echo "showAlert('" . addslashes($_SESSION['add']) . "', 'primary');";
                unset($_SESSION['add']);
            }
            if (isset($_SESSION['delete'])) {
                echo "showAlert('" . addslashes($_SESSION['delete']) . "', 'danger');";
                unset($_SESSION['delete']);
            }
            if (isset($_SESSION['update'])) {
                echo "showAlert('" . addslashes($_SESSION['update']) . "', 'success');";
                unset($_SESSION['update']);
            }
            ?>
        };
    </script>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="fas fa-cogs"></i> System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#addEmployeeModal"><i class="fas fa-user-plus"></i> Add Employee</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php if (isset($_SESSION['add'])): ?>
        <div class="alert alert-primary text-center" role="alert">
            <?php echo $_SESSION['add']; ?>
        </div>
        <?php unset($_SESSION['add']); // Clear the message after displaying ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['delete'])): ?>
        <div class="alert alert-danger text-center" role="alert">
            <?php echo $_SESSION['delete']; ?>
        </div>
        <?php unset($_SESSION['delete']); // Clear the message after displaying ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['update'])): ?>
        <div class="alert alert-success text-center" role="alert">
            <?php echo $_SESSION['update']; ?>
        </div>
        <?php unset($_SESSION['update']); // Clear the message after displaying ?>
    <?php endif; ?>
    <!-- Content Section -->
    <div class="content container">
        <h1 class="text-center mb-4">Employee Management</h1>

        <!-- Employee Table -->
        <div class="container mt-5">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $counter = 1;
                    while($row = mysqli_fetch_assoc($result)):
                    ?>
                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td><?php echo ($row['name']); ?></td>
                        <td><?php echo ($row['email']); ?></td>
                        <td><?php echo ($row['phone']); ?></td>
                        <td>
                           <a href="Controller/Update.php?id=<?php echo $row['id']?>"> <button class="btn btn-primary btn-sm me-2"><i class="fas fa-edit"></i> Edit</button></a>
                           <a href="Controller/Delete.php?id=<?php echo $row['id']?>&name=<?php echo $row['name']?>">
    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
</a>

                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Add Employee Modal -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Add New Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add novalidate attribute to disable default HTML validation -->
                    <form id="addEmployeeForm" action="Controller/Store.php" method="POST" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="invalid-feedback">Please provide a name.</div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">Please provide a valid email address.</div>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                            <div class="invalid-feedback">Please provide a valid phone number.</div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name = "save">Save Employee</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Footer -->
    <footer>
        <div class="container-fluid">
            <p>Mohamed Thabet | Back-End Engineer</p>
            <div class="social-icons">
                <a href="https://github.com/MohamedThabt" target="_blank"><i class="fab fa-github"></i></a>
                <a href="https://www.linkedin.com/in/mohamed-thabet-5694462a0?lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_view_base_contact_details%3BJVmhEe2rRsGWlP7HkwKDyg%3D%3D" target="_blank"><i class="fab fa-linkedin"></i></a>
                <a href="https://x.com/Mohamed13546660/" target="_blank"><i class="fab fa-twitter"></i></a>
            </div>
            <p>&copy; 2024 Your Company. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap 5.3 JS and Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="Assets/main.js"></script>
    
</body>
</html>


