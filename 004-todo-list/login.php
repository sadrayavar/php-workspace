<?php
include('includes/init.php');

if (isset($_SESSION['user']) || isset($_COOKIE['user'])) {
    // get username and password from session or cookie
    $saved_credentials = unserialize(isset($_SESSION['user']) ? $_SESSION['user'] : $_COOKIE['user']);
    $username = $saved_credentials['username'];
    $password = $saved_credentials['password'];
} else if (isset($_POST['login_pushed'])) {
    // get username and password from form
    $username = $_POST['username'];
    $password = $_POST['password'];
}

// check credentials
if (isset($username)) {
    $users = include "includes/simple-login-form-users.php";
    $credential_ok;
    foreach ($users as $user) {
        if ($username === $user['username'] && $password === $user['password']) {
            $credential_ok = true;
            $this_user = $user;
            break;
        }
    }
    if (!isset($credential_ok)) {
        $credential_ok = false;
    }
}

// procede if credentials are correct
if (isset($credential_ok) && $credential_ok) {
    if (isset($_GET['remember'])) {
        // set cookies
        $one_week_from_now = time() + (1 * 24 * 60 * 60);
        setcookie('user', serialize($this_user), $one_week_from_now);
    } else {
        // set session
        $_SESSION['user'] = serialize($this_user);
    }

    // redirect to index page
    redirect('index.php');
}
?>
<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ورود به پنل کاربری</title>
    <link rel="stylesheet" href="https://dl.daneshjooyar.com/mvie/Moodi_Hamed/assets/css/font-yekanbakh-vf.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="login-container">
        <img src="images/daneshjooyar-logo.svg" class="login-logo" alt="Daneshjooyar" width="145" height="59">
        <?php if (isset($credential_ok) && !$credential_ok): ?>
            <div class="message error">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none">
                    <path d="m14 16.16-3.96-3.96M13.96 12.24 10 16.2M10 6h4c2 0 2-1 2-2 0-2-1-2-2-2h-4C9 2 8 2 8 4s1 2 2 2Z" stroke="#FF8A65" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M16 4.02c3.33.18 5 1.41 5 5.98v6c0 4-1 6-6 6H9c-5 0-6-2-6-6v-6c0-4.56 1.67-5.8 5-5.98" stroke="#FF8A65" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <p>
                    نام کاربری یا رمز عبور اشتباه است
                </p>
            </div><!--.message-->
        <?php endif; ?>
        <form action="login.php" method="post">
            <h1>ورود به سایت</h1>
            <div class="form-group">
                <label for="username">نام کاربری</label>
                <input type="text" id="username" name="username" class="form-control" value="<?php echo $username ?? "" ?>">
            </div>
            <div class="form-group">
                <label for="password">گذرواژه</label>
                <input type="text" id="password" name="password" class="form-control" value="<?php echo $password ?? "" ?>">
            </div>
            <div class="switch-group">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">
                    مرا به خاطر بسپر
                </label>
            </div>
            <button name="login_pushed" class="btn btn-primary">ورود به حساب کاربری</button>
        </form>
        <?php if (isset($credential_ok) && $credential_ok): ?>
            شما با موفقیت وارد شدید!
        <?php endif; ?>
    </div><!--.login-container-->
    <a class="about-course" href="https://dnjy.ir/php">
        <p>دوره جامع PHP مقدماتی تا پیشرفته</p>
        <p>dnjy.ir/php</p>
    </a>
</body>

</html>
