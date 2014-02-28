$(function() {
  function select_write(img, selection) {
      var posting = $.post(ajax_url, { img:$(img).attr("src"), selection:selection } );
      posting.done(function( data ) {
        console.log(data);
      });
  }
  function select_load(){
    $( "img.photo" ).each(function() {
      var posting = $.post(ajax_url, { img:$(this).attr("src"), askParam:true } ), img = $(this), id = $(this).attr("id");
      
      img.imgAreaSelect({ instance: true, handles: true, onSelectEnd: select_write });
      
      posting.done(function( data ) {
        if(data.hasData) img.imgAreaSelect({ x1: data.sel.x1, y1: data.sel.y1, x2: data.sel.x2, y2: data.sel.y2 });
      });
    });
  };
  function init(){
    select_load();
    
  }
  var ajax_url = "call_ajax.php";
  init();
})