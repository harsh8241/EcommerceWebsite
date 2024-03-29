<?php
  require_once 'core/init.php';
  include 'includes/head.php';
  include 'includes/navigation.php';
  include 'includes/headerpartial.php';
  include 'includes/leftbar.php';

  if(isset($_GET['cat'])){
    $cat_id=sanitize($_GET['cat']);
  }else{
    $cat_id='';
  }

  $sql="SELECT * FROM products WHERE categories='$cat_id'";
  $productQ=$db->query($sql);
  $category = get_category($cat_id);
?>

   <!--Main content-->
   <div class="col-md-8">
     <div class="row">
       <h2 class="text-center"><?=$category['parent'].' '.$category['child'];?></h2>
          <?php while($product=mysqli_fetch_assoc($productQ)) : ?>
              <div class="col-md-3">
                 <h4><?=$product['title'];?></h4>
                 <img src=<?=$product['image'];?> alt=<?=$product['title'];?> class="img-thumb"  />
                 <p class="list-price text-danger">list Price : <s> &#8377 <?=$product['list_price'];?></s></p>
                 <p class="price">Our price : &#8377 <?=$product['price'];?></p>
                 <button type="button" class ="btn btn-sm btn-success" onclick="detailsmodal(<?=$product['id']; ?>)">Details</button>
              </div>
          <?php endwhile;?>
      </div>
  </div>
<?php

  include 'includes/rightbar.php';
  include 'includes/footer.php';
  include 'includes/design.php';
?>
