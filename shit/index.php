<?php
require_once('load.php');

if( !empty( $_SESSION['user_login'] ) ) {
	$user_login = $_SESSION['user_login'];
	$id_user = chk_credentials( $user_login );
	if( $id_user != CONS_EMPTY ) {
		$success = true;
	}
}
?>
<html>
<head>
<title>deepvue</title>
<link type="text/css" rel="stylesheet" href="css/deepvue.css">

<meta name="viewport" content="width=1024" />
<script type="text/javascript" src="lib/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">                                         
$(document).ready(function() {
	// generate markup
	for(var i = 1; i < 13; i++) {
		$("#navigation").append("<a href='#'>"+ i +"</a> ");
	}

	var size = 0;
	var photos = [];
	var thumbs = [];
	var images = [];
	
	// setupAll();
	
	// add markup to container and apply click handlers to anchors
	$("#navigation a").click( function(e) {
		// stop normal link click
		e.preventDefault();

		// send request
		$.ajax({
			url: "dvfeeder.php",
			data: {user_login: "<?php echo $user_login ?>", year: "2010", month: $(this).html()},
			dataType: "json",
			type: "POST",
			success: function( data ) {
				
				var index = 0;
				$.each(data.images, function(key, value) {
					
					thumbs[index] = value.thumb;
					images[index] = value.name;
					index++;
				});
				size = index;
				$("#main").empty();
				$("#main").append("size = " + size + "<br/>");
				for( var i = 0; i < index; i++ ) {
					$("#main").append(thumbs[i] + "<br/>");
				}
			}
		});
	});
});

var days = new Array(30);
var daytext = new Array(30);
var currentBig = -1;

var whotext = null;
var distancetext = null;
var datetext = null;
var timetext = null;
var periodtext = null;

var bigphoto1 = null;
var bigphoto2 = null;
var map1 = null;
var map2 = null;
var seconda = 0;
var secondam = 0;

var WAITSS = 10;

var attesa = WAITSS;     //i giri di timer che startScreensaver aspetta a far ripartire slide (dopo un click su thumbnail)

var maptype = [ 0, 1, 1, 0, 0, 1 ,     0, 0, 0, 1, 0, 1, 0, 1, 0,0,0,0 ];
var mapzoom =[ 18,14, 14, 16, 18, 14, 18,18,18,16,18,11,17,16,17,15,15,15 ];

var mapcenter =new Array ( new google.maps.LatLng(29.057939, -13.563045), 
                            new google.maps.LatLng(29.057644, -13.557315),
                            new google.maps.LatLng(  29.057644, -13.557315 ),
                            new google.maps.LatLng( 29.057516,-13.550520  ),
                            new google.maps.LatLng( 29.057516, -13.550520 ),
                            new google.maps.LatLng( 29.058016,-13.555646 ),
                            new google.maps.LatLng( 29.058572,-13.559705 ),
                            new google.maps.LatLng( 29.058572,-13.559705 ),
                            new google.maps.LatLng( 29.058572,-13.559705 ),
                            new google.maps.LatLng( 29.058059,-13.561521 ),
                            new google.maps.LatLng( 29.057968,-13.563197 ),
                            new google.maps.LatLng( 29.086681,-13.559587 ),
                            new google.maps.LatLng( 29.115006,-13.556311 ),
                            new google.maps.LatLng( 29.115579,-13.554335 ),
                            new google.maps.LatLng( 29.116184,-13.552376 ),
                            new google.maps.LatLng( 29.114944,-13.556631 ),
                            new google.maps.LatLng( 29.114944,-13.556631 ),
                            new google.maps.LatLng( 29.114944,-13.556631 )
);

var mapstart =new Array ( new google.maps.LatLng(29.057939, -13.563045),
                          new google.maps.LatLng(29.057939, -13.563045),
                            new google.maps.LatLng(  29.057939, -13.563045 ),
                            new google.maps.LatLng( 29.057516,-13.550520  ),
                            new google.maps.LatLng( 29.057516, -13.550520 ),
                            new google.maps.LatLng( 29.057516, -13.550520 ),
                            new google.maps.LatLng( 29.058572,-13.559705 ),
                            new google.maps.LatLng( 29.058572,-13.559705 ),
                            new google.maps.LatLng( 29.058572,-13.559705 ),
                            new google.maps.LatLng( 29.058572, -13.559705 ),
                            new google.maps.LatLng( 29.057968,-13.563197 ),
                            new google.maps.LatLng( 29.057968, -13.563197 ),
                            new google.maps.LatLng( 29.115006,-13.556311 ),
                            new google.maps.LatLng( 29.115006, -13.556311 ),
                            new google.maps.LatLng( 29.116184,-13.552376 ),
                            new google.maps.LatLng( 29.114944,-13.556631 ),
                            new google.maps.LatLng( 29.114944,-13.556631 ),
                            new google.maps.LatLng( 29.114944,-13.556631 )
);

