// provides menu functionality in the administration interface

function get_x(obj){
	var xpos = 0;
	if (obj.offsetParent){
		while (obj.offsetParent){
			xpos += obj.offsetLeft;
			obj = obj.offsetParent;
		}
	}
	else if (obj.x)	xpos += obj.x;
	return xpos;
}

function get_y(obj){
	var ypos = 0;
	if (obj.offsetParent){
		while (obj.offsetParent){
			ypos += obj.offsetTop;
			obj = obj.offsetParent;
		}
	}
	else if (obj.y) ypos += obj.y;
	return ypos;
}
	
function show_menu(obj){

	var x = get_x(obj);
	var y = get_y(obj);
	
	document.getElementById('menu').style.left = x;
	document.getElementById('menu').style.top = y + 14;

	document.getElementById('menu').style.visibility = 'visible';
	
}

function hide_menus(){
	document.getElementById('menu').style.visibility = 'hidden';
	
}