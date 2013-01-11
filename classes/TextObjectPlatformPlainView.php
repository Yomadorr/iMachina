<?
  
  // platform > domain
	class TextObjectPlatformPlainView extends TextObjectDomainPlainView
  {
		var $textobjectviewType="platform";
		var $textobjectviewTypeSub="plain";


  		// view the platform
      // this is not an overwritten method it is a new one!
      // textobjectDomainContentId is the to show content!
     	function viewDetailPlatform( $textobjectDomainContentId, $app, $userId )
     	{
     		$str="";

     		$str=$str."";
     		// echo("viewDetail( app, $userId )");
    		     // print_r($this->textobjectObject->getMemberByName( "logo", $app, $userId ));
               $str=$str."<div class='textobjectPlatformPlainDetail'>";

                // logo
          	    $str=$str."<div class='textobjectPlatformPlainDetailHeadContainer'  onClick=\"document.location.href='index.php';\" >";
          	         	$pathLogo=$this->textobjectObject->getMemberValue("logo",$app,$userId);
                         $str=$str."<div class='textobjectPlatformDetailPlainHeadContainerText'>".$this->textobjectObject->getArgument()."</div>";               
                         if ($pathLogo!="")  { $str=$str."<div class='textobjectPlatformPlainDetailHeadContainerLogo'><img src='$pathLogo'></div>"; }
     		       $str=$str."</div>";

           // todo: if access is ok
           // edit
           // $str=$str."\n   ".$this->viewForm( $app, $userId )."";    
           $str=$str."<div class='textobjectPlatformPlainDetailEdit' id='textobjectPlatformPlainDetailEdit' onClick=\"doCommandTextObject(".$this->textobjectObject->textobjectId.", 'edit', 'textobjectPlatformPlainDetailEdit' );\"></div>";
           $str=$str."<div class='textobjectPlatformPlainDetailRule' id='textobjectPlatformPlainDetailRule' onClick=\"doCommandRuleOnTextObject('rule',".$this->textobjectObject->textobjectId.",'textobjectPlatformPlainDetailRule' );\"></div>";


                    // split
                  $str=$str."<div class='textobjectPlatformPlainDetailHeadContainerSplit'></div>";

                  // from selected?
                  $showId=$textobjectDomainContentId;
                  // search for platforms
                  $arr=$app->getDomains($userId);

                  // only one platform 
                  // todo: problem no domain!

                  // no preset
                  if ($showId==-1)
                  {
                      if (count($arr)==0)
                      {
                         $str=$str."<div>No domain selected.</div>";
                      }

                      // select this ...
                      if (count($arr)==1)
                      {
                         $domainObj=$arr[0];
                         $showId=$domainObj->textobjectId;
                      }

                      // select the selected!
                      if (count($arr)>1)
                      {
                          // take the selected!
                          // todo: 
                          $domainObj=$arr[0];
                           $showId=$domainObj->textobjectId;
                      }
                  }

                     /*
                        User Container
                     */
                     $containerObj=new UserContainerView();
                     $str=$str.$containerObj->viewContainer( $app, $userId );

 
                  // display this here and now ...
                  // if (false)
                  // echo("<br>showId: ".$showId);
                  if ($showId!=-1)
                  {

                     /*
                        Content Container
                     */
                     // content

                      // version 2.0
                      // /gettree

                      // displaying down the tree here ...
                      // get domain .. and show this there .. 
                      // get domain and show there! 
                      // ...
                      
                      // view container ... 

                      // 1. get tree
                      // 2. get domain > show domain
                      // 3. show tree
                      // 4. show ... next hyperthread
                      // 5. show tree to thread
                      // 6. show thread

                      // container
                      // platform > domain
                      $str=$str."<div class='contentContainer' >";
                        $domainObj=$app->getDomainById( $showId, $userId );                   
                        if ($domainObj!=null) 
                        {
                            // domainView
                            $domainObjView=$app->getTextObjectViewFor($domainObj, $userId );
                            $str=$str.$domainObjView->viewDetailDomain( $showId, $app, $userId );
                        }
                        if ($domainObj==null) 
                        {
                            $strError=$app->getLanguageBy( $app->getDomainLanguage($userId), "@contentErrorThreadNotFound" ) ;  
                            $str=$str.$strError;                      
                        }
                      $str=$str."</div>";

                     
                  }
                  else
                  {
                     $str=$str."Error could not show this. @error";
                  }

               
               $str=$str."</div>";

    		    return $str;
     	} 

        


	}
	
    
?>