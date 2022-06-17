<?php


$insert = false;
$update = false;
$delete = false;
// intialize database connection
$severname = "localhost";
$username = "root";
$password = "";
$database = "Notes";

// connecting to the database
$conn = mysqli_connect($severname, $username, $password, $database);

// checking database  connection i.e. it is connected or not 
if (!$conn) {
  die("Unable to connect due to this reason : " . mysqli_connect_error());
}
if (isset($_GET['delete'])) {
  $Sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `saved_notes` WHERE `Sno` = '$Sno' ";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['SnoEdit'])) {
    // echo "Yes";
    // update the record
    $Sno = $_POST['SnoEdit'];
    $Title = $_POST['TitleEdit'];
    $Description = $_POST['DescriptionEdit'];


    $sql = "UPDATE `saved_notes` SET `Title` = '$Title', `Description` = '$Description' 
            WHERE `Sno` = '$Sno' ";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $update = true;
    } else {
      echo "can't Update!";
    }
  } else {
    $Title = $_POST['Title'];
    $Description = $_POST['Description'];


    $sql = "INSERT INTO `saved_notes` ( `Title`, `Description`) 
            VALUES ('$Title', '$Description')";

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
<?php
  // required variables declaration 
  $nameError = $emailError = $phoneError = $subjectError = "";
  $name = $email = $phone = $subject = $message = "";

  // check the input field is filled and filled correctly or not 
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['name'])) {
      $nameError = "Required";
    } else {
      $name = $_POST['name'];
    }

    if (empty($_POST['email'])) {
      $emailError = "Required";
    } else {

      $email = $_POST['email'];
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format";
      }
    }

    if (empty($_POST['phone'])) {
      $phoneError = "Required";
    } else {
      $phone = $_POST['phone'];
    }

    if (empty($_POST['subject'])) {
      $subjectError = "Required";
    } else {
      $subject = $_POST['subject'];
    }

    $message = $_POST['message'];
  $sql = "INSERT INTO `contact` (`Sno`, `FullName`, `Email`, `PhoneNo`, `MessageSubject`, `Message`) 
                  VALUES ('', '$name', '$email', '$phone', '$subject', '$message')";
      $result = mysqli_query($conn, $sql);
      // check Value Insertion is  successful or not
      if ($result) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> your entry is saved into the database.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
      } else {
        //echo "Values is not Inserted successfully because this error : ". mysqli_error($conn);
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Technical Issue!</strong> your entry is not saved into the database, Please try after some time.
                "we regret the inconvenience caused"
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
      }
    
  }

?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.rtl.min.css" integrity="sha384-dc2NSrAXbAkjrdm9IYrX10fQq9SDG6Vjz7nQVKdKcJl3pC+k37e7qJR5MVSCS+wR" crossorigin="anonymous">

  <title>Php Form Validation</title>
</head>

<body>


  <!-- Navigation Bar starts from here -->
 
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
  <!-- Navbar ends here -->




  <!-- form fields -->
  <div class="container mt-3">
    <h1>Please Fill Up the Form</h1>
    <form action="php025.php" method="post"><br>

      <input class="form-control " type="text" placeholder="Full Name" name="name" required />
      <span class="text-danger">* <?php echo $nameError; ?></span><br>

      <input class="form-control " type="text" placeholder="E-mail address" name="email" pattern="[^ @]*@[^ @]*" required />
      <span class="text-danger">* <?php echo $emailError; ?></span><br>

      <input class="form-control " type="tel" placeholder="Phone Number" name="phone" maxlength="10" pattern="[1-9]{1}[0-9]{9}" required />
      <span class="text-danger">* <?php echo $phoneError; ?></span><br>

      <input class="form-control " type="text" placeholder="Subject" name="subject" required />
      <span class="text-danger">* <?php echo $subjectError; ?></span><br>

      <fieldset>
        <textarea name="message" id="message" class="form-control" placeholder="Your Message" cols="30" rows="5"></textarea>
      </fieldset><br>
      <div id="msg" style="display: none"></div>
      <input type="submit" class="btn btn-dark btn-lg">

    </form>
  </div>



  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>

</html>