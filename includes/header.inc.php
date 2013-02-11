<?

    // index.php > appinstance.php > header.inc.php!
    // something not here

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html lang="en-US" xml:lang="en-US" xmlns="http://www.w3.org/1999/xhtml">
<html>

<meta content="text/html; charset=UTF-8" http-equiv="Content-Type"/>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

<title><?=$app->getConfigValueByName("name")?> - <?=$app->getConfigValueByName("description")?></title>

<!-- css -->
<link href="styles/default/stylesplatform.css" rel="stylesheet" type="text/css" />

<!-- jquery -->
<script src="jquery.min.js"></script> 
<!-- jquery ui -->
<script src="jqueryui.min.js"></script> 

<!-- add ons -->
<script src="jquery.topzindex.min.js"></script>
<script src="jqueryaddons.js"></script> 

<!-- javascript -->
<script>
    /*
        Debugging
    */
    // debug
    function debug( area, strLog )
    {
        if (typeof console != 'undefined') 
        {
            console.log("["+area+"]:"+strLog);
        }
    }
</script>
<!-- including timeline etc. scripts -->
<script src="jclasses.js"></script> 

<!-- tinymce -->
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">


tinyMCE.init({
        mode : "textareas",
        theme : "advanced"
    /*,
        verify_html : false,
       verify_css_classes : false,
        cleanup : false,
        cleanup_on_startup : false,
        auto_cleanup_word: false,
    */
      // ,
      //  theme_advanced_toolbar_location: "bottom",
      //  valid_children : "+body[style],-body[div],p[strong|a|#text]"
      //  content_css : "tinymceaddons.css"
});


// imachinaText
/*
tinyMCE.init({
    mode : "none", // none
    theme : "advanced", // 
    // editor_selector : "tinymceRtf",
    plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable",
        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        // theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
    width: "100%"
    //,height: "400"    
});
*/

// simple ... 
/*
tinyMCE.init({
    mode : "none", // none
    theme : "advanced", // 
    // editor_selector : "tinymceRtf",
    plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager,filemanager",
        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        // theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
    width: "100%"
    //,height: "400"    
});

*/
/*
// rtf
tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",

        editor_selector : "tinymceRtf",
        // name for the selector

        // theme_advanced_disable : "image,anchor,link,unlink,bullist,tablet,separator,insertdate,inserttime,preview,zoom,separator,forecolor,backcolor,bullist,separator,outdent,indent,separator,separator,hr,removeformat,visualaid,separator,sub,sup,separator,charmap",
        plugins : "paste",
        // valid_elements : "p[br|strong|b],strong/b,br[strong|b]",
        //theme_advanced_buttons1 : "bold,redo,undo",
        //theme_advanced_buttons2 : "",
        //theme_advanced_buttons3 : "",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_resizing : true,

        paste_auto_cleanup_on_paste : true,

        // width : "730",
        // height: "400",

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",
      
        content_css : "stylestinymce.css",
        // convert_fonts_to_spans : false,
        //  theme_advanced_font_sizes: "x-large",
        //  font_size_classes : "16px,16px,16px,16px,16px,16px,16px",
        // Example content CSS (should be your site CSS)
        // content_css : "css/example.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",

        // on init
       // oninit : tinymceInitDone,

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
        

});
*/
/*
// html
tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",

        editor_selector : "tinymceHtml",
        // name for the selector

        // theme_advanced_disable : "image,anchor,link,unlink,bullist,tablet,separator,insertdate,inserttime,preview,zoom,separator,forecolor,backcolor,bullist,separator,outdent,indent,separator,separator,hr,removeformat,visualaid,separator,sub,sup,separator,charmap",
        plugins : "paste",
        // valid_elements : "p[br|strong|b],strong/b,br[strong|b]",
        //theme_advanced_buttons1 : "bold,redo,undo",
        //theme_advanced_buttons2 : "",
        //theme_advanced_buttons3 : "",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_resizing : true,

        paste_auto_cleanup_on_paste : true,

        // width : "730",
        // height: "400",

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",
      
        content_css : "stylestinymce.css",
        // convert_fonts_to_spans : false,
        //  theme_advanced_font_sizes: "x-large",
        //  font_size_classes : "16px,16px,16px,16px,16px,16px,16px",
        // Example content CSS (should be your site CSS)
        // content_css : "css/example.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",

        // on init
       // oninit : tinymceInitDone,

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
        

});
*/

</script>

