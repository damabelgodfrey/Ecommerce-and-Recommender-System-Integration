<style>
* {
  padding: 0;
  margin: 0;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  font-family: 'Droid Sans', sans-serif;
  outline: none;
}
body{
  background-color: #2a2b3d;
  color: white;
}

::-webkit-scrollbar {
  background: transparent;
  width: 5px;
  height: 5px;
}
::-webkit-scrollbar-thumb {
  background-color: #888;
}
::-webkit-scrollbar-thumb:hover {
  background-color: rgba(0, 0, 0, 0.3);
}

.navbar-toggle .middlebar {
	  top: 1px;
}

.navbar-toggle .bottombar {
  	top: 2px;
}

.navbar-toggle .icon-bar {
	  position: relative;
	  transition: all 500ms ease-in-out;
}

.navbar-toggle.active .topbar {
	  top: 6px;
	  transform: rotate(45deg);
    background-color: red;
}

.navbar-toggle.active .middlebar {
	  background-color: transparent;
}

.navbar-toggle.active .bottombar {
	  top: -6px;
	  transform: rotate(-45deg);
    background-color: red;
}
#contents {
  position: relative;
  transition: .3s;
  /*  margin-left: 290px; */
  background-color: #2a2b3d;
}
.margin {
  margin-left: 0 !important;
}
/* Start side navigation bar  */

.side-nav {
  float: left;
  height: 100%;
  width: 290px;
  background-color: #252636;
  color: #CCC;
  -webkit-transform: translateX(0);
  -moz-transform: translateX(0);
  transform: translateX(0);
  -webkit-transition: all .3s ease-in-out;
  -moz-transition: all .3s ease-in-out;
  transition: .3s;
  position: fixed;
  top: 0;
  left: 0;
  overflow: auto;
  z-index: 9999999
}
.side-nav .close-aside {
  position: absolute;
  top: 7px;
  right: 7px;
  cursor: pointer;
  color: #EEE;
}
.side-nav .heading {
  background-color: #252636;
padding: 10px 5px 5px 5px;
overflow: hidden;
border-bottom: 1px solid #2a2b3c;
}
.side-nav .heading > img {
  border-radius: 50%;
  float: left;
  width: 29%;
  height: 70px;
  margin-top: 5%;
}
.side-nav .info {
  float: left;
  width: 69%;
}
.side-nav .heading .info > h3 {margin: 0 0 5px}
.side-nav .heading .info > h3 > a {
  color: #EEE;
  font-weight: 100;
  margin-top: 4px;
  display: block;
  text-decoration: none;
  font-size: 18px;
}
.side-nav .heading .info > h3 > a:hover {
  color: #FFF;
}
.side-nav .heading .info > p {
  color: #BBB;
  font-size: 13px;
}
/* End heading */
/* Start search */
.side-nav .search {
  text-align: center;
  padding: 15px 30px;
  margin: 15px 0;
  position: relative;
}
.side-nav .search > input {
  width: 100%;
  background-color: transparent;
  border: none;
  border-bottom: 1px solid #23262d;
  padding: 7px 0 7px;
  color: #DDD
}
.side-nav .search > input ~ i {
  position: absolute;
  top: 22px;
  right: 40px;
  display: block;
  color: #2b2f3a;
  font-size: 19px;
}
/* End search */

