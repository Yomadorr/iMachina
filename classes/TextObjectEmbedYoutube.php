<?

	class TextObjectEmbedYoutube extends TextObject
	{
		var $textobjectType="embed"; // name for 
    	var $textobjectTypeSub="youtube"; // name for 
    	var $innerCommentType="visual";
    	
    	
		function onInsert($app,$userId)
		{
		    $this->textobjectTimeLength = -1;
			$textobjectViewTmp=$app->getTextObjectViewFor($this, $app, $userId );
			$yTId = $textobjectViewTmp->getYoutubeId($this->textobjectArgumentText);
			$this->textobjectTimeLength = $textobjectViewTmp->getDuration($yTId);
			
		}

		function onUpdate($app,$userId)
		{
			if($this->textobjectTimeLength == -1){
				$textobjectViewTmp=$app->getTextObjectViewFor($this, $app, $userId );
				$yTId = $textobjectViewTmp->getYoutubeId($this->textobjectArgumentText);
				$this->textobjectTimeLength = $textobjectViewTmp->getDuration($yTId);
			}
		}

	}
	
    
?>