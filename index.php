<?php
  require_once 'core/init.php';
  include 'includes/head.php';
  include 'includes/navigation.php';
  include 'includes/headerfull.php';
  include 'includes/leftbar.php';
  $sql="SELECT * FROM products WHERE featured=1 AND deleted = 0";
  $featured=$db->query($sql);
?>
   <!--Main content-->
   <div class="col-md-8">
     <div class="row">
       <h2 class="text-center"><b>Featured Products</b></h2>
          <?php while($product=mysqli_fetch_assoc($featured)) : ?>
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
