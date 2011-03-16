<?php
class DateFunctions {

	public function dateFormated($date) {
		$date = strtotime($date);
		return date('d/m/Y H:i:s', $date);
	}
	
	public function dateTimeFormated($date, $array_field=false) {
		
		if($array_field===false) {
			$date = strtotime($date);
			return date('d/m/Y H:i:s', $date);
		}
		else {
		 	foreach($date as $item) 
		 		if($item==$array_field) {
		 			$item = strtotime($item);
		 			return date_format($item, 'd/m/Y H:i:s');
		 		}
		}
	
	}
	
}