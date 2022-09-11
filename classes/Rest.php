<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Headers: *');
	include "controller/AuthController.php"; 

	class Rest{
		private $request;

		private $class;
		private $method;
		private $params = array();

		public function __construct($req) {
			$this->request = $req;
			$this->load();
		}

		public function load()
		{
			$newUrl = explode('/', $this->request['url']);
			array_shift($newUrl);

			if (isset($newUrl[0])) {
				$this->class = ucfirst($newUrl[0]);
				// $this->class = new $this->class();
				array_shift($newUrl);

				if (isset($newUrl[0])) {
					$this->method = $newUrl[0];
					array_shift($newUrl);

					if (isset($newUrl[0])) {
						$this->params = $newUrl;
					}
				}
			}
		}

		public function run()
		{
			// var_dump(($this->class));
			// var_dump($this->method);
			// var_dump($this->params);

			if (class_exists($this->class) && method_exists($this->class, $this->method)) {

				try {
					$controll = $this->class;
					$response = call_user_func_array(array(new $controll, $this->method), $this->params);
					return json_encode(array('data' => $response, 'status' => 'sucess'));
				} catch (\Exception $e) {
					return json_encode(array('data' => $e->getMessage(), 'status' => 'error'));
				}
				
			} else {
				return json_encode(array('data' => 'Operacao Invalida', 'status' => 'error'));
			}
		}
	}