var mapend =new Array ( new google.maps.LatLng(29.057939, -13.563045),
                        new google.maps.LatLng(29.057348, -13.551585),
                            new google.maps.LatLng(  29.057348, -13.551585 ),
                            new google.maps.LatLng( 29.057516,-13.550520  ),
                            new google.maps.LatLng( 29.057516, -13.550520 ),
                            new google.maps.LatLng( 29.058516, -13.560771 ),
                            new google.maps.LatLng( 29.058572,-13.559705 ),
                            new google.maps.LatLng( 29.058572,-13.559705 ),
                            new google.maps.LatLng( 29.058572,-13.559705 ),
                            new google.maps.LatLng( 29.057545, -13.563337 ),
                            new google.maps.LatLng( 29.057968,-13.563197 ),
                            new google.maps.LatLng( 29.115395, -13.555976 ),
                            new google.maps.LatLng( 29.115006,-13.556311 ),
                            new google.maps.LatLng( 29.116152, -13.552359 ),
                            new google.maps.LatLng( 29.116184,-13.552376 ),
                            new google.maps.LatLng( 29.114944,-13.556631 ),
                            new google.maps.LatLng( 29.114944,-13.556631 ),
                            new google.maps.LatLng( 29.114944,-13.556631 )
);

var mapfoto =new Array ( new google.maps.LatLng(29.057999, -13.563209),
                        new google.maps.LatLng(29.058338, -13.558568 ), 
                        new google.maps.LatLng(29.057467,-13.552896),
                        new google.maps.LatLng(29.057583,-13.552277),
                        new google.maps.LatLng(29.057552,-13.550425),
                        new google.maps.LatLng(29.059683,-13.556453),
                        new google.maps.LatLng(29.058836,-13.560012),
                        new google.maps.LatLng(29.058957,-13.559269),
                        new google.maps.LatLng(29.058876,-13.559325),
                        new google.maps.LatLng(29.058502,-13.561300),
                        new google.maps.LatLng(29.058138,-13.563212),
                        new google.maps.LatLng(29.045053,-13.583776),
                        new google.maps.LatLng(29.114855,-13.556957),
                        new google.maps.LatLng(29.115444,-13.555948),
                        new google.maps.LatLng(29.116083,-13.552408),
                        new google.maps.LatLng(29.116397,-13.552409),
                        new google.maps.LatLng(29.116085,-13.553547),
                        new google.maps.LatLng(29.115786,-13.554640)
);

var datestring = new Array( "March 21st, 2010");
var timestring = new Array( "10.27am - 10.31am",
                            "10.31am - 11.31am",
                            "10.31am - 11.31am",
                            "11.31am - 11.56am",
                            "11.31am - 11.56am",
                            "11.56am - 12.22pm",
                            "12.22pm - 1.35pm",
                            "12.22pm - 1.35pm",
                            "12.22pm - 1.35pm",
                            "1.35pm - 1.38pm",
                            "1.38pm - 1.42pm",
                            "1.42m - 1.52pm",
                            "1.52pm - 1.57pm",
                            "1.57pm - 2.01pm",
                            "2.01pm - 2.13pm",
                            "2.13pm - 3.12pm",
                            "2.13pm - 3.12pm",
                            "2.13pm - 3.12pm"  );
var whostring = new Array( "alex at 10.27am in teguise parking",
                           "alex at 10.48am in teguise",
                           "alex at 11.30am in castillo de santa barbara",
                           "alex at 11.34am in castillo de santa barbara: bright and clear. walking on a volcano.",
                           "alex at 11.50am in castillo de santa barbara",
                           "alex at 12.15pm",
                           "alex at 12.22pm in teguise",
                           "alex at 12.42pm in teguise",
                           "alex at 12.52pm in teguise",
                           "alex at 1.37pm in teguise",
                           "alex at 1.39pm in teguise parking",
                           "alex at 1.44pm",
                           "alex at 1.52pm in famara beach",
                           "alex at 1.57pm in famara beach",
                           "alex at 2.12pm in famara beach: sunbathing in the wind!",
                           "alex at 2.15pm in famara beach",
                           "alex at 2.27pm in famara beach",
                           "alex at 2.39pm in famara beach" );
