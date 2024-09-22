<?php
include 'header.php';
session_start();
if(isset($_SESSION["register"])){
    header("Location: index.php");
}
?>

<body>
<div class="">
    <!-- Button HTML (to Trigger Modal) -->
    
    <button><a href="#myModal" class="trigger-btn" data-toggle="modal">Sign In</a></button>
</div>

<!-- Modal HTML -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <div class="modal-header">                
                <h4 class="modal-title">Student</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <?php
            if(isset($_POST["login"])){
                $sid = $_POST["sid"];
                $password = $_POST["password"];
                require_once "dbconnect.php";
                $sql = "SELECT * FROM register WHERE sid = '$sid'";
                $result = mysqli_query($conn,$sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if($user){
                    if(password_verify($password, $user['password'])){
                        session_start();
                        $_SESSION["register"] = "yes";
                        header("Location: index.php");
                        die();
                    }else{
                        echo "<div class = 'alert alert-danger'>Password does not match!</div>";
                    }
                }else{
                    echo "<div class = 'alert alert-danger'>SID not found!</div>";
                }
            }
            ?>
            <div class="modal-body">
                <form action="login.php" method="POST">
                    <label for="Student ID">Student ID (AXX-XXXX):</label>
                    <div class="form-group">  
                        <i class="fa fa-user"></i>
                        <input type="text" name = "sid" class="form-control" placeholder="Enter Student ID" required="required">
                    </div>
                    <label for="Password">Password (MM-DD-YYYY):</label>
                    <div class="form-group">         
                        <i class="fa fa-lock"></i>
                        <input type="password" name = "password" id="password" class="form-control" placeholder="Enter your password" required="required">
                        <input type="checkbox" id="show-password" onclick="showPassword()"> Show Password
                    </div>
                    <div class="form-group">
                        <input type="submit" name = "login" class="btn btn-primary btn-block btn-lg" value="Sign In">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p>Don't have an account? <a href="registration.php">Register Here</a></p>
            </div>
        </div>
    </div>
</div>     
<script>
    function showPassword() {
        var passwordInput = document.getElementById("password");
        var showPasswordCheckbox = document.getElementById("show-password");
        if (showPasswordCheckbox.checked) {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
</script>
</body>