<script>



    
    /*

        Load Content 
    */

    /*

        [contentContainer][userContainer]

        // in a container
        // edit/add/rule
        Overlays:
        - Edit: []
        - Rule: [dialogCommandOnObjectRuleContainer]
        - Add: []
        
    */


    // load 
    <?
        // todo: optimize this!
        // todo: security
        $textobjectId=$app->requestFromWebExt( "id", "int", -1 );

        // check if is existing
        // $textojbectObj=$app->getTextObjectById($textobjectId);
        // if ($textojbectObj==null) $textobjectId=-1;

    ?>
    var actualThreadId=<?=$textobjectId?>;
    // alert("textobjectId "+actualThreadId);
    var loadDivMode="onediv"; // onediv/twodivs
    function loadContent( threadId, contentType )
    {
            // hide dialog!
            hideSystemDialog();

            // todo: check here but not in all cases! ...
            // hide also add ...
            // edit ... 
            actualThreadId=threadId;


        // load content
        loadContentExtended( threadId, contentType, true );
    }

    function reloadContent( contentType )
    {
        hideSystemDialog();
        loadContentExtended( actualThreadId, contentType, false );
    }

    function loadContentExtended( threadId, contentType, flagHistory )
    {
        actualThreadId=threadId;

        var containerDiv="contentContainer";
        var userDiv="userContentThread"; // use sub of the usercontainer

        // alert("loadContent( "+threadId+", "+contentType+" )"+flagHistory);

        // todo
        // 2 different histories ...
        // or only a history for content? 

        // load 
        if (loadDivMode=="onediv")
        {
            // alert("loadContent( "+threadId+", "+flagContentDiv+" )");
            var mergedcontenttype="content";
            loadThreadIdToDiv(threadId,containerDiv,contentType,flagHistory);
        }
        
        if (loadDivMode=="twodivs")
        {
            if (contentType=="content") loadThreadIdToDiv(threadId,containerDiv,contentType, flagHistory);
            if (contentType=="user")
            {
                
                <? if ($userId!=-1) echo("setUserFunctionality('content');"); ?>
               loadThreadIdToDiv(threadId,userDiv, contentType, flagHistory);
            }
        }

        // disable some overall dialogs
        $('#dialogCommandOnObjectRuleContainer').hide();

        // scroll to top
        $('html, body').animate({ scrollTop: 0 }, 'fast');
        
    }


            // load the thread here ...
            function loadThreadIdToDiv( threadId, divx, contentType, flagHistory )
            {   
                // alert("loadThreadIdToDiv( "+threadId+","+divx+", "+contentType+","+ flagHistory+") ");

                // add to
                var url="webservice.rest.php?area=thread&action=get&actionsub=view&textobjectId="+threadId; 
                var urlInBrowser="index.php?id="+threadId;
                if (threadId==-1) urlInBrowser="index.php";

                // todo: loading content here - simple animation ...
                height=$('.'+divx).height();
                // alert("height ("+divx+")"+height);
                $("."+divx).html("<div class='containerLoad' style='height: "+height+"px'>loading...</div>");
                
                // alert(""+url+"("+divx+")");
                $("."+divx).load(url);
                // loaded > show ... 

                // alert("done...");

                // change url in browser
                // problem title etc ... 
                // todo: getname of : ....

                // get history .. 
                // add this for history
                if (flagHistory) 
                {
                    var newObj=addHistoryObject( threadId, contentType, urlInBrowser, contentType );
                    var newStateObj={ 'id': newObj.id };
                    window.history.pushState(newStateObj,"TODO:TITLE", urlInBrowser);  
                }              
            }

    /*
        login/logout
    */
    // login -> appinstance.php
    function logOut()
    {
        var locationURLPart="";
        if (actualThreadId!=-1) locationURLPart="&id="+actualThreadId;
        // alert("actualThreadId"+actualThreadId);
        document.location.href='index.php?action=logout'+locationURLPart;
    }

    /*
        Back & Forward-History 

        Javascript GOTO
        Loading
        History etc.
    */
    
      var historyId=0;

        var arrHistoryLoadedObjects=new Array();
         // class for the history
        var LoadedObject = function()
        {
            var id=-1;
            var textobjectId=-1
            var contentType=""; // contentType
            var time=new Date();
            var url="";
        };       

        function addHistoryObject( textobjectId, contentType, iurl ) 
        { 
            historyId++; 

            var newObj=new LoadedObject();   
                newObj.id=historyId;
                newObj.textobjectId=textobjectId;
                newObj.contentType=contentType;
                newObj.url=iurl;

            arrHistoryLoadedObjects[arrHistoryLoadedObjects.length]=newObj;

            // alert("addHistoryObject( "+textobjectId+", "+contentType+", "+iurl+" )");

            // debug list
            // alert(""+debugHistory());

            debug("history","add id="+arrHistoryLoadedObjects.length);
            debug("history","add "+debugHistory());


            return newObj;
        }
            function debugHistory()
            {
                var str="History: ";

                if (arrHistoryLoadedObjects.length>0)
                for (var z=0;z<arrHistoryLoadedObjects.length;z++)
                {
                    var histTemp=arrHistoryLoadedObjects[z];
                    str=str+"\n "+histTemp.id+" ("+histTemp.contentType+") "+histTemp.textobjectId;
                }

                return str;
            }

        function getHistoryObjectById( id )
        {
            var histTemp;
            if (arrHistoryLoadedObjects.length>0)
            for (var z=0;z<arrHistoryLoadedObjects.length;z++)
            {
                histTemp=arrHistoryLoadedObjects[z];
                if (histTemp.id==id) return histTemp;
            }

            return null;
        }

    // add first object
    // todo: fix ... this
    // if (actualThreadId!=-1) 
    addHistoryObject( actualThreadId, "content", "text/html" );


     // patch back&forward  ...  
     window.onpopstate = function(e){
            // alert(e.state);
            if(e.state){
                
                // alert("onpopstate()");
                // debug stats
                debug("history",debugHistory());

                // the id
                if (e.state.id!=null)
                {
                    var backhistoryId=e.state.id;
                    // alert("history.onpopstate "+e.state.id);
                    var histObj=getHistoryObjectById( backhistoryId );
                    // alert(""+histObj);
                    if (histObj!=null)
                    {
                        // load back
                        // alert("onpopstate() "+histObj.id+" --- "+ histObj.contentType);
                        loadContentExtended( histObj.textobjectId, histObj.contentType, false ); // no history
   
                        // history back
                       debug("history","found "+histObj.textobjectId+": "+histObj.textobjectId );

                    }
                    else 
                    {
                        debug("history","back.notfound");
                        loadContentExtended( -1, "content", false ); // no history
   
                    }
 
 
                }
                else debug("history","no.id.notfound");
            }
        };

    /*
        TextComments 
        (render Text etc)

        Selections
    */
    // instance of the manager ...
    var imachinaTextManager=new imachinaTextManager();
        
        /*
            textCommentToggle(

        */
        function onTextCommentToggle( textobjectId )
        {
            alert("textobjectId: "+textobjectId);
        }

        /*
            actual
        */
        // selection mode [insert][update?]
        var textobjectSelectionMode="insert";

        // actual action type
        var textobjectSelectionType="cursorA"; // cursorA default | cursorB

        // selected text
        var textobjectSelection=new TextObject();
            textobjectSelection.textobjectId=15001; // default
            textobjectSelection.textobjectRef=3132; // default

            textobjectSelection.textobjectTextWordAttribute.colorRed=255;
            textobjectSelection.textobjectCursorA=-1;
            textobjectSelection.textobjectCursorB=-1;
        // add this component here ...
        imachinaTextManager.addTextComment(textobjectSelection);    
        
        // debug
        var debugComments=imachinaTextManager.debugTextComments();
        // console.debug(""+debugComments);  

        function onTextWorkflowStart()
        {
            textobjectSelectionType="cursorA";
            textobjectSelection.textobjectCursorA=-1;
            textobjectSelection.textobjectCursorB=-1;           
        }


        // 
        function onTextCommand( insertOrUpdate, textobjectId, actionType )
        {
            // if action type==
            alert("onTextCommand( "+insertOrUpdate+", "+textobjectId+", "+actionType+" )");

            if (actionType=="clear")
            {
                onTextWorkflowStart();
                imachinaTextManager.renderTextObjectById(textobjectSelection.textobjectRef);   
            }
        }

        // todo: remove this here ... 
        function onTextClick( textobjectId, textId )
        {
            var debugThis=true;

            // alert("onTextClick( "+textobjectId+","+ textId+")");
            if (debugThis) debug("onTextClick","onTextClick("+textobjectId+","+textId+")");

            // ref ...
            
            // clear
            if (textobjectId!=textobjectSelection.textobjectRef)
            {
                if (debugThis) debug("onTextClick","newTextObject selected");


  /*              textobjectSelection.textobjectCursorA=-1;
                textobjectSelection.textobjectCursorB=-1;

                imachinaTextManager.clearCommentAttributesForId( textobjectSelection.textobjectRef );
*/
                onTextWorkflowStart()
        


                // todo: render old now !!! if available!
                var textobjectNotAnymoreId=textobjectSelection.textobjectRef;

                // change 
                textobjectSelection.textobjectRef=textobjectId;
                imachinaTextManager.renderTextObjectById(textobjectNotAnymoreId);   

            }

            if (textobjectSelection.textobjectCursorA==-1)
            {
                if (debugThis) debug("onTextClick","set first selected word");

                textobjectSelection.textobjectCursorA=textId;
                
                // open directly the add-dialog here! - evtl. addtextcomment
                doCommandTextObject(textobjectSelection.textobjectRef,'addtextmark','imt'+textobjectId+'_'+textId);
            }
            else
            {
                // version 2.0
                if (debugThis) debug("onTextClick","select second word");

                // first entry of cursor b
                
                var indexNewCursorA=imachinaTextManager.getIndexOfWordId(textobjectSelection.textobjectRef,textobjectSelection.textobjectCursorA);
                var indexNewCursorB=imachinaTextManager.getIndexOfWordId(textobjectSelection.textobjectRef,textId);

                if (textobjectSelection.textobjectCursorB==-1)
                {
                    // cursorB is less than cursorA > cursorA=cursorB > cursorB = -1
                    if (debugThis) debug("onTextClick","first selction of 2nd word");
                    
                    if (indexNewCursorB!=-1)
                    {

                        if (indexNewCursorB<indexNewCursorA)
                        {
                            if (debugThis) debug("onTextClick"," ? [   ");
                            // B < A 
                            textobjectSelection.textobjectCursorA=textId;
                            alert("smaller now!!!");
                        }
                        else
                        {
                            if (debugThis) debug("onTextClick"," [  ? ");
                            // cases 
                            textobjectSelection.textobjectCursorB=textId;
                        }
                    
                    }
                }
                else
                {
                // both are filled in > update !
                    if (debugThis) debug("onTextClick"," [  |  ] ? ");

                       // cases:  NewClick1 [A  NewClick2   |MidAB|  NewClick3  B] NewClick4 
                    var indexNewCursorA=imachinaTextManager.getIndexOfWordId(textobjectSelection.textobjectRef,textobjectSelection.textobjectCursorA);
                    var indexNewCursorB=imachinaTextManager.getIndexOfWordId(textobjectSelection.textobjectRef,textobjectSelection.textobjectCursorB);
                    var indexNewCursorMidAB=(indexNewCursorA+indexNewCursorB)/2;
                    var indexNewCursorNewClick=imachinaTextManager.getIndexOfWordId(textobjectSelection.textobjectRef,textId);

                        // frame
                        if ((indexNewCursorA!=-1)&&(indexNewCursorB!=-1))
                        {
                              var parsed=false;

                              // case NewClick1
                              if (indexNewCursorNewClick<indexNewCursorA) 
                              { 
                                textobjectSelection.textobjectCursorA=textId;                     
                                if (debugThis) debug("onTextClick"," * [  |  ]");
                                parsed=true;
                              }

                              // case NewClick4
                              if (indexNewCursorNewClick>indexNewCursorB) 
                              { 
                                textobjectSelection.textobjectCursorB=textId; 
                                parsed=true;   
                                if (debugThis) debug("onTextClick","[  |  ]*");
                              }


                              // case NewClick2
                              if (!parsed)
                              {
                                  if (indexNewCursorNewClick<indexNewCursorMidAB)
                                  {
                                    if (debugThis) debug("onTextClick","[ * |  ]");
                                      textobjectSelection.textobjectCursorA=textId; 
                                  }
                                  // case NewClick3
                                  else
                                  {
                                    if (debugThis) debug("onTextClick","[  | * ]");
                                      textobjectSelection.textobjectCursorB=textId;
                                  }

                              }
                        }

                }
                // alert("WordIndexOfNewWord: "+);

                // version 1.0
                //if (textobjectSelection.textobjectCursorA!=-1) 
                //{
                    /*
                    if (selectionRangeA<selectionRangeB) selectionRangeB=textId;
                    else
                    if (selectionRangeA>selectionRangeA) selectionRangeA=textId;
                    */
                    //textobjectSelection.textobjectCursorB=textId;

                //}
            }
            // alert("onTextClick( "+textobjectId+","+ textId+")");
            // showTextSelection();
            // todo: deselect old version
            // console.debug("onTextClick() "+textobjectSelection.textobjectCursorA+"  "+textobjectSelection.textobjectCursorB);

            // todo: push this to dialog divs!
            // if (textobjectSelectionMode=="insert")
            // {

                  // alert("---"+$("#FormAddDatatextobjectCursorA").val());
                  $("#FormAddDatatextobjectCursorA").val(textobjectSelection.textobjectCursorA);
                  $("#FormAddDatatextobjectCursorB").val(textobjectSelection.textobjectCursorB);
            // }

            // render 
            imachinaTextManager.renderTextObjectById(textobjectSelection.textobjectRef);
            debug("imachnaTextManager",imachinaTextManager.debugText()+"\n"+imachinaTextManager.debugTextComments());
            

        }

    /*
            
        Spec. Actions OnTextObjects
        
    */
            // commands
            <? $textobjectviewObj=new TextObjectView(); ?>    
            var diffPrefix="<?=$textobjectviewObj->getDivIdBase()?>";
            var divIdAttach="";
            function doCommandTextObject( textobjectId, command, divId )
            {
                // diff here .. 
                divIdAttach=divId;

                var divTextobjectId=diffPrefix+textobjectId;
                // divIdAttach=divTextobjectId;

                // alert('doCommandTextObject( '+textobjectId+', '+command+', '+divId+' )');
                tinyMCE.execCommand('mceRemoveControl', false, 'FormAddDatatextobjectArgument');
                tinyMCE.execCommand('mceRemoveControl', false, 'FormEditDatatextobjectArgument');

                if (command=='edit')
                {
                    updateObject.textobjectId=textobjectId;

                    //$('#detailComponentFormAdd').hide();
                    if (divIdAttach!="") setDivPositionToDiv( 'detailComponentFormEdit', divIdAttach );
                    $('#detailComponentFormEdit').show();
                    $('#detailComponentFormEdit').css( 'z-index',$.topZIndex()+10);
                    $('#detailComponentFormEdit').html( "<div class='dialogCommandOnObjectRuleContainerEventLoading'>loading</div>" );

                    var url='webservice.rest.php?area=textobjectdetail&action=update&actionsub=form&textobjectId='+textobjectId; 
                    $('#detailComponentFormEdit').load(url);
                }

                // add 
                if (command=='add')
                {
                    if (divIdAttach!="") setDivPositionToDiv( 'detailComponentFormAdd', divIdAttach );
                    //$('#detailComponentFormEdit').hide();
                    $('#detailComponentFormAdd').show();
                    $('#detailComponentFormAdd').css( 'z-index',$.topZIndex()+10);
                    //    selectAdd( textobjectId, 'text', 'rtf', '' )
                    $('#detailComponentFormAdd').html( "<div class='dialogCommandOnObjectRuleContainerEventLoading'>loading</div>" );
                    selectTextObjectAdd( textobjectId, 'text', 'plain', '' );
                }

                         // addthread
                        if (command=='addthread')
                        {
                            if (divIdAttach!="") setDivPositionToDiv( 'detailComponentFormAdd', divIdAttach );
                            //$('#detailComponentFormEdit').hide();
                            $('#detailComponentFormAdd').show();
                            $('#detailComponentFormAdd').css( 'z-index',$.topZIndex()+10);
                            //    selectAdd( textobjectId, 'text', 'rtf', '' )
                            $('#detailComponentFormAdd').html( "<div class='dialogCommandOnObjectRuleContainerEventLoading'>loading</div>" );
                            selectTextObjectAdd( textobjectId, 'thread', 'plain', '' );
                        }
                    
                    if (command=='addpostit')
                    {
                        if (divIdAttach!="") setDivPositionToDiv( 'detailComponentFormAdd', divIdAttach );
                        //$('#detailComponentFormEdit').hide();
                        $('#detailComponentFormAdd').show();
                        $('#detailComponentFormAdd').css( 'z-index',$.topZIndex()+10);
                        $('#detailComponentFormAdd').html( "<div class='dialogCommandOnObjectRuleContainerEventLoading'>loading</div>" );
                        selectTextObjectAdd( textobjectId, 'text', 'plain', 'visual' );
                    }
                    
                    // textmark mode
                    if (command=='addmarkmode')
                    {
                        // alert("markmode "+textobjectId);
                        updateObject.textobjectId=textobjectId;
                        // do we have to change or is it change?
                        reloadTextObject( textobjectId, "coremarkmode" );  

                        $('#'+divId).hide();                      
                        $('#'+divId+"Mode").show();                      
                    } 

                    if (command=='addmarkmodeclose')
                    {
                        // alert("markmode "+textobjectId);
                        updateObject.textobjectId=textobjectId;
                        // do we have to change or is it change?
                        reloadTextObject( textobjectId, "core" );                        

                        $('#'+divId).show();                      
                        $('#'+divId+"Mode").hide();                      
                    } 

                    // add a textmark!
                     if (command=='addtextmark')
                    {
                         if (divIdAttach!="") setDivPositionToDiv( 'detailComponentFormAdd', divIdAttach );
                        //$('#detailComponentFormEdit').hide();
                        $('#detailComponentFormAdd').show();
                        $('#detailComponentFormAdd').css( 'z-index',$.topZIndex()+10);
                        $('#detailComponentFormAdd').html( "<div class='dialogCommandOnObjectRuleContainerEventLoading'>loading</div>" );
                        selectTextObjectAdd( textobjectId, 'text', 'plain', 'text' );
                   }


                if (command=='timeline')
                {
                    $('#'+divTextobjectId+'Timeline').toggle(); 
                }


                if (command=='comments')
                {
                    $('#'+divTextobjectId+'Comments').slideToggle('fast');
                }


            }
                    function setDivPositionToDiv( divNameToSet, divNameToPositionAt )
                    {
                        var pos=$('#'+divNameToPositionAt).position();

                        // alert(pos);
                            var offsetX=50;
                            var offsetY=-70;
                        // version 1.0
                        //var posx=pos.left+offsetX; // alert("posx"+posx);
                        //var posy=pos.top+offsetY;
                        var posx=$('#'+divNameToPositionAt).offset().left+offsetX; // alert("posx"+posx);
                        var posy=$('#'+divNameToPositionAt).offset().top+offsetY;

                        /*
                            var width=$('#'+divToPositionAt).width();
                            var height=$('#'+divToPositionAt).height();
                        posx=posx+width;
                        */
                        // posy=posy+height;
                        // alert("doCommandOnTextObject(action,textobjectId,divId) "+posx+" "+posy+"  "+width+"  "+height);
                        // actualRuleDialogId=textobjectId;
                        //  actualRuleDialogDivId=divId;
                        $('#'+divNameToSet).css("left",posx+"px");
                        $('#'+divNameToSet).css("top",posy+"px");


                        // add loading here ...
                        // $('#dialogCommandOnObjectRuleContainer').html("<div class='dialogCommandOnObjectRuleContainerEventLoading'>loading</div>");
                    }
             
                         
                      function reloadTextObject( textobjectId, typ )
                      { 
                           // alert("reloadTextObject() "+textobjectId+"-"+typ);
                           //alert("reloadTextObject() "+textobjectId+"-"+typ);

                            var divTextobjectId=diffPrefix+textobjectId;
                            if (typ=='core') 
                            { 
                              var url='webservice.rest.php?area=textobjectdetail&action=get&actionsub=core&textobjectId='+textobjectId; /* alert('reload '+url); */ 
                              $('#'+divTextobjectId+'Core').load(url);  return; 
                            } 
                                // case not yet marked at all !                                
                                if (typ=='coremarkmode') 
                                { 
                                  var url='webservice.rest.php?area=textobjectdetail&action=get&actionsub=coremarkmode&textobjectId='+textobjectId; /* alert('reload '+url); */ 
                                  $('#'+divTextobjectId+'Core').load(url);  return; 
                                } 
                            if (typ=='listview') 
                            { 
                                var url='webservice.rest.php?area=textobjectdetail&action=get&actionsub=listview&textobjectId='+textobjectId; /*  alert('reload '+url); */  
                                $('#'+divTextobjectId).load(url); return;   
                            } 

                            if (typ=='listview') 
                            { 
                                var url='webservice.rest.php?area=textobjectdetail&action=get&actionsub=listview&textobjectId='+textobjectId; /*  alert('reload '+url); */  
                                $('#'+divTextobjectId).load(url); return;   
                            } 

                                // components
                                if (typ=='timeline') 
                                { 
                                    var url='webservice.rest.php?area=textobjectdetail&action=get&actionsub=timeline&textobjectId='+textobjectId; /*  alert('reload '+url); */  
                                    // iTextObjectDetail1380Timeline 
                                    $('#'+diffPrefix+textobjectId+"Timeline").load(url); 

                                    // show here!
                                    $('#'+diffPrefix+textobjectId+"Timeline").show(); 
                                    
                                    return;   
                                } 

                                    // parenttimeline
                                    if (typ=='parenttimeline') 
                                    { 
                                        var url='webservice.rest.php?area=textobjectdetail&action=get&actionsub=parenttimeline&textobjectId='+textobjectId; /*  alert('reload '+url); */  
                                        // iTextObjectDetail1380Timeline 
                                        
                                        // alert('#'+diffPrefix+textobjectId+'Timeline');

                                        $('#'+diffPrefix+textobjectId+'Timeline').load(url); return;   
                                    } 


                    //           $('#".$this->getDivId()."Core').load('webservice.rest.php?area=textobjectdetail&action=get&actionsub=core&textobjectId=".$this->textobjectObject->textobjectId."');  
                    //           alert('reload not found '+typ);
                      }                
                                  


                        /*
                            add dialog
                        */
                        var addSelectObject=new TextObject();
                        function selectTextObjectAdd( textobjectId, type, typesub, commentType ) // commentType: "" (AddComment) | "visual" (VisualComment)
                         {
                              addSelectObject.textobjectRef=textobjectId; 
                              addSelectObject.textobjectType=type; 
                              addSelectObject.textobjectTypeSub=typesub;
                              if (commentType!='*') addSelectObject.textobjectCommentType=commentType; 

                              // textcomment
                              addSelectObject.textobjectCursorA=textobjectSelection.textobjectCursorA;
                              addSelectObject.textobjectCursorB=textobjectSelection.textobjectCursorB;

                              // textcomment
                              // if (commentType=="text") alert("cursorA:"+addSelectObject.textobjectCursorA);

                              // alert('textobjectCommentType='+$javascriptObj.textobjectCommentType); 
                             loadTextObjectAdd( textobjectId ); 
                         } 

                             // todo!
                             function loadTextObjectAdd( textobjectId ) // commentType: "" (AddComment) | "visual" (VisualComment)
                             {

                                    var url='webservice.rest.php?area=textobjectdetail&action=insert&actionsub=form&textobjectType='+addSelectObject.textobjectType+'&textobjectTypeSub='+addSelectObject.textobjectTypeSub+'&textobjectRef='+addSelectObject.textobjectRef+'&textobjectCommentType='+addSelectObject.textobjectCommentType+'&textobjectCursorA='+addSelectObject.textobjectCursorA+'&textobjectCursorB='+addSelectObject.textobjectCursorB; 
                                    // ."&textobjectPositionX='+x+'&textobjectPositionY='+y; 
                                     // alert(''+url); 
                                    // alert(\"select".$this->getDivId()."FormAdd( type, typesub )\"+url);
                                    $('#detailComponentFormAdd').load(url);
                             }


                                     function insertTextObject( textobjectRef, commentType, argumentEditor  )
                                     {
                                        var divTextobjectIdBase=diffPrefix+textobjectRef;

                                        // alert('insertTextObject( '+textobjectRef+', '+commentType+', argumentEditor: '+argumentEditor+' )');
                                        
                                        var textobjectRef=$('#FormAddDatatextobjectRef').val();

                                        // alert("insertTextObject() "+textobjectRef);
                                        
                                        var textobjectArgument=$('#FormAddDatatextobjectArgument').val();

//                                         alert("textobjectArgument: "+textobjectArgument);

                                        // simple form
                                        // if ($this->textobjectArgumentEditor=="form")
                                        /*
                                        if (argumentEditor=="form")
                                        {   
                                               textobjectArgument=$('#FormAddDatatextobjectArgument').val();
                                        }
                                        */

                                        // tinymce
                                        // check if tinymce
                                        
                                        var tinymceObject=tinyMCE.get('FormAddDatatextobjectArgument');
                                        // tinymce object
                                        if ((tinymceObject+"")!="undefined")
                                        {
                                            textobjectArgument=tinyMCE.get('FormAddDatatextobjectArgument').getContent();                                             
                                            // todo: creates strange behavior here - if you don't remove it!
                                            // 
                                        }

// todo: problem ... overwrite ... always the same ... 
if (tinyMCE.getInstanceById('FormAddDatatextobjectArgument'))
{
    tinyMCE.execCommand('mceFocus', false, 'FormAddDatatextobjectArgument');                    
    tinyMCE.execCommand('mceRemoveControl', false, 'FormAddDatatextobjectArgument');
}

                                        /*
                                        if (argumentEditor=="tinymce")
                                        {   
                                            //     tinyMCE.triggerSave(); 
                                               // alert('tinymce '+textobjectArgument);  
                                        }
                                        */

                                        // alert("textobjectArgument: "+textobjectArgument);


                                           textobjectType=$('#FormAddDatatextobjectType').val();
                                           textobjectTypeSub=$('#FormAddDatatextobjectTypeSub').val();
                                           textobjectCommentType=$('#FormAddDatatextobjectCommentType').val();

                                        // iObjectDetail338FormDatatextobjectPositionXAddVisual
                                           textobjectPositionX=$('#FormAddDatatextobjectPositionX').val();
                                           textobjectPositionY=$('#FormAddDatatextobjectPositionY').val();

                                           textobjectCursorA=$('#FormAddDatatextobjectCursorA').val();
                                           textobjectCursorB=$('#FormAddDatatextobjectCursorB').val();

                                        // alert("insertTextObject() textobjectArgument= "+textobjectArgument+" textobjectType="+textobjectType+" / textobjectTypeSub="+textobjectTypeSub+" textobjectCommentType="+textobjectCommentType);
                                        
                                           $.ajax({
                                            url: 'webservice.rest.php',
                                            post: 'post',
                                            data:  { area: 'textobjectdetail', action: 'insert', actionsub: '', textobjectRef: textobjectRef, textobjectType: textobjectType,  textobjectTypeSub: textobjectTypeSub, textobjectCommentType: textobjectCommentType,  textobjectPositionX: textobjectPositionX, textobjectPositionY: textobjectPositionY,  textobjectArgument: textobjectArgument, textobjectCursorA: textobjectCursorA, textobjectCursorB: textobjectCursorB  },
                                            context: document.body
                                           }).done(function( result ) { 

                                               // alert('insert a new record '+result); 
                                            
                                            //      $('#".$this->getDivId()."Core').load('webservice.rest.php?area=textobjectdetail&action=get&actionsub=core&textobjectId=".$this->textobjectObject->textobjectId."');
                                            
                                                 if (result.indexOf('error')!=-1) { alert('Error in creating!'+result); return; }  
                                                 if (result.indexOf('error')==-1) {
                                                        var newId=result; 
                                                    // insert normal comment (add below)

                                                        // alert("textobjectType: "+textobjectType+" commentType=/"+commentType+"/");
                                                        // todo: something else ..
                                                        if (commentType=="") 
                                                        {
                                                             //alert('Add inserted record here: '+'#'+divTextobjectIdBase+'Comments');
                                                             $('#'+divTextobjectIdBase+'Comments').append( $('<div>').load('webservice.rest.php?area=textobjectdetail&action=get&actionsub=listview&textobjectId='+newId, 

                                                                    // load
                                                                    function() 
                                                                    { 
                                                                            // alert("textobjectType: "+textobjectType); 
                                                                            var isThread=false;
                                                                            if (textobjectType=="thread") isThread=true;
                                                                            if (textobjectType=="hyperthread") isThread=true;
                                                                            if (isThread)
                                                                            {

                                                                                // load new content ...
                                                                                // version 1.0
                                                                                // loadContent( newId, "content" );

                                                                                // load actual content again!
                                                                                reloadContent("content");

                                                                            }

                                                                            // scroll there ..
                                                                            if (!isThread)
                                                                            {
                                                                                scrollToTextObjectById( newId );  
                                                                            }
                                                                    } 

                                                                ) );         
                                                        }

                                                        if (commentType=="visual") 
                                                        {
                                                            $('#'+divTextobjectIdBase+'CommentsVisual').append( $('<div>').load('webservice.rest.php?area=textobjectdetail&action=get&actionsub=listviewvisual&textobjectId='+newId) );                                              
                                                        }

                                                        //              $('#".$this->getDivIdBase()."'+newId).css( 'background', '#ffcccc' );
                                                        //     alert('#".$this->getDivIdBase()."'+newId); 
                                                        //          $('#".$this->getDivId()."Comments').append( $('<div>').load('webservice.rest.php?area=textobjectdetail&action=get&actionsub=container&textobjectId='+newId) );
                                                                    // version 1: close the div here .. 
                                                                    $('#detailComponentFormAdd').slideToggle('fast');
                                                                    // version 2 or add on ..: select
                                                                    selectTextObjectAdd( textobjectRef , 'text', 'plain', '*' );


                                                        // todo: case hasMembers > turn into edit if has members!
                                                        // check types!!!
                                                        // alert("Types: "+textobjectType+"/"+textobjectTypeSub);
                                                        var flagEdit=false;
                                                        <?
                                                            // textobjectFrontEndInsertToEditDialog
                                                            // public types
                                                            for ($z=0;$z<count($app->arrPublicTypes);$z++)
                                                            {
                                                                $obj=$app->arrPublicTypes[$z];
                                                                if ($obj->textobjectFrontEndInsertToEditDialog==true) 
                                                                 echo("\n  if ((textobjectType=='".$obj->textobjectType."')&&(textobjectTypeSub=='".$obj->textobjectTypeSub."')) flagEdit=true; ");
                                                            }
                                                        
                                                        ?>
                                                        if (flagEdit)
                                                        {
                                                             doCommandTextObject( newId, "edit", 'detailComponentFormAdd' );

                                                             // move detailComponentFormAdd to the inserted object
                                                        }
                                                        else
                                                        {
                                                            // scroll to inserted object
                                                            // scrollToTextObjectById( newId );
                                                        }


                                                        // scroll to this object ...
                                                        // todo: ?


                                            } // result  
                                            
                                            // error IndexOf()!=-1

                                            });
                                        
                                          // alert('running in background');

                                         //  } 
                                }

                     // scrollToTextObjectById()
                     function scrollToTextObjectById( textobjectId )
                     {

                        // alert("0. scrollToTextObjectById()  "+textobjectId);
                        var divId="#"+getTextObjectDivById(textobjectId);
                        // alert("1. scrollToTextObjectById()  "+textobjectId+"  divId="+divId);
                        // alert("2. scrollToTextObjectById()  "+textobjectId+"  divId="+divId+" offset="+$(divId+"Core").offset());
                        var posY=$(divId).offset().top;
                        // alert("3. scrollToTextObjectById()  "+textobjectId+" divId="+divId+" posY: "+posY);
                        // scroll now to this!

                        // todo: check actual posy and check difference
                        var scrollPosY=$(window).scrollTop();
                        var scrollingHeight = $(window).height();

                        // and some more jquery!
                        // alert("scrollPosY "+scrollPosY);

                        var diff=posY-scrollPosY;
                        if (Math.abs(diff)>scrollingHeight) 
                        {
                            $('html, body').animate({ scrollTop: posY }, 'fast');
                        }
                     }

                        // textobject div > returns div without #!
                        function getTextObjectDivById( textobjectId )
                        {
                            return diffPrefix+textobjectId;
                        }


  
                     // updateObject
                     var updateObject=new TextObject();
                     function updateTextObject( textobjectId, textobjectEditor )
                     {
                            var divTextobjectId=diffPrefix+textobjectId;

                            updateObject.textobjectId=textobjectId;
                           
//                           alert('updateTextObject() '+textobjectId+'--'+textobjectEditor);

                            var textobjectArgument=$('#FormEditDatatextobjectArgument').val();

                            var tinymceObject=tinyMCE.get('FormEditDatatextobjectArgument');
                            // tinymce object
                            if ((tinymceObject+"")!="undefined")
                            {
                                   textobjectArgument=tinyMCE.get('FormEditDatatextobjectArgument').getContent();                                             
                            }


                           // alert('updateTextObject() '+textobjectId+'--'+textobjectEditor+" textobjectArgument="+textobjectArgument);

    <?

    /*
                            // members?
                            // add the second content ...
                            // echo("<br>".$this->textobjectObject->textobjectId.".MODFIY".$this->textobjectObject->textobjectType."/".$this->textobjectObject->textobjectTypeSub." members: ".$this->textobjectObject->hasMembers()."");                                       
                            $memberAddOns="
                            if ($this->textobjectObject->hasMembers())
                            {
                                 for ($m=0;$m<count($this->textobjectObject->arrMembers);$m++)
                                {
                                    // get them and insert them here!
                                    $memberDef=$this->textobjectObject->arrMembers[$m]; 
                                    // viewFormExtendedCoreContentForm( $addDivAction="", $showMemberForms=false ) 
                                    // $str=$str."$m 
                                    if ($memberDef->textobjectObject!=null)
                                    {
                                        //$str=$str."$m 
                                        $memberObject=$memberDef->textobjectObject;
                                        $memberObjectView=$app->getTextObjectViewFor($memberObject, $userId);   
                                        // echo("<pre>");print_r($memberObjectView);echo("</pre>");
                                        $labelName=$memberDef->memberRefName;

                                        // todo tinymce
                                        
                                        // version 1
                                        //    textobjectMember".$labelName."Argument=''+$('#FormDatatextobject".$labelName."').val(); 
                                        // version 2
                                           textobjectMember".$labelName."Argument=''+$('#".$memberObjectView->getDivIdOrRef()."FormDatatextobjectArgument".$labelName."').val(); 
                                        $memberAddOns=$memberAddOns.", textobjectMember".$labelName."Argument: textobjectMember".$labelName."Argument 
                                    
                                    }
                                }
                            }
    */
    ?>


                           // alert('Update".$this->getDivId()."');
                           $.ajax({
                            url: 'webservice.rest.php',
                            post: 'post',
                            data:  { area: 'textobjectdetail', action: 'update', textobjectId: textobjectId, textobjectArgument: textobjectArgument /* $memberAddOns */  },
                            context: document.body
                           }).done(function( result ) { 
                             //alert('saved '+result); 
                             // alert('saved '+result+' ".$this->getId()."  '); 
                        // textobjectdetail 
                        //      $('#".$this->getDivId()."Core').load('webservice.rest.php?area=textobjectdetail&action=get&actionsub=core&textobjectId=".$this->textobjectObject->textobjectId."');
                        //      $('#".$this->getDivId()."Core').load('webservice.rest.php?area=textobjectdetail&action=get&actionsub=core&textobjectId=".$this->textobjectObject->textobjectId."');
                                reloadTextObject( updateObject.textobjectId, 'core' );
                                // reloadTextObject
                                $('#detailComponentFormEdit').hide();
                        
                            });
                      } 

                        // updateTextObjectDetailProperty

                     function updateTextObjectDetailProperty( textobjectId, propertyName )
                     {
                        // alert('updateTextObjectDetailProperty( '+textobjectId+ ','+propertyName+ ')');

                        updateObject.textobjectId=textobjectId;

                        // ask for ...

                        // timea
                           var textobjectTimeA=-1;
                           var textobjectTimeB=-1;
                            // get value
                              if (propertyName=='time') 
                              { 
                               textobjectTimeA=$('#FormEditDatatextobjectTimeA').val();
                               textobjectTimeB=$('#FormEditDatatextobjectTimeB').val();
                               // alert('updateTextObjectDetailProperty( '+propertyName+ ') '+textobjectTimeA+'-'+textobjectTimeB);
                              } 

                               var textobjectTimeLength=-1;
                              if (propertyName=='timelength') 
                              { 
                                 textobjectTimeLength=$('#FormEditDatatextobjectTimeLength').val();
//                               textobjectTimeB=$('#FormEditDatatextobjectTimeB').val();
                                // alert('updateTextObjectDetailProperty( '+propertyName+ ') textobjectTimeLength:'+textobjectTimeLength);
                              } 

                        // size ...
                           var textobjectWidth='';
                           var textobjectHeight='';
                            // get value
                              if (propertyName=='size') 
                              { 
                                textobjectWidth=$('#FormEditDatatextobjectWidth').val();
                                textobjectHeight=$('#FormEditDatatextobjectHeight').val();
                            //    alert('updateDetail".$divId."Property( '+propertyName+ ') '+textobjectTimeA+'-'+textobjectTimeB);
                              } 

                        // position ...
                           var textobjectPositionX=-1;
                           var textobjectPositionY=-1;
                            // get value
                              if (propertyName=='position') 
                              { 
                                textobjectPositionX=$('#FormEditDatatextobjectPositionX').val();
                                textobjectPositionY=$('#FormEditDatatextobjectPositionY').val();
                            //    alert('updateDetail".$divId."Property( '+propertyName+ ') '+textobjectTimeA+'-'+textobjectTimeB);
                              } 


                                                                        

                           $.ajax({
                            url: 'webservice.rest.php',
                            post: 'post',
                            data:  { area: 'textobjectdetail', action: 'update', actionsub: propertyName, textobjectId: textobjectId, textobjectTimeA: textobjectTimeA, textobjectTimeB: textobjectTimeB, textobjectWidth: textobjectWidth, textobjectHeight: textobjectHeight, textobjectPositionX: textobjectPositionX, textobjectPositionY: textobjectPositionY, textobjectTimeLength: textobjectTimeLength },
                            context: document.body
                           }).done(function( result ) { 

                            // alert('saved ('+propertyName+') '+result); 
                             // alert('saved '+result+' - ".$this->getId()."  '); 
 
 // reloadTextObject( textobjectId, 'listview' );

                              if (propertyName=='time') 
                              { 
                                  // reload timeline  
                                  reloadTextObject( textobjectId, 'parenttimeline' );
                                  // reload parent! ...
                                  // iTextObjectDetail1380Timeline

                                  // reloadTextObject( textobjectId, 'timeline' );                                  
                              } 


                              if (propertyName=='timelength') 
                              { 
                                  // reload timeline  
                                  reloadTextObject( textobjectId, 'core' );
                              } 

                              if (propertyName=='position') 
                              { 
                                  // reload visual  
                                  reloadTextObject( textobjectId, 'core' );
                              } 

                              if (propertyName=='size') 
                              { 
                                  // reload size  
                                  reloadTextObject( textobjectId, 'core' );

                              } 

                                                                            
                            //      $('#".$this->getDivId()."Core').load('webservice.rest.php?area=textobjectdetail&action=get&actionsub=core&textobjectId=".$this->textobjectObject->textobjectId."');
                            //      $('#".$this->getDivId()."').load('webservice.rest.php?area=textobjectdetail&action=get&actionsub=listview&textobjectId=".$this->textobjectObject->textobjectId."');
                                    // reload( 'listview' );

                            });
                        }

                        function updateTextObjectDetailMember( textobjectId, memberName, memberId )
                        {
                            // alert("updateTextObjectDetailMember() "+textobjectId+", "+memberName+", "+memberId);
                            // debug("updateTextObjectDetailMember", textobjectId+", "+memberName+", "+memberId);

                            var textobjectArgument="";
                            // Form2444DatatextobjectArgument
                            textobjectArgument=$('#Form'+memberId+'DatatextobjectArgument').val();
                            // alert("updateTextObjectDetailMember() "+textobjectArgument);

                            var tinymceObject=tinyMCE.get('Form'+memberId+'DatatextobjectArgument');
                            // tinymce object
                            if ((tinymceObject+"")!="undefined")
                            {
                                   textobjectArgument=tinyMCE.get('Form'+memberId+'DatatextobjectArgument').getContent();                                             
                            }

                    /*
                            // todo direct here!! if exisits ... 
                            // simple form
                            if (textobjectEditor=="form")
                            {   
                                   textobjectArgument=$('#FormEditDatatextobjectArgument').val();
                            }
                            // tinymce
                            if (textobjectEditor=="tinymce")
                            {   
                                   textobjectArgument=tinyMCE.get('FormEditDatatextobjectArgument').getContent(); 
                                //    alert('tinymce '+textobjectArgument);  
                            }
                      */      

                           // alert('Update".$this->getDivId()."');
                           $.ajax({
                            url: 'webservice.rest.php',
                            post: 'post',
                            data:  { area: 'textobjectdetail', action: 'updatemember', textobjectId: memberId, textobjectArgument: textobjectArgument /* $memberAddOns */  },
                            context: document.body
                           }).done(function( result ) { 
                             //alert('saved '+result); 
                                reloadTextObject( textobjectId, 'core' );
                            });
                        }                        


                        /*
                            Uploading
                        */

                        // Single (Updating an Object)
                        // var documentAddSingleTextObjectId=-1;
                        // var documentAddSingleTextObjectFileType="";
                        function onChangeDocumentAddSingleDocument( )
                        {
                            // alert("onChangeDocumentAddSingleDocument()");
                            var fileList= document.getElementById("documentAddSingle").files;
                            // alert("list: "+fileList.length);
                            var fileDocumentAddSingle=fileList[0];
                            if (!fileDocumentAddSingle)
                            {
                                alert("not found!");
                                return;
                            }

                            documentAddSingleDocumentFile( fileDocumentAddSingle );
                        }

                        function documentAddSingleDocumentFile( fileDocumentAddSingle ) // file the javascript-html5-fileobject
                        {
                            // fileDocumentAddSingle
                            
                            // infos ...
                            $("#documentAddSingleFileName").html("Filename: "+fileDocumentAddSingle.name);
                            $("#documentAddSingleFileSize").html("Size: "+ Math.floor(fileDocumentAddSingle.size/1024)+"kb");
                            $("#documentAddSingleFileType").html("FileTyp: "+fileDocumentAddSingle.type);

                            // check here ...
                            // todo: check here if filetyp is ok 
                            // if (updatingSingleDocumentTextObjectFileType!=file.type) return;
                            $("#documentAddSingleError").html("");

                            // workflow ...
                            // 1. create an new object here
                            // 2. update object
                            // 3. add and reload object
                            //  documentAddSingleUploadFile( updatingSingleDocumentTextObjectId , file );
                        
                            // insert his here and now ..

                            var divTextobjectIdBase=diffPrefix+textobjectRef;
                            var textobjectRef=$('#FormAddDatatextobjectRef').val();
                            var textobjectArgument="NoValueNoCommentType";
                                textobjectArgument=$('#FormAddDatatextobjectArgument').val();
                               textobjectType=$('#FormAddDatatextobjectType').val();
                               textobjectTypeSub=$('#FormAddDatatextobjectTypeSub').val();
                               textobjectCommentType=$('#FormAddDatatextobjectCommentType').val();
                            // iObjectDetail338FormDatatextobjectPositionXAddVisual
                               textobjectPositionX=$('#FormAddDatatextobjectPositionX').val();
                               textobjectPositionY=$('#FormAddDatatextobjectPositionY').val();
                            var textobjectCommentType=$('#FormAddDatatextobjectCommentType').val();
                            
                               $.ajax({
                                url: 'webservice.rest.php',
                                post: 'post',
                                data:  { area: 'textobjectdetail', action: 'insert', actionsub: '', textobjectRef: textobjectRef, textobjectType: textobjectType,  textobjectTypeSub: textobjectTypeSub, textobjectCommentType: textobjectCommentType,  textobjectPositionX: textobjectPositionX, textobjectPositionY: textobjectPositionY,  textobjectArgument: textobjectArgument  },
                                context: document.body
                               }).done(function( result ) { 

                                        //     alert('insert a new record '+result); 
                                        
                                        //      $('#".$this->getDivId()."Core').load('webservice.rest.php?area=textobjectdetail&action=get&actionsub=core&textobjectId=".$this->textobjectObject->textobjectId."');
                                        
                                             if (result.indexOf('error')!=-1) { alert('Error in creating!'+result); return; }  
                                             if (result.indexOf('error')==-1) {
                                            
                                            var newId=result; 
                                        
                                            // upload it
                                            documentAddSingleUploadFile( newId, fileDocumentAddSingle )

                                            // insert normal comment (add below)
                                            addNewTextObjectDiv( textobjectRef, newId, textobjectCommentType);

                                     } // result  

                                });
                                        

                        }

                                // add ...
                                // todo: do this also for the default insert .. 
                                function addNewTextObjectDiv( textobjectRef, newId, commentType)
                                {
                                    addNewTextObjectDivExt( textobjectRef, newId, commentType, true);
                                }

                                function addNewTextObjectDivExt( textobjectRef, newId, commentType, flagCloseAddForm)
                                {
                                    // alert("addNewTextObjectDiv( "+textobjectRef+","+ newId+", "+commentType+")");

                                    var divTextobjectIdBase=diffPrefix+textobjectRef;
                                    
                                    // todo: something else ..
                                    if (commentType=="") 
                                    {
                                        // alert('Add inserted record here: '+'#'+divTextobjectIdBase+'Comments');
                                         $('#'+divTextobjectIdBase+'Comments').append( $('<div>').load('webservice.rest.php?area=textobjectdetail&action=get&actionsub=listview&textobjectId='+newId) );                                              
                                    }

                                    if (commentType=="visual") 
                                    {
                                                    $('#'+divTextobjectIdBase+'CommentsVisual').append( $('<div>').load('webservice.rest.php?area=textobjectdetail&action=get&actionsub=listviewvisual&textobjectId='+newId) );                                              
                                    }

                                    // version 1: close the div here .. 
                                    if (flagCloseAddForm)
                                    {
                                       $('#detailComponentFormAdd').slideToggle('fast');
                                       // version 2 or add on ..: select
                                        selectTextObjectAdd( textobjectRef , 'text', 'plain', '*' );
                                    }

                                }

                        // update ...
                        function onChangeDocumentUpdateSingleDocument( textobjectId )
                        {
                            // alert("onChangeDocumentUpdateSingleDocument( "+textobjectId+" )");
                            var fileList= document.getElementById("documentUpdateSingle").files;
                            // alert("list: "+fileList.length);
                            var fileDocumentUpdateSingle=fileList[0];
                            if (!fileDocumentUpdateSingle)
                            {
                                alert("not found!");
                                return;
                            }

                            documentUpdateSingleUpload( textobjectId, fileDocumentUpdateSingle );
                        }

                        function documentUpdateSingleUpload( textobjectId, fileDocumentUpdateSingle )
                        {
                            // infos ...
                            $("#documentUpdateSingleFileName").html("Filename: "+fileDocumentUpdateSingle.name);
                            $("#documentUpdateSingleFileSize").html("Size: "+ Math.floor(fileDocumentUpdateSingle.size/1024)+"kb");
                            $("#documentUpdateSingleFileType").html("FileTyp: "+fileDocumentUpdateSingle.type);

                            // check here ...
                            // todo: check here if filetyp is ok 
                            // if (updatingSingleDocumentTextObjectFileType!=file.type) return;
                            $("#documentUpdateSingleError").html("");

                            // workflow ...
                            // 1. update object
                            // 2. reload object
                            //  documentUpdateSingleUploadFile( updatingSingleDocumentTextObjectId , file );
                        
                            // upload it
                            documentUpdateSingleUploadFile( textobjectId, fileDocumentUpdateSingle );

                        }

                        // MultipleUpload

                        /*
                            Upload for updating ... 
                            // protery for document
                            (also used in add)
                        */
                        
                        // html5 variante!

                        function documentAddSingleUploadFile( textobjectId, file )
                        {
                            // alert("documentAddSingleUploadFile()"); 

                            var htmlAnswer="";
                            
                            var formData=new FormData();
                                formData.append("documentfile",file);
                            var client=new XMLHttpRequest();

                            if (!file) return;
                            
                            client.onError = function(e) { alert("upload problem"); };
                            client.onUploadProgress = function(e) 
                            {  
                               
                            };
                            client.onload = function(e) { /* alert("Uploaded");*/  };
                            client.onreadystatechange = function() 
                            {
                                // alert(" -- "+);
                                if (client.readyState != 4)  {  return; }
                                // alert(""+client.responseText);
                                
                                htmlAnswer=client.responseText;
                                // alert("----"+htmlAnswer);


                            };
                            client.upload.onprogress = function(e) 
                            {
                                // debug("uploadprogress","debugupload");
                                if (e.lengthComputable)
                                {
                                    var proc = (e.loaded / e.total);
                                    // debug("uploadprogress",""+proc);
                                    var size=400;
                                    var sizeA=size*proc;
                                    var sizeB=size-sizeA;
                                    $('#documentAddSingleProgress').show();
                                    $('#documentAddSingleProgress').css("width",size+"px");
                                    $('#documentAddSingleProgressA').css("height","20px");
                                    $('#documentAddSingleProgressA').css("width",sizeA+"px");
                                    $('#documentAddSingleProgressB').css("height","20px");
                                    $('#documentAddSingleProgressB').css("width",sizeB+"px");

                                }   

                            };
                            client.open("POST","webservice.rest.php?area=textobjectdetail&action=update&actionsub=document&textobjectId="+textobjectId);
                            client.send(formData);

                        }

                        function documentUpdateSingleUploadFile( textobjectId, file )
                        {
                            // alert("documentUpdateSingleUploadFile()"); 

                            var htmlAnswer="";
                            
                            var formData=new FormData();
                                formData.append("documentfile",file);
                            var client=new XMLHttpRequest();

                            if (!file) return;
                            
                            client.onError = function(e) { alert("upload problem"); }
                            client.onUploadProgress = function(e) {  }
                            client.onload = function(e) { /* alert("Uploaded");*/  }
                            client.onreadystatechange = function() 
                            {
                                // alert(" -- "+);
                                if (client.readyState != 4)  {  return; }
                                // alert(""+client.responseText);
                                
                                htmlAnswer=client.responseText;
                                // alert("----"+htmlAnswer);

                                // reload ... 
                                reloadTextObject( textobjectId, 'core' );

                                $('#detailComponentFormEdit').hide();

                            }
                            client.upload.onprogress = function(e) 
                            {
                                // debug("uploadprogress","debugupload");
                                if (e.lengthComputable)
                                {
                                    var proc = (e.loaded / e.total);
                                    // debug("uploadprogress",""+proc);
                                    var size=400;
                                    var sizeA=size*proc;
                                    var sizeB=size-sizeA;
                                    $('#documentUpdateSingleProgress').show();
                                    $('#documentUpdateSingleProgress').css("width",size+"px");
                                    $('#documentUpdateSingleProgressA').css("height","20px");
                                    $('#documentUpdateSingleProgressA').css("width",sizeA+"px");
                                    $('#documentUpdateSingleProgressB').css("height","20px");
                                    $('#documentUpdateSingleProgressB').css("width",sizeB+"px");

                                }   

                            };                            
                            client.open("POST","webservice.rest.php?area=textobjectdetail&action=update&actionsub=document&textobjectId="+textobjectId);
                            client.send(formData);

                        }

                        /*
                            MultipleUpload
                        */
                        // dropbox
                        // filelist
                        var dropboxTextObjectRef=-1;
                        var dropboxTextObjectCommentType="";
                        var dropboxArrFiles;
                        var dropboxArrIndex=0;
                        function documentCreateTextObjects( textobjectRef, commentType, arrFiles ) // Files
                        {
                            // alert("documentCreateTextObjects( "+textobjectRef+","+ commentType+", arrFiles ) ");

                            dropboxTextObjectRef=textobjectRef;
                            dropboxTextObjectCommentType=commentType;
                            dropboxArrFiles=arrFiles;

                            dropboxArrIndex=0;

                            $('#formAddFileDropBoxContainerList').html("");
                            // do all here ... 
                            for (var z=0;z<arrFiles.length;z++)
                            {
                                var file=arrFiles[z];
                                $('#formAddFileDropBoxContainerList').append("<div id='formAddFileDropBoxContainerListEntry"+z+"'>"+file.name+" ["+file.type+"]</div>");
                            }

                            // start it now ...
                            documentCreateNextTextObjectStart();
                        }
                                var arrMimeTypes=Array();

                                    function documentAddMimeType( textobjectType, textobjectTypeSub )
                                    {
                                        // alert("documentAddMimeType( "+textobjectType+","+ textobjectTypeSub+" )");
                                        var newTypeObj=new TextObject();
                                            newTypeObj.textobjectType=textobjectType;
                                            newTypeObj.textobjectTypeSub=textobjectTypeSub;
                                        arrMimeTypes[arrMimeTypes.length]=newTypeObj;
                                    }

        // types import is directly in header.inc.php
        // > therefore not in a js!
        // add here all possible mimetypes ...
        <?

            // public types
            for ($z=0;$z<count($app->arrPublicTypes);$z++)
            {
                $obj=$app->arrPublicTypes[$z];
                if ($obj->textobjectDocument==1) 
                {
                    echo("\n documentAddMimeType( '".$obj->textobjectType."', '".$obj->textobjectTypeSub."' ); ");
                    // add alternatives
                    $arrAlternativeTypes=$obj->arrAlternativeTextobjectTypes;
                    for ($alt=0;$alt<count($arrAlternativeTypes);$alt++)
                    {
                        $documentTypeAlt=$arrAlternativeTypes[$alt];
                        echo("\n documentAddMimeType( '".$documentTypeAlt->documentType."', '".$documentTypeAlt->documentTypeSub."' ); ");
                    }

                }
            }

        ?>

                                function documentIsRegularMimeType( textobjectType, textobjectTypeSub )
                                {
                                    // check for it ... 
                                    for (var z=0;z<arrMimeTypes.length;z++)
                                    {
                                        var obj=arrMimeTypes[z];
                                        if (obj.textobjectType==textobjectType)
                                            if (obj.textobjectTypeSub==textobjectTypeSub)
                                        {
                                            return true;
                                        }
                                    }

                                    return false;
                                }

                                    // not supported ...
                                    function documentSupportedMimeType( textobjectType, textobjectTypeSub )
                                    {
                                        var analyse="";

                                        // check for it ... 
                                        for (var z=0;z<arrMimeTypes.length;z++)
                                        {
                                            var obj=arrMimeTypes[z];
                                            if (obj.textobjectType==textobjectType)
                                            {
                                                //if (obj.textobjectTypeSub==textobjectTypeSub)
                                                //{
                                                    analyse=analyse+"Would be supported: ["+obj.textobjectType+"/"+obj.textobjectTypeSub+"]<br>";                                            
                                                //}
                                            }
                                        }

                                        return analyse;
                                    }

                                // process creating ... 
                                function documentCreateNextTextObjectStart(  )
                                {
                                    if (dropboxArrIndex<dropboxArrFiles.length)
                                    {
                                        var file=dropboxArrFiles[dropboxArrIndex];

                                        // check if possible
                                        // look for the arr with all documents arrays ...
                                        var divTextobjectIdBase=diffPrefix+dropboxTextObjectRef;

                                        var textobjectType="image";
                                        var textobjectTypeSub="png";

                                        var arrFileType=file.type.split("/");
                                        // alert("----"+arrFileType.length);

                                        var fileType=arrFileType[0];
                                        var fileTypeSub="";
                                        if (arrFileType.length>1) { fileTypeSub=arrFileType[1]; }
                                    
                                        // is ok 
                                        var found=documentIsRegularMimeType( fileType, fileTypeSub );
                                        // alert("   "+found);
                                        if (found)
                                        {
                                           $.ajax({
                                            url: 'webservice.rest.php',
                                            post: 'post',
                                            data:  { area: 'textobjectdetail', action: 'insert', actionsub: '', textobjectRef: dropboxTextObjectRef, textobjectType: textobjectType,  textobjectTypeSub: textobjectTypeSub, textobjectCommentType: dropboxTextObjectCommentType,   textobjectArgument: ''  },
                                            context: document.body
                                           }).done(function( result ) { 

                                                    //     alert('insert a new record '+result); 
                                                    
                                                    //      $('#".$this->getDivId()."Core').load('webservice.rest.php?area=textobjectdetail&action=get&actionsub=core&textobjectId=".$this->textobjectObject->textobjectId."');
                                                    
                                                         if (result.indexOf('error')!=-1) { alert('Error in creating!'+result); return; }  
                                                         if (result.indexOf('error')==-1) {
                                                        
                                                        var newId=result; 
                                                    
                                                        // upload it
                                                        documentAddSingleUploadFile( newId, file )

                                                        // insert normal comment (add below)
                                                        addNewTextObjectDivExt( dropboxTextObjectRef, newId, dropboxTextObjectCommentType, false);

                                                        documentCreateNextTextObjectStop( true, "" );

                                                 } // result  

                                            });
                                        }

                                        if (!found)
                                        {
                                            // not supported ... 
                                            var msg=documentSupportedMimeType( fileType, fileTypeSub );                                            
                                            documentCreateNextTextObjectStop( false, msg );

                                        }

                                    }
                                }

                                    // process creating ... 
                                    function documentCreateNextTextObjectStop( flagOk, msg )
                                    {
                                        if (dropboxArrIndex<dropboxArrFiles.length)
                                        {
                                            if (flagOk)
                                            {
                                                var file=dropboxArrFiles[dropboxArrIndex];
                                                $('#formAddFileDropBoxContainerListEntry'+dropboxArrIndex).append("<strong> done</strong>");
                                            }
                                            else
                                            {
                                                $('#formAddFileDropBoxContainerListEntry'+dropboxArrIndex).append("<strong> not supported</strong>");
                                                $('#formAddFileDropBoxContainerListEntry'+dropboxArrIndex).append("<div style='font-color: red; color: red;'> "+msg+"</div>");
                                            }

                                            dropboxArrIndex++;
                                            documentCreateNextTextObjectStart(  );
                                        }

                                    }



                        /*
                            Dragging Objects ...
                        */

                         // detail position
                         var dragBaseDivX=0; // position of 
                         var dragBaseDivY=0;
                            var dragOffsetToDragObjectX=0;
                            var dragOffsetToDragObjectY=0;
                         function startDragOnTextObjectDetailPosition( textobjectBaseDivId, textobjectToDragId, x, y )
                         {
                                // start here 
                                // alert("tartDragOnTextObjectDetailPosition( textobjectId, x, y )");
                                // debug( "startDragOnTextObjectDetailPosition", x+" "+y );

                                // get start ...
                                var divTextobjectId=diffPrefix+textobjectBaseDivId;
                                dragBaseDivX=$('#'+divTextobjectId).offset().left;
                                dragBaseDivY=$('#'+divTextobjectId).offset().top;

                                        var divTextobjectDragId=diffPrefix+textobjectToDragId;
                                        dragOffsetToDragObjectX=x-$('#'+divTextobjectDragId).offset().left;
                                        dragOffsetToDragObjectY=y-$('#'+divTextobjectDragId).offset().top;

                                debug( "startDragOnTextObjectDetailPosition", dragBaseDivX+" "+dragBaseDivX+" OffsetTo...("+dragOffsetToDragObjectX+"/"+dragOffsetToDragObjectY+") " );

   
                         }

                         // on update or! on dragstop?
                         function updateDragTextObjectDetailPosition( textobjectId, x, y )
                         {
                               var divTextobjectId=diffPrefix+textobjectId;

                               var newPosX=x-dragBaseDivX-dragOffsetToDragObjectX;
                               var newPosY=y-dragBaseDivY-dragOffsetToDragObjectY;

                               updateWebservicePosition(textobjectId, newPosX, newPosY);

                                debug( "updateDragTextObjectDetailPosition", newPosX+" "+newPosY );


                        }
                                function updateWebservicePosition(textobjectId,itextobjectPositionX,itextobjectPositionY)
                                {
                                     $.ajax({
                                        url: 'webservice.rest.php',
                                        post: 'get',
                                        data:  { area: 'textobjectdetail', action: 'update', actionsub: 'position', textobjectId: textobjectId, textobjectPositionX: itextobjectPositionX, textobjectPositionY: itextobjectPositionY },
                                        context: document.body
                                       }).done(function( result ) 
                                       {                
                                            debug('updateWebservicePosition()',result);                     
                                       }
                                    );
                                }
                        
                        
                     function deleteTextObject( textobjectId )
                     {
                           var divTextobjectId=diffPrefix+textobjectId;
                           // alert('delete'+textobjectId);
                           var result=confirm('Are you sure, you want to delete this?');
                           if (result) 
                           { 
                                 $.ajax({
                                  url: 'webservice.rest.php',
                                   post: 'post',
                                   data:  { area: 'textobjectdetail', action: 'delete', textobjectId: textobjectId  },
                                   context: document.body
                                   }).done(function( resulttmp ) { 
                                    // alert('saved '+resulttmp); 
                                    if (resulttmp.indexOf('error')!=-1) deleteTextObjectError( textobjectId, resulttmp ) 
                        //            $('#'+textobjectId+'Core').load('webservice.rest.php?area=textobjectdetail&action=delete&actionsub=&textobjectId='+id);
                                    $('#'+diffPrefix+updateObject.textobjectId).remove(); 
                                    // reloadTextObject( updateObject.textobjectId, 'core' );
                                    
                                    // reloadTextObject
                                    $('#detailComponentFormEdit').hide();

                                    // todo: type: thread/hyperthread > go up ... 

                                })
                                .fail(function( resulttmp ) { deleteAddError( textobjectId, resulttmp ) })

                           }
                      } 

                    // add a special error
                     function deleteTextObjectError( textobjectId, addMsg )
                     {
                        alert('There was an eror in this action. Try it again.'+addMsg);  
                     }




    /*
        Rules
    */
    var actualRuleDialogId=-1;
    var actualRuleDialogDivId="";
    var actualRuleName="friends";
    // RuleOperationIndex: 1
    function doCommandRuleOnTextObject(action,textobjectId,divId)
    {
        doCommandRuleOnTextObjectExt(action,textobjectId,divId, true )
    }

    function doCommandRuleOnTextObjectExt(action,textobjectId,divId, flagCorrectPosition )
    {
        // alert("doCommandRuleOnTextObject("+action+","+textobjectId+","+divId+")");

        if (action=="rule")
        {
            // $('#'+divId).toggle();
            /*
            // version 1.0
            var pos=$('#'+divId).position();
            // alert(pos);
            var posx=pos.left;
            var posy=pos.top;
                var width=$('#'+divId).width();
                var height=$('#'+divId).height();
            posx=posx+width;
            */
            // posy=posy+height;
            // alert("doCommandOnTextObject(action,textobjectId,divId) "+posx+" "+posy+"  "+width+"  "+height);
            actualRuleDialogId=textobjectId;
            actualRuleDialogDivId=divId;

            // add loading here ...
            $('#dialogCommandOnObjectRuleContainer').html("<div class='dialogCommandOnObjectRuleContainerEventLoading'>loading</div>");

            // set div 

            /*
            $('#dialogCommandOnObjectRuleContainer').css("left",posx+"px");
            $('#dialogCommandOnObjectRuleContainer').css("top",posy+"px");
            */
            if (flagCorrectPosition) setDivPositionToDiv( 'dialogCommandOnObjectRuleContainer', divId );

            // show add and position
            $('#dialogCommandOnObjectRuleContainer').show();

            // to top ...
            $('#dialogCommandOnObjectRuleContainer').css( 'z-index',$.topZIndex()+10);

            // load here and now ...
//            $('#'.ivId."').html("");
            var url="webservice.rest.php?area=textobjectdetail&action=rule&actionsub=form&textobjectId="+textobjectId;
            $('#dialogCommandOnObjectRuleContainer').load(url);


        }

    }

        // show insert dialog
        // RuleOperationIndex: 2
        function doRuleAction( action, ruleName, ruleIndex )
        {
            // debug
            //alert("doRuleAction("+ action+", "+ruleName+", "+ruleIndex+" ["+actualRuleDialogId+"])");

            // actions

            // add
            if (action=="addform")
            {
                actualRuleName=ruleName;

                // give form for ruleName now ..  
                var url="webservice.rest.php?area=textobjectdetail&action=rule&actionsub=addform&textobjectId="+actualRuleDialogId+"&ruleName="+ruleName;
                $('#ruleContainerAdd').load(url);  
            }

                if (action=="addformsearch")
                {
                    // alert("AddFormSearch");
                    var searchVal=$('#RuleSearch').val();
                    // alert("SearchVal:"+searchVal);
                    $('#ruleContainerAddResult').html("loading...");   

                    // do it with ajax here ...
                    var url="webservice.rest.php?area=textobjectdetail&action=rule&actionsub=addformsearch&textobjectId="+actualRuleDialogId+"&addformsearch="+escape(searchVal);
                    $('#ruleContainerAddResult').load(url);          

                    // delete and reload
                    // reloadDialogRule();       
                }

                // addformsearchrule
                if (action=="addformsearchrule")
                {
                    // alert("add next rule");
                    // alert("SearchVal:"+searchVal);
                    $('#ruleContainerAddResult').html("loading...");   

                    // do it with ajax here ...
                    // var url="webservice.rest.php?area=textobjectdetail&action=rule&actionsub=addformsearch&textobjectId="+actualRuleDialogId+"&addformsearch="+escape(searchVal);
                    // $('#ruleContainerAddResult').load(url);          

                    $.ajax({
                         url: 'webservice.rest.php',
                         post: 'post',
                         data:  { area: 'textobjectdetail', action: 'rule', actionsub: 'insert', textobjectId: actualRuleDialogId, ruleName: actualRuleName, ruleUserId: ruleIndex   },
                         context: document.body
                    }).done(function( result ) { 

                        // alert('saved '+result); 

                    });
                    

                    // delete and reload
                    reloadDialogRule();       
                }

            // invitationform
            if (action=="invitationform")
            {
                actualRuleName=ruleName;

                // give form for ruleName now ..  
                var url="webservice.rest.php?area=textobjectdetail&action=rule&actionsub=invitationform&textobjectId="+actualRuleDialogId+"&ruleName="+ruleName;
                $('#ruleContainerAdd').load(url);  
            }

                // invitationformsearch
                if (action=="invitationformsearch")
                {
                    // alert("AddFormSearch");
                    var searchVal=$('#InvitationSearch').val();
                    // alert("SearchVal:"+searchVal);
                    $('#ruleContainerAddResult').html("loading...");   

                    // do it with ajax here ...
                    var url="webservice.rest.php?area=textobjectdetail&action=rule&actionsub=invitationformsearch&textobjectId="+actualRuleDialogId+"&invitationformsearch="+escape(searchVal);
                    $('#ruleContainerAddResult').load(url);          

                    // delete and reload
                    // reloadDialogRule();       
                }

                // invitationformsearch
                if (action=="invitationformsearchrule")
                {
                    // alert("add next rule invitation");
                    // alert("SearchVal:"+searchVal);
                    $('#ruleContainerAddResult').html("loading...");   

                    // do it with ajax here ...
                    // var url="webservice.rest.php?area=textobjectdetail&action=rule&actionsub=addformsearch&textobjectId="+actualRuleDialogId+"&addformsearch="+escape(searchVal);
                    // $('#ruleContainerAddResult').load(url);          

                    $.ajax({
                         url: 'webservice.rest.php',
                         post: 'post',
                         data:  { area: 'textobjectdetail', action: 'rule', actionsub: 'insertinvitation', textobjectId: actualRuleDialogId, ruleName: actualRuleName, ruleUserId: ruleIndex   },
                         context: document.body
                    }).done(function( result ) { 

                        // alert('saved '+result); 

                    });
                    

                    // delete and reload
                    reloadDialogRule();       
                }

                 // invitationwebformsearch
                if (action=="invitationwebformsearchrule")
                {
                    // alert("add next rule invitationweb");
                    // alert("SearchVal:"+searchVal);

                    var ruleEmail=$('#RuleEmail').val();

                    // alert("add next rule invitationweb"+ruleEmail);


                    $('#ruleContainerAddResult').html("loading...");   

                    // do it with ajax here ...
                    // var url="webservice.rest.php?area=textobjectdetail&action=rule&actionsub=addformsearch&textobjectId="+actualRuleDialogId+"&addformsearch="+escape(searchVal);
                    // $('#ruleContainerAddResult').load(url);          

                    $.ajax({
                         url: 'webservice.rest.php',
                         post: 'post',
                         data:  { area: 'textobjectdetail', action: 'rule', actionsub: 'insertinvitationweb', textobjectId: actualRuleDialogId, ruleName: actualRuleName, ruleUserId: -1, ruleEmail: ruleEmail   },
                         context: document.body
                    }).done(function( result ) { 

                        // alert('saved '+result); 

                    });
                    

                    // delete and reload
                    reloadDialogRule();       
                }


            if (action=="delete")
            {
                // alert("doRuleAction("+ action+", "+ruleName+", "+ruleIndex+" ).DELETE");

                // do it with ajax here ...
                var url="webservice.rest.php?area=textobjectdetail&action=rule&actionsub=delete&ruleId="+ruleIndex;
                $('#dialogCommandOnObjectRuleContainer').load(url);  

                // delete and reload
                reloadDialogRule();       
            }

            if (action=="rejectrequest")
            {
                // alert("doRuleAction("+ action+", "+ruleName+", "+ruleIndex+" ).DELETE");

                // do it with ajax here ...
                var url="webservice.rest.php?area=textobjectdetail&action=rule&actionsub=rejectrequest&ruleId="+ruleIndex;
                $('#dialogCommandOnObjectRuleContainer').load(url);  

                // delete and reload
                reloadDialogRule();       
            }

            if (action=="approverequest")
            {
                // alert("doRuleAction("+ action+", "+ruleName+", "+ruleIndex+" ).DELETE");

                // do it with ajax here ...
                var url="webservice.rest.php?area=textobjectdetail&action=rule&actionsub=approverequest&ruleId="+ruleIndex;
                $('#dialogCommandOnObjectRuleContainer').load(url);  

                // delete and reload
                reloadDialogRule();       
            }




        }

            function hideDialogeAddRule()
            {
                $('#ruleContainerAdd').html(""); 
            }


            // reload
            function reloadDialogRule()
            {
                // do it here and now ...
                doCommandRuleOnTextObjectExt("rule",actualRuleDialogId,actualRuleDialogDivId,false);
            }

    /*
        Rule Requests
    */

    function doCommandRuleRequest( ruleName,textobjectId )
    {
        // alert("doCommandRuleRequest( "+ruleName+","+textobjectId+" )");

        /*
        if (Confirm("You wanna set up a request?"),"") 
        { 
        }
        */
        var url="webservice.rest.php?area=textobjectdetail&action=rule&actionsub=request&textobjectId="+textobjectId+"&ruleName="+ruleName;
        $('#dialogCommandOnObjectRuleContainer').load(url);

    }

        /*

            dialogs

        */
        // dialog / alerts
        var systemDialogMessage="";

        function resetSystemDialog()
        {
            systemDialogMessage="";
        }

        function appendSystemDialog( msg )
        {
            systemDialogMessage=systemDialogMessage+"<div class='systemDialogMessage'>"+msg+"</div>";
            //  $('#systemDialog').append();
        }

        function showSystemDialog()
        {
            // alert("---"+systemDialogMessage);
            systemDialogMessage="<div class='systemDialogIcon'>&nbsp;</div>"+"<div class='systemDialogIconClose' onClick=\"hideSystemDialog();\">&nbsp;X</div>"+systemDialogMessage;
            systemDialogMessage=systemDialogMessage+"<br><a onClick=\"hideSystemDialog();\">[OK]</a>";

            $('#systemDialog').html(systemDialogMessage);
            bringSystemDialogToFront();
            $('#systemDialog').show();

            // scroll top
            $('html, body').animate({ scrollTop: 0 }, 'fast');
        }
                function bringSystemDialogToFront()
                {
                    var zIndex=$.topZIndex(); $('#systemDialog').css( 'z-index',zIndex+10);
                }

        function hideSystemDialog() // user do this!
        {
            $('#systemDialog').hide();
        }


