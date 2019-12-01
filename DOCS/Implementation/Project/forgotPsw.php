<link rel="stylesheet" href="style.css"></link>
<script src="scripts.js"></script>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Forgot Password</title>

</head>
<body>
    <div class="container" id="fullC">

    <div class="top">
        <button onclick="openForm2()"  id="rsignup">Restaurant Sign Up</button>
        <button onclick="openForm3()"  id="signup" >Sign Up</button>
        <button onclick="openForm()"   id="signin" >Sign In</button>         
        <a href="returnHP.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
    </div>
    <div class = "formPage" id="forgotpsw">    
    <form method="post" class="form-container" action="forgotPassword.php">
   
      
        <label for="email">Enter your e-mail</label>
            <input type="email" placeholder="E-mail" name="email" required/>
         
                 <br><br>
                 <label for="recCode">Enter your recovery code</label>
        <input type="text" placeholder="Recovery Code" name="recCode" required/>
            <br><br>
        
                 <label for="password"><b>Password</b></label>
        <input type="password" placeholder="  Enter Password" name="password" required/>
       
          <br><br>
         
          <label for="rpassword"><b>Re-Password</b></label>
        <input type="password" placeholder=" Re-enter Password" name="rpassword" required/>
           
           <br><br>
        <input type="submit" id="ca" value="Send"></input>
    </form>
</div>
 </div>
</body>


