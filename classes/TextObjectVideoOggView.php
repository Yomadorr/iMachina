<?

	class TextObjectVideoOggView extends TextObjectView
	{
		var $textobjectviewType="video";
		var $textobjectviewTypeSub="ogg";
		
		var $textobjectviewIcon="VideoIcon.png"; // * not used
		var $textobjectviewIconBig="VideoIconBig.png"; // * not used
		var $textobjectviewLabel=".ogg VideoClip"; // @textobject.label*
		var $textobjectviewDescription="Upload  a .ogg-VideoClip"; // @textobject.description
		
		var $textobjectviewInteractionType="text"; // text|visual

		
			/*
			function viewList()
			{
				return $this->viewDetail();
			}

			function viewDetail()
			{
				return $this->viewHeader()."<pre>".$this->textobjectObject->textobjectId."  ".$this->textobjectObject->textobjectArgumentText."</pre>".$this->viewFooter();
			}
			*/
			

			function viewFormExtendedCoreContentForm( $addDivAction="" )
			{
				// todo: escape html-entities
				$str="\n 	<input type=hidden id='".$this->getDivId()."FormDatatextobjectId".$addDivAction."' value='".$this->textobjectObject->textobjectId."'> ";
				$str=$str."\n  	<input type=textfield size=50 id='".$this->getDivId()."FormDatatextobjectArgument".$addDivAction."' style='width: 100%' value='".$this->textobjectObject->textobjectArgumentText."''>";

				return $str;
			}
			
					function viewContent( )
					{
						$data= $this->textobjectObject->textobjectArgumentText;
						$textobjectID = $this->textobjectObject->textobjectId;
						$divID = $this->getDivId();
						
						
						// recalculate width and height
						$playerWidth = 640;
						$playerHeight = 390;
						
						if ($this->textobjectObject->textobjectWidth){
							$playerWidth = round($this->textobjectObject->textobjectWidth);
						}else{
							$playerWidth = round($playerHeight/390*640);
						}
						if ($this->textobjectObject->textobjectHeight){
							$playerHeight = round($this->textobjectObject->textobjectHeight);
						}else{
							$playerHeight = round($playerWidth/640*390);
						}
						
						$str="\n  	
									<div style='border:1px gray solid'>
									  <h2>HTML 5 Video:</h2>
										<video id='html5video".$textobjectID."' src='http://v2v.cc/~j/theora_testsuite/320x240.ogg' controls>
										  Your browser does not support the <code>video</code> element.
										</video>
										<div>
										  <button onclick='$(".'"#html5video'.$textobjectID.'"'.").get(0).play()'>Play the Video</button>
										  <button onclick='$(".'"#html5video'.$textobjectID.'"'.").get(0).pause()'>Pause the Video</button>
										  <button onclick='$(".'"#html5video'.$textobjectID.'"'.").get(0).volume+=0.1'>Increase Volume</button>
										  <button onclick='$(".'"#html5video'.$textobjectID.'"'.").get(0).volume-=0.1'>Decrease Volume</button>
										</div> 
									</div> ";
									
						
						return $str;
					}

					
	}
	
    
?>