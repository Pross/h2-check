!function ($) {
  $(document).ready(function() {
    $.UrlSubmit.init();
  })
  
  $.UrlSubmit = {
    init: function() {
      $( "#urlsubmit" ).click(function() {
        $.UrlSubmit.error('')
        $.UrlSubmit.reset()
        var that = $(this)
        var input = $(that).parent().parent().find('.url').val()
        if( ! input ) {
          $.UrlSubmit.error('Please enter a valid URL')
          return;
        }

        var request = $.ajax({
          url: "check.php",
          method: "POST",
          data: { url : input },
          dataType: "html"
        });
         
        request.done(function( response ) {
          $.UrlSubmit.output( response );
        });
         
        request.fail(function( jqXHR, textStatus ) {
          alert( "Request failed: " + textStatus );
        });
        
      });
    },
    
    error: function(response) {
      var out = '<p>' + response + '</p>';
      $('.msg').html(out);
    },
    
    output: function(response) {
      
      var data = $.parseJSON(response)
      var html = ''
      if( true == data.success ) {
        html = '<p>Yay! Looks like that site is http/2 ready!</p>';
      } else {
        html = '<p>Unfortunatly we could not detect http/2</p>';
      }

      html += '<p>Headers detected:<br /><i>' + data.headers + '</i></p>'
      $('.output').removeClass('hidden')
      $('.output').html(html)
    },
    reset: function() {
      $('.output').addClass('hidden')
    }
  }
  
}(window.jQuery)
