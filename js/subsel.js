$(function() {
  var ajax_url = "call_ajax.php";
      
  $('img#photo').imgAreaSelect({
      handles: true,
      onSelectEnd: update_select
  });
      
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
})