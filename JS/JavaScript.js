var count = 1;
var counter = 1;
setInterval(function(){
	document.getElementById('radio' + count).checked = true;
	count++;
	if(count > 2){
		count = 1;
	}
}, 5000);

function toggle(id){
	document.getElementById(id).style.display = "block";
}

function closebtn(id){
	document.getElementById(id).style.display = "none";
}

function addField(){
	counter+=1;
	html='<div class="mb-3">\
	<label>Stop</label>\
	<br>\
		<select name="s'+counter+'" class="form-control" style="text-align: center; background-color: white;">\
		<option disabled selected>--Select Stop--</option>\
	</select>\
</div>\
<div class="mb-3">\
	<label>Time</label>\
	<input type="time" class="form-control" name="t'+counter+'" placeholder="Enter Time">\
</div>'
var form = document.getElementById('Addform')
form.innerHTML += html
}


function gotopage(pagename)
{
	window.location.href = pagename;
}

function print()
{
	// var doc = new jsPDF();

	// var html = document.querySelector("#confirmation");

	// alert(html);
	
}