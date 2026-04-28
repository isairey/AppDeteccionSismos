/*
*
*  Mac OS X Dock script by John Pennypacker
*  3-31-2005
*  http://blog.pennypacker.net
*  http://www.pennypacker.net
*  http://www.fuzzycoconut.com
*  If you are gonna use this script, let me know, I'd love to see it 
*  please leave this notice intact
*
*/

var minZ = 32;
var maxZ = 96;
var range = 3;


var theDiv;
var incZ = (maxZ - minZ)/range;
var IEeM = document.all?true:false;
var tX = 0;
var tY = 0;

dockArray = new Array();

//rewrite the markup from a list
function reWrite() {
	theDiv = document.getElementById('dock');	if(!theDiv) return;
	theDiv.style.paddingTop = (minZ-(minZ/4)) + "px";
	var dockItems = theDiv.getElementsByTagName('li');
		for (var i=0; i<dockItems.length; i++) {
			dockItems[i].firstChild.innerHTML="";
			dockItems[i].firstChild.style.margin="0 -.5em";
			var itemName = dockItems[i].firstChild.getAttributeNode('title').nodeValue;
			var itemImage = itemName.replace(/\s+/g, "");
			var itemImage = "img/" + itemImage.toLowerCase() + ".png";
			addEvent(dockItems[i], 'mouseover', desc);
			addEvent(dockItems[i], 'mouseout', undesc);
			if(IEeM) { dockItems[i].firstChild.style.paddingTop = "0"; }

			//create the span
			var s = document.createElement('span');
			s.setAttribute("class","desc");
			s.setAttribute("id","desc"+i);
			s.style.visibility = "hidden";
			var t = document.createTextNode(itemName);
			s.appendChild(t);
			dockItems[i].firstChild.appendChild(s);


			//create the icon
			var a = document.createElement('img');
			a.setAttribute("src",itemImage);
			a.setAttribute("alt",itemName);
			a.style.width = a.style.height = minZ + "px";
			dockItems[i].firstChild.appendChild(a);
			dockArray[i] = dockItems[i];
			}
	}

function desc() {
	if(IEeM) {
		var tli = event.srcElement;
		while(tli.nodeName != "LI") {
				tli = tli.parentNode;
				}
			tli = tli.getElementsByTagName('span')[0];
			} else {
			tli = this.getElementsByTagName('span')[0];
			}
		tli.style.visibility = "visible";
		if(navigator.userAgent.indexOf("Safari") != -1) { //Skip the fade effect for Safari because Safari can't do it
			setOpacity(tli, 100);
			} else {
			fadeIn(tli.getAttributeNode('id').nodeValue,20); 
			}
		} 
function undesc() {
	if(IEeM) {
		var tli = event.srcElement;
		while(tli.nodeName != "LI") {
				tli = tli.parentNode;
				}
			tli = tli.getElementsByTagName('span')[0];
			} else {
			tli = this.getElementsByTagName('span')[0];
			}
		tli.style.visibility = "hidden";
		}

function fadeIn(objId,opacity) {
	obj = document.getElementById(objId);
	if(opacity < 100) {
		setOpacity(obj, opacity);
		opacity += 20;
		window.setTimeout("fadeIn('"+objId+"',"+opacity+")", 100);
		}
	}
function setOpacity(obj,opacity) {
	opacity = (opacity == 100)?99.999:opacity;
	// IE/Win
	obj.style.filter = "alpha(opacity:"+opacity+")";
	// Safari<1.2, Konqueror
	obj.style.KHTMLOpacity = opacity/100;
	// Older Mozilla and Firefox
	obj.style.MozOpacity = opacity/100;
	// Safari 1.2, newer Firefox and Mozilla, CSS3
	obj.style.opacity = opacity/100;
	//alert(opacity/100 + " on: " + obj.innerHTML);
	}


//ensure that all onload events are executed thanks to quirksmode.org
function addEvent(obj, evType, fn){
	if (obj.addEventListener){
		obj.addEventListener(evType, fn, false); //changed from true at the request of hallvors
		return true;
		} else if (obj.attachEvent){
			var r = obj.attachEvent('on'+evType, fn);
			return r;
			} else {
			return false;
			}
	}
