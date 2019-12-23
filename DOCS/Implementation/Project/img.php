<?php
$uname=$_GET['varname'];
//IF THE FOLDER DOES NOT EXIST FOR RESTAURANT OWNER CREATE IT
if(!file_exists("restaurantImages/$uname")){
 mkdir("restaurantImages/$uname"); 
}
?>
<!DOCTYPE html>
<html>
<body>
<!--    UPLOAD IMAGE FORM-->
<form  action="upload.php?varname=<?php echo $uname?>" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input  type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>
        