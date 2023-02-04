<?php

    session_start();

    if(isset($_GET['logout']))
    {
        session_destroy();

        header('Location:index.php');
    }
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="inotes";

    $conn=mysqli_connect($servername,$username,$password,$dbname);

    if(!$conn)
    {
        die("The Connection not Found" . mysqli_connect_error());
    }
    else
    {
    $delete = false;
    if(isset($_GET['delete']))
    {
        $sno = $_GET['delete'];

        $SQL = "DELETE FROM notes WHERE `notes`.`sno` = ".$sno."";
        $result = mysqli_query($conn,$SQL);
        if(!$result)
        {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Sorry</strong> notes does not deleted.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
        else
        {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Congrats!</strong> your note sucessfully Deleted.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
    }
        if(!$_SERVER['REQUEST_METHOD']=='POST')
        {
            die ("Record not Submitted");
        } 
         else
        {
            if(isset($_POST['snoEdit']))
            {
                $sno = $_POST['snoEdit'];
                $title = $_POST['titleEdit'];
                $description = $_POST['descriptionEdit'];

            
                $SQL= "UPDATE `notes` SET `Title` = '".$title."', `Description` = '".$description."' WHERE `notes`.`sno` = ".$sno." ";
                $result = mysqli_query($conn,$SQL);
                if(!$result)
                {
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>Sorry</strong> notes does not updated.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
                else
                {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>Congrats!</strong> your note sucessfully updated.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
            
            }
            elseif(isset($_POST['upload']))
            {
                $title = $_POST['title'];
                $description = $_POST['description'];

                if(!$title=="" && !$description == "")
                {
                    $SQL= "INSERT INTO `notes` (`Title`, `Description`, `Email`) VALUES ('".$title."', '".$description."', '".$_SESSION['useremail']."'); ";
                    $result = mysqli_query($conn,$SQL);
                    if(!$result)
                    {
                        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>Sorry</strong> notes does not uploaded.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    }
                    else
                    {
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>Congrats!</strong> your note sucessfully uploaded.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    }
                }
            }  
        }
        
    }
   
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iNotes</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


    <style>
        body
        {
            background-color: #d0d0d0;
        }
        #dropdown
        {
            display: inline-block;
            position: relative;
        }

        #dropdown button
        {
            border: none;
            background-color: forestgreen;
            color: white;
            font-size: 20px;
            padding: 5px 25px;
            font-weight: bold;
            font-family: Arial, Helvetica, sans-serif;

        }

        #dropdown-content
        {
            position: absolute;
            visibility:collapse;
            right: 0;
            z-index: 1000;
        }

        #dropdown-content a
        {
            display: block;
            white-space: nowrap;
            text-decoration: none;
            color: black;
            background-color: rgb(219, 219, 219);
            padding: 10px 20px;
        }

        #dropdown:hover button
        {
            background-color: darkgreen;
        }

        #dropdown:hover #dropdown-content
        {
            visibility: visible;
        }
        
        #header #dropdown-content>a:hover
        {
            background-color: #999;

        }

        #sign-up :hover
        {
            background-color:darkgrey;
        }
        
    </style>
    
   
</head>

<body>
    <!--edit modal-->
    <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editmodalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="../inotes/index.php" method="post">
                    <input type="hidden" name="snoEdit" id="snoEdit">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" id="titleEdit" name="titleEdit">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
                    </div>
                    <button type="submit" name="upload" class="btn btn-primary">Update</button>
                </form>
        
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">DiGiNoTeS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../inotes/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../inotes/about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../inotes/contact.php">Contact Us</a>
                    </li>
                </ul>
                <?php
                if (!isset($_SESSION['username'])) {
                    ?>
                <div id="sign-up" class="d-flex">
                    <button class="btn btn-outline-success" type="submit"><a href="../inotes/Authentication/login.php" onMouseOver="this.style.color='black'" onMouseOut="this.style.color='green'" style="color:green;">Sign Up</a></button>           
                </div>
                <?php
                }
                else
                {
                ?>
                <div id="dropdown">
                    <button><?php echo $_SESSION['username']?></button>
                    <div id="dropdown-content">
                        <a href="../inotes/Authentication/changepwd.php">Change Password</a>
                        <a href=" index.php?logout=true">Log Out</a>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </nav>
    <?php
        if(!isset($_SESSION['username']))
        {
    ?>
        <div class="container my-4">
            <center><h1 style="font-weight: bolder;font-size:50px">DiGiNoTeS - Your Online Diary</h1></center>
            <br>
            <center><h2 style="font-weight: bolder;">Explore Your Digital Diary</h2></center>
            <br>
        </div>

        <div class="container my-4">
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img src="../inotes/assets/theme/1.png" height="700px"width="100px" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                    <img src="../inotes/assets/theme/2.jpg" height="700px"width="100px" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                    <img src="../inotes/assets/theme/3.webp" height="700px"width="100px" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                </div>
            </div>
    <?php
        } 
        else
        {
    ?>
        <div class="container my-4">
            <center><h1 style="font-weight: bolder;font-size:50px">DiGiNoTeS - Your Online Diary</h1></center>
            <br>
            <h2 style="font-weight: bolder;">Explore Your Digital Diary</h2>
            <br>
            
            <form action="../inotes/index.php" method="post">
                <div class="mb-4">
                    <label class="form-label" style="font-weight:bolder">Title</label>
                    <input type="text" class="form-control" name="title" style="border:1px solid Grey;background-color:#EDEDED">
                </div>
                <div class="mb-3">
                    <label class="form-label" style="font-weight:bolder">Description</label>
                    <textarea class="form-control" name="description" rows="3" style="border:1px solid Grey;background-color:#EDEDED"></textarea>
                </div>
                <button type="submit" name="upload" class="btn btn-primary" style="background-color: darkslategrey;">Add Note</button>
            </form>
        </div>


        <div class="container">        
            <table class="table" id="myTable">
                <thead>
                    <tr>
                    <th scope="col">sno</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sno=0;
                    $SQL="SELECT * FROM `notes` WHERE `Email` = '".$_SESSION['useremail']."'";
                    $result= mysqli_query($conn,$SQL);
                    while($row=mysqli_fetch_assoc($result))
                    {
                        $sno=$sno+1;
                ?> 
                        
                            <tr>
                            <td scope="row"><?php echo $sno ?></td>
                            <td><?php echo $row['Title']?></td>
                            <td><?php echo $row['Description']?></td>
                            <td><button type="button" id="<?php echo $row['sno'] ?>"class="btn btn-primary btn-sm edit" data-toggle="modal" data-target="#editmodal"> Edit </button> <button type="button" id="del<?php echo $row['sno'] ?>"class="btn btn-danger btn-sm delete"> Delete </button></td>
                <?php
                    } 
                ?>
                        </tbody>
                    </table>
                
        
            
        <div class=" container md-7">
            <hr>
               <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
                <script>
                    $(document).ready( function () {
                    $('#myTable').DataTable();
                    } );
                </script>

                <script>
                    edits = document.getElementsByClassName('edit');
                    Array.from(edits).forEach((element)=>
                    {
                        element.addEventListener("click",(e)=>
                        {
                            console.log("edit", );
                            tr = e.target.parentNode.parentNode;
                            title = tr.getElementsByTagName("td")[1].innerText;
                            description = tr.getElementsByTagName("td")[2].innerText;
                            console.log(title,description);
                            titleEdit.value = title;
                            descriptionEdit.value = description;
                            snoEdit.value = e.target.id;
                            console.log(e.target.id);
                        })
                    })

                    deletes = document.getElementsByClassName('delete');
                    Array.from(deletes).forEach((element)=>
                    {
                        element.addEventListener("click",(e)=>
                        {
                            console.log("delete", );
                            tr = e.target.parentNode.parentNode;
                            sno = e.target.id.substr(3,);
                            sno.value = sno;
                            console.log(sno);

                            if(confirm("Press a button"))
                            {
                                console.log("yes");
                                window.location = `../inotes/index.php?delete=${sno}`;
                            }
                            else
                            {
                                console.log("no");
                            }
                        })
                    })
                </script>
        </div>

    </div>
    <?php
            }
        ?>

</body>

</html>