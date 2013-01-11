<?

	// not in database 
	class RuleAccessMatrix
	{
		var $version=1.0;
		var $debug=false;

		// name
		var $ruleName="";
		var $name=""; // not used somehow - error
		var $label="";
		var $description="";

		// special
		var $flagAccessBanned=false; // * ...

		// access
		var $flagAccessRead=false;
		var $flagAccessChange=false;
		var $flagAccessDelete=false;

		var $flagAccessAddComments=false; // create

		var $flagAccessAddCommentsExtended=false; // create special objects 

		// checks
		function isReadable() { return $this->flagAccessRead; }
		function isChangeable() { return $this->flagAccessChange; }
		function isWritable() { return $this->flagAccessChange; }
		function isUpdatable() { return $this->flagAccessChange; }
		function isDeletable() { return $this->flagAccessDelete; }
		function isCommentable() { return $this->flagAccessAddComments; }
		function isCommentableExtended() { return $this->flagAccessAddCommentsExtended; }

		function debug()
		{
			$str="";
				$str=$str."".$this->ruleName." [u:".$this->flagAccessChange." r:".$this->flagAccessRead." d:".$this->flagAccessDelete."  [coments a:".$this->flagAccessAddComments." s:".$this->flagAccessAddCommentsExtended."]";
			return $str;
		}
    }
    
    
?>