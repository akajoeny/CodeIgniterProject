/* Global JavaScript File for working with jQuery library */

// execute when the HTML file's (document object model: DOM) has loaded

function printusersonline(users){
	$("#usersonline").replaceWith(
		"<ul id='" + "usersonline" +"'>"+ users +"</ul>"	
	);
}

function waitForMsg(){
    /* This requests the url "msgsrv.php"
    When it complete (or errors)*/
    $.ajax({
        type: "GET",
        url: "http://localhost/CodeIgniterProject/CodeIgniter/game/loggedinusers",

        async: true, /* If set to non-async, browser shows page as "Loading.."*/
        cache: false,
        timeout:50000, /* Timeout in ms */

        success: function(data){ /* called when request to barge.php completes */
            //Break out users from data...
        	printusersonline(data);
        	
            setTimeout(
                'waitForMsg()', /* Request next message */
                10000 /* ..after 10 seconds */
            );
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){
            setTimeout(
                'waitForMsg()', /* Try again after.. */
                "15000"); /* milliseconds (15seconds) */
        },
    });
};

$(document).ready(function(){
	        waitForMsg(); /* Start the inital request */
	    });
	
	
	
	
