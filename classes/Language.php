<?

    // todo: could also be in database
    // $app->getLanByKey("en","@dialog.login");
    // 
	class Language
	{
		
        var $arrLan=array();

 		function Language( )
        {
            // en
            $this->addLanguageByValue( "en", "dialog.login", "Please log in. " );
            $this->addLanguageByValue( "en", "textobject.length", "Time-Length" );

            $this->addLanguageByValue( "de", "textobject.length", "Länge" );

            return $this;
        }

        function addLanguageByValue( $lan, $key, $val )
        {
            $obj=new LanguageObject($lan,$key,$val);
            $this->addLanguageObject( $obj );
        }

            function addLanguageObject( $obj )
            {
                $arrLan[count($arrLan)]=$obj;
            }
		
	}    
    
?>