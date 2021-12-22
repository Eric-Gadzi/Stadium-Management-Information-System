<?php


/**
 * THIS CLASS CHECKS DATE AGES AND MONTHS FOR VALIDATIONS
 */
class MyDate 
{
	function getAge($DOB){
	$bday = new DateTime($DOB); // Your date of birth
	$today = new Datetime(date('d.m.y'));
	$diff = $today->diff($bday);
	return $diff->y;
	}
	
}




	function getDay($event_date){
	$bday = new DateTime($event_date); // Your date of birth
	$today = new Datetime(date('d.m.y'));
	$diff = $today->diff($bday);
	return $diff->y;
	}

	$bday = new DateTime('11/12/2021');
	$today = new Datetime(date('d/m/y'));

	if($bday > $today){
		echo " It will happen tomorrow";
	}
	else{
		echo "It will not happen";
	}




?>