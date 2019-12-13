<?php
$uname=$_GET['varname'];
if(!file_exists("restaurantImages/$uname")){
 mkdir("restaurantImages/$uname"); 
 echo "ADSHDSAHKHAASDJL";
}
?>
<!DOCTYPE html>
<html>
<body>
<form  action="upload.php?varname=<?php echo $uname?>" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input  type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>
        