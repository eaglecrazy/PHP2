<?
$a = 5;
$b = 0;
try{
	$z = $a / $b;
}
catch(Exception $e){
   echo ('ERROR: ' . $e->getMessage());	
}



//throw new Exception("Будьте внимательнее")