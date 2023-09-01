<?php include '../koneksi.php';
session_start(); 
if (isset($_SESSION['login'])) {
    echo "<script>alert('anda sudah login');
        location.href='../index.php'</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="login.css">
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    
</head>

<body class="login-bg">
    <div class="login-form">
        <form action="" method="post">
            <p class="logoText">Login Page</p>
            <div class="form-group ">
                <input type="text" class="form-control" name="username" placeholder="Username " id="UserName">
                <i class="fa fa-user"></i>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" id="Password">
                <i class="fa fa-lock"></i>
            </div>
            <span class="alert">Invalid Credentials</span>
            <button type="submit" name="login" class="log-btn">Submit</button>
        </form>
    </div>
    <?php 
        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $sql = $koneksi->query("SELECT * FROM login WHERE username = '$username' AND password = '$password'");
            if ($sql->num_rows > 0) {
                $row = $sql->fetch_assoc();
                
                if ($row['level'] == 'admin') {
                    // $_SESSION['admin'] = $row;
                    $_SESSION['login'] = $row;
                    echo "<script>alert('sukses login');
                    location.href='../index.php?page=home'</script>";
                } elseif ($row['level'] == 'karyawan') {
                    // $_SESSION['karyawan'] = $row;
                    $_SESSION['login'] = $row;
                    echo "<script>alert('sukses login');
                    location.href='../index.php?page=absensi'</script>";
                }
            }
        }
      ?>
   
   
<script>
      $(document).ready(function(){
        $('.log-btn').click(function(){
            $('.log-status').addClass('wrong-entry');
           $('.alert').fadeIn(500);
           setTimeout( "$('.alert').fadeOut(1500);",3000 );
        });
        $('.form-control').keypress(function(){
            $('.log-status').removeClass('wrong-entry');
        });

    });
</script>
</body>
</html>
