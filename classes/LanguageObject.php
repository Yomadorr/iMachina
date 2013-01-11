<?

	class LanguageObject
	{
		var $debug=false;

        // db 
    	// var $languageId=-1;
    	var $languageLanguage="en"; // de/en/fr
    	var $languageKey=""; 
    	var $languageValue="";
    
 		function LanguageObject( $language, $key, $value )
        {
        	$this->languageLanguage=$language;
        	$this->languageKey=$key;
        	$this->languageValue=$value;
        	
        	return $this;
        }
		
	}    
    
?>