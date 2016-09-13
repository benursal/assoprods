<?php
	//array functions
function rBlankElements($arr, $test) // remove blank elements
{
	$x = 0;
	$newArr = array();
	foreach($arr as $k=>$v)
	{
		if(trim($v) != $test)
		{
			$newArr[$x++] = $v;
		}
	}
	return $newArr;
}

function getIndex($arr, $test) // get the index of the elements that meet the condition specified
{
	$holderArray = array();
	
	foreach($arr as $k=>$v)
	{
		if($v != $test)
		{
			$holderArray[] = $k;
		}
	}
	return $holderArray;
}

function matchIndex($arr1,$arr2) // arr1 is the array  which values will be extracted. Arr2 contains the indeces
{
	$holderArray = array();
	
	foreach($arr2 as $k=>$v)
	{
		$holderArray[] = $arr1[$v];
	}
	return $holderArray;
}
?>