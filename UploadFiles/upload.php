<?php
// php.ini settings
// post_max_size = 2G
// upload_max_filesize = 2G
function rmdir_recursive($dir) {
   foreach(scandir($dir) as $file) {
       if ('.' === $file || '..' === $file) continue;
       if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
       else unlink("$dir/$file");
   }
   rmdir($dir);
}

if($_FILES["file"]["name"]) {
    $projectname;
    if(isset($_POST['projectname'])){
      $projectname=$_POST['projectname'];
    }
    $filename = $_FILES["file"]["name"];
    $source = $_FILES["file"]["tmp_name"];
    $type = $_FILES["file"]["type"];

    $name = explode(".", $filename);
    $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
    foreach($accepted_types as $mime_type) {
        if($mime_type == $type) {
            $okay = true;
            break;
        } 
    }

    $continue = strtolower($name[1]) == 'zip' ? true : false;
    if(!$continue) {
        $message = "The file you are trying to upload is not a .zip file. Please try again.";
    }

  /* PHP current path */
  $path = dirname(__FILE__).'/Projects/';  // absolute path to the directory where zipper.php is in
  $filenoext = basename ($filename, '.zip');  // absolute path to the directory where zipper.php is in (lowercase)
  $filenoext = basename ($filenoext, '.ZIP');  // absolute path to the directory where zipper.php is in (when uppercase)

  if(isset($projectname)){
      if (!file_exists($path .$projectname))
        mkdir($path .$projectname, 0777);
      //$targetdir = $path .$projectname."/" . $filenoext; // target directory
      $targetdir = $path .$projectname; // target directory
      $targetzip = $path .$projectname."/". $filename; // target zip file
  }else{
    $targetdir = $path . $filenoext; // target directory
    $targetzip = $path . $filename; // target zip file
  }

  /* create directory if not exists', otherwise overwrite */
  /* target directory is same as filename without extension */

  if (is_dir($targetdir))  rmdir_recursive ( $targetdir);

  mkdir($targetdir, 0777);

  /* here it is really happening */

    if(move_uploaded_file($source, $targetzip)) {
        $zip = new ZipArchive();
        $x = $zip->open($targetzip);  // open the zip file to extract
        if ($x === true) {
            $zip->extractTo($targetdir); // place in the directory with same name  
            $zip->close();

            unlink($targetzip);
        }
        $message = "Your .zip file was uploaded and 3D Project created successfully.";
    } else {    
        $message = "There was a problem with the upload. Please try again.";
    }
}
echo $message;
?>
