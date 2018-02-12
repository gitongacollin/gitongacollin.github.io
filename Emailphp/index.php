<html>
    <head>
        <title>NETTUTS</title>
        <link href="style.css" type="text/css" rel="stylesheet"/>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="header">
            <h3>NETTUTS > Sign up</h3>
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
                if(isset($_POST['name']) && !empty($_POST['name']) AND isset($_POST['email']) && !empty($_POST['email'])){
                    $name = mysqli_escape_string($con, $_POST['name']);
                    $email = mysqli_escape_string($con, $_POST['email']);
                
                    
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        //Return Error - InvalidEmail
                        $msg = 'The email you have entered is invalid, please try again.';
                    } else {
                        // Return success - Valid Email
                        $msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been sent to your email.';
                        $hash = md5(rand(0, 1000));//generate random 32 character hash and assign it to a local variable.
                        $password = md5(rand(1000, 5000));
                        $sql = "INSERT INTO users (username, password, email, hash) VALUES('$name',
                            '$password','$email','$hash')";
                        if (!mysqli_query($con, $sql)){
                            die('Error:'.mysqli_error($con));
                        }
                        $to = $email; //send email to user
                        $subject = 'Signup | Verification';//Give the Email a Subject
                        $Message = 
                                'Thanks for signing up!
                                Your account has been created, you can login with the followin credntials after you have activated by pressing the url below.
                                -------------------------------------------
                                Username:    '.$name.'
                                Password:    '.$password.'   
                                -------------------------------------------
                                Please Click this link to activate your account:
                                http://www.mywebiste.com/verify.php?email='.$email.' &hash='.$hash.'';
                        //our message above including the link
                        $headers= 'From:noreply@yourwebsite.com' . "\r\n";//set from headers
                        mail($to, $subject, $Message, $headers);// Send our email
                }
                }
            ?>
            <!--Stop php code-->
            
            
            <h3> Signup Form</h3>
            <p>Please enter your name and email address to create your account</p>
            
            <?php
            if (isset($msg)){
                // check if $msg is not empty
                echo '<div class="statusmsg">'.$msg.'</div>';//Display our message and wrap it with a div with the class "statusmsg".
            }
            ?>
            <!--Start of signup form-->
            <form action="" method="post">
                <label for="name">Name:</label>
                <input type="text" name="name" value=""/>
                <label for="email">Email:</label>
                <input type="text" name="email" value=""/>
                
                <input type="submit" class="submit_button" value="Sign up"/>
            </form>
            <!--end of sign up form-->
        </div>
        <!--end of wrap div-->
    </body>
</html>