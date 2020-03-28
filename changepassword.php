<?php 
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>เปลี่ยนรหัสผ่าน</title>
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
                    if($_SERVER["REQUEST_METHOD"] == "POST") {
                        include("./connect.php");
                        if($_SESSION['password']==$_POST['passwordold']){
    
                            if($_POST['passwordnew']==$_POST['passwordnews']){
                                
                                if($_POST['passwordnew']==$_SESSION['password']){
                                    $chk= "ห้ามตั้งรหัสผ่านเป็นเลขบัตรประชาชน !!! ";
                                }
                                else{
                                    $passwordold = md5($_POST['passwordold']); 
                                    $passwordnew = md5($_POST['passwordnew']); 
                                    $passwordnews = md5($_POST['passwordnews']); 
        
                                    $sqledit = "UPDATE employee SET password='".$passwordnew."' WHERE emp_id='".$_SESSION['user_id']."'"; 
                                    if(mysqli_query($con, $sqledit)){ 
                                        header("location: main.php");
                                    } else { 
                                        $chk= "เกิดข้อผิดพลาด กรุราลองใหม่ !!! ";
                                    } 
                                }
                              
                            }
                            else{
                                $chk= "รหัสผ่านใหม่ไม่ตรงกัน !!! ";
                            }
                        }
                        else{
                            $chk= "รหัสผ่านเก่าไม่ถูกต้อง !!! ";
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
                <h3>เปลี่ยนรหัสผ่าน</h3>
                <div class="login-logo">
                        <img src="./img/shopping.png">
                        </div>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="" style="color: #fff;">รหัสผ่านเก่า </label>
                            <input id="passwordold" type="password" class="form-control" name="passwordold" required />
                        </div>
                        <div class="form-group">
                        <label for="" style="color: #fff;">รหัสผ่านใหม่ </label>
                            <input type="password" id="checkpassword" class="form-control" name="passwordnew" required/>
                        </div>
                        <div class="form-group">
                        <label for="" style="color: #fff;">ยืนยันรหัสผ่านใหม่ </label>
                            <input id="checkpasswordcf" type="password" class="form-control" name="passwordnews" required/>
                            <p id="checkpasswordcfs" style="display: block; margin-top: 10px;color: #000;"></p>
                            <p style="display: block; margin-top: 10px;color: #000;margin-left: 20%;">                     
                              <?php if($chk!=null){ echo $chk;}?>
                            </p>
                        </div>
                        <div class="form-group text-center" style="margin-top:30px;">
                            <input id="myBtn" type="submit" name="submit" class="btnSubmit" value="เปลี่ยนรหัสผ่าน" />
                        </div>
                        </form>
                </div>
            </div>
        </div>
</body>
<script>
    $("#checkpassword").change(function(){
        var pass = $(this).val();
        if(pass.length<5){
            document.getElementById("checkpasswordcfs").innerHTML = "รหัสผ่านอย่างน้อย 6 ตัว";
            document.getElementById("myBtn").disabled = true;
        }
        else{
            document.getElementById("checkpasswordcfs").innerHTML = "";
            document.getElementById("myBtn").disabled = false;
        }
    })
    $("#checkpasswordcf").change(function(){
        var pass = $(this).val();
        if(pass.length<5){
            document.getElementById("checkpasswordcfs").innerHTML = "รหัสผ่านอย่างน้อย 6 ตัว";
            document.getElementById("myBtn").disabled = true;
        }
        else{
            document.getElementById("checkpasswordcfs").innerHTML = "";
            document.getElementById("myBtn").disabled = false;
        }
    })
</script>
</html>