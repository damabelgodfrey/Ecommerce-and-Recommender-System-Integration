<?php
//require_once '../core/init';
// function to pass in an array of errors style in bootstrap for errors
function display_errors($errors){
  $display = '<ul class="bg-danger">';
  foreach($errors as $error) {
    //class text danger make the font red
    $display .='<li class="text-danger">'.$error.'</li>';
  }
  $display .= '</ul>';
  return $display;
}

function display_success($successes){
  $s_display = '<ul class="bg-success">';
//  var_dump($successes); die();
  foreach($successes as $success) {
    //class text danger make the font red
    $s_display .='<li class="text-success">'.$success.'</li>';
  }
  $s_display .= '</ul>';
  return $s_display;
}

function alert1($successes){
?>
<script >
  alert(<?php $successes ?>);
</script>

<?php
die('i got in');
}
// Sanitize html entities and bad code not to run in your database
function sanitize($dirty){
  return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}

function money($number){
  return '£'.number_format($number,2); //format money to 2 decimal, place add money sign (N)
}

function loginstaff($staff_id,$staff_username,$staff_permission){
  $_SESSION['staff_id'] = $staff_id; //set user session on Login
  $_SESSION['staff_username'] = $staff_username; //set user session on Login
  $_SESSION['last_staff_login_timestamp'] = time();
  $admin_mode = 'false';
  $Clearance_level = 'admin';
  $level = explode(',',$Clearance_level);
  global $staff_data;
  $S_C_level = explode(',', $staff_permission); //check user data permissions
  if (count(array_intersect($level, $S_C_level)) === 1) {
    $admin_mode = 'true';
    $_SESSION['maintenance_admin_login'] = $admin_mode;
  }else{
    $_SESSION['maintenance_admin_login'] = $admin_mode;
  }
  //$date = date("Y-m-d H:i:s"); //this is the date format of the Database
  //$db->query("UPDATE users SET last_login = '$date' WHERE username = '$staff_username'");
  $_SESSION['success_flash'] = $staff_username.' you are now logged in!';
    if(isset($_SESSION['staff_rdrurl'])){
      header('location: '.$_SESSION['staff_rdrurl']);
    }else{
      header('location: index');
    }
}

function loginCustomer($user_id,$user_username){
  $_SESSION['Userid'] = $user_id; //set user session on Login
  $_SESSION['Username'] = $user_username; //set user session on Login
  $_SESSION['last_login_timestamp'] = time();
  global $db; //make database object a global variable
  $date = date("Y-m-d H:i:s"); //this is the date format of the Database
  $db->query("UPDATE customer_user SET last_login = '$date' WHERE username = '$user_username' ");
  $_SESSION['success_flash'] = 'you are now logged in!';
    if(isset($_SESSION['rdrurl'])){
      header('location: '.$_SESSION['rdrurl']);
    }else{
      header('location: index');
    }
}


function is_logged_in(){
  if(isset($_SESSION['Userid'])){
    return true;
  }
  return false;
}

function is_staff_logged_in(){
  if(isset($_SESSION['staff_id'])){
    return true;
  }
  return false;
}
function is_maintainance(){
 $status =1;
  global $db;
 $maintananceQ = $db->query("SELECT * FROM settings WHERE maintenance_status = '{$status}'");
$Q_status = mysqli_num_rows($maintananceQ);
  if($Q_status == 1){
      return true;
  }else{
  return false;
  }

}

function maintainance_redirect(){
      $url = 'maintenance_page';
  ?>
     <script>
      var row = '<?php echo $url; ?>';
      window.location.replace(row);
      </script>

<?php
  header('Location:'.$url);
exit();
}
function login_error_redirect($url = 'login'){
  $_SESSION['error_flash'] = 'You must be logged in to access that page';
  header('Location:'.$url);
  ?>
     <script>
      var row = '<?php echo $url; ?>';
      window.location.replace(row);
      </script>

<?php
exit();
}

function error_redirect($url,$message){
  $_SESSION['error_flash'] = $message;
  header('Location:'.$url);
}

