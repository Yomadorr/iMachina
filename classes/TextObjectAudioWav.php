<?

	class TextObjectAudioWav extends TextObject
	{
		var $innerCommentType="visual";

			// textobject ...
	   		var $textobjectDocument=1; 
    		var $textobjectSuffix="wav"; 

    				var $textobjectviewTypeCategory="audio";
					var $textobjectviewTypeCategoryLabel="Audio";
		
	

		function TextObjectAudioWav()
		{
			$this->addMemberByValue("image","WAVformImage",false,"image","png","default/TextObjectcomplexWavImage.png",false);
		}

		function onDocumentUpload($app,$userId)
		{
			// document path
			$documentURL=$this->getDocumentURL();
			// get memger documentURl -> draw Image
			$wavImageObjdocumentURL = "default/TextObjectcomplexWavImage.png";
			$member = $this->getMemberByName("image", $app, $userId );
			if ($member!=null)
	    	{
	    		$membertextObj = $member->textobjectObject;
	    		if($membertextObj!=null)
	    		{
					$wavImageObjdocumentURL = $membertextObj->getDocumentURL();
	    		}
	    	}
			drawWaveform( $documentURL, $wavImageObjdocumentURL );

			// get duration
			$duration = $this->getDuration($documentURL);
			$this->textobjectTimeLength = $duration;
			// update duration
			$app->updateTextObject($this,$userId);
		}

		function getDuration($file){
				
			if(!file_exists($file)) return 1;
						
			$fp = fopen($file, 'r');
			$size_in_bytes = filesize($file);
			fseek($fp, 20);
			$rawheader = fread($fp, 16);
			$header = unpack('vtype/vchannels/Vsamplerate/Vbytespersec/valignment/vbits',$rawheader);
			$sec = ceil($size_in_bytes/$header['bytespersec']);
			// todo:
			if($sec < 1) $sec = 1;
			return $sec;		
		}
	}
?>