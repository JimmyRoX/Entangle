<?php
	
	/*
	
		header('Content-Description: File Transfer');
		//header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.$file->getFilename());
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . $file->getSize());
	//	ob_clean();
		//flush();
		//readfile(file->getBytes());
		//exit;
	
	
	header('Content-type: application/pdf;');
	echo $file->getBytes();
	exit;
	* */
	//if ( (substr($ask,-3) == 'zip') || (substr($ask,-3) == 'pdf') ) {
       /* Any file types you want to be downloaded can be listed in this */
       header('Content-Type: application/octet-stream');
       header('Content-Disposition: attachment; filename=pdf'); 
       header('Content-Transfer-Encoding: binary');
       
       foreach($cursor as $chunk) {
          echo $chunk['data']->bin;
       }
    }
    
	
?>


