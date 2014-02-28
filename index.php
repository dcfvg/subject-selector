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
        $html.= '<p><img id="'.$id.'" class="'.$hasdata[$id].'" src="'.$img.'" alt=""></p>';
      }
      $html = "<div>$html</div>";
      
    break;
    case 'edit':
      $set_name   = $_GET["set_name"];
      $img_list = glob("$assets/sets/$set_name/*.jpg");
      $active["edit"] = "active";

      foreach ($img_list as $id => $img){
        $img_selectionFile = $img.".md";
        $id = basename($img, ".jpg");

        if(file_exists($img_selectionFile)) $hasdata[$id] = "hasdata";
        $html.= '<p><img id="'.$id.'" class="photo '.$hasdata[$id].'" src="'.$img.'" alt=""></p>';
      }
      $html = "<div>$html</div>";
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
        " ></div>';
      }
      $html = '<div id="pack" class="js-packery"
        data-packery-options=\'{ "itemSelector": ".part", "gutter": 10 }\' >'.$html.'</div>';
    break;
    case 'heatmap':
      $set_name   = $_GET["set_name"];
      $img_list = glob("$assets/sets/$set_name/*.jpg");
      $active["heatmap"] = "active";

      foreach ($img_list as $id => $img){
        $img_selectionFile = $img.".md";
        $id = basename($img, ".jpg");
        $img_selection = unserialize (file_get_contents($img_selectionFile));
        
        $x = $img_selection["x2"]-$img_selection["x1"];
        $y = $img_selection["y2"]-$img_selection["y1"];
        $count = 1; //$img_selection["width"]*$img_selection["height"];
        $max = 5;// max($count, $max);
        
        if(file_exists($img_selectionFile)) $hasdata[$id] = "hasdata";
        $data .= '{ x: '.$x.', y: '.$y.', count: '.$count.'},';
      }
      $script = '<script type="text/javascript">
      window.onload = function(){

          // heatmap configuration
          var config = {
              element: document.getElementById("heatmapArea"),
              radius: 50,
              opacity: 100,
          };

          //creates and initializes the heatmap
          var heatmap = h337.create(config);

          var data = {
            max: '.$max.', 
            data: [
              '.$data.'
            ]};
          heatmap.store.setDataSet(data);
      };
      

         
      </script>';
      $html = '
      <div class="lead" id="heatmapContainer">
        <div id="heatmapArea"></div>
      </div>';
    break;
    case 'zones':
      $set_name   = $_GET["set_name"];
      $img_list = glob("$assets/sets/$set_name/*.jpg");
      $active["zones"] = "active";
      foreach ($img_list as $id => $img){
        $img_selectionFile = $img.".md";
        $id = basename($img, ".jpg");
        
        unset($img_selection);
        
        if(file_exists($img_selectionFile)) {
          $img_selection = unserialize (file_get_contents($img_selectionFile));
          $hasdata[$id] = "hasdata";
        }
        /*
        background-image:url('.$img.');
        background-position:-'.$img_selection["x1"].'px -'.$img_selection["y1"].'px;
        */
        $html.= '
        <p id="'.$id.'" class="crop" style="

            width:'.$img_selection["width"].'px;
            height:'.$img_selection["height"].'px;
            top:'.$img_selection["y1"].'px;
            left:'.$img_selection["x1"].'px;
        " ></p>';
      }
      $html = '<div id="cropContainer">'.$html.'</div>';
    break;
    default:$sets_list = sets_menu( $assets);break;
  }
  $nav_elemnt = array(
    "edit"    => "glyphicon-pushpin", 
    "view"    => "glyphicon-picture",
    "parts"   => "glyphicon-th",
    "zones"   => "glyphicon-th-large",
    "heatmap" => "glyphicon-signal"

  );
  if(isset($active)) {
    

    foreach ($nav_elemnt as $mode => $icon) {
      $nav_html .= '<li class="'.$active[$mode].'"><a href="?set_name='.$set_name.'&mode='.$mode.'"><span class="glyphicon '.$icon.'"> '.$mode.' </span></a></li>'; 
    }
    $nav_html = '<ul class="nav nav-tabs">'.$nav_html.'</ul><p></p>';
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
      <script src="lib/heatmap.js"></script>
      
      <script src="js/subsel.js"></script>
      <?php echo $script ?>
  </body>
  
  
</html>