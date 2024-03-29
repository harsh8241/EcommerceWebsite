<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/E_commerce/core/init.php';
  include 'includes/head.php';
  $email=((isset($_POST['email']))?sanitize($_POST['email']):'');
  $email = trim($email);
  //$password='password';
  $password=((isset($_POST['password']))?sanitize($_POST['password']):'');
  $password=trim($password);
  //$hashed = password_hash($password,PASSWORD_DEFAULT);
//  var_dump($password);die();
  $errors=array();
?>
<style>
  body{
    background-image: url("/E_commerce/images/headerlogo/background.png");
    background-size : 100vw 100vh;
    background-attachment: fixed;
  }
</style>
<div id="login-form">
  <div>
    <?php
      if($_POST){
        //form-validation
        if(empty($_POST['email'])||empty($_POST['password'])){
          $errors[] = 'You must provide email and password';
        }
    //validate email
      if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors[] = 'You must enter a valid email';
      }

      //password is more than 6 characters
      if(strlen($password)<6){
        $errors[]='Password must be of at least 6 characters';
      }

       $query = $db->query("SELECT * FROM users WHERE email = '$email'");
       $user=mysqli_fetch_assoc($query);
       $userCount = mysqli_num_rows($query);
       if($userCount < 1){
         $errors[] = 'That email doesn\'t exist in our database';
       }

       if($password != $user['password']){
         $errors[] = 'The password does not match our records. Please try again ';
       }

        if(!empty($errors)){
          echo display_errors($errors);
        }else{
          //login
          $user_id = $user['id'];
          login($user_id);
        }
  }
    ?>
  </div>
  <h2 class = "text-center">Login</h2><hr>
  <form action="login.php" method="post">
    <div class="form-group">
      <label for ="email">Email:</label>
      <input type = "email" name ="email" class = "form-control" value = "<?=$email;?>">
    </div>
    <div class="form-group">
      <label for ="password">Password:</label>
      <input type = "password" name ="password" class = "form-control" value = "<?=$password;?>">
    </div>
    <div class="form-group">
      <input type="submit" value="login" class="btn btn-primary">
    </div>
  </form>
  <p class = "text-right"><a href="/E_commerce/index.php" alt="home">Visit Site</a></p>
</div>
<?php include 'includes/footer.php'?>
