/*!
 * Imachina JClasses
 */

// TimeLine

// at the moment in index.php


	// iMachinaTextObject
	var TextObject = function()
	{
		var textobjectId=-1;
		var textobjectRef=-1;
		var textobjectType="text";
		var textobjectTypeSub="plain";
		var textobjectArgument="";
		var textobjectCommentType=""; // textobjectCommentType
	}

	// iMachinaTimeLine
	var iMachinaTimeLine = function( )
	{
			// display
			this.playerId="20";
			this.playerOffset=20;
			this.playerWidth=400;
			this.playerHeight=10;
			this.playerbuttonspace = 10;
			this.playerDiv="";
			this.timeToPixelRatio=1.0;
			this.pixelToTimeRatio=1.0;
			
			this.showingAllTimeComments=false;

			// timeinplayer
			this.timeInExternalPlayer=1.0; // * for example in wav or youtube ... 

			this.setId=function( thisId )
			{
				this.playerId=thisId;
			}

			// player
	   		this.status="pause"; // wait | run | pause
	   		// this.position=0.0; // position ... todo: used?
	   		this.interval=0.05; // in secs
	   		this.playedTime=0.0;
			this.maxTime=10.0; // in secs ...

			this.startInterval=0.0;
			this.stopInterval=0.0;

			this.reset=function()
			{
				// set all to zero
				for (var o=0;o<this.arrayTimeObjects.length;o++)
			 	{
			 		 textobjectTimed=this.arrayTimeObjects[o];
			 		 textobjectTimed.inPlayerStatus="";
			 	}
			 	// wait againforstart
				this.status="waitforstart"; 

				// update everything
			}

				// get time
				this.getTimeInSecs=function()
				{
					var seconds = new Date().getTime() / 1000;
					return seconds;
				}

			// start here
	   		this.play=function(  )
   			{
   				this.playWithoutTrigger();			   				
   				$.event.trigger({
					type: "OnTimelineStateChange"+this.playerId,
					status: "play"
				});
		   	}
		   	
		   	this.playWithoutTrigger=function(  )
   			{
   				// start interval
   				this.newStart();

   				// is running?
   				// todo: used?
   				if (this.status=="waitforstart")
   				{
   					this.startAt(0.0);
   				}
				if (this.status=="pause")
   				{
   					// this.startAt(0.0);
   					// go on ...
   					this.startAt(this.playedTime);
   				}
   				if (this.status=="stopaction") // if it is just a stop
   				{
   					// this.startAt(this.playedTime);
   				}
   				if (this.status=="end")
   				{
   					this.reset();
   					this.startAt(0.0);
   				}

   				// alert("this.status "+this.status);

   				this.status="playing";

   				// this.playLoop;
   				this.loopThread();			   				
		   	}

		   	this.jumpToPositionPixel=function(x)
		   	{
		   		// start here and now to play or stop ..
		   		// alert(x);
		   		var jumpToTime=this.pixelToTime(x);
		   		// alert("jumpToTime: "+jumpToTime);
		   		this.startAt(jumpToTime);
		   	}

		   	this.isPlaying=function()
		   	{
		   		if (this.status=="playing") return true;
		   		return false;
		   	}

		   	this.pause=function(  )
   			{
   	   			this.pauseWithoutTrigger();
   	   			//alert("pause");
  				$.event.trigger({
					type: "OnTimelineStateChange"+this.playerId,
					status: "pause"
				});   				
   			}
   			
   			this.pauseWithoutTrigger=function(  )
   			{
   	   			this.newStop();
   	   			this.status="pause";
				//alert("pauseWithoutTrigger");
   				
   			}

   			this.toggle=function()
   			{
   				if (this.isPlaying()) { this.pause(); }
   				else { this.play(); }
   			}

   			this.end=function(  )
   			{
   	   			this.status="end";
   	   			this.pause(); 
   	   			// this.position=0.0;
   	   			this.playedTime=0.0; 
   			}

   			// stop - use only for action
		   	this.stopaction=function(  )
   			{
   	   			this.newStop();
   	   			this.status="stopaction";
   			}

   			// start
	   		this.startAt=function( timeInSecs )
   			{
   				this.newStart();

   				// position here ..
   				// this.position=timeInSecs; 
   				this.playedTime=timeInSecs;
   				
   				// reset all and set on done if done ...
   				for (var o=0;o<this.arrayTimeObjects.length;o++)
			 	{
			 		 textobjectTimed=this.arrayTimeObjects[o];
			 		 textobjectTimed.inPlayerStatus="";
			 		 if (timeInSecs>textobjectTimed.timeobjectA) textobjectTimed.inPlayerStatus="active";
			 		 if (timeInSecs>textobjectTimed.timeobjectB) textobjectTimed.inPlayerStatus="done";
			 	}

		   		// check what to display and what not ... 
		   		this.actualiseVisuals();

		   		// alert("startAt");
		   				   		
		   		$.event.trigger({
					type: "OnTimelineStartAt"+this.playerId,
					status: timeInSecs
				});
			}
				this.newStart=function()
   				{
   					// start at
	   				this.startInterval=this.getTimeInSecs();
				}
				this.nextTimeStop=function()
				{
					this.newStop();
					this.startInterval=this.stopInterval;
				}
   				this.newStop=function()
   				{
   					// pause ...
   					this.stopInterval=this.getTimeInSecs();
   					// add diff time here
   					var diff=this.stopInterval-this.startInterval;
   					this.playedTime=this.playedTime+diff;
				}

			// the loop
			this.loopThread=function(  )
   			{
		   		// timeouts here ... 

		   		// stopped ... 
		   		if (this.status=="playing")
		   		{
		   			// this.stopThis();
		   			this.nextTimeStop();

		   			// update view here ...
					this.updateCursorToActual();

					// actualise next step!
					this.actualiseVisualsByActualCursor();

		   			// this time line
	   				var thisTimeLine=this;
	   				// end?
			   		if (this.playedTime>this.maxTime)
			   		{
			   			this.end();
			   		}
	   				setTimeout(function() { thisTimeLine.loopThread(); }, this.interval);
		   		}


			}
				this.updateCursorToActual=function()
				{
					this.updateCursorToTime( this.playedTime );
				}

					var posHistory=0;
					this.updateCursorToTime=function( timex )
					{
						var pos=this.timeToPixel(timex);

						if (pos!=posHistory)
						{
							$('#playcursor'+this.playerId).css("margin-left",pos);
							$('#playcursor'+this.playerId+"Time").css("margin-left",pos+10);
							$('#playcursor'+this.playerId+"Time").html(this.converToMinutes(timex));
						}
						posHistory=pos;
					}

			// visuals for all 
			this.actualiseVisuals=function()
			{
				// hide them all
				// version 1.0
				// this.actualiseVisualsAllActive(false);

				// version 2.0
				// show what is active now ..
				for (var o=0;o<this.arrayTimeObjects.length;o++)
			 	{
			 		 textobjectTimed=this.arrayTimeObjects[o];
			 		 if (textobjectTimed.inPlayerStatus=="active")
			 		 {
			 		 	$('#'+textobjectTimed.timeobjectDiv).show(); // 'fast'
			 		 }
			 		 else
			 		 {
			 		 	$('#'+textobjectTimed.timeobjectDiv).hide(); // 'fast'
			 		 }
			 	}

				// go there ...
				this.updateCursorToActual();
			}
			
			    this.toggleTimeComments = function ()
			    {
			        this.showingAllTimeComments = !this.showingAllTimeComments;
			        this.actualiseVisualsAllActive(this.showingAllTimeComments);
			        
			    }

				this.actualiseVisualsAllActive=function( flagShow )
				{
					for (var o=0;o<this.arrayTimeObjects.length;o++)
				 	{
				 		 textobjectTimed=this.arrayTimeObjects[o];
				 		 if (flagShow) $('#'+textobjectTimed.timeobjectDiv).show();
				 		 if (!flagShow) $('#'+textobjectTimed.timeobjectDiv).hide();
					}
				}

			// actualise visual step by step
			this.actualiseVisualsByActualCursor=function()
			{
				// reset all and set on done if done ...
   				for (var o=0;o<this.arrayTimeObjects.length;o++)
			 	{
			 		 textobjectTimed=this.arrayTimeObjects[o];
			 		 textobjectTimed.inPlayerStatus="";

			 		 // only if you are not yet active
			 		 if (textobjectTimed.inPlayerStatus=="")
			 		 {
				 		 if (this.playedTime>textobjectTimed.timeobjectA) 
				 		 { 
				 		 	$('#'+textobjectTimed.timeobjectDiv).show();

				 		 	// actions  
				 		 	// todo: active
				 		 	textobjectTimed.inPlayerStatus="active"; 
				 		 	if (textobjectTimed.timeobjectAction=="stop") { this.stopaction(); }  
				 		 }
			 		 }
			 		 // only if this is active
			 		 if (textobjectTimed.inPlayerStatus=="active")
			 		 {
				 		 if (this.playedTime>textobjectTimed.timeobjectB) 
				 		 { 
				 		 	textobjectTimed.inPlayerStatus="done"; 
				 		 	$('#'+textobjectTimed.timeobjectDiv).hide(); 
				 		 }
				 	 }

			 	}
			}

	   		// objects
	   		this.arrayTimeObjects=new Array()
			this.addTextObject=function( timeStart, timeStop, textobjectId, divId, action )
   			{
		   		var tobject=new TextObjectTimed();
		   			tobject.timeobjectA=timeStart;
		   			tobject.timeobjectB=timeStop;
		   			tobject.timeobjectId=textobjectId;
					tobject.timeobjectDiv=divId;
		   			tobject.timeobjectAction=action;
		   		this.arrayTimeObjects[this.arrayTimeObjects.length]=tobject;	
			}

			// dont' use this from outside ...
			this.setMaxTime = function( maxTime )
			{
				maxTime=parseFloat(maxTime);
				this.maxTime=maxTime;
			}

			this.setWidth = function( maxWidth )
			{
				maxWidth=parseFloat(maxWidth);
				this.playerWidth=maxWidth;
			}

			this.calculateMaxTime=function()
			{
				/*
				// todo: use old value?
				this.maxTime=0.0;
				*/
				if(this.maxTime==-1){
					this.maxTime=0.0;
					var textobjectTimed;
					for (var o=0;o<this.arrayTimeObjects.length;o++)
					{
						 textobjectTimed=this.arrayTimeObjects[o];
						 // alert(textobjectTimed.timeobjectA);
						 if (textobjectTimed.timeobjectA!=-1)
						 {
							 if (textobjectTimed.timeobjectA>this.maxTime) this.maxTime=textobjectTimed.timeobjectA;
							 if (textobjectTimed.timeobjectB>this.maxTime) this.maxTime=textobjectTimed.timeobjectB;
						 }
					}
				}
			 	// alert("this.maxTime:"+this.maxTime);
			}

				this.converToMinutes=function( secs )
				{
					var minutes=parseInt(parseInt(secs)/60);
					var seconds=parseInt(secs)%60;

					secondsNull="";
					if (seconds<10) secondsNull="0";

					return minutes+":"+secondsNull+seconds;
				}


			this.display=function ()
			{
				// autodetect maxTime
				this.calculateMaxTime();	

				// an object for referc
				var objectThis=this;

				// generate the keys
				// do this here!
				this.timeToPixelRatio=parseFloat(this.playerWidth)/parseFloat(this.maxTime);
				this.pixelToTimeRatio=parseFloat(this.maxTime)/parseFloat(this.playerWidth);

				// alert(" TimeToPixelRation("+this.timeToPixelRatio+") TimeToPixelRation("+this.pixelToTimeRatio+")  ");
				// add background
				// $('#'+this.playerDiv).append("<div id='playerBackground"+this.playerId+"' style='position: absolute; border: 1px solid black; background:#cccccc; margin-left: 20px; width: "+this.playerWidth+"; height: "+this.playerHeight+";' ></div>");
				$('#'+this.playerDiv).css("height",this.playerHeight+"px");
				$('#'+this.playerDiv).append("<div id='playerBackground"+this.playerId+"' style='position: absolute; border: 1px solid black; background:#cccccc; margin-left: 20px; width: "+this.playerWidth+"px; height: "+this.playerHeight+"px;' ></div>");
				$("#playerBackground"+this.playerId+"").click(function(e) { /* objectThis.jumpToMousePosition( e.pageX, e.pageY); */ });

				// $('#'+this.playerDiv).append("<div id='playerBackground' border: 1px solid black; background: #cccccc; width="+this.playerWidth+" height="+this.playerHeight+">,</div>");
				// $('#aplayer').append("PLAYERXXXXX");

				// do here 
				var textobjectTimed;
				var maxZIndex=1;
		   		for (var o=0;o<this.arrayTimeObjects.length;o++)
			 	{
			 		maxZIndex=o;
			 		 textobjectTimed=this.arrayTimeObjects[o];
			 		 // add here .. 
			 		 id=textobjectTimed.id;
			 		 pos=this.timeToPixel(textobjectTimed.timeobjectA);
			 		 width=this.timeToPixel(textobjectTimed.timeobjectB)-pos;

			 		 // immer dunkler ..

			 		 // start point 
			 		 // $('#'+this.playerDiv).append("<div id='timeline"+id+"start' style='position: absolute; border: 1px solid black; margin-left:"+pos+"; z-index: "+o+"; background:#000000; opacity: .5;  width: 5px; height: "+this.playerHeight+";' ></div>");
			 		 $('#'+this.playerDiv).append("<div id='timeline"+id+"start' style='position: absolute; border: 1px solid black; margin-left:"+pos+"px; z-index: "+o+"; background:#000000; opacity: .5;  width: 5px; height: "+this.playerHeight+"px;' ></div>");
			 		
			 		 // length 
//			 		 $('#'+this.playerDiv).append("<div id='timeline"+id+"' style='position: absolute; border: 1px solid black; margin-left:"+pos+"; z-index: "+o+"; background:#cccc00;  opacity: .3; width: "+width+"; height: "+this.playerHeight+";' ></div>");
			 		 $('#'+this.playerDiv).append("<div id='timeline"+id+"' style='position: absolute; border: 1px solid black; margin-left:"+pos+"px; z-index: "+o+"; background:#cccc00;  opacity: .3; width: "+width+"px; height: "+this.playerHeight+"px;' ></div>");
			 	}

				// overlay detect clicks direct in the timeline
				maxZIndex=maxZIndex+1;
//				$('#'+this.playerDiv).append("<div id='playerBackground"+this.playerId+"Overlay' style='position: absolute; border: 1px solid black; margin-left: 20px; width: "+this.playerWidth+"; height: "+this.playerHeight+"; z-index: "+maxZIndex+";' ></div>");
				$('#'+this.playerDiv).append("<div id='playerBackground"+this.playerId+"Overlay' style='position: absolute; border: 1px solid black; margin-left: 20px; width: "+this.playerWidth+"px; height: "+this.playerHeight+"px; z-index: "+maxZIndex+";' ></div>");
				$("#playerBackground"+this.playerId+"Overlay").click(function(e) { var x = e.pageX - this.offsetLeft; /* var y = e.pageY - this.offsetTop; */ objectThis.jumpToPositionPixel(x);  });

			 	// alert("display"+this.arrayTimeObjects.length);
			 	// cursors
				maxZIndex=maxZIndex+1;
//			 	$('#'+this.playerDiv).append("<div id='playcursor"+this.playerId+"'     style='z-index: "+maxZIndex+"; position: absolute; border: 1px solid black; background:#cc0000;opacity: .9;  margin-left: "+this.timeToPixel(0)+"; width: "+5+";  height: "+this.playerHeight+";' ></div>");
			 	$('#'+this.playerDiv).append("<div id='playcursor"+this.playerId+"'     style='z-index: "+maxZIndex+"; position: absolute; border: 1px solid black; background:#cc0000;opacity: .9;  margin-left: "+this.timeToPixel(0)+"px; width: "+5+";  height: "+this.playerHeight+"px;' ></div>");
				maxZIndex=maxZIndex+1;
//			 	$('#'+this.playerDiv).append("<div id='playcursor"+this.playerId+"Time' style='z-index: "+maxZIndex+"; position: absolute; opacity: .7; font-size: 12px; margin-left: "+this.timeToPixel(0)+"; width: "+5+"; height: "+this.playerHeight+";' >0:00</div>");
			 	$('#'+this.playerDiv).append("<div id='playcursor"+this.playerId+"Time' style='z-index: "+maxZIndex+"; position: absolute; opacity: .7; font-size: 12px; margin-left: "+this.timeToPixel(0)+"px; width: "+5+"; height: "+this.playerHeight+"px;' >0:00</div>");

			 	// show all
					maxZIndex=maxZIndex+1;
//					$('#'+this.playerDiv).append("<div id='playertime"+this.playerId+"ShowAll' style='z-index: "+maxZIndex+"; position: absolute; border: 1px solid black; background:#ffffff; font-size: 12px; opacity: .7;  margin-left: "+(this.timeToPixel(this.maxTime)+40)+"; height: "+this.playerHeight+";' >ShowAll</div>");
					$('#'+this.playerDiv).append("<div id='playertime"+this.playerId+"ShowAll' style='z-index: "+maxZIndex+"; position: absolute; border: 1px solid black; background:#ffffff; font-size: 12px; opacity: .7;  margin-left: "+(this.timeToPixel(this.maxTime)+40)+"px; height: "+this.playerHeight+"px;' >Show/HideAll</div>");
				 	// append ...
				 	$("#playertime"+this.playerId+"ShowAll").click(function() { objectThis.toggleTimeComments();  });

			 		// controls
			 		// time till the end 
					maxZIndex=maxZIndex+1;
//				 	$('#'+this.playerDiv).append("<div id='playertime"+this.playerId+"' style='z-index: "+maxZIndex+"; position: absolute; border: 1px solid black; background:#ffffff; font-size: 12px; opacity: .7;  margin-left: "+(this.timeToPixel(this.maxTime)+10)+"; height: "+this.playerHeight+";' > "+this.converToMinutes(this.maxTime)+" </div>");
				 	$('#'+this.playerDiv).append("<div id='playertime"+this.playerId+"' style='z-index: "+maxZIndex+"; position: absolute; border: 1px solid black; background:#ffffff; font-size: 12px; opacity: .7;  margin-left: "+(this.timeToPixel(this.maxTime)+10)+"px; height: "+this.playerHeight+"px;' > "+this.converToMinutes(this.maxTime)+" </div>");
					

				 	// play
					maxZIndex=maxZIndex+1;
				 	$('#'+this.playerDiv).append("<div id='playerPlay"+this.playerId+"' style='z-index: "+maxZIndex+"; position: absolute; border: 1px solid black; background:#cccccc; width: 10px; font-size: 8px; valign: topx; vertical-alignment:top; ' >></div>");
				 	$("#playerPlay"+this.playerId+"").click(function() { objectThis.toggle();  });

				
				 // start to 0
				 this.startAt(0.0);
			}
				// pixels
				this.timeToPixel = function( timeInSecsToPixel )
				{
					var pixels=0;

					if (timeInSecsToPixel<0) timeInSecsToPixel=0;
					if (timeInSecsToPixel>this.maxTime) timeInSecsToPixel=this.maxTime;

					pixels=timeInSecsToPixel*this.timeToPixelRatio+this.playerOffset;

					return pixels;
				}

				this.pixelToTime = function( pixels )
				{
					var timeInSecs=0;

					if (pixels<0) pixels=0;
					if (pixels>this.playerWith) timeInSecsToPixel=this.playerWith;

					timeInSecs=pixels*this.pixelToTimeRatio;

					return timeInSecs;
				}

				this.getPlayerEnd=function()
				{
					return (this.playerOffset+this.playerWidth+this.playerbuttonspace);
				}
				



	}

			// textobject timed ...
			var TextObjectTimed = function( )
			{
				this.timeobjectA=0.0;
				this.timeobjectB=0.0;
				this.timeobjectId=-1;
				this.timeobjectDiv="";
				this.timeobjectAction=""; // go on / play

				// done this event
				this.inPlayerStatus=""; // playerstatus
			}
			

function LeadingZero(Time) {
	return (Time < 10) ? "0" + Time : + Time;
}