function redirect($url){
  header('Location:'.$url);
  ?>
     <script>
      var row = '<?php echo $url; ?>';
      window.location.replace(row);
      </script>

<?php
exit();
}

function succes_redirect($url,$message){
    $_SESSION['success_flash'] = $message;
  header('Location:'.$url);
  ?>
     <script>
      var link = '<?php echo $url; ?>';
      window.location.replace(link);
      </script>

<?php
exit();
}

function permission_error_redirect($url = 'login'){
  $_SESSION['error_flash'] = 'You do not have permission to access that page';
  if(isset($_SESSION['staff_rdrurl'])){
    $url = $_SESSION['staff_rdrurl'];
  }
  header('Location:'.$url);
  ?>
     <script>
     alert('You do not have permission to view that page');
      var row = '<?php echo $url; ?>';
      window.location.replace(row);
      </script>

<?php
exit();
}

function permission_ungranted($url,$message){
  $_SESSION['error_flash'] = $message;
  header('Location:'.$url);
  ?>
     <script>
      var row = '<?php echo $url; ?>';
      window.location.replace(row);
      </script>

<?php
exit();
}

function check_staff_permission($level){
  $Clearance_level = $level;
  $C_permission = explode(',',$Clearance_level);
  global $staff_data;
  $C_permissions = explode(',', $staff_data['permissions']); //check user data permissions
    if (count(array_intersect($C_permission, $C_permissions)) === 0) {
      return false;
    }else{
      return true;
    }
 }
 function check_staff_permission_mult($level,$staff_level){
   $C_level = explode(',',$level);
   $C_staff_level = explode(',', $staff_level); //check user data permissions
     if (count(array_intersect($C_level, $C_staff_level)) === 0) {
       return false;
     }else{
       return true;
     }
  }
function check_permission($level){
  $Clearance_level = $level;
  $C_permission = explode(',',$Clearance_level);
  global $user_data;
  $C_permissions = explode(',', $user_data['permissions']); //check user data permissions
    if (count(array_intersect($C_permission, $C_permissions)) === 0) {
      return false;
    }else{
      return true;
    }
 }

// format of date to be displayed
function my_dateFormat($date){
  return date("M d, Y h:i A",strtotime($date));
}


function is_valid_password($password) {
    if(preg_match_all('$S*(?=S{6,})(?=S*[a-z])(?=S*[A-Z])(?=S*[d])(?=S*[W])S*$', $password)){
      return true;
    }
    return false;
}
function is_accept_password($password){
  if (preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $password)){
    return true;
  }
  return false;
}
/**
* phone number vallidator.
* @param $input
* @return type returns boolean
*/
function is_accept_phone_no($phone){
  $pattern = '/^0[0-9]{10}/';

  if (preg_match($pattern, $phone)){
    if(strlen($phone)==11){
      return true;
    }else{
      return false;
    }

  }
  return false;
}

function get_category($child_id){
  global $db;
  $id=sanitize($child_id);
  $sql = "SELECT p.id AS 'pid', p.category AS 'parent', c.id AS 'cid', c.category AS 'child'
          FROM categories c
          INNER JOIN categories p
          ON c.parent = p.id
          WHERE c.id = '$id'";
  $query = $db->query($sql);
  $category = mysqli_fetch_assoc($query);
  return $category;
}

//   turn size quantity string into an array [medium:10,large:66]
function sizesToArray($string){
  $sizesArray = explode(',',$string);
  $returnArray = array();
  foreach($sizesArray as $size){
    $s =explode(':',$size);
    $returnArray[] = array('size'=> $s[0], 'price' => $s[1],'quantity' => $s[2],'threshold' => $s[3]);
  }
  return $returnArray;
}

function sizesToString($sizes){
  $sizeString = '';
  foreach($sizes as $size){
    $sizeString .= $size['size'].':'.$size['price'].':'.$size['quantity'].':'.$size['threshold'].',';
  }
  $trimmed =rtrim($sizeString,',');
  return $trimmed;
}

function qtysoldToString($sizes){
  $sizeString = '';
  foreach($sizes as $size){
    $sizeString .= $size['quantity'].':'.$size['price'].',';
  }
  $trimmed =rtrim($sizeString,',');
  return $trimmed;
}


