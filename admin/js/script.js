tinymce.init({
	selector: 'textarea'
});


$(document).ready(function(){
	$('#selectAllBoxes').on('click',function(){
		if(this.checked){
			$(".checkBoxes").each(function(){
				this.checked=true;
			});
		}else{
			$(".checkBoxes").each(function(){
				this.checked=false;
			});
		}
	});

	$('#con').on('click',function(event){
		//prevent the link
		event.preventDefault();
		//alert('here');
		var answer = confirm("Are you sure you want to delete?");

		var href = $(this).attr('href');
		if(answer){
			//redirect to the link
			window.location=href;
		}
	});


	
	$("#apply").on('click',function(event){
		if($('#option_selection').val() == "delete"){
			var answer = confirm("Are you sure you want to delete?");
    		if (!answer) {
        		return false;
    		}
		}
	});
	
	//loader
	var div_box="<div id='load-screen'><div id='loading'></div></div>";
	$("body").prepend(div_box);

	$('#load-screen').delay(500).fadeOut(600,function(){
		$(this).remove();
	});
});


function load_user_online(){
	//use ajax to send request to function.php
	$.get("function.php?onlineuser=result",function(data){
		$('.useronline').text(data);
	});
}

//set interval to 500ms
setInterval(function(){
	load_user_online();
},500);



