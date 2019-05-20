<?php
defined('BASEPATH') or exit('No se permite acceso directo');

class conversacionController extends Controller
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
    $this->model = new conversacionModel();
    
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
    //si post con param validos, registra respuesta luego
    //recibe el numero de conversacion y la muestra
    // si no existe muestra error
    if (Session::valid_session()) {
      $chck = array(
        'msj' => 's'
        ,'cht' => 'i'
        );
      if (checkPost($chck,$_POST) ) {
        //Registrar respuesta
        $mensaje=htmlentities( $_POST['msj']);
        $conversacion=htmlentities( $_POST['cht']);
        $paciente=$_SESSION['id'];
        $token=Session::generateToken($paciente);
        if ($this->model->existeConversacion($conversacion,$paciente)) {
          $resp=$this->model->registrarRespuesta($mensaje,$paciente,$token,$conversacion);
          if ($resp>0) {
            //header("location: ".$conversacion);
          } else {
            $params['msg'] = "Error al guardar el mensaje";
          $this->render(__CLASS__,"back", $params);
          }
          
        } else {
          $params['msg'] = "Error al enviar el mensaje";
          $this->render(__CLASS__,"back", $params);
        }
        
        
      } 

      //mostrar conversacion
      if ($this->model->existeConversacion($params[0],$_SESSION['id'])){
        $param['conversacion']=$this->model->getConversacion($params[0]);
        $this->render(__CLASS__,null, $param);
      } else {
        $params['msg'] = "No se encontro la conversacion";
        $this->render(__CLASS__,"back", $params);
      }
    } else {
      $params['msg'] = "No tienes permiso de estar aqui";
      $this->render(__CLASS__,"back", $params);
    }
    

  }
  public function nueva($params)
  {
    $chck = array(
    'tkn' => 's'
    ,'mot' => 's'
    ,'ar' => 's'
    ,'descr' => 's'
    );
    if (checkPost($chck,$_POST) and Session::valid_session()) {
      $token=htmlentities($_POST['tkn']);
      $motivo=htmlentities($_POST['mot']);
      $area=htmlentities($_POST['ar']);
      $descripcion=htmlentities($_POST['descr']);
      $id_estudio=$this->model->crearConversacion($_SESSION['id'],$token,$area,$motivo,$descripcion);
      if (is_numeric($id_estudio) and $id_estudio>0) {
        header("location: ".BASE_URL."conversacion/".$id_estudio);
      }else{
        $params['msg'] = "Error al crear el estudio: ".$id_estudio;
        $this->render(__CLASS__,"back", $params);
      }
    }else{
      $param['dareas']=conversacionModel::getAreas();
      $this->render(__CLASS__,"nueva", $param);
    }
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





}