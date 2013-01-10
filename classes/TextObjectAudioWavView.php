<?

	class TextObjectAudioWavView extends TextObjectView
	{

		var $textobjectviewType="audio";
		var $textobjectviewTypeSub="wav";

		var $textobjectviewIcon="AudioWavIcon.png"; // * not used
		var $textobjectviewIconBig="AudioWavIconBig.png"; // * not used
		var $textobjectviewLabel="AudioWave"; // @textobject.label*
		var $textobjectviewDescription="This is a audiofile."; // @textobject.description

		function viewFormExtendedCoreContentForm( $addDivAction="" )
		{
			$str="";
			$str=$str."\n  	<input type=textfield size=50 id='".$this->getDivId()."FormDatatextobjectArgument".$addDivAction."' style='width: 100%' value='".$this->textobjectObject->textobjectArgumentText."''>";
			return $str;
		}

		// detail is all together ... 
		function viewContent( )
		{
			$textobjectID = $this->getId();
			// audio container
			$str="";
			$str=$str."\n <div class='detailContainerContent' id='".$this->getDivId()."Content' >";
			$str=$str."\n 	<audio id='audio".$textobjectID."'>";
  			$str=$str."\n 		<source src='".$this->textobjectObject->textobjectArgumentText."' type='audio/wav'>";
  			$str=$str."\n 		<source src='".$this->textobjectObject->textobjectArgumentText."'' type='audio/x-wav'>";
			$str=$str."\n 		Your browser does not support the wav audio element.";
			$str=$str."\n 	</audio>";

			// waveform image	
			$str=$str."\n 	<div style='margin: 0 0 0 21px; float:left; clear:right; position: absolute;'>";
			if(file_exists('./audio/waveforms/waveform'.$textobjectID.'.png')){
				$str=$str."\n 		<img id='waveformimage".$textobjectID."' src='./audio/waveforms/waveform".$textobjectID.".png' width='400px' height='29px'  border='1px solid black'>";
			}else{
				$str=$str."\n 	sorry no wavform available!";
			}
			$str=$str."\n 	</div>";

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
		}
		
		public function getDuration(){

			$file = $this->textobjectObject->textobjectArgumentText;
			$fp = fopen($file, 'r');

			if (fread($fp,4) == "RIFF") {
				fseek($fp, 20);
				$rawheader = fread($fp, 16);
				$header = unpack('vtype/vchannels/Vsamplerate/Vbytespersec/valignment/vbits',$rawheader);
				$pos = ftell($fp);
				while (fread($fp,4) != "data" && !feof($fp)) {
					$pos++;
					fseek($fp,$pos);
				}
				$rawheader = fread($fp, 4);
				$data = unpack('Vdatasize',$rawheader);
				$sec = $data[datasize]/$header[bytespersec];
				return $sec;
			}
			return false;
		}

	}
?>