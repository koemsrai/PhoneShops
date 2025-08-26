<?php
    include 'include/connect.php';
    echo '<pre>';
    var_dump ($_POST);
    echo '</pre>';
    if (isset($_POST['btnADD'])) {
        // Retrieve form data
        $phoneName = $_POST['txtName']; 
        $phonePrice = $_POST['txtPrice'];
        $brandId = $_POST['cboBrand'];
        $colorId = $_POST['cboColor'];
        $txtImage = $_FILES['txtImage']['name'];     
        $txtImageTmp = $_FILES['txtImage']['tmp_name'];
        $newImagename = date("Y_m_d_H_i_s").rand().'_'.$txtImage;
        if(!empty ($txtImage)){
            $sqlInsert = "INSERT INTO tbl_product2 (name, price, brand_id, color_id,image) VALUES ('$phoneName', '$phonePrice', '$brandId', '$colorId','$newImagename')";
            move_uploaded_file($txtImageTmp, 'images/'.$newImagename);
        }else{
            $sqlInsert = "INSERT INTO tbl_product2 (name, price, brand_id, color_id,image) VALUES ('$phoneName', '$phonePrice', '$brandId', '$colorId','no_image.png')";
        }
        //Execute the query
        if ($myCon->query($sqlInsert) === TRUE) {
            // echo "New record created successfully";
            header("Location: phone_add.php?sms=1");
        } 
        else{
            echo'error';
        }
    }

    if(isset($_REQUEST['btnUpdate'])){
        $txtID = $_REQUEST['txtID'];
        $txtName = $_REQUEST['txtName'];
        $txtPrice = $_REQUEST['txtPrice'];
        $cboBrand = $_REQUEST['cboBrand'];
        $cboColor = $_REQUEST['cboColor'];
        $txtImage = $_FILES['txtImage']['name'];
        $txtImageTmp = $_FILES['txtImage']['tmp_name'];
        $newImageName = date("Y_m_d_h_i_s").rand()."-".$txtImage;
    
        if(!empty($txtImage)){
            $sqlUpdate = "UPDATE tbl_product2 SET name='$txtName', price='$txtPrice', brand_id='$cboBrand', color_id='$cboColor',
                          image='$newImageName' WHERE id='$txtID'";
            $getImage = $myCon->query("SELECT * FROM tbl_product2 WHERE id=$txtID")->fetch_assoc();
            if($getImage['image'] != 'no-image.png') unlink("images/".$getImage['image']);
            move_uploaded_file($txtImageTmp, 'images/'.$newImageName);
        } else {
            $sqlUpdate = "UPDATE tbl_product2 SET name='$txtName', price='$txtPrice', brand_id='$cboBrand', color_id='$cboColor' WHERE id='$txtID'";
        }
    
        if($myCon->query($sqlUpdate) === TRUE){
            header("Location: phone_add.php?sms=3&pID=$txtID");
            // echo 'success';
        } else {
            header("Location: phone_add.php?sms=4&pID=$txtID");
        }
    }
?>