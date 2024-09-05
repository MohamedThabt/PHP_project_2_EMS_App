<?php
session_start();
$connect = mysqli_connect('localhost', 'root', '', 'ems');

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id =  $_GET['id'];
    $sql = "SELECT * FROM employee WHERE id = '$id'";
    $result = mysqli_query($connect, $sql);
    $employee = mysqli_fetch_assoc($result);
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $name =  $_POST['name'];
    $email = $_POST['email'];
    $phone =  $_POST['phone'];

    $sql = "UPDATE employee SET name='$name', email='$email', phone='$phone' WHERE id='$id'";
    
    if (mysqli_query($connect, $sql)) {
        $_SESSION['update'] = $name . " updated successfully";
        header("Location: ../index.php");
        exit();
    } else {
        $_SESSION['update'] = "Error updating employee: " . mysqli_error($connect);
    }
}

mysqli_close($connect);
?>

<!-- view -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/style.css">
    <link rel="shortcut icon" href="../Assets/management.png" type="image/x-icon">
</head>
<body>
    <!-- nav -->
<nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="../index.php"><i class="fas fa-cogs"></i> System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#addEmployeeModal"><i class="fas fa-user-plus"></i> Add Employee</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- form -->
    <div class="container mt-5">
        <h2>Update Employee</h2>
        <form action="Update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $employee['id']; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $employee['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $employee['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $employee['phone']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="update">Update Employee</button>
        </form>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




