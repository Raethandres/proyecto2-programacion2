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
			var_dump(tipo);
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

$ss="true";
echo($ss);
?>