<?php include('loginProcess.php') ?>
<html>
    <head>
    <title>Registration system PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <body>
    <div class="container" id="fullC">
        <div class="top">
            <button onclick="openForm2()"  id="rsignup">Restaurant Sign Up</button>
            <a href="signUp.php"><button  id="signup" >Sign Up</button>
                <a href="signIn.php"><button    id="signin" >Sign In</button>   </a>      
                <a href="index.php"><img src="img/LOGO.png" alt="RBS" style="width:150px"></a>
        </div>
        <div class="formArea">
            <form class="formX" method="post" action="signUp.php">
                <h1>Forgot Password</h1>
                <?php include('errors.php'); ?>
                
                <div class="input-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $email; ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required/>
                </div>
                
                <div class="input-group">
                    <button type="submit" class="btn" name="forgotSend">Send</button>
                </div>
                
            </form>
        </div>
    </div>
</body>
</html>
