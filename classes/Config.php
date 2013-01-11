<?

	/*
	
		configurations
	
	*/
	
	// Config
	class Config
	{
		var $arrConfigs=array();
		
		/*
			constructor
		*/
		// > 5.2x
		function Config()
		{
			// init defaults ... 
		 	$this->init();
		}
		
		function init()
		{
			// defaults
			
			// app 
			$this->addConfigByValue(  "name", "string", "imachina" );
			$this->addConfigByValue(  "description", "string", "imagination machina | web 2.o elearning and working" );
			$this->addConfigByValue(  "copyright", "string", "open source project" );
			$this->addConfigByValue(  "link", "string", "http://www.imachina.ch" );

			// database
			$this->addConfigByValue(  "database.host", "string", "localhost:3306" );
			$this->addConfigByValue(  "database.name", "string", "imachina" );
			$this->addConfigByValue(  "database.login", "string", "root" );
			$this->addConfigByValue(  "database.password", "string", "root" );

			// email
			$this->addConfigByValue(  "email.from", "string", "schreibberatung.ph@fhnw.ch" );

			// email sending server
			$this->addConfigByValue(  "email.usemailserver", "string", "false" );
			$this->addConfigByValue(  "email.host", "string", "lmailer.fhnw.ch" );
			$this->addConfigByValue(  "email.login", "string", "" );
			$this->addConfigByValue(  "email.password", "string", "" );

			// size textarea etc		
			$this->addConfigByValue(  "user.textarea.width", "string", "700" );
			$this->addConfigByValue(  "user.textarea.height", "string", "400" );
			// last item will overwrite earlier entries
		}

		function setConfigByValue(  $configName, $configType, $configValueString )
		{
			$this->addConfigByValue(  $configName, $configType, $configValueString );
		}
		
		function addConfigByValue(  $configName, $configType, $configValueString )
		{
			$confItemObj=new ConfigItem();
			$confItemObj->configName=$configName;
			$confItemObj->configType=$configType;
			$confItemObj->configValueString=$configValueString;
			
			$this->addConfig( $confItemObj );
		}

		function addConfig(  $configItemObj )
		{
			$this->arrConfigs[count($this->arrConfigs)]=$configItemObj;
		}
	
		function getConfigByName( $iname )
		{
			// search the latest !
			if (count($this->arrConfigs)>0)
			{
 				for ($t=count($this->arrConfigs)-1;$t>=0;$t--)
				{
					$confItemObj=$this->arrConfigs[$t];
					if ($confItemObj->configName==$iname)
					{
						return $confItemObj;
					}
				}
			}
			
			return null;
		}
		
		function getConfigValueByName( $iname )
		{
			$obj=$this->getConfigByName( $iname );
			if ($obj!=null) return $obj->configValueString;
			if ($obj==null) return "";
		}
		
		function getAllConfigs()
		{
			$strDebug="";
			$arrFounds=array();
			
			// search the latest !
			if (count($this->arrConfigs)>0)
			{
 				for ($t=count($this->arrConfigs)-1;$t>=0;$t--)
				{
					$confItemObj=$this->arrConfigs[$t];
					
					$found=false;
					if (count($arrFounds)>0)
					for ($o=0;$o<count($arrFounds);$o++)
					{
						if ($arrFounds[$o]==$confItemObj->configName)
						{
							$found=true;
						}
					}
					
					$strDebug=$strDebug."<br>";
					if ($found) $strDebug=$strDebug."<strike>";
						$strDebug=$strDebug.$confItemObj->configName."<!--[".$confItemObj->configType."]-->: ".$confItemObj->configValueString;
					if ($found) $strDebug=$strDebug."</strike>";

					$arrFounds[count($arrFounds)]="".$confItemObj->configName;
				}
			}
		
			return $strDebug;
		}
		
		
	}

?>