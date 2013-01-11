<?

	class User
	{
		var $debug=false;


        // db 
    	var $userId=-1;
    	var $userStatus="";

    	var $userAvatar="";

    	var $userName="";
    	var $userPreName="";
    	var $userType="user";
    	
    	var $userLogin="";
    	var $userPassword="";
    	var $userPasswordNew="";

  		var $userGroup="";
      	var $userClass="";

      	var $userEmails="";

      	var $userCanLogin=1; // 0/1

      	var $userGeneric=0;  // is user generic (friends/registrated)

      	var $userIconStatus="default";


 		function User()
        {
        
        }
	
	
	// insert Record to Database
		function insertRecord()
		{
			$sqlInsert="INSERT INTO User ";

			$sqlInsert=$sqlInsert."(userAvatar,userName,userPrename,userType,userGroup,userClass,userEmails,userLogin,userPassword,userPasswordNew,userCanLogin,userGeneric) ";
			$sqlInsert=$sqlInsert." values ";
			$sqlInsert=$sqlInsert."('".Converter::escapeSql($this->userAvatar)."','".Converter::escapeSql($this->userName)."','".Converter::escapeSql($this->userPreName)."','".Converter::escapeSql($this->userType)."','".Converter::escapeSql($this->userGroup)."','".Converter::escapeSql($this->userClass)."','".Converter::escapeSql($this->userEmails)."','".Converter::escapeSql($this->userLogin)."','".Converter::escapeSql($this->userPassword)."','".Converter::escapeSql($this->userPasswordNew)."','".Converter::escapeSql($this->userCanLogin)."','".Converter::escapeSql($this->userGeneric)."'   )   "; // $userPasswordNew / 

			return $sqlInsert;
		}
	
		// updateRecord
		function updateRecord()
		{
			$sqlUpdate="update User ";
	
			$sqlUpdate=$sqlUpdate." set userName='".Converter::escapeSql($this->userName)."',userPreName='".Converter::escapeSql($this->userPreName)."',userType='".Converter::escapeSql($this->userType)."',userGroup='".Converter::escapeSql($this->userGroup)."',userClass='".Converter::escapeSql($this->userClass)."',userEmails='".Converter::escapeSql($this->userEmails)."',userLogin='".Converter::escapeSql($this->userLogin)."',userPassword='".Converter::escapeSql($this->userPassword)."',userPasswordNew='".Converter::escapeSql($this->userPasswordNew)."' ";
			$sqlUpdate=$sqlUpdate." where userId=".Converter::escapeSql($this->userId)."   ";
// echo("User.updateRecord() ".$sqlUpdate);			
			return $sqlUpdate;
		}
	
		/*
		function getEmails()
		{
			$arrEmails=split(";",$this->userEmails);
			return $arrEmails;
		}
		*/

		// deleteRecord 
		function deleteRecord( )
		{
			$query="DELETE FROM User WHERE userId=".Converter::secureForSQL($this->userId)." ";
			return $query;
		}
		
		// update to record in database
		function updateToRecord( $result, $index )
		{
			$this->userId=Converter::unescapesql(mysql_result($result, $index,"userId"));
			$this->userType=Converter::unescapesql(mysql_result($result, $index,"userType"));
			
			$this->userAvatar=Converter::unescapesql(mysql_result($result, $index,"userAvatar"));
			
			$this->userName=Converter::unescapesql(mysql_result($result, $index,"userName"));
			$this->userPreName=Converter::unescapesql(mysql_result($result, $index,"userPreName"));
			$this->userLogin=Converter::unescapesql(mysql_result($result, $index,"userLogin"));
			$this->userPassword=Converter::unescapesql(mysql_result($result, $index,"userPassword"));
			$this->userPasswordNew=Converter::unescapesql(mysql_result($result, $index,"userPasswordNew"));
			$this->userStatus=Converter::unescapesql(mysql_result($result, $index,"userStatus"));
			$this->userClass=Converter::unescapesql(mysql_result($result, $index,"userClass"));
			$this->userGroup=Converter::unescapesql(mysql_result($result, $index,"userGroup"));
			$this->userEmails=Converter::unescapesql(mysql_result($result, $index,"userEmails"));

			$this->userIconStatus=Converter::unescapesql(mysql_result($result, $index,"userIconStatus"));			

			$this->userCanLogin=Converter::unescapesql(mysql_result($result, $index,"userCanLogin"));
			$this->userGeneric=Converter::unescapesql(mysql_result($result, $index,"userGeneric"));

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
			
			if (isset($request["userId"]))  {  $this->userId=$request["userId"]; } 
			if (isset($request["userType"]))  {  $this->userType=$request["userType"]; } 
			// if (isset($request["userStatus"]))  {  $this->userStatus=$request["userStatus"]; } 
			if (isset($request["userName"]))  {  $this->userName=$request["userName"]; } 
			if (isset($request["userPreName"]))  {  $this->userPreName=$request["userPreName"]; }
			if (isset($request["userLogin"]))  {  $this->userLogin=$request["userLogin"]; }
			if (isset($request["userPassword"]))  {  $this->userPassword=$request["userPassword"]; }
			if (isset($request["userPasswordNew"]))  {  $this->userPasswordNew=$request["userPasswordNew"]; }
			if (isset($request["userClass"]))  {  $this->userClass=$request["userClass"]; }
			if (isset($request["userGroup"]))  {  $this->userGroup=$request["userGroup"]; }
			if (isset($request["userEmails"]))  {  $this->userEmails=$request["userEmails"]; }

			


		}
	
		function getAsFormat( $formatType )
		{
			/*
			$delimiter=";";
			$output="";
			
			if ($formatType=="csv")
			{
				$output=$output.$this->userId; $output=$output.$delimiter;
				$output=$output.$this->userSessionId; $output=$output.$delimiter;
				$output=$output.asciionly($this->userCountry); $output=$output.$delimiter;
				$output=$output.asciionly($this->userTown); $output=$output.$delimiter;

				$output=$output.$this->userVirtualX; $output=$output.$delimiter;
				$output=$output.$this->userVirtualY; $output=$output.$delimiter;
				$output=$output.$this->userVirtualZ; $output=$output.$delimiter;

				$output=$output.$this->userLat; $output=$output.$delimiter;
				$output=$output.$this->userLng; $output=$output.$delimiter;
				$output=$output.$this->userAlt; $output=$output.$delimiter;

				$output=$output.$this->userCreate; $output=$output.$delimiter;

				$output=$output.$this->userArgument; $output=$output.$delimiter;
				$uniformValue="0";
				if ($this->userUniform!="") { $uniformValue=$this->userUniform; }
				$output=$output.$uniformValue; $output=$output.$delimiter;

				$output=$output.str_replace("\n","(*)",$this->userText); $output=$output.$delimiter;
				$output=$output.$this->userURL; $output=$output.$delimiter;
				$output=$output.$this->userName; $output=$output.$delimiter;
				$output=$output.$this->userArgument; $output=$output.$delimiter;
				$output=$output.$this->userTeam; $output=$output.$delimiter;
				
				$output=$output."\n";
			}
			
			return $output;
			
		*/
		}
		
	}
	
    
    function asciionly( $str)
    {
//    	$str=utf8_decode($str);
		// $str = mb_convert_encoding($str, "UTF-8", "ASCII");
		return $str;
    }
    
    
?>