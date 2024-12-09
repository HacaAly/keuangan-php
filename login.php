<?php 
session_start();

include 'koneksi.php';

$err        = "";
$username   = "";
$ingataku   = "";

if(isset($_COOKIE['cookie_username'])){
    $cookie_username = $_COOKIE['cookie_username'];
    $cookie_password = $_COOKIE['cookie_password'];

    $sql1 = "SELECT * FROM user WHERE nama = '$cookie_username'";
    $q1   = mysqli_query($koneksi, $sql1);
    $r1   = mysqli_fetch_array($q1);
    if($r1['password'] == $cookie_password){
        $_SESSION['session_username'] = $cookie_username;
        $_SESSION['session_password'] = $cookie_password;
        $_SESSION['level'] = $r1['level']; // Simpan level pengguna ke dalam session
    }
}

if(isset($_SESSION['session_username'])){
    header("location: index.php");
    exit();
}

if(isset($_POST['login'])){
    $username   = $_POST['nama'];
    $password   = $_POST['password'];

    if($username == '' or $password == ''){
        $err .= "<li>Silakan masukkan username dan juga password.</li>";
    } else {
        $sql1 = "SELECT * FROM user WHERE nama = '$username'";
        $q1   = mysqli_query($koneksi, $sql1);
        $r1   = mysqli_fetch_array($q1);

        if(empty($r1['nama'])){
            $err .= "<li>Username <b>$username</b> tidak tersedia.</li>";
        } else if($r1['password'] != md5($password)){
            $err .= "<li>Password yang dimasukkan tidak sesuai.</li>";
        }       

        if(empty($err)){
            $_SESSION['session_username'] = $username;
            $_SESSION['session_password'] = md5($password);
            $_SESSION['level'] = $r1['level']; // Simpan level pengguna ke dalam session

            if($ingataku == 1){
                $cookie_name = "cookie_username";
                $cookie_value = $username;
                $cookie_time = time() + (60 * 60 * 24 * 30);
                setcookie($cookie_name, $cookie_value, $cookie_time, "/");

                $cookie_name = "cookie_password";
                $cookie_value = md5($password);
                $cookie_time = time() + (60 * 60 * 24 * 30);
                setcookie($cookie_name, $cookie_value, $cookie_time, "/");
            }

            if ($_SESSION['level'] == 0) {
                header("location: index.php");
            } elseif ($_SESSION['level'] == 1) {
                // Level 1 bisa diarahkan ke halaman tertentu jika perlu
                header("location: index.php");
                
            } elseif ($_SESSION['level'] == 2) {
                // Level 2 bisa diarahkan ke halaman tertentu jika perlu
                header("location: index.php");
            }
            elseif ($_SESSION['level'] == 3) {
                // Level 1 bisa diarahkan ke halaman tertentu jika perlu
                header("location: index.php");

            }elseif ($_SESSION['level'] == 4) {
                // Level 1 bisa diarahkan ke halaman tertentu jika perlu
                header("location: index.php");
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

</head>
<body>
<div class="container">
    <div class="mainbox mx-auto col-md-6 col-sm-8">
        <div class="panel">
            <div class="panel-heading">Login dan Masuk</div>
            <div class="panel-body">
                <?php if($err) { ?>
                    <div class="alert alert-danger">
                        <?php echo $err; ?>
                    </div>
                <?php } ?>
                <form class="form-horizontal" action="" method="post" role="form">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="login-username" type="text" class="form-control" name="nama" value="<?php echo $username ?>" placeholder="Masukkan username yang benar">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="login-password" type="password" class="form-control" name="password" placeholder="Masukkan password yang benar">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input id="login-remember" type="checkbox" name="ingataku" value="1" <?php if($ingataku == '1') echo "checked"?>> Ingatkan Saya
                            </label>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" name="login" class="btn btn-login" value="Login"/>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
