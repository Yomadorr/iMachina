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
 		// textcomment system with words...
 		var $textobjectCursorA=-1; // word cursors! it is the id of div (=word)
    	var $textobjectCursorB=-1; // word cursors! it is the id of div (=word)

		// todo: check all
		// as a comment - what type of coment is ist?
		// default is not commentable!
		// text/comment
		var $textobjectCommentType=""; // *** ... "","visual","text"

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
    	var $textobjectTypeSub=""; // plain ... add /text/plain

    		// arrTypeAlter. ...
	    	var $arrAlternativeTextobjectTypes=Array();
    		function addAlternativeType($atype,$atypeSub)
    		{
	    		$newType=new DocumentType($atype,$atypeSub);
	    		$this->arrAlternativeTextobjectTypes[count($this->arrAlternativeTextobjectTypes)]=$newType;
    		}

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

    		function getFilePath( $app )
    		{
    			$addVersionPath="";
				if ($this->getVersionId()!=0) $addVersionPath=".".$this->getVersionId();
				$filePath="documents/document".$this->textobjectId.".$addVersionPath".$this->textobjectSuffix;
				// base ...    
				$filePath=$app->getApplicationBaseFilePath().$filePath;

    			return $filePath;
    		}

    		function existsDocument( $app )
    		{
// echo("existsDocument( app )".$this->getFilePath( $app ));

    			if (file_exists($this->getFilePath( $app ))) return true;

    			return false;
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

		// comment - what is possible? !!! exampl. text/plain > can be commented by text!
		var $innerCommentType="text"; // text/visual/none	
			var $innerCommentable=false; // * commentable ... 

			// is the info somehow encrypted
			var $textobjectFormat=""; // * WordText

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

			$this->textobjectFormat=$copyFromObject->textobjectFormat;

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
			$sqlInsert=$sqlInsert."(textobjectStatus,textobjectType,textobjectTypeSub,textobjectRefName,textobjectName,textobjectRef,textobjectUserRef,textobjectCommentType,textobjectCursorA,textobjectCursorB,textobjectPositionX,textobjectPositionY,textobjectPositionZ,textobjectTimeA,textobjectTimeB,textobjectTimeLength,textobjectArgumentText,textobjectOrder,textobjectCreate, textobjectUpdate, textobjectVersionType, textobjectVersionUserRef, textobjectFormat) ";
			$sqlInsert=$sqlInsert." values ";
			$sqlInsert=$sqlInsert."('".Converter::escapeSql($this->textobjectStatus)."','".Converter::escapeSql($this->textobjectType)."','".Converter::escapeSql($this->textobjectTypeSub)."','".Converter::escapeSql($this->textobjectRefName)."','".Converter::escapeSql($this->textobjectName)."',".Converter::escapeSql($this->textobjectRef).",".Converter::escapeSql($this->textobjectUserRef).",'".Converter::escapeSql($this->textobjectCommentType)."',".Converter::escapeSql($this->textobjectCursorA).",".Converter::escapeSql($this->textobjectCursorB).",".Converter::escapeSql($this->textobjectPositionX).",".Converter::escapeSql($this->textobjectPositionY).",".Converter::escapeSql($this->textobjectPositionZ).",".Converter::escapeSql($this->textobjectTimeA).",".Converter::escapeSql($this->textobjectTimeB).",".Converter::escapeSql($this->textobjectTimeLength).",'".Converter::escapeSql($this->textobjectArgumentText)."',".Converter::escapeSql($this->textobjectOrder).",Now(),Now(),'".Converter::escapeSql($this->textobjectVersionType)."','".Converter::escapeSql($this->textobjectVersionUserRef)."','".Converter::escapeSql($this->textobjectFormat)."')   "; // textobjectFormat

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

			$sqlUpdate=$sqlUpdate.    ",textobjectFormat='".Converter::escapeSql($this->textobjectFormat)."' ";

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

		function updateTypeToTextRtf()
		{
			$sqlUpdate="UPDATE TextObject ";
	
			$sqlUpdate=$sqlUpdate." set textobjectTypeSub='rtf'";
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

			$this->textobjectFormat=Converter::unescapesql(mysql_result($result, $index,"textobjectFormat"));

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

		/*

			TextComment
		
		*/
		/*
	          Texts (and CommentText)

	          Remark: Text out of WordTexts > Word-Tagged Texts...

	          WordText: <>TextWord/TextWord</>
	      */
	      // WordText: <imachinaTextDiv><div class='imachinaText'   onClick="onTextClick( 1001, 92 )"  id='imt1001_92' imachinaTag>Das</div id='endimt1001_92'><div class='detailComponentCommentsText'  id='commentimt1001_92'></div><div class='imachinaText'   onClick="onTextClick( 1001, 93 )"  id='imt1001_93' imachinaTag> </div id='endimt1001_93'><div class='detailComponentCommentsText'  id='commentimt1001_93'></div><div class='imachinaText'   onClick="onTextClick( 1001, 94 )"  id='imt1001_94' imachinaTag>ist</div id='endimt1001_94'><div class='detailComponentCommentsText'  id='commentimt1001_94'></div><div class='imachinaText'   onClick="onTextClick( 1001, 95 )"  id='imt1001_95' imachinaTag> </div id='endimt1001_95'><div class='detailComponentCommentsText'  id='commentimt1001_95'></div><div class='imachinaText'   onClick="onTextClick( 1001, 96 )"  id='imt1001_96' imachinaTag>der</div id='endimt1001_96'><div class='detailComponentCommentsText'  id='commentimt1001_96'></div><div class='imachinaText'   onClick="onTextClick( 1001, 97 )"  id='imt1001_97' imachinaTag> </div id='endimt1001_97'><div class='detailComponentCommentsText'  id='commentimt1001_97'></div><div class='imachinaText'   onClick="onTextClick( 1001, 98 )"  id='imt1001_98' imachinaTag>Weg</div id='endimt1001_98'><div class='detailComponentCommentsText'  id='commentimt1001_98'></div><div class='imachinaText'   onClick="onTextClick( 1001, 99 )"  id='imt1001_99' imachinaTag> </div id='endimt1001_99'><div class='detailComponentCommentsText'  id='commentimt1001_99'></div><div class='imachinaText'   onClick="onTextClick( 1001, 100 )"  id='imt1001_100' imachinaTag>hinab</div id='endimt1001_100'><div class='detailComponentCommentsText'  id='commentimt1001_100'></div><div class='imachinaText'   onClick="onTextClick( 1001, 101 )"  id='imt1001_101' imachinaTag> </div id='endimt1001_101'><div class='detailComponentCommentsText'  id='commentimt1001_101'></div><div class='imachinaText'   onClick="onTextClick( 1001, 102 )"  id='imt1001_102' imachinaTag>ins</div id='endimt1001_102'><div class='detailComponentCommentsText'  id='commentimt1001_102'></div><div class='imachinaText'   onClick="onTextClick( 1001, 103 )"  id='imt1001_103' imachinaTag> </div id='endimt1001_103'><div class='detailComponentCommentsText'  id='commentimt1001_103'></div><div class='imachinaText'   onClick="onTextClick( 1001, 104 )"  id='imt1001_104' imachinaTag>Ungewisse.</div id='endimt1001_104'><div class='detailComponentCommentsText'  id='commentimt1001_104'></div><div class='imachinaText'   onClick="onTextClick( 1001, 105 )"  id='imt1001_105' imachinaTag> </div id='endimt1001_105'><div class='detailComponentCommentsText'  id='commentimt1001_105'></div><div class='imachinaText'   onClick="onTextClick( 1001, 106 )"  id='imt1001_106' imachinaTag></div id='endimt1001_106'><div class='detailComponentCommentsText'  id='commentimt1001_106'></div><div class='imachinaText'   onClick="onTextClick( 1001, 107 )"  id='imt1001_107' imachinaTag> </div id='endimt1001_107'><div class='detailComponentCommentsText'  id='commentimt1001_107'></div><br><div class='imachinaText'   onClick="onTextClick( 1001, 86 )"  id='imt1001_86' imachinaTag></div id='endimt1001_86'><div class='detailComponentCommentsText'  id='commentimt1001_86'></div><div class='imachinaText'   onClick="onTextClick( 1001, 87 )"  id='imt1001_87' imachinaTag> </div id='endimt1001_87'><div class='detailComponentCommentsText'  id='commentimt1001_87'></div><div class='imachinaText'   onClick="onTextClick( 1001, 88 )"  id='imt1001_88' imachinaTag>Was</div id='endimt1001_88'><div class='detailComponentCommentsText'  id='commentimt1001_88'></div><div class='imachinaText'   onClick="onTextClick( 1001, 89 )"  id='imt1001_89' imachinaTag> </div id='endimt1001_89'><div class='detailComponentCommentsText'  id='commentimt1001_89'></div><div class='imachinaText'   onClick="onTextClick( 1001, 90 )"  id='imt1001_90' imachinaTag></div id='endimt1001_90'><div class='detailComponentCommentsText'  id='commentimt1001_90'></div><div class='imachinaText'   onClick="onTextClick( 1001, 91 )"  id='imt1001_91' imachinaTag> </div id='endimt1001_91'><div class='detailComponentCommentsText'  id='commentimt1001_91'></div><div class='imachinaText'  onClick="onTextClick( 1001, 16 )"  id='imt1001_16' imachinaTag>meinstdu</div><div class='imachinaText'   onClick="onTextClick( 1001, 80 )"  id='imt1001_80' imachinaTag></div id='endimt1001_80'><div class='detailComponentCommentsText'  id='commentimt1001_80'></div><div class='imachinaText'   onClick="onTextClick( 1001, 81 )"  id='imt1001_81' imachinaTag> </div id='endimt1001_81'><div class='detailComponentCommentsText'  id='commentimt1001_81'></div><div class='imachinaText'   onClick="onTextClick( 1001, 82 )"  id='imt1001_82' imachinaTag>Du</div id='endimt1001_82'><div class='detailComponentCommentsText'  id='commentimt1001_82'></div><div class='imachinaText'   onClick="onTextClick( 1001, 83 )"  id='imt1001_83' imachinaTag> </div id='endimt1001_83'><div class='detailComponentCommentsText'  id='commentimt1001_83'></div><div class='imachinaText'   onClick="onTextClick( 1001, 84 )"  id='imt1001_84' imachinaTag>!</div id='endimt1001_84'><div class='detailComponentCommentsText'  id='commentimt1001_84'></div><div class='imachinaText'   onClick="onTextClick( 1001, 85 )"  id='imt1001_85' imachinaTag> </div id='endimt1001_85'><div class='detailComponentCommentsText'  id='commentimt1001_85'></div><a href='http://www.heise.de'><div class='imachinaText'   onClick="onTextClick( 1001, 76 )"  id='imt1001_76' imachinaTag>alte</div id='endimt1001_76'><div class='detailComponentCommentsText'  id='commentimt1001_76'></div><div class='imachinaText'   onClick="onTextClick( 1001, 77 )"  id='imt1001_77' imachinaTag> </div id='endimt1001_77'><div class='detailComponentCommentsText'  id='commentimt1001_77'></div><div class='imachinaText'   onClick="onTextClick( 1001, 78 )"  id='imt1001_78' imachinaTag>Fettel</div id='endimt1001_78'><div class='detailComponentCommentsText'  id='commentimt1001_78'></div><div class='imachinaText'   onClick="onTextClick( 1001, 79 )"  id='imt1001_79' imachinaTag> </div id='endimt1001_79'><div class='detailComponentCommentsText'  id='commentimt1001_79'></div></a><div class='imachinaText'   onClick="onTextClick( 1001, 66 )"  id='imt1001_66' imachinaTag>.</div id='endimt1001_66'><div class='detailComponentCommentsText'  id='commentimt1001_66'></div><div class='imachinaText'   onClick="onTextClick( 1001, 67 )"  id='imt1001_67' imachinaTag> </div id='endimt1001_67'><div class='detailComponentCommentsText'  id='commentimt1001_67'></div><div class='imachinaText'   onClick="onTextClick( 1001, 68 )"  id='imt1001_68' imachinaTag>Der</div id='endimt1001_68'><div class='detailComponentCommentsText'  id='commentimt1001_68'></div><div class='imachinaText'   onClick="onTextClick( 1001, 69 )"  id='imt1001_69' imachinaTag> </div id='endimt1001_69'><div class='detailComponentCommentsText'  id='commentimt1001_69'></div><div class='imachinaText'   onClick="onTextClick( 1001, 70 )"  id='imt1001_70' imachinaTag>Weg</div id='endimt1001_70'><div class='detailComponentCommentsText'  id='commentimt1001_70'></div><div class='imachinaText'   onClick="onTextClick( 1001, 71 )"  id='imt1001_71' imachinaTag> </div id='endimt1001_71'><div class='detailComponentCommentsText'  id='commentimt1001_71'></div><div class='imachinaText'   onClick="onTextClick( 1001, 72 )"  id='imt1001_72' imachinaTag>tÃ¶tet.</div id='endimt1001_72'><div class='detailComponentCommentsText'  id='commentimt1001_72'></div><div class='imachinaText'   onClick="onTextClick( 1001, 73 )"  id='imt1001_73' imachinaTag> </div id='endimt1001_73'><div class='detailComponentCommentsText'  id='commentimt1001_73'></div><div class='imachinaText'   onClick="onTextClick( 1001, 74 )"  id='imt1001_74' imachinaTag></div id='endimt1001_74'><div class='detailComponentCommentsText'  id='commentimt1001_74'></div><div class='imachinaText'   onClick="onTextClick( 1001, 75 )"  id='imt1001_75' imachinaTag> </div id='endimt1001_75'><div class='detailComponentCommentsText'  id='commentimt1001_75'></div><div class='imachinaText'  onClick="onTextClick( 1001, 20 )"  id='imt1001_20' imachinaTag>Die</div><div class='imachinaText'   onClick="onTextClick( 1001, 59 )"  id='imt1001_59' imachinaTag> </div id='endimt1001_59'><div class='detailComponentCommentsText'  id='commentimt1001_59'></div><div class='imachinaText'   onClick="onTextClick( 1001, 60 )"  id='imt1001_60' imachinaTag>Welt</div id='endimt1001_60'><div class='detailComponentCommentsText'  id='commentimt1001_60'></div><div class='imachinaText'   onClick="onTextClick( 1001, 61 )"  id='imt1001_61' imachinaTag> </div id='endimt1001_61'><div class='detailComponentCommentsText'  id='commentimt1001_61'></div><div class='imachinaText'   onClick="onTextClick( 1001, 62 )"  id='imt1001_62' imachinaTag>ist</div id='endimt1001_62'><div class='detailComponentCommentsTextIcon' onClick="onTextCommentToggle( 15001 )">[]</div><div class='detailComponentCommentsText'  id='commentimt1001_62'><div class='detailComponentCommentsTextEntity' id='imcommentt_'>ABC</div></div><div class='imachinaText'   onClick="onTextClick( 1001, 63 )"  id='imt1001_63' imachinaTag> </div id='endimt1001_63'><div class='detailComponentCommentsText'  id='commentimt1001_63'></div><div class='imachinaText'   onClick="onTextClick( 1001, 64 )"  id='imt1001_64' imachinaTag>da!</div id='endimt1001_64'><div class='detailComponentCommentsText'  id='commentimt1001_64'></div><div class='imachinaText'   onClick="onTextClick( 1001, 65 )"  id='imt1001_65' imachinaTag> </div id='endimt1001_65'><div class='detailComponentCommentsText'  id='commentimt1001_65'></div></div><div class='imachinaText'   onClick="onTextClick( 1001, 54 )"  id='imt1001_54' imachinaTag>.</div id='endimt1001_54'><div class='detailComponentCommentsText'  id='commentimt1001_54'></div><div class='imachinaText'   onClick="onTextClick( 1001, 55 )"  id='imt1001_55' imachinaTag> </div id='endimt1001_55'><div class='detailComponentCommentsText'  id='commentimt1001_55'></div><div class='imachinaText'   onClick="onTextClick( 1001, 56 )"  id='imt1001_56' imachinaTag></div id='endimt1001_56'><div class='detailComponentCommentsText'  id='commentimt1001_56'></div><div class='imachinaText'   onClick="onTextClick( 1001, 57 )"  id='imt1001_57' imachinaTag> </div id='endimt1001_57'><div class='detailComponentCommentsText'  id='commentimt1001_57'></div><strong><div class='imachinaText'   onClick="onTextClick( 1001, 46 )"  id='imt1001_46' imachinaTag>Er</div id='endimt1001_46'><div class='detailComponentCommentsText'  id='commentimt1001_46'></div><div class='imachinaText'   onClick="onTextClick( 1001, 47 )"  id='imt1001_47' imachinaTag> </div id='endimt1001_47'><div class='detailComponentCommentsText'  id='commentimt1001_47'></div><div class='imachinaText'   onClick="onTextClick( 1001, 48 )"  id='imt1001_48' imachinaTag>macht</div id='endimt1001_48'><div class='detailComponentCommentsText'  id='commentimt1001_48'></div><div class='imachinaText'   onClick="onTextClick( 1001, 49 )"  id='imt1001_49' imachinaTag> </div id='endimt1001_49'><div class='detailComponentCommentsText'  id='commentimt1001_49'></div><div class='imachinaText'   onClick="onTextClick( 1001, 50 )"  id='imt1001_50' imachinaTag>sie</div id='endimt1001_50'><div class='detailComponentCommentsText'  id='commentimt1001_50'></div><div class='imachinaText'   onClick="onTextClick( 1001, 51 )"  id='imt1001_51' imachinaTag> </div id='endimt1001_51'><div class='detailComponentCommentsText'  id='commentimt1001_51'></div><div class='imachinaText'   onClick="onTextClick( 1001, 52 )"  id='imt1001_52' imachinaTag>fertig</div id='endimt1001_52'><div class='detailComponentCommentsText'  id='commentimt1001_52'></div><div class='imachinaText'   onClick="onTextClick( 1001, 53 )"  id='imt1001_53' imachinaTag> </div id='endimt1001_53'><div class='detailComponentCommentsText'  id='commentimt1001_53'></div></strong><div class='imachinaText'   onClick="onTextClick( 1001, 38 )"  id='imt1001_38' imachinaTag></div id='endimt1001_38'><div class='detailComponentCommentsText'  id='commentimt1001_38'></div><div class='imachinaText'   onClick="onTextClick( 1001, 39 )"  id='imt1001_39' imachinaTag> </div id='endimt1001_39'><div class='detailComponentCommentsText'  id='commentimt1001_39'></div><div class='imachinaText'   onClick="onTextClick( 1001, 40 )"  id='imt1001_40' imachinaTag>bis</div id='endimt1001_40'><div class='detailComponentCommentsText'  id='commentimt1001_40'></div><div class='imachinaText'   onClick="onTextClick( 1001, 41 )"  id='imt1001_41' imachinaTag> </div id='endimt1001_41'><div class='detailComponentCommentsText'  id='commentimt1001_41'></div><div class='imachinaText'   onClick="onTextClick( 1001, 42 )"  id='imt1001_42' imachinaTag>aufs</div id='endimt1001_42'><div class='detailComponentCommentsText'  id='commentimt1001_42'></div><div class='imachinaText'   onClick="onTextClick( 1001, 43 )"  id='imt1001_43' imachinaTag> </div id='endimt1001_43'><div class='detailComponentCommentsText'  id='commentimt1001_43'></div><div class='imachinaText'   onClick="onTextClick( 1001, 44 )"  id='imt1001_44' imachinaTag></div id='endimt1001_44'><div class='detailComponentCommentsText'  id='commentimt1001_44'></div><div class='imachinaText'   onClick="onTextClick( 1001, 45 )"  id='imt1001_45' imachinaTag> </div id='endimt1001_45'><div class='detailComponentCommentsText'  id='commentimt1001_45'></div><span><div class='imachinaText'   onClick="onTextClick( 1001, 37 )"  id='imt1001_37' imachinaTag>Blut</div id='endimt1001_37'><div class='detailComponentCommentsText'  id='commentimt1001_37'></div></span><div class='imachinaText'   onClick="onTextClick( 1001, 21 )"  id='imt1001_21' imachinaTag></div id='endimt1001_21'><div class='detailComponentCommentsText'  id='commentimt1001_21'></div><div class='imachinaText'   onClick="onTextClick( 1001, 22 )"  id='imt1001_22' imachinaTag> </div id='endimt1001_22'><div class='detailComponentCommentsText'  id='commentimt1001_22'></div><div class='imachinaText'   onClick="onTextClick( 1001, 23 )"  id='imt1001_23' imachinaTag>zerwuerrgte</div id='endimt1001_23'><div class='detailComponentCommentsText'  id='commentimt1001_23'></div><div class='imachinaText'   onClick="onTextClick( 1001, 24 )"  id='imt1001_24' imachinaTag> </div id='endimt1001_24'><div class='detailComponentCommentsText'  id='commentimt1001_24'></div><div class='imachinaText'   onClick="onTextClick( 1001, 25 )"  id='imt1001_25' imachinaTag>Zeit.</div id='endimt1001_25'><div class='detailComponentCommentsText'  id='commentimt1001_25'></div><div class='imachinaText'   onClick="onTextClick( 1001, 26 )"  id='imt1001_26' imachinaTag> </div id='endimt1001_26'><div class='detailComponentCommentsText'  id='commentimt1001_26'></div><div class='imachinaText'   onClick="onTextClick( 1001, 27 )"  id='imt1001_27' imachinaTag>was</div id='endimt1001_27'><div class='detailComponentCommentsText'  id='commentimt1001_27'></div><div class='imachinaText'   onClick="onTextClick( 1001, 28 )"  id='imt1001_28' imachinaTag> </div id='endimt1001_28'><div class='detailComponentCommentsText'  id='commentimt1001_28'></div><div class='imachinaText'   onClick="onTextClick( 1001, 29 )"  id='imt1001_29' imachinaTag>soll</div id='endimt1001_29'><div class='detailComponentCommentsText'  id='commentimt1001_29'></div><div class='imachinaText'   onClick="onTextClick( 1001, 30 )"  id='imt1001_30' imachinaTag> </div id='endimt1001_30'><div class='detailComponentCommentsText'  id='commentimt1001_30'></div><div class='imachinaText'   onClick="onTextClick( 1001, 31 )"  id='imt1001_31' imachinaTag>das!???</div id='endimt1001_31'><div class='detailComponentCommentsText'  id='commentimt1001_31'></div><div class='imachinaText'   onClick="onTextClick( 1001, 32 )"  id='imt1001_32' imachinaTag> </div id='endimt1001_32'><div class='detailComponentCommentsText'  id='commentimt1001_32'></div><div class='imachinaText'   onClick="onTextClick( 1001, 33 )"  id='imt1001_33' imachinaTag>.</div id='endimt1001_33'><div class='detailComponentCommentsText'  id='commentimt1001_33'></div><div class='imachinaText'   onClick="onTextClick( 1001, 34 )"  id='imt1001_34' imachinaTag> </div id='endimt1001_34'><div class='detailComponentCommentsText'  id='commentimt1001_34'></div><div class='imachinaText'   onClick="onTextClick( 1001, 35 )"  id='imt1001_35' imachinaTag></div id='endimt1001_35'><div class='detailComponentCommentsText'  id='commentimt1001_35'></div><div class='imachinaText'   onClick="onTextClick( 1001, 36 )"  id='imt1001_36' imachinaTag> </div id='endimt1001_36'><div class='detailComponentCommentsText'  id='commentimt1001_36'></div></imachinaTextDiv>
	      // entity: <div class='detailComponentCommentsText'  id='commentimt1001_35'>ABC</div><div class='imachinaText'   onClick="onTextClick( 1001, 36 )"  id='imt1001_36' imachinaTag> </div id='endimt1001_36'><div class='detailComponentCommentsText'  id='commentimt1001_36'></div>

	    // convert and update it ...
	    // not used anymore
	    function isWordText()
	    {
	    	/*
	    	if (stristr($this->getArgument(),"<imachinaTextDiv>")===FALSE) { return false; }
	    	return true;
	    	*/

	    	if ($this->textobjectFormat=="wordtext") return true;
	    	return false;
	    }

	    	// disable hrefs etc for textmarking-mode
	     	function updateArgumentDeactivateInteractivity()
	     	{
	     		$this->setArgument(str_replace(" href="," _href",$this->getArgument()));
	 		}
   
	      function updateArgumentAsWordText()
	      {
	      		$debugThis=false;

	      		// check if is Wordtext
	      		// version
	      		// if (!$this->isWordText()) 
				if ($this->textobjectFormat=="")
	      		{
	      			// text/plain? add \n > <br>!
	      			if (($this->textobjectType=="text")&&($this->textobjectTypeSub=="plain")) { $this->setArgument(str_replace("\r","<br />",$this->getArgument())); $this->setArgument(str_replace("\n","<br />",$this->getArgument())); }
	      			$this->replaceReturns( );
	      		}

	      		$selectableText=$this->getArgument();

	      		// envel. for simpler processing
	      		$selectableText="<imachina>".$selectableText."</imachina>";


				   // 1. find not imachinaTextId tagged object
	      			// remark: preg_match matches to (0)(1) > arr[0]
					$pattern = '/>([^<]+)/s';
					preg_match_all($pattern, $selectableText, $matches, PREG_OFFSET_CAPTURE, 3);

					// 2. take the foundings... 
					if ($debugThis) { echo("<hr><strong>STEP 1: FIND 'TEXT-SNIPPETS' (>Der Baum<) NOT IN TAGS! AND SPLIT</strong><hr>"); }

					$arrMatches=$matches[1];
					$arrFound=array();
					if ($debugThis) {  echo("<pre>");print_r($arrMatches);echo("</pre>"); }
					for ($i=0;$i<count($arrMatches);$i++)
					{
						// echo("<pre>");print_r($arrMatches[$i]);echo("</pre>");
						$newTextObject=new TextWordFound();
						$newTextObject->text=$arrMatches[$i][0];
						$newTextObject->position=$arrMatches[$i][1];
						$arrFound[count($arrFound)]=$newTextObject;
						if ($debugThis) echo("\n<br>---$i:-".$newTextObject->text);
					}
					// show matches here
					// debug
					for ($i=0;$i<count($arrFound);$i++)
					{
						$textObj=$arrFound[$i];
						// echo("<br>$i ".$textObj->debug());
					}

					if ($debugThis) { echo("<hr><strong>STEP 2: FIND MAX WORDID</strong><hr>"); }

					// get max imachinaTextId	
					$imachinaTextId=0;
					preg_match_all("/imt[0-9]+_([0-9]+)/", $selectableText, $arrImachinaIds, PREG_OFFSET_CAPTURE, 3);
					if ($debugThis)  { echo("<hr>ID<hr>");echo("<pre>");print_r($arrImachinaIds);echo("</pre>"); echo("<hr>"); }
					for ($i=0;$i<count($arrImachinaIds[1]);$i++)
					{
						$val=$arrImachinaIds[1][$i][0];
						if ($debugThis) echo("\n<br>-----VAL:".$val);
						$valInt=intval($val);
						/*
						$arrVal=explode("_",$val);
						if (count($arrVal)>0) { $val=$arrVal[1]; } 
						$valInt=intval($val);
						*/
						if ($valInt>$imachinaTextId) $imachinaTextId=$valInt;
					}
					if ($debugThis) echo("\n<br><hr>----".$imachinaTextId."---");

					if ($debugThis) echo("\n<hr>");	
					if ($debugThis) echo("\n<hr>");	
					if ($debugThis) echo("\n<hr>");	

					// imachinaTextId
					$imachinaTextId++;

					if ($debugThis) { echo("<hr><strong>STEP 3: GO BACKWARDS THROUGH FOUND TEXT-SNIPPETS</strong><hr>"); }

					// go from back to top 
					if (count($arrFound)>0)
					{
						for ($i=count($arrFound)-1;$i>=0;$i--)
						{
							$textObj=$arrFound[$i];
							// check 
							if ($debugThis) echo("\n<br><br><strong>TEXT-SNIPPET: $i: ".$textObj->debug()."</strong><br>");

							$inlineText=$textObj->text;

							// check now if there is something to do
						
							// check: "wordonly" > is it a imachinatext-div?
							//  imachinaTag>
							$isInSystem=false;
							// version 1
							// $checkForThisTag="imachinaTag>";

							// version 2
							// search for something like this ...
							$checkForThisTag="   id='imt234234_2'>";

							// case: "wordonly" > is it a imachinatext-div?
							// version 1
							// if ($debugThis) echo("\n<br>CHECK 1: Is it already a marked textmachina-word? (imachinaTag - at the end?)<br>");
							// version 2
							if ($debugThis) echo("\n<br>CHECK 1: Is it already a marked textmachina-word? (imachinaTag - at the end?)<br>");
							
							$pos=$textObj->position;
							if ($pos>strlen($checkForThisTag))
							{
								// version 1
								/*
								$posStart=$pos-strlen($checkForThisTag);
								// ok get thext
								$tag=substr($selectableText,$posStart,strlen($checkForThisTag));
								if ($debugThis) echo("<br>---------------- SUBSTRING BACK---<strike>{$tag}</strike>");
								if ($tag==$checkForThisTag)
								{
									$isInSystem=true;
								}
								*/

								// version 2
								// check preg_match
								$posStart=$pos-strlen($checkForThisTag);
								$tag=substr($selectableText,$posStart,strlen($checkForThisTag));
								if (preg_match("/ id='imt[0-9]+_[0-9]+'/", $tag))
								{
									$isInSystem=true;
								}
								if (preg_match("/ id=\"imt[0-9]+_[0-9]+\"/", $tag))
								{
									$isInSystem=true;
								}
								// echo("<br>TAGGG: --[".$tag."]--- INSYSTEM: ".$isInSystem);
							}

								// echo("------TAG: ".$tag);
								if ($debugThis) if ($isInSystem) echo("\n<br>-------------------> TAGFOUND > is part of imachinaWordText");
								if ($debugThis) if (!$isInSystem) echo("\n<br>-------------------> TAGNOTFOUND > not part of imachinaWordText yet");

								if ($debugThis) if (!$isInSystem) echo("\n<br><br>------------> WORDMODE (Splitted by words)");
								$commentMode="word";
								// mode: word - do it 
								// $app->
								if ($commentMode=="word")
								{
									$strReplace="";

									if ($debugThis) if (!$isInSystem) echo("\n<br>------------> EXPLODE WORDS ...");
	
									// explode
									$arrWords=explode(" ",$inlineText);
									// = one
									if (count($arrWords)==1)
									{
										// in system?
										if (!$isInSystem)
										{
	  										if ($debugThis) if (!$isInSystem) echo("\n<br><br>----------> HANDLE SINGLE WORD: ".$arrWords[0]);

											// add div here ... 
											// addTextObject()
											// $strReplace="\n-REPLACEONEWORD-";
											// <div class='imachinaText' id='imt".$textobjectId."_16' imachinaTag>
	  										if ($debugThis) if (!$isInSystem) echo("\n<br>---------------> ONLY ONE WORD > ADD ...");
											$strReplace=$strReplace.$this->addTextWord( $this->textobjectId, $imachinaTextId, $inlineText, $debugThis );
											$imachinaTextId++;
										}
										
										if ($isInSystem)
										{
											if ($debugThis) echo("<br>---------------> DON'T ADD IS IN SYSTEM IN SYSTEM ");
											$strReplace="";
										}
									}
									// on or more?
									if (count($arrWords)>1)
									{
										if ($debugThis) if (!$isInSystem) echo("\n<br><br>----------> HANDLE MULTIPLE WORDS: ".count($arrWords)." WORDS");

										// add all now ... 
										$strReplace="";  // \n(-REPLACEMORETHANONEWORD-)";

										// version one - problem <div id='100'>A B</div>
										/*
										for ($wordIndex=0;$wordIndex<count($arrWords);$wordIndex++)
										{
											$singleWord=$arrWords[$wordIndex];
											// echo($singleWord);
											$strReplace=$strReplace.addTextWord( $textobjectId, $imachinaTextId, $singleWord );
											$imachinaTextId++;

											$strReplace=$strReplace.addTextWord( $textobjectId, $imachinaTextId, " " );
											$imachinaTextId++;

										}
										*/

										for ($wordIndex=0;$wordIndex<count($arrWords);$wordIndex++)
										{
											$singleWord=$arrWords[$wordIndex];

	  										if ($debugThis) if (!$isInSystem) echo("\n<br><br>-------------> WORD $wordIndex: ".$singleWord);

	  										if ($singleWord!="")
	  										{
												// echo($singleWord);
												// cases first word!
												if (($isInSystem)&&($wordIndex==0)) { $strReplace=$strReplace.$singleWord."</span [wordindatabaseadd] >"; } // end div in original!
												if ((!$isInSystem)&&($wordIndex==0)) { $strReplace=$strReplace.$this->addTextWord( $this->textobjectId, $imachinaTextId, $singleWord, $debugThis  ); } // end div in original!

												if (($wordIndex>0))
												{ 
													$strReplace=$strReplace.$this->addTextWord( $this->textobjectId, $imachinaTextId, $singleWord, $debugThis );
												}
												$imachinaTextId++;
											}

												// add space?
												if ($wordIndex>0)
												{
													if ($wordIndex!=(count($arrWords)-1)) 
													{
														$strReplace=$strReplace.$this->addTextWord( $this->textobjectId, $imachinaTextId, " ", $debugThis );
														$imachinaTextId++;
													}
												}
												
										}

										// not in system
										// </span> toomuch
										// todo: change this dirty solution
										if (!$isInSystem)
										{
											// a closing span
											$strReplace=$strReplace."<span [morethanoneword-cleaner]>";
										}
									}

									// replace this here and now ...
									if ($strReplace!="")
									{
										if ($debugThis) if (!$isInSystem) echo("\n<br><br>---------------> REPLACEMENT WORDS TO DIVS");

										// cutoff ..
										$wordsLength=strlen($inlineText);
										$tmpText=$selectableText;
											$textA=substr($selectableText,0,$pos);
											if ($debugThis) echo("\n<br>-----------------------> ATPOS: ".$pos);
											$textB=substr($selectableText,$pos+$wordsLength);
											if ($debugThis) echo("\n[".$this->convertHtmlToSourceCode($textA)." [REPLACING] ");
											if ($debugThis) echo("\n".$this->convertHtmlToSourceCode($textB)." ]");
										$selectableText=$textA.$strReplace.$textB;
											if ($debugThis) echo("\n<br><br><br>-----------------------> RESULT: ".$this->convertHtmlToSourceCode($selectableText.""));
										// if ($debugThis) echo("\n!!!!!!!!!!!!!!!!!!!!CHANGED");
									}

								
								// mode: char - do every char!
								// ressource hungry
								if ($commentMode=="char")
								{

								}

							}

						}

						// done ..
						if ($debugThis) echo("\n\n\n<hr><br><hr>RESULT CLEAN (no start/stop-tags!: <br>".$selectableText);

						// add all ids and comments?


					}
				
					// case: someone is editing and produces more than one _1" by splitting text !!!
					// todo: go through and kill doubles 
					// _1 _1

					// envel. for simpler processing
		      		// $selectableText="<imachina>".$selectableText."</imachina>";
		      		$selectableText=substr($selectableText,strlen("<imachina>"),strlen($selectableText)-strlen("<imachina>"."</imachina>"));
		      		if ($debugThis) echo("<br>RESULT CUTTED: ".$selectableText);

					
					if ($debugThis) echo("<br>parsing done - text updated - done...");



				$this->setArgument($selectableText);
			}

					function convertHtmlToSourceCode( $text )
					{
						$text=str_replace("<","&lt;",$text);
						$text=str_replace(">","&gt;",$text);
						return $text;
					}

				function replaceReturns( )
			    {
			    	
			    	// todo: replace returns? <br/> - only in the direct .. text/plain

// check for textplain!			    	
// text/plain > text/rtf !!!!!
// if there is a comment on this!!!

    	            $this->setArgument( str_replace("\r"," ",$this->getArgument()) );
					$this->setArgument( str_replace("\n"," ",$this->getArgument()) );

// add this?				
			    	// add ...
			    	// $this->setArgument($this->getArgument());
			    }

						// function
						function addTextWord( $textobjectId, $imachinaTextId, $word, $debugThisMethode=false )
						{
							if ($debugThisMethode) echo("<br>---------------------> ADDWORD: ($word) as WORDID: imt".$textobjectId."_".$imachinaTextId."");
							return "<span id='imt".$textobjectId."_".$imachinaTextId."'>".$word."</span>";
							// version 2.0
							//		return "<div class='imachinaText'  id='imt".$textobjectId."_".$imachinaTextId."' imachinaTag>".$word."</div>";
							// version 1.0
							// return "<div class='imachinaText'  id='imt".$textobjectId."_".$imachinaTextId."' imachinaTag>".$word."</div id='endimt".$textobjectId."_".$imachinaTextId."'>";
						}


		          // get textword out of the text ... 
		          function getTextWords( )
		          { 
		          	  $textwordText=$this->getArgument();



		              $arr=array();

						// get the things ... 
		                // version 1.0
		                // preg_match_all("/ id='imt([0-9]+)_([0-9]+)' imachinaTag>([^<]+)/", $textwordText, $arrWords, PREG_OFFSET_CAPTURE, 3);
		                // version 2.0
		                preg_match_all("/ id='imt([0-9]+)_([0-9]+)'>([^<]+)/", $textwordText, $arrWords, PREG_OFFSET_CAPTURE, 3);
		                //echo("<pre>");
		                // print_r($arrWords);
		                // print_r($arrWords[1]); // every array after $1, $2 etc
		                //echo("</pre>");
		                for ($i=0;$i<count($arrWords[1]);$i++)
		                {
		                  $textwordTextObjectId=$arrWords[1][$i][0];
		                  $textwordId=$arrWords[2][$i][0];
		                  $textwordString=$arrWords[3][$i][0];
		                  
		                  //echo("<br>$i $textobjectId $textobjectWordId $textobjectString ");;
		                  $textwordObj=new TextWord();
		                  $textwordObj->textwordTextObjectId=$textwordTextObjectId;
		                  $textwordObj->textwordId=$textwordId;
		                  $textwordObj->textwordString=$textwordString;
		                  $arr[count($arr)]=$textwordObj;
		                }
		 
		                // echo("<pre>");print_r($arr);echo("</pre>");

		              return $arr;
		          }

		    // getTextFromWordIdToId
	        function getTextFromWordIdToId( $wordStartId, $wordEndId  )
	        {
	           $str="";

	           $textwordText=$this->getArgument();

	           $arrWords=$this->getTextWords( $textwordText );

	            $inSelection=false;
	            for ($i=0;$i<count($arrWords);$i++)
	            {
	                $textwordObj=$arrWords[$i];
	                if ($textwordObj->textwordId==$wordStartId)
	                {
	                    $inSelection=true;
	                }
	                if ($inSelection) { $str=$str."".$textwordObj->textwordString;  }
	                if ($textwordObj->textwordId==$wordEndId)
	                {
	                    break;
	                }
	            }

	           return $str;
	        }

		
	}
	
    
?>