var distancestring = new Array( "a few yards",
                                "about a mile",
                                "about a mile",
                                "a few yards",
                                "a few yards",
                                "around 9 hundred yards",
                                "a few yards",
                                "a few yards",
                                "a few yards",
                                "around 3 hundred yards",
                                "a few yards",
                                "about 4 miles",
                                "a few yards",
                                "around 3 hundred yards",
                                "a few yards",
                                "around 4 hundred yards",
                                "around 4 hundred yards",
                                "around 4 hundred yards" );
var periodstring = new Array( "staying there for about 5 minutes",
                              "while going from teguise parking to castillo de santa barbara in about an hour",
                              "while going from teguise parking to castillo de santa barbara in about an hour",
                              "staying there for about 25 minutes",
                              "staying there for about 25 minutes",
                              "going from castillo de santa barbara to teguise in about 25 minutes",
                              "staying there for about an hour",
                              "staying there for about an hour",
                              "staying there for about an hour",
                              "while going from teguise to teguise parking in about 5 minutes",
                              "staying there for about 5 minutes",
                              "going from teguise parking to famara beach in about 10 minutes",
                              "staying there for about 5 minutes",
                              "while moving around there for about 5 minutes",
                              "staying there for about 10 minutes",
                              "while moving around there for about an hour",
                              "while moving around there for about an hour",
                              "while moving around there for about an hour" );

function mybearing( from, to )
{
       var lat1 = from.lat();
       var lon1 = from.lng();
       var lat2 = to.lat();
       var lon2 = to.lng();
       var angle = Math.atan2(  (lon2-lon1), (lat2-lat1) );
       return angle;
}

  function loadMap(mappa) 
  {
    var latlng = mapcenter[currentBig];
    var ll1 = mapstart[currentBig];
    var ll2 = mapend[currentBig];
    
    var myOptions = {
      zoom:  mapzoom[currentBig],
      center: latlng,
      disableDefaultUI: true,
      disableDoubleClickZoom: true,
      draggable: false,
      scrollwheel: false,
      noClear: true,
      mapTypeId: google.maps.MapTypeId.SATELLITE};
       
    var map = new google.maps.Map(mappa, myOptions);
    
    if (maptype[currentBig]==0)     //stay
    { 
        var circ_opz = 
        {
            center: latlng,
            map: map,
            clickable: false,
            fillColor: "#000000",
            fillOpacity: 0.0,   
            radius: 10*Math.pow(2,20-mapzoom[currentBig]),
            strokeColor: "#ffffff",
            strokeOpacity: 1,
            strokeWeight: 6,
            zIndex: 667        
        }
        var circle = new google.maps.Circle(circ_opz);

    var fll = mapfoto[currentBig];
    var circ_opz = 
        {
            center: fll,
            map: map,
            clickable: false,
            fillColor: "#ffffff",
            fillOpacity: 1,
            radius: 1.5*Math.pow(2,20-mapzoom[currentBig]),
            strokeColor: "#ffffff",
            strokeOpacity: 0,
            strokeWeight: 1,
            zIndex: 667        
        }
        var circle = new google.maps.Circle(circ_opz); 
    }
    else        //move
    {
   
    var fll = mapfoto[currentBig];

    var angle = mybearing(ll1,fll);
    
    //var fllback = new google.maps.LatLng(fll.lat() + 0.001 * Math.cos(angle+Math.PI),  fll.lng() + 0.001 * Math.sin(angle+Math.PI) );
     
    angle = mybearing (fll,ll2);
    
    //var fllfwd = new google.maps.LatLng(fll.lat() + 0.001 * Math.cos(angle),  fll.lng() + 0.001 * Math.sin(angle) );
    var ll2back = new google.maps.LatLng(ll2.lat() + 0.002*Math.pow(2,14-mapzoom[currentBig]) * Math.cos(angle+Math.PI),  ll2.lng() + 0.002*Math.pow(2,14-mapzoom[currentBig]) * Math.sin(angle+Math.PI) );
     
    var ll3 = new google.maps.LatLng(ll2.lat() + 0.0025*Math.pow(2,14-mapzoom[currentBig]) * Math.cos(angle+Math.PI+Math.PI/12.0),  ll2.lng() + 0.0025*Math.pow(2,14-mapzoom[currentBig]) * Math.sin(angle+Math.PI+Math.PI/12.0) );
    var ll4 = new google.maps.LatLng(ll2.lat() + 0.0025*Math.pow(2,14-mapzoom[currentBig]) * Math.cos(angle+Math.PI-Math.PI/12.0),  ll2.lng() + 0.0025*Math.pow(2,14-mapzoom[currentBig]) * Math.sin(angle+Math.PI-Math.PI/12.0) );
        
    var fillcircle=1;
    var strokecircle=0;
    var dist = Math.abs (fll.lat()-ll2back.lat())+Math.abs (fll.lng()-ll2back.lng());
    dist = dist / Math.pow(2,8-mapzoom[currentBig]);
    //alert(dist);
    if (dist<0.15)
    {
        strokecircle=1;
        fillcircle=0;
    }
    
    var circ_opz = 
        {
            center: fll,
            map: map,
            clickable: false,
            fillColor: "#ffffff",
            fillOpacity: fillcircle,
            radius: 1.5*Math.pow(2,20-mapzoom[currentBig]),
            strokeColor: "#ffffff",
            strokeOpacity: strokecircle,
            strokeWeight: 1.5,
            zIndex: 667        
        }
        var circle = new google.maps.Circle(circ_opz); 
     
    var arrowCoords = [
    ll2,
    ll3,
    ll4
  ];

  arrow = new google.maps.Polygon({
    paths: arrowCoords,
    strokeColor: "#FFffff",
    strokeOpacity: 0.0,
    strokeWeight: 1,
    fillColor: "#FFffff",
    fillOpacity: 1
  });
  
  var line1Coords = [
    ll1,fll
  ];
  var line2Coords = [
        fll,ll2back
  ];
  
  var line1 = new google.maps.Polyline({
    path: line1Coords,
    strokeColor: "#FFffff",
    strokeOpacity: 1,
    strokeWeight: 6
  });
    var line2 = new google.maps.Polyline({
    path: line2Coords,
    strokeColor: "#FFffff",
    strokeOpacity: 1,
    strokeWeight: 6
  });
  
    line1.setMap(map);
    line2.setMap(map);
    arrow.setMap(map);

    }
    
    google.maps.event.addListener(map, 'tilesloaded', function() {
    showMap(photos[currentBig]);   });
  }

