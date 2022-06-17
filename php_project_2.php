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
    if(!$conn){
        die("Unable to connect due to this reason : ". mysqli_connect_error());
    }
    if(isset($_GET['delete'])){
        $Sno = $_GET['delete'];
        $delete = true;
        $sql = "DELETE FROM `saved_notes` WHERE `Sno` = '$Sno' ";
    $result = mysqli_query($conn, $sql);
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
  
       

        if(isset($_POST['SnoEdit'])){
            // echo "Yes";
            // update the record
            $Sno = $_POST['SnoEdit'];
            $Title = $_POST['TitleEdit'];
            $Description = $_POST['DescriptionEdit'];

        
            $sql = "UPDATE `saved_notes` SET `Title` = '$Title', `Description` = '$Description' 
            WHERE `Sno` = '$Sno' ";
            $result = mysqli_query($conn, $sql);
            if($result){
                $update = true;
            }else{
                echo "can't Update!";
            }
            
        
        }else{
            $Title = $_POST['Title'];
            $Description = $_POST['Description'];

        
            $sql = "INSERT INTO `saved_notes` ( `Title`, `Description`) 
            VALUES ('$Title', '$Description')";

            $result = mysqli_query($conn, $sql);
            if($result){
                // echo "Successfull insertion!";
                $insert = true;
            }else{
                echo "Unsuccessfull insertion due to this reason :" . mysqli_error($conn);
            }
        }
    }
?>
<!-- <?php     
//      if($_SERVER['REQUEST_METHOD'] = 'POST'){
//               // required variables declaration 
//      $TitleError = $DescriptionError =  "";
//      $Title = $Description =  "";
   
//      // check the input field is filled and filled correctly or not 
     
//        if (!empty($_POST['Title'])) {
        
//          $Title = $_POST['Title'];
//        } else {
//         $TitleError = "Required";
//        }
   
//        if (empty($_POST['Description'])) {
//          $DescriptionError = "Required";
//        } else {
//          $Description = $_POST['Description'];
//        }
//    }
     
?> -->


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP CRUD Operation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    
  </head>
  <body>
    

    
  <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditModal">
  Edit Modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditModalLabel">Edit Modal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="/Php_practice/PHP_CRUD/php_project_2.php" method="POST">
            <div class="modal-body">
        
                <input type="hidden" name="SnoEdit" id="SnoEdit">
                <!-- Note Title from here -->
                <div class="mb-3">
                    <label for="Title" class="form-label">Edit Note Title</label>
                    <input type="text" class="form-control" name="TitleEdit" id="TitleEdit" aria-describedby="Title">
                </div> 
                <!-- Notes description from here -->
                <div >
                    <label for="Description" class="form-label">Edit Note Description</label>
                    <div class="form-floating">
                    <textarea class="form-control" id="DescriptionEdit" name="DescriptionEdit" style="height: 100px"></textarea>  
                </div>
                
            </div>
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

            <!-- Navbar title -->
            <a class="navbar-brand" href="#">eNotes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar menu options -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">ContactUs</a>
                    </li>
                </ul>
            
                <!-- navbar Search Area and button -->
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- navbar ends here -->
    <?php
        if($insert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You have entered the values and successfully saved the record.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    
   ?>
   <?php
        if($delete){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You have deleted the record successfully!.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    
   ?>
   <?php
        if($update){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You have updated the record successfully!.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    
   ?>



     <!-- Notes Taking Form strat from Here  -->
     <div class="container mt-5">
        <h2>Take Notes to Remember</h2>

        <form id="msg-sent" action="/Php_practice/PHP_CRUD/php_project_2.php" method="POST">
            <!-- Note Title from here -->
            <div class="mb-3">
                <label for="Title" class="form-label">Note Title</label>
                <input type="text" class="form-control" required name="Title" id="Title" aria-describedby="Title" >
                
            </div> 
            <!-- Notes description from here -->
      
            <div class="mb-3">
                <label for="Title" class="form-label">Note Description</label>
                <textarea name="Description" class="form-control" id="Description" required  style="height: 100px" ></textarea> 
                
            </div> 
            <!-- submit note button  -->
            <div id="loading1"  align="center" style="display:none;"><img src="assets/img/loading.gif"/></div>
            <!-- <div id="msg" style="display: none "></div> -->
            <button type="submit"class="btn btn-primary btn-lg mt-3">Add Note</button>
        </form>
    </div>
    <!-- Form Ends here -->

    <div class="container mt-5 mb-3"> 
        <table class="table mt-3 mb-3" id="myTable">       
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM `saved_notes`";
                    $result = mysqli_query($conn, $sql);
                    $Sno = 0;
                    while($row = mysqli_fetch_assoc($result)){
                        $Sno += 1;
                        echo '<tr>
                                <th scope="row">'.$Sno.'</th>
                                <td>'. $row['Title'] .'</td>
                                <td>'. $row['Description'].'</td>
                                <td><button type="button" class="edit btn btn-sm btn-primary mt-1" id ='.$row['Sno'].'>Edit</button> 
                                <button type="button" class="delete btn btn-sm btn-primary mt-1" id =d'.$row['Sno'].'>Delete</button></td>
                            </tr>';
                    }
                ?>        
            </tbody>
        </table>

    </div>
<hr>


    <!-- Bootstrap 5.2  Script  -->
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
        $(document).ready( function () {
        $('#myTable').DataTable();
        } );
    </script>
    <script>
        edits = document.getElementsByClassName("edit");
        Array.from(edits).forEach((element)=>{
            element.addEventListener("click", (e)=>{
                console.log("edit ", );
                tr = e.target.parentNode.parentNode;
                Title = tr.getElementsByTagName("td")[0].innerText;
                Description = tr.getElementsByTagName("td")[1].innerText;
                console.log(Title, Description);
                TitleEdit.value = Title;
                DescriptionEdit.value = Description;
                SnoEdit.value = e.target.id;
                console.log(e.target.id);
                $('#EditModal').modal('toggle');
           })
        })
           deletes = document.getElementsByClassName("delete");
        Array.from(deletes).forEach((element)=>{
            element.addEventListener("click", (e)=>{
                console.log("edit ", );
               
                Sno = e.target.id.substr(1,);
                if(confirm("Are you sure you want to delete your Note!")){
                    console.log("Yes");
                    window.location = `/Php_practice/PHP_CRUD/php_project_2.php?delete=${Sno}`;
                }else{
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