</script>

<body bgcolor=white>

<!-- script divs -->

    <!-- errors -->
    <div id='systemDialog'></div>
    <? 

       if (isset($_SESSION["userLoginError"]))
       {
            // echo("---".$_SESSION["userLoginError"]);
            if (("".$_SESSION["userLoginError"])!="") 
            { 
                echo("<script>appendSystemDialog( \"".$_SESSION["userLoginError"]."\" ); showSystemDialog();</script>");  
            }
        }
    ?>

    <!-- edit container -->
    <div  class='detailComponentFormBasic detailComponentForm' id='detailComponentFormEdit' ><div class='dialogCommandOnObjectRuleContainerEventLoading'>loading add</div></div>

    <!-- rule container -->
    <div _class='detailComponentFormBasic' id='dialogCommandOnObjectRuleContainer'><div class='dialogCommandOnObjectRuleContainerEventLoading'>loading</div></div>

    <!-- add container -->
    <div  class='detailComponentFormBasic detailComponentAdd' id='detailComponentFormAdd' ><div class='dialogCommandOnObjectRuleContainerEventLoading'>loading edit</div></div>

    <script>
        // todo: only drag bar!

        // drag on edit rule
        $(function() {
             $( '#detailComponentFormEdit' ).draggable({
             cursor: 'move', 
                // cursorAt: { top: 0, left: 0 },
                start: function(event, ui) { $( '#detailComponentFormEdit' ).css( 'z-index',$.topZIndex()+10); }, 
                drag: function(event, ui) {    }, 
                stop: function(event, ui) {    }
                });
         });

        // drag on edit rule
        $(function() {
             $( '#dialogCommandOnObjectRuleContainer' ).draggable({
             cursor: 'move', 
                // cursorAt: { top: 0, left: 0 },
                start: function(event, ui) { $( '#dialogCommandOnObjectRuleContainer' ).css( 'z-index',$.topZIndex()+10); }, 
                drag: function(event, ui) {    }, 
                stop: function(event, ui) {    }
                });
         });

        $(function() {
             $( '#detailComponentFormAdd' ).draggable({
             cursor: 'move', 
                // cursorAt: { top: 0, left: 0 },
                start: function(event, ui) { $( '#detailComponentFormAdd' ).css( 'z-index',$.topZIndex()+10); }, 
                drag: function(event, ui) {    }, 
                stop: function(event, ui) {    }
                });
         });

