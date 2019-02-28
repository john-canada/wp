<?php
/*
  template name:custom login
 */


 global $user_ID;
 global $wpdb; 
 
 if(!$user_ID){
  
   if($_POST){
  
        $username=$wpdb->escape($_POST['username']);
          $password=$wpdb->escape($_POST['password']);

          $login_array=array();
          $login_array['user_login']=$username;
          $login_array['user_password']=$password;
          $verify_user=wp_signon($login_array,true);

          if(current_user_can('Administrator')){
            echo "<script> window.location='".site_url()."/wp-admin/profile.php'</script>";
          }

            if(current_user_can('Subscriber')){
                if(!is_wp_error($verify_user)){
                  echo "<script> window.location='".site_url()."'</script>"; 
                    }else{
                  echo "Invalid credentials";
              }
            
            }
            
       }else{

         get_header();

       ?>

<div class="container">
   <div class="row">
          <div class="col-md-6">
          <form method="POST">
          <p>
            <label for="Username">Enter Username</label>
            <input type="text" class="form-control" name="username" placeholder="Username">  
          </p>
          <p>
            <label for="password">Enter Password: </label>
            <input type="password" class="form-control" name="password" placeholder="Password">  
          </p>

        <p><button type="submit" class="btn">Submit</button></p>

        </form>
         
      </div>
   </div>
</div>

<?php  get_footer(); 

 }
 
}else{
    
   echo "You are login"; 

 }
?>

