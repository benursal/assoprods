<?php

class paginator
{
	private $numRecs;
	private $rpp;
	private $url;
	private $extraParams; //used for searches. Added so that the search results will continue to be displayed.
	
	public function paginator($numrecs, $rppage, $u)
	{
		$this->numRecs = $numrecs;
		$this->rpp = $rppage;
		$this->url = $u;
	}
	
	public function addParameters($params)
	{
		$this->extraParams = $params;
	}

	public function displayPageLinks($page)
	{
		if($this->rpp == "ALL")
		{
			$pages = 1;
		}
		else
		{
			$pages = $this->numRecs / $this->rpp;
			$extra = $this->numRecs % $this->rpp;
			if($extra>0)
			{
				$extra = 1;
			}
			$pages = floor($pages)+$extra;
		}
		
		echo "<table cellspacing=10><tr>";
		if($pages > 1)
		{
			for($x=1; $x <= $pages; $x++)
			{
				if($x == $page)
				{
					echo "<td bgcolor=lightblue><b>$x</b></td>";
				}
				else
				{
					echo "<td bgcolor=lightblue><a href=".$this->url."?page=$x&rpp=".$this->rpp.$this->extraParams.">".$x."</a></td>";
				}
			}
		}
		echo "</tr></table>";
	}
}
?>