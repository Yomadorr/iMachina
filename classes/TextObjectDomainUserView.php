<?

	class TextObjectDomainUserView extends TextObjectDomainPlainView
	{
		var $textobjectviewType="domain";
		var $textobjectviewTypeSub="user";


		function viewDetailAccess( $app, $userId )
     	{
     		$str="";
     		
     		$str=$str."<div class='textObjectDomainUserView'>";

                    $str=$str."<h1>".$this->textobjectObject->getArgument()."</h1>";

                    $str=$str." PROFILE | CONTENT | GROUPS |";

                    // $str=$str.$this->viewDetail( $app, $userId );               

     			// add header here ...
     			// get user here ...
     			$userObj=$app->getUserById($this->textobjectObject->textobjectUserRef);
     			// print_r($userObj);
     			$str=$str."<div class='containerDomainUserHead'>";
	     			$str=$str."".$userObj->userName." ".$userObj->userPreName;
     			$str=$str."</div>";

     			// the content
	     		$str=$str.parent::viewDetailAccess($app,$userId);
	     	$str=$str."</div>";

     		return $str;
     	}

	}
	
    
?>