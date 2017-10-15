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


$(".btn-logup").click(function(){
		$("#contenido").load('../html/logup.html #sign-up');
		$("#contenido").on('click',"#send-up",function(){
			print("ss");
			$.ajax({
            type: 'post',
            url: '../php/back.php',
            data: $('#logup').serialize(),
            dataType:'JSON',
            success: function (result) {
            	print(result);
                if(result.ok=="entro"){
                	print(result);
                	print(result.row);
                		$("#id_nombre").html(result.row.nombre);
						$("#id_apellido").html(result.row.apellido);
						$("#id_cedula").html(result.row.cedula);
						$("#id_direccion").html(result.row.direccion);
						$("#id_email").html(result.row.email);
						$("#id_telefono").html(result.row.telefono);
						$("#id_username").html(result.row.username);
						$("#id_pass").html(result.row.pass);
                	

          			// print(result.row);
          			// $("#tik").html(result.row.nombre);
          			// $("#usul").html(result.row.nombre);
          			// $(".dropdown-content").css({display: 'none'});


                }
              
            }
          });
		});

		}
);

	$("#send").click(function(){
	print($('#login').serialize());
	if ($("#user").val()!=" " && $("#pasword").val()!=" " ) {
		print("ajax");
		$.ajax({
            type: 'post',
            url: '../php/back.php',
            data: $('#login').serialize(),
            dataType:'JSON',
            success: function (result) {
            	print(result);
                if(result.ok=="entro"){
                	print(result);
                	print(result.row);
                	$("#contenido").load('../html/user.html');
          			print(result.row);
          			$("#tik").html(result.row.nombre);
          			$("#usul").html(result.row.nombre);
          			$(".dropdown-content").css({display: 'none'});


                }
              
            }
          });
	}


});
