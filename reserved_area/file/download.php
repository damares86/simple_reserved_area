<?php 

  $type=filter_input(INPUT_GET,"type");
  $product=filter_input(INPUT_GET,"product");


  // download dei documenti

  if($type=='install' ||$type=='user'){
    $fileList = glob($product.'docs/'.$type.'/*.pdf');
    foreach($fileList as $filename){
      if(is_file($filename)){
        $file = $filename;
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
      }   
    }
  
  // download dei software
  
  } else if($type=='software'){
    //$fileList = glob($product.'/*.txt'); //per test in locale
    $fileList = glob($product.'/*.deb');
    foreach($fileList as $filename){
      if(is_file($filename)){
        $file = $filename;
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
      }   
    }
  }


?>