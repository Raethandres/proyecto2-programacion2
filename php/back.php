<?php

	/**
	* 
	*/
	class Request
	{
		public $tipo;
		public $form;
		// public $func= array('GET' =>this->Get() ,'POST'=>this->Post() );

		
		function __construct(string $tipo,array $form)
		{
			$this->tipo=tipo;
			$this->form=form;
			echo $this->tipo;
			// var_dump(tipo);
			// fu=$this->func[$this->tipo];
			// fu();
		}

		function do(){

		} 

		function Get(){

		}

		function Post(){

		}



	}

if ($_POST) {
	$reg=new Request("Post",$_POST);
}elseif ($_GET) {
	$reg=new Request("Get",$_GET);
}elseif ($_PUT) {
	$reg=new Request("Put",$_PUT);
}elseif ($_DELETE) {
	$reg=new Request("Delete",$_DELETE);
}else{
	echo "nada";
}

?>