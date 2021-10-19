<?php
	class Format{
		public function formatDate($date){
			return date('F j, Y, g:i a', strtotime($date));

		}
		public function readMore($text, $limit=400){
			$text= $text." ";
			$text=substr($text, 0, $limit);
			$text=substr($text, 0, strrpos($text, ' '));
			$text=$text."...";
			return $text;

		}
		public function validation($data){
			$data=trim($data);
			$data=stripcslashes($data);
			$data=htmlspecialchars($data);
			return $data;

		}
	 
		public function title(){
			$path=$_SERVER['SCRIPT_FILENAME'];//fulll path name
			$title=basename($path, '.php');// last part after '/'
			$title=str_replace('_','', $title);//contuct_us.php
			 
			if($title=='index'){
				 $title='home';
			}
			elseif($title=='contact'){
				$title='contact';
			}
			return $title=ucwords($title); 
		}  

	}
?>