var cursor = null;
var month = null;
//var arrowl = null;
//var arrowr = null;
var screensaverbutton = null;
var prefs = null;
var togrid = null;
var round1 = null;
var round2 = null;
var round3 = null;
var round4 = null;
var interval = null;

var togridtransform = " position: absolute;	top: 0px; left: 0px; padding: 0px; border: 0px solid #000000; background-color: #000000; -webkit-transform: translate(750px,500px)";
//var cursortransform = " position: absolute;	top: 0px; left: 0px; padding: 0px; border: 0px solid #000000; background-color: #000000; -webkit-transform: translate(20px,27px)";

var bigtransform = " 	top: 0px; left: 0px; padding: 0px; border: 0px solid #000000; background-color: #000000; -webkit-transition-duration: 500ms; 	-webkit-transition-timing-function: linear; -webkit-transition-property: -webkit-transform, 0, 0; position: absolute; z-index: 700;	-webkit-border-radius: 12px; -webkit-transform: translate(0px,105px) scale(0.94)";
var maptransform = "	position: absolute; width: 254px; height: 254px; -webkit-transition-duration: 500ms; -webkit-transition-timing-function: linear; 	-webkit-transition-property: -webkit-transform, 0, 0; -webkit-transform: translate(712px,184px) ";

var monthtransform = "	position: absolute; -webkit-transform: translate(90px,50px) ";
var roundtransform1 = "	position: absolute; width: 8px; height: 8px; -webkit-transform: translate(712px,184px) ";
var roundtransform2 = "	position: absolute; width: 8px; height: 8px; -webkit-transform: translate(958px,184px) ";
var roundtransform3 = "	position: absolute; width: 8px; height: 8px; -webkit-transform: translate(958px,430px) ";
var roundtransform4 = "	position: absolute; width: 8px; height: 8px; -webkit-transform: translate(712px,430px) ";

function forceStartScreensaver()
{
    attesa=1;
    startScreensaver();
}

