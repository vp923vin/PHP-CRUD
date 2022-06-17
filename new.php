<?php
//INSERT INTO `user_info` ( `FullName`, `Email`, `Phone`, `Subject`, `YourMessage`) 
//VALUES ('', '$name', '$email', '$phone', 'subject', '$message');


$insert = false;
$update = false;
$delete = false;
// initializing  database
$severname = "localhost";
$username = "root";
$password = "";
$database = "Contactus";

// Creating connection to the database
$conn = mysqli_connect($severname, $username, $password, $database);
if (!$conn) {
    echo "Error : " . mysqli_connect_error();
}

if (!$conn) {
    die("Unable to connect due to this reason : " . mysqli_connect_error());
}
if (isset($_GET['delete'])) {
    $Sno = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `user_info` WHERE `Sno` = '$Sno' ";
    $result = mysqli_query($conn, $sql);
}

?>
<?php

// check the input field is filled and filled correctly or not 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {



    if (isset($_POST['SnoEdit'])) {
        // echo "Yes";
        // update the record
        $Sno = $_POST['SnoEdit'];
        $name = $_POST['nameEdit'];
        $email = $_POST['emailEdit'];
        $phone = $_POST['phoneEdit'];
        $subject = $_POST['subjectEdit'];
        $message = $_POST['messageEdit'];


        $sql = "UPDATE `user_info` SET `FullName` = '$name', `Email` = '$email', `Phone` = '$phone', `Subject` = '$subject', `YourMessage` = '$message' 
            WHERE `Sno` = '$Sno'; ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $update = true;
        } else {
            echo "can't Update!";
        }
    } else {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];



        $sql = "INSERT INTO `user_info` ( `FullName`, `Email`, `Phone`, `Subject`, `YourMessage`) 
            VALUES ('$name', '$email', '$phone', '$subject', '$message')";

        $result = mysqli_query($conn, $sql);
        if ($result) {
            // echo "Successfull insertion!";
            $insert = true;
        } else {
            echo "Unsuccessfull insertion due to this reason :" . mysqli_error($conn);
        }
    }
}

?>




<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Form of Customer</title>
    <!-- Bootstarp Css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- Jquery CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

</head>

<body>



    <!-- Modal -->
    <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditModalLabel">Edit Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/Php_practice/PHP_CRUD/new.php" method="post"><br>
                    <div class="modal-body">
                        <input type="hidden" name="SnoEdit" id="SnoEdit">
                        <input class="form-control " type="text" placeholder="Full Name" name="nameEdit" id="nameEdit"><br>
                        <input class="form-control " type="text" placeholder="E-mail address" name="emailEdit" id="emailEdit" pattern="[^ @]*@[^ @]*"><br>
                        <input class="form-control " type="tel" placeholder="Phone Number" name="phoneEdit" id="phoneEdit" maxlength="10" pattern="[1-9]{1}[0-9]{9}"><br>
                        <input class="form-control " type="text" placeholder="Subject" name="subjectEdit" id="subjectEdit"><br>
                        <fieldset>
                            <textarea name="messageEdit" id="messageEdit" class="form-control" placeholder="Your Message" cols="30" rows="5"></textarea><br>
                        </fieldset><br>
                        <!-- <button type="submit"class="btn btn-primary btn-lg">Add Note</button> -->
                        <!-- <input type="submit" class="btn btn-dark btn-lg"> -->
                    </div>

                    <div class="modal-footer d-block mr-auto">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="assets/img/php.png" alt="#logo" height="28px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link ">ContactUs</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- navbar ends here -->
    <?php
    if ($insert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You have entered the values and successfully saved the record.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }

    ?>
    <?php
    if ($delete) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You have deleted the record successfully!.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }

    ?>
    <?php
    if ($update) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You have updated the record successfully!.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }

    ?>




    <!-- form fields -->
    <div class="container mt-3">
        <h1>Please Fill Up the Form</h1>
        <form id="msg-sent" action="/Php_practice/PHP_CRUD/new.php" method="post"><br>

            <input class="form-control " type="text" placeholder="Full Name" name="name" id="name" required /><br>


            <input class="form-control " type="text" placeholder="E-mail address" name="email" id="email" pattern="[^ @]*@[^ @]*" required /><br>


            <input class="form-control " type="tel" placeholder="Phone Number" name="phone" id="phone" maxlength="10" pattern="[1-9]{1}[0-9]{9}" required /><br>


            <input class="form-control " type="text" placeholder="Subject" name="subject" id="subject" required /><br>


            <fieldset>
                <textarea name="message" id="message" class="form-control" required placeholder="Your Message" cols="30" rows="5"></textarea>
            </fieldset><br>
            <button type="submit" class="btn btn-primary btn-lg">Add Note</button>
            <!-- <input type="submit" class="btn btn-dark btn-lg"> -->

        </form>
    </div>

    <!-- database Stored values Are shown here -->
    <div class="container mt-5 mb-3">
        <table class="table mt-3 mb-3" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Message</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>

            <tbody>
                <?php
                $sql = "SELECT * FROM `user_info`";
                $result = mysqli_query($conn, $sql);
                $Sno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $Sno += 1;
                    echo '<tr>
                            <th scope="row">' . $Sno . '</th>
                            <td>' . $row['FullName'] . '</td>
                            <td>' . $row['Email'] . '</td>
                            <td>' . $row['Phone'] . '</td>
                            <td>' . $row['Subject'] . '</td>
                            <td>' . $row['YourMessage'] . '</td>
                            <td><button type="button" class="edit btn btn-sm btn-primary mt-1" id =' . $row['Sno'] . '>Edit</button> 
                            <button type="button" class="delete btn btn-sm btn-primary mt-1" id =d' . $row['Sno'] . '>Delete</button></td>
                            </tr>';
                }
                ?>
            </tbody>
        </table>

    </div>
    <hr>






    <!-- Bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <!-- JQuery Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.4/jquery.validate.min.js"></script>
    <script src="assets/js/form-validator.min.js"></script>
    <script src="assets/js/form-main.js"></script>
    <script src="assets/js/validation.js"></script>
    <script src="assets/js/form.js"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        edits = document.getElementsByClassName("edit");
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ", );
                tr = e.target.parentNode.parentNode.parentNode.parentNode.parentNode;
                name = tr.getElementsByTagName("td")[0].innerText;
                email = tr.getElementsByTagName("td")[1].innerText;
                phone = tr.getElementsByTagName("td")[2].innerText;
                subject = tr.getElementsByTagName("td")[3].innerText;
                message = tr.getElementsByTagName("td")[4].innerText;

                console.log(name, email, phone, subject, message);
                nameEdit.value = name;
                emailEdit.value = email;
                phoneEdit.value = phone;
                subjectEdit.value = subject;
                messageEdit.value = message;

                SnoEdit.value = e.target.id;
                console.log(e.target.id);
                $('#EditModal').modal('toggle');
            })
        })
        deletes = document.getElementsByClassName("delete");
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ", );

                Sno = e.target.id.substr(1, );
                if (confirm("Are you sure you want to delete your Note!")) {
                    console.log("Yes");
                    window.location = `/Php_practice/PHP_CRUD/new.php?delete=${Sno}`;
                } else {
                    console.log("No");
                }
            })
        })
    </script>
    <script type="text/javascript">
        setForm('msg-sent');
    </script>
</body>

</html>