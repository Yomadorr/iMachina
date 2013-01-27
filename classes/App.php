<?
	// App (MainClass)
  /*

    platform
    - domains


    ideas:
    - alias > new singletons ..



    todos:
    - arrays in definition!

  Structure
  |- Domain
     |- HyperThread
        |- ThreadA
        |- ThreadB
        |- ThreadC
        |- ...    

  Most important:
  
  TEXTOBJECT
  |-- TEXTOBJECTVIEW

  obj=new ...
  TEXTOBJECT=$app->getTextObjectCastForMime( $itype, $itypesub )

  // existing from database ...

  // View
  $objview=$app->getTextObjectViewFor($obj, $userId);



  // UserAccess
  TEXTOBJECT
  |--- USERACCESS -- USER

  |--- HYPERTHREAD
       |--- GROUP -- USERS 

  TEXTOBJECTHISTORY*
  |  change textobjectId > no AutoInkrement/No Key 
  |  add new datetime
  |- INSERT INTO TextObjectVersion (Select * from TextObject)
  |- INSERT INTO TextObjectVersion (Select * from TextObject WHERE textobjectId=110 )
  |- INSERT INTO TextObjectVersion (a,b) (Select a,b from TextObject WHERE textobjectId=110 )

  View:

  = Platform (TextObjectPlatformPlain) ======
  | .viewDetailPlatform()                   |
  |  -- Domain (TextObjectDomainView) ------|
  |  .viewDetailDomain()                    | 
  |  (TreeToHyperThread)                    |
  |   --TextObjectThreadHyperView --------| |
  |   .viewDetailHyperthread()            |
  |   |   TreeToThread                    | |
  |   |   --                              | |
  |   |   -- TextObjectThreadPlainView -| | |
  |   |   |                             | | |
  |   |   |   TextObjectViews           | | |
  |   |   |                             | | |
  |   |   ------------------------------- | |
  |   ------------------------------------| |
  ------------------------------------------

  VIEW
  -- DOMAINS > Special Domain? Show Domainobjects ...  
  -- DOMAIN       ====
  -- TreeA?
  -- HyperThread  ====  
  -- TreeB?
  -- Thread       ====


  RuleTypes [additiv?]
  - admin (Hyperthreads)
  - staff (can add 'veranstaltungen') > * thread/course
  - collaborator (creator) - team* ... 
  - friends (can add comments ... ) 
    [registrateduser [yes/no]]
  - spectator/freerider
    [registrateduser [yes/no] anonymous [yes/no]]

  - User
    -- Anoyme
    -- Registrated (~RegistratedPlatform)

    // envelopped Threads or domains
    -- RegistratedFriends*
    -- RegistratedHyperthread* 
    -- RegistratedDomain* 

    todo: member (always refName till up to object! )

  RuleAccessMatrix
  - read
  - write
  - delete
  - addcomments
  - addcommentsspec

        Rule
        - name 
        - textobjectRef
        - userRef

        - ruleArgumentRef // points to a group for example ...


  // TODO: * nice to have 
  // 0.0 * access control also on the layer of appmethodes > possiblity: load and mark with TextObject { var $access=true;  }
  
  
  ShowHistory
  - ...
  - ..

  CollaborativeGamemechanic
  - Get Points for Inserting/Adding ...
  - Front-Clicks ... 
  - ClicksOn ... 

  Following ...*
  - 

  Attribute




  */

	class App
	{
		// debug it
    	var $debug=false;

    // todos

    // - members
    // - textmarkers
    // - keywords
    // - attributes
    // - ego+ area
    // - loading components
    // - gamification (scores and points)
    // - design
    // - 

    // nicetohave:
    // - insert a member-object > open directly detail form ... example: link
    // - new object > scroll to this object ... 

    // bugs
    // - javascript-history: problem going forward and back - conten will not be found! load with return works ... 
    // - updateTextObject > ref? memberupdate > update baseobect (getBaseMember!)
    // - changing members > open such an object > problem with editing members !!!


		// version 
    var $version=0.78; // versions ... 

    // 0.78 implemented all classes for textmarking
    // 0.77 invite front-end implemented (not yet login etc...)
    // 0.76 imported div. javascripts for textmarking & new text for hyperthreads
    // 0.75 first time installed remote (several changes - app->emailSystem - killed app->emailFrom)
    // 0.74 first test for text-markers
    // 0.73 bug fixes & better add container ... 
    // 0.72 fixes on edit ... html ... 
    // 0.71 members update 50% integrated! (open: tinymce & upload objects!)
    // 0.7 members bug fix & first implementation of member update
    // 0.69 small bug fixes
    // 0.68 new todos
    // 0.67 Visualisation of "", "AllUsers", "TeamOnly"
    // 0.65 i are implemented - show now usage-user not collaborators
    // 0.64 first request implementation - not yet finished
    // 0.62 complete access implmentation
    // 0.61 implemented right into webservices ... simple error messages
    // 0.6 first correct implementation of the rights (only rendering rights)
    // 0.594 new structure in rednering content down to content
    // 0.591 div. bug fixes for rule window ... 
    // 0.59 User can login implemented / anonymous-user / friend / myfriend ... 
    // 0.58 dragn and rop implemented perfect
    // 0.57 multiple drag and drop minimal implementation
    // 0.56 single drag & drop implemented
    // 0.55 introduced single add und update for uploads (example image/png)
    // 0.54 included protected documents (documents will be streamed / htaccess)
    // 0.53 introduced versioning ... (backend)
    // 0.51 solved problems with dialog-position & fixed drag & drop for visuals comments
    // 0.5 all interactions now in only 3 divs (edit,rule,add) - not yet solved problem with dialogs on visual comments! first test for textobject-history > own table textobjecthistory (rb)
    // 0.49 published/draft/deleted implemented backarea app / disabled member direct memberedit (rb)
    // 0.47 back&forward in browser now available (html5) rb

    // ideas:
    //  add onStart=''|'start' - onEnd=''|'repeat'  (rb)
    //  add timeAAction='/go'  (rb)

    // new types: 
    //  zip


		// config object
		var $config; // config 

        // db 
    	var $dbconnect;

    	// email
      var $emailUseEmailServer=false; // hmmm ...
        	var $emailHost="smtp.imachina.ch"; // *
            // default no authen.
        	var $emailLogin=""; // 
        	var $emailPassword="";  // 

    	var $emailSystem="rene.bauer@zhdk.ch";

      // not yet implemented!
      // use seo names (insert seo name in domain properties!)
      // seo-names: /domain/
      // todo: into config
      var $urlConvertToSeo=true; // *

      // documents
      // attention: documents must be protected if there are some 
      var $documentsUseRewriteRules=true; // activate htaccess! (rewrite!) in documents (documentx.xyz > webservice.rest.php?area=document&action=get&textobjectId=xyz [&version=84] )
                                          // =false > usage without protection
      // add new 
      // todo: into config
      var $userCanCreateDomains=true; // *

    // -----------------------------
		// constructor
		// -----------------------------
        // php < 5.2
/*
		private __construct()
 		{
    
    }
*/        
		// called > 5.2
		function App()
 		{

 			// session
       // 	$this->session=new Session();
        	
        	// config
        	$this->config=new Config();
        	
        }

    // -----------------------------
		// init
		// -----------------------------
    // init App
    	function setConfigByValue( $iname, $itype, $ivalue )
    	{
		    $this->addConfigByValue(  $iname, $itype, $ivalue );
			}
        
    	function addConfigByValue( $iname, $itype, $ivalue )
    	{
				$this->config->addConfigByValue(  $iname, $itype, $ivalue );
			}
        
        	function getConfigValueByName( $iname )
        	{
        		return $this->config->getConfigValueByName( $iname );
        	}
        	
        	function debugConfigs()
        	{
	       		echo("<div class='debugconf'>".$this->config->getAllConfigs()."</div>");
        	}
        

    // -----------------------------
		// start
		// -----------------------------
        function start()
        {
        
        	// start database ..
        	// database
        	$host=$this->getConfigValueByName( "database.host" );
        	$database=$this->getConfigValueByName( "database.name" );
        	$login=$this->getConfigValueByName( "database.login" );
        	$password=$this->getConfigValueByName( "database.password" );
        	$this->initDB($host, $database, $login, $password);
        
        	$this->emailSystem=$this->getConfigValueByName( "email.system" );

            // check enabled
            $this->strEmailSystem=$this->getConfigValueByName( "email.usemailserver" );           
            //   echo("<hr>App.start()****".$this->strEmailSystem."***<hr>");
            if ($this->strEmailSystem=="true")
            {
                $this->emailUseEmailServer=true;
                // echo("<hr>App.start()*******<hr>");
            }

            // accessRules
            $this->initRuleTypes( );
            // debug
            // echo($this->debugRuleTypes());  

            /*
            $ruleObject=new Rule();
            $ruleObject->ruleUserRef=3306;
            $ruleObject->ruleName="collaborator";
            $ruleObject->ruleTextObjectRef=1164;
            $this->insertRule( $ruleObject, -1 );
            */

            // todo: check protections on documents
            // documentsUseRewriteRules
            if ($this->documentsUseRewriteRules==true)
            {
                // check if exists ... otherwise create!
                // or! print an alert! ... 


            }

            /*
              important default users...
            */
            // is there an admin user?
            /*
            $arrSpecialUser=$this->getUsersByUserType( "admin" );
            // not there?
            if (count($arrSpecialUser)>0)
            // if ($specialUser!=null)
            {
               $this->userAnonymous=$arrSpecialUser[0];
               return $this->userAnonymous;
            }
            */

            // registrated user
            $this->getUserRegistrated( );

            // anonymous
            $this->getUserAnonymous( );

        }

        // ?action=install
        function install( )
        {
          $str="";

          // for the default user 
          $userId=-1;

echo("<br>App.install().<br>");

          // installing
          $str=$str."<hr>install<hr>";

          // todo: check if there is something 
          // no platform?
          // > add platform
          // $app->

          // is there an installation done?
// todo          
        $platformObject=$this->getPlatform($userId);
        if ($platformObject==null)
        {
          // null generate one?
          // todo: problem
          echo("Problem with the installation. Install platform ... <br><a href='index.php?action=install'>install</a>");

          $this->installPlatform($userId);
          $platformObject=$this->getPlatform($userId);
          
            // create admin for platform
            $adminuserRootObject=$this->createUserRoot();
            $this->insertRuleByValueFor("admin",$platformObject->textobjectId,$adminuserRootObject->userId,$adminuserRootObject->userId);           

          // add an objects counter display ...


        }

          // return to this object
          echo("<br><a href='index.php'>start up</a>");

          return $str;
        }
        
        
        function stop()
        {
        
        }
        	
    // -----------------------------
		// database
		// -----------------------------
		
		function initDB($dbhost, $dbdatabase, $dblogin, $dbpassword)
  		{
  			// start
			if ($this->debug) { echo("\nApp() $dbhost, $dbdatabase,$dblogin,..)"); }
			if ($this->debug) $this->debugMessage("\nApp() host: ---$dbhost---  databasename: ---$dbdatabase--- login: ---$dblogin--- password: ---$dbpassword---..)");
           
           if ($this->debug) $this->debugMessage("\nApp(): connect to database");
            
           // connect to database
           $this->dbconnect = mysql_connect($dbhost,$dblogin,$dbpassword) or die("Rejected: Could not connect to database.");
           @mysql_select_db($dbdatabase,$this->dbconnect ) or die("<div style='border: 1px solid red; font-color: red; padding: 5px; '>problem with database selection: ".$dbdatabase." </div>");
    
    	   if ($this->debug) { echo("\nApp() $dbhost, $dbdatabase,$dblogin,..) end"); }
    	   

        }
       
            // getDatabaseConnection
            function getDatabaseConnection()
            {
            	return $this->dbconnect;
            }
     
    // -----------------------------
    // platform 
    // -----------------------------
    var $platformObject;
    
    function initPlatform($userId)
    {
        $platformObject=$this->getPlatform($userId);
        if ($platformObject==null)
        {
          // null generate one?
          // todo: problem
          echo("Problem with the installation. Install platform ... <br><a href='index.php?action=install'>install</a>");
/*
          // would be automatic!
          $this->installPlatform($userId);
          $platformObject=$this->getPlatform($userId);
*/
          return false;
        }

        if ($platformObject!=null)
        {
          $this->platformObject=$platformObject;
          return true;;
        }
    }

        function installPlatform( $userId )
        {
            $platformObj=$this->getTextObjectCastForMime( "platform", "plain" );
            // echo("<pre>");print_r($platformObj);echo("</pre>");
            $this->insertTextObject($platformObj,$userId);

            // add new platform users > look at insertTextObject
            // $platformObj->addRulesDefault();

            // add an example domain ...
            $this->installDomain( $userId );

            return $platformObj;
        }

      /*
      funciton initPlatformError()
      {
          return "";
      }
      */

        // from database
        function getPlatform( $userId)
        {
            // get platform from database!
            $arrPlatformObjectTmp=$this->fundamentalGetAllTextObjectsByRefAndType( -1, "platform", "plain" );
            // not existing?
            if (count($arrPlatformObjectTmp)>0) return $arrPlatformObjectTmp[0];
            return null;
        }

    function getActivePlatform( $userId)
    {
       return $this->platformObject;
    }

    // -----------------------------
    // domains
    // -----------------------------
    function installDomain( $userId )
    {
          $platformObj=$this->getTextObjectCastForMime( "domain", "plain" );
          $this->insertTextObject($platformObj,$userId);

          // todo: add admin for this user!
    }

    function createDomain( $domainName, $userId )
    {
          $platformObj=$this->getTextObjectCastForMime( "domain", "plain" );
          $platformObj->textobjectName=$domainName;
          $platformObj->setArgument($domainName);
          // public?
          $this->insertTextObject($platformObj,$userId);

          // todo: add admin for this user!
    }

    function getDomains( $userId )
    {
       $arr=$this->fundamentalGetAllTextObjectsByRefAndType( -1, "domain", "plain" );
       return $arr;
    }

        // todo: users ... 
        function getUserDomains( $userId )
        {
           $arr=$this->fundamentalGetAllTextObjectsByRefAndType( -1, "domain", "user" );
           return $arr;
        }

    function getUserDomainByUserId( $userRef , $userId)
    {
       // echo("getUserDomainByUserId( $userRef , $userId)");
       $arr=$this->fundamentalCountAllTextObjectsByUserRef($userRef);
       // print_r($arr);
       if (count($arr)>0) return $arr[0];

       return null;      
    }

    // -----------------------------
    // connections
    // -----------------------------
    // all textobjects for public add
    var $arrPublicTypes=array();
    function addPublicTypeTypeSub($itype,$itypesub)
    {
       // get object here ..
       // todo: automatic 
       $textobjectObj=$this->getTextObjectCastForMime( $itype, $itypesub );
       if ( $textobjectObj!=null)
       {
           $this->arrPublicTypes[count($this->arrPublicTypes)]= $textobjectObj;     
       }
    }
     
     	// -----------------------------
		// session / user
     	// -----------------------------
     //	var $session; // session is a special object (!=session object!)
     	
     	// should this be used?
     	/*
     	function isLoggedIn()
     	{
     		return $this->session->isLoggedIn();
     	}

     	function isAdmin()
     	{
     		return $this->session->isAdmin();
     	}
     	*/

      // todo: different processes for different types
      function createNewUser( $login, $accounttype="" ) // imachina, facebook, twitter, switch
      { 
          $userObj=new User();
          $userObj->userLogin=$login;
          // user login
          // @
          $arrSplit=explode("@",$login);
          $avatarName="".$arrSplit[0];
          $userObj->userName=$avatarName;
          $userObj->userAvatar=$avatarName;
          $userObj->userType=$accounttype;
          $userObj->userCanLogin=1;
          $this->jobSetRandomPasswordNew($userObj, true);
          $this->insertUser($userObj);

          // send this email
          $arrEmails[0]=$login;
          $emailText="";
              $emailText=$emailText."\n<br>";
              $emailText=$emailText."\n<br>Login-Name: ";
              $emailText=$emailText."\n<br>".$login;
              $emailText=$emailText."\n<br><br>You can login with a new password: ";
              $emailText=$emailText."\n<br>".$userObj->userPassword." ";
              $emailText=$emailText."\n<br>";
              $baseUrl=$this->getPlatformBaseURL();
              $emailText=$emailText."\n<br><a href='".$baseUrl."'>Login here (".$baseUrl.") ></a>";
 //             $arrEmails[count($arrEmails)]=$this->emailSystem;
  
          $sentEmail=$this->sendEmailWithTitleText($arrEmails,"[imachina] Account-Activation ",$emailText);

          return $userObj;
        }

        function createUserRoot()
        {
          // echo("createUserRoot()");
          /*
          // create a user object and add the admin rule here ... 
           $rootObj=$this->createSpecialUserExt( "root", "root", 0, true );
           return $rootObj;
           */
           $adminuserRootObject=$this->createNewUser( "root" );
           // add admin for the whole root!

           return $adminuserRootObject;
        }


        // todo: all or just a special domain?
        function createUserRegistrated()
        {
           $friendObj=$this->createSpecialUser( "Registrated Platform Users", "registrated", 0 );
           return $friendObj;
        }

        function createUserAnonymous()
        {
           $guestObj=$this->createSpecialUser( "Guest", "anonymous", 0 );
           return $guestObj;
        } 

        function createUserFriends()
        {
           $friendObj=createSpecialUser( "Friends", "friends", 0, false);
           return $friendObj;
        }

            function createSpecialUser( $name, $userType, $canLogin )
            {
              return $this->createSpecialUserExt( $name, $userType, $canLogin, true );
            }

              function createSpecialUserExt( $name, $userType, $canLogin, $flagCreateUserPassword )
              {
                 $newSpecialUser=new User(); // $this->createNewUser( $name, $userType ); // guest here ...
                 $newSpecialUser->userName=$name;
                 $newSpecialUser->userType=$userType;
                 $newSpecialUser->userCanLogin=$canLogin;

                 // special user
                   if ($userType=="registrated") $newSpecialUser->userGeneric=1;
                   if ($userType=="friends") $newSpecialUser->userGeneric=1;
                   if ($userType=="anonymous") $newSpecialUser->userGeneric=1;

                 if ($flagCreateUserPassword) $this->jobSetRandomPasswordNew($newSpecialUser, true);
                 $newSpecialUser=$this->insertUser($newSpecialUser);
                 return $newSpecialUser;
              }

              // create a new user with everything needed ..
              // no email, no password set etc .. 
              // email > use createNewUSer
              function insertUser( $userObj )
              { 
                  // 1. create user
                  $userCreatedObject=$this->fundamentalInsertUser($userObj);

                  // 2. add a user platform ... 
                  // create the user domain

                  $userDomain=new TextObjectDomainUser();
                  $userDomain->setArgument($userObj->userAvatar);
                  $userDomain->textobjectUserRef= $userObj->userId;
                  $userNewDomain=$this->insertTextObject($userDomain,$userCreatedObject->userId);                

                  // add admin
                  $this->insertRuleByValueFor("admin",$userNewDomain->textobjectId,$userCreatedObject->userId,$userCreatedObject->userId);           

                  return $userObj;  
              }


          /*
            special users
          */
          var $userAnonymous=null;
          var $userRegistrated=null;

              // get anonymous & friends
              function getUserAnonymous( ) // 'anonymous' & 'friend'
              {

                if ($this->userAnonymous==null)
                {
                    // get ... 
                    $arrSpecialUser=$this->getUsersByUserType( "anonymous" );
                    // not there?
                    if (count($arrSpecialUser)>0)
                    // if ($specialUser!=null)
                    {
                       $this->userAnonymous=$arrSpecialUser[0];
                       return $this->userAnonymous;
                    }

                    // create a anonymous user?
                    return $this->createUserAnonymous();


                    return null;
                }
                else
                {
                   return $this->userAnonymous;              
                }
              }

                function getUserAnonymousId( )
                {
                    $anonymousUser=$this->getUserAnonymous( );

                    if ($anonymousUser!=null) return $anonymousUser->userId;

                    return -1;
                }

              // get registrated user 
              function getUserRegistrated() // 'anonymous' & 'friend'
              {

                if ($this->userRegistrated==null)
                {
                    // get ... 
                    $arrSpecialUser=$this->getUsersByUserType( "registrated" );
                    // not there?
                    if (count($arrSpecialUser)>0)
                    // if ($specialUser!=null)
                    {
                       $this->userRegistrated=$arrSpecialUser[0];
                       return $this->userRegistrated;
                    }

                    // create a anonymous user?
                    return $this->createUserRegistrated();


                    return null;
                }
                else
                {
                   return $this->userRegistrated;              
                }
              }

                function getUserRegistratedId( )
                {
                    $registratedUser=$this->getUserRegistrated( );

                    if ($registratedUser!=null) return $registratedUser->userId;

                    return -1;
                }


              // *todo
              // getFriendsFor()

     	
      		function checkIn( $login, $password )
      		{
      			$userObject=$this->fundamentalGetUserByLoginAndPassword( $login, $password );
      			
      			if ($userObject!=null)
      			{
      				// $userObj=$arr[0];
      				// $this->session->userId=$userObj->userId;
      				
      				// logged in 
      				return $userObject; // $arr[0];
      			}
      			
      			return null;
      		}

            function checkInPasswordNew( $login, $password )
            {
// echo("checkInPasswordNew( $login, $password )");
                $arr=$this->fundamentalGetUserByLoginAndPasswordNew( $login, $password );
                
                if (count($arr)>0)
                {
                    $userObj=$arr[0];
                    $this->session->userId=$userObj->userId;
                    
                    // logged in 
                    return $arr[0];
                }
                
                return null;
            }

            function jobSetRandomPasswordNew( $userObj, $mainPassword=false )
            {
                $userObj->userPasswordNew="";

                $length = 5;

                // start with a blank password
                $password = "";

                // define possible characters - any character in this string can be
                // picked for use in the password, so if you want to put vowels back in
                // or add special characters such as exclamation marks, this is where
                // you should do it
                $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";

                // we refer to the length of $possible a few times, so let's grab it now
                $maxlength = strlen($possible);
              
                // check for length overflow and truncate if necessary
                if ($length > $maxlength) {
                  $length = $maxlength;
                }
                
                // set up a counter for how many characters are in the password so far
                $i = 0; 
                
                // add random characters to $password until $length is reached
                while ($i < $length) { 

                  // pick a random character from the possible ones
                  $char = substr($possible, mt_rand(0, $maxlength-1), 1);
                    
                  // have we already used this character in $password?
                  if (!strstr($password, $char)) { 
                    // no, so it's OK to add it onto the end of whatever we've already got...
                    $password .= $char;
                    // ... and increase the counter by one
                    $i++;
                  }

                }

                if (!$mainPassword) $userObj->userPasswordNew="".$password;
                if ($mainPassword) $userObj->userPassword="".$password;

                // update
                $this->updateUserPasswordNew($userObj);

                return $userObj->userPasswordNew;
            } 

                function updateUserPasswordNew($userObj)
                {
                    $sql=$userObj->updateRecord();
                    $sql="update User set userPasswordNew='".$userObj->userPasswordNew."' where userId=".$userObj->userId." ";
                    // echo(" updateUserPasswordNew() $sql ");            
                    mysql_query($sql, $this->dbconnect); 
                    // todo: error
                }


          function getUserById( $id )
          {
              return $this->fundamentalGetUserById($id);
          }

          function getUserByLogin( $login )
           {
              return $this->fundamentalGetUserByLogin($login);
           }

           // todo: secure!
           function getUsersByNameAndPrenameLike( $queryname, $userId )
           {
              return $this->fundamentalGetUsersByNameAndPrenameLike($queryname);
           }

           function getUsersByUserType( $userType )
           {
              return $this->fundamentalGetUsersByUserType($userType);
           }


           function checkUserInSystem( $login )
           {
              $userObj=$this->fundamentalGetUserByLogin($login);

              if ($userObj!=null) return true; 

              return false;
           }

           // updateUserPassword
          function updateUserPassword( $userObj )
           {
                $this->fundamentalUpdateUserPassword($userObj);
           }

      // -----------------------------
      //  user & access
      // -----------------------------

      /*

            RuleTypes [RuleAccessMatrix] (Applications)
            - admin
            - staff
            - friend
            - freerider

              Rules [DB]
              - textobjectRef - [ruleType] - userRef

      */


      /*
          RuleTypes
      */
      // like admin, staff, collobrator > matrxi: read / write etc.
      var $arrRuleTypes=array();
      var $friendIndex=-1;
      function initRuleTypes( )
      {
          // addRuleType( $ruleName, $flagAccessRead, $flagAccessChange, $flagAccessDelete, $flagAccessAddComments )
          $argObj=$this->addRuleType( "admin",          true, true, true, true, true );
          $argObj->label="Admins";
          $argObj->description="Can do everything.";

          // not yet implemented
          $argObj=$this->addRuleType( "staff",          false, false, false, false, true );
          $argObj->label="Staff";
          $argObj->description="Is able to add courses.";


          // $this->addRuleType( "owner",          true, true, true, true ); 
          $argObj=$this->addRuleType( "collaborator",   true, true, true, true, false );
          $argObj->label="Owner/Collaborators";
          $argObj->description="Can do everything you can do. Except: delete.";

          $argObj=$this->addRuleType( "friend",         true, false, false, true, false );
          $argObj->label="Friends";
          $argObj->description="Can read and insert comments.";


          $argObj=$this->addRuleType( "freerider",      true, false, false, false, false );
          $argObj->label="Freeriders";
          $argObj->description="Can read only read.";
          
      }

         function addRuleType( $ruleName, $flagAccessRead, $flagAccessChange, $flagAccessDelete, $flagAccessAddComments, $flagAccessAddCommentsExtended )
         {
            $newRuleAccessMatrixObj=new RuleAccessMatrix();
            // $newRuleAccessMatrixObj->flagAccessEditable=$flagAccessEditable;
            $newRuleAccessMatrixObj->ruleName=$ruleName;
            $newRuleAccessMatrixObj->flagAccessRead=$flagAccessRead;
            $newRuleAccessMatrixObj->flagAccessChange=$flagAccessChange;
            $newRuleAccessMatrixObj->flagAccessDelete=$flagAccessDelete;
            $newRuleAccessMatrixObj->flagAccessAddComments=$flagAccessAddComments;
            $newRuleAccessMatrixObj->flagAccessAddCommentsExtended=$flagAccessAddCommentsExtended;
            $this->arrRuleTypes[count($this->arrRuleTypes)]=$newRuleAccessMatrixObj;

            if ($newRuleAccessMatrixObj->ruleName=="friend") 
            {
                $this->friendIndex=count($this->arrRuleTypes); 
            }
            
            return $newRuleAccessMatrixObj;
         }

         function countRuleTypes()
         {
            return count($this->arrRuleTypes);
         }

         function getRuleTypeByIndex( $index )
         {
            if ($index<0) return $index=0;
            if ($index>count($this->arrRuleTypes)) $index=$this->arrRuleTypes-1;
            return $this->arrRuleTypes[$index];
         }

              // todo: change name to getRuleTypeFriendsIndex( )
             function getRuleFriendsIndex( )
             {
                return $this->friendIndex;
             }

         function getRuleTypeByName( $ruleTypeName )
         {
            // $str="app.debugRuleTypes( )";
            for ($n=0;$n<count($this->arrRuleTypes);$n++)
            {
                $ruleObj=$this->arrRuleTypes[$n];
                if ($ruleObj->ruleName==$ruleTypeName)
                {
                    return $ruleObj;
                }
            }

            return null; 
         }  

         function debugRuleTypes( )
         {
            $str="app.debugRuleTypes( )";
            for ($n=0;$n<count($this->arrRuleTypes);$n++)
            {
                $ruleTypeObj=$this->arrRuleTypes[$n];
                $str=$str."\n<br>$n ".$ruleTypeObj->debug();
            }
            return $str; 
         }  

          /*

              Rules

          */
          // get rules ...
          // userId

          // textobjectId - [ruleType] - userRef
          // 10 - "friend" - 30

          function insertRule( $ruleObject, $userId )
          {
             $ruleObject->ruleUserOwnerRef=$userId;
             return $this->fundamentalInsertRule($ruleObject);
          }

            function insertRuleByValueFor($ruleName,$textobjectId, $userRef, $userId)
            {
               return $this->insertRuleByValueForExt($ruleName,$textobjectId,"active", $userRef, $userId);
            }

                function insertRuleByValueForExt($ruleName,$textobjectId, $ruleStatus, $userRef, $userId, $ruleEmail="") // todo: not so cool - end param should be $userId!
                {
                    // todo: check if possible 

                    $ruleObject=new Rule();
                    $ruleObject->ruleUserRef=$userRef;
                    $ruleObject->ruleName="".$ruleName;
                      
                      // only status=="invitationweb"
                      $ruleObject->ruleTypeCaseInvitationsEmail="".$ruleEmail;

                    $ruleObject->ruleStatus="".$ruleStatus;
                    $ruleObject->ruleTextObjectRef=$textobjectId;
                    $this->insertRule( $ruleObject, $userId );

                    return $ruleObject;
                }

          function updateRule( $ruleObject, $userId )
          {
              $this->fundamentalUpdateRule($ruleObject);
          }

          // add guest / friends ...
          function insertDefaultRules( $textobjectBaseId, $userId )
          {
             $this->insertRuleByValueFor("freerider",$textobjectBaseId,$this->getUserAnonymousId( ),$this->getUserAnonymousId( ));
             $this->insertRuleByValueFor("friend",$textobjectBaseId,$this->getUserRegistratedId( ),$this->getUserRegistratedId( ));
             $this->insertRuleByValueFor("admin",$textobjectBaseId,$userId,$userId);
          }

          function getRuleById( $ruleId )
          {
              return $this->fundamentalGetRuleById( $ruleId );
          }

          // only rules that are here on this object!
          function getRulesByTextObjectId( $textobjectId, $userId )
          {
              // todo: can everyone get id
              return $this->fundamentalGetRulesByTextObjectId( $textobjectId );
          }

          function getRulesByTextObjectIdRuleNameAndUserIdAndGeneric( $textobjectId, $ruleName, $userId )
          {
              return $this->fundamentalGetRulesByTextObjectIdRuleNameAndUserIdAndGeneric($textobjectId, $ruleName, $userId);
          }

          // 
          function getRuleRequestsByTextObjectIdRuleName( $textobjectId, $ruleName, $userId )
          {
              return $this->fundamentalGetRuleRequestsByTextObjectIdRuleName( $textobjectId, $ruleName );
          }

          // 
          function getRuleInvitationsByTextObjectIdRuleName( $textobjectId, $ruleName, $userId )
          {
              return $this->fundamentalGetRuleInvitationsByTextObjectIdRuleName( $textobjectId, $ruleName );
          }
     
          // checkRules
          function checkRuleByTextObjectIdRuleNameUserId( $textobjectId, $ruleName, $userId )
          {
              $arr=$this->fundamentalGetRulesByTextObjectIdRuleNameUserId( $textobjectId, $ruleName, $userId );
              if (count($arr)>0) return true;
              return false;
          }



          function deleteRule( $ruleId, $userId )
          {
              return $this->fundamentalDeleteRule( $ruleId );
          }

      /*

        Rules & Access 
        RuleAccessMatrix & Rules
        // based on rules
      
      */

      /*
          // usage
          // 1. get matrix
          $ruleaccessmatrixObj=$app->getRuleAccessMatrixByTextObjectId( $textobjectId, $userId );

                  // 2.1 check for ...
                  if ($app->checkRuleMatrixFor($ruleaccessmatrixObj,"read")) echo("can read!!!"):

              // 2.2 or internal
              // (preferred!)
              $ruleaccessmatrixObj->isReadable();
              $ruleaccessmatrixObj->isWritable();
              $ruleaccessmatrixObj->isUpdatable();
              $ruleaccessmatrixObj->isDeletable();

              $ruleaccessmatrixObj->isCommentable();
              $ruleaccessmatrixObj->isCommentableExtended();

      */

      // 
      function checkRuleMatrixFor($ruleaccessmatrixObj,$accessType)
      {
          $foundCommand=false;

          if ($accessType=="read") return $ruleaccessmatrixObj->flagAccessRead;

          if ($accessType=="write") return $ruleaccessmatrixObj->flagAccessChange;
          if ($accessType=="update") return $ruleaccessmatrixObj->flagAccessChange;

          if ($accessType=="delete") return $ruleaccessmatrixObj->flagAccessDelete;

          if ($accessType=="comment") return $ruleaccessmatrixObj->flagAccessAddComments;

          if ($accessType=="commentextended") return $ruleaccessmatrixObj->flagAccessAddCommentsExtended;

          if (!$foundCommand) echo("<hr>App.checkRuleMatrixFor() { Errror: Could not find '$accessType'!</hr>");   

          return false;
      }

      function getRuleAccessMatrixByTextObjectId( $textobjectId, $userId )
      {
          $debugThis=false;

          $ruleaccessmatrixObj=new RuleAccessMatrix();

            // rules
            if ($debugThis) echo("<br><hr>1. getRuleAccessMatrixByTextObjectId( $textobjectId, $userId )<hr>");

            $arrRules=$this->getRulesMergedByTextObjectId( $textobjectId, $userId );
            
//            if ($debugThis) { echo("<pre>"); print_r($arrRules); echo("</pre>"); }
            if ($debugThis) { echo("<br><br>Rules: count: ".count($arrRules)); }

            for ($z=0;$z<count($arrRules);$z++)
            { 
                
                $ruleObj=$arrRules[$z];
                $ruleName=$ruleObj->ruleName;

                if ($debugThis) echo("<br>- $z [$ruleName] ");
 
                $ruleaccessmatrixAdd=$this->getRuleTypeByName( $ruleName );
                if ($debugThis) echo(" ".$ruleaccessmatrixAdd->debug());

                $ruleaccessmatrixObj=$this->mergeRuleAccessMatrices( $ruleaccessmatrixObj, $ruleaccessmatrixAdd );
            }

           if ($debugThis) { echo("<br><br><br>Merged Rules: ".$ruleaccessmatrixObj->debug()); }


          return $ruleaccessmatrixObj;
      }

                      // more power overwrites less power
                      function mergeRuleAccessMatrices( $ruleaccessmatrixA, $ruleaccessmatrixB )
                      {
                         $ruleaccesmatrixMerge=new RuleAccessMatrix();

                         if ($ruleaccessmatrixA->flagAccessRead==true) $ruleaccesmatrixMerge->flagAccessRead=true;
                         if ($ruleaccessmatrixB->flagAccessRead==true) $ruleaccesmatrixMerge->flagAccessRead=true;

                         if ($ruleaccessmatrixA->flagAccessChange==true) $ruleaccesmatrixMerge->flagAccessChange=true;
                         if ($ruleaccessmatrixB->flagAccessChange==true) $ruleaccesmatrixMerge->flagAccessChange=true;

                         if ($ruleaccessmatrixA->flagAccessDelete==true) $ruleaccesmatrixMerge->flagAccessDelete=true;
                         if ($ruleaccessmatrixB->flagAccessDelete==true) $ruleaccesmatrixMerge->flagAccessDelete=true;

                         if ($ruleaccessmatrixA->flagAccessAddComments==true) $ruleaccesmatrixMerge->flagAccessAddComments=true;
                         if ($ruleaccessmatrixB->flagAccessAddComments==true) $ruleaccesmatrixMerge->flagAccessAddComments=true;

                         if ($ruleaccessmatrixA->flagAccessAddCommentsExtended==true) $ruleaccesmatrixMerge->flagAccessAddCommentsExtended=true;
                         if ($ruleaccessmatrixB->flagAccessAddCommentsExtended==true) $ruleaccesmatrixMerge->flagAccessAddCommentsExtended=true;

                         return $ruleaccesmatrixMerge;
                      }


          function getRulesMergedByTextObjectId( $textobjectId, $userId )
          {

            $debugThis=false; 

    //        $arrRules=

            if ($debugThis) echo("<br>1.1 getRulesMergedByTextObjectId( $textobjectId, $userId )<br>");
            // version 1.0
            // $ruleaccessmatrixObj=$this->getRuleAccessMatrixForTextobjectAndUser( $textobjectId, $userId );
            // version 2.0
            // $str=$str.$this->checkTextobjectForAccess($textobjectId,"read",$userId);

            // version 3.0
            $str="";

            /*
              
              Rules get them 

            */

              // arr tree
              $arrTree=$this->getTreeUpForIdDirectExt( $textobjectId, $userId );
              $platformId=-1; $platformObj=$this->getPlatform( $userId );  if ($platformObj!=null) $platformId=$platformObj->textobjectId;
              // error here?
              $domainId=-1; $domainObject=null; $domainIndex=$this->getIndexDomain( $arrTree );  if ($domainIndex!=-1) { if (count($arrTree)>0) { $domainObject=$arrTree[0];  $domainId=$domainObject->textobjectId; } }          
              $hyperthreadId=-1; $hyperThreadObject=null; $hyperThreadIndex=$this->getIndexInTreeFirstHyperthreadOrDomain( $arrTree ); if ($hyperThreadIndex!=-1) { $hyperThreadObject=$arrTree[$hyperThreadIndex]; $hyperthreadId=$hyperThreadObject->textobjectId;  }

              if ($debugThis) echo("<br>platformId: $platformId ");
              if ($debugThis) echo("<br>domainId: $domainId ");
              if ($debugThis) echo("<br>hyperthreadId: $domainId ");
              if ($debugThis) echo("<br>textobjectId: $textobjectId");

              // collect all types here ...
              // you are in it or! it is generic!
              $arrCollectedRules=array();

              /* local */
              $hierarchy="textobject";

                // freerider
                $arrRule=$this->getRulesByTextObjectIdRuleNameAndUserIdAndGeneric( $textobjectId, "freerider", $userId );
                    // echo("<pre>"); print_r($arrRule);  echo("<pre>");
                    if (count($arrRule)>0) $arrCollectedRules=$this->mergeRuleArrayAdd($arrCollectedRules,$arrRule,$hierarchy,$userId);

                // friends
                $arrRule=$this->getRulesByTextObjectIdRuleNameAndUserIdAndGeneric( $textobjectId, "friend", $userId );
                    // echo("<pre>"); print_r($arrRule);  echo("<pre>");
                    if (count($arrRule)>0) $arrCollectedRules=$this->mergeRuleArrayAdd($arrCollectedRules,$arrRule,$hierarchy,$userId);

                // collaborators
                $arrRule=$this->getRulesByTextObjectIdRuleNameAndUserIdAndGeneric( $textobjectId, "collaborator", $userId );
                    // echo("<pre>"); print_r($arrRule);  echo("<pre>");
                    if (count($arrRule)>0) $arrCollectedRules=$this->mergeRuleArrayAdd($arrCollectedRules,$arrRule,$hierarchy,$userId);

              /* hyperthread */
              $hierarchy="hyperthread";

                // freerider
                $arrRule=$this->getRulesByTextObjectIdRuleNameAndUserIdAndGeneric( $hyperthreadId, "freerider", $userId );
                    // echo("<pre>"); print_r($arrRule);  echo("<pre>");
                    if (count($arrRule)>0) $arrCollectedRules=$this->mergeRuleArrayAdd($arrCollectedRules,$arrRule,$hierarchy,$userId);

                // friends
                $arrRule=$this->getRulesByTextObjectIdRuleNameAndUserIdAndGeneric( $hyperthreadId, "friend", $userId );
                    // echo("<pre>"); print_r($arrRule);  echo("<pre>");
                    if (count($arrRule)>0) $arrCollectedRules=$this->mergeRuleArrayAdd($arrCollectedRules,$arrRule,$hierarchy,$userId);

                // collaborators
                /*
                $arrRule=$this->getRulesByTextObjectIdRuleNameAndUserIdAndGeneric( $hyperthreadId, "collaborator", $userId );
                    // echo("<pre>"); print_r($arrRule);  echo("<pre>");
                    if (count($arrRule)>0) $arrCollectedRules=$this->mergeRuleArrayAdd($arrCollectedRules,$arrRule,$userId);
                */

                // admin
                $arrRule=$this->getRulesByTextObjectIdRuleNameAndUserIdAndGeneric( $hyperthreadId, "admin", $userId );
                    // echo("<pre>"); print_r($arrRule);  echo("<pre>");
                    if (count($arrRule)>0) $arrCollectedRules=$this->mergeRuleArrayAdd($arrCollectedRules,$arrRule,$hierarchy,$userId);

              /* domain */
              $hierarchy="domain";

                // staff
                $arrRule=$this->getRulesByTextObjectIdRuleNameAndUserIdAndGeneric( $domainId, "staff", $userId );
                    // echo("<pre>"); print_r($arrRule);  echo("<pre>");
                    if (count($arrRule)>0) $arrCollectedRules=$this->mergeRuleArrayAdd($arrCollectedRules,$arrRule,$hierarchy,$userId);

                // admin
                $arrRule=$this->getRulesByTextObjectIdRuleNameAndUserIdAndGeneric( $domainId, "admin", $userId );
                    // echo("<pre>"); print_r($arrRule);  echo("<pre>");
                    if (count($arrRule)>0) $arrCollectedRules=$this->mergeRuleArrayAdd($arrCollectedRules,$arrRule,$hierarchy,$userId);

              /* platform */
              $hierarchy="platform";

                // staff
                $arrRule=$this->getRulesByTextObjectIdRuleNameAndUserIdAndGeneric( $platformId, "staff", $userId );
                    // echo("<pre>"); print_r($arrRule);  echo("<pre>");
                    if (count($arrRule)>0) $arrCollectedRules=$this->mergeRuleArrayAdd($arrCollectedRules,$arrRule,$hierarchy,$userId);

                // admin
                $arrRule=$this->getRulesByTextObjectIdRuleNameAndUserIdAndGeneric( $platformId, "admin", $userId );
                    // echo("<pre>"); print_r($arrRule);  echo("<pre>");
                    if (count($arrRule)>0) $arrCollectedRules=$this->mergeRuleArrayAdd($arrCollectedRules,$arrRule,$hierarchy,$userId);

              /*
                  
                  Analyse the collected Rules

              */
              // the collected rules ... 
              $ruleObj=null;
              $debugStr="";

              $arrCorrectRules=array();

              for ($i=0;$i<count($arrCollectedRules);$i++)
              {
                  $ruleObj=$arrCollectedRules[$i];

                  // simple debug
                  if ($debugThis) echo("<br>- $i (".$ruleObj->ruleHierarchy.") [".$ruleObj->ruleName."] ".$ruleObj->ruleGeneric);          

                  // go through and check it ...
                  if ($ruleObj->ruleGeneric==1) 
                  {

                    if ($debugThis)
                    {
                        $userObj=$this->getUserById($ruleObj->ruleUserRef);
                        $userName=$userObj->userName;
                        if ($debugThis) echo("<br> userName: ".$userName);
                    }

                      // check this generic rule
                      if ($debugThis) echo("<br>--- checkGenericRule:  ");
                      
                      $flag=$this->checkRuleGeneric($ruleObj, $platformId,$domainId,$hyperthreadId,$textobjectId, $userId); 

                      if ($debugThis) echo(" flag: ".$flag);
                      if ($flag)
                      {
                          // todo: optimize adding!
                          // todo: rule done?
                          $arrCorrectRules[count($arrCorrectRules)]=$ruleObj;
                          if ($debugThis) echo("<br>---- Add!");
                      }
                  }
                  else
                  {
                      if ($debugThis) echo("<br> userName: correct user");


                      // todo: optimize adding!
                      // todo: rule done?
                      if ($debugThis) echo("<br>---- Add!");
                      $arrCorrectRules[count($arrCorrectRules)]=$ruleObj;
                  }


              }   
  

             return $arrCorrectRules;
          }   

                  function checkRuleGeneric($ruleObj, $platformId,$domainId,$hyperthreadId,$textobjectId,  $userId)
                  {
                      $userObj=$this->getUserById($userId);
                      // echo("<br>checkRuleGeneric( (ruleObj: ".$ruleObj->ruleName."/".$ruleObj->ruleUserRef.") - $platformId,$domainId,$hyperthreadId,$textobjectId -  [$userId] ) ".$userObj->userName);

                      // rule: anonymous
                      if ($ruleObj->ruleUserRef==$this->getUserAnonymousId()) 
                      {
                          if ($userId==$this->getUserAnonymousId()) return true;
                              // registrated users are also anonymous users!
                             if ($userId!=$this->getUserAnonymousId())  return true;
                      }

                      // rule: registrated
                      if ($ruleObj->ruleUserRef==$this->getUserRegistratedId()) 
                      {
                          if ($userId!=$this->getUserAnonymousId())  return true;
                      }

                      return false;
                  }

              // merge rule array add
              function mergeRuleArrayAdd($arrCollectedRules,$arrRule,$hierarchy,$userId)
              {
                  // todo: optimise this > never add the same rule again! ident. (ruleName & generci)  > all rulestypes done > everything done
                  // todo: problem - same generic but not same textobjectId - ruleObj
                  $optimize=true;

                  for ($i=0;$i<count($arrRule);$i++)
                  {
                      $ruleObj=$arrRule[$i];
                      $ruleObj->ruleHierarchy=$hierarchy;

                      $addThisRuleObject=true;

                      // is this in the database?
                      if ($optimize)
                      {
                          $foundObject=false;
                          for ($t=0;$t<count($arrCollectedRules);$t++)
                          {
                              $ruleTestObj=$arrCollectedRules[$t];
                              if ($ruleObj->ruleName==$ruleTestObj->ruleName)
                              {
                                if ($ruleObj->ruleGeneric==$ruleTestObj->ruleGeneric)
                                { 
                                  // special generic things
                                  // todo: domainregistrated - textobjectId
                                  // todo: hyperthreadregistrated - textobjectId

                                  // if ($ruleObj->ruleUserRef==$ruleTestObj->ruleUserRef)
                                  // { 
                                      $foundObject=true;
                                      break;
                                  // }

                                }

                              }

                          } 

                          if ($foundObject) { $addThisRuleObject=false; }
                      }
                                       
                      // check this ...
                      if ($addThisRuleObject) $arrCollectedRules[count($arrCollectedRules)]=$ruleObj;
                      // echo("-".count($arrCollectedRules));
                  }

                  return $arrCollectedRules;
              }


     	// -----------------------------
		// input
     	// -----------------------------
     	function requestFromWebIsset( $inputName )
     	{
     		global $_REQUEST;

     		if (isset($_REQUEST[$inputName]))
     		{
     			return true;
     		}

     		return false;
     	}
     	
     	function requestFromWeb( $inputName, $inputType )
     	{
         $notthere="";

         if ($inputType=="int") $notthere="-1";
         if ($inputType=="string") $notthere="";

     		 return $this->requestFromWebExt( $inputName, $inputType, $notthere );
     	}

       // not used?
        function requestFromWebExt( $inputName, $inputType, $notthere )
        {
           // echo("alert('requestFromWebExt( ".$inputName.", ".$inputType.", $notthere )');");

            // check for
            if (isset($_REQUEST[$inputName]))
            {
                $strInput="".$_REQUEST[$inputName];

                // echo("alert('requestFromWebExt( ".$inputName.", ".$inputType.", $notthere )'+'".$strInput."');");

                // case: id
                if ($inputType=="int") 
                {  
                   // check for bigint
                   if (is_numeric($strInput)) return $strInput;
                   else return -1;
                }
            
                // todo: secure
                return $strInput;
            }
            
            return $notthere;
        }


        /*
            Views for TextObjects

        */
        function getTextObjectViewFor( $argObj, $userId )
        {
            return  $this->fundamentalGetTextObjectViewFor( $argObj );
        }
	
		/*
			TextObject
		*/
		function insertTextObject($argObj,$userId) 
		{

          // echo("<pre>");print_r($argObj);echo("</pre>");

            // versioning
            $argObj->textobjectVersionUserRef=$userId;
            $argObj->textobjectVersionType="insert";


            // check parent object
            // todo: update comments!
            if ($argObj->textobjectRef!=-1)
            {
                $textobjectParentObject=$this->getTextObjectById($argObj->textobjectRef,$userId);
                if ($textobjectParentObject!=null)
                {
                    $this->updateTextObjectUpdateComments($textobjectParentObject->textobjectId,$userId);
                }
                // -1
            }
            else
            {
                // add something to the top
                // error 
            }

            // events
            // onInsert
            $argObj->onInsert($this,$userId);
            
            // todo: check assurances/rights		
			     // insert here ..
           // echo("<pre>");print_r($argObj);echo("</pre>");
           $this->fundamentalInsertTextObject($argObj) ;

            // todo: do it correctly with table etc ... 
            $newTextObjectId = mysql_insert_id();
            $newTextObject=$this->getTextObjectById($newTextObjectId,$userId);

            // add this rule
            if ($userId!=-1) $this->insertRuleByValueFor("collaborator",$newTextObject->textobjectId,$userId,$userId);

            // special objects 
            // domain
            // hyperthread
            // add default rules
            $insertDefaultRules=false;
            if ($newTextObject->textobjectType=="domain") $insertDefaultRules=true;
            if ($newTextObject->textobjectType=="hyperthread") $insertDefaultRules=true;
            if ($insertDefaultRules)  $this->insertDefaultRules( $newTextObject->textobjectId, $userId );
            
            // not yet perfect ... is there really everything copied?
            $argObj->updateTo($newTextObject);

            // complex
            // there are members create them ... 
            if ($argObj->hasMembers())
            {
                // add the ...
                // insert them now
                for ($m=0;$m<count($argObj->arrMembers);$m++)
                {
                    // get them and insert them here!
                    $memberDef=$argObj->arrMembers[$m];

                    // insert this here
                    if ($memberDef->textobjectObject!=null)
                    {
                        // is there an object to update? manual?
                        if ($memberDef->memberDefaultObject!=null)
                        {
                            $memberDef->textobjectObject->updateTo($memberDef->memberDefaultObject); 
                            // echo("<br>-- not null memberdefaultobject! update");
                        }

                        // memberdefs .. 
                        $memberDef->textobjectObject->textobjectRef=$newTextObject->textobjectId;
                        $memberDef->textobjectObject->textobjectRefName=$memberDef->memberRefName;
                        $memberDef->textobjectObject->setArgument($memberDef->memberDefaultArgument);
                        $this->insertTextObject($memberDef->textobjectObject,$userId);

                        // todo: add ownership here!!! ?
                        // don't think so ... everything ...


                        // echo("<br>-- not null memberdefaultobject! update: argument:".$memberDef->memberDefaultArgument);
                    }

                }

            }

            // add textobjectversion
            $this->insertTextObjectVersion($newTextObject->textobjectId,"insert",$userId);
            
            return $newTextObject;
		}

// get all not visual comments
    function getAllCommentsByRef( $refId, $userId )
    {
        // todo: check user access
        return $this->fundamentalGetAllCommentsByRef( $refId );
    }


    // get all not visual comments
    function getAllCommentsCommentTypeEmptyByRef( $refId, $userId )
    {
        // todo: check user access
        return $this->fundamentalGetAllCommentsCommentTypeEmptyByRef( $refId );
    }

    function getAllCommentsCommentTypeVisualByRef( $refId, $userId )
    {
        return $this->fundamentalGetAllCommentsCommentTypeVisualByRef( $refId );
    }

    function getAllCommentsTimedByRef( $refId, $userId )
    {
        return $this->fundamentalGetAllCommentsTimedByRef( $refId );
    }


    /*
        get/show content
    */
    // generate output here ... 
    // 
    /*
    function viewDomainDetailSelectContent( $showId, $userId )
    {
        $str="";

        // $str=$str."-----$showId";

          $threadObj=$this->getTextObjectById( $showId, $userId );
          if ($threadObj!=null)
          {
                $arr=$this->getTreeUpForIdExt( $threadObj, $userId, true );
                //print_r($arr);
                for ($a=0;$a<count($arr);$a++)
                {
                    $treeObj=$arr[$a];
                    $str=$str."<br>".$a." ".$treeObj->getArgument();
                }
          }
          else
          {
              // $str=$str."@contentErrorThreadNotFound";
              $str=$str.$this->getLanguageBy( $this->getDomainLanguage($userId), "@contentErrorThreadNotFound" );
          }

        return $str;
    }
    */

    // 1. domain

    // domain
    function getDomainById( $showId, $userId )
    {
        $str="";

        // $str=$str."-----$showId";

          $threadObj=$this->getTextObjectById( $showId, $userId );
          if ($threadObj!=null)
          {
                $arr=$this->getTreeUpForIdExt( $threadObj, $userId, true );
                //print_r($arr);
                /*
                for ($a=0;$a<count($arr);$a++)
                {
                    $treeObj=$arr[$a];
                    $str=$str."<br>".$a." ".$treeObj->getArgument();
                }
                */
                return $arr[0];
          }
          else
          {
              // $str=$str."@contentErrorThreadNotFound";
//              $str=$str.$this->getLanguageBy( $this->getDomainLanguage($userId), "@contentErrorThreadNotFound" );
              return null;
          }
    }

    /*
    // get all visual and text-intern comments
    function getAllCommentsVisualMarkerByRef( $refId, $userId )
    {
        // todo: check user access
        return $this->fundamentalGetAllCommentsVisualMarkerByRef( $refId );
    }
    */

		
		function updateTextObject($argObj,$userId) 
		{ 		
        // versioning
        $argObj->textobjectVersionUserRef=$userId;
        $argObj->textobjectVersionType="update";

				// onUpdate
				$argObj->onUpdate($this,$userId);

		    $this->fundamentalUpdateTextObject($argObj); 	

        // complex
        // update if there is more
        // todo: update  members > update update-date in textobject!

        // add textobjectversion
        $this->insertTextObjectVersion($argObj->textobjectId,"update",$userId);
		} 

        // only update last comment update
        function updateTextObjectUpdateComments($textobjectId,$userId)
        {
            $this->fundamentalUpdateTextObjectUpdateComments( $textobjectId );
        }


      // more raw ...

     	function getAllTextObjectsByRef( $refId,$userId )
     	{
  			return $this->fundamentalGetAllTextObjectsByRef( $refId );
     	} 
  
        function countAllTextObjectsByRef( $refId,$userId )
        {
            return $this->fundamentalCountAllTextObjectsByRef( $refId );
        } 
    
        function getAllTextObjectsByRefAndType( $refId, $itype, $itypeSub, $userId )
        {
            return $this->fundamentalGetAllTextObjectsByRefAndType( $refId, $itype, $itypeSub, $userId );
        } 
   
        function getAllTextObjectsByRefAndTypes( $refId, $arrTypes, $userId )
        {
            return $this->fundamentalGetAllTextObjectsByRefAndTypes( $refId, $arrTypes, $userId );
        }    

        // returns the object in correct class (castet)
        // and adds all attributes!*
        function getTextObjectById( $id,$userId ) 
        {
            // 1. get from database
            $objInDatabase=$this->fundamentalGetTextObjectById( $id );
            if ($objInDatabase!=null)
            {
                return $objInDatabase;

                /*


                // needless - is done direct

                  // 2. get correct casted object
                  //print_r($objInDatabase);
                  $castObject=$this->getTextObjectCastFor( $objInDatabase );
                  //echo("<hr>");
                  //print_r($castObject);
                  if ($castObject!=null)
                  {
                      return  $castObject;
                  }
                  else
                  {
                      echo("ERROR CAST FOR [".$objInDatabase->textobjectType."/".$objInDatabase->textobjectTypeSub."] NOT FOUND!");
                  }
                */

            }

            return null;
        }
    
            // this returns database representation.
            function getTextObjectInDatabaseById( $id,$userId ) 
            {
                return $this->fundamentalGetTextObjectById( $id );
            }

        // get
        function getTextObjectByUserRef( $refId, $userId )
        {    
          return $this->fundamentalGetAllCommentsByUserRef( $refId );
        }
        // deleteTextObject
        // recursively!
        function deleteTextObject($textobjectId,$userId) 
        {
            // todo: check useraccess here!
            $deleteTextobject=$this->getTextObjectById($textobjectId,$userId);

            // get children here ... 
            // deactivate them now ...
            if ($deleteTextobject!=null)
            {
                // get it here ...
                $arrChildren=$this->getAllTextObjectsByRef( $textobjectId,$userId );
                if (count($arrChildren)>0)
                for ($i=0;$i<count($arrChildren);$i++)
                {
                    $childToDelete=$arrChildren[$i];
                    $this->deleteTextObject($childToDelete->textobjectId,$userId);
                }

                // delete it here ...
                $deleteTextobject->textobjectStatus="deleted";
                $this->fundamentalUpdateTextObject($deleteTextobject); 

                // get parent and update comments
                // todo: update comments!
                $this->updateTextObjectUpdateComments($deleteTextobject->textobjectId,$userId);
            }

        }

        /*
          Version
        */
        function insertTextObjectVersion( $textobjectId , $commentType, $userId )
        {
            // update here and now ...
            $this->fundamentalInsertTextObjectVersion($textobjectId,$commentType, $userId);
        }

        function countTextObjectVersions( $textobjectId )
        {
           return $this->fundamentalCountTheseTextObjectVersions($textobjectId);
        }

       // getLatestTextObjectVersions desc
        function getTextObjectVersions( $textobjectId, $userId )
        {
            return $this->fundamentalTextObjectVersions($textobjectId);
        }

        // getLatestTextObject
        function getLatestTextObjectVersion( $textobjectId, $userId )
        {
            return $this->fundamentalGetLatestTextObjectVersion($textobjectId);
        }

        /*
          Tree
        */
        function getRootObject( $startObject, $userId  )
        {
            $arr=$this->getTreeUpForId( $startObject, $userId );
            
            if (count($arr)>0) return $arr[count($arr)-1];

            return null;
        }


            // get index in tree ... 
            function getIndexInTreeFirstHyperThread( $arrTopDown )
            {
                // get last hyperthread 
                for ($i=count($arrTopDown)-1;$i>=0;$i--)
                { 
                  $obj=$arrTopDown[$i];
                  if 
                    (
                      ($obj->textobjectType=="hyperthread")
 /*                     ||
                      ($obj->textobjectType=="domain")
 */                   )                      
                  {
                    //if ($obj->textobjectTypeSub=="hyper")
                    //{
                        return $i;
                    //}

                  }
                }

                return -1;
            }

            
            function getIndexInTreeFirstHyperthreadOrDomain( $arrTopDown )
            {
                // get last hyperthread 
                for ($i=count($arrTopDown)-1;$i>=0;$i--)
                { 
                  $obj=$arrTopDown[$i];
                  if 
                    (
                      ($obj->textobjectType=="hyperthread")
                      ||
                      ($obj->textobjectType=="domain")
                   )                      
                  {
                    //if ($obj->textobjectTypeSub=="hyper")
                    //{
                        return $i;
                    //}

                  }
                }

                return -1;
            }
        
           
            // member has refName!=""
            function getIndexMemberBaseObject( $arrTopDown )
            {
                // get last hyperthread 
                for ($i=count($arrTopDown)-1;$i>=0;$i--)
                { 
                  $obj=$arrTopDown[$i];
                  if ($obj->textobjectRefName=="")
                  {
                      if ($i==(count($arrTopDown)-1))
                      {
                          return -1;
                      }

                      return $i;
                  }
                }

                return -1;
            }
        

            // get index in tree ... 
            function getIndexDomain( $arrTopDown )
            {
                if (count($arrTopDown)>0)
                {
                  return 0;
                }
      
                return null;
            }


              // get array part
              function getArrayPart($arrMain, $startIndex, $indexStop=-1 )
              {
                  $arr=Array(); 

                  if ($indexStop==-1) { $indexStop=count($arrMain)-1; }

                  for ($z=$startIndex;$z<=$indexStop;$z++) 
                  {
                    if ($z>=0)
                    {
                      //if ($z<count($arrMain))
                      //{
                           $arr[count($arr)]=$arrMain[$z]; 
                      //}
                      
                    }
                  }

                  return $arr;
              }


          // get tree up
          function getTreeUpForId( $startObject, $userId)
          {
              return $this->getTreeUpForIdExt( $startObject, $userId, false);
          }

              // only id ... 
              function getTreeUpForIdDirectExt( $starobjectId, $userId )
              {
                  $threadObj=$this->getTextObjectById($starobjectId, $userId);
                  if ($threadObj!=null)
                  {
                      return $this->getTreeUpForIdExt( $threadObj, $userId, true);
                  }

                  return Array();
              }


          function getTreeUpForIdExt( $startObject, $userId, $flagReverse)
          {

            // TREE
            // count deepnes
            $depth=0;
            $arrTreeLine=Array();

            $nextThreadObjectUp=$startObject;
            $breakPointCounter=0;
            do
            {
              // $strLine=$this->viewTreeLineUp( $nextThreadObjectUp->textobjectId, $nextThreadObjectUp->textobjectRef, $depth, $app, $userId );
              $arrTreeLine[count($arrTreeLine)]=$nextThreadObjectUp;
              // echo($str);
              $depth++;
              // todo - speed up
              $nextThreadObjectUp=$this->getTextObjectById($nextThreadObjectUp->textobjectRef, $this, $userId);
              
                // break it?
                $breakPointCounter++;
                if ($breakPointCounter>100) 
                {
                  echo("<div>tree up too long!!!!!</div>"); 
                  break;
                }
            }
            while ($nextThreadObjectUp!=null);


            if ($flagReverse)
            {
                $arrReverse=Array();

                for ($z=0;$z<count($arrTreeLine);$z++)
                {
                    $objRev=$arrTreeLine[count($arrTreeLine)-1-$z];
                    $arrReverse[count($arrReverse)]=$objRev;
                }

                return $arrReverse;
            }

            return $arrTreeLine;
          }

          /*

              siblings ...

          */

          // ------- get siblings -------------
          // 
          function getDomainSiblingsByParentId( $textobjectId, $userId )
          {
              $arr=$this->getTextObjectThreadSiblingsByParentId( $textobjectId, $userId );
              $arrDomains=array();

              for ($t=0;$t<count($arr);$t++)
              {
                  $objTmp=$arr[$t];
                  if ($objTmp->textobjectUserRef==-1) $arrDomains[count($arrDomains)]=$objTmp;
              }

              return  $arrDomains;
          }

          // ------- get siblings -------------
          // 
          //      textobjectParent
          //       (Ref)|      |(Ref)
          //  textobjectId      textobjectB    etc. 
          function getTextObjectThreadSiblingsByParentId( $textobjectId, $userId )
          {
              $textobjectSibling=$this->getTextObjectById($textobjectId, $userId);

              if ($textobjectSibling!=null)
              {
                 $arrTypes=array();
                   $arrTypes[0]="Thread";
                   $arrTypes[1]="Hyperthread";
                   $arrTypes[2]="Domain";
                 $arr=$this->getAllTextObjectsByRefAndTypes( $textobjectSibling->textobjectRef, $arrTypes , $userId );
                return $arr;
              }

              return array();
          }

          // get children
          function getTextObjectChildrenById( $textobjectId, $userId )
          {
              //$textobjectObj=$this->getTextObjectById($textobjectId, $userId);
              //if ($textobjectObj!=null)
              //{
                 $arrTypes=array();
                   $arrTypes[0]="Thread";
                   $arrTypes[1]="Hyperthread";
                   $arrTypes[2]="Domain";
                 $arr=$this->getAllTextObjectsByRefAndTypes( $textobjectId, $arrTypes , $userId );
                return $arr;
              //}

              //return array();
          }

      /*
          languages
      */
      // todo: get user language ... by userId ... 
          /*
          function getUserLanguage($userId)
          {
            return "en";
          }
          */
          function getDomainLanguage($threadId)
          {
            return "en";
          }


      // @ > translated
      function getLanguageBy( $language, $keyOrText )
      {
          $str="";

          $displayDirect=true;

          if (strlen($str>0))
          {
             if (substr($str,1)=="@")
             {
                $displayDirect=false;
             }
          }

          // direct here ...
          if ($displayDirect) return $keyOrText;

          // search for key ...
          // @xyz
          if (!$displayDirect)
          {

              // not found?
              // > give back $keyOrText
              return "[$keyOrText]";
          }

          return $str;
      }

      // emails
      function sendEmailWithTitleText($arrAddress,$title,$text)
      {
        $debugThisFunction=false;

              // convert to html ...
              // $text=htmlspecialchars($text);

        $done=true;

        $mail= new PHPMailer(); // defaults to using php "mail()"

              // use smtp
              if ($this->emailUseEmailServer)
              {
                  /*
                              var $emailHost="lmailer.fhnw.ch"; // *
          var $emailLogin=""; // *
          var $emailPassword="";  
                  */
                  $mail->IsSMTP(); // telling the class to use SMTP
                  $mail->Host       = $this->emailHost; // SMTP server
                  // $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                  // 1 = errors and messages
                  // 2 = messages only
                  $mail->SMTPAuth   = false;                  // enable SMTP authentication
                  // $mail->Host       = $this->emailHost; // sets the SMTP server
                  // $mail->Port       = 26;                    // set the SMTP port for the GMAIL server
                  // $mail->Username   = "yourname@yourdomain"; // SMTP account username
                  // $mail->Password   = "yourpassword";  
              }

        for ($i=0;$i<count($arrAddress);$i++)
        {
          $emailadress=$arrAddress[$i];
          $mail->AddAddress($emailadress, "");

                  // only first ...
                  break;
        }

        $mail->AddReplyTo($this->emailSystem,"");
        $mail->SetFrom($this->emailSystem, '');
                
        // $mail->AddAddress($address, "John Doe");
        $mail->Subject = "".$title;
        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
        $mail->MsgHTML($text);
        // $mail->AddAttachment("images/phpmailer.gif");      // attachment
        // $mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

        if(!$mail->Send()) {
          // echo "Mailer Error: " . $mail->ErrorInfo;
          $done=false;
        } else {
          // echo "Message sent!";
          $done=true;
        }


        return $done;
      }

      // infos
      function getPlatformBaseURL()
      {
          $serverPath=dirname($_SERVER["PHP_SELF"]);
          $url="http://".$_SERVER["HTTP_HOST"].$serverPath;
          return $url;
      }

      // base
      //var $pathFileBasePath="";
      function getApplicationBaseFilePath()      
      {
          // echo($_SERVER['SCRIPT_FILENAME']);
          return dirname($_SERVER['SCRIPT_FILENAME'])."/";
      }

      // logs
      function log($action,$argument,$userId)
      { 
          $logObject=new Log();
          $logObject->logAction=$action;
          $logObject->logUrl=$_SERVER["QUERY_STRING"];
          $logObject->logArgument=$argument;
          // echo("<br> ARGUMENT: ". $argument ."<br>");
          $this->fundamentalInsertLogObject($logObject,$userId);
 	    }

// -------------------------------------------------------------------------------------------------------------------------------------------------
// native methodes
// don't use them directly!
// -------------------------------------------------------------------------------------------------------------------------------------------------

// todo: change all users into fundamental
     	
     	// -----------------------------
		// users
     	// -----------------------------
     	private function fundamentalInsertUser($userObj)
     	{
     		$sql=$userObj->insertRecord();
     		// echo($sql);
        $sql=mb_convert_encoding($sql, "UTF-8", "ISO-8859-1");
     		// error
        mysql_query($sql, $this->dbconnect); 

            // version 1
            /*
     		$userObjInput=$this->getLatestUser( $userObj );        
     		if ($userObjInput!=null)
     		{
     			$userObj->userId=$userObjInput->userId;
     		}
            else
            {
                echo("<br><p style='color:red'>error: could not find user ".$userObj->userName."/".$userObj->userPreName."</p>");
                
            }
            */

            // version 2
            //$id=mysql_insert_id();
            //$userObj=$this->getUserById( $id );      

            // version 3
            $userObjInput=$this->fundamentalGetLatestUser( $userObj );        
            if ($userObjInput!=null)
            {
                $userObj->userId=$userObjInput->userId;
            }
            else
            {

                $id=mysql_insert_id();
                $userObj=$this->getUserById( $id );  
            }

     		return $userObj;
     	}

	     	private function fundamentalGetLatestUser( $userObj )
	     	{
	     		// get this   
	     		$sql=" where userLogin='".$userObj->userLogin."' ";
	     		// echo("getLatestUser().$sql");
	     		$arr = $this->fundamentalGetTheseUsers($sql, " order by userId desc limit 0,1");
	     		if (count($arr)>0)
	     		 return $arr[0];
	     		return null;
	     	}

        /*
     	function insertUserAndExcerciseUser($userObj, $excerciseId)
     	{
     		$iObj=$this->insertUser($userObj);

     		$excerciseuserObj=new ExcerciseUser();
     		$excerciseuserObj->excerciseuserUserRef=$iObj->userId;
     		$excerciseuserObj->excerciseuserExcerciseRef=$excerciseId;
     		$this->insertExcerciseUser($excerciseuserObj);

            return $iObj;
     	}

        // reset excercise 
        function resetExcerciseUser( $userId, $excerciseId )
        {
            $arrTasks=$this->getAllActiveExcerciseTasksFromExcercise( $excerciseId );
            for ($aa=0;$aa<count($arrTasks);$aa++)
            {
                $taskObj=$arrTasks[$aa];
                // echo("<br>  ".$taskObj->excercisetaskId."  ".$userId);
                // $val=$app->getUserExcerciseTaskAttributeString( $userId, $taskObj->excercisetaskId, "task", "" );
                // echo($val);                  
                // echo("<br>- ".$taskObj->excercisetaskName.":".$val." > reset");
                $this->setUserExcerciseTaskAttributeString( $userId, $taskObj->excercisetaskId, "task", "" );

                // $val=$app->getUserExcerciseTaskAttributeString( $userId, $taskObj->excercisetaskId, "task", "" );
            }
        }
*/
     	private function fundamentalUpdateUser($userObj)
     	{
     		$sql=$userObj->updateRecord();
     		mysql_query($sql, $this->dbconnect); 
     		// todo: error
     	}

     	private function fundamentalUpdateUserPassword($userObj)
     	{
     		$sql=$userObj->updateRecord();
     		$sql="update User set userPassword='".$userObj->userPassword."' where userId=".$userObj->userId." ";
     		mysql_query($sql, $this->dbconnect); 
     		// todo: error
     	}

        private function fundamentalUpdateUserPasswordNew($userObj)
        {
            $sql=$userObj->updateRecord();
            $sql="update User set userPasswordNew='".$userObj->userPasswordNew."' where userId=".$userObj->userId." ";
// echo(" updateUserPasswordNew() $sql ");            
            mysql_query($sql, $this->dbconnect); 
            // todo: error
        }

     	private function fundamentalGetUserByLoginAndPassword( $login, $password )
     	{
            $login=Converter::escapeSql($login);
            $password=Converter::escapeSql($password);

     		// get this 
     		$arr = $this->fundamentalGetTheseUsers(" where userStatus='active' and userLogin='$login' and userPassword='$password' ", "");
     		
        if (count($arr)>0) return $arr[0];

        return null;
     	}

        private function fundamentalGetUserByLoginAndPasswordNew( $login, $password )
        {
            $login=Converter::escapeSql($login);
            $password=Converter::escapeSql($password);

            // get this 
            $sql=" where userLogin='$login' and userPasswordNew='$password' ";
            $arr = $this->fundamentalGetTheseUsers($sql, "");
            return $arr;
        }


        private function fundamentalGetUserByLogin( $login )
        {
            $login=Converter::escapeSql($login);

            $checkSQL=" where userLogin='$login'  ";
            // get this 
            $arr = $this->fundamentalGetTheseUsers($checkSQL, "");
//            print_r($arr);
           if (count($arr)>0) return $arr[0];

            return null;        
        }
     	
     	private function fundamentalGetUserById( $id )
     	{
            $id=Converter::escapeSql($id);

     		// get this 
     		$arr = $this->fundamentalGetTheseUsers(" where userId='$id' ", "");
     		if (count($arr)>0)
     		 return $arr[0];

     		return null;
     	}

      private function fundamentalGetUsersByNameAndPrenameLike( $queryname )
      { 
          // todo: space to % !
          // or use against!
          return $this->fundamentalGetTheseUsers(" where concat(userLogin,' ',userName,' ', userPreName) like '%".Converter::escapeSql($queryname)."%'  "," order by userName "); 
      }
     	
      
      private function fundamentalGetUsersByUserType( $userType )
      { 
          // todo: space to % !
          // or use against!
          return $this->fundamentalGetTheseUsers(" where userType = '".Converter::escapeSql($userType)."'  "," order by userName "); 
      }
      

     		private function fundamentalGetTheseUsers($where,$orderby)
			{
				$sqlSelect="SELECT  * from User ".$where." ".$orderby." ";
	
				// $sqlSelect=utf8_encode($sqlSelect);
				$sqlSelect=mb_convert_encoding($sqlSelect, "ISO-8859-1", "UTF-8");
				// echo($sqlSelect);
	
				// echo("getThisArticles() : ".$sqlSelect."--");
				
				$arrayResult=array();
				
				$result = mysql_query($sqlSelect, $this->dbconnect); // $this->getDatabaseConnection()); 
				if ($result)
				{
					$number= mysql_num_rows($result);
					for ($i=0;$i<$number;$i++)
					{
						$objToUpdate=new User();
									 $objToUpdate->updateToRecord($result,$i);
						$arrayResult[count($arrayResult)]=$objToUpdate;
						// print_r($ArticleObj);				
					}
				}
				else
				{
					echo("App() error in $sqlSelect");
					//$obj=$this->addApplicationRapport($sqlSelect);
					//$obj->applicationRapportType="error";
				}
	
				return $arrayResult;			
			}


		private function fundamentalDeleteUser($userObj)
     	{
     		$sql=$userObj->deleteRecord();
     		mysql_query($sql, $this->dbconnect); 
     		// todo: error
     	}

              /*
                  
                  Rule

              */
                    private function fundamentalInsertRule($ruleObj)
                    {

                      // get textobject and check for userGeneric
                      // todo: for performance
                      if ($ruleObj->ruleUserRef!=-1)
                      {
                          // ok add here ...
                          $userObject=$this->fundamentalGetUserById($ruleObj->ruleUserRef);
                          if ($userObject!=null)
                          {
                              // cool do it
                              $ruleObj->ruleGeneric=$userObject->userGeneric;
                          }
                      }

                      $sql=$ruleObj->insertRecord();
                      // echo($sql);
                      $sql=mb_convert_encoding($sql, "UTF-8", "ISO-8859-1");

                      // echo("<br>fundamentalInsertRule: $sql");
                      // error
                      mysql_query($sql, $this->dbconnect); 

                          // version 3
                          $ruleObjInput=$this->fundamentalGetLatestRule( $ruleObj );        
                          if ($ruleObjInput!=null)
                          {
                              $ruleObj->ruleId=$ruleObjInput->ruleId;
                          }
                          else
                          {

                              $id=mysql_insert_id();
                              $ruleObj=$this->getRuleById( $id );  
                          }

                      return $ruleObj;
                    }

                      private function fundamentalGetLatestRule( $ruleObj )
                      {
                        // get this   
                        $sql=" where ruleUserRef='".$ruleObj->ruleUserRef."' ";
                        // echo("getLatestRule().$sql");
                        $arr = $this->fundamentalGetTheseRules($sql, " order by ruleId desc limit 0,1");
                        if (count($arr)>0)
                         return $arr[0];
                        return null;
                      }

                    private function fundamentalGetRulesByTextObjectIdRuleNameUserId( $textobjectId, $ruleName, $userId )
                    {
                        $arr = $this->fundamentalGetTheseRules(" where ruleTextObjectRef='$textobjectId' and ruleName='$ruleName' and ruleUserRef='$userId' and ruleStatus='active' ", "");
                      
                        return $arr;
                    }

                    private function fundamentalGetRulesByTextObjectIdRuleNameAndUserIdAndGeneric( $textobjectId, $ruleName, $userId )
                    {
                        $sqlSelect=" where ruleTextObjectRef='$textobjectId' and ruleName='$ruleName' and (ruleUserRef='$userId' or ruleGeneric='1') and ruleStatus='active' order by ruleGeneric ";
                        $arr = $this->fundamentalGetTheseRules($sqlSelect, ""); //  order by ruleGeneric ");
                       return $arr;
                    }                    

                    private function fundamentalGetRulesByTextObjectId( $textobjectId )
                    {
                        $arr = $this->fundamentalGetTheseRules(" where ruleTextObjectRef='$textobjectId' and ruleStatus='active' ", "");
                      
                        return $arr;
                    }

                    private function fundamentalGetRuleRequestsByTextObjectIdRuleName( $textobjectId, $ruleName )
                    {
                        $arr = $this->fundamentalGetTheseRules(" where ruleTextObjectRef='$textobjectId' and ruleName='$ruleName' and ruleStatus='request' ", "");
                      
                        return $arr;
                    }

                    private function fundamentalGetRuleInvitationsByTextObjectIdRuleName( $textobjectId, $ruleName )
                    {
                        $arr = $this->fundamentalGetTheseRules(" where ruleTextObjectRef='$textobjectId' and ruleName='$ruleName' and (ruleStatus='invitation' or ruleStatus='invitationweb') ", "");
                      
                        return $arr;
                    }

                    private function fundamentalUpdateRule($ruleObj)
                    {
                      $sql=$ruleObj->updateRecord();
                      mysql_query($sql, $this->dbconnect); 
                      // todo: error
                    }

                    private function fundamentalGetRuleById( $id )
                    {
                          $id=Converter::escapeSql($id);

                      // get this 
                      $arr = $this->fundamentalGetTheseRules(" where ruleId='$id' ", "");
                      if (count($arr)>0)
                       return $arr[0];

                      return null;
                    }
                    

                    private function fundamentalGetTheseRules($where,$orderby)
                    {
                      $sqlSelect="SELECT  * from Rule ".$where." ".$orderby." ";
                
                      // $sqlSelect=utf8_encode($sqlSelect);
                      $sqlSelect=mb_convert_encoding($sqlSelect, "ISO-8859-1", "UTF-8");
                      // echo($sqlSelect);
                
                      // echo("getThisArticles() : ".$sqlSelect."--");
                      
                      $arrayResult=array();
                      
                      $result = mysql_query($sqlSelect, $this->dbconnect); // $this->getDatabaseConnection()); 
                      if ($result)
                      {
                        $number= mysql_num_rows($result);
                        for ($i=0;$i<$number;$i++)
                        {
                          $objToUpdate=new Rule();
                                 $objToUpdate->updateToRecord($result,$i);
                          $arrayResult[count($arrayResult)]=$objToUpdate;
                          // print_r($ArticleObj);        
                        }
                      }
                      else
                      {
                        echo("App() error in $sqlSelect");
                        //$obj=$this->addApplicationRapport($sqlSelect);
                        //$obj->applicationRapportType="error";
                      }
                
                      return $arrayResult;      
                    }

                    private function fundamentalDeleteRule($ruleObj)
                    {
                      $sql=$ruleObj->deleteRecord();
                      mysql_query($sql, $this->dbconnect); 
                      // todo: error
                    }


        // TextObject extended Classes

         /*
            
            Cast
            Correct Class
            
            // no fundamental?

        */

        function getTextObjectCastForMime( $itype, $itypesub )
        {
            $newObj=new TextObject();

            $newObj->textobjectType=$itype;
            $newObj->textobjectTypeSub=$itypesub;

            return $this->getTextObjectCastFor( $newObj, false );
        }

        // attention: overwrites $argObj-content/members!
        // init 
        function getTextObjectCastFor( $argObj, $updateArguments=true )
        {
            $debugThis=false;


            if ($debugThis) echo("App.getTextObjectEntityFor(  ) ".$argObj->textobjectType."/".$argObj->textobjectTypeSub);

            if ($argObj->textobjectType=="platform")
            {
                // echo("****THREAD!");
                $newObj=new TextObjectPlatformPlain();  $newObj->updateTo($argObj, $updateArguments); return $this->addMembers($newObj);
            }            

            if ($argObj->textobjectType=="domain")
            {
                // echo("****THREAD!");
                 if ($argObj->textobjectTypeSub=="plain")
                 {
                     $newObj=new TextObjectDomainPlain();  $newObj->updateTo($argObj, $updateArguments); return $this->addMembers($newObj);
                  }
                 if ($argObj->textobjectTypeSub=="user")
                 {
                     $newObj=new TextObjectDomainUser();  $newObj->updateTo($argObj, $updateArguments); return $this->addMembers($newObj);
                  }
            }            

            if ($argObj->textobjectType=="thread")
            {
                // echo("****THREAD!");
                // hyper

                // plain
                if ($argObj->textobjectTypeSub=="plain") {  $newObj=new TextObjectThread();  $newObj->updateTo($argObj, $updateArguments); return $this->addMembers($newObj); }
            }

            if ($argObj->textobjectType=="hyperthread")
            {
                // echo("****THREAD!");
                // hyper

                // plain
                if ($argObj->textobjectTypeSub=="plain") {  $newObj=new TextObjectHyperthreadPlain();  $newObj->updateTo($argObj, $updateArguments); return $this->addMembers($newObj); }
            }


            // title
            if ($argObj->textobjectType=="title") {    $newObj=new TextObjectTitle();  $newObj->updateTo($argObj, $updateArguments); return $this->addMembers($newObj);   }
            
            // primitives
            if ($argObj->textobjectType=="number")
            {
                if ($argObj->textobjectTypeSub=="boolean") {  $newObj=new TextObjectNumberBoolean(); $newObj->updateTo($argObj, $updateArguments); return $this->addMembers($newObj); }
                if ($argObj->textobjectTypeSub=="integer") {  $newObj=new TextObjectNumberInteger(); $newObj->updateTo($argObj, $updateArguments); return $this->addMembers($newObj);  }
                if ($argObj->textobjectTypeSub=="float") {  $newObj=new TextObjectTextNumberFloat(); $newObj->updateTo($argObj, $updateArguments); return $this->addMembers($newObj);  }
            }

            // text 
            if ($argObj->textobjectType=="text")
            {
                if ($argObj->textobjectTypeSub=="line") {  $newObj=new TextObjectTextLine(); $newObj->updateTo($argObj, $updateArguments); return $this->addMembers($newObj); }
                if ($argObj->textobjectTypeSub=="plain") {  $newObj=new TextObject(); $newObj->updateTo($argObj, $updateArguments); return $this->addMembers($newObj); }
                if ($argObj->textobjectTypeSub=="html") {  $newObj=new TextObjectTextHtml(); $newObj->updateTo($argObj, $updateArguments); return $this->addMembers($newObj);  }
                if ($argObj->textobjectTypeSub=="rtf") {  $newObj=new TextObjectTextRtf(); $newObj->updateTo($argObj, $updateArguments); return $this->addMembers($newObj);  }
            }

            // images
            if ($argObj->textobjectType=="image")
            {
                if ($argObj->textobjectTypeSub=="png") {  $newObj=new TextObjectImagePng(); $newObj->updateTo($argObj, $updateArguments); return $this->addMembers($newObj); }
            }           
            
            // images
            if ($argObj->textobjectType=="audio")
            {
                if ($argObj->textobjectTypeSub=="wav") {  $newObj=new TextObjectAudioWav(); $newObj->updateTo($argObj, $updateArguments); return $this->addMembers($newObj); }
            }   

            // video
            if ($argObj->textobjectType=="video")
            {
                if ($argObj->textobjectTypeSub=="ogg") {  $newObj=new TextObjectVideoOgg(); $newObj->updateTo($argObj, $updateArguments); return $this->addMembers($newObj); }
            } 
            
            // video embed
            if ($argObj->textobjectType=="embed")
            {
                if ($argObj->textobjectTypeSub=="youtube") {  $newObj=new TextObjectEmbedYoutube(); $newObj->updateTo($argObj, $updateArguments); return $this->addMembers($newObj); }
            } 

            // link plain
            if ($argObj->textobjectType=="link")
            {
                if ($argObj->textobjectTypeSub=="plain") {  $newObj=new TextObjectLinkPlain(); $newObj->updateTo($argObj, $updateArguments); return $this->addMembers($newObj); }
            } 
            // complex blog
            if ($argObj->textobjectType=="blog")
            {
                if ($argObj->textobjectTypeSub=="plain") {  $newObj=new TextObjectBlogPlain(); $newObj->updateTo($argObj, $updateArguments); return $this->addMembers($newObj); }
            }   

            // echo("App.fundamentalGetTextObjectViewFor(  ) NOTFOUND! (".$argObj->textobjectType."/".$argObj->textobjectTypeSub.")");

            // todo: TextObjectTextNotDefined        
           // $newObj=new TextObjectTextNotDefined(); return $newObj->updateTo($argObj);
            $newObj=new TextObject(); 
            $newObj->updateTo($argObj);
            $newObj->textobjectArgumentText="TYPENOTFOUND! (".$argObj->textobjectType."/".$argObj->textobjectTypeSub."): ".$newObj->textobjectArgumentText;
            return $newObj;

            return null;
        }   

                // addMembers if there are!
                // 
                function addMembers( $argObj )
                {
                    // go trough members and add ...
                    if ($argObj->hasMembers())
                    {
                        // add the ...
                        // insert them now
                        for ($m=0;$m<count($argObj->arrMembers);$m++)
                        {
                            // get them and insert them here!
                            $memberDef=$argObj->arrMembers[$m];

                            // print_r($memberDef);
                            // add member here
                            $this->addMember($argObj,$memberDef);
                        }

                    }

                    $argObj->memberActivated=true;

                    return $argObj;
                }

                          function addMember( $argObj, $memberDef )
                          {

                              $memberDefObject=$this->getTextObjectCastForMime( $memberDef->memberMimeType, $memberDef->memberMimeTypeSub );
                              if ( $memberDefObject!=null )
                              {
                                  // update it
                                  $memberDef->textobjectObject=$memberDefObject;

  // todo? not correct ... 
                                  // is there an object to update? manual?
                                  if ($memberDef->memberDefaultObject!=null)
                                  {
                                      $memberDef->textobjectObject->updateTo($memberDef->memberDefaultObject); 
                                  }

                                  // update argument
                                  $memberDef->textobjectObject->setArgument($memberDef->memberDefaultArgument);

                              }

                          }

            
        /*
            
            Display
            
        */
        private function fundamentalGetTextObjectViewFor( $argObj )
        {
            $debugThis=false;

            if ($argObj==null) { echo("<hr>fundamentalGetTextObjectViewFor( null );<hr>"); return null; }
            
            if ($debugThis) echo("App.fundamentalGetTextObjectViewFor(  ) (".$argObj->textobjectType."/".$argObj->textobjectTypeSub.")");
            
            if ($argObj->textobjectType=="platform")   {  $viewObject=new TextObjectPlatformPlainView(); $viewObject->textobjectObject=$argObj; return $viewObject;   }

            if ($argObj->textobjectType=="domain")   
            {  
              if ($argObj->textobjectTypeSub=="plain")  { $viewObject=new TextObjectDomainPlainView(); $viewObject->textobjectObject=$argObj; return $viewObject;   }
              if ($argObj->textobjectTypeSub=="user")  {  $viewObject=new TextObjectDomainUserView(); $viewObject->textobjectObject=$argObj; return $viewObject;   }
            }

            if ($argObj->textobjectType=="thread")   
            {  
               if ($argObj->textobjectTypeSub=="plain") {  $viewObject=new TextObjectThreadView(); $viewObject->textobjectObject=$argObj; return $viewObject;   }
            }

            if ($argObj->textobjectType=="hyperthread")   
            {  
               if ($argObj->textobjectTypeSub=="plain") {  $viewObject=new TextObjectHyperthreadPlainView(); $viewObject->textobjectObject=$argObj; return $viewObject;   }
            }

            if ($argObj->textobjectType=="number")
            {
                if ($argObj->textobjectTypeSub=="boolean") { $viewObject=new TextObjectNumberBoolean(); $viewObject->textobjectObject=$argObj; return $viewObject; }
                if ($argObj->textobjectTypeSub=="integer") { $viewObject=new TextObjectNumberInteger(); $viewObject->textobjectObject=$argObj; return $viewObject; }
                if ($argObj->textobjectTypeSub=="float") { $viewObject=new TextObjectNumberFloat(); $viewObject->textobjectObject=$argObj; return $viewObject; }
            }

            if ($argObj->textobjectType=="title")   {  $viewObject=new TextObjectTitleView(); $viewObject->textobjectObject=$argObj; return $viewObject;   }

            if ($argObj->textobjectType=="text")
            {
                if ($argObj->textobjectTypeSub=="line") { $viewObject=new TextObjectTextLineView(); $viewObject->textobjectObject=$argObj; return $viewObject; }
                if ($argObj->textobjectTypeSub=="plain") { $viewObject=new TextObjectView(); $viewObject->textobjectObject=$argObj; return $viewObject; }
                if ($argObj->textobjectTypeSub=="html") { $viewObject=new TextObjectTextHTMLView(); $viewObject->textobjectObject=$argObj; return $viewObject; }
                if ($argObj->textobjectTypeSub=="rtf") { $viewObject=new TextObjectTextRtfView(); $viewObject->textobjectObject=$argObj; return $viewObject; }
            }

            // images
            if ($argObj->textobjectType=="image")
            {
                if ($argObj->textobjectTypeSub=="png")  { $viewObject=new TextObjectImagePngView(); $viewObject->textobjectObject=$argObj; return $viewObject;  }
            }           

            // images
            if ($argObj->textobjectType=="audio")
            {
                if ($argObj->textobjectTypeSub=="wav")  { $viewObject=new TextObjectAudioWavView(); $viewObject->textobjectObject=$argObj; return $viewObject;  }
            }           
			
			// video
            if ($argObj->textobjectType=="video")
            {
                if ($argObj->textobjectTypeSub=="ogg")  { $viewObject=new TextObjectVideoOggView(); $viewObject->textobjectObject=$argObj; return $viewObject;  }
            }      
            
            // video embed
            if ($argObj->textobjectType=="embed")
            {
                if ($argObj->textobjectTypeSub=="youtube")  { $viewObject=new TextObjectEmbedYoutubeView(); $viewObject->textobjectObject=$argObj; return $viewObject; }
            }  
            
            // complex
            if ($argObj->textobjectType=="link")
            {
                if ($argObj->textobjectTypeSub=="plain")  { $viewObject=new TextObjectLinkPlainView(); $viewObject->textobjectObject=$argObj; return $viewObject;  }
            }           

            // complex
            if ($argObj->textobjectType=="blog")
            {
                if ($argObj->textobjectTypeSub=="plain")  { $viewObject=new TextObjectBlogPlainView(); $viewObject->textobjectObject=$argObj; return $viewObject;  }
            }           

            
            echo("App.fundamentalGetTextObjectViewFor(  ) NOTFOUND! (".$argObj->textobjectType."/".$argObj->textobjectTypeSub.")");
        
            // todo ...
            $viewObject=new TextObjectView();
            $viewObject->textobjectObject=$argObj;
            // $newObj->textobjectArgumentText="TYPEVIEWNOTFOUND! (".$argObj->textobjectType."/".$argObj->textobjectTypeSub."): ".$newObj->textobjectArgumentText;
            
            return $viewObject;
            
            return null;
            
        }

    
		// -----------------------------
		// TextObject
     	// -----------------------------
     	private function fundamentalInsertTextObject($argObj)
		{
		     $sql=$argObj->insertRecord();
         //echo("<br>fundamentalInsertTextObject() ".$sql);
		     mysql_query($sql, $this->dbconnect); 
		     if (mysql_errno())
		     {
		      	echo mysql_errno($this->dbconnect) . ": " . mysql_error($this->dbconnect) . " --- ".$sql. "\n";
			   }
            else
            {
                // search for last object
                // todo: correct ...

            }

            return null;
		}

		private function fundamentalUpdateTextObject($argObj)
		{
		     $sql=$argObj->updateRecord();
		     mysql_query($sql, $this->dbconnect); 
             if (mysql_errno())
             {
                echo mysql_errno($this->dbconnect) . ": " . mysql_error($this->dbconnect) . " --- ".$sql. "\n";
            }
		}
     	
            // special
            private function fundamentalUpdateTextObjectUpdateComments( $textobjectId )
            {
                 $sql="UPDATE TextObject SET textobjectUpdateComments=Now() WHERE textobjectId=$textobjectId; ";
                 mysql_query($sql, $this->dbconnect); 
                 if (mysql_errno())
                 {
                    echo mysql_errno($this->dbconnect) . ": " . mysql_error($this->dbconnect) . " --- ".$sql. "\n";
                }
            }

     	// change this!!!
     	// get latest !!!
     	private function fundamentalGetLatestTextObject( $argObj )
     	{
     		// get this 
     		$arr = $this->fundamentalGetTheseTextObjects(" where textObjectName='".$argObj->textObjectName."'  and (textobjectStatus='published' OR textobjectStatus='draft') ", " order by textObjectId desc limit 0,1");
     		if (count($arr)>0)
     		 return $arr[0];
     		return null;
     	}
     	
     	private function fundamentalGetAllTextObjects(  )
     	{
     		// get this 
     		$arr = $this->fundamentalGetTheseTextObjects("  and (textobjectStatus='published' OR textobjectStatus='draft') ", " order by textObjectName");
     		return $arr;
     	}
     	
     	// ... todo: security
        // ... todo: add order ...
     	private function fundamentalGetAllTextObjectsByRef( $refId )
     	{
     		// get this 
     		$arr = $this->fundamentalGetTheseTextObjects(" where textobjectRef=$refId  and (textobjectStatus='published' OR textobjectStatus='draft') ", " order by textobjectOrder");
     		return $arr;
     	} 

        private function fundamentalCountAllTextObjectsByRef( $refId )
        {
            // get this 
            $arr = $this->fundamentalCountTheseTextObjects(" where textobjectRef=$refId and (textobjectStatus='published' OR textobjectStatus='draft') ", " order by textobjectOrder");
            return $arr;
        } 

        
        private function fundamentalGetAllTextObjectsByRefAndType( $refId, $refType, $refTypeSub )
        {
            // get this 
            $arr = $this->fundamentalGetTheseTextObjects(" where textobjectRef=$refId and  textobjectType='$refType' and textobjectTypeSub='$refTypeSub' and (textobjectStatus='published' OR textobjectStatus='draft') ", " order by textobjectArgumentText");
            return $arr;
        }

        private function fundamentalGetAllTextObjectsByRefAndTypes( $refId, $arrTypes, $refTypeSub )
        {
            // get this 
            $strOrTypes="";
            for ($t=0;$t<count($arrTypes);$t++) 
            { 
              $strOrTypes= $strOrTypes." textobjectType='".$arrTypes[$t]."'  OR";
            }
            $strOrTypes=substr($strOrTypes,0,strlen($strOrTypes)-3);

            $strSelect=" where textobjectRef=$refId and  ( $strOrTypes ) and (textobjectStatus='published' OR textobjectStatus='draft') ";
    // echo($strSelect);
            $arr = $this->fundamentalGetTheseTextObjects($strSelect, " order by textobjectArgumentText");
            return $arr;
        }

      private function fundamentalGetAllTextObjectsByRefRefName( $refId, $refName )
      {
        // get this 
        $arr = $this->fundamentalGetTheseTextObjects(" where textobjectRef=$refId and textobjectRefName='$refName' and (textobjectStatus='published' OR textobjectStatus='draft') ", " order by textobjectOrder");
        return $arr;
      } 

      private function fundamentalGetAllCommentsByRef( $refId )
      {
          $arr = $this->fundamentalGetTheseTextObjects(" where textobjectRef=$refId and textobjectRefName='' and (textobjectStatus='published' OR textobjectStatus='draft') ", " order by textobjectOrder");
          return $arr; 
      }

       private function fundamentalCountAllTextObjectsByUserRef( $refId )
        {
            // get this 
            $arr = $this->fundamentalGetTheseTextObjects(" where textobjectUserRef=$refId and (textobjectStatus='published' OR textobjectStatus='draft') ", " order by textobjectOrder");
            return $arr;
        } 

      private function fundamentalGetAllCommentsByUserRef( $refId )
      {
          $arr = $this->fundamentalGetTheseTextObjects(" where textobjectUserRef=$refId and textobjectRefName='' and (textobjectStatus='published' OR textobjectStatus='draft') ", " order by textobjectOrder");
          return $arr; 
      }     

      // comments withoutvisualorcursormarkers
      private function fundamentalGetAllCommentsCommentTypeEmptyByRef ( $refId )
      {
        // echo("fundamentalGetAllCommentsNoVisualNoMarkerByRef ( $refId )");
        $arr = $this->fundamentalGetTheseTextObjects(" where textobjectRef=$refId and textobjectRefName='' and (textobjectStatus='published' OR textobjectStatus='draft') and  textobjectCommentType=''  ", " order by textobjectOrder");
        return $arr;
      } 

      private function fundamentalGetAllCommentsCommentTypeVisualByRef( $refId )
      {
        // echo("fundamentalGetAllCommentsNoVisualNoMarkerByRef ( $refId )");
        $arr = $this->fundamentalGetTheseTextObjects(" where textobjectRef=$refId and textobjectRefName='' and (textobjectStatus='published' OR textobjectStatus='draft') and  textobjectCommentType='visual'   ", " order by textobjectOrder");
        return $arr;
      } 

      private function fundamentalGetAllCommentsTimedByRef( $refId )
      {
        // echo("fundamentalGetAllCommentsNoVisualNoMarkerByRef ( $refId )");
        $arr = $this->fundamentalGetTheseTextObjects(" where textobjectRef=$refId and textobjectRefName='' and (textobjectStatus='published' OR textobjectStatus='draft') and  (textobjectTimeA<>-1.0 or textobjectTimeB<>-1.0)   ", " order by textobjectTimeA");
        return $arr;
      } 

      /*
      private function fundamentalGetAllCommentsVisualMarkerByRef ( $refId )
      {
        $arr = $this->fundamentalGetTheseTextObjects(" where textobjectRef=$refId and textobjectRefName='' and (textobjectStatus='published' OR textobjectStatus='draft') and  (textobjectCursorA<>-1  or textobjectCursorB<>-1  or textobjectPositionX<>-1.0 or textobjectPositionY<>-1.0  or textobjectPositionZ<>-1.0)   ", " order by textobjectOrder");
        return $arr;
      } 
      */

     	// by status
     	private function fundamentalGetAllTextObjectsByStatus( $status )
     	{
     		// get this 
     		$arr = $this->fundamentalGetTheseTextObjects(" where textobjectStatus='$status' ", " order by textObjectName");
     		return $arr;
     	}  

		
     	private function fundamentalGetTextObjectById( $id )
     	{
     		// get this 
     		$arr = $this->fundamentalGetTheseTextObjects(" where textobjectId='$id' ", "");
     		if (count($arr)>0)
     		 return $arr[0];

     		return null;
     	}

            // gives only the status='' back
            private function fundamentalGetTheseTextObjects($where,$orderby)
            {
                return $this->fundamentalGetTheseTextObjectsExtended($where." AND (textobjectStatus='published' OR textobjectStatus='draft') ",$orderby);          
            }       

     	
     	private function fundamentalGetTheseTextObjectsExtended($where,$orderby)
			{

//echo("<br>fundamentalGetTheseTextObjectsExtended($where,$orderby)");

				$arr=$this->fundamentalGetTheseTextObjectsInDatabase($where,$orderby);

                if (count($arr)>0)
                {
                    for ($a=0;$a<count($arr);$a++)
                    {
                        $objUncast=$arr[$a];
                        $objCast=$this->getTextObjectCastFor( $objUncast );
                        $arr[$a]= $objCast;

                        // add here also the members for this object
                        if ($objCast->hasMembers())
                        {
                            // add the ...
                            // insert them now
                            for ($m=0;$m<count($objCast->arrMembers);$m++)
                            {
                                // get them and insert them here!
                                $memberDef=$objCast->arrMembers[$m];

                                // go through members 
                                // check for 
                                // if there is no member create one!
                                // 

                                // 1. get member
                                $refId=$objCast->textobjectId;
                                $refName=$memberDef->memberRefName;

                                // 2. existing? > add
                                $arrExistingMembers=$this->fundamentalGetAllTextObjectsByRefRefName( $refId, $refName );

                                // 2.1 not existing > create one and add ...
                                // inconsistent datatypes/classe > add *
                                if (count($arrExistingMembers)==0)
                                {
                                   // create one
                                   $this->addMember( $objCast, $memberDef );
                                   $arrExistingMembers=$this->fundamentalGetAllTextObjectsByRefRefName( $refId, $refName );
                                }

                                // fill in here ..
                                for ($t=0;$t<count($arrExistingMembers);$t++)
                                {
                                    // * todo arrays here ..
                                    $memberDef->textobjectObject=$arrExistingMembers[$t];
                                    break;
                                }

                            }

                        }

                    }
                }

				return $arr;			
			}		

                    private function fundamentalCountTheseTextObjects($where,$orderby)
                    {
                        $sqlSelect="SELECT  count(*) from TextObject ".$where." ".$orderby." ";
            
                        // $sqlSelect=utf8_encode($sqlSelect);
                        $sqlSelect=mb_convert_encoding($sqlSelect, "ISO-8859-1", "UTF-8");

                        $result = mysql_query($sqlSelect, $this->dbconnect); 
                        $num=mysql_result($result, 0,0);

                        return $num;
                    }

     	
		
                    // todo: merc
                    private function fundamentalGetTheseTextObjectsInDatabase($where,$orderby, $tableName="TextObject")
                    {
                        $sqlSelect="SELECT  * from $tableName ".$where." ".$orderby." ";
            
                        // $sqlSelect=utf8_encode($sqlSelect);
                        $sqlSelect=mb_convert_encoding($sqlSelect, "ISO-8859-1", "UTF-8");
                        // echo($sqlSelect);
            
     // echo("fundamentalGetTheseTextObjectsInDatabase() : ".$sqlSelect."--");
                        
                        $arrayResult=array();
                        
                        $result = mysql_query($sqlSelect, $this->dbconnect); // $this->getDatabaseConnection()); 
                        if ($result)
                        {
                            $number= mysql_num_rows($result);
                            for ($i=0;$i<$number;$i++)
                            {
                                $objToUpdate=new TextObject();
                                             $objToUpdate->updateToRecord($result,$i);
                                $arrayResult[count($arrayResult)]=$objToUpdate;
                                // print_r($ArticleObj);                
                            }
                        }
                        else
                        {
                            echo("App() error in $sqlSelect");
                            //$obj=$this->addApplicationRapport($sqlSelect);
                            //$obj->applicationRapportType="error";
                        }
            
                        return $arrayResult;            
                    }               
     
      // -----------------------------
      // TextObjectVersion
      // -----------------------------
        private function fundamentalInsertTextObjectVersion($textobjectId, $commentType, $userId)
        {
            // insert it now!!
             $sqlInserNewVersion="INSERT INTO TextObjectVersion (Select * from TextObject WHERE textobjectId=$textobjectId )";
             mysql_query($sqlInserNewVersion, $this->dbconnect); 
             if (mysql_errno())
             {
                echo "<br>ERROR: fundamentalInsertTextObjectVersion() ".mysql_errno($this->dbconnect) . ": " . mysql_error($this->dbconnect) . " --- ".$sqlInserNewVersion. "\n";
            }
        }

                    private function fundamentalCountTheseTextObjectVersions($textobjectId)
                    {
                        $sqlSelect="SELECT  count(*) from TextObjectVersion where textobjectId=$textobjectId ";
            
                        // $sqlSelect=utf8_encode($sqlSelect);
                        $sqlSelect=mb_convert_encoding($sqlSelect, "ISO-8859-1", "UTF-8");

                        $result = mysql_query($sqlSelect, $this->dbconnect); 
                        $num=mysql_result($result, 0,0);

                        return $num;
                    }

       private function fundamentalGetLatestTextObjectVersion( $textobjectId )
       {
          // get this 
          $arr = $this->fundamentalGetTheseTextObjectsInDatabase(" where textobjectId=$textobjectId ", " order by textobjectVersionId desc limit 0,1"," TextObjectVersion ");
          if (count($arr)>0)
           return $arr[0];
          return null;
        }

       private function fundamentalTextObjectVersions( $textobjectId )
       {
          // get this 
          $arr = $this->fundamentalGetTheseTextObjectsInDatabase(" where textobjectId=$textobjectId ", " order by textobjectVersionId desc "," TextObjectVersion ");
          return $arr;
        }



    /*
        documents
        protected objects 

    */

   
      // Read a file and display its content chunk by chunk
      function readfile_chunked($filename, $retbytes = TRUE) 
      {
        $chunkSize=1024*1024;

        $buffer = '';
        $cnt =0;
        // $handle = fopen($filename, 'rb');
        $handle = fopen($filename, 'rb');
        if ($handle === false) {
          return false;
        }
        while (!feof($handle)) {
          $buffer = fread($handle, $chunkSize);
          echo $buffer;
          ob_flush();
          flush();
          if ($retbytes) {
            $cnt += strlen($buffer);
          }
        }
        $status = fclose($handle);
        if ($retbytes && $status) {
          return $cnt; // return num. bytes delivered like readfile() does.
        }
        return $status;
      }

        function streamDocumentWithMimeType( $filePath, $mimeType )
        {
           header('Content-Type: '.$mimeType );
           $this->readfile_chunked($filePath);
        }

    // -----------------------------
    // logging
    // -----------------------------
    private function fundamentalInsertLogObject($argObj,$userId) 
    {
        $sql=$argObj->insertRecord();
         // echo($sql);
             // echo("fundamentalInsertTextObject() ".$sql);
         mysql_query($sql, $this->dbconnect); 
         if (mysql_errno())
         {
          echo "<br>ERROR: fundamentalInsertLogObject() ".mysql_errno($this->dbconnect) . ": " . mysql_error($this->dbconnect) . " --- ".$sql. "\n";
      }
    }  


     // -----------------------------
		  // debugging
     	// -----------------------------
     	function debugMessage( $msg )
     	{
     		echo("<div class='error'>".$msg."</div>");
     	}
     	
     
		
		
    }
    
?>