<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/tutorial/core/init.php';
  include 'includes/head.php';
  include 'includes/navigation.php';
  $sql = "SELECT * FROM categories WHERE parent =0";
  $result =$db->query($sql);
  $errors= array();
  $category = '';
  $post_parent ='';

  //Edit CATEGORIES
  if(isset($_GET['edit']) && !empty($_GET['edit'])){
    $edit_id = (int)$_GET['edit'];
    $edit_id = sanitize($edit_id);
    $edit_sql = "SELECT * FROM categories WHERE id = '$edit_id'";
    $edit_result = $db->query($edit_sql);
    $edit_category = mysqli_fetch_assoc($edit_result);


  }

  //Delete category
  if(isset($_GET['delete']) && !empty($_GET['delete'])){
    $delete_id = (int)$_GET['delete'];  //pull the value from the url
    $delete_id = sanitize($delete_id);
    $sql = "SELECT * FROM categories WHERE id = '$delete_id'";
    $result = $db->query($sql);
    $category = mysqli_fetch_assoc($result);
    //if parent category has sub category delete sub categories
    if($category['parent'] == 0){
      $sql = "DELETE FROM categories WHERE parent = '$delete_id'";
      $db->query($sql);
    }
   //delete parent category
    $dsql = "DELETE FROM categories WHERE id = '$delete_id'";
    $db->query($dsql);
  header('Location: categories.php');
  }
  //Process form
  if(isset($_POST) && !empty($_POST)){
    $post_parent =  sanitize(trim($_POST['parent'])); //trim remove white space and sanitize deactivate html code
    $category = sanitize(trim($_POST['category']));
    $sqlform = "SELECT * FROM categories WHERE category = '$category' AND parent = '$post_parent'";
    if(isset($_GET['edit'])){
      $id =$edit_category['id'];
      $sqlform = "SELECT * FROM categories WHERE category = '$category' AND parent = '$post_parent' AND id != '$id'";
    }
    $fresult = $db->query($sqlform);
    $row_count = mysqli_num_rows($fresult);
    // if category is blank
    if($category ==''){
      $errors[].= 'The category cannot be left blank';
    }
    //if exist in Database
    if($row_count > 0){
      $errors[] .= $category. ' already exists. Please choose a new category.';
    }
    //Display Errors or update Database
    if(!empty($errors)){
      //pass errors into display_errors function in helpers.php to return the error as html
      $display =display_errors($errors); ?>
      <!--Display error on screen by using jquery to plug in the html-->
      <script>
        jQuery('document').ready(function(){
          jQuery('#errors').html('<?=$display; ?>');
        });
      </script>
    <?php }else{
      //update database
      $updatesql = "INSERT INTO categories (category, parent) VALUES ('$category', '$post_parent')";
      //if we are editing then update not insert
      if(isset($_GET['edit'])){
        $updatesql = "UPDATE categories SET category = '$category', parent = '$post_parent' WHERE id = '$edit_id'";
      }
      $db->query($updatesql);
      header('Location: categories.php'); //refresh page
    }
  }
  //set category box to empty string but if edit is clicked set to edit value
  $category_value ='';
  $parent_value =0;
  if(isset($_GET['edit'])){
    $category_value = $edit_category['category'];
    $parent_value = $edit_category['parent'];
  }else{
    if(isset($_POST)){
      $category_value = $category; //keep category name in box even if it fails
      $parent_value = $post_parent; //if form is submitted set parent to the parent value on the submitted form
    }
  }
 ?>
<h2 class = "text-center">CATEGORIES</h2><hr>
  <div class="row">
    <!-- Form -->
      <div class="col-md-6">
       <form class ="form action=categories.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" method="post">
         <legend><?=((isset($_GET['edit']))?'Edit': 'Add A');?> Category</legend> <!-- set to add category (default) if there is no edit category request -->
         <div id='errors'> </div> <!-- print error just above add a category label-->
         <div class ="form-group">
           <label for="parent">Parent</label>
             <select class="form-control" name="parent" id="parent">
               <option value ="0"<?=(($parent_value == 0)?'selected="selected"':'');?>>PARENT</option>
               <?php while($parent = mysqli_fetch_assoc($result)): ?>
                 <option value ="<?=$parent['id'];?>"<?=(($parent_value == $parent['id'])?' selected="selected"':'');?>><?=$parent['category'];?></option>
               <?php endwhile; ?>
             </select>
           </div>
           <div class="form-group">
             <label for ="category">Category</label>
             <input type="text" class="form-control" id="category" name ="category" value = "<?=$category_value;?>">
           </div>
           <div class="form-group">
             <!--Add or edit category button -->
             <input type="submit" value="<?=((isset($_GET['edit']))?'Edit': 'Add');?> Category" class= "btn btn-success"> <!--set button label value to (Add default) or edit category -->
           </div>
         </form>
       </div>

        <!-- Category Table -->
        <div class="col-md-6">
          <table class="table table-bordered">
          <thead>
            <th>Category</th><th>Parent</th><th></th>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM categories WHERE parent =0";
            $result =$db->query($sql);
            while($parent = mysqli_fetch_assoc($result)):
              $parent_id =(int)$parent['id'];
              $sql2 = "SELECT * FROM categories WHERE parent ='$parent_id'";
              $cresult =$db->query($sql2);
            ?>
            <!--bg-primary bootsrap class to make table blue -->
             <tr class= "bg-primary">
               <td><?=$parent['category'];?></td>
               <td>Parent</td>
               <td>
                <a href="categories.php?edit=<?=$parent['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                <a href="categories.php?delete=<?=$parent['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
               </td>
             </tr>
             <?php while($child =mysqli_fetch_assoc($cresult)):  ?>
               <tr class= "bg-info">
                 <td><?=$child['category'];?></td>
                 <td><?=$parent['category'];?></td>
                 <td>
                  <a href="categories.php?edit=<?=$child['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                  <a href="categories.php?delete=<?=$child['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
                 </td>
               </tr>
             <?php endwhile;?>
           <?php endwhile;?>
          </tbody>
        </table>
    </div>
  </div>
 <?php include 'includes/footer.php' ?>
