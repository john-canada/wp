<?php
/*
  template name:custom registration page
 */

 get_header();
 global $wpdb;

 if($_POST){
   
    $username=$wpdb->escape($_POST['username']);
    $email=$wpdb->escape($_POST['email']);
    $password=$wpdb->escape($_POST['password']);
    $confirmpassword=$wpdb->escape($_POST['confirmpassword']);

     $error=array();
     
     if(strpos($username,' ')!==false){
       $error['username_space']='User name has space';
     }

     if(empty($username)){
        $error['username_empty']='User name has empty value';
     }

     if(username_exists($username)){
        $error['username_exist']='User name already exist';
     }

     if(!is_email($email)){
        $error['email_invalid']='invalid email';
     }

     if(email_exists($email)){
        $error['email_exist']='Email Already Exist';
     }

     if(strcmp($password,$confirmpassword)!==0){
        $error['password_notMatch']='Password not match';
     }

    if(count($error)==0){
        wp_create_user($username,$password,$email);
         echo "User created successfully";
        exit();
    }else{
        echo '<div class="container">';
          echo '<div class="row">';
          echo '<div class="col-md-6">';
          echo '<div style="background:#f1f1f1;width:100%;height:35px">';
          print_r($error);
          echo '</div>';
        echo '</div>';   
        echo '</div>';
        echo '</div>';   
    }

}

?>
<div class="container">
<div class="row">
   <div class="col-md-6 col-md-offset-3">
   <form method="POST">
      <input type="text" class="form-control" name="username" placeholder="username">  
      <input type="email" class="form-control" name="email" placeholder="email">
      <input type="password" class="form-control" name="password" placeholder="password">
      <input type="password" class="form-control" name="confirmpassword" placeholder="confirmpassword">
      <button type="submit" class="btn btn-primary mt-2">Register</button>
   </form>
 </div>
</div>
</div>

<?php get_footer();?>