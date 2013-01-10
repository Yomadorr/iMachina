<?
	
	class Converter
    {
	    static function  escapesql($str)
    	{
          // $str=str_replace("'","''",$str);
            $str=str_replace("\\'","'",$str);
            $str=str_replace("'","''",$str);

            $str=Converter::phpToDatabaseEncoding($str);

    		return $str;
    	}
        static function  unescapesql($str)
        {
          // $str=str_replace("'","''",$str);
            //$str=str_replace("\\'","'",$str);
            // $str=str_replace("'","''",$str);

            $str=Converter::databaseToPHPEncoding($str);

            return $str;
        }


    	
    	static function  secureForSQL($str)
    	{
           // $str=str_replace("'","''",$str);
    		return $str;
    	}
    
        static function escapeToForm($str)
        {
            $str="";
            $str=$str.str_replace("'","&apos;",$str);
            $str=$str.str_replace("<","&lt;",$str);
            $str=$str.str_replace(">","&gt;",$str);
            return $str;
        }
    
            // utf8_encode()
            static function phpToDatabaseEncoding( $str )
            {
                return utf8_decode($str);
            }
            static function databaseToPHPEncoding( $str )
            {
                return utf8_encode($str);
            }

    }
    
?>