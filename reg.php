<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>FROM SUBMISSION</title>
	<style>
		error{color: blue;}
   </style>
</head>
<body>
<?php
//veriables
$fname=$lname=$gender=$DOB=$Religion=$username=$email=$password="";
$fnameErr = $lnamErr=$DOBErr=$emailErr=$genderErr=$ReligionErr=$usernameErr=$passwordErr="";
 
  if ($_SERVER["REQUEST_METHOD"] == "POST") 
  {
  if (empty($_POST["fname"])) 
  {
    $fnameErr = "Required";
  } 
  
  if (str_word_count($_POST["fname"]) > 2) 
  {
    $fnameErr = "Max 2 words only";
  } 
  else 
  {
    $fname = test_input($_POST["fname"]);
    if (!preg_match("/^[a-zA-Z-'. ]*$/",$fname)) 
    {
      $fnameErr = "Only letters and white space allowed";
      $fname = "";
    }

  }
   if (empty($_POST["lname"])) 
  {
    $lnameErr = "Required";
  } 
  
  if (str_word_count($_POST["lname"]) > 2) 
  {
    $lnameErr = "Max 2 words only";
  } 
  else 
  {
    $lname = test_input($_POST["lname"]);
    if (!preg_match("/^[a-zA-Z-'. ]*$/",$lname)) 
    {
      $lameErr = "Only letters and white space allowed";
      $lname = "";
    }

  }
  
  if (empty($_POST["email"])) 
  {
  
    $emailErr = "Required";
  } 
  else
   {
    $email = test_input($_POST["email"]);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
      $emailErr = "Invalid email format";
      $email = "";
    }
  }
    
  if (empty($_POST["gender"])) {
    $genderErr = "Required";
  } else {
    $gender = test_input($_POST["gender"]);
  }

  if (empty($_POST["DOB"])){
    $DOBErr="Required";
  }
  else {
    $DOBErr = "" ;
    $DOB = $_POST["DOB"];
  }
 
  if (($_POST['Religion'])==""){
    $ReligionErr=" requied";
  } else {
    $ReligionErr="";
    $Religion=$_POST['Religion'];
  }
  if (empty($_POST["username"])) 
  {
    $usernameErr = " required";
  } 
  
  if (str_word_count($_POST["Username"]) > 2) 
  {
    $usernameErr = "Max 2 words only";
  } 
  else 
  {
    $username = test_input($_POST["Username"]);
    if (!preg_match("/^[a-zA-Z-'. ]$/",$username)) 
    {
      $userameErr = "Only letters and white space allowed";
      $username = "";
    }

  }

  $password= $_POST["password"];
 if (strlen($password)<8)
            {
                $passwordErr="Password must not be less than eight (8) characters";
            }
           
            //data store
            if(file_exists('data.json'))  
           {  
                $current_data = file_get_contents('data.json');  
                $array_data = json_decode($current_data, true);  
                $extra = array(  
                     'fname' =>     $_POST['fname'],  
                     'lname' =>     $_POST['lname'],  
                     'email' =>     $_POST["email"],  
                     //'gender'=>   $_POST["gender"],  
                     'DOB'     =>   $_POST["DOB"],
                     'Religion' =>  $_POST["Religion"],
                     'Username' =>  $_POST["Username"],
                     'password' => $_POST["password"] 
                );  
                $array_data[] = $extra;  
                $final_data = json_encode($array_data);  
                if(file_put_contents('data.json', $final_data))  
                {  
                     $message = "<label class='text-success'>File Appended Success fully</p>";  
                }  
           }  
           else  
           {  
                $error = 'JSON File not exits';  
           }  
      
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
 ?>
	<!-- form -->
	<div align="center">

	<h1  style="color:red;"><u>Registration Form</u></h1>

	<form  method="POST" autocomplete="off" novalidate>

		<label for="fname">First Name:</label>
		<input type="text" id="fname" name="fname" value="<?php echo $fname;?>"><span class="error">*<?php echo $fnameErr;?></span>

		<br><br>

		<label for="lname">Last Name:</label>
		<input type="text" id="lname" name="lname"  value="<?php echo $lname;?>">
		<span class="error">*<?php echo $lnamErr;?></span>

		<br><br>

		<input type="radio" id="male" name="gender" value="Male">
		<label for="male">Male</label>
		
		<input type="radio" id="female" name="gender" value="female">
		<label for="female">Female</label>
		
		<input type="radio" id="other" name="gender" value="other">
		<label for="other">Other</label>
		<span class="error">*<?php echo $genderErr;?></span>

		<br><br>
		<label for="DOB">DOB</label>
		 <input type="date" name="DOB" value="<?php echo $DOB;?>">
		 <span class="error">* <?php echo $DOBErr;?></span>
		 <br><br>

		
		<label for="city">Religion:</label>
		<select id="Religion" name="Religion" value="<?php echo $Religion;?>">
			<option value="" selected></option>
			<option value="MUSLIM">MUSLIM</option>
			<option value="HINDU">HINDU</option>
			<option value="CHRISTION">CHRISTION</option>
      <option value="OTHER">OTHER</option>
		</select>
		 <span class="error">* <?php echo $ReligionErr;?></span>
		<br><br>



		<h1 align="center" style="color:red;"><u>Contact Information</u></h1>

		

		<label for="city">City:</label>
		<select id="city" name="city"> 
			<option value="" selected></option>
			<option value="Dhaka">Dhaka</option>
			<option value="Barisal">Barisal</option>
			<option value= "Cumilla">Cumilla</option>
      <option value=   "Faridpur">Faridpur</option>
      <option value="Sylhet">Sylhet</option>
		</select>

		<br><br>
		<label for="fname">Present Address:</label>
		<input type="text" id="paddress" name="paddress">

		<br><br>


		<label for="lname">Permanet Address:</label>
		<input type="text" id="peraddress" name="peraddress">

		<br><br>
		 <label for="Phone">Phone Number: </label>
		<input type="Phone" name="Phone" required="+">
		<br><br>


		<label for="email">Email:</label>
		<input type="email" id="email" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>" 
		<br><br>
		


		<h1 style="color:black"><u>Account Information:</u></h1>
		<br>
		<label for="username">Username: </label>
		<input type="text" id="Username" name="Username" value="<?php echo $username;?>">
		<span class="error">*<?php echo $usernameErr;?> </span>
		<br><br>
		<label for="password">Password: </label>
		<input type="password" id="password" name="password" valu="<?php echo $password;?>"required>
		<span class="error">*<?php echo $passwordErr;?> </span>
		<br><br>


		<input type="submit" name="submit" value="Submit">
    <a href="login.php">LogIn</a>
		
	</form>
	</div>


</body>
</html>