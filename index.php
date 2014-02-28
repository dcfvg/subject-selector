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
    
    case 'parts':
      $set_name   = $_GET["set_name"];
      $img_list = glob("$assets/sets/$set_name/*.jpg");
      $active["parts"] = "active";

      foreach ($img_list as $id => $img){
        $img_selectionFile = $img.".md";
        $id = basename($img, ".jpg");
        $img_selection = unserialize (file_get_contents($img_selectionFile));
        
        if(file_exists($img_selectionFile)) $hasdata[$id] = "hasdata";
        $html.= '<div id="'.$id.'" class="part" style="
            background:url('.$img.');
            background-position:-'.$img_selection["x1"].'px -'.$img_selection["y1"].'px;
            width:'.$img_selection["width"].'px;
            height:'.$img_selection["height"].'px;
        " >.</div>';
      }
      $html = '<div id="pack" class="js-packery"
        data-packery-options=\'{ "itemSelector": ".part", "gutter": 5 }\' >'.$html.'</div>';
    break;
    default:$sets_list = sets_menu( $assets);break;
  }
  $nav_elemnt = array(
    "edit"    => "glyphicon-record", 
    "view"    => "glyphicon-picture", 
    "heatmap" => "glyphicon-signal", 
    "parts"    => "glyphicon-th"
  );
  if(isset($active)) {
    

    foreach ($nav_elemnt as $mode => $icon) {
      $nav_html .= '<li class="'.$active[$mode].'"><a href="?set_name='.$set_name.'&mode='.$mode.'"><span class="glyphicon '.$icon.'"> '.$mode.' </span></a></li>'; 
    }
    $nav_html = '<ul class="nav nav-tabs">'.$nav_html.'</ul>';
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
              <a class="navbar-brand" href="index.php">subject selector</a>
            </div>
          </div>
    </div>
    <div class="container">
      <p class="lead"><?php echo $set_name ?></p>
      <?php echo $nav_html; ?>
      <?php echo $sets_list;?>
      <?php echo $html;?>
    </div>
      <script src="lib/jquery-2.1.0.min.js"></script>
      <script src="lib/jquery.imgareaselect-0.9.10/scripts/jquery.imgareaselect.pack.js"></script>
      <script src="lib/packery.pkgd.min.js"></script>
      <script src="js/subsel.js"></script>
      
  </body>
  
  
</html>