/* Global JavaScript File for working with jQuery library */

// execute when the HTML file's (document object model: DOM) has loaded
$(document).ready(function() {

  /* USERNAME VALIDATION */
  // use element id=username 
  // bind our function to the element's onblur event
  $('#username').blur(function() {

    // get the value from the username field                              
    var username = $('#username').val();
    
    // Ajax request sent to the CodeIgniter controller "ajax" method "username_taken"
    // post the username field's value
    $.post('jstest/username_taken',
      { 'username':username },

      // when the Web server responds to the request
      function(result) {
        // clear any message that may have already been written
        $('#bad_username').replaceWith('');
        
        // if the result is TRUE write a message to the page
        if (result) {
          $('#username').after('<div id="bad_username" style="color:red;">' +
            '<p>(That Username is already taken. Please choose another.)</p></div>');
        }
      }
    );
  });  

});