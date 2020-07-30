<?php
$ranks = recommend(createRatingMatrix(),$user_name);

foreach($ranks as $item =>$value){
  echo "<pre>";
  print_r($item); //item name .. sort database with the product name;
  print_r($value); //prediction rank
  echo "</pre>";; //
$flag =1; //add recomended flag to product in database
$db->query("UPDATE products SET recommend_flag = '{$flag}' WHERE title = '{$item}'");
}
$clickedItemID = (int)sanitize($_POST['id']);
$sql ="SELECT * FROM products WHERE recommend_flag = 1 AND id != '{$clickedItemID}' AND defective_product = 0 AND archive = 0 AND category_activate_flag =1";
$recommended = $db->query($sql);
$flag =0;
$db->query("UPDATE products SET recommend_flag = '{$flag}'");
$return = mysqli_num_rows($recommended);
if($return > 0){ ?>
        <div class="col-md-12">
        <div class="panel panel-default">
        <div class="panel-heading text-center"><h3>⇩ You may also like ⇩</h3>
        </div>
        <div class="panel-body">
            <div class="posts_list">
                <?php while ($product = mysqli_fetch_assoc($recommended)) :
                $listP = (int)$product['list_price'];
                $actualP = (int)$product['price'];
                $perOff = ($listP - $actualP )/ $listP;
                $perOff = round($perOff * 100);
                $photos = explode(',',$product['image']);
                   ?>
                 <div class="col-xs-6 col-sm-5 col-md-4 padding-0 animation">
                   <div class="polaroid text-center">
                     <div class="product_title">
                       <h4><strong><?= $product['title']; ?></strong></h4>
                     </div>
                     <div class="imgHolder">
                       <img onclick="detailsmodal('add',<?= $product['id']; ?>)" src="<?= $photos[0]; ?>" alt="<?= $product['title']; ?>" class="img-thumb" style="width:100%"/>
                        <?php if ($product['sales'] == 1): ?>
                          <span>
                            <button type ="button" id="sales" class="btn btn-xs btn-danger pull-left" onclick="detailsmodal('add',<?= $product['id']; ?>)">Sales</button>
                          </span>
                       <?php endif; ?>
                     </div>
                    <p></p><p class="list-price"><s>$<?= $product['list_price']; ?></s></p>
                    <strong> <p class="price text-danger">$<?= $product['price']; ?> (<?= $perOff ?>% off)</p></strong>
                    <!--<button type ="button" id="dbutton" class="btn btn-sm btn-danger" onclick="detailsmodal(
                    <?= $product['id']; ?>)">Details</button> -->
                 </div>
                 </div>
               <?php endwhile;
             ?>
             </div>
    </div>
     <div class="panel-footer"><?php echo $return; ?></div>
    </div>
  </div>
<?php }else{ ?>
  <div class="bg-info">
    <p class="text-center text-info">
      No recommendation made at this time!
    </p>
  </div>
<?php } ?>
