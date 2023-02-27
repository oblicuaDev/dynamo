<?php 
 if(isset($_FILES['file']['name'])){
   // file name
   $filename = $_FILES['file']['name'];

   // Location
   $location = 'upload/'.$filename;

   // file extension
   $file_extension = pathinfo($location, PATHINFO_EXTENSION);
   $file_extension = strtolower($file_extension);
   $destination_path = getcwd().DIRECTORY_SEPARATOR;
   $target_path = $destination_path .'uploads/'. basename( $_FILES["file"]["tmp_name"]) . "." . $file_extension;
   // Valid extensions
   $valid_ext = array("pdf","doc","docx","jpg","png","jpeg");

   $response = 0;
   if(in_array($file_extension,$valid_ext)){
      // Upload file
      if(move_uploaded_file($_FILES['file']['tmp_name'],$target_path)){
           $_POST["file"] = basename($_FILES['file']['tmp_name']) . "." . $file_extension;
           $response = 1;
      } 
   } 
}
if(isset($_FILES['portafolio']['name'])){
   // file name
   $filename = $_FILES['portafolio']['name'];

   // Location
   $location = 'upload/'.$filename;

   // file extension
   $file_extension = pathinfo($location, PATHINFO_EXTENSION);
   $file_extension = strtolower($file_extension);
   $destination_path = getcwd().DIRECTORY_SEPARATOR;
   $target_path = $destination_path .'uploads/'. basename( $_FILES["file"]["tmp_name"]) . "." . $file_extension;
   // Valid extensions
   $valid_ext = array("pdf","doc","docx","jpg","png","jpeg");

   $response = 0;
   if(in_array($file_extension,$valid_ext)){
      // Upload file
      if(move_uploaded_file($_FILES['portafolio']['tmp_name'],$target_path)){
           $_POST["portafolio"] = basename($_FILES['portafolio']['tmp_name']) . "." . $file_extension;
           $response = 1;
      } 
   } 
}
if(isset($_FILES['file2']['name'])){
   // file name
   $filename = $_FILES['file2']['name'];

   // Location
   $location = 'upload/'.$filename;

   // file extension
   $file_extension = pathinfo($location, PATHINFO_EXTENSION);
   $file_extension = strtolower($file_extension);
   $destination_path = getcwd().DIRECTORY_SEPARATOR;
   $target_path = $destination_path .'uploads/'. basename( $_FILES["file"]["tmp_name"]) . "." . $file_extension;
   // Valid extensions
   $valid_ext = array("pdf","doc","docx","jpg","png","jpeg");

   $response = 0;
   if(in_array($file_extension,$valid_ext)){
      // Upload file
      if(move_uploaded_file($_FILES['file2']['tmp_name'],$target_path)){
           $_POST["file2"] = basename($_FILES['file2']['tmp_name']) . "." . $file_extension;
           $response = 1;
      } 
   } 
}