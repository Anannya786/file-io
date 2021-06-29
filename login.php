<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style> error{color=red;}</style>
    <title>Login</title>
</head>
<body>
   
   
    <?php
        $username = $password = "";
        $userErr = $passErr = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            //username validation
            $username=$_POST['username'];

            if(strlen($_POST['username'])<2)
            {
                $userErr="Username can not be less than 2 characters!";
            }
            else if (!preg_match('/[0-9A-Za-z_.-]$/',$username))
            {
                $userErr = "User Name can only contain alpha numeric characters, period, dash or 
                underscore only";
            }
            else 
            {
                $userErr="";
            }
            $password = $_POST['password'];

            //password validation
            if (strlen($password)<8)
            {
                $passErr="Password must not be less than eight (8) characters";
            }
            else if (!preg_match("/.*[@#$%]/",$password))
            {
                $passErr="Password must contain at least one of the special characters (@, #, $,
                %)";
            }
        }
        ?>
    <fieldset>
    <legend><h2>LOGIN</h2></legend>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <br>
        User Name: <input type="text" name="username" value="<?php echo $username; ?>"> <span class="error">*<?php echo $userErr; ?></span>
        <br><br>
        Password: <input type="password" name="password" value="<?php echo $password; ?>"><span class="error">* <?php echo $passErr; ?></span>
        <br><br>
        <input type="checkbox" name="remember" id="remember"> Remember Me
        <br><br>
        <input type="submit" value="Submit">
        <br><br>
        <a href="welcome.php">enter</a>
    </fieldset>
    </form>



</body>
</html>