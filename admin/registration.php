<?php
require_once './dbcon.php';
    if(isset($_POST['registration']))
    {
        $name =$_POST['name'];
        $username =$_POST['username'];
        $reg_id =$_POST['reg_id'];
        $department =$_POST['department'];
        $year =$_POST['year'];
        $semester =$_POST['semester'];
        $email =$_POST['email'];
        $password =$_POST['password'];
        $c_password =$_POST['c_password'];

        $photo = explode('.',$_FILES['photo']['name']);
        $photo = end($photo);
        $photo_name = $username.'.'.$photo;

        $input_error = array();
        if(empty($name))
        {
            $input_error['name'] = "Name Field is Required";
        }
        if(empty($username))
        {
            $input_error['username'] = "UserName Field is Required";
        }
        if(empty($reg_id))
        {
            $input_error['reg_id'] = "ID Field is Required";
        }
        if(empty($department))
        {
            $input_error['department'] = "Dept Field is Required";
        }
        if(empty($year))
        {
            $input_error['year'] = "Year Field is Required";
        }
        if(empty($semester))
        {
            $input_error['semester'] = "Semester Field is Required";
        }
        if(empty($email))
        {
            $input_error['email'] = "Email Field is Required";
        }
        if(empty($password))
        {
            $input_error['password'] = "Password Field is Required";
        }
        if(empty($c_password))
        {
            $input_error['c_password'] = "Confirm Password Field is Required";
        }

        if(count($input_error) == 0) {

            //Email Exists and Email Check


            if (!empty($link)) {
                $email_check = mysqli_query($link, "SELECT * FROM `users` WHERE `email`= '$email';");
                if (mysqli_num_rows($email_check) == 0) {

                    $username_check = mysqli_query($link, "SELECT * FROM `users` WHERE `username`= '$username';");
                    if (mysqli_num_rows($username_check) == 0) {


                        $name_check = mysqli_query($link, "SELECT * FROM `users` WHERE `name`= '$name';");
                        if (mysqli_num_rows($name_check) == 0) {

                            $reg_id_check = mysqli_query($link, "SELECT * FROM `users` WHERE `reg_id`= '$reg_id';");
                            if (mysqli_num_rows($reg_id_check) == 0) {

                                if(strlen($reg_id) == 8 ){

                                }else{
                                    $reg_id_l = "RegID should not be more than 8 digits";
                                }

                            }

                            if (strlen($name) > 8) {

                            } else {
                                $name_l = "Name should be more than 8 characters";
                            }
                        } else {
                            $name_error = "This name already Exists";
                        }

                        if (strlen($username) >= 7) {

                            if (strlen($password) > 7) {

                                if($password == $c_password){

                                }else{
                                    $password_not_matched = "Password Not Matched!";
                                }

                            } else {
                                $password_l = "Password should be more than 8 Characters";
                            }
                        } else {
                            $username_l = "Username should not be more than 8 Characters";
                        }
                    } else {
                        $username_error = "This Name Already Exists";
                    }

                } else {
                    $email_error = "This Email Address Already Exists";
                }
            }
        }
    }
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>UAP Students Management System</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="../css/animate.css"/>
    <link rel="stylesheet" type="text/css" href="style.css" media="all"/>


