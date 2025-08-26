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
<div class="container-fluid mt-4">
<div class="container mt-4">
  <?php
    if(isset($_REQUEST['sms'])){
      $sms = $_REQUEST['sms'];
      if($sms == 1){
        echo'
           <div class="alert alert-success alert-dismissible" id="alert-off">
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              <strong>Success!</strong> Data has been Inserted .
            </div>
        ';

      }else if($sms == 3){
        echo'
           <div class="alert alert-success alert-dismissible" id="alert-off">
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              <strong>Success!</strong> Data has been Update.
            </div>
        ';

      }else if($sms == 1){
        echo'
           <div class="alert alert-success alert-dismissible" id="alert-off">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Erorr!</strong>  Data  cannot update.
                  </div>
        ';

      }
    }
    if(isset($_REQUEST['pID'])){
      $pID = $_REQUEST['pID'];
      $frm = $myCon->query("SELECT * FROM `tbl_product2` WHERE id= $pID")->fetch_assoc();
      // var_dump($frm);
      
    }
    else{
      $frm=["id"=>"","name"=>"","price"=>"0","brand_id"=>"1","color_id"=>"1","image"=>"no_image.png" ];
    }
  
  ?>
  
    <form action="crud.php" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-8">
      <div class="col-md-12">
        <div class="mt-3">
          <label for="txtName" class="form-label">Phone Name:</label>
          <input type="hidden" class="form-control"  name="txtID" value="<?php echo $frm['id'];?>">
          <input type="text" class="form-control" id="txtName" placeholder="Enter Phone Name" name="txtName" value="<?php echo $frm['name'];?>">
        </div>
      </div> <!-- end of col -->
      <div class="col-md-12">
        <div class="mt-3">
          <label for="txtPrice" class="form-label">Price:</label>
          <input type="number" class="form-control" id="txtPrice" placeholder="Enter Phone Price" name="txtPrice" value="<?php echo $frm['price'];?>">
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <div class="mt-3">
            <label for="cboBrand" class="form-label">Brand:</label>
            <select name="cboBrand" id="cboBrand" class="form-select">
              <?php
                  $sqlBrand = "SELECT * FROM `tbl_brand`";
                  $qrBrand = $myCon->query($sqlBrand);
                  while($rowBrand = $qrBrand->fetch_assoc()){
                    if($rowBrand['id']==$frm['brand_id']) $selBrand = 'selected';
                    else $selBrand='';
                      echo'<option value="'.$rowBrand['id'].'" '.$selBrand.'> '.$rowBrand['name'].' </option>';
                  }
              ?>
            </select>
          </div>
        </div> <!-- end of col -->
        <div class="col-6">
          <div class="mt-3">
            <label for="cboColor" class="form-label">Color:</label>
            <select name="cboColor" id="cboColor" class="form-select">
            <?php
                $sqlColor = "SELECT * FROM `tbl_color`";
                $qrColor = $myCon->query($sqlColor);
                while($rowColor = $qrColor->fetch_assoc()){
                if($rowColor['id']==$frm['color_id']) $selColor = 'selected';
                else $selColor='';
                echo '<option value=" '.$rowColor['id'].'" '.$selColor.'> '.$rowColor['name'].'</option>';
                          }
            ?>
            </select>
          </div>
        </div> <!-- end of col -->
      </div> <!-- end of row -->
      <div class="col-md-12">
        <div class="mt-4">
          <?php
            if(isset($_REQUEST['pID'])){
              echo'
                <input type="submit" class=" btn btn-success" id="btnupdate" name="btnUpdate" value="Update">
                <a href = "phone_add.php" class="l btn btn-success">New </a>
              ';
            }
            else{
              echo'<input type="submit" class="form-control btn btn-success" id="btnADD" name="btnADD">';
            }
          ?>
        </div>
      </div> <!-- end of col -->
      </div>
      <div class="col-md-4">
        <div class="row">
          <div class="col-md-12 mt-1">
              <img src="images/<?php echo $frm['image'];?>" alt="" id="blah" style="width:100%"/>
          </div>
          <div class="col-md-12">
            <div class="mt-3">
              <input type="file" class="form-control"  name="txtImage" id="imgInp" accept="image/*">
            </div>
          </div>
        </div>
       
      </div> <!-- end of col -->
      
    </div><!-- end of row -->
    </form>
</div><!-- end of container -->
        
    
</div>
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>

    <script>
      imgInp.onchange =evt =>{
        const[file] = imgInp.files
        if(file){
          blah.src = URL.createObjectURL(file)
        }

      }
    </script>
</body>

</html>
