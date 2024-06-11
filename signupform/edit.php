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
    <title>Edit Info</title>
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
<div class="container">
    <?php
        $id=$_GET['id'];
        $sql = "SELECT * FROM `crud` WHERE id=$id LIMIT 1";
        $result = mysqli_query($con,$sql);

    ?>
    <form action="" method="GET">
    <div class="inputField">
                <div>
                    <label for="readName">Name:</label>
                    <input type="text" name="readName" id="readName">
                </div>
                <div>
                    <label for="readAge">Age:</label>
                    <input type="number" name="readAge" id="readAge">
                </div>
                <div>
                    <label for="readCity">City:</label>
                    <input type="text" name="readCity" id="readCity">
                </div>
                <div>
                    <label for="readEmail">E-mail:</label>
                    <input type="email" name="readEmail" id="readEmail">
                </div>
                <div>
                    <label for="readPhone">Number:</label>
                    <input type="text" name="readPhone" minlength="11" maxlength="11">
                </div>
                <div>
                    <label for="readPost">Post:</label>
                    <input type="text" name="readPost" id="readPost">
                </div>
                <div>
                    <label for="readStartDate">Start Date:</label>
                    <input type="date" name="readStartDate" id="readStartDate">
                </div>
    </div>
    <button type="button"><a href="index.php">Close</a></button>
    <button type="submit" form="myForm" class="btn btn-primary submit" name="addUser">Update</button>
    </form>
</div>
</body>
</html>
