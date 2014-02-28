<?php
  include 'helpers.php';
  function sets_menu( $assets){
    $sets_path = glob("$assets/sets/*/");
    foreach ($sets_path as $id => $set_path) {
      $img_count = count(glob($set_path."/*.jpg"));
      $sets_list .=  '<a class="list-group-item" href="?set_name='.basename($set_path).'&mode=view"><span class="badge">'.$img_count.'</span>'.basename($set_path).'</a>';
    }
    return '<p class="lead">choose a set</p><div class="list-group">'.$sets_list.'</div>'; 
  }
  function exif_select($exiffile){
    $exif = file_get_contents($exiffile);
    $lines  = explode("\n",$exif);
    
    foreach ($lines as $id => $line) {
      $lines[$id] = explode(": ",$line);

      $v = $lines[$id][0];
      $e = $lines[$id][1];
      if (stripos($v,"eadline")) $fields["headline"] = $e;
      if (stripos($v,"y-line")) $fields["by-line"] = $e;
      if (stripos($v,"bject")) $fields["object"] = $e;
      if (stripos($v,"abstract")) $fields["caption-abstract"] = $e;
    }
   return $fields;
  }
?>