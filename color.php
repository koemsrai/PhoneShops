<?php 
  include 'include/connect.php';
  //Insert Color
  if (isset($_POST['submit'])) {
    $cname = $_POST['cname']; 
    $sqlInsert = "INSERT INTO tbl_color (name) VALUES ('$cname')";

    if ($myCon->query($sqlInsert) === TRUE) {
        echo '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Success!</strong> Product added successfully.
        </div>';
    } else {
        echo '<div class="alert alert-danger">Error: ' . $myCon->error . '</div>';
    }
  }

   //   Update Color
   if(isset($_REQUEST ['ColorID'])){
    $ColorID = $_REQUEST['ColorID'];
    if(isset($_REQUEST['update'])){
        $cname = $_REQUEST['cname'];
        $sqlUpdate = "UPDATE tbl_color SET `name` = '$cname' WHERE `id` = $ColorID";
        if($myCon->query($sqlUpdate)===TRUE){
            echo'
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>Success!</strong> Updated Product.
              </div>
            ';
        }
        else{
            echo 'Error'.$myCon->error; 
        }
       
    }
    $frm = $myCon->query("SELECT * FROM `tbl_color` WHERE id= $ColorID")->fetch_assoc();
}
else{
  $frm=["name"=>"",];
}

//  Delete Color
if(isset($_REQUEST['delID'])){
  $delID = $_REQUEST['delID'];
  $sqlDelete  = "DELETE FROM `tbl_color` WHERE id=$delID";

  if($myCon->query($sqlDelete)===TRUE){
    echo'
      <div class="alert alert-success alert-dismissible fade show" id="alert-off">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Success!</strong> Delete Data.
      </div>
  ';
  }
  else{
      echo 'Error'.$myCon->error;
  }

}  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/dist/css/main.css">
    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.min.css">
</head>
<body>
    <header class="text-center">
        <h1>ប្រព័ន្ធគ្រប់គ្រង ហាងលក់ទូរស័ព្ទ</h1>
        <h2>Phone Shop Management System</h2>
        <h2 class="mt-3">Name: Yi Koemsrai</h2>
        <h4>6</h4>
    </header>
    <?php include 'include/Nav.php';?>

    <div class="container mt-5">
        <form class="row" method="POST" action="">
        <label for="name" class="col-form-label">Name:</label>
        <div class="col-xl-10 col-11">
            <input type="text" class="form-control" name="cname" placeholder="Enter brand name"  value="<?php echo $frm['name']?>">
        </div>
        <div class="col-xl-2 col-1">
            <?php
                if(isset($_REQUEST['ColorID'])){
                    echo'
                    <button type="submit" class="btn btn-success px-3" name="update">Update</button>
                    <a href="color.php"  class="btn btn-primary py-2 px-4 btn-sm">New</a>
                    ';
                }
                    else
                    echo'
                        <button type="submit" name="submit" class="btn btn-primary px-5">Submit</button>
                    ';
            ?>
                
        </div>
        </form>
        <h4 class="mb-3 mt-5 1875rem">Color List</h4>
        <table class="table table-striped  ">
        <thead">
            <tr>
            <th>No</th>
            <th>Name</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM tbl_color";
            $qr = $myCon->query($sql);
            $i = 1;
                while($row = $qr->fetch_assoc()){
                echo'
                    <tr class="align-middle">
                    <td>'.$i.'</td>
                    <td>'.$row['name'].'</td>
                    <td>
                        <a href="color.php?ColorID='.$row['id'].'" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> </a>
                        <a href="#" data-href="color.php?delID='.$row['id'].'"  data-bs-toggle="modal" data-bs-target="#confirmDelete" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                    </td>
                    </tr>
                ';
                $i++;
                }
            
            ?>
        </tbody>
        </table>
</div>
    

<div class="modal" id="confirmDelete">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Warning</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                Are you sure you want to delete this data?
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">No</button>
                <a href="#" class="btn btn-success btn-ok">Yes</a>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Set the delete URL when modal is shown
    $('#confirmDelete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    // Auto-hide alert messages
    $("#alert-off").fadeTo(1000, 500).slideUp(500, function() {
        $("#alert-off").slideUp(500);
        window.location = "color.php";
    });
});
</script>


    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
</body>
</html>