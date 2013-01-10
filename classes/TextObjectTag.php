<?

	class TextObjectTag
	{
		var $debug=false;


        // db 
    	var $textobjecttagId=-1;
    	var $textobjecttagStaus="";
    	var $textobjecttagName="";
    
 		function TextObjectTag()
        {
        
        }
	
	
	// insert Record to Database
		function insertRecord()
		{
			$sqlInsert="INSERT INTO textobjecttag ";

			$sqlInsert=$sqlInsert."(textobjecttagName,textobjecttagPrename,textobjecttagType,textobjecttagGroup,textobjecttagClass,textobjecttagEmails,textobjecttagLogin,textobjecttagPassword,textobjecttagPasswordNew) ";
			$sqlInsert=$sqlInsert." values ";
			$sqlInsert=$sqlInsert."('".Converter::escapeSql($this->textobjecttagName)."','".Converter::escapeSql($this->textobjecttagPreName)."','".Converter::escapeSql($this->textobjecttagType)."','".Converter::escapeSql($this->textobjecttagGroup)."','".Converter::escapeSql($this->textobjecttagClass)."','".Converter::escapeSql($this->textobjecttagEmails)."','".Converter::escapeSql($this->textobjecttagLogin)."','".Converter::escapeSql($this->textobjecttagPassword)."','".Converter::escapeSql($this->textobjecttagPasswordNew)."'  )   "; // $textobjecttagPasswordNew

			return $sqlInsert;
		}
	
		// updateRecord
		function updateRecord()
		{
			$sqlUpdate="update textobjecttag ";
	
			$sqlUpdate=$sqlUpdate." set textobjecttagName='".Converter::escapeSql($this->textobjecttagName)."',textobjecttagPreName='".Converter::escapeSql($this->textobjecttagPreName)."',textobjecttagType='".Converter::escapeSql($this->textobjecttagType)."',textobjecttagGroup='".Converter::escapeSql($this->textobjecttagGroup)."',textobjecttagClass='".Converter::escapeSql($this->textobjecttagClass)."',textobjecttagEmails='".Converter::escapeSql($this->textobjecttagEmails)."',textobjecttagLogin='".Converter::escapeSql($this->textobjecttagLogin)."',textobjecttagPassword='".Converter::escapeSql($this->textobjecttagPassword)."',textobjecttagPasswordNew='".Converter::escapeSql($this->textobjecttagPasswordNew)."' ";
			$sqlUpdate=$sqlUpdate." where textobjecttagId=".Converter::escapeSql($this->textobjecttagId)."   ";
// echo("TextObjectTag.updateRecord() ".$sqlUpdate);			
			return $sqlUpdate;
		}
	
		function getEmails()
		{
			$arrEmails=split(";",$this->textobjecttagEmails);
			return $arrEmails;
		}

		// deleteRecord 
		function deleteRecord( )
		{
			$query="DELETE FROM textobjecttag WHERE textobjecttagId=".Converter::secureForSQL($this->textobjecttagId)." ";
			return $query;
		}
		
		// update to record in database
		function updateToRecord( $result, $index )
		{
			$this->textobjecttagId=mysql_result($result, $index,"textobjecttagId");
			$this->textobjecttagType=mysql_result($result, $index,"textobjecttagType");
			$this->textobjecttagName=mysql_result($result, $index,"textobjecttagName");
			$this->textobjecttagPreName=mysql_result($result, $index,"textobjecttagPreName");
			$this->textobjecttagLogin=mysql_result($result, $index,"textobjecttagLogin");
			$this->textobjecttagPassword=mysql_result($result, $index,"textobjecttagPassword");
			$this->textobjecttagPasswordNew=mysql_result($result, $index,"textobjecttagPasswordNew");
			$this->textobjecttagStatus=mysql_result($result, $index,"textobjecttagStatus");
			$this->textobjecttagClass=mysql_result($result, $index,"textobjecttagClass");
			$this->textobjecttagGroup=mysql_result($result, $index,"textobjecttagGroup");
			$this->textobjecttagEmails=mysql_result($result, $index,"textobjecttagEmails");

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
			
			if (isset($request["textobjecttagId"]))  {  $this->textobjecttagId=$request["textobjecttagId"]; } 
			if (isset($request["textobjecttagType"]))  {  $this->textobjecttagType=$request["textobjecttagType"]; } 
			// if (isset($request["textobjecttagStatus"]))  {  $this->textobjecttagStatus=$request["textobjecttagStatus"]; } 
			if (isset($request["textobjecttagName"]))  {  $this->textobjecttagName=$request["textobjecttagName"]; } 
			if (isset($request["textobjecttagPreName"]))  {  $this->textobjecttagPreName=$request["textobjecttagPreName"]; }
			if (isset($request["textobjecttagLogin"]))  {  $this->textobjecttagLogin=$request["textobjecttagLogin"]; }
			if (isset($request["textobjecttagPassword"]))  {  $this->textobjecttagPassword=$request["textobjecttagPassword"]; }
			if (isset($request["textobjecttagPasswordNew"]))  {  $this->textobjecttagPasswordNew=$request["textobjecttagPasswordNew"]; }
			if (isset($request["textobjecttagClass"]))  {  $this->textobjecttagClass=$request["textobjecttagClass"]; }
			if (isset($request["textobjecttagGroup"]))  {  $this->textobjecttagGroup=$request["textobjecttagGroup"]; }
			if (isset($request["textobjecttagEmails"]))  {  $this->textobjecttagEmails=$request["textobjecttagEmails"]; }

			


		}
	
		function getAsFormat( $formatType )
		{
			/*
			$delimiter=";";
			$output="";
			
			if ($formatType=="csv")
			{
				$output=$output.$this->textobjecttagId; $output=$output.$delimiter;
				$output=$output.$this->textobjecttagSessionId; $output=$output.$delimiter;
				$output=$output.asciionly($this->textobjecttagCountry); $output=$output.$delimiter;
				$output=$output.asciionly($this->textobjecttagTown); $output=$output.$delimiter;

				$output=$output.$this->textobjecttagVirtualX; $output=$output.$delimiter;
				$output=$output.$this->textobjecttagVirtualY; $output=$output.$delimiter;
				$output=$output.$this->textobjecttagVirtualZ; $output=$output.$delimiter;

				$output=$output.$this->textobjecttagLat; $output=$output.$delimiter;
				$output=$output.$this->textobjecttagLng; $output=$output.$delimiter;
				$output=$output.$this->textobjecttagAlt; $output=$output.$delimiter;

				$output=$output.$this->textobjecttagCreate; $output=$output.$delimiter;

				$output=$output.$this->textobjecttagArgument; $output=$output.$delimiter;
				$uniformValue="0";
				if ($this->textobjecttagUniform!="") { $uniformValue=$this->textobjecttagUniform; }
				$output=$output.$uniformValue; $output=$output.$delimiter;

				$output=$output.str_replace("\n","(*)",$this->textobjecttagText); $output=$output.$delimiter;
				$output=$output.$this->textobjecttagURL; $output=$output.$delimiter;
				$output=$output.$this->textobjecttagName; $output=$output.$delimiter;
				$output=$output.$this->textobjecttagArgument; $output=$output.$delimiter;
				$output=$output.$this->textobjecttagTeam; $output=$output.$delimiter;
				
				$output=$output."\n";
			}
			
			return $output;
			
		*/
		}
		
	}    
    
?>