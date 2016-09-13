<?php

class successWebPage
{
	private $pageContent;

	public function successWebPage($content)
	{
	
		$this->pageContent = $content;
	}
	
	public function displayPage()
	{
		$file = file_get_contents("dropDownMenuLookAndFeel.php");
		$dropDownFile = file_get_contents("dropDown.php");
		
		return "<html>
							<head>
							<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
							<title>sample</title>
							<style>
							.tae{font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#FF0000}
							</style>
							<link rel=\"stylesheet\" type=\"text/css\" href=\"styles/newStyle.css\">
							".$file."
							</head>
							
							<body>
							<div id=\"wrapper\">
								<div id=\"header\">
									<div id=\"logo\">logo</div>
									<div id=\"banner\">
									  
									  <div id=\"menu\">".$dropDownFile."</div>
								  </div>
								</div>
								
								<div id=\"content\">
									<div id=\"title\">
									  <h3>Saving Successfull</h3>
									  <div id=successLinks>
									  
									".$this->pageContent."
										
									  </div>
									</div>
								</div>
									<div id=\"footer\">
										created by edward benedict ursal
									</div>
								</div>
								</form>
								</body>
								</html>
			";
	}
}



?>