function updateProductQty($item,$db){
  foreach($item as $itemp){
  $product_id =$itemp['id'];
  $productQ = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
  $product = mysqli_fetch_assoc($productQ);
  $sizes = sizesToArray($product['sizes']); //function in helper file
  foreach($sizes as $size){
      if($size['size'] == $itemp['size']){
        $q = $size['quantity'] - $itemp['quantity']; // subtract quantity ordered to that in database
        $newSizes[] = array('size' => $size['size'],'price' => $size['price'],'quantity' => $q,'threshold' => $size['threshold']);
      }else{
        $newSizes[] = array('size' => $size['size'],'price' => $size['price'],'quantity' => $size['quantity'], 'threshold' => $size['threshold']);
         //$qtyOrdered[] = array('quantity' => $solds['quantity'],'price' =>$solds['price']);
      }
    }
    $sizeString = sizesToString($newSizes);
    $db->query("UPDATE products SET sizes = '{$sizeString}' WHERE id='{$product_id}'");
 }
  return;
}

function updateProductQtyupdate($mode,$items,$db,$edit_id,$edit_size,$edit_quantity){
  $productQ = $db->query("SELECT * FROM products WHERE id = '{$edit_id}'");
  $product = mysqli_fetch_assoc($productQ);
  $sizes = sizesToArray($product['sizes']); //function in helper file
  $edit_size= explode(',',$edit_size);
  foreach($sizes as $size){
    if($size['size'] == $edit_size[0]){
      if($mode == 'addone'){
        $q = $size['quantity'] - 1; // subtract quantity ordered to that in database
      }
      if($mode == 'removeone'){
        $q = $size['quantity'] + 1;
      }
      if($mode == 'delete'){
        $q = $size['quantity'] + $edit_quantity;
      }
      if($mode == 'expire'){
        $q = $size['quantity'] + $edit_quantity;
        $_SESSION['error_flash'] = 'Cart product expired, you can add back to cart from wishlist';
      }

    $newSizes[] = array('size' => $size['size'],'price' => $size['price'],'quantity' => $q,'threshold' => $size['threshold']);
  }else{
    $newSizes[] = array('size' => $size['size'],'price' => $size['price'],'quantity' => $size['quantity'], 'threshold' => $size['threshold']);
     //$qtyOrdered[] = array('quantity' => $solds['quantity'],'price' =>$solds['price']);
  }
}

$sizeString = sizesToString($newSizes);
$db->query("UPDATE products SET sizes = '{$sizeString}' WHERE id='{$edit_id}'");
return;
}

/* this function returns product expired in cart to wishlist */
function expireReturnProduct($cart_id,$user_name,$db){
  $paid = 0;
  $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
  $cartQ = $db->query("SELECT * FROM cart WHERE username = '{$user_name}' AND paid = '{$paid}'");
//  $db->query("INSERT INTO wishlist(id,items,username,expire_date) VALUES ({$cart_id}','{$cartQ}','{$user_name}','{$cart_expire}')");
  $result = mysqli_fetch_assoc($cartQ);
  $cart_items = json_decode($result['items'],true);
  $updated_items =array();
    foreach($cart_items as $item){
        $mode = 'expire';
        $edit_id =  $item['id'];
        $edit_size = $item['size'];
        $edit_quantity = $item['quantity'];
        updateProductQtyupdate($mode,$item,$db,$edit_id,$edit_size,$edit_quantity);
        //$item['quantity'] = 0;
        $updated_items[] = $item;
      }
  if(!empty($updated_items)){
    $json_update = json_encode($updated_items);
    //$db->query("UPDATE cart SET items = '{$json_update}' WHERE id = '{$cart_id}' AND paid = '{$paid}'");
    //$_SESSION['success_flash'] = 'Your shopping cart has been updated';
    $cart_item = $db->query("SELECT * FROM cart WHERE username = '{$user_name}' AND paid = '{$paid}'");
    $cart = mysqli_fetch_assoc($cart_item);
    $items = json_decode($cart['items'],true); //makes it an associated array not an object


    foreach ($items as $w_item) {
      $product_id = $w_item['id'];
      $price = $w_item['price'];
      $size = $w_item['size'];
      $quantity = $w_item['quantity'];
      $request = $w_item['request'];
      $item = array();
      $item[] = array(
        'id'            => $product_id,
        'price'            => $price,
        'size'          => $size,
        'quantity'      => $quantity,
        'request'      => $request,
      );
      $nill = 100; //not applicable for wishlist
      $available = $nill;
     cart_wishlist_update('wishlist',$db,$item,$cart_id,$user_name,$json_update,$cart_expire,$available);
    }
    $db->query("DELETE FROM cart WHERE username = '{$user_name}' AND paid = '{$paid}'");
    $_SESSION['success_flash'] = $user_name. ' Your shopping cart has been updated';
  }

  if(empty($updated_items)){
    $db->query("DELETE FROM cart WHERE username = '{$user_name}' AND paid = '{$paid}'");
  }
}

