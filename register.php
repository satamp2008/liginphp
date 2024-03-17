<?php
include("db.php");

$errors = [];
$success_message = "";

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $lastname = $_POST['lastname'];
  $address = $_POST['address'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];

  // Validate input
  if (empty($username)) {
    $errors['username'] = "กรุณากรอกหมายบัตรประชาชน 13 หลัก";
  } elseif (strlen($username) < 13) {
    $errors['username'] = "กรุณากรอกหมายบัตรประชาชนให้ถูกต้อง";
  }
  
  // ... validate other fields

  if (empty($lastname)) {
    $errors['lastname'] = "กรุณากรอกชื่อสกุล.";
}

if (empty($username)) {
    $errors['address'] = "กรุณากรอกที่อยู่.";
}

if (empty($phone)) {
    $errors['phone'] = "กรุณากรอกเบอร์โทร.";
}

if (empty($password)) {
    $errors['password'] = "ตั้งรหัสผ่าน 6 หลัก.";
} elseif (strlen($password) < 6) {
    $errors['password'] = "Password must be at least 6 characters long.";
}

if (empty($confirmPassword)) {
    $errors['confirm_password'] = "ยืนยันตั้งรหัสผ่าน.";
} elseif ($password !== $confirmPassword) {
    $errors['confirm_password'] = "Passwords do not match.";
}


  // Check if username exists
  $stmt_check_username = $conn->prepare("SELECT * FROM users WHERE username = ?");
  $stmt_check_username->execute([$username]);
  $existing_user = $stmt_check_username->fetch();

  if ($existing_user) {
    $errors['username'] = "ชื่อผู้ใช้นี้ถูกใช้แล้ว";
  }

  if (empty($errors)) {
    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare INSERT statement
    $stmt = $conn->prepare("INSERT INTO users (username, lastname, address, phone, email, password) VALUES (?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->execute([$username, $lastname, $address, $phone, $email, $hashedPassword]);

    // Success message
    $success_message = "การลงทะเบียนสำเร็จ! กรุณาเข้าสู่ระบบ";
  }
}

?>



<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>sign up</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<div class="container">

<?php include("nav.php");?>
     
      <div class="container col-md-6">
    <div class="wrapper">
        <h1>ลงทะเบียน</h1>
        <?php if ($success_message !== "") : ?>
            <div class="alert alert-success">
                <?= $success_message; ?>
            </div>
        <?php endif; ?>
        <form method="post" action="register.php">
            <div class="form-group">
                <label for="username">เลขบัตรประชาชน 13 หลัก</label>
                <input type="username" class="form-control" name="username">
                <?php if (isset($errors['username'])) : ?>
                    <small class="text-danger"><?= $errors['username']; ?></small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="lastname">ชื่อ นามสกุล</label>
                <input type="text" class="form-control" name="lastname">
                <?php if (isset($errors['lastname'])) : ?>
                    <small class="text-danger"><?= $errors['lastname']; ?></small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="address">ที่อยู่ในการจัดส่งเอกสาร</label>
                <input type="text" class="form-control" name="address">
                <?php if (isset($errors['address'])) : ?>
                    <small class="text-danger"><?= $errors['address']; ?></small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="phone">เบอร์ติดต่อ</label>
                <input type="text" class="form-control" name="phone">
                <?php if (isset($errors['phone'])) : ?>
                    <small class="text-danger"><?= $errors['phone']; ?></small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="email">อีเมล</label>
                <input type="email" class="form-control" name="email">
                <?php if (isset($errors['email'])) : ?>
                    <small class="text-danger"><?= $errors['email']; ?></small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password">รหัสผ่าน</label>
                <input type="password" class="form-control" name="password">
                <?php if (isset($errors['password'])) : ?>
                    <small class="text-danger"><?= $errors['password']; ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="confirm_password">ยืนยันรหัสผ่าน</label>
                <input type="password" class="form-control" name="confirmPassword">
                <?php if (isset($errors['confirm_password'])) : ?>
                    <small class="text-danger"><?= $errors['confirm_password']; ?></small>
                <?php endif; ?>
            </div>
            <br>
            <input class="btn btn-primary w-100" type="submit" name="submit" value="Submit">
        </form>

        <p>ลงทะเบียนเรียบร้อยแล้ว? <a href="index.php">ลงชื่อเข้าใช้ตอนนี้.</a></p>
    </div>
</div>
</div>

<?php include("footer.php"); ?>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>
