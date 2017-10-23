function print(arg){
	console.log(arg);
};

function crearTr(data){
	var tri="<tr id=";
	var tdi="<td>";
	var tre="</tr>";
	var tde="</td>";
	var da="";
  if (ad=="1") {
    for (var i = 0; i < data.length; i++) {
    da+=tri+data[i].id_vo+">";
    da+=tdi+data[i].nombre+tde;
    da+=tdi+data[i].apellido+tde;
    da+=tdi+data[i].cedula+tde;
    da+=tdi+data[i].nom+tde;
    da+=tdi+data[i].ubicacion+tde;
    da+="<td id=\""+data[i].id_vo+"\"><a id=\"ver\" alt=\"Ver registro\">View</a><a id=\"edit\" alt=\"Editar registro\">Edit</a><a id=\"eliminar\" alt=\"Eliminar registro\">Clear</a></td>";
    da+=tre;
    
  }
  }else{
  for (var i = 0; i < data.length; i++) {
    da+=tri+data[i].id_vo+">";
    da+=tdi+data[i].nom+tde;
    da+=tdi+"1"+tde;
    da+=tdi+data[i].ser+tde;
    da+=tdi+data[i].fecha+tde;
    da+=tdi+data[i].ubicacion+tde;
    da+="<td id=\""+data[i].id_vo+"\"><a id=\"ver\" alt=\"Ver registro\">View</a><a id=\"edit\" alt=\"Editar registro\">Edit</a><a id=\"eliminar\" alt=\"Eliminar registro\">Clear</a></td>";
    da+=tre;
  }
}
	
	if(da.length>1){
    $(".table-hover").append("<tbody>"+da+"</tbody>");
  print("sd");
  $("tr #eliminar").on('click',function(){
    var mas=$(this).parent().attr("id");
    // var m=$("#"+mas).parent().attr("id");
    var d="id_vo="+mas+"&crsf=voleto";
    print(d);
    $.ajax({
            type: 'delete',
            url: '../php/back.php',
            data:d,
            dataType:'JSON',
            success: function (result) {
              print(result);
              location.reload();
              
            }
          });
  });
  // $("#eliminar").click(function(){
  //   var mas=$(this).parent().attr("id");
  //   var m=$("#"+mas).parent().attr("id");
  //   var d="id_vo="+m+"&crsf=delete";
  //   print(d);
  //   // $.ajax({
  //   //         type: 'get',
  //   //         url: '../php/back.php',
  //   //         data:d,
  //   //         dataType:'JSON',
  //   //         success: function (result) {
  //   //           print(result);
  //   //           location.href="..";
              
  //   //         }
  //   //       });
  // });
  }
	
	
	// $(".table-hover").
};
var ad;
var id;
$(document).ready(function(){
	
  
	var da="crsf=user";
	$.ajax({
			
            type: 'post',
            url: '../php/back.php',
            data: da,
            dataType:'JSON',
            success: function (result) {
                if(result.ok=="entro"){
                	print(result);
                	
                	$("#user_n").html(result.us.row[0].nombre);
                	$("#user_np").html(result.us.row[0].nombre+" "+result.us.row[0].apellido);
                	id=result.us.row[0].id;
                  ad=result.us.row[0].admin;
                  if (result.row!="no") {
                    crearTr(result.row)
                  }
                  


                }
              
            }
          });
  
  $("#btn-logout").click(function(){
    var d="crsf=out";
    $.ajax({
            type: 'get',
            url: '../php/back.php',
            data:d,
            dataType:'JSON',
            success: function (result) {
              print(result);
              location.href="..";
              
            }
          });

  });
	$("#user_n").click(function(){
		// if (!$("#c").children("#home")) {
      location.reload();
			// $("#c").load('../html/home.html');
			// da="crsf=user";
			// $.ajax({
			
   //          type: 'post',
   //          url: '../php/back.php',
   //          data: da,
   //          dataType:'JSON',
   //          success: function (result) {
   //              if(result.ok=="entro"){
   //              	print(result);
   //              	crearTr(result.row)
   //              	$("#user_n").html(result.row[1].nombre);
   //              	$("#user_np").html(result.row[1].nombre+" "+result.row[1].apellido);
   //              	id=result.row[1].id_us;


   //              }
              
   //          }
   //        });


		// }

	});
	$("#cargar-boleto").click(function(){
		$("#c").load('../html/voletos.html');
    var d="crsf=evento"
    $.ajax({
            type: 'get',
            url: '../php/back.php',
            data:d,
            dataType:'JSON',
            success: function (result) {
              print(result);
                if(result.ok=="entro"){
              var tri="<option value=\"";
              var tre="</option>";
              
              for (var i = 0; i < result.row.length; i++) {
                var da="";
                da+=tri+result.row[i].nom+"\"id=\""+result.row[i].id+"\" >";
                da+=result.row[i].nom;
                da+=tre;
                $("#id_evento").append(da);
                print("ev");
                print(da);
              }
              
                }
              
            }
          });
		$("#c").on('click',"#volet",function(){
			print($('#vole').serialize());
      
			$.ajax({
            type: 'post',
            url: '../php/back.php',
            data:$('#vole').serialize(),
            dataType:'JSON',
            success: function (result) {
            	print(result);
                if(result.ok=="entro"){
                	print(result);
                  print("sige");
                  


                }
              
            }
          });
		});
	});
	$("#btn-logup").click(function(){
  		print("asas");
  		var da="id="+id+"&crsf=chus"
      print(da)
		$("#c").load('../html/logup.html #sign-up');
		$.ajax({
            type: 'get',
            url: '../php/back.php',
            data:da,
            dataType:'JSON',
            success: function (result) {
            	print(result);
                if(result.ok=="entro"){
                	print(result);
                  // print("sige");
                  $("#id_nombre").val(result.row[0].nombre);
                	$("#id_apellido").val(result.row[1].apellido);
                  $("#id_cedula").val(result.row[2].cedula);
                  $("#id_sexo").val(result.row[3].sexo);
                  $("#id_direccion").val(result.row[4].direccion);
                  $("#id_email").val(result.row[5].email);
                  $("#id_telefono").val(result.row[6].telefono);
                  $("#id_username").val(result.row[7].username);
                  $("#id_pass").val(result.row[8].pass);
          			// print(result.row);
          			// $("#tik").html(result.row.nombre);
          			// $("#usul").html(result.row.nombre);
          			// $(".dropdown-content").css({display: 'none'});


                }
              
            }
          });
    });
  //Carga html del registro de evento-Admin
  $("#evento").click(function(){
      print("Entro a evento registro");
    $("#c").load('../html/evento.html #registro-event');
    
		$("#c").on('click',"#cargar-evento",function(){
			print("ss");
      
			$.ajax({
            type: 'post',
            url: '../php/back.php',
            data:$('#resgistro-evento').serialize(),
            dataType:'JSON',
            success: function (result) {
            	print(result);
                if(result.ok==true){
                	$("h2").html("cargado exitoso");
                  $('#resgistro-evento')[0].reset();
                	


                }
              
            }
          });
		});
		}
);
});