//This function update wish list and cart.
function cart_wishlist_update($mode,$db,$item,$cart_id,$user_name,$json_update,$cart_expire,$available){
  $paid = 0;
  if($mode == 'wishlist'|| $mode == 'wish'){
    $cartQ = $db->query("SELECT * FROM wishlist WHERE username = '{$user_name}'");
  }else{
    $cartQ = $db->query("SELECT * FROM cart WHERE username = '{$user_name}' AND paid = '{$paid}'");
  }
  $return = mysqli_num_rows($cartQ);
  if($return != 1){
    $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
    $exp_time = time();
      if($mode != 'wishlist'){
      $items_json = json_encode($item);
        if($mode == 'cart'){
          $db->query("INSERT INTO cart (items,username,expire_date,exp_time) VALUES ('{$items_json}','{$user_name}','{$cart_expire}','{$exp_time}')");
        $cart_id = $db->insert_id; //return the last inserted item in database
        $_SESSION['success_flash'] = ' Item added to Cart successfully.';
          $_SESSION['cartid'] = $cart_id;
       }else{
         $db->query("INSERT INTO wishlist (items,username,expire_date) VALUES ('{$items_json}','{$user_name}','{$cart_expire}')");
         $w_id = $db->insert_id; //return the last inserted item in database
         $_SESSION['success_flash'] = $wish_id.' Item added to Wish List successfully.';
        }
      }else{
      $db->query("INSERT INTO wishlist (id,username,items,expire_date) VALUES ('{$cart_id}','{$user_name}','{$json_update}','{$cart_expire}')");
      $_SESSION['success_flash'] =  'wishlist update successful..';
      }
  }else{
    $cart = mysqli_fetch_assoc($cartQ);
    $previous_items = json_decode($cart['items'],true); //makes it an associated array not an object
    $item_match = 0;
    $new_items = array();
    //$_SESSION['success_flash'] = $product['title']. ' in loop.';
      foreach ($previous_items as $pitem){
        if($item[0]['id'] == $pitem['id'] && $item[0]['size'] == $pitem['size']){
          if($mode == 'cart'){
              if($available == 0){
              $pitem['quantity'] = $pitem['quantity']; // do not update quantity for same item
            }else{
              $pitem['quantity'] =$pitem['quantity'] + $item[0]['quantity'];
            }
          }else{
            $pitem['quantity'] =$pitem['quantity'] + $item[0]['quantity'];
          }
        $item_match = 1;
      }
      $new_items[] = $pitem;
    }

    if($item_match != 1){
      $new_items = array_merge($item,$previous_items);
    }
    $items_json = json_encode($new_items);
    $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
    $exp_time = time();

      if($mode == 'cart'){
         $db->query("UPDATE cart SET items = '{$items_json}', expire_date = '{$cart_expire}', exp_time = '{$exp_time}'
                     WHERE username = '{$user_name}' AND paid = '{$paid}'");
         $_SESSION['success_flash'] =  'cart update successful..';
      }else{
        $db->query("UPDATE wishlist SET items = '{$items_json}', expire_date = '{$cart_expire}' WHERE username = '{$user_name}'");
        $_SESSION['success_flash'] =  'wishlist update successful..';
      }
  }
}
