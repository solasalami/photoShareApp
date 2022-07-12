<?php
session_start();

require_once('database.php');
$db = $conn; //  Connection variable;
$tableName = 'gallery'; // table Name;
$errors = array();
$location = "";
$title    = "";
$caption    = "";


// upload image on submit
if (isset($_POST['submit'])) {
   echo upload_image($tableName);
}

function upload_image($tableName)
{

   global $db;
   $uploadTo = "../uploads/";
   $allowedImageTypes = array('jpg', 'png', 'jpeg', 'gif');
   $imageName = array_filter($_FILES['image_gallery']['name']);
   $imageTempName = $_FILES["image_gallery"]["tmp_name"];
   $location = mysqli_real_escape_string($db, $_POST['location']);
   $title    = mysqli_real_escape_string($db, $_POST['title']);
   $caption    = mysqli_real_escape_string($db, $_POST['caption']);

   $errors = array();


   $tableName = trim($tableName);

   if (empty($location)) {
      $error = "<p style='color:red'> Please enter location </p>";
      return $error;
   }

   if (empty($title)) {
      $error = "<p style='color:red'> Please enter title  </p>";
      return $error;
   }

   if (empty($caption)) {
      $error = "<p style='color:red'> Please enter caption </p>";
      return $error;
   }



   if (empty($imageName)) {
      $error = "<p style='color:red'> Please select an image </p>";
      return $error;
      //array_push($errors, "Please select an image");
      return;
   } else if (empty($tableName)) {
      $error = "You must specify a table name";
      return $error;
   } else {
      $error = $savedImageBasename = '';
      foreach ($imageName as $index => $file) {

         $imageBasename = basename($imageName[$index]);
         $imagePath = $uploadTo . $imageBasename;
         $imageType = pathinfo($imagePath, PATHINFO_EXTENSION);

         if (in_array($imageType, $allowedImageTypes)) {

            // Upload image to server 
            if (move_uploaded_file($imageTempName[$index], $imagePath)) {

               // Store image into database table
               $savedImageBasename .=  $imageBasename;
            } else {
               $error =
                  "<p style='color:red'> File not uploaded successfully</p>";
            }
         } else {
            $error .= $_FILES['file_name']['name'][$index] . ' - file extensions not allowed<br> ';
            $error =
               "<p style='color:red'>" . $error . "</p>";
         }
      }
      save_image($savedImageBasename, $tableName, $location, $title, $caption);
   }
   return $error;
}
// File upload configuration 
function save_image($savedImageBasename, $tableName, $location, $title, $caption)
{

   global $db;
   if (!empty($savedImageBasename)) {
      $value = trim($savedImageBasename, ',');
      $saveImageQuery = "INSERT INTO " . $tableName . " (image_name,location,title,caption) VALUES('" . $value . "','" . $location . "','" . $title . "','" . $caption . "')";
      $exec = $db->query($saveImageQuery);
      if ($exec) {
         echo "<p style='color:green'>Image is uploaded successfully </p>";
      } else {
         echo  "<p style='color:red'> Error: " .  $saveImageQuery . "<br>" . $db->error . "</p>";
      }
   }
}
