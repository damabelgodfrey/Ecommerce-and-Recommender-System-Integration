<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecommerce/recommender/Model/Users.php';
/**
 *
 */

class UserController extends Users
{
  public function updateUserLogin($userType,$date,$user_username){
    if($userType == "customer"){
     $sql ="UPDATE customer_user SET last_login = ? WHERE username = ?";
    }else{
    $sql ="UPDATE staffs SET last_login = ? WHERE username = ?";
    }
   $myQuerry = $this->setUserLogin($sql,$date,$user_username);
  }

  public function selectUser($userType,$email){
    if($userType == "customer"){
      $sql ="SELECT * FROM customer_user WHERE email = '$email'";
    }else{
      $sql ="SELECT * FROM staffs WHERE email = '$email'";
    }
    return $this->getUser($sql,$email);
  }

  public function updatepassword($userType, $new_hashedpwd,$user_id){
    if($userType == "customer"){
      $sql = "UPDATE users SET password = '$new_hashed' WHERE id = '$user_id'";
    }else{
      $sql = "UPDATE users SET password = '$new_hashed' WHERE id = '$user_id'";
    }
    $this->setPassword($sql,$new_hashedpwd,$user_id);
  }

  public function registerUser($username,$name,$phone,$email,$hashed,$permissions){
    $sql = "INSERT INTO customer_user (username,full_name,phone,email,password,permissions) values(?,?,?,?,?,?)";
     return $this->setUser($sql,$username,$name,$phone,$email,$hashed,$permissions);

  }

  public function updateStaff($username1,$name1,$phone1,$email1,$photopath,$permissions1,$rank,$last_login,$edit_id){
    $sql = "UPDATE staffs SET username =?, full_name =?, phone=?, email =?, photo =?, permissions = ?,last_login =? WHERE id=?";
    $this->setUpdatedStaff($sql,$username1,$name1,$phone1,$email1,$photopath,$permissions1,$rank,$last_login,$edit_id);
  }
  public function registerStaff($username,$name,$phone,$email,$hashed,$permissions,$ranks,$photopath){
    $sql ="INSERT INTO staffs (username,full_name,phone,email,password,permissions,rank,photo) values(?,?,?,?,?,?,?,?)";
    $this->setStaff($sql,$username,$name,$phone,$email,$hashed,$permissions,$ranks,$photopath);

  }

}