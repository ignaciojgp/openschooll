<?php
header("content-type:text/javascript");
include_once("../core/core.php");
include_once("../model/themeauthor.class.php");
include_once("../model/lesson.class.php");

echo " \n probando theme \n";


try{
	
	$db = new ModelLesson();

	$res = $db-> save(6, 31, "prueba", "description", "content",  0, 5);
	//$res = $db->setCreatorToTheme(3,14);

	print_r($res);
	
	echo " \n fin de la prueba \n";
	
	
	
	
	

}catch(Exception $e){
	
	print_r($e);
	
	
}


?>