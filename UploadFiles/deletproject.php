<?php 
// function deleteDir($dirPath) {
//     if (! is_dir($dirPath)) {
//         throw new InvalidArgumentException("$dirPath must be a directory");
//     }
//     if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
//         $dirPath .= '/';
//     }
//     $files = glob($dirPath . '*', GLOB_MARK);
//     foreach ($files as $file) {
//         if (is_dir($file)) {
//             self::deleteDir($file);
//         } else {
//             unlink($file);
//         }
//     }
//     rmdir($dirPath);
// }
// function deleteDir2($dir) {
//   $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
//   $files = new RecursiveIteratorIterator($it,
//                RecursiveIteratorIterator::CHILD_FIRST);

//   foreach($files as $file) {
//       if ($file->isDir()){
//           rmdir($file->getRealPath());
//       } else {
//           unlink($file->getRealPath());
//       }
//   }
//   rmdir($dir);
// }
function rrmdir($dir) { 
   if (is_dir($dir)) { 
     $objects = scandir($dir);
     foreach ($objects as $object) { 
       if ($object != "." && $object != "..") { 
         if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
           rrmdir($dir. DIRECTORY_SEPARATOR .$object);
         else
           unlink($dir. DIRECTORY_SEPARATOR .$object); 
       } 
     }
     rmdir($dir); 
   } 
 }

if(isset($_GET['pname'])){
  $p_name=$_GET['pname'];
  $project_dir_path= dirname(__FILE__).'/Projects/';
  rrmdir($project_dir_path.$p_name);
  echo "Project ".$p_name ." has been deleted.";
}

?>
