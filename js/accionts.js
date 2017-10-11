function print(arg){
	console.log(arg);
};


var vs=0;
$(".dropdown").click(function(){
	
	if ($('.dropdown-content').is(':hover')) {
        print("aja");
    }


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