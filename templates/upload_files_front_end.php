<?php
/*
  template name: upload files
 */
get_header();
?>

<div class="container">
   <div class="row">
       <div class="col-sm-6 col-sm-offset-3">
       <form action="inc/upload.php" method="post" enctype="multipart/form-data">
        <label for="file"><span>Filename:</span></label>
        <input type="text" class="form-control mb-2" name="name" id="name" />
        <input type="file" class="form-control mb-3" name="file" id="file" />        
        <input class="btn btn-default" type="submit" class="form-control mb-2" name="submit" value="Submit" />
      </form>
      <br>

       </div><!-- .col-md-6 col-md-offset-3 -->
   </div><!-- .row -->
</div><!-- .container -->
    
<?php 

// echo do_shortcode('[contact-form-7 id="325" title="Contact form 1_copy"]');
// echo do_shortcode('[wpforms id="327" title="false" description="false"]');

get_footer();
?>

<?php


    // $name=$_POST['name'];
    // $filename=$_POST['file'];
    
    // echo $name;
?>
