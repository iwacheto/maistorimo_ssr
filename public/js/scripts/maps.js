!function(e){var t={};function o(i){if(t[i])return t[i].exports;var l=t[i]={i:i,l:!1,exports:{}};return e[i].call(l.exports,l,l.exports,o),l.l=!0,l.exports}o.m=e,o.c=t,o.d=function(e,t,i){o.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:i})},o.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},o.t=function(e,t){if(1&t&&(e=o(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var i=Object.create(null);if(o.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var l in e)o.d(i,l,function(t){return e[t]}.bind(null,l));return i},o.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return o.d(t,"a",t),t},o.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},o.p="/",o(o.s=224)}({224:function(e,t,o){e.exports=o(225)},225:function(e,t,o){function i(e){return(i="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}var l="star-rating";!function(e){"use strict";var t=document.getElementById("map");void 0!==t&&null!=t&&google.maps.event.addDomListener(window,"load",(function(){var t=new InfoBox;function o(e,t,o,i,n,r){return'<a href="'+e+'" class="listing-img-container"><div class="infoBox-close"><i class="fa fa-times"></i></div><img src="'+t+'" alt=""><div class="listing-item-content"><h3>'+o+"</h3><span>"+i+'</span></div></a><div class="listing-content"><div class="listing-title"><div class="'+l+'" data-rating="'+n+'"><div class="rating-counter">('+r+" reviews)</div></div></div></div>"}var r=[[o("listings-single-page.html","images/listing-item-01.jpg","Tom's Restaurant","964 School Street, New York","3.5","12"),40.94401669296697,-74.16938781738281,1,'<i class="im im-icon-Chef-Hat"></i>'],[o("listings-single-page.html","images/listing-item-02.jpg","Sticky Band","Bishop Avenue, New York","5.0","23"),40.77055783505125,-74.26002502441406,2,'<i class="im im-icon-Electric-Guitar"></i>'],[o("listings-single-page.html","images/listing-item-03.jpg","Hotel Govendor","778 Country Street, New York","2.0","17"),40.7427837,-73.11445617675781,3,'<i class="im im-icon-Home-2"></i>'],[o("listings-single-page.html","images/listing-item-04.jpg","Burger House","2726 Shinn Street, New York","5.0","31"),40.70437865245596,-73.98674011230469,4,'<i class="im im-icon-Hamburger"></i>'],[o("listings-single-page.html","images/listing-item-05.jpg","Airport","1512 Duncan Avenue, New York","3.5","46"),40.641311,-73.778139,5,'<i class="im im-icon-Plane"></i>'],[o("listings-single-page.html","images/listing-item-06.jpg","Think Coffee","215 Terry Lane, New York","4.5","15"),41.080938,-73.535957,6,'<i class="im im-icon-Coffee"></i>'],[o("listings-single-page.html","images/listing-item-04.jpg","Burger House","2726 Shinn Street, New York","5.0","31"),41.079386,-73.519478,7,'<i class="im im-icon-Hamburger"></i>'],[o("listings-single-page.html","images/listing-item-04.jpg","Burger House","2726 Shinn Street, New York","5.0","31"),52.36863,4.895782,7,'<i class="im im-icon-Hamburger"></i>'],[o("listings-single-page.html","images/listing-item-04.jpg","Burger House","2726 Shinn Street, New York","5.0","31"),52.350179,4.634857,7,'<i class="im im-icon-Hamburger"></i>']];google.maps.event.addListener(t,"domready",(function(){(l="numerical-rating")&&numericalRating(".infoBox ."+l),(l="star-rating")&&starRating(".infoBox ."+l)}));var a=e("#map").attr("data-map-zoom"),s=e("#map").attr("data-map-scroll");if("undefined"!==i(a)&&!1!==a)var m=parseInt(a);else m=5;if("undefined"!==i(s)&&!1!==s)var c=parseInt(s);else c=!1;var p=new google.maps.Map(document.getElementById("map"),{zoom:m,scrollwheel:c,center:new google.maps.LatLng(40.8,-73.7),mapTypeId:google.maps.MapTypeId.ROADMAP,zoomControl:!1,mapTypeControl:!1,scaleControl:!1,panControl:!1,navigationControl:!1,streetViewControl:!1,gestureHandling:"cooperative",styles:[{featureType:"poi",elementType:"labels.text.fill",stylers:[{color:"#747474"},{lightness:"23"}]},{featureType:"poi.attraction",elementType:"geometry.fill",stylers:[{color:"#f38eb0"}]},{featureType:"poi.government",elementType:"geometry.fill",stylers:[{color:"#ced7db"}]},{featureType:"poi.medical",elementType:"geometry.fill",stylers:[{color:"#ffa5a8"}]},{featureType:"poi.park",elementType:"geometry.fill",stylers:[{color:"#c7e5c8"}]},{featureType:"poi.place_of_worship",elementType:"geometry.fill",stylers:[{color:"#d6cbc7"}]},{featureType:"poi.school",elementType:"geometry.fill",stylers:[{color:"#c4c9e8"}]},{featureType:"poi.sports_complex",elementType:"geometry.fill",stylers:[{color:"#b1eaf1"}]},{featureType:"road",elementType:"geometry",stylers:[{lightness:"100"}]},{featureType:"road",elementType:"labels",stylers:[{visibility:"off"},{lightness:"100"}]},{featureType:"road.highway",elementType:"geometry.fill",stylers:[{color:"#ffd4a5"}]},{featureType:"road.arterial",elementType:"geometry.fill",stylers:[{color:"#ffe9d2"}]},{featureType:"road.local",elementType:"all",stylers:[{visibility:"simplified"}]},{featureType:"road.local",elementType:"geometry.fill",stylers:[{weight:"3.00"}]},{featureType:"road.local",elementType:"geometry.stroke",stylers:[{weight:"0.30"}]},{featureType:"road.local",elementType:"labels.text",stylers:[{visibility:"on"}]},{featureType:"road.local",elementType:"labels.text.fill",stylers:[{color:"#747474"},{lightness:"36"}]},{featureType:"road.local",elementType:"labels.text.stroke",stylers:[{color:"#e9e5dc"},{lightness:"30"}]},{featureType:"transit.line",elementType:"geometry",stylers:[{visibility:"on"},{lightness:"100"}]},{featureType:"water",elementType:"all",stylers:[{color:"#d2e7f7"}]}]});e(".listing-item-container").on("mouseover",(function(){if(void 0!==e(this).data("marker-id")){var t=e(this).data("marker-id")-1,o=u[t].div;e(o).addClass("clicked"),e(this).on("mouseout",(function(){e(o).is(":not(.infoBox-opened)")&&e(o).removeClass("clicked")}))}}));var g=document.createElement("div");g.className="map-box";var d,y,f={content:g,disableAutoPan:!1,alignBottom:!0,maxWidth:0,pixelOffset:new google.maps.Size(-134,-55),zIndex:null,boxStyle:{width:"270px"},closeBoxMargin:"0",closeBoxURL:"",infoBoxClearance:new google.maps.Size(25,25),isHidden:!1,pane:"floatPane",enableEventPropagation:!1},u=[];for(d=0;d<r.length;d++){y=r[d][4];var v=new n(new google.maps.LatLng(r[d][1],r[d][2]),p,{marker_id:d},y);u.push(v),google.maps.event.addDomListener(v,"click",function(o,i){return function(){t.setOptions(f),g.innerHTML=r[i][0],t.close(),t.open(p,o),r[i][3],google.maps.event.addListener(t,"domready",(function(){e(".infoBox-close").click((function(o){o.preventDefault(),t.close(),e(".map-marker-container").removeClass("clicked infoBox-opened")}))}))}}(v,d))}new MarkerClusterer(p,u,{imagePath:"images/",styles:[{textColor:"white",url:"",height:50,width:50}],minClusterSize:2}),google.maps.event.addDomListener(window,"resize",(function(){var e=p.getCenter();google.maps.event.trigger(p,"resize"),p.setCenter(e)}));var T=document.createElement("div");new function(e,t){T.index=1,t.controls[google.maps.ControlPosition.RIGHT_CENTER].push(T),e.style.padding="5px",e.className="zoomControlWrapper";var o=document.createElement("div");e.appendChild(o);var i=document.createElement("div");i.className="custom-zoom-in",o.appendChild(i);var l=document.createElement("div");l.className="custom-zoom-out",o.appendChild(l),google.maps.event.addDomListener(i,"click",(function(){t.setZoom(t.getZoom()+1)})),google.maps.event.addDomListener(l,"click",(function(){t.setZoom(t.getZoom()-1)}))}(T,p);var h=e("#scrollEnabling");e(h).click((function(t){t.preventDefault(),e(this).toggleClass("enabled"),e(this).is(".enabled")?p.setOptions({scrollwheel:!0}):p.setOptions({scrollwheel:!1})})),e("#geoLocation, .input-with-icon.location a").click((function(e){e.preventDefault(),navigator.geolocation&&navigator.geolocation.getCurrentPosition((function(e){var t=new google.maps.LatLng(e.coords.latitude,e.coords.longitude);p.setCenter(t),p.setZoom(12)}))}))}));var o=document.getElementById("singleListingMap");function n(e,t,o,i){this.latlng=e,this.args=o,this.markerIco=i,this.setMap(t)}void 0!==o&&null!=o&&google.maps.event.addDomListener(window,"load",(function(){var t=new google.maps.LatLng({lng:e("#singleListingMap").data("longitude"),lat:e("#singleListingMap").data("latitude")}),o=new google.maps.Map(document.getElementById("singleListingMap"),{zoom:15,center:t,scrollwheel:!1,zoomControl:!1,mapTypeControl:!1,scaleControl:!1,panControl:!1,navigationControl:!1,streetViewControl:!1,styles:[{featureType:"poi",elementType:"labels.text.fill",stylers:[{color:"#747474"},{lightness:"23"}]},{featureType:"poi.attraction",elementType:"geometry.fill",stylers:[{color:"#f38eb0"}]},{featureType:"poi.government",elementType:"geometry.fill",stylers:[{color:"#ced7db"}]},{featureType:"poi.medical",elementType:"geometry.fill",stylers:[{color:"#ffa5a8"}]},{featureType:"poi.park",elementType:"geometry.fill",stylers:[{color:"#c7e5c8"}]},{featureType:"poi.place_of_worship",elementType:"geometry.fill",stylers:[{color:"#d6cbc7"}]},{featureType:"poi.school",elementType:"geometry.fill",stylers:[{color:"#c4c9e8"}]},{featureType:"poi.sports_complex",elementType:"geometry.fill",stylers:[{color:"#b1eaf1"}]},{featureType:"road",elementType:"geometry",stylers:[{lightness:"100"}]},{featureType:"road",elementType:"labels",stylers:[{visibility:"off"},{lightness:"100"}]},{featureType:"road.highway",elementType:"geometry.fill",stylers:[{color:"#ffd4a5"}]},{featureType:"road.arterial",elementType:"geometry.fill",stylers:[{color:"#ffe9d2"}]},{featureType:"road.local",elementType:"all",stylers:[{visibility:"simplified"}]},{featureType:"road.local",elementType:"geometry.fill",stylers:[{weight:"3.00"}]},{featureType:"road.local",elementType:"geometry.stroke",stylers:[{weight:"0.30"}]},{featureType:"road.local",elementType:"labels.text",stylers:[{visibility:"on"}]},{featureType:"road.local",elementType:"labels.text.fill",stylers:[{color:"#747474"},{lightness:"36"}]},{featureType:"road.local",elementType:"labels.text.stroke",stylers:[{color:"#e9e5dc"},{lightness:"30"}]},{featureType:"transit.line",elementType:"geometry",stylers:[{visibility:"on"},{lightness:"100"}]},{featureType:"water",elementType:"all",stylers:[{color:"#d2e7f7"}]}]});e("#streetView").click((function(e){e.preventDefault(),o.getStreetView().setOptions({visible:!0,position:t})}));var i=document.createElement("div");new function(e,t){i.index=1,t.controls[google.maps.ControlPosition.RIGHT_CENTER].push(i),e.style.padding="5px";var o=document.createElement("div");e.appendChild(o);var l=document.createElement("div");l.className="custom-zoom-in",o.appendChild(l);var n=document.createElement("div");n.className="custom-zoom-out",o.appendChild(n),google.maps.event.addDomListener(l,"click",(function(){t.setZoom(t.getZoom()+1)})),google.maps.event.addDomListener(n,"click",(function(){t.setZoom(t.getZoom()-1)}))}(i,o);var l="<i class='"+e("#singleListingMap").data("map-icon")+"'></i>";new n(t,o,{marker_id:"1"},l)})),n.prototype=new google.maps.OverlayView,n.prototype.draw=function(){var t=this,o=this.div;o||((o=this.div=document.createElement("div")).className="map-marker-container",o.innerHTML='<div class="marker-container"><div class="marker-card"><div class="front face">'+t.markerIco+'</div><div class="back face">'+t.markerIco+'</div><div class="marker-arrow"></div></div></div>',google.maps.event.addDomListener(o,"click",(function(o){e(".map-marker-container").removeClass("clicked infoBox-opened"),google.maps.event.trigger(t,"click"),e(this).addClass("clicked infoBox-opened")})),void 0!==t.args.marker_id&&(o.dataset.marker_id=t.args.marker_id),this.getPanes().overlayImage.appendChild(o));var i=this.getProjection().fromLatLngToDivPixel(this.latlng);i&&(o.style.left=i.x+"px",o.style.top=i.y+"px")},n.prototype.remove=function(){this.div&&(this.div.parentNode.removeChild(this.div),this.div=null,e(this).removeClass("clicked"))},n.prototype.getPosition=function(){return this.latlng}}(this.jQuery)}});