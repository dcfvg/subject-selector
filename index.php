<?php
  include 'lib/functions.php';
  $assets = "assets";
  
  switch ($_GET["mode"]) {
    case 'view':
      $set_name   = $_GET["set_name"];
      $img_list = glob("$assets/sets/$set_name/*.jpg");
      $active["view"] = "active";
            
      foreach ($img_list as $id => $img){
        $img_selectionFile = $img.".md";
        $id = basename($img, ".jpg");
        
        if(file_exists($img_selectionFile)) $hasdata[$id] = "hasdata";
        $html.= '<img id="'.$id.'" class="'.$hasdata[$id].'" src="'.$img.'" alt="">';
      }
      $html = "<p>$html</p>";
      
    break;
    case 'edit':
      $set_name   = $_GET["set_name"];
      $img_list = glob("$assets/sets/$set_name/*.jpg");
      $active["edit"] = "active";
            
      foreach ($img_list as $id => $img){
        $img_selectionFile = $img.".md";
        $id = basename($img, ".jpg");
        
        if(file_exists($img_selectionFile)) $hasdata[$id] = "hasdata";
        $html.= '<img id="'.$id.'" class="photo '.$hasdata[$id].'" src="'.$img.'" alt="">';
      }
      $html = "<p>$html</p>";
    break;
    default:$sets_list = sets_menu( $assets);break;
  }
  
  if(isset($active)) {
    $nav = '
      <ul class="nav nav-tabs">
          <li class="'.$active["view"].'"><a href="?set_name='.$set_name.'&mode=view"><span class="glyphicon glyphicon-picture"> view </a></li>
          <li class="'.$active["edit"].'"><a href="?set_name='.$set_name.'&mode=edit"><span class="glyphicon glyphicon-edit"> edit </span></a></li>
      </ul>';
  }
?>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="lib/bootstrap-3.1.1-dist/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="lib/bootstrap-3.1.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/screen.css">
    <link rel="stylesheet" href="lib/jquery.imgareaselect-0.9.10/css/imgareaselect-custom.css">    
  </head>
  <body>
    <div class="navbar navbar-default navbar-static-top" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php">subject selector</a>
            </div>
          </div>
    </div>
    <div class="container">
      <p class="lead"><?php echo $set_name ?></p>
      <?php echo $nav; ?>
      <?php echo $sets_list;?>
      <?php echo $html;?>
    </div>
      <script src="lib/jquery-2.1.0.min.js"></script>
      <script src="lib/jquery.imgareaselect-0.9.10/scripts/jquery.imgareaselect.pack.js"></script>
      <script src="js/subsel.js"></script>
      
  </body>
  
  
</html>