//load up the onload events
addEvent(window, 'load', reWrite);

function getX(obj) {
	var curleft = 0;
	if(obj.offsetParent) {
		while(obj.offsetParent) {
			curleft += obj.offsetLeft
			obj = obj.offsetParent;
			}
		}
	else if(obj.x) {
		curleft += obj.x;
			}
	return curleft;
	}

function getY(obj) {
	var curtop = 0;
	if(obj.offsetParent) {
		while(obj.offsetParent) {
			curtop += obj.offsetTop
			obj = obj.offsetParent;
			}
		}
	else if(obj.y) {
		curtop += obj.y;
		}
	return curtop;
	}


document.onmousemove = getMouseXY;
if(!IEeM) {document.captureEvents(Event.MOUSEMOVE);} //hide this from IE

function getMouseXY(e) {
	if(IEeM) { // grab the x-y if browser is IE
		tX = event.clientX + document.body.scrollLeft;
		tY = event.clientY + document.body.scrollTop;
		} else {  // grab the x-y pos.s if browser is not IE
		tX = e.pageX;
		tY = e.pageY;
		}  
	dockX = getX(theDiv);
	widthX = getX(dockArray[(dockArray.length-1)]) + 128;
	dockY = getY(document.getElementById('dockContainer'));

	if(dockX && dockArray) {
		if(tY>dockY && tX>dockX && tX<widthX) {
			for(var j=0; j<dockArray.length; j++) {
				var x = dockArray[j].offsetLeft;
				var xw = (x*1)+maxZ;
				
				if(tX>x && tX<(xw)) {
					var xdif = tX - x;
					var oxdif = maxZ-xdif;
					var xPercent = xdif/maxZ;
					var oxPercent = 1-xPercent;
					
					t = dockArray[j].getElementsByTagName('img')[0].style;
					t.width = t.height = maxZ + "px";
					

					if(dockArray[j+1]) {
						var n = dockArray[j+1].getElementsByTagName('img')[0].style;
						n.width = n.height = (maxZ-incZ) + (xPercent*incZ) + "px";
						}
					if(dockArray[j+2]) {
						var n = dockArray[j+2].getElementsByTagName('img')[0].style;
						n.width = n.height = maxZ-(2*incZ) + ((xPercent*incZ)/3) + "px";
						}
					if(dockArray[j+3]) {
						var n = dockArray[j+3].getElementsByTagName('img')[0].style;
						n.width = n.height = minZ + ((xPercent*incZ)/4) + "px";
						}
					if(dockArray[j+4]) {
						var n = dockArray[j+4].getElementsByTagName('img')[0].style;
						n.width = n.height = minZ + "px";
						}

					if(dockArray[j-1]) {
						var p = dockArray[j-1].getElementsByTagName('img')[0].style;
						p.width = p.height = (maxZ-incZ) + (oxPercent*incZ) + "px";
						}
					if(dockArray[j-2]) {
						var p = dockArray[j-2].getElementsByTagName('img')[0].style;
						p.width = p.height =  maxZ-(2*incZ) + (oxPercent*incZ) + "px";
						}
					if(dockArray[j-3]) {
						var p = dockArray[j-3].getElementsByTagName('img')[0].style;
						p.width = p.height =  minZ + (oxPercent*incZ) + "px";
						}
					if(dockArray[j-4]) {
						var p = dockArray[j-4].getElementsByTagName('img')[0].style;
						p.width = p.height =  minZ + "px";
						}
					}
				}
			}
		if(dockY>tY || tX<2 || tX<dockX || tX>(dockArray[(dockArray.length-1)].offsetLeft+(maxZ*1))) {
			//reset sizes
			for (var k=0; k<dockArray.length; k++) {
				ll = dockArray[k].getElementsByTagName('img')[0];
				ll.style.width = ll.style.height = minZ + "px";
				}
			}
		}
	return true;
}
