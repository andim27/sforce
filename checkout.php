<?php

if (isset($_GET['type'])&& ($_GET['type']=='slider')) {

   $f_id=$_GET['f_id'];
   if (is_dir(getcwd().'/output_html/sliders_html/'.$f_id)) {
     echo "yes";
   } else {
      include "sf_ext.php";
      echo "<br>No dir ".$f_id;
      $sf=new SfExt();
      $sf->takeFile($f_id);
      if (isset($_GET['f_name'])) {
          $sf->f_name=$_GET['f_name'];
      } else {
          $sf->f_name='index.html';
      }
      $sf->saveFile();
      $sf->createSliderHTML();
      echo $sf->state;
   }
}

?>