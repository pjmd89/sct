<?php 
$files = array(
	"alerts.css",
	"base.css",
	"buttons.css",
	"containers.css",
	"forms.css",
	"navbars.css",
	"tooltips.css",
	"display-table.css",
	"icons.css",
	"icons-16.css",
	"fileupload.css",
	"modal.css",
	"table.css",
	"debugger.css"
);

$path = "css";

$out = "../sct.min.css";

minified($files, $path, $out);

function minified( $files , $path , $out ){
	
	$scan = scandir( $path );
	
	$fileToMini = array();
	
	if( count( $scan ) > 0 ){
		
		$mini = "";
		
		foreach( $scan as $file ){
			
			if( in_array($file , $files ) ){
				
				$openFile = file_get_contents($path."/".$file);
				
				$openFile =preg_replace('/\/\*[^\*]+\*\//', '', $openFile);
				$openFile =preg_replace('/,[\n\t\s]+/', ',', $openFile);
				$openFile =preg_replace('/{[\n\t\s]+/', '{', $openFile);
				$openFile =preg_replace('/[\n\t\s]+{/', '{', $openFile);
				$openFile =preg_replace('/;[\n\t\s]+/', ';', $openFile);
				$openFile =preg_replace('/}[\n\t\s]+/', '}', $openFile);
				
				$mini.=$openFile;
			}
		}
		$handle = fopen($path."/".$out, "w");
		
		fwrite( $handle , $mini );
		
		fclose( $handle );
	}
}
?>
