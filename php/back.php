<?php
	session_start();
	/**
	* 
	*/
	/**
	* 
	*/
	class DataBase 
	{
		public $servername = "localhost";
		public $username = "root";
		public $password = "kara";
		public $coon;
		public $dbname = "siket";

		function __construct()
		{
			$x=1;
			$this->conexion();
		}
		function conexion(){
			
			$this->coon = new mysqli($this->servername, $this->username, $this->password,$this->dbname);
			
// Check connection
			if ($this->coon->connect_error) {
    			echo json_encode(array("ok"=>"conection fail",));
			}
		}
		function Select($data,string $tipo,string $table,string $spec){
			if ($spec!="0") {
				$result=$this->coon->query($spec);

				if ($result->num_rows > 0) {
					mysqli_close($this->coon);
					$row=array();
					$x=0;
					while ($x!=$result->num_rows) {
						$row[$x]=$result->fetch_assoc();
						$x+=1;
				}
					return array("ok"=>"entro","row"=>$row,"nr"=>$result->num_rows );
    			
    			
    			}else{
    				mysqli_close($this->coon);
    				return array("ok"=>"no-entro","row"=>"no");
    			}			

			}if ($data=="*") {
				$data="\"$data\"";
				$sql="SELECT * FROM $table";
				$result=$this->coon->query($sql);

				if ($result->num_rows > 0) {
					mysqli_close($this->coon);
					$row=array();
					$x=0;
					while ($x!=$result->num_rows) {
						$row[$x]=$result->fetch_assoc();
						$x+=1;
					}
					return array("ok"=>"entro","row"=>$row,"nr"=>$result->num_rows );
    			
    			
    			}else{
    				mysqli_close($this->coon);
    				return array("ok"=>"no-entro","row"=>"no");
    			}	
			}
			$data="\"$data\"";
			$sql="SELECT * FROM $table WHERE $tipo=$data";
			$result=$this->coon->query($sql);

			if ($result->num_rows > 0) {
				mysqli_close($this->coon);
				$row=array();
				$x=0;
				while ($x!=$result->num_rows) {
					$row[$x]=$result->fetch_assoc();
					$x+=1;
				}
				return array("ok"=>"entro","row"=>$row,"nr"=>$result->num_rows );
    			
    			
    		}else{
    			mysqli_close($this->coon);
    			return array("ok"=>"no-entro","row"=>"no");
    		}			
			
			// if($conn->query($sql)){
				
			// }
		}
		function Insert($form,string $tipo){
			// echo json_encode(array("ok"=>$form));
			if($tipo=="logup"){
				
				$id=1;
				$nombre=$form['nombre'];
				$cedula=(int)$form['cedula'];
				$email= $form['email'];
				$sexo=$form['sexo'];
				$dire=$form['direccion'];
				$telefono=(int)$form['telefono'];
				$user=$form['username'];
				$pass=$form['pass'];
				$admin=0;
				$apellido=$form['apellido'];
				// echo json_encode(array("ok"=>$form));

				$sql = "INSERT INTO user (nombre,apellido, cedula , email, sexo , dire, telefono , user , pass,admin)
						VALUES ('$nombre','$apellido','$cedula','$email','$sexo','$dire','$telefono','$user','$pass','$admin')";
				$r=$this->coon->query($sql);
				mysqli_close($this->coon);
				echo json_encode(array("ok"=>$r,"info"=>$form));

				//  if ($this->coon->query($sql) === TRUE) {
   	// 				echo json_encode(array("ok"=>"si"));
				//  } else {
    // 				echo json_encode(array("ok"=>"no"));
				// }
		
	
			}elseif ($tipo=="volet") {
				$serial=$form['serial'];
				$evento=$form['evento'];
				$fecha= $form['fecha'];
				$ubicacion=$form['ubicacion'];
				$id_eve=0;
				// echo json_encode(array("ok"=>$form));
				$event=$this->Select($evento,"nom","evento","0");
				$ev=$event["row"];
				$this->conexion();
				// echo json_encode(array("ok"=>$evento,"info"=>$event));
				$sql = "INSERT INTO voleto (ser,fecha , ubicacion)
						VALUES ('$serial','$fecha','$ubicacion')";
				$r=$this->coon->query($sql);
				$vol=$this->Select($serial,"ser","voleto","0");
				$vo=$vol["row"];//fallo
				// echo json_encode(array("ok"=>$vo[0]["id"],"info"=>$ev[0]["id"]));
				$this->conexion();
				$id_v=$vo[0]["id"];
				$id_e=$ev[0]["id"];
				$id_u=$_SESSION["user"];
				$sql = "INSERT INTO registros (id_us,id_vo, id_eve)
						VALUES ('$id_u','$id_v','$id_e')";//aqui
				$r=$this->coon->query($sql);

				//aqui selecciona eventos, relaciona, luego creas un registro,relaciona y cierra
				mysqli_close($this->coon);
				// echo json_encode(array("ok"=>$r,"info"=>$form));
				
				
			}elseif ($tipo=="evento") {
				$nombre=$form["evento"];
				$platino=$form["evento-platino"];
				$vip=$form["evento-vip"];
				$medio=$form["evento-medios"];
				$alto=$form["evento-altos"];
				$sql = "INSERT INTO evento (nom,alto,medio,vip,platino)
						VALUES ('$nombre','$alto','$medio','$vip','$platino')";
				$r=$this->coon->query($sql);
				mysqli_close($this->coon);
				echo json_encode(array("ok"=>$r,"info"=>$form));
			}
		}
		function Update($data,string $tipo,string $table,$place,$pla){
			$us=
			$sql="UPDATE $table SET $tipo=$data WHERE $place=\"$pla\"";
			// echo json_encode(array("ok"=>$sql));
			$r=$this->coon->query($sql);
			mysqli_close($this->coon);
			
		}
		function Delete($vo,$wh){
			$sql = "DELETE FROM registros WHERE id_vo=$vo";
			$r=$this->coon->query($sql);
			$sql = "DELETE FROM voleto WHERE id=$vo";
			$r=$this->coon->query($sql);
			mysqli_close($this->coon);
			echo json_encode(array("ok"=>$r));
		}
	}
	class Request
	{
		public $tipo;
		public $form;
		public $accion;
		public $db;
		// public $func= array('GET' =>this->Get() ,'POST'=>this->Post() );

		
		function __construct(string $tipo,array $form)
		{
			$this->tipo=$tipo;
			$this->form=$form;
			$this->db=new DataBase();
			// echo json_encode(array("ok"=>$this->form,));
			if($this->tipo=="Post"){
				$this->Post();
			}elseif ($this->tipo=="Get") {
				$this->Get();
			}elseif ($this->tipo=="Delete") {
				$this->Delete();
			}elseif ($this->tipo=="Put") {
				$this->Put();
			}
			// var_dump(tipo);
			// fu=$this->func[$this->tipo];
			// fu();
		}


		function Put(){
			if ($this->form["crsf"]=="logup") {
				$us=$this->db->Select($_SESSION["user"],"id_us","registros","0");
				echo json_encode(array("ok"=>$us));
				// $r=$this->db->Update($t,$this->form["nombre"],"user","id",$_SESSION["user"]);

			}

		} 

		function Get(){
			if ($this->form["crsf"]=="chus") {
				$user=$this->db->Select($this->form["id"],"id","user","0");
				// if ($user["ok"]=="entro") {
					
				// 	$_SESSION["user"]=$user["row"][0]["id"];
				// }
				
				echo json_encode($user);
			}
			if ($this->form["crsf"]=="evento") {
				$user=$this->db->Select("*","","evento","0");
				
				echo json_encode($user);
			}elseif ($this->form["crsf"]=="out") {
				$_SESSION["user"]=NULL;
				echo json_encode(array('ok' =>"bye"));
			}
		}

		function Post(){
			if ($this->form["crsf"]=="login") {

				// echo json_encode(array("ok"=>$this->form["uname"],));
				$user=$this->db->Select($this->form["uname"],"user","user","0");
				if ($user["ok"]=="entro") {
					
					$_SESSION["user"]=$user["row"][0]["id"];
					$_SESSION["adm"]=$user["row"][0]["admin"];
				}
				
				echo json_encode($user);
				// if ($user["pass"]==$this->form["psw"]) {
				// 	echo json_encode(array("ok"=>"entro","row"=>$user));
				// }else{
				// 	echo json_encode(array("ok"=>"denegado",));
				// }

			}elseif ($this->form["crsf"]=="logup") {
				//echo json_encode(array("ok"=>$this->form));
				$user=$this->db->Insert($this->form,"logup");
			}elseif ($this->form["crsf"]=="user") {
				$us=$_SESSION["user"];
				if ($_SESSION["adm"]==1) {
					$regis=$this->db->Select($_SESSION["user"],"id_us","registros","SELECT nombre,apellido,cedula,nom,ubicacion,id_vo FROM user A0 ,registros A1,voleto A2,evento A3 WHERE A1.id_us=A0.id and A2.id=A1.id_vo and A3.id=A1.id_eve");
					$this->db->conexion();
				$regis["ok"]="entro";
				$regis["us"]=$this->db->Select($_SESSION["user"],"id","user","0");
				echo json_encode($regis);
				}else{
				$regis=$this->db->Select($_SESSION["user"],"id_us","registros","SELECT ser,fecha,ubicacion,nom,nombre,apellido,id_vo,id_us FROM user A0, registros A1,voleto A2,evento A3 WHERE A0.id=$us and A1.id_us=A0.id and A2.id=A1.id_vo and A3.id=A1.id_eve");
				$this->db->conexion();
				$regis["ok"]="entro";
				$regis["us"]=$this->db->Select($_SESSION["user"],"id","user","0");
				echo json_encode($regis);
			}
			}elseif ($this->form["crsf"]=="volet") {
				$user=$this->db->Insert($this->form,"volet");
				$this->db->conexion();
				$r=$this->db->Select($this->form["evento"],"nom","evento","0");
				// echo json_encode(array("r"=>$this->form);
				$t=$r["row"]["0"][$this->form["ubicacion"]];
				$t-=1;
				// echo json_encode(array("r"=>$t));
				$this->db->conexion();
				$r=$this->db->Update($t,$this->form["ubicacion"],"evento","nom",$this->form["evento"]);
				echo json_encode(array("ok"=>$r));
			}elseif ($this->form["crsf"]=="evento") {
				$user=$this->db->Insert($this->form,"evento");
			}

		}
		function Delete(){
			if ($this->form["crsf"]=="voleto") {
				$user=$this->db->Delete($this->form["id_vo"],"volet");
			}
		}


	}

if ($_POST) {
	// echo json_encode(array("ok"=>"1",));
	$reg=new Request("Post",$_POST);   

}elseif ($_GET) {
	$reg=new Request("Get",$_GET);
}elseif ($_SERVER["REQUEST_METHOD"]=="PUT") {
	parse_str(file_get_contents("php://input"),$_PUT);
	$reg=new Request("Put",$_PUT);
}elseif ($_SERVER["REQUEST_METHOD"]=="DELETE") {
	parse_str(file_get_contents("php://input"),$_DELETE);
	$reg=new Request("Delete",$_DELETE);
}else{
	echo "nada";
}

?>