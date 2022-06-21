<?php
use function PHPUnit\Framework\fileExists;  

  function deleteMedia($oldImageProduct, $path)
 {
     $oldImage = public_path("assets/admin/img//$path//" . $oldImageProduct);
     if (file_exists($oldImage)) {
         unlink($oldImage);
     }
 }

 ?>