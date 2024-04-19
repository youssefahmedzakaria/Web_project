<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
 $targetDir = __DIR__ . '/' . 'uploads/';
 $targetFile = $targetDir . basename($_FILES['image']['name']);
 

 if (!is_dir($targetDir)) {
     mkdir($targetDir);
 }
 
 
 if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
 echo "Image uploaded successfully!";
 } else {
 echo "Error uploading image.";
 }
}
?>