.side-nav .categories > li {
  padding: 17px 40px 17px 30px;
  overflow: hidden;
  border-bottom: 1px solid rgba(255, 255, 255, 0.02);
  cursor: pointer;
}
.side-nav .categories > li > a {
  color: #AAA;
  text-decoration: none;
}
/* Start num: there are three options primary, danger and success like Bootstrap */
.side-nav .categories > li > a > .num {
  line-height: 0;
  border-radius: 3px;
  font-size: 14px;
  color: #FFF;
  padding: 0px 5px
}
.dang {background-color: #f35959}
.prim {background-color: #0275d8}
.succ {background-color: #5cb85c}
/* End num */
.side-nav .categories > li > a:hover {
  color: #FFF
}
.side-nav .categories > li > i {
  font-size: 18px;
  margin-right: 5px
}
.side-nav .categories > li > a:after {
  content: "\f053";
  font-family: fontAwesome;
  font-size: 11px;
  line-height: 1.8;
  float: right;
  color: #AAA;
  -webkit-transition: all .3s ease-in-out;
  -moz-transition: all .3s ease-in-out;
  transition: all .3s ease-in-out;
}
.side-nav .categories .opend > a:after {
  -webkit-transform: rotate(-90deg);
  -moz-transform: rotate(-90deg);
  transform: rotate(-90deg);
}
/* End categories */
/* Start dropdown menu */
.side-nav .categories .side-nav-dropdown {
  padding-top: 10px;
  padding-left: 30px;
  list-style: none;
  display: none;
}
.side-nav .categories .side-nav-dropdown > li > a {
  color: #AAA;
  text-decoration: none;
  padding: 7px 0;
  display: block;
}
.side-nav .categories p {
  margin-left: 30px;
  color: #535465;
  margin-top: 10px;
}

/* End dropdown menu */

.show-side-nav {
  -webkit-transform: translateX(-290px);
  -moz-transform: translateX(-290px);
  transform: translateX(-290px);
}


/* Start media query */
@media (max-width: 767px) {
  .side-nav .categories > li {
    padding-top: 12px;
    padding-bottom: 12px;
  }
  .side-nav .search {
    padding: 10px 0 10px 30px
  }
}

/* End side navigation bar  */
/* Start welcome */

.welcome {
  color: #CCC;
}
.welcome .content {
  background-color: #313348;
  padding: 15px;
  margin-top: 25px;
}
.welcome h2 {
  font-family: Calibri;
  font-weight: 100;
  margin-top: 0
}
.welcome p {
  color: #999;
}

.box {
  background-color: #404361;
  padding: 15px;
  overflow: hidden;
  color: #ffffff;
}
.table th{
  text-align:center;
  box-shadow: 7px 7px 15px rgba(0, 0, 0, 0.6);
  font-size: 16px;
  background-color: #2a2b3d;
  color: white;
}
.table{
  font-size: 14px;
  background-color: #c5c8e6;
  color: black;
}
/* Start statistics */
.statistics {
  margin-top: 25px;
  color: #CCC;
}
.statistics .box {
  background-color: #313348;
  padding: 15px;
  overflow: hidden;
}
.statistics .box > i {
  float: left;
  color: #FFF;
  border-radius: 50%;
  width: 60px;
  height: 60px;
  line-height: 60px;
  font-size: 22px;
}
.statistics .box .info {
  float: left;
  width: auto;
  margin-left: 10px;
}
.statistics .box .info h3 {
  margin: 5px 0 5px;
  display: inline-block;
}
.statistics .box .info p {color:#BBB}

/* End statistics */
/* Start charts */
.charts {
  margin-top: 25px;
  color: #BBB
}
.charts .chart-container {
  background-color: #404361;
  padding: 15px;
}
.charts .chart-container h3 {
  margin: 0 0 10px;
  font-size: 17px;
}

/* Start users */

.admins {
  margin-top: 25px;
}
.admins .box {

}
.admins .box > h3 {
  color: #ccc;
  font-family: Calibri;
  font-weight: 300;
  margin-top: 0;
}
.admins .box .admin {
  margin-bottom: 20px;
  overflow: hidden;
  background-color: #313348;
  padding: 10px;
}
.admins .box .admin .img {
  width: 20%;
  margin-right: 5%;
  float: left;
}
.admins .box .admin .img img {
  border-radius: 50%;
}
.admins .box .info {
  width: 75%;
  color: #EEE;
  float: left;
}
.admins .box .info h3 {font-size: 19px}
.admins .box .info p {color: #BBB}

/* End users */
/* Start statis */

.statis {
  color: #EEE;
  margin-top: 15px;
}
.statis .box {
  position: relative;
  padding: 15px;
  overflow: hidden;
  border-radius: 3px;
  margin-bottom: 25px;
}
.statis .box h3:after {
  content: "";
  height: 2px;
  width: 70%;
  margin: auto;
  background-color: rgba(255, 255, 255, 0.12);
  display: block;
  margin-top: 10px;
}
.statis .box i {
  position: absolute;
  height: 70px;
  width: 70px;
  font-size: 22px;
  padding: 15px;
  top: -25px;
  left: -25px;
  background-color: rgba(255, 255, 255, 0.15);
  line-height: 60px;
  text-align: right;
  border-radius: 50%;
}

/*chart*/
.chrt3 {
  padding-bottom: 50px;
}
.chrt3 .chart-container {
  height: 350px;
  padding: 15px;
  margin-top: 25px;
}
.chrt3 .box {
  padding: 15px;
}

.main-color {
  color: #ffc107
}
.warning {background-color: #f0ad4e}
.danger {background-color: #d9534f}
.success {background-color: #5cb85c}
.inf {background-color: #5bc0de}

/* Start bootstrap */
.navbar-right .dropdown-menu {
  right: auto !important;
  left: 0 !important;
}
.navbar-default {
  background-color: #6f6486 !important;
  border: none !important;
  border-radius: 0 !important;
  margin: 0 !important
}
.navbar-default .navbar-nav>li>a {
  color: white !important;
  line-height: 45px !important;
}
.navbar-default .navbar-brand {color:#FFF !important}
.navbar-default .navbar-nav>li>a:focus,
.navbar-default .navbar-nav>li>a:hover {color: #EEE !important}

.navbar-default .navbar-nav>.open>a,
.navbar-default .navbar-nav>.open>a:focus,
.navbar-default .navbar-nav>.open>a:hover {background-color: transparent !important; color: #FFF !important}

.navbar-default .navbar-brand { line-height: 35px !important;
  background: url(../images/headerlogo/logo.jpg) center / contain no-repeat;
  width: 120px;
  padding: 0 15px;
  height: 75px;
}
.navbar-default .navbar-brand:focus,
.navbar-default .navbar-brand:hover {color: #FFF !important}
.navbar-default .myproduct:focus,
.navbar-default .myproduct:hover {color: #FFF !important}
.navbar>.container .navbar-brand, .navbar>.container-fluid .navbar-brand {margin: 0 !important}
.navbar>.container .myproduct, .navbar>.container-fluid .myproduct {margin: 0 !important}
.navbar-default .myproduct {
    /* height: 50px; */
    padding: 15px 15px;
    font-size: 18px;
    line-height: 45px;

  }
  @media (min-width: 767px) {
    .navbar-default .myproduct {
    position: absolute;
    left: 35%;}
  }
@media (max-width: 767px) {
  .navbar>.container-fluid .navbar-brand {
    margin-left: 1px !important;
  }
  .navbar-default .navbar-brand {    line-height: 20px !important;
    background: url(../images/headerlogo/logo.jpg) center / contain no-repeat;
    width: 120px;
    padding: 0 15px;
    height: 60px;
}
  .navbar-default .myproduct {line-height: 20px !important;
    float: right;
      /* height: 50px; */
      padding: 15px 15px;
      font-size: 18px;
  }
  .navbar-default .navbar-nav>li>a {
    padding-left: 0 !important;
  }
  .navbar-nav {
    margin: 0 !important;
  }
  .navbar-default .navbar-collapse,
  .navbar-default .navbar-form {
    border: none !important;
  }

}

.navbar-default .navbar-nav>li>a {
  float: left !important;
}
.navbar-default .navbar-nav>li>a>span:not(.caret) {
  background-color: #e74c3c !important;
  border-radius: 50% !important;
  height: 25px !important;
  width: 25px !important;
  padding: 2px !important;
  font-size: 11px !important;
  position: relative !important;
  top: -10px !important;
  right: 5px !important
}
.dropdown-menu>li>a {
  padding-top: 5px !important;
  padding-right: 5px !important;
}
.navbar-default .navbar-nav>li>a>i {
  font-size: 22px !important;
  line-height: 35px;
}

/* Start media query */
@media (max-width: 767px) {
  #contents {
    margin: 0 !important
  }
  .statistics .box {
    margin-bottom: 25px !important;
  }
  .navbar-default .navbar-nav .open .dropdown-menu>li>a {
    color: #CCC !important
  }
  .navbar-default .navbar-nav .open .dropdown-menu>li>a:hover {
    color: #FFF !important
  }
  .navbar-default .navbar-toggle{
    border:none !important;
    color: #EEE !important;
    font-size: 18px !important;
  }
  .navbar-default .navbar-toggle:focus, .navbar-default .navbar-toggle:hover {background-color: transparent !important}
}
.container-fluid>.navbar-collapse, .container-fluid>.navbar-header, .container>.navbar-collapse, .container>.navbar-header {
    padding: 0 50px
  }
<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecommerce/core/staff-init.php';
 if(isset($_SESSION['total_item_ordered'])){
  $total_message= $_SESSION['total_item_ordered'];
}else{
  $total_item ='';
}
$status = 'unread';
$msgQ = $db->query("SELECT * FROM contact WHERE status = '{$status}'");
$unread_messages = mysqli_num_rows($msgQ);

$product_countQ = $db->query("SELECT * FROM products WHERE archive = 0 ");
$product_count = mysqli_num_rows($product_countQ);

$product_archive_countQ = $db->query("SELECT * FROM products WHERE archive = 1 ");
$product_archive_count = mysqli_num_rows($product_archive_countQ);

$customer_countQ = $db->query("SELECT * FROM customer_user");
$customer_count = mysqli_num_rows($customer_countQ);

$staff_countQ = $db->query("SELECT * FROM staffs");
$staff_count = mysqli_num_rows($staff_countQ);

$defective_productQ = $db->query("SELECT * FROM products WHERE archive = 0 AND  defective_product = 1");
$defective_product = mysqli_num_rows($defective_productQ);
$onsaleQ = $db->query("SELECT * FROM products WHERE archive = 0 AND  sales = 1");
$onsale = mysqli_num_rows($onsaleQ);
$onfeaturedQ = $db->query("SELECT * FROM products WHERE archive = 0 AND  featured = 1");
$onfeatured = mysqli_num_rows($onfeaturedQ);
$dyear =  date('Y');
$dmonth = date('m');
$dtL = DateTime::createFromFormat('!m',$dmonth);
$monthL = $dtL->format("F");
$YrQ = $db->query("SELECT * FROM transactions WHERE YEAR(txn_date) = '{$dyear}' AND MONTH(txn_date)= '{$dmonth}'");
//$YrQ = $db->query("SELECT * FROM transactions WHERE YEAR(txn_date) = '{$dyear}'");

$monthDailSale = array();
$monthTotal = 0;
$noofTrans = 0;
$total_item_count = 0;
$unique_item_count = 0;
while($x = mysqli_fetch_assoc($YrQ)){
  $day = (int)date("d",strtotime($x['txn_date']));
  $noofTrans++;
    if(!array_key_exists($day,$monthDailSale)){
      $monthDailSale[(int)$day] = $x['grand_total'];
    }else{
      $monthDailSale[(int)$day] += $x['grand_total'];
    }
  $monthTotal += $x['grand_total'];
  $items = json_decode($x['items'],true);
  $unique_item_count += count($items);
  foreach($items as $item){
    $total_item_count += $item['quantity'];
    }
}
?>
</style>
  <body>
    <aside class="side-nav" id="show-side-navigation1">
      <i class="fa fa-bars close-aside hidden-sm hidden-md hidden-lg" data-close="show-side-navigation1"></i>
      <div class="heading text-center">
        <img src="<?=$staff_data['photo'];?>" alt="saved image"/><br>
        <div class="info">
          <h3><a href="#"><?=$staff_data['full_name'];?></a></h3>
          <p><strong>Rank:</strong> <?=$staff_data['rank'];?></p>
          <p><strong>Email:</strong> <?=$staff_data['email'];?></p>
        </div>
      </div>
      <div class="search">
        <input type="text" placeholder="Type here"><i class="fa fa-search"></i>
      </div>
      <ul class="categories">
        <?php if(check_staff_permission('admin')): ?>
          <li><i class="fa fa-home fa-fw" aria-hidden="true"></i><a href="#">Transactions</a>
            <ul class="side-nav-dropdown">
              <li><a href="orderedItem">Order To Ship</a></li>
              <li><a href="inventory">Inventory</a></li>
              <li><a href="storeTransactions">Transactions</a></li>
              <li><a href="exploresales">Explore Sales</a></li>
            </ul>
          </li>
      <?php endif; ?>

        <?php if(check_staff_permission('admin')): ?>
          <li><i class="fa fa-support fa-fw"></i><a href="#"> My Admin</a>
            <ul class="side-nav-dropdown">
              <li><a href="staff_account">Staff Account</a></li>
              <li><a href="customer_account">Customers</a></li>
              <li><a href="permissions">Permissions</a></li>
              <li><a href="staff_rank">Staff Rank</a></li>
              <li><a href="refresh_page">unread_messages Product</a></li>
            </ul>
          </li>
      <?php endif; ?>
      <li><i class="fa fa-envelope fa-fw"></i><a href="#">Product & Settings</a>
        <ul class="side-nav-dropdown">
          <li><a href="products">Product</a></li>
          <li><a href="brands">Brands Manager</a></li>
          <li><a href="categories">Categories Manager</a></li>
          <li><a href="archiveproducts">Archive Products</a></li>
          <li><a href="discount">Discount Manager</a></li>
        </ul>
      </li>
      <li><i class="fa fa-users fa-fw"></i><a href="#">Staffs & Customers</a>
        <ul class="side-nav-dropdown">
          <li><a href="staff_account">Staffs</a></li>
          <li><a href="customer_account">Customers</a></li>
        </ul>
      </li>
      <li>

        <?php if($unread_messages == 0) {?>
          <i class="fa fa-envelope-open-o fa-fw"></i><a href="receivedmessage"> Messages <span class="num dang"></span></a>
      <?php }else{ ?>
        <i class="fa fa-envelope-open-o fa-fw"></i><a href="receivedmessage"> Messages <span class="num dang"><?=$unread_messages; ?> </span></a>
      <?php } ?>
      </li>
      <li><i class="fa fa-wrench fa-fw"></i><a href="#"> Settings <span class="num prim">3</span></a>
        <ul class="side-nav-dropdown">
          <li><a href="settings">Global Settings</a></li>
          <li><a href="slide">SlideShow Manager</a></li>
          <li><a href="appearance">appearance Setting</a></li>
        </ul>
      </li>
      <li><i class="fa fa-laptop fa-fw"></i><a href="#"> About us &amp;  <span class="num succ">U</span></a></li>
      <li><i class="fa fa-comments-o fa-fw"></i><a href="#"> Message Admin</a></li>
      </ul>
      </aside>
    <section id="contents">
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <i class="fa fa-align-right"></i>
            </button>
            <a class="navbar-brand" href="index"></a>
            <a class="myproduct" href="products">my<span class="main-color">Products</span></a>
          </div>
          <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?=(isset($staff_data['first'])?'Hello '. $staff_data['first']:'Account');?><span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <?php  if(isset($staff_data['first'])){ ?>
                    <li><a href="change_password"><i class="fa fa-user-o fw"></i> Change Password</a></li>
                    <li><a href="#"><i class="fa fa-envelope-o fw"></i> My inbox</a></li>
                    <li><a href="#"><i class="fa fa-question-circle-o fw"></i> Help</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="logout"><i class="fa fa-sign-out"></i> Log out</a></li>
                  <?php  }else{ ?>
                    <li><a href="login">Sign In</a></li>
                   <?php } ?>
                </ul>
              </li>
              <li><a id="receivedmessage" href="receivedmessage"><i class="fa fa-comments"></i><span><?=$unread_messages?></span></a></li>
              <li><a href="#"><i class="fa fa-bell-o"></i><span>98</span></a></li>
              <li><a href="#" id=bugger>
                <i data-show="show-side-navigation1" class="fa fa-bars show-side-btn"></i></a></li>
            </ul>
          </div>
        </div>
      </nav>
<br><br><br><p></p>
