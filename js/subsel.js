$(function() {

      
  function update_select(img, selection) {
      var scaleX = 100 / (selection.width || 1);
      var scaleY = 100 / (selection.height || 1);
      console.log(selection);
      console.log($(img).attr("src"));
      
      var posting = $.post(ajax_url, { img:$(img).attr("src"), selection:selection } );
      posting.done(function( data ) {
        console.log(data);
      });
  }
  
  function init(){

    
    selectionFromFiles();
  }
  function selectionFromFiles(){
    $( "img.photo" ).each(function() {
        var posting = $.post(ajax_url, { img:$(this).attr("src"), askParam:true } );
        var img = $(this);
        
        img.imgAreaSelect({ handles: true, onSelectEnd: update_select });
  
        posting.done(function( data ) {
          if(data.hasData) img.imgAreaSelect({ x1: data.sel.x1, y1: data.sel.y1, x2: data.sel.x2, y2: data.sel.y2 });
        });
    });
  }
  
  var ajax_url = "call_ajax.php";
      
  
  
  init();
})