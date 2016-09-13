<?php
function givePoPrefix($len,$v)
{
	if($len == 1)
	{
		$tae = '00'.$v;
	}
	else if($len == 2)
	{
		$tae = '0'.$v;
	}
	else if($len == 3)
	{
		$tae = $v;
	}
	
	return $tae;
}

function removeEmpty($a)
{
	$b = array();
	$x = 0;
	for($i = 0; $i< sizeof($a); $i++)
	{
		if($a[$i] != '')
		{
			$b[$x] = trim($a[$i]);
			$x++;
		}
	}
	return $b;
}
?>