</head>
<body>

        <div class=" text-center container animate__animated animate__bounceInDown" >
            <h1 class="text-center">User Registration Form</h1>
            <hr/>
            <div class="row text-center">
                <div class="text-center col-md-12">
                    <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal">


                        <div class="form-group row">
                            <label for="name" class="text-center control-label col-sm-1">NAME</label>
                            <div class="col-sm-4">
                                <input class="form-control" id="name" type="text" name="name" placeholder="Enter your Name" value="<?php if(isset($name)){echo $name;} ?>"/>
                            </div>
                            <label class="error"><?php if(isset($input_error['name'])){echo $input_error['name'];} ?></label>
                            <!-- Name Exist check -->
                            <label class="error"><?php if(isset($name_error)){ echo $name_error;} ?></label>
                            <label class="error"><?php if(isset($name_l)){ echo $name_l;} ?></label>
                        </div>

                        <div class="form-group row ">
                            <label for="username" class="text-center control-label col-sm-1">USERNAME</label>
                            <div class="col-sm-4">
                                <input class="form-control" id="username" type="text" name="username" placeholder="Enter your UserName" value="<?php if(isset($username)){echo $username;} ?>"/>
                            </div>
                            <label class="error"><?php if(isset($input_error['username'])){echo $input_error['username'];} ?></label>
                            <!-- USerName Exist check -->
                            <label class="error"><?php if(isset($username_error)){ echo $username_error;} ?></label>
                            <label class="error"><?php if(isset($username_l)){ echo $username_l;} ?></label>

                        </div>

                        <div class="form-group row">
                            <label for="reg_id" class="text-center control-label col-sm-1">REG_ID</label>
                            <div class="col-sm-4">
                                <input class="form-control" id="reg_id" type="number" pattern="[0-9]{8}" name="reg_id" placeholder="Enter your Reg_ID" value="<?php if(isset($reg_id)){echo $reg_id;} ?>" />
                            </div>
                            <label class="error"><?php if(isset($input_error['reg_id'])){echo $input_error['reg_id'];} ?></label>
                            <label class="error"><?php if(isset($reg_id_l)){ echo $reg_id_l;} ?></label>
                        </div>

                        <div class="form-group row">
                            <label for="department" class="text-center control-label col-sm-1">DEPT</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="department" name="department">
                                    <option value=""> Select </option>
                                    <option value="1"> Pharmacy </option>
                                    <option value="2"> CE </option>
                                    <option value="3"> Architecture </option>
                                    <option value="4"> CSE </option>
                                    <option value="5"> EEE </option>
                                    <option value="6"> English </option>
                                    <option value="7"> BBA </option>
                                </select>
                            </div>
                            <label class="error"><?php if(isset($input_error['department'])){echo $input_error['department'];} ?></label>
                        </div>

                        <div class="form-group row">
                            <label for="year" class="text-center control-label col-sm-1">YEAR</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="year" name="year">
                                    <option value=""> Select </option>
                                    <option value="1"> 1st </option>
                                    <option value="2"> 2nd </option>
                                    <option value="3"> 3rd </option>
                                    <option value="4"> 4th </option>
                                </select>
                            </div>
                            <label class="error"><?php if(isset($input_error['year'])){echo $input_error['year'];} ?></label>
                        </div>

                        <div class="form-group row">
                            <label for="semester" class="text-center control-label col-sm-1">SEMESTER</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="semester" name="semester">
                                    <option value=""> Select </option>
                                    <option value="1"> 1st </option>
                                    <option value="2"> 2nd </option>
                                </select>

                            </div>
                            <label class="error"><?php if(isset($input_error['semester'])){echo $input_error['semester'];} ?></label>
                        </div>

                        <div class="form-group row">
                            <Label for="email" class="text-center control-label col-sm-1">E-MAIL</Label>
                            <div class="col-sm-4">
                                <input class="form-control" id="email" type="email" name="email" placeholder="Enter your E-mail" value="<?php if(isset($email)){echo $email;} ?>" />

                            </div>
                            <label class="error"><?php if(isset($input_error['email'])){echo $input_error['email'];} ?></label>
                                                                    <!--Email Exist check -->
                            <label class="error"><?php if(isset($email_error)){ echo $email_error;} ?></label>

                        </div>

                        <div class="form-group row">
                            <label for="password" class="text-center control-label col-sm-1">PASSWORD</label>
                            <div class="col-sm-4">
                                <input class="form-control" id="password" type="password" name="password" placeholder="Enter your Password" value="<?php if(isset($password)){echo $password;} ?>"/>

                            </div>
                            <label class="error"><?php if(isset($input_error['password'])){echo $input_error['password'];} ?></label>
                            <label class="error"><?php if(isset($password_l)){echo $password_l;} ?></label>
                        </div>

                        <div class="form-group row">
                            <label for="c_password" class="text-center control-label col-sm-1">CONFIRM PASSWORD</label>
                            <div class="col-sm-4">
                                <input class="form-control" id="c_password" type="password" name="c_password" placeholder="Enter your Confirm_Password" value="<?php if(isset($c_password)){echo $c_password;} ?>"/>

                            </div>
                            <label class="error"><?php if(isset($input_error['c_password'])){echo $input_error['c_password'];} ?></label>
                            <label class="error"><?php if(isset($password_not_matched)){echo $password_not_matched;} ?></label>
                        </div>

                        <div class="form-group row">
                            <label for="photo" class="text-center control-label col-sm-1">PHOTO</label>
                            <div class="col-sm-4">
                                <input id="photo" type="file" name="photo" />

                            </div>
                        </div>


                        <div class="col-sm-5 col-sm-offset-5" >
                            <input class=" text-center btn btn-outline-success float-center" type="submit" colspan="2" value="Registration" name="registration"/>
                        </div>


                    </form>
                </div>
            </div>
            <br/>
            <p class="text-left float-left" >If you have an account? then please <a href="login.php">Login</a></p>
            <br/>
            <hr/>
            <footer>
                <p>Copyright &copy; <?php echo date('Y') ?> All Rights Reserved By <a href="https://github.com/imtiazeemel"> Ibnul Imtiaz </a></p>
            </footer>
        </div>

</body>
</html>