function startScreensaver()        //screensaver
{
    attesa = attesa -1;
    
    if (attesa<=0)
    {
        //qui parte screensaver
        bigphoto1.style.webkitTransform = "translate(120px,80px) scale(1.3)";
        bigphoto2.style.webkitTransform = "translate(120px,80px) scale(1.3)";
        
        whotext.style.visibility="hidden";
        periodtext.style.visibility="hidden";
        for (i = 0; i< size; i++)
        {
            photos[i].style.visibility="hidden";
            photos[i].setAttribute("onclick","");
        }
        cursor.style.visibility="hidden";
        togrid.style.visibility="hidden";
        togrid.setAttribute("onclick","");
        screensaverbutton.style.visibility="hidden";
        screensaverbutton.setAttribute("onclick","");
     
        bigphoto1.setAttribute("onclick","exitScreensaver()");
        bigphoto2.setAttribute("onclick","exitScreensaver()");
        map1.setAttribute("onclick","");
        map2.setAttribute("onclick","");
    
        whotext.innerHTML = "&nbsp; ";
        periodtext.innerHTML = "&nbsp; ";
        datetext.innerHTML = "&nbsp;   ";
        timetext.innerHTML = "&nbsp;  ";
        distancetext.innerHTML = "&nbsp;  ";

        map1.style.opacity=0;
        map2.style.opacity=0;
        if ( attesa < 0) //non al primo giro
        {
            currentBig = currentBig + 1;
            if (currentBig > 17) currentBig = 0;
            preloadBigNoMaps();
        }
    }
}

function exitScreensaver()        //exit screensaver
{
        attesa = WAITSS;

        bigphoto1.setAttribute("style", bigtransform);
        bigphoto2.setAttribute("style", bigtransform);
                
        whotext.style.visibility="visible";
        periodtext.style.visibility="visible";
        
        for (i = 0; i< size; i++)
        {
            photos[i].style.visibility="visible";
            photos[i].setAttribute("onclick","cliccato(this)");
        }
        cursor.style.visibility="visible";
        togrid.style.visibility="visible";
        togrid.setAttribute("onclick","gotoGrid()");
        screensaverbutton.setAttribute("onclick", "forceStartScreensaver()");
        screensaverbutton.style.visibility="visible";
    
        bigphoto1.setAttribute("onclick","suddenNextSlide()");
        bigphoto2.setAttribute("onclick","suddenNextSlide()");
        map1.setAttribute("onclick","");
        map2.setAttribute("onclick","");
    
        whotext.innerHTML = "&nbsp; ";
        periodtext.innerHTML = "&nbsp; ";
        datetext.innerHTML = "&nbsp;   ";
        timetext.innerHTML = "&nbsp;  ";
        distancetext.innerHTML = "&nbsp;  ";

        map1.style.opacity=1;
        map2.style.opacity=1;
    
        preloadBig();
}

function suddenNextSlide()
{
    
    attesa=WAITSS;
    currentBig = currentBig + 1;
    if (currentBig > 17) currentBig = 0;
    preloadBig();
}

