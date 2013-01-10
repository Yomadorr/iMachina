<?

	// include instance
	include("./appinstance.php");

	// excercise task handling
	include("./includes/excercisetaskhandling.user.php");

	// check logged in!
	include("./includes/checkaccess.user.php");

	// excercise
	$excerciseId=$excerciseObject->excerciseId;
	$excercisetaskObject=$excerciseObject;

	// excercise task
	$excercisetaskObjId=$excerciseTaskObject->excercisetaskId;
	$excercisetaskObject=$excerciseTaskObject;
	$excercisetaskId=$excerciseTaskObject->excercisetaskId;


	// create pdf!
	include("./includes/fpdf/fpdf.php");

	class PDF extends FPDF
	{
		var $B;
		var $I;
		var $U;
		var $HREF;

		function PDF($orientation='P', $unit='mm', $size='A4')
		{
		    // Call parent constructor
		    $this->FPDF($orientation,$unit,$size);
		    // Initialization
		    $this->B = 0;
		    $this->I = 0;
		    $this->U = 0;
		    $this->HREF = '';
		}

						function WriteHTML($html)
						{
						    // HTML parser
						    $html = str_replace("\n",' ',$html);
						    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
						    foreach($a as $i=>$e)
						    {
						        if($i%2==0)
						        {
						            // Text
						            if($this->HREF)
						                $this->PutLink($this->HREF,$e);
						            else
						                $this->Write(5,$e);
						        }
						        else
						        {
						            // Tag
						            if($e[0]=='/')
						                $this->CloseTag(strtoupper(substr($e,1)));
						            else
						            {
						                // Extract attributes
						                $a2 = explode(' ',$e);
						                $tag = strtoupper(array_shift($a2));
						                $attr = array();
						                foreach($a2 as $v)
						                {
						                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
						                        $attr[strtoupper($a3[1])] = $a3[2];
						                }
						                $this->OpenTag($tag,$attr);
						            }
						        }
						    }
						}

						function OpenTag($tag, $attr)
						{
						    // Opening tag
						    if($tag=='B' || $tag=='I' || $tag=='U')
						        $this->SetStyle($tag,true);
						    if($tag=='A')
						        $this->HREF = $attr['HREF'];
						    if($tag=='BR')
						        $this->Ln(5);
						}

						function CloseTag($tag)
						{
						    // Closing tag
						    if($tag=='B' || $tag=='I' || $tag=='U')
						        $this->SetStyle($tag,false);
						    if($tag=='A')
						        $this->HREF = '';
						}

						function SetStyle($tag, $enable)
						{
						    // Modify style and select corresponding font
						    $this->$tag += ($enable ? 1 : -1);
						    $style = '';
						    foreach(array('B', 'I', 'U') as $s)
						    {
						        if($this->$s>0)
						            $style .= $s;
						    }
						    $this->SetFont('',$style);
						}

						function PutLink($URL, $txt)
						{
						    // Put a hyperlink
						    $this->SetTextColor(0,0,255);
						    $this->SetStyle('U',true);
						    $this->Write(5,$txt,$URL);
						    $this->SetStyle('U',false);
						    $this->SetTextColor(0);
						}

						// -------------------
						// TABLES
						// -------------------

						// complex 
						var $lineWith=180.0;
						function DisplayTableLine( $lineText )
						{
							// $pdfInstance->WriteHTML("<br><b>".$obj->frameworkdimName."</b>");
							$columns = array();       
								// data col
								$col = array();
									$col[] = array('text' => $lineText, 'width' => $this->lineWith, 'height' => '5', 'align' => '', 'font_name' => 'Helvetica', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '200,200,200', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR');
								$columns[] = $col;
								// Draw Table   
							$this->WriteTable($columns);
						}

							function DisplayTableLineDarker( $lineText )
							{
								// $pdfInstance->WriteHTML("<br><b>".$obj->frameworkdimName."</b>");
								$columns = array();       
									// data col
									$col = array();
										$col[] = array('text' => $lineText, 'width' => $this->lineWith, 'height' => '5', 'align' => '', 'font_name' => 'Helvetica', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '50,50,50', 'textcolor' => '255,255,255', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR');
									$columns[] = $col;
									// Draw Table   
								$this->WriteTable($columns);
							}

						function DisplayTableLineHeader( $lineText )
						{
							// $pdfInstance->WriteHTML("<br><b>".$obj->frameworkdimName."</b>");
							$columns = array();       
								// data col
								$col = array();
									$col[] = array('text' => $lineText, 'width' => $this->lineWith, 'height' => '5', 'align' => '', 'font_name' => 'Helvetica', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '220,220,220', 'textcolor' => '5,5,5', 'drawcolor' => '0,0,0', 'linewidth' => '0.05', 'linearea' => 'LTBR');
								$columns[] = $col;
								// Draw Table   
							$this->WriteTable($columns);
						}						

						function DisplayTableLineComment( $lineText )
						{
							// $this->WriteHTML("Kommentar: ".$lineText."<br><br>");
							$columns = array();       
								// data col
								$col = array();
						//			$col[] = array('text' => $lineText, 'width' => $this->lineWith, 'height' => '5', 'align' => '', 'font_name' => 'Helvetica', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '220,220,220', 'textcolor' => '5,5,5', 'drawcolor' => '0,0,0', 'linewidth' => '0.05', 'linearea' => 'LTBR');
								$col[] = array('text' => "Kommentar: ".$lineText."\n\n", 'width' => $this->lineWith, 'height' => '5', 'align' => '', 'font_name' => 'Helvetica', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '80,80,80', 'drawcolor' => '0,0,0', 'linewidth' => '0.05', 'linearea' => 'LTBR');
								$columns[] = $col;
								// Draw Table   
							$this->WriteTable($columns);
						}						

						function DisplayTableColsNeutral( $arrCols, $arrResult=null, $colsFromType="self", $colIndex=0 ) /* self/other/both */
						{
							// coltype=
							// self/other/both

							// $pdfInstance->WriteHTML("<br><b>".$obj->frameworkdimName."</b>");
							$columns = array();    

							$columsadd= array();

								// data col
								$colSize=$this->lineWith/count($arrCols);

								$col = array();
								$colAdd = array();
								for ($t=0;$t<count($arrCols);$t++)
								{
									$lineText=$arrCols[$t];
									$textAdd="";

									// dirty version
									// $lineText.
									

									$coltype=""; // default
									$val=0;
									if ($arrResult!=null)
									{
										//if ($t<count($arrResult))
										//{
										//if ()
										//{	
											$val=$arrResult[$t];
											if ($val==1) { /* $lineText="[O]\n".$lineText;*/  $textAdd="O"; $coltype="self"; }
											if ($val==2) { /* $lineText="[X]\n".$lineText; */ $textAdd="X"; $coltype="other"; }
											if ($val==3) { /*$lineText="[XO]\n".$lineText; */ $textAdd="XO"; $coltype="both"; }
										//}
										//}

										// $lineText=$val."-".$lineText;
									}

										if ($coltype=="") $col[] = array('text' => $lineText, 'width' => $colSize, 'height' => '5', 'align' => '', 'font_name' => 'Helvetica', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR');
										if ($coltype!="") $col[] = array('text' => $lineText, 'width' => $colSize, 'height' => '5', 'align' => '', 'font_name' => 'Helvetica', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR', 'type' => $coltype );
									
									
									// coltypes ... 
									
									// $coladd[] = array('text' => "$val", 'width' => $colSize, 'height' => '5', 'align' => '', 'font_name' => 'Helvetica', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '130,130,130', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR');									

									if ($coltype=="")
									{
										$coladd[] = array('text' => $textAdd, 'width' => $colSize, 'height' => '5', 'align' => '', 'font_name' => 'Helvetica', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR');									
									}
									
									if ($coltype=="self")
									{
										$coladd[] = array('text' => $textAdd, 'width' => $colSize, 'height' => '5', 'align' => '', 'font_name' => 'Helvetica', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '130,130,130', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR');									
									}
									
									if ($coltype=="other")
									{
										$coladd[] = array('text' => $textAdd, 'width' => $colSize, 'height' => '5', 'align' => '', 'font_name' => 'Helvetica', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '100,100,100', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR');
									}

									if ($coltype=="both")
									{
										$coladd[] = array('text' => $textAdd, 'width' => $colSize, 'height' => '5', 'align' => '', 'font_name' => 'Helvetica', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '50,50,50', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR');
									}									

								}
								$columns[] = $col;

								$columsadd[] = $coladd;

								// Draw Table   
							$this->WriteTable($columns);

							// add here ... 
							// if ($colIndex>0)
							{
								$this->WriteTable($columsadd);
							}
						}

						function DisplayTableCols( $arrCols, $arrResult=null, $colsFromType="self", $colIndex=0 ) /* self/other/both */
						{
							// coltype=
							// self/other/both

							// $pdfInstance->WriteHTML("<br><b>".$obj->frameworkdimName."</b>");
							$columns = array();    

							$columsadd= array();

								// data col
								$colSize=$this->lineWith/count($arrCols);

								$col = array();
								$colAdd = array();
								for ($t=0;$t<count($arrCols);$t++)
								{
									$lineText=$arrCols[$t];
									$textAdd="";

									// dirty version
									// $lineText.
									$neutral=false;
									if (strlen($lineText)>0)
									{
										if (substr($lineText,0,1)=="*") 
										{
											$neutral=true;
											$lineText=substr($lineText,1);
										}
									}

									$coltype=""; // default
									$val=0;
									if ($arrResult!=null)
									{
										//if ($t<count($arrResult))
										//{
										//if ()
										//{	
											$val=$arrResult[$t];
											if ($val==1) { /* $lineText="[O]\n".$lineText;*/  $textAdd="O"; $coltype="self"; }
											if ($val==2) { /* $lineText="[X]\n".$lineText; */ $textAdd="X"; $coltype="other"; }
											if ($val==3) { /*$lineText="[XO]\n".$lineText; */ $textAdd="XO"; $coltype="both"; }
										//}
										//}

										// $lineText=$val."-".$lineText;
									}

									if ($neutral)
									{
										if ($coltype=="") $col[] = array('text' => $lineText, 'width' => $colSize, 'height' => '5', 'align' => '', 'font_name' => 'Helvetica', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR');
										if ($coltype!="") $col[] = array('text' => $lineText, 'width' => $colSize, 'height' => '5', 'align' => '', 'font_name' => 'Helvetica', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR', 'type' => $coltype );
									}
									if (!$neutral)
									{
										if ($coltype=="") $col[] = array('text' => $lineText, 'width' => $colSize, 'height' => '5', 'align' => '', 'font_name' => 'Helvetica', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '210,255,210', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR');
										if ($coltype!="") $col[] = array('text' => $lineText, 'width' => $colSize, 'height' => '5', 'align' => '', 'font_name' => 'Helvetica', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '210,255,210', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR', 'type' => $coltype );
									}
									
									// coltypes ... 
									
									// $coladd[] = array('text' => "$val", 'width' => $colSize, 'height' => '5', 'align' => '', 'font_name' => 'Helvetica', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '130,130,130', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR');									

									if ($coltype=="")
									{
										$coladd[] = array('text' => $textAdd, 'width' => $colSize, 'height' => '5', 'align' => '', 'font_name' => 'Helvetica', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR');									
									}
									
									if ($coltype=="self")
									{
										$coladd[] = array('text' => $textAdd, 'width' => $colSize, 'height' => '5', 'align' => '', 'font_name' => 'Helvetica', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '130,130,130', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR');									
									}
									
									if ($coltype=="other")
									{
										$coladd[] = array('text' => $textAdd, 'width' => $colSize, 'height' => '5', 'align' => '', 'font_name' => 'Helvetica', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '100,100,100', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR');
									}

									if ($coltype=="both")
									{
										$coladd[] = array('text' => $textAdd, 'width' => $colSize, 'height' => '5', 'align' => '', 'font_name' => 'Helvetica', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '50,50,50', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.1', 'linearea' => 'LTBR');
									}									

								}
								$columns[] = $col;

								$columsadd[] = $coladd;

								// Draw Table   
							$this->WriteTable($columns);

							// add here ... 
							// if ($colIndex>0)
							{
								$this->WriteTable($columsadd);
							}
						}

						// DisplayTableColsNeutral


						// Margins
						   var $left = 10;
						   var $right = 10;
						   var $top = 10;
						   var $bottom = 10;
						         
						   // Create Table
						   function WriteTable($tcolums)
						   {
						      // go through all colums
						      for ($i = 0; $i < sizeof($tcolums); $i++)
						      {
						         $current_col = $tcolums[$i];
						         $height = 0;
						         
						         // get max height of current col
						         $nb=0;
						         for($b = 0; $b < sizeof($current_col); $b++)
						         {
						            // set style
						            $this->SetFont($current_col[$b]['font_name'], $current_col[$b]['font_style'], $current_col[$b]['font_size']);
						            $color = explode(",", $current_col[$b]['fillcolor']);
						            $this->SetFillColor($color[0], $color[1], $color[2]);
						            $color = explode(",", $current_col[$b]['textcolor']);
						            $this->SetTextColor($color[0], $color[1], $color[2]);            
						            $color = explode(",", $current_col[$b]['drawcolor']);            
						            $this->SetDrawColor($color[0], $color[1], $color[2]);
						            $this->SetLineWidth($current_col[$b]['linewidth']);
						                        
						            $nb = max($nb, $this->NbLines($current_col[$b]['width'], $current_col[$b]['text']));            
						            $height = $current_col[$b]['height'];
						         }  
						         $h=$height*$nb;
						         
						         
						         // Issue a page break first if needed
						         $this->CheckPageBreak($h);
						         
						         // Draw the cells of the row
						         for($b = 0; $b < sizeof($current_col); $b++)
						         {
						            $w = $current_col[$b]['width'];
						            $a = $current_col[$b]['align'];
						            
						            // Save the current position
						            $x=$this->GetX();
						            $y=$this->GetY();

						            // type?
						            if (isset($current_col[$b]['type']))
						            {
							            $thisType=$current_col[$b]['type'];
							            if ($thisType!=null)
							            {
							               // add here ... 
							            	$serverPath=dirname($_SERVER["PHP_SELF"]);	
						
											$imgsOther="http://".$_SERVER["HTTP_HOST"].$serverPath."/imgs/other.png";
											$imgsSelf="http://".$_SERVER["HTTP_HOST"].$serverPath."/imgs/self.png";

											// add here
											// $pdfInstance->WriteHTML("Fremdbeurteilung: "); 
											// $this->Cell( 0, 0, $this->Image($imgsOther, $this->GetX(), $this->GetY(), 1.0 ), 0, 0, 'R', true );
											// $this->Image($imgsOther, $this->GetX(), $this->GetY(), 1.0 );

											// $this->WriteHTML("<br>Selfbeurteilung ****: "); 
											// $pdfInstance->Cell( 10, 5, $pdfInstance->Image($imgsSelf, $pdfInstance->GetX(), $pdfInstance->GetY(), 6.0 ), 0, 0, 'R', false );

							            }
						            }

						            // set style
						            $this->SetFont($current_col[$b]['font_name'], $current_col[$b]['font_style'], $current_col[$b]['font_size']);
						            $color = explode(",", $current_col[$b]['fillcolor']);
						            $this->SetFillColor($color[0], $color[1], $color[2]);
						            $color = explode(",", $current_col[$b]['textcolor']);
						            $this->SetTextColor($color[0], $color[1], $color[2]);            
						            $color = explode(",", $current_col[$b]['drawcolor']);            
						            $this->SetDrawColor($color[0], $color[1], $color[2]);
						            $this->SetLineWidth($current_col[$b]['linewidth']);
						            
						            $color = explode(",", $current_col[$b]['fillcolor']);            
						            $this->SetDrawColor($color[0], $color[1], $color[2]);
						            
						            
						            // Draw Cell Background
						            $this->Rect($x, $y, $w, $h, 'FD');
						            
						            $color = explode(",", $current_col[$b]['drawcolor']);            
						            $this->SetDrawColor($color[0], $color[1], $color[2]);
						            
						            // Draw Cell Border
						            if (substr_count($current_col[$b]['linearea'], "T") > 0)
						            {
						               $this->Line($x, $y, $x+$w, $y);
						            }            
						            
						            if (substr_count($current_col[$b]['linearea'], "B") > 0)
						            {
						               $this->Line($x, $y+$h, $x+$w, $y+$h);
						            }            
						            
						            if (substr_count($current_col[$b]['linearea'], "L") > 0)
						            {
						               $this->Line($x, $y, $x, $y+$h);
						            }
						                        
						            if (substr_count($current_col[$b]['linearea'], "R") > 0)
						            {
						               $this->Line($x+$w, $y, $x+$w, $y+$h);
						            }
						            
						            
						            // Print the text
						            $this->MultiCell($w, $current_col[$b]['height'], $current_col[$b]['text'], 0, $a, 0);
						            
						            // Put the position to the right of the cell
						            $this->SetXY($x+$w, $y);         
						         }
						         
						         // Go to the next line
						         $this->Ln($h);          
						      }                  
						   }

						   
						   // If the height h would cause an overflow, add a new page immediately
						   function CheckPageBreak($h)
						   {
						      if($this->GetY()+$h>$this->PageBreakTrigger)
						         $this->AddPage($this->CurOrientation);
						   }


						   // Computes the number of lines a MultiCell of width w will take
						   function NbLines($w, $txt)
						   {
						      $cw=&$this->CurrentFont['cw'];
						      if($w==0)
						         $w=$this->w-$this->rMargin-$this->x;
						      $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
						      $s=str_replace("\r", '', $txt);
						      $nb=strlen($s);
						      if($nb>0 and $s[$nb-1]=="\n")
						         $nb--;
						      $sep=-1;
						      $i=0;
						      $j=0;
						      $l=0;
						      $nl=1;
						      while($i<$nb)
						      {
						         $c=$s[$i];
						         if($c=="\n")
						         {
						            $i++;
						            $sep=-1;
						            $j=$i;
						            $l=0;
						            $nl++;
						            continue;
						         }
						         if($c==' ')
						            $sep=$i;
						         $l+=$cw[$c];
						         if($l>$wmax)
						         {
						            if($sep==-1)
						            {
						               if($i==$j)
						                  $i++;
						            }
						            else
						               $i=$sep+1;
						            $sep=-1;
						            $j=$i;
						            $l=0;
						            $nl++;
						         }
						         else
						            $i++;
						      }
						      return $nl;
						   }

}

	// utf8
	// a little line
	function drawLine($pdf)
	{
		$pdf->SetDrawColor(0.1, 0.1, 0.1); 
		$pdf->SetLineWidth(0.25); 
		$pdf->Line(0,$pdf->GetY(), 256, $pdf->GetY()); 
	}
		
	// generate the pdf object
	$pdf = new PDF();
	// First page
	$pdf->AddPage();
	$pdf->SetFont('Helvetica','',9);

	// header
	// $pdf->Image('fhnw_logo_de.png',10,12,30,0,'','http://www.fpdf.org');	
	$pdf->Cell( 100, 200, $pdf->Image("http://web.fhnw.ch/cd/fhnw-logos/fhnw_ph_10mm.jpg", $pdf->GetX(), $pdf->GetY(), 50.78), 0, 0, 'L', false );


	$pdf->WriteHTML("<br><br>");

	// $pdf->WriteHTML("<b>FHWN</b><br>");
	// http://web.fhnw.ch/cd/fhnw-logos/fhnw_ph_10mm.jpg

	// logo
	$serverPath=dirname($_SERVER["PHP_SELF"]);	
	
	// add here
	$image1="http://".$_SERVER["HTTP_HOST"].$serverPath."/imgs/logo_toss.gif";
	$link="http://".$_SERVER["HTTP_HOST"].$serverPath;

	// $pdf->WriteHTML("".$image1);
	// $image1 = "../..";
	$pdf->Cell( 100, 200, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 50.78), 0, 0, 'L', false );
	// drawLine($pdf);

	$pdf->WriteHTML("<br><br><br>");

	// drawLine($pdf);
	// $pdf->WriteHTML("<b>Webseite</b><br><a href='$link'>$link</a>");

	// $pdf->WriteHTML("<br><br>");
	drawLine($pdf);

	// title
	$pdf->WriteHTML("<b>".utf8_decode($excerciseObject->excerciseName)."</b> ");
	$pdf->WriteHTML("<br>");

	// person
	$userObject=$app->session->userObject;
	$pdf->WriteHTML("<br><b>Personendaten</b>");
	$pdf->WriteHTML("<br>".utf8_decode($userObject->userName).", ".utf8_decode($userObject->userPreName));

	// teilaufgaben
	/*
	$pdf->WriteHTML("<br>");
	$pdf->WriteHTML("<br><b>Teilaufgaben</b>");
	drawLine($pdf);
	*/

	// all the tasks
	$arr=$app->getAllActiveExcerciseTasksFromExcercise( $excerciseObject->excerciseId );
	$firstOpen=true;
	for ($i=0;$i<count($arr);$i++)
	{
		$obj=$arr[$i];

// $pdf->WriteHTML("<br>TYPE [".$obj->excercisetaskType."]");		

		$inPDF=false;

		// in pdf?
		$excerciseinpdf=$app->getAdminExcerciseTaskAttributeInt( $obj->excercisetaskId, "excercisetaskexcerciseinpdf", 0);
		if ($excerciseinpdf==1) $inPDF=true;

		// taskname
		if ($inPDF)
		{

			// new pages
			// > take this to the admin!
			$newPage=false;

			if ($obj->excercisetaskType=="selfevaluation") $newPage=true;
			if ($obj->excercisetaskType=="otherevaluation") $newPage=true;

			if ($newPage) $pdf->AddPage();


			$pdf->WriteHTML("<br>");
			$pdf->WriteHTML("<br><b>".utf8_decode($obj->excercisetaskName)."</b><br>");
			drawLine($pdf);


			// use pdfs ...
			$readtextObj=$app->getTaskRemarkTextByTaskRef( $obj->excercisetaskId );
			$text=$readtextObj->taskremarktextDescription;
			

			$displayText=false;

			if ($obj->excercisetaskType=="start") $displayText=true;



			if ($displayText) $pdf->WriteHTML("<br>".html_entity_decode(utf8_decode($text))."<br>");

			if ($obj->excercisetaskType=="start")
			{
				// $pdf->WriteHTML("".Display::displayQuestionnaire( $app, $obj->excercisetaskId, "html", $app->getSessionUserId() ));

			}

			

			// do the pdf thing
			if ($obj->excercisetaskType=="questionnaire")
			{
				$str=Display::displayQuestionnaire( $app, $obj->excercisetaskId, "htmlpdf", $app->getSessionUserId() );
				$pdf->WriteHTML("".utf8_decode($str));

			}

			// write text
			if ($obj->excercisetaskType=="writetext")
			{

				$textInput="Kein Text gefunden.";

				// $pdf->AddPage();

				$arrTextObjs=$app->getTaskWriteTextDocumentsByTaskAndUser($obj->excercisetaskId,$userObject->userId);
				// print_r($arrTextObjs);
				if (count($arrTextObjs)>0)
				{
					$objDocument=$arrTextObjs[0];
					$textDate="".$objDocument->taskwritetextdocumentDateCreate;
					$textInput="".$objDocument->taskwritetextdocumentText;
					
					$pdf->WriteHTML("<br><i>".html_entity_decode(utf8_decode($textDate))."</i><br>");

					// $pdf->Write(html_entity_decode(utf8_decode($textInput)));
					// <div> </div> > <br />
					$textInput=str_replace("<div ","<br ",$textInput);
					$textInput=str_replace("<p>","<br>",$textInput);
					$textInput=str_replace("<b>","<strong>",$textInput);
					$textInput=str_replace("</b>","</strong>",$textInput);
					// $textInput=str_replace("<","",$textInput);
					// $textInput=str_replace(">","",$textInput);

					$pdf->WriteHTML("<br><i>".html_entity_decode(utf8_decode($textInput))."</i><br>");
				}

			}

			// otherevaluation
			// $pdf->WriteHTML("----".$obj->excercisetaskType);
			if ($obj->excercisetaskType=="otherevaluation")
			{

				$textInput="Fremdbeurteilung";

					Display::displayFramework($app,$obj->excercisetaskId,"other",-1, $pdf);	
					// $pdf->WriteHTML("<br>DisplayFrameworkDone<br>");

				$pdf->WriteHTML("<br><br>");

			}

			// selfevaluation
			if ($obj->excercisetaskType=="selfevaluation")
			{

				$textInput="Eigenbeurteilung";

					Display::displayFramework($app,$obj->excercisetaskId,"self",-1, $pdf);	
					// $pdf->WriteHTML("<br>DisplayFrameworkDone<br>");

				$pdf->WriteHTML("<br><br>");

			}

			// other evaluation
			if ($obj->excercisetaskType=="result")
			{

				$textInput="Resultate";

					Display::displayFramework($app,$obj->excercisetaskId,"both",-1, $pdf);	
					// $pdf->WriteHTML("<br>DisplayFrameworkDone<br>");

				$pdf->WriteHTML("<br><br>");

			}




		}


	}




	$pdf->Output();


?>
	
?>
