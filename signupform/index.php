<?php
session_start();
if(!isset($_SESSION["user"])){
    header("Location: index.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Bootstrap 5 icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <title>CRUD Operations</title>

    <link rel="stylesheet" href="index.css">
</head>
<body>
    
    <?php
        require_once('tableDbConnect.php');
        if(isset($_POST['addUser'])){
            $name = $_POST['name'];
            $age = $_POST['age'];
            $city = $_POST['city'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $post = $_POST['post'];
            $startDate = $_POST['startDate'];
            $image = $_FILES['image']['name'];
            $imageTmp = $_FILES['image']['tmp_name'];

            // Move uploaded image to the desired directory
            // move_uploaded_file($imageTmp, "uploads/$image");

            $insert_query = "INSERT INTO `employees`(picture, name, age, city, email, phone, post, start_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($con);
            $prepareStmt = mysqli_stmt_prepare($stmt, $insert_query);

            if($prepareStmt){
                mysqli_stmt_bind_param($stmt, "ssssssss", $image, $name, $age, $city, $email, $phone, $post, $startDate);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>Added Successfully</div>";
            }else{
                die("Something Went Wrong");
            }
        }
    ?>
    
    <section class="p-3">
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary newUser" data-bs-toggle="modal" data-bs-target="#userForm">New User <i class="bi bi-people"></i></button>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-hover mt-3 text-center table-bordered">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>City</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Post</th>
                            <th>Start Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once('tableDbConnect.php');
                            $sql = "SELECT * FROM `employees`";
                            $result = mysqli_query($con, $sql);
                            $sno = 1;
                            while($row = mysqli_fetch_assoc($result)){
                           
                        ?>
                        <tr>
                            <td><?php echo $sno++; ?></td>
                            <td><img src="uploads/<?php echo htmlspecialchars($row['picture']); ?>" alt="User Image" width="50" height="50"></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['age']); ?></td>
                            <td><?php echo htmlspecialchars($row['city']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['post']); ?></td>
                            <td><?php echo htmlspecialchars($row['start_date']); ?></td>
                            <td>
                                <button><a href="edit.php" class="link-dark"><i class="bi bi-pencil-square"></i></a>    </button>  
                                <a href="edit.php?id=<?php echo $row['id']?>" class="link-dark"><i class="bi bi-trash"></i></a>                         
                            </td>
                        </tr>
                        <?php  }?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Modal Form -->
    <div class="modal fade" id="userForm" tabindex="-1" aria-labelledby="userFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="userFormLabel">Fill the Form</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="index.php" id="myForm" method="POST" enctype="multipart/form-data">
                        <div class="card imgholder">
                            <label for="imgInput" class="upload">
                                <input type="file" name="image" id="imgInput" accept="image/*">
                                <i class="bi bi-plus-circle-dotted"></i>
                            </label>
                            <img src="./images/user1.jpg" alt="" width="200" height="200" class="img">
                        </div>
                        <div class="inputField">
                            <div>
                                <label for="name">Name:</label>
                                <input type="text" name="name" id="showName" required>
                            </div>
                            <div>
                                <label for="age">Age:</label>
                                <input type="number" name="age" id="showAge" required>
                            </div>
                            <div>
                                <label for="city">City:</label>
                                <input type="text" name="city" id="showCity" required>
                            </div>
                            <div>
                                <label for="email">E-mail:</label>
                                <input type="email" name="email" id="showEmail" required>
                            </div>
                            <div>
                                <label for="phone">Number:</label>
                                <input type="text" name="phone" id="showPhone" minlength="11" maxlength="11" required>
                            </div>
                            <div>
                                <label for="post">Post:</label>
                                <input type="text" name="post" id="showPost" required>
                            </div>
                            <div>
                                <label for="startDate">Start Date:</label>
                                <input type="date" name="startDate" id="showsDate" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" form="myForm" class="btn btn-primary submit" name="addUser">Add User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="app.js"></script>
</body>
</html>