function setupAll()
{
    body = document.getElementById("main");
    
    body.style.width="1024px";
    body.style.height="768px";

    bigphoto1 = document.createElement("img");
    map1 = document.createElement("div");
   
    bigphoto1.setAttribute("style", bigtransform);
    bigphoto1.setAttribute("onclick", "suddenNextSlide()");
        
    body.appendChild(bigphoto1);
    bigphoto2 = document.createElement("img");

    map1.setAttribute("style", maptransform);
    body.appendChild(map1);
    
    map2 = document.createElement("div");
    map2.setAttribute("style", maptransform);   
    body.appendChild(map2);
    
    bigphoto2.setAttribute("style", bigtransform);
    body.appendChild(bigphoto2);        
    bigphoto2.setAttribute("onclick", "suddenNextSlide()");
    
    bigphoto1.style.opacity=0;
    bigphoto2.style.opacity=0;
    map1.style.opacity=0;
    map2.style.opacity=0;
   
    whotext = document.createElement("div");
    whotext.innerHTML = "<h2> </h2>";
    body.appendChild(whotext);
    var whotransform = "position: absolute; -webkit-transform: translate(25px, 525px)";
    whotext.setAttribute("style", whotransform);

    datetext = document.createElement("div");
    datetext.innerHTML = "<h2>     </h2>";
    body.appendChild(datetext);
    var datetransform = "position: absolute; -webkit-transform: translate(720px,120px)";
    datetext.setAttribute("style", datetransform);

    timetext = document.createElement("div");
    timetext.innerHTML = "<h2>    </h2>";
    body.appendChild(timetext);
    var timetransform = "position: absolute; -webkit-transform: translate(720px,148px)";
    timetext.setAttribute("style", timetransform);

    periodtext = document.createElement("div");
    periodtext.innerHTML = "<h2> </h2>";
    body.appendChild(periodtext);
    var periodtransform = "position: absolute; -webkit-transform: translate(25px, 556px)";
    periodtext.setAttribute("style", periodtransform);

    distancetext = document.createElement("div");
    distancetext.innerHTML = "<h2> </h2>";
    body.appendChild(distancetext);
    var distancetransform = "position: absolute; -webkit-transform: translate(720px,450px)";
    distancetext.setAttribute("style", distancetransform);

    var x = 10;

    round1 = document.createElement("img");
    round1.setAttribute("style", roundtransform1);
    round1.setAttribute("src", "images/masks/maskul.png");
    body.appendChild(round1);
    round1.style.zIndex=666;
    round2 = document.createElement("img");
    round2.setAttribute("style", roundtransform2);
    round2.setAttribute("src", "images/masks/maskur.png");
    body.appendChild(round2);
    round2.style.zIndex=666;
    round3 = document.createElement("img");
    round3.setAttribute("style", roundtransform3);
    round3.setAttribute("src", "images/masks/maskbr.png");
    body.appendChild(round3);
    round3.style.zIndex=666;
    round4 = document.createElement("img");
    round4.setAttribute("style", roundtransform4);
    round4.setAttribute("src", "images/masks/maskbl.png");
    body.appendChild(round4);
    round4.style.zIndex=666;

    for (i=1; i <= size; i++)
    {
        photo = document.createElement("img");
        photos[i-1]=photo;
        var thumbtransform = " 	top: 0px; left: 0px; padding: 0px; border: 0px solid #000000; background-color: #ff0000; position: absolute;	-webkit-border-radius: 12px; -webkit-transform: translate(" + x+"px,40px)"
        photo.setAttribute("style", thumbtransform);
        photo.setAttribute("src", thumbs[i-1]);
        photo.setAttribute("onclick", "cliccato(this)");
        photo.setAttribute("x",x);
        photo.setAttribute("num",i);
        
        photo.style.visibility="visible";
        
        body.appendChild(photo);

        x = x+85;
    }


	var dx=80;
	var dtx=90;
	var dy=110;
	var dty=91;

    for (j=0; j < 30; j++)
    {
        day = document.createElement("img");
        days[j]=day;
        var daytransform = " 	top: 0px; left: 0px; padding: 0px; border: 0px solid #000000; background-color: #ff0000; position: absolute;	-webkit-border-radius: 12px; -webkit-transform: translate(" + dx+"px," + dy+"px)"
        day.setAttribute("style", daytransform);
        var k = (j%18)+1; 
        day.setAttribute("src", "images/thumb/"+k+".jpg");
        day.setAttribute("dx",dx);
        day.setAttribute("dy",dy);
        day.setAttribute("dn",j);
        day.style.visibility="visible";
        day.style.zIndex=-1000;
        day.style.visibility="hidden";
        
        body.appendChild(day);

        daytext[j] = document.createElement("div");
        k=j+1;
        daytext[j].innerHTML = "<h3>"+k+"</h3>";
        
        body.appendChild(daytext[j]);
        daytexttransform = "position: absolute; -webkit-transform: translate("+dtx+"px, "+ dty +"px)";
        daytext[j].setAttribute("style", daytexttransform);
        
        daytext[j].style.zIndex=-1000;
        daytext[j].style.visibility="hidden";
        
        dx = dx+100;
        dtx = dtx+100;
        if (dx>700)
        {
            dty = dty+75;
            dy = dy+75;
            dx = 80;
            dtx=90;
        }
        
    }
    
    cursor = document.createElement("img");
    cursortransform = "	position: absolute; top: 0px; left: 0px; padding: 0px; border: 0px solid #000000; background-color: #000000; -webkit-transform: translate("+(photos[0].x+100)+"px,27px)";
    cursor.setAttribute("style", cursortransform);
    body.appendChild(cursor);
    cursor.setAttribute("src", "images/elements/cursor.jpg");
    cursor.style.zIndex=-1;
    
    prefs = document.createElement("img");
    var prefstransform = "	position: absolute; top: 0px; left: 0px; padding: 0px; border: 0px solid #000000; background-color: #000000; -webkit-transform: translate(720px,450px)";
    prefs.setAttribute("style", prefstransform);
    body.appendChild(prefs);
    prefs.setAttribute("src", "images/elements/settings.png");
    prefs.style.zIndex=-1;
    prefs.style.visibility="hidden";
    
    screensaverbutton = document.createElement("img");
    var screensaverbuttontransform = "	position: absolute; top: 0px; left: 0px; padding: 0px; border: 0px solid #000000; background-color: #000000; -webkit-transform: translate(930px,520px)";
    screensaverbutton.setAttribute("style", screensaverbuttontransform);
    body.appendChild(screensaverbutton);
    screensaverbutton.setAttribute("src", "images/elements/ss.jpg");
    screensaverbutton.setAttribute("onclick", "forceStartScreensaver()");
    screensaverbutton.style.zIndex=333;
    screensaverbutton.style.visibility="visible";
    
    month = document.createElement("div");
    month.setAttribute("style", monthtransform);
    body.appendChild(month);
    month.style.zIndex=-2;
    month.style.visibility="hidden";
    month.innerHTML = "<h2>March 2010</h2>";
    
    togrid = document.createElement("img");
    togridtransform = "	position: absolute; top: 0px; left: 0px; padding: 0px; border: 0px solid #000000; background-color: #000000; -webkit-transform: translate(930px,560px)";
    togrid.setAttribute("style", togridtransform);
    togrid.setAttribute("onclick", "gotoGrid()");
    body.appendChild(togrid);
    togrid.setAttribute("src", "images/elements/grid.png");
    togrid.style.zIndex=699;
    
    var hashnum = window.location.hash.match(/\d+/);
    
    if (window.location.hash == "#grid")
    {
        gotoGrid();
    }
    else if (window.location.hash.length>0)
    {
        cliccato(photos[hashnum]);
    }
    else
    {
        cliccato(photos[0]);        //faccio vedere la prima
    }
}

