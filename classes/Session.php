<?
	// Session
	class Session
    {
    	// session
	    var $sessionUserId=-1;
	    var $userType="user"; // user | admin

	    var $userObject; // filled every time .. 
	    
	    function logOut()
	    {
	    	$this->sessionUserId=-1;
	    	$this->userObject=null;
	    }
	    
	    // add ons ...
	    function isLoggedIn()
	    {
	    	if ($this->sessionUserId==-1) return false;
	    	// if ($this->sessionUserId=="-1") return false;
	    	return true;
	    }
	    
	    // is Admin
	    function isAdmin()
	    {
	    	if ($this->isLoggedIn())
	    	{
	    		// super admin - can administrate users etc
	    		if ($this->userObject->userType=="admin") return true;
	    		// admin excercise - can admin excercise
	    		if ($this->userObject->userType=="adminexcercise") return true;
	    		// admin excercsie assessment only 
	    		if ($this->userObject->userType=="adminexerciseassessementonly") return true;
	    	}
	    	
	    	return false;
	    }
	    
	    
	    
	    
    }
    
?>