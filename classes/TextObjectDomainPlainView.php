<?

	class TextObjectDomainPlainView extends TextObjectHyperthreadPlainView 
	{
		var $textobjectviewType="domain";
		var $textobjectviewTypeSub="plain";

		function viewDetailDomain($contentId,$app,$userId)
		{
			$str="";

			// default show siblings?
			$str=$str.$this->showSiblingLineBySiblingId( -1, $this->getId(), $app, $userId ); // -1
			// $str=$str."<br>";

			// go on here ...
			// intreeview
			if ($contentId!=$this->getId())
			{
				
				// start
				$str=$str.$this->viewTreeDetailStart( 0, $app, $userId);

						// show tree down to next hyperthread
						// show in hyperthread the tree > content again!
						$arrTree=$app->getTreeUpForIdDirectExt( $contentId, $userId );
						// print_r($arrTree);
						/* for ($i=0;$i<count($arrTree);$i++)
						{
							$obj=$arrTree[$i];
							$str=$str."<br>$i. ".$obj->getArgument()." [".$obj->textobjectType."/".$obj->textobjectTypeSub."]";
						}
						$str=$str."<br>";
						*/

						$hyperThreadIndex=$app->getIndexInTreeFirstHyperThread( $arrTree );
						/*
								
							CASES: No Hyperthread, show direct Hyperthread or a thread direct to show
								
						*/
							/*
								case: domainthread
									  no hyperthread - is just a thread of a domain!

							*/
							if ($hyperThreadIndex==-1)
							{
								// if there is no hyperthread!!
					
								$arr=$app->getArrayPart($arrTree,1);
								$str=$str.$this->showTreePart(-1, $arr, $app, $userId); // start: 0

								// get last object and show it here !
								// echo("***".(count($arrTree)-1)."***");
								$threadObj=$arrTree[count($arrTree)-1];
								// get thread here ...
								$threadObjView=$app->getTextObjectViewFor($threadObj, $userId );
			                    $str=$str.$threadObjView->viewDetail( $app, $userId );					

								return $str; // ."<br>NOT FOUND! MEANS NO HYPERTHREAD HERE !!!! ";	
								// show direct ... 
							} 


						/*
							Between Domain and Hyperthread
						*/
						// TREE: domain-hyperthread
						// echo($hyperThreadIndex);
						$arr=$app->getArrayPart($arrTree,1,$hyperThreadIndex);
						$str=$str.$this->showTreePart($hyperThreadIndex, $arr, $app, $userId); // start: 0 / 


						/*
							Cases: Hyperthread and below
						*/
						/*
									case: showId is the Hyperthread Node
								*/
								// HyperThread!
								// get hyperthread an show him now ...
								$hyperthreadObj=$arr[$hyperThreadIndex-1];
								$hyperthreadObjView=$app->getTextObjectViewFor($hyperthreadObj, $app, $userId);

								// case: hyperthread is object to show ...
								if ($hyperthreadObj->textobjectId==$contentId)
								{
									$str=$str.$hyperthreadObjView->viewDetail($app,$userId);
								}
							
								/*
									case: showId is the Hyperthread Node
								*/
								// case: hyperthread is not object to show go further ...
								if ($hyperthreadObj->textobjectId!=$contentId)
								{
									// $str=$str."SHOW BELOW".$hyperthreadObjView->viewDetail($app,$userId);
									$str=$str."".$hyperthreadObjView->viewDetailHyperthread($contentId, $app,$userId);
								}
					

		// 				viewDetailWithId($contentId,$app,$userId)

				// stop 
				$str=$str.$this->viewTreeDetailStop( 0, $app, $userId);

			}

			/*
				Case: content
			*/
			// this is the content ... 
			if ($contentId==$this->getId())
			{

				$str=$str."".$this->viewDetail($app,$userId);
			}

			return $str;
		}


/*
          in the view ...
        */
        function viewTreeMenuPoint( $depth, $siblingAmount, $app, $userId)
        {
          $str="";

            $str=$str."<div class='textobjectThreadPlainTreeContainerMenuPoint' ".$this->getOnClickURLWebservice( $this->textobjectObject ).">";
            $str=$str.$this->textobjectObject->getArgumentCutted()." *";
            $str=$str."</div>";

          return $str;
        }

          //   ___________________
          // _| threadA selected* |__
          function viewTreeMenuPointSelected( $depth, $siblingAmount,  $app, $userId)
          {
            $str="";

              $str=$str."<div class='textobjectThreadPlainTreeContainerMenuPointActive' ".$this->getOnClickURLWebservice( $this->textobjectObject ).">";
              $str=$str.$this->textobjectObject->getArgumentCutted()." *";
              $str=$str."</div>";

            return $str;
          }

				/*
					selected object
				*/
				function viewTreeDetailStart( $depth, $app, $userId)
				{
					$str="";
						$str=$str."<div class='textobjectDomainPlainView'>";
						$str=$str.$this->getNoScriptHrefURLDirect( $this->textobjectObject ); // direct
						$strOnClick=$this->getOnClickURLWebservice( $this->textobjectObject ); // onClick
						// show ...
						// $str=$str."<div style='font-size: 24px;' $strOnClick >".$this->textobjectObject->getArgument()."</div>";
					return $str;
				}

					// content here ... 

				function viewTreeDetailStop( $depth, $app, $userId)
				{
					$str="";
						$str=$str."</div>";
					return $str;
				}


	}
	
    
?>