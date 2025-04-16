<?php
   ob_start();
   session_start();
?>
<html lang = "en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="loginstyle.css">
   <title>Login</title>
   <style>
    body {
        display: flex;
        background-color: black;
        color: white;
    }
    h4 {
        color:red;
    }
    form {
        margin: auto;
    }
   </style>
</head>
<body>
   <?php
      $msg = '';
      $users = ['user'=>"test", "manager"=>"secret"];
    $host = 'localhost';
    $dbname = 'queue_system';
    $user = 'root';
    $password = '';
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM `settings` WHERE (`settings`.`name` = 'admin_password');";
    $stmt = $pdo->query($sql);

    // Pobranie wyniku
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $users['user'] = $result['value'];
    } else {
        $users['user'] = 'test'; // Brak rekordów w tabeli
    }
    
      if (isset($_POST['login']) 
      && !empty($_POST['password'])) {
         $user='user';                  
         if (array_key_exists($user, $users)){
            if ($users[$user]==$_POST['password']){
               $_SESSION['authenticated'] = true;
               $_SESSION['username'] = $user;
               $msg = "OK";
               header('Location: panel_sterowania.php');

            }
            else {
               $msg = "Złe hasło";
            }
         }
         else {
            $msg = "Błąd wewnętrzny";
         }
      }
   ?>

   <h4><?php echo $msg; ?></h4>
   <br/><br/>
   <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
         <label for="password">Hasło:</label>
         <input type="password" name="password" id="password">
         <button type="submit" name="login">Zaloguj</button>
   </form>
   </div> 
</body>
</html>