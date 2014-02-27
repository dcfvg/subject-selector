<?php
  include 'lib/functions.php';
  $assets = "assets";
  
  if(!isset($_GET["set_name"])){
    $sets_list = sets_menu( $assets);
    $page_class = "home";
  }else{
    $set_name   = $_GET["set_name"];
    $img_list = glob("$assets/sets/$set_name/*.jpg");
    
    foreach ($img_list as $id => $img) {
      $html.= '<img id="photo" src="'.$img.'" alt="">';
    }
  }
?>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="lib/bootstrap-3.1.1-dist/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="lib/bootstrap-3.1.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/screen.css">
    <link rel="stylesheet" href="lib/jquery.imgareaselect-0.9.10/css/imgareaselect-default.css">
    
  </head>
  <body>

    <div class="container">
      <?php 
        echo $sets_list;
      ?>
      <div id="preview">      
        <h2><?php echo $set_name ?></h2>    
      </div>
      <?php echo $html;?>
    </div>
      <script src="lib/jquery-2.1.0.min.js"></script>
      <script src="lib/jquery.imgareaselect-0.9.10/scripts/jquery.imgareaselect.pack.js"></script>
      <script src="js/subsel.js"></script>
      
  </body>
  
  
</html>