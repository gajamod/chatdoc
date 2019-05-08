<?php 

/**
 * 
 */
class Carousel
{
	private $id;
	private $controls;
	private $indicators;
	private $slides=array();
	private $width;
	private $height;
	private $raro;

	function __construct($id,$height,$controls=true,$indicators=true,$raro=false)
	{
		$this->raro=$raro;
		//$this->width=$width;
		$this->height=$height;
		$this->setId($id);
		$this->setIndicators($indicators);
		$this->setControls($controls);
	}
	public function addSlide($src,$alt="",$title="",$text=""){
		$this->slides[]= array(
			'src' => $src, 
			'alt' => $alt,
			'title' => $title, 
			'text' => $text
		);
	}

	public function draw(){
		/*
		<img class="d-block img-fluid mh-100" style="background-image: url(<?php echo $slide['src']; ?>);" alt="<?php echo (empty($slide['alt'])) ?  $this->id." slide ".$key :  $slide['alt']; ?>">

		<img class="d-block img-fluid" src="<?php echo $slide['src']; ?>" alt="<?php echo (empty($slide['alt'])) ?  $this->id." slide ".$key :  $slide['alt']; ?>">
		*/

		?>
		<?php  
			if ($this->raro) {
				?>
				
				<style type="text/css">
					#<?php echo $this->id; ?> .carousel-item{
					    background-position: center center;
					    background-repeat: no-repeat;
					    background-size: cover;
					    padding: <?php echo $this->height; ?> 0 0 0;
					    width:100%;
					}
					#<?php echo $this->id; ?> .carousel-item::before {
					    background: rgba(0, 0, 0, 0.80) none repeat scroll 0 0;
					     background-position: center center;
					    background-repeat: no-repeat;
					    content: "";
					    height: 100%;
					    left: 0;
					    position: absolute;
					    top: 0;
					    width: 100%;
					    z-index: 0;
					}

					#<?php echo $this->id; ?> h1, h2,h3{
						color:white !important;
					}
				</style>
				<?php 
			}
			 ?>
			<div id="<?php echo $this->id; ?>" class="carousel slide" data-ride="carousel">
				<?php 
			  		if ($this->indicators) {
			  			?>
			  				<ol class="carousel-indicators">
			  					<?php 
			  						foreach ($this->slides as $key => $slide) {
			  							?>
			  							<li data-target="<?php echo $this->id; ?>" data-slide-to="<?php echo $key; ?>" <?php echo ($key==0) ?  'class="active"':''; ?> ></li>
			  							<?php
			  						}
			  					 ?>
						  	</ol>
			  			<?php
			  		}
			   	?>
			  	<div class="carousel-inner" role="listbox">
			  		<?php 
			  			foreach ($this->slides as $key => $slide){
			  				if ($this->raro) {
			  					?>
			  					<div class="carousel-item  <?php echo $key==0 ?  "active":"" ; ?>" style="background-image: url(<?php echo $slide['src']; ?>); padding-top: <?php echo $this->height; ?>" >
			  					<?php
			  				}else{
			  					?>
			  					<div class="carousel-item  <?php echo $key==0 ?  "active":"" ; ?>" >
			  						<img class="d-block img-fluid" src="<?php echo $slide['src']; ?>" alt="<?php echo (empty($slide['alt'])) ?  $this->id." slide ".$key :  $slide['alt']; ?>">
			  					<?php
			  				} ?>
						      
						      <?php 
						      if (!(empty($slide['title']))) {
						      	?>
						      	<div class="carousel-caption d-none d-md-block">
							    	<h3><?php echo $slide['title']; ?></h3>
							    	<?php echo (!(empty($slide['text']))) ?  "<p>".$slide['text']."</p>": ''; ?>
							  	</div>
						      	<?php
						      }
						      ?>
						    </div>	
			  				<?php
			  			}
			  		?>
				</div>
			  	<?php 
			  		if ($this->controls) {
			  			?>
			  			<a class="carousel-control-prev" href="#<?php echo $this->id ?>" role="button" data-slide="prev">
						    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
						    <span class="sr-only">Previous</span>
					  	</a>
					  	<a class="carousel-control-next" href="#<?php echo $this->id ?>" role="button" data-slide="next">
					    	<span class="carousel-control-next-icon" aria-hidden="true"></span>
					    	<span class="sr-only">Next</span>
					  	</a>
			  			<?php
			  		}
			   	?>
						  	
			</div>
		<?php
	}

    /**
     * @param mixed $indicators
     *
     * @return self
     */
    public function setIndicators($indicators)
    {
        $this->indicators = $indicators;

        return $this;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param mixed $controls
     *
     * @return self
     */
    public function setControls($controls)
    {
        $this->controls = $controls;

        return $this;
    }

}