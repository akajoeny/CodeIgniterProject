/* Global JavaScript File for working with jQuery library */

// execute when the HTML file's (document object model: DOM) has loaded

function addmsg(type, msg){
	        /* Simple helper to add a div.
	        type is the name of a CSS class (old/new/error).
	        msg is the contents of the div */
	        $("#messages").append(
	            "<div class='msg "+ type +"'>"+ msg +"</div>"
	        );
	    }
function printuser(type, user){
			$("#messages").replaceWith(
					"<div class='msg "+ type +"'>"+ user +"<br></div>"
			);
	
}

	    function waitForMsg(){
	        /* This requests the url "msgsrv.php"
	        When it complete (or errors)*/
	        $.ajax({
	            type: "GET",
	            url: "http://localhost/CodeIgniterProject/CodeIgniter/jstest/loggedinusers",

	            async: true, /* If set to non-async, browser shows page as "Loading.."*/
	            cache: false,
	            timeout:50000, /* Timeout in ms */

	            success: function(data){ /* called when request to barge.php completes */
	                //Break out users from data...
	            	printuser("new", data);
	            	//addmsg("new", data[i]['username']); /* Add response to a .msg div (with the "new" class)*/            	
	                setTimeout(
	                    'waitForMsg()', /* Request next message */
	                    10000 /* ..after 10 seconds */
	                );
	            },
	            error: function(XMLHttpRequest, textStatus, errorThrown){
	                addmsg("error", textStatus + " (" + errorThrown + ")");
	                setTimeout(
	                    'waitForMsg()', /* Try again after.. */
	                    "15000"); /* milliseconds (15seconds) */
	            },
	        });
	    };

$(document).ready(function(){
	        waitForMsg(); /* Start the inital request */
	    });
	
	
	
	
