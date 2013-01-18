<?

	class TextObject
	{
		var $debug=false;

		var $textobjectVersion=1.0; // class version ?

			// version 
			var $textobjectVersionId=0; // version 0/13/25/39 etc 
			var $textobjectVersionType=""; // type
			var $textobjectVersionUserRef=-1; // userref
			// var $textobjectVersionDate // date ...
			// var $textobjectVersionComment
			// get version id in the version database!
    		function getVersionId()
    		{
    			if (
    				($this->textobjectVersionId==0)
    				||
    				($this->textobjectVersionId==null)
    			  )
    			{
    				return 0;
    			}
    			else
    			{
    				return $this->textobjectVersionId;
    			}
    		}			

		// access*
		var $accessUserCanDelete=true; // > thread

        // db 
    	var $textobjectId=-1;

    	// status
    	var $textobjectStatus="published"; // published/draft/deleted

    	var $textobjectName=""; // name for / used in members!

		// refs
    	var $textobjectRef=-1; // name for 
    	var $textobjectRefName=""; // name for 

			// special
	    	var $textobjectUserRef=-1; // to a user

	    // special parents? ...
		var $needsThreadAsParent=false; // *
 
 		// REF TEXT (Cursor) *
 		var $textobjectCursorA=-1; // name for 
    	var $textobjectCursorB=-1; // name for 

		var $textobjectCommentType=""; // ... "","visual","text"

    	// REF GRAFIC (Pos) *
 		var $textobjectPositionX=50; // name for 
    	var $textobjectPositionY=50; // name for 
    	var $textobjectPositionZ=-1; // name for 

    	// gps? add here?

    	// REF TIME
    	var $textobjectTimeA=-1.0; // time ref 
    	var $textobjectTimeB=-1.0; // time ref
    	var $textobjectTimeAction=""; // play | stop

    	// open/close *
		// /border/over*
		// /chain

		// type
    	var $textobjectType="text"; // name for 
    	var $textobjectTypeSub="plain"; // name for 

					// overview type selection [add view]
					// var $textobjectviewTypes="text";
					var $textobjectviewTypeCategory="text";
					var $textobjectviewTypeCategoryLabel="Texts";

	    	// documents ...
    		var $textobjectDocument=0; // 0/1 has a document like .jpg etc.
    		var $textobjectSuffix=""; // suffix jpg/png etc ...

    		// after upload document
    		function onDocumentUpload($app,$userId)
    		{
    			// exp. timelength 
    			// $timelength=$...
    			// $app->updateTextObject($this);
    		}

    		// get document url
    		function getDocumentURL()
    		{
    							// show a special version?
				$addVersionPath="";
				if ($this->getVersionId()!=0) $addVersionPath=".".$this->getVersionId();
				$documentURL="documents/document".$this->textobjectId.".$addVersionPath".$this->textobjectSuffix;

				return $documentURL;
    		}

    		// special
    		// complex
    	    		// ... 
    		// var $textobjectDefintion=""; // Defintion? ""|"complex"	 *	used for dynamic adhoc types
    	
    	// argument
    	var $textobjectArgumentText=""; // name for 
    	var $textobjectArgumentFloat=0.0; // name for 
    	var $textobjectArgumentInt=0; // name for 
    	
    	// length*
    	var $textobjectTimeLength=-1; // time length 
    	// length*
    	var $textobjectLength=-1; // time length 
    	// size
		var $textobjectWidth=""; // time length 
		var $textobjectHeight=""; // 

		var $textobjectBackground=""; // * ... 

		// comment
		var $innerCommentType="text"; // text/visual/none	
		var $innerCommentable=false; // * commentable ... 


		// gps lat/lng*

    	// order
       	var $textobjectOrder=-1; // order... -1: not defined yet
       	// todo: !!!! 

       	// display* ... 
       	// todo: ...
       	// *
       	var $textobjectDisplay="edit"; // present / define in Hyperthread or only Thread? ... 

       	// copyright*
       	var $textobjectCopyright=""; // * "":no / "education": must - online in open communities important! ... 

       	// in case of domain *
       	var $textobjectIsPublic=1; // * is public = searchable etc ... 

        // special staff
		var $isRootAdminStuff=false; // * 
		var $isDomainAdminStuff=false; // * 
		var $isAdminStuff=false; // * 

		var $isStaffStuff=false; // * 
		
    	// different values?

    	var $textobjectCreate;
    	var $textobjectUpdate;
    	
	    	// temp ... var $textobjectFrontEndInsertToEditDialog=true;
    		var $textobjectFrontEndInsertToEditDialog=false;

    	// members
            
    	// definition
    	// (add on things)

    		// members

    		// membersActive
    		var $memberActivated=false;

    		// arr
    		var $arrMembers=Array();

    		// not existing - go to the definition and add one!
    		function addMemberByValue($refName,$memberRefLabelName,$memberIsList,$memberMimeType,$memberMimeTypeSub,$memberDefaultArgument,$memberVisibleOnlyForAdmin)
    		{
    			$newMember=new TextObjectComplexMember();
    			$newMember->memberRefName=$refName;
    			$newMember->memberRefLabelName=$memberRefLabelName;
    			$newMember->memberIsList=$memberIsList;
    			$newMember->memberMimeType=$memberMimeType;
    			$newMember->memberMimeTypeSub=$memberMimeTypeSub;
    			$newMember->memberDefaultArgument=$memberDefaultArgument;
    			$newMember->memberVisibleOnlyForAdmin=$memberVisibleOnlyForAdmin;

    			$newMember->textobjectObject;

    			return $this->addMember( $newMember );
    		}

    			function addMember( $memberObj )
    			{
    				// check if member is existhing here ...
    				$this->arrMembers[count($this->arrMembers)]=$memberObj;
    				return $memberObj;
	    		}

	    		function getMemberByName( $refName, $app, $userId )
	    		{
	    			// echo("getMemberByName( $refName, app, $userId )");
	    			for ($i=0;$i<count($this->arrMembers);$i++)
	    			{
	    				$obj=$this->arrMembers[$i];
						// echo("<br>(".$this->textobjectType.")getMemberByName( $refName ) $i ... ".$obj->memberRefName);
	    				if ($obj->memberRefName==$refName)
	    				{
	    					// echo("****");
		    				return $obj;
		    			}
	    			}
	    			
	    			return null;
	    		}

	    	function getMemberValue( $memberName, $app, $userId )
	    	{
	    		// echo("getMemberValue( $memberName, app, $userId )");
	    			
	    		$member=$this->getMemberByName( $memberName, $app, $userId );
	    		if ($member!=null)
	    		{
	    			// echo("<pre>");print_r($member);echo("</pre>");
	    			// echo("<pre>");print_r($member->textobjectObject);echo("</pre>");
	    			if ($member->textobjectObject!=null) 
	    			{
	    				$memberRealObject=$member->textobjectObject;
	    				return $memberRealObject->getArgument();
	    			}
	    		}

	    		return null;
	    	}

	    	function setMemberValue( $memberName, $value, $app, $userId  )
	    	{
	    		// set Member
	    		$member=$this->getMemberByName( $memberName, $app, $userId );
	    		if ($member!=-1)
	    		{
	    			$member->textobjectObject->setArgument($value);	
	    		}

	    		// todo
	    		// store object ?
	    		if ($this->textobjectObject->textobjectId=-1)
	    		{

	    		}
	    	}

    		function hasMembers()
    		{
    			if (count($this->arrMembers)>0)
    			{
    				return true;
    			}

    			return false;
    		}


 		function TextObject()
        {
        
        }
	
        /*
			setArgument
			maps the argument to correct object
        */
		function setArgument( $iArgument )
		{
			$this->textobjectArgumentText=$iArgument;
		}
		/*
			getArgument
			maps the argument to correct object
		*/
		function getArgument( )
		{
			return $this->textobjectArgumentText;
		}

				// cutted ...
				function getArgumentCutted()
				{
					$strTitle=$this->textobjectArgumentText;
					$titleLength=15;
					if (strlen($strTitle)>$titleLength) { $strTitle=substr($strTitle,0,$titleLength-3)."..."; }

					return $strTitle;
				}

		/*
			runtime
		*/
		function updateTo( $copyFromObject, $updateArguments=true )
		{
			$this->textobjectId=$copyFromObject->textobjectId;

			$this->textobjectStatus=$copyFromObject->textobjectStatus;
 
			$this->textobjectRef=$copyFromObject->textobjectRef;
			$this->textobjectRefName=$copyFromObject->textobjectRefName;

			$this->textobjectCommentType=$copyFromObject->textobjectCommentType;

			$this->textobjectPositionX=$copyFromObject->textobjectPositionX;
			$this->textobjectPositionY=$copyFromObject->textobjectPositionY;
			$this->textobjectPositionZ=$copyFromObject->textobjectPositionZ;
			$this->textobjectCursorA=$copyFromObject->textobjectCursorA;
			$this->textobjectCursorB=$copyFromObject->textobjectCursorB;

			$this->textobjectUserRef=$copyFromObject->textobjectUserRef;

			$this->textobjectTimeA=$copyFromObject->textobjectTimeA;
			$this->textobjectTimeB=$copyFromObject->textobjectTimeB;
			
			$this->textobjectWidth=$copyFromObject->textobjectWidth;
			$this->textobjectHeight=$copyFromObject->textobjectHeight;

			$this->textobjectTimeLength=$copyFromObject->textobjectTimeLength;

			$this->textobjectType=$copyFromObject->textobjectType;
			$this->textobjectTypeSub=$copyFromObject->textobjectTypeSub;
			// $this->textobjectDefintion=$copyFromObject->textobjectDefintion; // *

			$this->textobjectName=$copyFromObject->textobjectName;

			// versions
			// only in TextObjectVersion important
			$this->textobjectVersionId=$copyFromObject->textobjectVersionId;
			$this->textobjectVersionType=$copyFromObject->textobjectVersionType;
			$this->textobjectVersionUserRef=$copyFromObject->textobjectVersionUserRef;


			if ($updateArguments)
			{
				/*
				$this->textobjectArgumentFloat=$copyFromObject->textobjectArgumentFloat;
				$this->textobjectArgumentInt=$copyFromObject->textobjectArgumentInt;
				$this->textobjectArgumentText=$copyFromObject->textobjectArgumentText;
				*/

				$this->setArgument($copyFromObject->getArgument());
					
			}

			// returns the own object
			return $this;
		}
	
		/*
			database
		*/
		// insert Record to Database
		function insertRecord()
		{
			$sqlInsert="INSERT INTO TextObject ";
			$sqlInsert=$sqlInsert."(textobjectStatus,textobjectType,textobjectTypeSub,textobjectRefName,textobjectName,textobjectRef,textobjectUserRef,textobjectCommentType,textobjectCursorA,textobjectCursorB,textobjectPositionX,textobjectPositionY,textobjectPositionZ,textobjectTimeA,textobjectTimeB,textobjectTimeLength,textobjectArgumentText,textobjectOrder,textobjectCreate, textobjectUpdate, textobjectVersionType, textobjectVersionUserRef) ";
			$sqlInsert=$sqlInsert." values ";
			$sqlInsert=$sqlInsert."('".Converter::escapeSql($this->textobjectStatus)."','".Converter::escapeSql($this->textobjectType)."','".Converter::escapeSql($this->textobjectTypeSub)."','".Converter::escapeSql($this->textobjectRefName)."','".Converter::escapeSql($this->textobjectName)."',".Converter::escapeSql($this->textobjectRef).",".Converter::escapeSql($this->textobjectUserRef).",'".Converter::escapeSql($this->textobjectCommentType)."',".Converter::escapeSql($this->textobjectCursorA).",".Converter::escapeSql($this->textobjectCursorB).",".Converter::escapeSql($this->textobjectPositionX).",".Converter::escapeSql($this->textobjectPositionY).",".Converter::escapeSql($this->textobjectPositionZ).",".Converter::escapeSql($this->textobjectTimeA).",".Converter::escapeSql($this->textobjectTimeB).",".Converter::escapeSql($this->textobjectTimeLength).",'".Converter::escapeSql($this->textobjectArgumentText)."',".Converter::escapeSql($this->textobjectOrder).",Now(),Now(),'".Converter::escapeSql($this->textobjectVersionType)."','".Converter::escapeSql($this->textobjectVersionUserRef)."')   "; // textobjectOrder

			return $sqlInsert;
		}
	
		// updateRecord
		function updateRecord()
		{
			$sqlUpdate="UPDATE TextObject ";
	
			$sqlUpdate=$sqlUpdate." set textobjectName='".Converter::escapeSql($this->textobjectName)."'";
			$sqlUpdate=$sqlUpdate.    ",textobjectStatus='".Converter::escapeSql($this->textobjectStatus)."' ";
			$sqlUpdate=$sqlUpdate.    ",textobjectRef=".Converter::escapeSql($this->textobjectRef)." ";
			$sqlUpdate=$sqlUpdate.    ",textobjectRefName='".Converter::escapeSql($this->textobjectRefName)."' ";
			$sqlUpdate=$sqlUpdate.    ",textobjectUserRef=".Converter::escapeSql($this->textobjectUserRef)." ";

			$sqlUpdate=$sqlUpdate.    ",textobjectTimeA=".Converter::escapeSql($this->textobjectTimeA)." ";
			$sqlUpdate=$sqlUpdate.    ",textobjectTimeB=".Converter::escapeSql($this->textobjectTimeB)." ";

			$sqlUpdate=$sqlUpdate.    ",textobjectCommentType='".Converter::escapeSql($this->textobjectCommentType)."' ";

			$sqlUpdate=$sqlUpdate.    ",textobjectCursorA=".Converter::escapeSql($this->textobjectCursorA)." ";
			$sqlUpdate=$sqlUpdate.    ",textobjectCursorB=".Converter::escapeSql($this->textobjectCursorB)." ";
			$sqlUpdate=$sqlUpdate.    ",textobjectPositionX=".Converter::escapeSql($this->textobjectPositionX)." ";
			$sqlUpdate=$sqlUpdate.    ",textobjectPositionY=".Converter::escapeSql($this->textobjectPositionY)." ";
			$sqlUpdate=$sqlUpdate.    ",textobjectPositionZ=".Converter::escapeSql($this->textobjectPositionZ)." ";

			$sqlUpdate=$sqlUpdate.    ",textobjectArgumentText='".Converter::escapeSql($this->textobjectArgumentText)."' ";
			$sqlUpdate=$sqlUpdate.    ",textobjectWidth='".Converter::escapeSql($this->textobjectWidth)."' ";
			$sqlUpdate=$sqlUpdate.    ",textobjectHeight='".Converter::escapeSql($this->textobjectHeight)."' ";
			$sqlUpdate=$sqlUpdate.    ",textobjectTimeLength='".Converter::escapeSql($this->textobjectTimeLength)."' ";

			$sqlUpdate=$sqlUpdate.    ",textobjectVersionType='".Converter::escapeSql($this->textobjectVersionType)."' ";
			$sqlUpdate=$sqlUpdate.    ",textobjectVersionUserRef='".Converter::escapeSql($this->textobjectVersionUserRef)."' ";

			$sqlUpdate=$sqlUpdate.    ",textobjectUpdate=Now() ";

			// $sqlUpdate=$sqlUpdate." textobjectModify = Now() ";
			$sqlUpdate=$sqlUpdate." where textobjectId=".Converter::escapeSql($this->textobjectId)."   ";
			return $sqlUpdate;
		}

		// deleteRecord 
		function deleteRecord( )
		{
			$query="DELETE FROM textobject WHERE textobjectId=".Converter::secureForSQL($this->textobjectId)." ";
			return $query;
		}
		
		// update to record in database
		function updateToRecord( $result, $index )
		{
			$this->textobjectId=Converter::unescapesql(mysql_result($result, $index,"textobjectId"));
			$this->textobjectStatus=Converter::unescapesql(mysql_result($result, $index,"textobjectStatus"));
			$this->textobjectRef=Converter::unescapesql(mysql_result($result, $index,"textobjectRef"));
			$this->textobjectRefName=Converter::unescapesql(mysql_result($result, $index,"textobjectRefName"));
			$this->textobjectUserRef=Converter::unescapesql(mysql_result($result, $index,"textobjectUserRef"));

			$this->textobjectCommentType=Converter::unescapesql(mysql_result($result, $index,"textobjectCommentType"));
			$this->textobjectCursorA=Converter::unescapesql(mysql_result($result, $index,"textobjectCursorA"));
			$this->textobjectCursorB=Converter::unescapesql(mysql_result($result, $index,"textobjectCursorB"));
			$this->textobjectPositionX=Converter::unescapesql(mysql_result($result, $index,"textobjectPositionX"));
			$this->textobjectPositionY=Converter::unescapesql(mysql_result($result, $index,"textobjectPositionY"));
			$this->textobjectPositionZ=Converter::unescapesql(mysql_result($result, $index,"textobjectPositionZ"));

			$this->textobjectTimeA=Converter::unescapesql(mysql_result($result, $index,"textobjectTimeA"));
			$this->textobjectTimeB=Converter::unescapesql(mysql_result($result, $index,"textobjectTimeB"));


			$this->textobjectName=Converter::unescapesql(mysql_result($result, $index,"textobjectName"));
			$this->textobjectType=Converter::unescapesql(mysql_result($result, $index,"textobjectType"));
			$this->textobjectTypeSub=Converter::unescapesql(mysql_result($result, $index,"textobjectTypeSub"));

			$this->textobjectArgumentText=Converter::unescapesql(mysql_result($result, $index,"textobjectArgumentText"));
			$this->textobjectArgumentInt=Converter::unescapesql(mysql_result($result, $index,"textobjectArgumentInt"));
			$this->textobjectArgumentFloat=Converter::unescapesql(mysql_result($result, $index,"textobjectArgumentFloat"));

			$this->textobjectWidth=Converter::unescapesql(mysql_result($result, $index,"textobjectWidth"));
			$this->textobjectHeight=Converter::unescapesql(mysql_result($result, $index,"textobjectHeight"));

			$this->textobjectTimeLength=Converter::unescapesql(mysql_result($result, $index,"textobjectTimeLength"));

			// versions
			// only in TextObjectVersion important
			$this->textobjectVersionId=Converter::unescapesql(mysql_result($result, $index,"textobjectVersionId"));
			$this->textobjectVersionType=Converter::unescapesql(mysql_result($result, $index,"textobjectVersionType"));
			$this->textobjectVersionUserRef=Converter::unescapesql(mysql_result($result, $index,"textobjectVersionUserRef"));

		} 
	
		function encodeField( $fieldvalue )
		{
//			return mb_convert_encoding($str, "SJIS");
// 			return htmlentities($fieldvalue);			
			return utf8_encode($fieldvalue);
			
			return $fieldvalue;
		}
		
		// Request
		function updateToWebRequest($request)
		{
			if (isset($request["textobjectId"]))  {  $this->textobjectId=$request["textobjectId"]; } 
			if (isset($request["textobjectStatus"]))  {  $this->textobjectStatus=$request["textobjectStatus"]; } 

			if (isset($request["textobjectType"]))  {  $this->textobjectType=$request["textobjectType"]; } 
			if (isset($request["textobjectTypeSub"]))  {  $this->textobjectTypeSub=$request["textobjectTypeSub"]; } 

			if (isset($request["textobjectRef"]))  {  $this->textobjectRef=$request["textobjectRef"]; } 
			if (isset($request["textobjectRefName"]))  {  $this->textobjectRefName=$request["textobjectRefName"]; } 
			if (isset($request["textobjectUserRef"]))  {  $this->textobjectUserRef=$request["textobjectUserRef"]; } 

			if (isset($request["textobjectCommentType"]))  {  $this->textobjectCommentType=$request["textobjectCommentType"]; } 

			if (isset($request["textobjectCursorA"]))  {  $this->textobjectCursorA=$request["textobjectCursorA"]; } 
			if (isset($request["textobjectCursorB"]))  {  $this->textobjectCursorB=$request["textobjectCursorB"]; } 
			if (isset($request["textobjectPositionX"]))  {  $this->textobjectPositionX=$request["textobjectPositionX"]; } 
			if (isset($request["textobjectPositionY"]))  {  $this->textobjectPositionY=$request["textobjectPositionY"]; } 
			if (isset($request["textobjectPositionZ"]))  {  $this->textobjectPositionZ=$request["textobjectPositionZ"]; } 
			if (isset($request["textobjectTimeA"]))  {  $this->textobjectTimeA=$request["textobjectTimeA"]; } 
			if (isset($request["textobjectTimeB"]))  {  $this->textobjectTimeB=$request["textobjectTimeB"]; } 

			// if (isset($request["textobjectArgumentText"]))  {  $this->textobjectArgumentText=$request["textobjectArgumentText"]; } 
			if (isset($request["textobjectArgument"]))  
			{  
				// $this->textobjectArgumentText=$request["textobjectArgumentText"]; 
				$this->setArgument($request["textobjectArgument"]); 
			} 
			
			// if (isset($request["textobjectName"]))  {  $this->textobjectName=$request["textobjectName"]; } 

			if (isset($request["textobjectWidth"]))  {  $this->textobjectWidth=$request["textobjectWidth"]; } 
			if (isset($request["textobjectHeight"]))  {  $this->textobjectHeight=$request["textobjectHeight"]; } 

			if (isset($request["textobjectTimeLength"]))  {  $this->textobjectTimeLength=$request["textobjectTimeLength"]; } 

		}
	
		/*
		function getAsFormat( $formatType )
		{
			$delimiter=";";
			$output="";
			
			if ($formatType=="csv")
			{
				$output=$output.$this->textobjectId; $output=$output.$delimiter;
				$output=$output.$this->textobjectSessionId; $output=$output.$delimiter;
				$output=$output.asciionly($this->textobjectCountry); $output=$output.$delimiter;
				$output=$output.asciionly($this->textobjectTown); $output=$output.$delimiter;

				$output=$output.$this->textobjectVirtualX; $output=$output.$delimiter;
				$output=$output.$this->textobjectVirtualY; $output=$output.$delimiter;
				$output=$output.$this->textobjectVirtualZ; $output=$output.$delimiter;

				$output=$output.$this->textobjectLat; $output=$output.$delimiter;
				$output=$output.$this->textobjectLng; $output=$output.$delimiter;
				$output=$output.$this->textobjectAlt; $output=$output.$delimiter;

				$output=$output.$this->textobjectCreate; $output=$output.$delimiter;

				$output=$output.$this->textobjectArgument; $output=$output.$delimiter;
				$uniformValue="0";
				if ($this->textobjectUniform!="") { $uniformValue=$this->textobjectUniform; }
				$output=$output.$uniformValue; $output=$output.$delimiter;

				$output=$output.str_replace("\n","(*)",$this->textobjectText); $output=$output.$delimiter;
				$output=$output.$this->textobjectURL; $output=$output.$delimiter;
				$output=$output.$this->textobjectName; $output=$output.$delimiter;
				$output=$output.$this->textobjectArgument; $output=$output.$delimiter;
				$output=$output.$this->textobjectTeam; $output=$output.$delimiter;
				
				$output=$output."\n";
			}
			
			return $output;
			
		}
		*/

		/*
			addevents
		*/
		function onInsert($app,$userId)
		{


		}

		function onUpdate($app,$userId)
		{


		}

		// todo: * not yet implemented
		function onDelete($app,$userId)
		{

		}

		/*
			 attributes

		*/
		//var $arrAttributes=new Array();
		function addTextObjectAttribute( $textobjectattributeObj )
		{


		}
		function setTextObjectAttribute($notFoundValue)
		{

		}
		function getTextObjectAttribute($notFoundValue)
		{

		}


		
	}
	
    
?>