<?
/*
                                $str=$str."\n         $(function() {";
                                $str=$str."\n             $( \"#".$divId."$add\" ).draggable({";
//                              $str=$str."\n                 cursor: 'move', ";
//                              $str=$str."\n                 cursorAt: { top: 56, left: 56 }, ";
                                // $str=$str."\n                 start: function(event, ui) {  } ";
                                //$str=$str."\n                 start: function(event, ui) { mainObjectLeft=$('#".$divId."Content').offset().left; mainObjectTop=$('#".$divId."Content').offset().top; }, ";
                                //$str=$str."\n                 drag: function(event, ui) {    }, ";
                                //$str=$str."\n                 stop: function(event, ui) { stopLeft=$('#".$textobjectViewTmp->getDivId()."CommentsVisualDetail').offset().left; diffX=parseInt(stopLeft)-parseInt(mainObjectLeft); newPositionLeft=diffX; $('#".$textobjectViewTmp->getDivId()."CommentsVisualDetail').css('left','0px'); $('#".$textobjectViewTmp->getDivId()."CommentsVisualDetail').css('margin-left',(mainObjectLeft+newPositionLeft)+'px');  stopTop=$('#".$textobjectViewTmp->getDivId()."CommentsVisualDetail').offset().top; diffY=parseInt(stopTop)-parseInt(mainObjectTop); newPositionTop=diffY; $('#".$textobjectViewTmp->getDivId()."CommentsVisualDetail').css('top','0px');    $('#".$textobjectViewTmp->getDivId()."CommentsVisualDetail').css('margin-top',(mainObjectTop+newPositionTop)+'px');   updateDetailPosition".$divId."( ".$textobjectViewTmp->getId().", newPositionLeft, newPositionTop );   }";
                                $str=$str."\n             });";
                                $str=$str."\n         });";
*/?>
     </script>