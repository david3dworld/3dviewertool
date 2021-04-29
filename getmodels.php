<?php 
$models = [];
if (isset($_GET['pname'])) {
  $durl=$_GET['durl'];
  $project_dir_path= dirname(__FILE__).'/Projects/'.$_GET['pname'];
  $fileList = glob($project_dir_path.'/*');
  foreach($fileList as $filename){
    if(is_file($filename)){
        $ll= explode('/', $filename);
        //echo $ll[count($ll)-1], '<br>'; 
        array_push($models ,$durl.$ll[count($ll)-1]);
    }   
  }
}
print "#model=".implode(",",$models);
?>