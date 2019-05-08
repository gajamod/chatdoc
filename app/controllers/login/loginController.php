<?php
defined('BASEPATH') or exit('No se permite acceso directo');
//require_once LIBS_ROUTE .'Session.php';
require_once ROOT . FOLDER_PATH .'/app/models/loginModel.php';


/**
* Login controller
*/
class loginController extends Controller
{
  private $model;
  private $session;
  public function __construct()
  {
    $this->model = new LoginModel();
    
  }

   public function index()
  {
      Session::activar_session();
      if (isset($_GET['cerrar'])) {
        Session::closeSession();
      }
      if (Session::valid_session()) {
        header('location: '.BASE_URL."home");
      }

      if (isset($_POST['btnsubmit'] ) and isset($_POST['usuario']) and isset($_POST['password'])) {
        $usuario=htmlentities($_POST['usuario']);
        $password=htmlentities($_POST['password']);
        $login=new LoginModel();
        if ($login->signin($usuario,$password)) {
          header('location: '.BASE_URL."home");
        }else{
          $params['msg']="Error 1 signIn";
          $this->render(__CLASS__,"back",$params);
          echo "error1";
        }
      }else{
        $this->render(__CLASS__);
      }
  }
 
  public function signin()
  {
      Session::activar_session();
      if (isset($_GET['cerrar'])) {
        Session::closeSession();
      }
      if (Session::valid_session()) {
        header('location: '.BASE_URL."home");
      }
      if (isset($_POST['usuario']) and isset($_POST['password'])) {
        $usuario=htmlentities($_POST['usuario']);
        $password=htmlentities($_POST['password']);
        $login=new loginModel();
        if ($login->signIn($usuario,$password)) {
          echo "OK";
          header('location: '.BASE_URL."home");
          
        }else{
          echo "Error al iniciar session";
          header('location: '.BASE_URL."login");
        }
        
      }else{
        echo "No se han recibido los datos";
        header('location: '.BASE_URL."login");
      }
    $this->render(__CLASS__,"signin");
  }

   public function logout()
  {
    Session::activar_session();
    Session::closeSession();
    header('location: '.LOGIN_URL);
  }

  public function lista()
  {
    $params['usuarios']= $this->model->ver_usuarios();
    $this->render(__CLASS__,"lista",$params);
  }

  public function registro()
  {
    if (isset($_POST['btnregistrar']) and Session::requiere_sesion()) {
      $nombre=htmlentities($_POST['nombre']);
      $usuario=htmlentities($_POST['usuario']);
      $admin=(isset($_POST['ad']))? htmlentities($_POST['ad']):false;
      $activo=(isset($_POST['act']))? htmlentities($_POST['act']):false;
      $password=htmlentities($_POST['password']);

      if ($this->model->existe_usuario($usuario)) {
        $params['msg'] = "El usuario ya existe";
        $this->render(__CLASS__,"back",$params);
      }else{
        $registrado=$this->model->alta_usuario($nombre,$usuario,$password,$activo,$admin);
        $params['registrado']=$registrado;
        $this->render(__CLASS__,"registroExito",$params);
      }

    }else{
      $this->render(__CLASS__,"registro");
    }
  }

  public function recuperar(){
    $this->sesion_permisos=false;
    $this->sesion_valida=false;
    if (Session::valid_session()) {
      $this->error('Tiene que cerrar sesion para continuar');
    }else{
      $chckvalido= array(
        't' => 's', 
        'c' => 's'
      );
      $chckRecuperar= array(
        'tkn' => 's', 
        'cr' => 's',
        'us' => 's',
        'password'=>'s',
        'password2'=>'s'
      );
      if (checkPost($chckvalido,$_GET) and $this->model->recuperar_valido($_GET['t'],$_GET['c'])) {
        //Muestra formulario restaurar password
        $params['token']=$_GET['t'];
        $params['tokenR']=$_GET['c'];
        $this->render(__CLASS__,"recuperar",$params);

      }elseif (checkPost($chckRecuperar,$_POST)) {
        //restaura password
        $idUsuario=$this->model->get_IDusuario($_POST['us']);
        if ($this->model->restaurar_password($idUsuario,$_POST['tkn'],$_POST['cr'],$_POST['password'])) {
          $params['registrado']=$_POST['us'];
          $this->render(__CLASS__,"registroExito",$params);
        } else {
          $this->error("No se ha podido cambiar la contraseña");
        }
        ;
      } else {
        $this->error("El enlace ha expirado");
      }
      
      
    }
    
  }
}