function gotoGrid()
{
    clearInterval ( interval );     //disattiva screensaver
    
    window.location.hash = "grid";
    
    for (i = 0; i< size; i++)
    {
        photos[i].style.visibility="hidden";
        photos[i].setAttribute("onclick","");
    }

    cursor.style.visibility="hidden";
    month.style.visibility="visible";
    prefs.style.visibility="visible";
    month.innerHTML = "<h2>March 2010</h2>";
    
    togrid.style.visibility="hidden";
    togrid.setAttribute("onclick","");
    screensaverbutton.style.visibility="hidden";
    screensaverbutton.setAttribute("onclick", "");
    
    bigphoto1.setAttribute("onclick","");
    bigphoto2.setAttribute("onclick","");
    map1.setAttribute("onclick","");
    map2.setAttribute("onclick","");
    
    whotext.innerHTML = "&nbsp; ";
    periodtext.innerHTML = "&nbsp; ";
    datetext.innerHTML = "&nbsp;   ";
    timetext.innerHTML = "&nbsp;  ";
    distancetext.innerHTML = "&nbsp;  ";

    bigphoto1.style.opacity=0;
    bigphoto2.style.opacity=0;
    map1.style.opacity=0;
    map2.style.opacity=0;
    
    for (j=0; j<30; j++)
    {
        days[j].style.visibility="visible";
        daytext[j].style.visibility="visible";
        days[j].setAttribute("onclick", "gotoSlide()");
        days[j].style.zIndex=1111;
    }
}

function gotoSlide()
{
    for (j=0; j<30; j++)
    {
        days[j].style.visibility="hidden";
        days[j].setAttribute("onclick", "");
        days[j].style.zIndex=-1000;
        daytext[j].style.visibility="hidden";
    }
    for (i = 0; i< size; i++)
    {
        photos[i].style.visibility="visible";
        photos[i].style.visibility="visible";
        photos[i].setAttribute("onclick","cliccato(this)");
    }

    cursor.style.visibility="visible";
    month.style.visibility="hidden";
    prefs.style.visibility="hidden";
    
    togrid.style.visibility="visible";
    togrid.setAttribute("onclick","gotoGrid()");
 
    screensaverbutton.setAttribute("onclick", "forceStartScreensaver()");
    screensaverbutton.style.visibility="visible";
    
    bigphoto1.setAttribute("onclick","suddenNextSlide()");
    bigphoto2.setAttribute("onclick","suddenNextSlide()");
    map1.setAttribute("onclick","");
    map2.setAttribute("onclick","");
    
    whotext.innerHTML = "&nbsp; ";
    periodtext.innerHTML = "&nbsp; ";
    datetext.innerHTML = "&nbsp;   ";
    timetext.innerHTML = "&nbsp;  ";
    distancetext.innerHTML = "&nbsp;  ";
    
    clearInterval ( interval );
    currentBig = 1;         //sempre questa
    preloadBig();
    attesa=WAITSS;
    interval = setInterval( startScreensaver , 6000 );

}

