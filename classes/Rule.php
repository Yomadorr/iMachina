<?

	class Rule
	{
		var $version=1.0;
		var $debug=false;


        // db 
    	var $ruleId=-1;
    	var $ruleStatus="active"; // active/waiting/disabled
    	var $ruleTextObjectRef=-1;
    	var $ruleUserRef=-1;

    	var $ruleName="";
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

			$sqlInsert=$sqlInsert."(ruleName,ruleStatus,ruleTextObjectRef,ruleUserRef,ruleGeneric,ruleCreate) ";
			$sqlInsert=$sqlInsert." values ";
			$sqlInsert=$sqlInsert."('".Converter::escapeSql($this->ruleName)."','".Converter::escapeSql($this->ruleStatus)."','".Converter::escapeSql($this->ruleTextObjectRef)."','".Converter::escapeSql($this->ruleUserRef)."','".Converter::escapeSql($this->ruleGeneric)."',Now()  )   "; // $rulePasswordNew
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
		}
	
		function getAsFormat( $formatType )
		{
			$output="";
			
			
			return $output;
		}
		
	}
	
    
?>