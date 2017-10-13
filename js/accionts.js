function print(arg){
	console.log(arg);
};


var vs=0;
$(".dropdown").click(function(){
	
	
	if(vs==0){
		vs=1;
		$(".dropdown-content").css({
        display: 'block'
    	});
	}else if (!($('.dropdown-content').is(':hover'))){
		vs=0;
		
		$(".dropdown-content").css({
        display: 'none'
    });
	}
	
	

});

$(".log").click(function(){
	if ($("#user").val()!=" " && $("#pasword").val()!=" " ) {
		print("ajax");
		$.ajax({
            type: 'post',
            url: '../php/back.php',
            data: $('form').serialize(),
            dataType:'JSON',
            success: function (result) {
            	print(result);
                if(result=="true"){
                	print(result);
                }
              
            }
          });
	}


});