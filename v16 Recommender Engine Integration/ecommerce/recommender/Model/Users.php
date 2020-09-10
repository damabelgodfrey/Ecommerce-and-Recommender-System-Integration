<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecommerce/core/DBh.php';
class Users extends DBh{
  //update user last log in
    public function setUserLogin($sql,$date,$user_id){
     $myQuerry = $this->getConnection()->prepare($sql);
     $myQuerry->execute([$date,$user_id]);
    }
    //select a system user
  public function getUser($sql,$user_id){
    $myQuerry = $this->getConnection()->prepare($sql);
    $myQuerry->execute([$user_id]);
    $result = $myQuerry->fetchAll();
    return $result;
  }
  public function getUserByEmail($sql,$email){
    $myQuerry = $this->getConnection()->prepare($sql);
    $myQuerry->execute([$email]);
    return $myQuerry;
  }
  // public function getUserID($username,$sql){
  //   $myQuerry = $this->getConnection()->prepare($sql);
  //   $myQuerry->execute([$username]);
  //   $results = $myQuerry->fetchAll();
  //   foreach ($results as $key) {
  //   $id =  $key['id'];
  //   return $id;
  //   }
  //   //return $id;
  // }

  public function setUser($sql,$username,$name,$phone,$email,$hashed,$permissions){
    $myQuerry = $this->getConnection()->prepare($sql);
    $myQuerry->execute([$username,$name,$phone,$email,$hashed,$permissions]);
    return $myQuerry->lastInsertId();
  }

  public function setPassword($sql,$new_hashedpwd){
    $myQuerry = $this->getConnection()->prepare($sql);
    $myQuerry->execute([$new_hashedpwd,$user_id]);
  }

  public function setStaff($sql,$username,$name,$phone,$email,$hashed,$permissions,$ranks,$photopath){
    $myQuerry = $this->getConnection()->prepare($sql);
    $myQuerry->execute([$sql,$username,$name,$phone,$email,$hashed,$permissions,$ranks,$photopath]);
  }

  public function setUpdatedStaff($sql,$username1,$name1,$phone1,$email1,$photopath,$permissions1,$rank,$last_login,$edit_id){
    $myQuerry = $this->getConnection()->prepare($sql);
    $myQuerry->execute([$username1,$name1,$phone1,$email1,$photopath,$permissions1,$rank,$last_login,$edit_id]);
  }
}
