<?php
// Check if the user is logged in, otherwise redirect to the login page
// You may need to modify this part based on your authentication mechanism
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Include your database connection code here (e.g., db.php)
include("db.php");

// Fetch user information from the database
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// You can customize the dashboard content based on your requirements
?>


<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>dashboard</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<div class="container">

<?php include("nav.php"); ?>
     

    <div class="wrapper">
        <p>ยินดีต้อนรับ, <?php echo $user['lastname']; ?>!</p>
        <p>นีคือระบบ ค้นหารายการประเมินภาษีที่ดินและสิ่งปลูกสร้าง</p>
        <a href="logout.php" class="btn btn-primary">ออกจากระบบ</a>   
    </div>   
        <!-- Add more content and functionalities as needed -->
<!--         
        <div class="px-4 py-5 my-5 text-center">
    <img class="d-block mx-auto mb-4" src="img/569.png" alt="" width="72" height="57">
    <h1 class="display-5 fw-bold text-body-emphasis">Centered hero</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
      <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button>
        <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button>
        </div>
        
        </div> -->
        <br>
      <div class="container">
      <iframe src=" https://script.google.com/macros/s/AKfycbyQyhJKRm0ELAwE-_5h1DoJ4Efv7ebLxb9eny5tbnmWf0ZbwA_MmKUTAyGi6krZvhEjDQ/exec
" width="100%" height="1000"frameborder="0"> </iframe>
     
      
    
    </div>
  </div>
  

  


   
   <?php include("footer.php"); ?>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>
</html>