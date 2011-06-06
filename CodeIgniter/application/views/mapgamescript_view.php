<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<style type="text/css">
  html { height: 100% }
  body { height: 100%; margin: 0px; padding: 0px; background-color:black; color:white;}
  #map_canvas { height: 100% }
  #distance {text-align:center;}
</style>
<script type="text/javascript"
    src="http://maps.google.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript">
  function initialize() {
    var latlng = new google.maps.LatLng(0, 0);
    var myOptions = {
      zoom: 3,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      scrollwheel : false,
      disableDoubleClickZoom : true  
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"),
        myOptions);

    //addListenerOnce(instance:Object, eventName:string, handler:Function)
      
      google.maps.event.addListener(map, 'click', function(event) {
        calculate(event.latLng);
      });
  }

  function calculate(location){
		var lat = location.lat();
		var lng = location.lng();
	  	var c = Math.sqrt(lat*lat + lng*lng);
	  	document.getElementById("distance").innerHTML=c;
	  	//Compar c with data from database
	  	//Reload eventlistener
	  };

</script>
</head>
<body onload="initialize()">
  <div id="map_canvas" style="width:80%; height:80%; margin-left: auto; margin-right: auto; margin-top: 10px;"></div>
  <br />
  <br />
  <p id="distance">K</p>
</body>
</html>