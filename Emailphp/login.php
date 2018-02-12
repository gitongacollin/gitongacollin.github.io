<html>
    <head>
        <title>NETTUTS</title>
        <link href="style.css" type="text/css" rel="stylesheet"/>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="header">
            <h3>NETTUTS > Login</h3>
        </div>
        <!--end header div-->
        <!-- start wrap div-->
        <div id="wrap">
            <!--Start php code-->
            <?php
            // Establish database connection
                $con= mysqli_connect("localhost", "root", "", "registrations");
                //check connection
                if (mysqli_connect_errno()){
                    echo 'Failed to connect to mysql:' .mysqli_connect_error();
                }
                
                if(isset($_POST['name']) && !empty($_POST['name']) AND isset($_POST['password']) && !empty($_POST['password'])){
                    $username = mysqli_escape_string($con, $_POST['name']);
                    $password = mysqli_escape_string($con, md5($_POST['password']));
                    
                    $search = mysqli_query($con, "SELECT username, password, active FROM users WHERE username='".$username."' AND password='".$password."' AND active='1'") or die('connction error');
                    $match = mysqli_num_rows($search);
                    
                    if($match > 0){
                        $msg = 'Login complete! Thanks';
                        //set cookie / start Session/ start download etc...
                    } else {
                        $msg = 'Login Failed! Please make sure that you enter the correct details and that you have activated your account.';
                    }
                }
                
            ?>
            <!--Stop php code-->
            
            
            <h3> Login Form</h3>
            <p>Please enter your name and password to login</p>
            
            <?php
            if (isset($msg)){
                // check if $msg is not empty
                echo '<div class="statusmsg">'.$msg.'</div>';//Display our message and wrap it with a div with the class "statusmsg".
            }
            ?>
            <!--Start of Login form-->
            <form action="" method="post">
                <label for="name">Name:</label>
                <input type="text" name="name" value=""/>
                <label for="password">Password:</label>
                <input type="password" name="password" value=""/>
                
                <input type="submit" class="submit_button" value="Login"/>
            </form>
            <!--end of login form-->
        </div>
        <!--end of wrap div-->
    </body>
</html>