<?php include 'include/connect.php'?>
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
<div class=" container mt-4">
    <h2>Phone List</h2>
    <?php
        if(isset($_REQUEST['delID'])){
            $delID = $_REQUEST['delID'];
            $sqlDelete  = "DELETE FROM `tbl_product2` WHERE id=$delID";
            $getImage = $myCon->query("SELECT *FROM `tbl_product2` WHERE id = $delID")->fetch_assoc();
            if($getImage['image']!='no_image.png')unlink("images/".$getImage['image']);
            if($myCon->query($sqlDelete)===TRUE){
                echo'
                  <div class="alert alert-success alert-dismissible fade show" id="alert-off">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Success!</strong> Insert Data.
                  </div>
                ';
            }
            else{
                echo 'Error'.$myCon->error;
            }
          
          }
    ?>

    <table class="table  text-center border  ">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Price</th>
            <th>Brand</th>
            <th>Color</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $sqlProduct = "SELECT * FROM tbl_product2";
            $qrProduct = $myCon->query($sqlProduct);
            $i = 1;
           
                while ($rowProduct = $qrProduct->fetch_assoc()) {
                    $rBrand = $myCon->query("SELECT * FROM `tbl_brand` where id =".$rowProduct['brand_id'])->fetch_assoc();
                    $rColor = $myCon->query("SELECT * FROM `tbl_color` where id =".$rowProduct['color_id'])->fetch_assoc();
                    echo '
                        <tr class="align-middle">
                            <td>'.$i.'</td>
                            <td>'.$rowProduct['name'].'</td>
                            <td >'.$rowProduct['price'].'$</td>
                            <td>'.$rBrand['name'].'</td>
                            <td>'.$rColor['name'].'</td> 
                            <td>
                                <img src="images/'.$rowProduct['image'].'" style="height:70px"/> 
                            </td> 
                            <td>
                                <a href= "phone_add.php?pID='.$rowProduct['id'].'" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> </a>
                                <a href="#" data-href="phone_list.php?delID='.$rowProduct['id'].'"  data-bs-toggle="modal" data-bs-target="#confirmDelete" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
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
        window.location = "phone_list.php";
    });
});
</script>


    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
</body>
</html>
