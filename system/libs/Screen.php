<?php 
/**
 * 
 */
//require_once(PATH_TEMPLATES.'configScreen.php');
class Screen
{
	private $title;
	private $onBody;
	private $extendHead;
	private $structure;
	private $pagina;
	private $content='';
    private $paramScreen;

	function __construct($title,$content,$onBody='',$extendHead='',$paramscreen=array())
	{
		
		$this->setTitle($title);
		$this->setOnBody($onBody);
		$this->setExtendHead($extendHead);
		$this->setContent($content);
        $this->setParamScreen($paramscreen);
	}
	

	public function draw(){
        ob_start();
		require_once PATH_TEMPLATES.'structureScreen.php';
		//setStructure(ob_get_clean());
        $this->pagina=ob_get_clean();
        //mose("pagina",$this->pagina);
        echo $this->pagina;
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
     * @param mixed $extendHead
     *
     * @return self
     */
    public function setExtendHead($extendHead)
    {
        $this->extendHead = $extendHead;

        return $this;
    }

    /**
     * @param mixed $structure
     *
     * @return self
     */
    private function setStructure($structure)
    {
        $this->structure = $structure;

        return $this;
    }

    

    /**
     * @param mixed $content
     *
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @param mixed $paramscreen
     *
     * @return self
     */
    public function setParamScreen($paramScreen)
    {
        $this->paramScreen = $paramScreen;
        return $this;
    }
}


 ?>