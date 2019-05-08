<?php 
	abstract class BasicDraw{
		protected $title;
		protected $opcion;
		protected $onBody="";
		protected $extraHead="";
		protected $extraScripts="";
		protected $mybody;
		protected $misScripts;
		function __construct($title=SOFTNAME,$opcion=0)
		{
			$this->title=$title;
			$this->opcion=$opcion;
			
		}
		abstract public function head();
		abstract protected function header();
		abstract public function left_menu();
		abstract protected function footer();
		private function body(){
			echo $this->mybody;
		}
		private function scripts(){
			echo $this->misScripts;
		}
		public function draw(){
			/*
			if(!class_exists('Session')){
				require(LIBS_ROUTE.'session.php');
			}
			if(!function_exists('conectar')){
				require(LIBS_ROUTE.'BDBF.php');
			}
			*/
			Session::activar_session();
			if ($this->opcion==opc_login or Session::valid_session()) {//true){
					//echo $this->body
				?><!DOCTYPE html>
			<html>
			<head>
				<?php 
					$this->head();
					echo $this->extraHead;
				 ?>
			</head>
			<body <?php echo $this->onBody; ?>>
				<div class="container-fluid">
					<?php 
						$this->header();
					 ?>
				</div>
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-2">
							<?php 
								if ($this->opcion!=opc_login) {
									$this->left_menu();
								}
								
							 ?>
						</div>
						<?php if ($this->opcion==opc_login) {
							$sic= 'class="col-md-8"';
						}else{
							$sic= 'class="col-md-10"';
						} ?> 
						<div " <?php echo $sic; ?> " ><!--AQUI-->
						
							<?php 
								echo $this->body();
							 ?>
						</div>
					</div>
				</div>
				<?php 
					$this->footer();
					$this->scripts();
				 ?>
			</body>
			</html>
			<?php		
			//echo $_SESSION['token'];
				
			}else{
				header('location: '.BASE_URL."login");
				echo "Error";
			}
			
		}



	
    /**
     * @param mixed $title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param mixed $opcion
     *
     * @return self
     */
    public function setOpcion($opcion)
    {
        $this->opcion = $opcion;

        return $this;
    }

    /**
     * @param mixed $onBody
     *
     * @return self
     */
    public function setOnBody($onBody)
    {
        $this->onBody = $onBody;

        return $this;
    }

    /**
     * @param mixed $extraHead
     *
     * @return self
     */
    public function setExtraHead($extraHead)
    {
        $this->extraHead = $extraHead;

        return $this;
    }



    /**
     * @return mixed
     */
    public function getExtraScripts()
    {
        return $this->extraScripts;
    }



    /**
     * @param mixed $mybody
     *
     * @return self
     */
    public function setBody($mybody)
    {
        $this->mybody = $mybody;

        return $this;
    }


    /**
     * @param mixed $misScripts
     *
     * @return self
     */
    public function setScripts($misScripts)
    {
        $this->misScripts = $misScripts;

        return $this;
    }


}

 ?>