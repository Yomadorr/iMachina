<?

	class Rule
	{
		var $version=1.0;
		var $debug=false;


        // db 
    	var $ruleId=-1;
    	var $ruleStatus="active"; // active/waiting/disabled/invitation/invitationweb*
    	var $ruleTextObjectRef=-1;
    	var $ruleUserRef=-1;

    	var $ruleName="";

 	  		var $ruleTypeCaseInvitationsEmail=""; //* case: $ruleName==invitationweb this is activation code
     		var $ruleTypeCaseInvitationsText=""; //* case: $ruleName==invitationweb this is activation code
    		var $ruleTypeCaseInvitationWebCode=""; //* case: 

    	var $ruleUserOwnerRef=-1;

    	var $ruleCreate;

    	var $ruleHierarchy=""; // only used for rule merging ...

    	// generic rule? is rule pointing to a generic user?
    	// ... 
    	var $ruleGeneric=0; 

 		function User()
        {
        
        }
	
	
	// insert Record to Database
		function insertRecord()
		{
			$sqlInsert="INSERT INTO Rule ";

			$sqlInsert=$sqlInsert."(ruleName,ruleStatus,ruleTextObjectRef,ruleUserRef,ruleGeneric,ruleCreate,ruleTypeCaseInvitationsText, ruleTypeCaseInvitationWebCode, ruleUserOwnerRef, ruleTypeCaseInvitationsEmail ) ";
			$sqlInsert=$sqlInsert." values ";
			$sqlInsert=$sqlInsert."('".Converter::escapeSql($this->ruleName)."','".Converter::escapeSql($this->ruleStatus)."','".Converter::escapeSql($this->ruleTextObjectRef)."','".Converter::escapeSql($this->ruleUserRef)."','".Converter::escapeSql($this->ruleGeneric)."',Now(),'".Converter::escapeSql($this->ruleTypeCaseInvitationsText)."','".Converter::escapeSql($this->ruleTypeCaseInvitationWebCode)."','".Converter::escapeSql($this->ruleUserOwnerRef)."','".Converter::escapeSql($this->ruleTypeCaseInvitationsEmail)."'   )   "; // ruleTypeCaseInvitationsEmail $rulePasswordNew ruleTypeCaseInvitationsText, ruleTypeCaseInvitationWebCode, ruleUserOwnerRef
// echo($sqlInsert);
			return $sqlInsert;
		}
	
		// updateRecord
		// used?
		function updateRecord()
		{
			$sqlUpdate="update Rule ";
	
			$sqlUpdate=$sqlUpdate." set ruleName='".Converter::escapeSql($this->ruleName)."',ruleStatus='".Converter::escapeSql($this->ruleStatus)."',ruleTextObjectRef='".Converter::escapeSql($this->ruleTextObjectRef)."',ruleUserRef='".Converter::escapeSql($this->ruleUserRef)."' ";
			$sqlUpdate=$sqlUpdate." where ruleId=".Converter::escapeSql($this->ruleId)."   ";
// echo("User.updateRecord() ".$sqlUpdate);			
			return $sqlUpdate;
		}
	
		/*
		function getEmails()
		{
			$arrEmails=split(";",$this->ruleEmails);
			return $arrEmails;
		}
		*/

		// deleteRecord 
		function deleteRecord( )
		{
			$query="DELETE FROM Rule WHERE ruleId=".Converter::secureForSQL($this->ruleId)." ";
			return $query;
		}
		
		// update to record in database
		function updateToRecord( $result, $index )
		{
			$this->ruleId=Converter::unescapesql(mysql_result($result, $index,"ruleId"));
			$this->ruleStatus=Converter::unescapesql(mysql_result($result, $index,"ruleStatus"));			
			$this->ruleName=Converter::unescapesql(mysql_result($result, $index,"ruleName"));
			$this->ruleUserRef=Converter::unescapesql(mysql_result($result, $index,"ruleUserRef"));
			$this->ruleTextObjectRef=Converter::unescapesql(mysql_result($result, $index,"ruleTextObjectRef"));
			$this->ruleGeneric=Converter::unescapesql(mysql_result($result, $index,"ruleGeneric"));

				$this->ruleTypeCaseInvitationsText=Converter::unescapesql(mysql_result($result, $index,"ruleTypeCaseInvitationsText"));
				$this->ruleTypeCaseInvitationWebCode=Converter::unescapesql(mysql_result($result, $index,"ruleTypeCaseInvitationWebCode"));
				$this->ruleUserOwnerRef=Converter::unescapesql(mysql_result($result, $index,"ruleUserOwnerRef"));
				$this->ruleTypeCaseInvitationsEmail=Converter::unescapesql(mysql_result($result, $index,"ruleTypeCaseInvitationsEmail"));

			$this->ruleCreate=Converter::unescapesql(mysql_result($result, $index,"ruleCreate"));
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
			if (isset($request["ruleId"]))  {  $this->ruleId=$request["ruleId"]; } 
			if (isset($request["ruleName"]))  {  $this->ruleType=$request["ruleName"]; } 
			if (isset($request["ruleUserRef"]))  {  $this->ruleType=$request["ruleUserRef"]; } 
			if (isset($request["ruleTextObjectRef"]))  {  $this->ruleType=$request["ruleTextObjectRef"]; } 

				if (isset($request["ruleTypeCaseInvitationsText"]))  {  $this->ruleTypeCaseInvitationsText=$request["ruleTypeCaseInvitationsText"]; } 
				if (isset($request["ruleTypeCaseInvitationsEmail"]))  {  $this->ruleTypeCaseInvitationsEmail=$request["ruleTypeCaseInvitationsEmail"]; } 

		}
	
		function getAsFormat( $formatType )
		{
			$output="";
			
			
			return $output;
		}
		
	}
	
    
?>