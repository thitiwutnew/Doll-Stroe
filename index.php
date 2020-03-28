<?php 
  session_start();
  session_unset();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ระบบจัดการร้านตุ๊กตา</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
            .login-container{
            margin-top: 5%;
            margin-bottom: 5%;
        }
        .login-logo{
            position: relative;
            margin-left: -41.5%;
        }
        .login-logo img{
            position: absolute;
            width: 20%;
            margin-top: 10%;
            background: #282726;
            border-radius: 4.5rem;
            padding: 5%;
        }
        .login-form-1{
            padding: 9%;
            background:#282726;
            box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
        }
        .login-form-1 h3{
            text-align: center;
            margin-bottom:12%;
            color:#fff;
        }
        .login-form-2{
            padding: 9%;
            background: #f05837;
            box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
        }
        .login-form-2 h3{
            text-align: center;
            margin-bottom:12%;
            color: #fff;
        }
        .btnSubmit{
            font-weight: 600;
            width: 50%;
            color: #282726;
            background-color: #fff;
            border: none;
            border-radius: 1.5rem;
            padding:2%;
        }
        .btnForgetPwd{
            color: #fff;
            font-weight: 600;
            text-decoration: none;
        }
        .btnForgetPwd:hover{
            text-decoration:none;
            color:#fff;
        }
</style>
</head>
<body>
<?php 
                if(isset($_POST['submit'])){
                    include("./connect.php");
                    if($_SERVER["REQUEST_METHOD"] == "POST") {
                       // username and password sent from form 
                       
                       $myusername = $_POST['username'];
                       $mypassword = md5($_POST['password']); 
                       $sql = "SELECT * FROM employee WHERE username ='".$myusername."' AND  password ='".$mypassword."'";
                       $result = mysqli_query($con,$sql);
                       $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                       $count = mysqli_num_rows($result);
                       if($count == 1) {
                            if($row['emp_idcard']==$_POST['password']){
                                $_SESSION['login_user'] =  $row['emp_name']." ". $row['emp_sur'];
                                $_SESSION['user_status'] =  $row['emp_type'];
                                $_SESSION['user_id'] =  $row['emp_id'];
                                $_SESSION['password'] =  $_POST['password'];
                                header("location: changepassword.php");
                            }
                            else{
                                $_SESSION['login_user'] =  $row['emp_name']." ". $row['emp_sur'];
                                $_SESSION['user_status'] =  $row['emp_type'];
                                $_SESSION['user_id'] =  $row['emp_id'];
                                header("location: main.php");
                                }
                       }else {
                           $chk= "ชื่อผู้ใช้งาน  หรือรหัสผ่านไม่ถูกต้อง";
                       }
                    }
                }
    ?>
<div class="container login-container">
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>ระบบจัดการร้านตุ๊กตา</h3>
                        <div class="form-group">
                        <img src="./img/logo.png" style="margin-left: 10%;">
                        </div>
                </div>
                <div class="col-md-6 login-form-2">
                <h3>เข้าสู่ระบบ</h3>
                <div class="login-logo">
                        <img src="./img/shopping.png">
                        </div>
                    <form action="./index.php" method="post">
                        <div class="form-group">
                            <label for="" style="color: #fff;">ชื่อผู้ใช้งาน :</label>
                            <input type="text" class="form-control" name="username" />
                        </div>
                        <div class="form-group">
                        <label for="" style="color: #fff;">รหัสผ่าน :</label>
                            <input type="password" class="form-control" name="password" />
                            <p style="display: block; margin-top: 10px;color: #000;margin-left: 20%;">                     
                              <?php if($chk!=null){ echo $chk;}?>
                            </p>
                        </div>
                        <div class="form-group text-center" style="margin-top:30px;">
                            <input type="submit" name="submit" class="btnSubmit" value="เข้าสู่ระบบ" />
                        </div>
                        </form>
                </div>
            </div>
        </div>
</body>
</html>