function cliccato(photo)
{
    clearInterval ( interval );
    if (currentBig != (photo.getAttribute("num") - 1 ) )
    {
        currentBig = photo.getAttribute("num") - 1;
        preloadBig();
    }
    attesa=WAITSS;
    interval = setInterval( startScreensaver , 6000 );
}

function preloadBig()
{
    window.location.hash = currentBig;
    var num = photos[currentBig].getAttribute("x");
    var sottr = -17;
    num = num-sottr;

    cursor.style.webkitTransform = "translate("+num+"px,27px) scale(0.7)";  //todo editare immagine e levare scale

    if (seconda<1)
    {
        bigphoto1.setAttribute("src", "images/"+(currentBig+1)+".jpg");
        if (bigphoto1.complete)
        {
            showPhoto(photos[currentBig]);
        }
        else
        {
            bigphoto1.setAttribute("onload", "showPhoto(photos[currentBig])");
        }
    }
    else
    {
        bigphoto2.setAttribute("src", "images/"+(currentBig+1)+".jpg");
        if (bigphoto2.complete)
        {
            showPhoto(photos[currentBig]);
        }
        else
        {
            bigphoto2.setAttribute("onload","showPhoto(photos[currentBig])"); 
        }
    }
    if (secondam<1)
    {
        loadMap(map1);
    }
    else
    {
        loadMap(map2);
    }
}

function preloadBigNoMaps()
{
    window.location.hash = currentBig;
    var num = photos[currentBig].getAttribute("x");
    var sottr = -17;
    num = num-sottr;

    cursor.style.webkitTransform = "translate("+num+"px,30px) scale(0.7)";  //todo editare immagine e levare scale

    if (seconda<1)
    {
        bigphoto1.setAttribute("src", "images/"+(currentBig+1)+".jpg");
        if (bigphoto1.complete)
        {
            showPhoto(photos[currentBig]);
        }
        else
        {
            bigphoto1.setAttribute("onload", "showPhoto(photos[currentBig])");
        }
    }
    else
    {
        bigphoto2.setAttribute("src", "images/"+(currentBig+1)+".jpg");
        if (bigphoto2.complete)
        {
            showPhoto(photos[currentBig]);
        }
        else
        {
            bigphoto2.setAttribute("onload","showPhoto(photos[currentBig])"); 
        }
    }
}

function showMap(photo)
{
    map1.setAttribute("onload", "");
    map2.setAttribute("onload", "");

    datetext.innerHTML = "<h2>"+datestring[ 0 ]+ "</h2>";
    timetext.innerHTML = "<h2>"+timestring[ photo.getAttribute("num")-1  ]+ "</h2>";
    distancetext.innerHTML = "<h2>"+distancestring[ photo.getAttribute("num")-1  ]+ "</h2>";
    
    body = document.getElementById("main");

    if (secondam<1)
    {
        secondam=666;
        map1.style.zIndex=665;
        map2.style.zIndex=664;
        
        map1.style.opacity=1;
        map2.style.opacity=0;
    }
    else
    {
        secondam=0;
        map2.style.zIndex=665;
        map1.style.zIndex=664;
        map1.style.opacity=0;
        map2.style.opacity=1;
    }
}

function showPhoto(photo)
{
    bigphoto1.setAttribute("onload", "");
    bigphoto2.setAttribute("onload", "");

    whotext.innerHTML = "<h2>"+whostring[ photo.getAttribute("num")-1 ]+ "</h2>";
    periodtext.innerHTML = "<h2>"+periodstring[ photo.getAttribute("num")-1  ]+ "</h2>";

    body = document.getElementById("main");

    if (seconda<1)
    {
        seconda=666;
        bigphoto1.style.opacity=1;
        bigphoto2.style.opacity=0;
    }
    else
    {
        seconda=0;
        bigphoto1.style.opacity=0;
        bigphoto2.style.opacity=1;
    }
}

</script>
</head>
<body>
	<div id="navigation"></div>
	<div id="main"></div>
	
<?php
if ( DEBUG == true ) {
	?>
		<div id="debug">
			<pre><?php print_r( $_SESSION ); ?></pre>
		</div>
	<?php
}
?>
</body>
</html>
