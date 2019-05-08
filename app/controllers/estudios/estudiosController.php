<?php
defined('BASEPATH') or exit('No se permite acceso directo');

class estudiosController extends Controller
{
  /**
   * string 
   */
  public $nombre;

  /**
   * object 
   */
  public $model;

  /**
   * Inicializa valores 
   */
  public function __construct()
  {
    $this->model = new estudiosModel();
    
  }

  /**
  * Método estándar
  */
  public function index($params)
  {
    $this->show($params);
  }

  public function show($params)
  {
    $this->sesion_permisos=false;
    $this->render(__CLASS__,null, $params); 
  }

  public function tomar($params)
  {
    $this->sesion_permisos=false;
    $chck = array(
    'paciente' => 'n',
    'estudio' => 'n',
    'tkn'=>'s'
    );

    $tomadoChck = array(
    'pac' => 'n',
    'std' => 'n',
    'token'=>'s'
    );


    if (checkPost($chck,$_POST)) {
      if (estudiosModel::exist($_POST['estudio'])) {
        $id_estud=$_POST['estudio'];
        $param['paciente']=pacientesModel::pacienteLite($_POST['paciente']);
        $param['data']=estudiosModel::getData($id_estud);
        $param['token']=$_POST['tkn'];
        $this->render(__CLASS__,"tomar", $param);
      }else{
        $params['msg'] = "No se ha encontrado el estudio";
        $this->render(__CLASS__,"back", $params);
      }
    }elseif (checkPost($tomadoChck,$_POST)) {
      $param=$params;
      //$param['post']=$_POST;
      $param['estudio']=$_POST['std'];
      $param['paciente']=$_POST['pac'];
      $param['token']=$_POST['token'];
      unset($_POST['std']);
      unset($_POST['pac']);
      unset($_POST['token']);
      $param['respuestas']=$_POST;

      $res=$this->model->registrarRespuestas($param['estudio'],$param['paciente'],$param['token'],$param['respuestas']);
      if ($res==-2) {
        $params['msg'] = "Registro Duplicado";
        $this->render(__CLASS__,"back", $params);
      }elseif ($res==-2) {
        $params['msg'] = "Error al registrar";
        $this->render(__CLASS__,"back", $params);
      }else{
        $this->render(__CLASS__,"tomado", $res);
      }
      
      
      
    }else{
      $params['msg'] = "Error en la solicitud";
      $this->render(__CLASS__,"back", $params);
    }
  }

  public function registrado($params){
    $this->sesion_permisos=false;
    if (estudiosModel::existRegistro($params[0])) {
      $id_Registro=$params[0];
      $param['data']=$this->model->getRegistro($id_Registro);
      $this->render(__CLASS__,"registrado", $param);
    }else{
      $params['msg'] = "No se ha encontrado el Registro";
      $this->render(__CLASS__,"back", $params);
    }
  }
  public function crear($params)
  {
    $chck = array(
    'nombre' => 's',
    'descripcion' => 's'
    );
    if (checkPost($chck,$_POST)) {
      $id_estudio=estudiosModel::crear($_POST['nombre'],$_POST['area'],$_POST['descripcion']);
      if (is_numeric($id_estudio) and $id_estudio>0) {
        header("location: ".BASE_URL."estudios/modificar/".$id_estudio);
      }else{
        $params['msg'] = "Error al crear el estudio";
        $this->render(__CLASS__,"back", $params);
      }
    }else{
      $this->render(__CLASS__,"crear", $params);
    }
  }

  public function modificar($params)
  {
    if (estudiosModel::exist($params[0])) {
      $id_estud=$params[0];
      $param['data']=estudiosModel::getData($id_estud);
      $this->render(__CLASS__,"modificar", $param);
    }else{
      $params['msg'] = "No se ha encontrado el estudio";
      $this->render(__CLASS__,"back", $params);
    }
  }



  public function mostrarCategorias($categorias,$nivel=0,$tomar=false){
    foreach ($categorias as $idCategoria => $datosCategoria) {
      $datosCategoria['idCategoria']=$idCategoria;
      $this->mostrarCategoria($datosCategoria,$nivel,$tomar);
    }
  }
  public function mostrarCategoria($datosCategoria,$nivel=0,$tomar=false){
    $datosCategoria['nivel']=$nivel;
    $datosCategoria['tomar']=$tomar;
    $this->renderPartial(__CLASS__,"categoriaPartial", $datosCategoria);
  }
  public function mostrarPreguntas($preguntas,$nivel=0,$tomar=false){
    if (is_array($preguntas)) {
      echo '<div class="row">';
        foreach ($preguntas as $idPregunta => $datosPregunta) {
          echo '<div class="col-lg-4 col-sm-6">';
            $datosPregunta['idPregunta']=$idPregunta;
            $this->mostrarPregunta($datosPregunta,$tomar);
          echo "</div>";
        }
      echo "</div>";
    }else{
      
      echo "<h4>Sin preguntas / respuestas :(</h4>";
      
      
      //$this->mostrarPregunta($preguntas);
    }

      
  }
  public function mostrarPregunta($datosPregunta,$tomar=false){
    if ($tomar) {
      $this->renderPartial(__CLASS__,"preguntaTomarPartial", $datosPregunta);
    }else{
      $this->renderPartial(__CLASS__,"preguntaPartial", $datosPregunta);
    }
    
  }
    

}