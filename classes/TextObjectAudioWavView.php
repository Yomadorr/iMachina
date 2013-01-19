<?

	class TextObjectAudioWavView extends TextObjectView
	{

		var $textobjectviewType="audio"; 
		var $textobjectviewTypeSub="wav"; 
	
		var $textobjectviewLabel="WAV-Audio"; // @textobject.label*
		var $textobjectviewDescription="a WAV Audiofile"; // @textobject.description


			function viewContent( $app, $userId )
			{
				// document path
				$width="".$this->textobjectObject->textobjectWidth;
				$height="".$this->textobjectObject->textobjectHeight;
				$strWidth="";
				$strHeight="";
					if ($width!="") $strWidth=" width='$width' ";
					if ($height!="") $strHeight=" width='$height' ";
				$strSize=" $strWidth  $strHeight ";

				// document path
				$documentURL=$this->textobjectObject->getDocumentURL();
				$textobjectID = $this->getId();
				$audioDuration = $this->textobjectObject->textobjectTimeLength;

				//$str="\n  <div  class='detailContainerContent' id='".$this->getDivId()."Content'>".$this->textobjectObject->textobjectArgument."</div>";
				$strContent=TextObjectView::textToHtml($this->textobjectObject->getArgument());
				$strContent=str_replace("\n","<br>",$strContent);


					$str="\n  <div  class='detailContainerContent' id='".$this->getDivId()."Content' >";

					$str=$str."\n 	<audio id='audio".$textobjectID."'>";
		  			$str=$str."\n 		<source id='wav_src".$textobjectID."' src='".$documentURL."' type='audio/wav'>";
					$str=$str."\n 		Your browser does not support the wav audio element.";
					$str=$str."\n 	</audio>";

					// Image
					$wavImageObjdocumentURL = "default/TextObjectcomplexWavImage.png";
					$member = $this->textobjectObject->getMemberByName("image", $app, $userId );
					if ($member!=null)
			    	{
			    		$membertextObj = $member->textobjectObject;
			    		if($membertextObj!=null)
			    		{
							$wavImageObjdocumentURL = $membertextObj->getDocumentURL();
			    		}
			    	}
					$str=$str."\n <div style='float:left; margin-left:21px;'><img src='".$wavImageObjdocumentURL."'  style='align: top; width:402px; height:25px;'></div>";

					// js audio
					$str=$str."\n <script>";
						//$str=$str."\n	timelineObj".$textobjectID.".timeToPixel(".$audioDuration.");";
						//$str=$str."\n	$('#waveformimage".$textobjectID."').width(timelineObj".$textobjectID.".timeToPercent(".$audioDuration.")+'%');";
						$str=$str."\n 	var audio".$textobjectID." = $('#audio".$textobjectID."').get(0);";
						
						// todo: reload audio src
						$str=$str."\n 	$(document).ready(function(){";
						$str=$str."\n 		$('#wav_src".$textobjectID."').attr('src','".$documentURL."'); alert('ready!');";
						$str=$str."\n 		$('#playerBackground".$this->getId()."Overlay').append(\"<img src='".$wavImageObjdocumentURL."'  style='position: absolute; align: top; width:402px; height:10px;'>\");";
						//$str=$str."\n 	$('#waveformimage".$textobjectID."').css('width', timelineObj".$textobjectID.".timeToPercent(".$audioDuration."));  ";
						$str=$str."\n 	});";

						//events handler
						$str=$str."\n 	$(document).on('OnTimelineStateChange".$textobjectID."', timelineHasChanged".$textobjectID.");";
						$str=$str."\n 	$(document).on('OnTimelineStartAt".$textobjectID."', timelineStartAt".$textobjectID.");";

						$str=$str."\n 	isAudioEnd = false;";

						$str=$str."\n 	function timelineHasChanged".$textobjectID."(e) {";
						//$str=$str."\n 		alert('E.STATUS:'+e.status+' isAudioEnd:'+isAudioEnd);";
						$str=$str."\n 		if(e.status == 'play'){";
						$str=$str."\n 			if(!isAudioEnd)audio".$textobjectID.".play();";
						$str=$str."\n 		}else if(e.status == 'pause'){";
						$str=$str."\n 			audio".$textobjectID.".pause();";
						$str=$str."\n 	} }";

						$str=$str."\n 	function timelineStartAt".$textobjectID."(e) { ";
						//$str=$str."\n 		alert('startAT: '+e.status+' maxtime: '+".$audioDuration."+audio".$textobjectID."+' isAudioEnd:'+isAudioEnd);";
						$str=$str."\n 		if(e.status >".$audioDuration."){";
						$str=$str."\n 			isAudioEnd = true; audio".$textobjectID.".currentTime = ".$audioDuration."; audio".$textobjectID.".pause();";
						$str=$str."\n 		}else{";
						$str=$str."\n 			isAudioEnd = false;";
						$str=$str."\n 			audio".$textobjectID.".currentTime = e.status; ";
						$str=$str."\n			if( timelineObj".$textobjectID.".isPlaying() ) audio".$textobjectID.".play();";
						$str=$str."\n 		}";
						$str=$str."\n 	}";
					$str=$str."\n 	</script>";

					$str=$str."\n</div>";


				// comments
				// $str=$str.$this->viewSideActionsComments( $app, $userId );

				return $str;
			}
        /*
		// detail is all together ... 
		function viewContent( )
		{

			$width="".$this->textobjectObject->textobjectWidth;
			$height="".$this->textobjectObject->textobjectHeight;
			$strWidth="";
			$strHeight="";
				if ($width!="") $strWidth=" width='$width' ";
				if ($height!="") $strHeight=" width='$height' ";
			$strSize=" $strWidth  $strHeight ";

			// document path
			$documentURL=$this->textobjectObject->getDocumentURL();
			$textobjectID = $this->getId();

			// audio container
			$str="";
			$str=$str."\n <div class='detailContainerContent' id='".$textobjectID."Content' >";
			$str=$str."\n 	<audio id='audio".$textobjectID."'>";
  			$str=$str."\n 		<source src='".$documentURL."' type='audio/wav'>";
  			$str=$str."\n 		<source src='".$documentURL."'' type='audio/x-wav'>";
			$str=$str."\n 		Your browser does not support the wav audio element.";
			$str=$str."\n 	</audio>";

			// waveform image				
			// volume control button
			$str=$str."\n 	<div id='audioControlContainer".$this->getId()."' class='audioControlContainer'>";
			$str=$str."\n 		<div class='volumeImg' id='muteButton".$this->getId()."'></div>"; // mute button
    		$str=$str."\n 		<div id='slider".$this->getId()."' class ='volumeslider' style='width: 50px; margin: 10px;' ></div>";	// volume slider
			$str=$str."\n 	</div>";
			$str=$str."\n </div>";

			// mute button
			$str=$str."\n 	<script>";
			$str=$str."\n 	$('#audioControlContainer".$textobjectID."').css('margin-left',timelineObj".$textobjectID.".getPlayerEnd())";
			$str=$str."\n 	$('#muteButton".$textobjectID."').click(function(){";
			$str=$str."\n 		if(audio".$textobjectID.".muted){ ";
			$str=$str."\n 			audio".$textobjectID.".muted = false;  $('#muteButton".$textobjectID."').attr('class','volumeImg');";
			$str=$str."\n 		}else{";
			$str=$str."\n 			audio".$textobjectID.".muted = true;  $('#muteButton".$textobjectID."').attr('class','volumeImgMuted');";
			$str=$str."\n 		}";
			$str=$str."\n 	});";

			// volume slider
			$str=$str."\n 	$('#slider".$this->getId()."').slider({"; 
    		$str=$str."\n 		range: 'min',";
    		$str=$str."\n 		min: 0,";
    		$str=$str."\n 		value: 30,";
    		$str=$str."\n 		animate: 'fast',";
        	$str=$str."\n 		slide: function(event, ui) {";
        	$str=$str."\n 			var vol = $('#slider".$this->getId()."').slider('value');";
        	$str=$str."\n 			audio".$textobjectID.".volume = vol/100;";
        	$str=$str."\n 		},";
			$str=$str."\n 	});";

			//events handler
			$str=$str."\n 	audio".$textobjectID." = $('#audio".$textobjectID."').get(0);";

			$str=$str."\n 	$(document).on('OnTimelineStateChange".$textobjectID."', timelineHasChanged".$textobjectID.");";
			$str=$str."\n 	$(document).on('OnTimelineStartAt".$textobjectID."', timelineStartAt".$textobjectID.");";
			
			$str=$str."\n 	function timelineHasChanged".$textobjectID."(e) {";
			$str=$str."\n 		//alert('E.STATUS:'+e.status);";
			$str=$str."\n 		if(e.status == 'play')";
			$str=$str."\n 			audio".$textobjectID.".play();";
			$str=$str."\n 		else if(e.status == 'pause')";
			$str=$str."\n 			audio".$textobjectID.".pause();";
			$str=$str."\n 	} ";

			$str=$str."\n 	$(document).ready(function(){";
			$str=$str."\n 		//alert(audio".$textobjectID."+'document is ready');";
			$str=$str."\n 	});";

			$str=$str."\n 	function timelineStartAt".$textobjectID."(e) {";
			$str=$str."\n 		audio".$textobjectID.".currentTime = e.status;";
			$str=$str."\n 	}";
			$str=$str."\n 	</script>";
			
			return $str;
		}*/

			function viewFormExtendedCoreContentForm( $addDivAction="" )
			{
				$str="";

				// todo: escape html-entities
				$str=$str."\n  	<input type=hidden size=50 id='Form".$addDivAction."DatatextobjectArgument'    style='width: 100%'  value='".$this->textobjectObject->textobjectArgumentText."''>";				
				
				return $str;
			}

				// form insert
				function viewFormExtendedCoreContentFormInsert()
				{
					$str="";

					// is document?
					$str=$str."\n ".$this->viewFormExtendedCoreContentFormDocumentAddSingle( );

					return $str;
				}

				// form update
				function viewFormExtendedCoreContentFormUpdate()
				{
					$str="";
					//$wavImageObjdocumentURL = $this->imageURL();
					//$str=$str."\n <div><img src='$wavImageObjdocumentURL' width='50%' border=0></div>";

					// is document?
					$str=$str."\n ".$this->viewFormExtendedCoreContentFormDocumentUpdateSingle( );
					

					return $str;								
				}

	}
?>