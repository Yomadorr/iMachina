<?
	// problems on todo

	class TextObjectEmbedYoutubeView extends TextObjectView
	{
		var $textobjectviewType="embed";
		var $textobjectviewTypeSub="youtube";
		
		var $textobjectviewIcon="EmbedIcon.png"; // * not used
		var $textobjectviewIconBig="EmbedIconBig.png"; // * not used
		var $textobjectviewLabel="Embed Youtube Clip"; // @textobject.label*
		var $textobjectviewDescription="Embed a Youtube- or a Vimeoclip by entering the cliplink"; // @textobject.description
		
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
				$str="";
				
				// todo: escape html-entities
				//$str="\n 	<input type=hidden id='".$this->getDivId()."FormDatatextobjectId".$addDivAction."' value='".$this->textobjectObject->textobjectId."'> ";
				$str=$str."\n  	<input type=textfield size=50 id='Form".$addDivAction."DatatextobjectArgument' style='width: 100%' value='".$this->textobjectObject->textobjectArgumentText."''>";

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
						
						$str="\n  <b>Unknown Link: </b>".$data." (".$divID.")";
						if(strpos($data, "youtu") !== false){
							
							$youtubeId = $this->getYoutubeId($data);
							
							if($youtubeId == "invalid"){
								$str="\n  <b>Invalid Youtube-Link</b>";
							}else{
								$str="
								<script src='//www.youtube.com/iframe_api' type='text/javascript'></script>

								<!--<script type='text/javascript'>
									//get meta data
									function youtubeFeedCallback(json){
									document.write('Title: ' + json['data']['title'] + '<br>');
									document.write('Duration: ' + json['data']['duration'] + '<br>');
									}
								</script>
								<script type='text/javascript' src='http://gdata.youtube.com/feeds/api/videos/".$youtubeId."?v=2&alt=jsonc&callback=youtubeFeedCallback&prettyprint=true'></script>
								-->
								<!--<p>asdf</p>
								    <script type='text/javascript' >
								        alert('domready fake');
								        
								        $('#".$divID."Content').load(function() {
                                          alert('load');
                                        });
                                        
                                        $('#".$divID."Content').live('click',function() {
                                          alert('live load');
                                          waitNCheckDOM".$textobjectID."();
                                        });
                                        
								    </script>
								   --> 
								<div  class='detailContainerContent' id='".$divID."Content'>
									<!--<h2>Youtube Video (textobjID: ".$textobjectID."; youtubeID:".$youtubeId."):</h2>
									-->
									<div id='youtubePlayerDiv".$textobjectID."' class='youtubePlayerDiv'>
									    <p>loading youtube video...</p>
									</div>
									

								    
								    
								        <script type='text/javascript' >
										
										
										$(document).ready(function() {
											waitNCheckDOM".$textobjectID."();
											//alert('domready');
										});

											
										$(document).on('OnTimelineStateChange".$textobjectID."', timelineHasChanged".$textobjectID.");
										$(document).on('OnTimelineStartAt".$textobjectID."', timelineStartAt".$textobjectID.");
										

										// newMessage event handler
										function timelineHasChanged".$textobjectID."(e) {
											//alert('event timelineHasChanged".$textobjectID." ausgeloest: '+e.status);
											if(e.status == 'play')
												yTPlayer".$textobjectID.".playVideo();
											else if(e.status == 'pause')
												yTPlayer".$textobjectID.".pauseVideo();
										}
										function timelineStartAt".$textobjectID."(e) {
											//alert('event timelineStartAt".$textobjectID." ausgeloest: '+e.status);
											yTPlayer".$textobjectID.".seekTo(e.status);
										}
										
										function waitNCheckDOM".$textobjectID."() {
											try{
												instantiateYTPlayer".$textobjectID."();
											}
											catch(err){
												window.setTimeout('waitNCheckDOM".$textobjectID."()', 100);
											}
										}		
										
								    	var yTPlayer".$textobjectID.";
								    	
								 
									    function instantiateYTPlayer".$textobjectID."() {
										    yTPlayer".$textobjectID." = new YT.Player('youtubePlayerDiv".$textobjectID."', {
											  height: '".$playerHeight."',
											  width: '".$playerWidth."',
											  videoId: '".$youtubeId."',
											  playerVars: { 'autoplay': 0, 'controls': 0 },
											  events: {
												'onReady': onYTPlayerReady".$textobjectID.",
												'onStateChange': onYTPlayerStateChange".$textobjectID."
												  }
												});
									    }
									    function onYTPlayerReady".$textobjectID."(event) {
											yTDisplayExternalMenu".$textobjectID."();
											yTTick".$textobjectID."();
										}
										
										  var yTIsRepeat".$textobjectID." = false;
										  function yTRepeatOnOff".$textobjectID."(){
											yTIsRepeat".$textobjectID." = !yTIsRepeat".$textobjectID.";
											$('#repeatDisplay".$textobjectID."').html('repeat: '+yTIsRepeat".$textobjectID.");	
										  }
										  
										function onYTPlayerStateChange".$textobjectID."(event) {
										
											if (yTIsRepeat".$textobjectID." && event.data == YT.PlayerState.ENDED) {
											  yTPlayer".$textobjectID.".seekTo(0, true);
											  yTPlayVideo".$textobjectID."();
											}

											//display playerstate
											var stateNo = yTPlayer".$textobjectID.".getPlayerState();
											if(stateNo==-1) {
												var stateName = 'unstarted';
												timelineObj".$textobjectID.".pauseWithoutTrigger();
											}else if(stateNo==0) {
												var stateName = 'ended';
												timelineObj".$textobjectID.".pauseWithoutTrigger();
											}else if(stateNo==1) {
												var stateName = 'playing';
												timelineObj".$textobjectID.".startAt(yTPlayer".$textobjectID.".getCurrentTime());
												timelineObj".$textobjectID.".playWithoutTrigger();
											}else if(stateNo==2) {
												var stateName = 'paused';
												timelineObj".$textobjectID.".pauseWithoutTrigger();
											}else if(stateNo==3) {
												var stateName = 'buffering';
												timelineObj".$textobjectID.".pauseWithoutTrigger();
											}else if(stateNo==5) {
												var stateName = 'video cued';
												timelineObj".$textobjectID.".pauseWithoutTrigger();
											}
											$('#stateDisplayDiv".$textobjectID."').html(stateName);
										}

									  
									  function yTDisplayExternalMenu".$textobjectID."(){
										$('#videoMenuDiv".$textobjectID."').show();
									  }
									  function yTTick".$textobjectID."() {
										yTUpdateTimeDisplay".$textobjectID."();
										window.setTimeout('yTTick".$textobjectID."()', 1000);
									  }
									  function yTUpdateTimeDisplay".$textobjectID."(){
										var Seconds = Math.round(yTPlayer".$textobjectID.".getCurrentTime());
									  
										var Hours = Math.floor(Seconds / 3600);
										Seconds -= Hours * (3600);
								
										var Minutes = Math.floor(Seconds / 60);
										Seconds -= Minutes * (60);
								
										var TimeStr = LeadingZero(Hours) + ':' + LeadingZero(Minutes) + ':' + LeadingZero(Seconds);
								
										$('#timeDisplayDiv".$textobjectID."').html(TimeStr);
									  }
									  function yTSeekToInput".$textobjectID."(){
										yTPlayer".$textobjectID.".seekTo($('#seektoDiv".$textobjectID."').val(), true); 
									  }
									  
									  function yTStopVideo".$textobjectID."() {
											yTPlayer".$textobjectID.".stopVideo();
											timelineObj".$textobjectID.".pauseWithoutTrigger();
										}
										function yTPlayVideo".$textobjectID."() {
											yTPlayer".$textobjectID.".playVideo();
											timelineObj".$textobjectID.".playWithoutTrigger();
										}
										function yTPauseVideo".$textobjectID."() {
											yTPlayer".$textobjectID.".pauseVideo();
											timelineObj".$textobjectID.".pauseWithoutTrigger();
										}


									</script>
								
									<!--<br />    
									<div id='videoMenuDiv".$textobjectID."' style='display:none;'>
										<p>
											Zeit: <span id='timeDisplayDiv".$textobjectID."'>0</span><br />Status: <span id='stateDisplayDiv".$textobjectID."'>-</span> 
										</p>
										<p>
											[<a href='#' onclick='yTPlayVideo".$textobjectID."(); return false;' >play</a>]
											[<a href='#' onclick='yTStopVideo".$textobjectID."(); return false;' >stop</a>]
											[<a href='#' onclick='yTPauseVideo".$textobjectID."(); return false;' >pause</a>]
											[<a href='#' id='repeatDisplay".$textobjectID."' onclick='yTRepeatOnOff".$textobjectID."(); return false;'>repeat: false</a>]
										</p>
										
										<label for='seektoDiv".$textobjectID."'>go to:</label>
										<input id='seektoDiv".$textobjectID."' type='text' size='4'> seconds
										<input type='submit' onclick='yTSeekToInput".$textobjectID."(); return false;' value='Go'>
										<br />
										<p>mehr funktionen hier im example-player: <a href='https://developers.google.com/youtube/youtube_player_demo' >https://developers.google.com/youtube/youtube_player_demo</a><br />
										und hier die api-reference: <a href='https://developers.google.com/youtube/iframe_api_reference'>https://developers.google.com/youtube/iframe_api_reference</a></p>
									</div>-->
										
								</div>";
							}
						}elseif(strpos($data, "vimeo") !== false){
							$vimeoId = $this->getVimeoId($data);
							
							if($vimeoId == "invalid"){
								$str="\n  <b>Invalid Vimeo-Link</b>";
							}else{
								$str="\n  <div  class='detailContainerContent' id='".$this->getDivId()."Content'> 
								<iframe src='http://player.vimeo.com/video/".$vimeoId."?badge=0&amp;color=ff9933' width='500' height='281' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
								</div>";
								//<iframe src="http://player.vimeo.com/video/11219730?badge=0&amp;color=ff9933" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
							}
						
						}
						return $str;
					}
					
					function getVimeoId($str){
						$vimeoId = "invalid";
						if(strpos($str, "iframe") !== false){
							//<iframe src="http://player.vimeo.com/video/11219730?badge=0&amp;color=ff9933" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
	//						$vimeoId = explode('?', explode("vimeo.com/video/", $str)[1])[0];
	// problem
	// todo: problem mit renes							
// Parse error: syntax error, unexpected '[' in /Applications/MAMP/htdocs/imachina/classes/TextObjects/TextObjectEmbedYoutubeView.php on line 281							

							$vimeoId=-1;
						}elseif(strpos($str, "object") !== false){
							/*
							<object width="500" height="281"><param name="allowfullscreen" value="true" />
							<param name="allowscriptaccess" value="always" />
							<param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=11219730&amp;force_embed=1&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=1&amp;color=ff9933&amp;fullscreen=1&amp;autoplay=0&amp;loop=0" />
							<embed src="http://vimeo.com/moogaloop.swf?clip_id=11219730&amp;force_embed=1&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=1&amp;color=ff9933&amp;fullscreen=1&amp;autoplay=0&amp;loop=0" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="500" height="281">
							</embed>
							</object>
							*/
//							$vimeoId = explode('&', explode("clip_id=", $str)[1])[0];
// todo: error on renes computer
// Parse error: syntax error, unexpected '[' in /Applications/MAMP/htdocs/imachina/classes/TextObjects/TextObjectEmbedYoutubeView.php on line 294							
$vimeoId=-1;
						}
						elseif(strpos($str, "http://") !== false){
							//http://vimeo.com/11219730
							//// Provides: <body text='black'>
							//$bodytag = str_replace("%body%", "black", "<body text='%body%'>");
							$vimeoId = trim(str_replace("www.", "", $str), "http://vimeo.com/");
						}
						
						return $vimeoId;
					}
					
					//<iframe width="560" height="315" src="http://www.youtube.com/embed/ZBj2nmodCuA" frameborder="0" allowfullscreen></iframe>
					
			public function getYoutubeId($str){
				//$str = $this->textobjectObject->textobjectArgumentText;
				$youtubeId = "invalid";
				
				if(strpos($str, "iframe") !== false){
					//<iframe width="560" height="315" src="http://www.youtube.com/embed/ZBj2nmodCuA" frameborder="0" allowfullscreen></iframe>
					$expList = explode("embed/", $str);
					if (count($expList)>=2){
					    $arrYoutubeId = explode('"', $expList[1]);
					    $youtubeId=$arrYoutubeId[0];
					}
					
					//$youtubeId = explode('"', explode("embed/", $str)[1])[0];
// todo: error on renes computer
// Parse error: syntax error, unexpected '[' in /Applications/MAMP/htdocs/imachina/classes/TextObjects/TextObjectEmbedYoutubeView.php on line 319
//$youtubeId =-1;
				}
				elseif(strpos($str, "object") !== false){
					/*
					<object width="560" height="315">
					<param name="movie" value="http://www.youtube.com/v/ZBj2nmodCuA?version=3&amp;hl=de_DE"></param>
					<param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param>
					<embed src="http://www.youtube.com/v/ZBj2nmodCuA?version=3&amp;hl=de_DE" type="application/x-shockwave-flash" width="560" height="315" allowscriptaccess="always" allowfullscreen="true">
					</embed>
					</object>
					*/
					$expList = explode("youtube.com/v/", $str);
					if (count($expList)>=2){
					    $arrYoutubeId = explode('?', $expList[1]);
					    $youtubeId=$arrYoutubeId[0];
					}
					
//					$youtubeId = explode('?', explode("youtube.com/v/", $str)[1])[0];
// todo: error on renes computer
//$youtubeId =-1;
				}
				elseif(strpos($str, "http") !== false){
					$str = str_replace("https://", "", str_replace("http://", "", str_replace("www.", "", $str)));
					
					// http://youtu.be/ZBj2nmodCuA
					if(strpos($str, "youtu.be/") !== false){
						$youtubeId = trim(trim($str,"youtu.be/"), "/");
					}
					
					// http://www.youtube.com/watch?v=PJ69Ucl82Jc&feature=g-vrec
					// http://www.youtube.com/watch/?v=1FH-q0I1fJY
					// http://www.youtube.com/watch?feature=endscreen&NR=1&v=pE0uRmETWKc
					elseif(strpos($str, "v=") !== false){
					
					    $expList = explode("v=", $str);
                        if (count($expList)>=2){
                            $arrYoutubeId = explode('&', $expList[1]);
						    $youtubeId=$arrYoutubeId[0];
                        }
					
//						$youtubeId = explode("&",explode("v=",$str)[1])[0];
// todo: error on renes computer
//$youtubeId=-1;
					}
				}

				return $youtubeId;
			}

		// wuerde ohne parameter funtionieren.
		public function getDuration($video_id){
	
		    if($video_id != "invalid"){
                //parse_str(parse_url($url,PHP_URL_QUERY),$arr);
                //$video_id=$arr['v']; 
        
        
                $data=@file_get_contents('http://gdata.youtube.com/feeds/api/videos/'.$video_id.'?v=2&alt=jsonc');
                if (false===$data) return false;
        
                $obj=json_decode($data);
        
                return $obj->data->duration;
			}else{
			    return -1;
			}
		}
	
		//echo getDuration('http://www.youtube.com/watch?v=rFQc7VRJowk');
					
	}
	
    
?>