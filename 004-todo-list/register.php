<?php include('includes/init.php'); ?>
<?php
$username_exists = false;

if (isset($_POST['register'])) {
    $user_data = [
        'username' => $_POST["username"],
        'password' => $_POST["password"],
        'name' => $_POST["name"],
        'family' => $_POST["family"],
        'phone' => $_POST["phone"],
        'birthdate' => $_POST["birthdate"],
        'avatar' => '',
    ];

    if (create_user(...$user_data) === false) {
        // username exists
        $username_exists = true;
    } else {
        // successfilly signed up: forward to login page
        redirect('login.php');
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ثبت نام</title>
    <link rel="stylesheet" href="https://dl.daneshjooyar.com/mvie/Moodi_Hamed/assets/css/font-yekanbakh-vf.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="login-container">
        <img src="images/daneshjooyar-logo.svg" class="login-logo" alt="Daneshjooyar" width="145" height="59">
        <?php if ($username_exists): ?>
            <div class="message error">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none">
                    <path d="m14 16.16-3.96-3.96M13.96 12.24 10 16.2M10 6h4c2 0 2-1 2-2 0-2-1-2-2-2h-4C9 2 8 2 8 4s1 2 2 2Z" stroke="#FF8A65" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M16 4.02c3.33.18 5 1.41 5 5.98v6c0 4-1 6-6 6H9c-5 0-6-2-6-6v-6c0-4.56 1.67-5.8 5-5.98" stroke="#FF8A65" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <p>
                    نام کاربر از قبل وجود دارد
                </p>
            </div><!--.message-->
        <?php endif; ?>
        <form method="post">
            <h1>ثبت نام در سایت</h1>
            <div class="form-group">
                <label for="username">نام کاربری</label>
                <input type="text" id="username" name="username" value="<?php echo $_POST['username'] ?? "" ?>" class="form-control ltr">
            </div>
            <div class="form-group">
                <label for="password">گذرواژه</label>
                <input type="text" id="password" name="password" value="<?php echo $_POST['password'] ?? "" ?>" class="form-control ltr">
            </div>
            <div class="form-group">
                <label for="name">نام </label>
                <input type="text" id="name" name="name" value="<?php echo $_POST['name'] ?? "" ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="family">نام خانوادگی </label>
                <input type="text" id="family" name="family" value="<?php echo $_POST['family'] ?? "" ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="phone">تلفن همراه</label>
                <input type="text" id="phone" name="phone" value="<?php echo $_POST['phone'] ?? "" ?>" class="form-control ltr">
            </div>
            <div class="form-group">
                <label for="birthdate">تاریخ تولد</label>
                <input type="text" id="birthdate" name="birthdate" value="<?php echo $_POST['birthdate'] ?? "" ?>" class="form-control ltr">
            </div>
            <button class="btn btn-primary" name="register">ثبت نام</button>
        </form>
    </div><!--.login-container-->
    <a class="about-course" href="https://dnjy.ir/php">
        <p>دوره جامع PHP مقدماتی تا پیشرفته</p>
        <p>dnjy.ir/php</p>
    </a>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#birthdate", {
            enableTime: true,
            dateFormat: "Y-m-d",
        });
    </script>
</body>

</html>
