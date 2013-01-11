<?

	class Tag
	{
		var $debug=false;


        // db 
    	var $tagId=-1;
    	var $tagStaus="";
    	var $tagName="";
    
 		function Tag()
        {
        
        }
	
	
	// insert Record to Database
		function insertRecord()
		{
			$sqlInsert="INSERT INTO tag ";

			$sqlInsert=$sqlInsert."(tagName,tagPrename,tagType,tagGroup,tagClass,tagEmails,tagLogin,tagPassword,tagPasswordNew) ";
			$sqlInsert=$sqlInsert." values ";
			$sqlInsert=$sqlInsert."('".Converter::escapeSql($this->tagName)."','".Converter::escapeSql($this->tagPreName)."','".Converter::escapeSql($this->tagType)."','".Converter::escapeSql($this->tagGroup)."','".Converter::escapeSql($this->tagClass)."','".Converter::escapeSql($this->tagEmails)."','".Converter::escapeSql($this->tagLogin)."','".Converter::escapeSql($this->tagPassword)."','".Converter::escapeSql($this->tagPasswordNew)."'  )   "; // $tagPasswordNew

			return $sqlInsert;
		}
	
		// updateRecord
		function updateRecord()
		{
			$sqlUpdate="update tag ";
	
			$sqlUpdate=$sqlUpdate." set tagName='".Converter::escapeSql($this->tagName)."',tagPreName='".Converter::escapeSql($this->tagPreName)."',tagType='".Converter::escapeSql($this->tagType)."',tagGroup='".Converter::escapeSql($this->tagGroup)."',tagClass='".Converter::escapeSql($this->tagClass)."',tagEmails='".Converter::escapeSql($this->tagEmails)."',tagLogin='".Converter::escapeSql($this->tagLogin)."',tagPassword='".Converter::escapeSql($this->tagPassword)."',tagPasswordNew='".Converter::escapeSql($this->tagPasswordNew)."' ";
			$sqlUpdate=$sqlUpdate." where tagId=".Converter::escapeSql($this->tagId)."   ";
// echo("Tag.updateRecord() ".$sqlUpdate);			
			return $sqlUpdate;
		}
	
		function getEmails()
		{
			$arrEmails=split(";",$this->tagEmails);
			return $arrEmails;
		}

		// deleteRecord 
		function deleteRecord( )
		{
			$query="DELETE FROM tag WHERE tagId=".Converter::secureForSQL($this->tagId)." ";
			return $query;
		}
		
		// update to record in database
		function updateToRecord( $result, $index )
		{
			$this->tagId=mysql_result($result, $index,"tagId");
			$this->tagType=mysql_result($result, $index,"tagType");
			$this->tagName=mysql_result($result, $index,"tagName");
			$this->tagPreName=mysql_result($result, $index,"tagPreName");
			$this->tagLogin=mysql_result($result, $index,"tagLogin");
			$this->tagPassword=mysql_result($result, $index,"tagPassword");
			$this->tagPasswordNew=mysql_result($result, $index,"tagPasswordNew");
			$this->tagStatus=mysql_result($result, $index,"tagStatus");
			$this->tagClass=mysql_result($result, $index,"tagClass");
			$this->tagGroup=mysql_result($result, $index,"tagGroup");
			$this->tagEmails=mysql_result($result, $index,"tagEmails");

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
			
			if (isset($request["tagId"]))  {  $this->tagId=$request["tagId"]; } 
			if (isset($request["tagType"]))  {  $this->tagType=$request["tagType"]; } 
			// if (isset($request["tagStatus"]))  {  $this->tagStatus=$request["tagStatus"]; } 
			if (isset($request["tagName"]))  {  $this->tagName=$request["tagName"]; } 
			if (isset($request["tagPreName"]))  {  $this->tagPreName=$request["tagPreName"]; }
			if (isset($request["tagLogin"]))  {  $this->tagLogin=$request["tagLogin"]; }
			if (isset($request["tagPassword"]))  {  $this->tagPassword=$request["tagPassword"]; }
			if (isset($request["tagPasswordNew"]))  {  $this->tagPasswordNew=$request["tagPasswordNew"]; }
			if (isset($request["tagClass"]))  {  $this->tagClass=$request["tagClass"]; }
			if (isset($request["tagGroup"]))  {  $this->tagGroup=$request["tagGroup"]; }
			if (isset($request["tagEmails"]))  {  $this->tagEmails=$request["tagEmails"]; }

			


		}
	
		function getAsFormat( $formatType )
		{
			/*
			$delimiter=";";
			$output="";
			
			if ($formatType=="csv")
			{
				$output=$output.$this->tagId; $output=$output.$delimiter;
				$output=$output.$this->tagSessionId; $output=$output.$delimiter;
				$output=$output.asciionly($this->tagCountry); $output=$output.$delimiter;
				$output=$output.asciionly($this->tagTown); $output=$output.$delimiter;

				$output=$output.$this->tagVirtualX; $output=$output.$delimiter;
				$output=$output.$this->tagVirtualY; $output=$output.$delimiter;
				$output=$output.$this->tagVirtualZ; $output=$output.$delimiter;

				$output=$output.$this->tagLat; $output=$output.$delimiter;
				$output=$output.$this->tagLng; $output=$output.$delimiter;
				$output=$output.$this->tagAlt; $output=$output.$delimiter;

				$output=$output.$this->tagCreate; $output=$output.$delimiter;

				$output=$output.$this->tagArgument; $output=$output.$delimiter;
				$uniformValue="0";
				if ($this->tagUniform!="") { $uniformValue=$this->tagUniform; }
				$output=$output.$uniformValue; $output=$output.$delimiter;

				$output=$output.str_replace("\n","(*)",$this->tagText); $output=$output.$delimiter;
				$output=$output.$this->tagURL; $output=$output.$delimiter;
				$output=$output.$this->tagName; $output=$output.$delimiter;
				$output=$output.$this->tagArgument; $output=$output.$delimiter;
				$output=$output.$this->tagTeam; $output=$output.$delimiter;
				
				$output=$output."\n";
			}
			
			return $output;
			
		*/
		}
		
	}    
    
?>