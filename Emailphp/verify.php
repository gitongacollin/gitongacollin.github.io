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
                
                if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
                    //verify data
                    $email = mysqli_escape_string($con, $_GET['email']);//set email variable
                    $hash = mysqli_escape_string($con, $_GET['hash']);
                    
                    $search = mysqli_query($con, "SELECT email, hash, active From users WHERE email='".$email."' AND hash= '".$hash."' AND active= '0'")
                            or die('connection failed');
                    $match = mysqli_num_rows($search);
                    if($match > 0){
                        mysqli_query($con, "UPDATE users SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND active='0'") or die('connection failed');
                        echo '<div class="statusmsg">Your account has been activated, you can now login</div>';
                    }
                 else {
                    //invalid data
                    echo '<div class="statusmsg">The url is either invalid or you have activated your account.</div> ';
                } 
                
                }else {
                    //invalid approach
                    echo '<div clas="statusmsg">Invalid approach, please use the link that has been sent to your email.</div>';
                }
            ?>
            <!--Stop php code-->
            
            
            <h3> Signup Form</h3>
            <p>Please enter your name and email address to create your account</p>
            
            <?php
            if (isset($msg)){
                // check if $msg is not empty
                echo '<div class="statusmsg">'.$msg.'</div>';//Display our message and wrap itwith a div with the class "statusmsg".
            }
            ?>
            </div>
        <!--end of wrap div-->
    </body>
</html>