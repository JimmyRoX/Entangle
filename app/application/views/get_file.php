<?php
	/*
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.$file->getFilename());
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: ' . $file->getSize());
	ob_clean();
	flush();
	echo $file->getBytes();
	exit;
    */
    echo "<br>id: ".$id;
    echo "<br>nombre: ".$file->getFilename();
    echo "<br>tama&ntilde;o: ".$file->getSize();
    
?>


