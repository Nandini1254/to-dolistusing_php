<!-- INSERT INTO `notes1` (`sno`, `title`, `desc1`, `timestamp`) VALUES ('1', 'first', 'php/python notes', 'current_timestamp(6).000000'); -->
<?php
$insert=false;
$update=false;
$delete=false;
$server="localhost";
$username="root";
$pass="";
$database="notes";
$conn=mysqli_connect($server,$username,$pass,$database);
  if(!$conn)
  {
      echo "<h1>Not connected</h1>";
  }

  if($_SERVER['REQUEST_METHOD']=='POST')
  {
    if(isset($_POST['snoEdit']))
        {
          $title1=$_POST['titleEdit'];
          $desc1=$_POST['descriptionEdit'];
          $sno=$_POST['snoEdit'];
         $sql3="UPDATE `notes1` SET `title` = '$title1', `desc1` = '$desc1' WHERE `notes1`.`sno` = $sno";
          $result2 = mysqli_query($conn, $sql3);
          if($result2)
             $update=true;
        }
     else
     {
    $title=$_POST['title'];
    $desc=$_POST['desc'];
    $sql2="INSERT INTO `notes1` (`title`, `desc1`) VALUES ('$title','$desc')";
    $result1 = mysqli_query($conn, $sql2);
    if($result1)
    {
        $insert=true;
    }
  }
  }
  ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <title>cruidapp</title>

    </script>
    <style>
    .table1 {
        margin: 50px 100px;
    }
    </style>
</head>

<body>
  <!-- modal-body -->
 
   <!-- Button trigger modal -->

<!-- Modal -->

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/cruidapp/index.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="title">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="desc">Note Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div> 
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- modal-end -->
    <div class="container my-3">
        <form action="/cruidapp/index.php" method="post">
            <h1>Add notes</h1>
            <div class="form-group">
                <label for="title">Note Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp"
                    placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="desc">Description</label>
                <textarea class="form-control" id="desc" rows="3" name="desc"></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Add note</button>
        </form>
    </div>
    <div class="table1">
        <table class="table table-striped" id="myTable">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Edit</th>
                </tr>
            </thead>

            <!-------------------- select php---------------- -->
    <?php
    $sql = "SELECT * FROM `notes1`";
    $result = mysqli_query($conn, $sql);
    $sno=0;
    while($row=mysqli_fetch_assoc($result))
    {
    //echo $row['sno']." ".$row['title']."</br>";
    $sno = $sno + 1;
    echo "<tr>
    <th scope='row'>". $sno . "</th>
    <td>". $row['title'] . "</td>
    <td>". $row['desc1'] . "</td>
    <td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button>
    </tr>";
    }
    ?>
       <!---------------- end php--------------- -->
        </table>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    })
   </script>
   <script>
   edit = document.getElementsByClassName("edit");
     Array.from(edit).forEach((elements)=>{
         addEventListener("click",(E)=>{
             console.log("edit",E);
             change = E.target.parentNode.parentNode;
             title = change.getElementsByTagName("td")[0].innerText;
             description = change.getElementsByTagName("td")[1].innerText;
             console.log(title,description);
             titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = E.target.id;
    // console.log(E.target.id);
        $('#editModal').modal('toggle');
     })})
    </script>
</body>

</html>