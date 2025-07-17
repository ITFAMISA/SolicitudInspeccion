<?php
// app/controllers/SupervisorController.php
class SupervisorController extends Controller {
    private $solicitudModel;

    public function __construct(){
        if(!checkRole('supervisor')){
            redirect('auth/login');
        }
        $this->solicitudModel = $this->model('Solicitud');
    }

    public function index(){
        $solicitudes = $this->solicitudModel->obtenerSolicitudesPorSupervisor($_SESSION['usuario_id']);
        $data = ['solicitudes' => $solicitudes];
        $this->view('supervisor/index', $data);
    }

    public function crear(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

            $data = [
                'id_supervisor' => $_SESSION['usuario_id'],
                'orden_trabajo' => trim($_POST['orden_trabajo']),
                'cliente' => trim($_POST['cliente']),
                'proyecto' => trim($_POST['proyecto']),
                'area_proceso' => trim($_POST['area_proceso']),
                'partidas' => isset($_POST['partidas']) ? array_values($_POST['partidas']) : []
            ];

            if(!empty($data['orden_trabajo']) && !empty($data['cliente']) && !empty($data['partidas'])){
                if($this->solicitudModel->crearSolicitud($data)){
                    flash('solicitud_mensaje', 'Solicitud creada correctamente.');
                    redirect('supervisor/index');
                } else {
                    die('Algo salió mal al guardar la solicitud.');
                }
            } else {
                $data['error'] = 'Por favor, complete los datos generales y agregue al menos una partida.';
                $this->view('supervisor/crear', $data);
            }
        } else {
            $data = ['orden_trabajo' => '', 'cliente' => '', 'proyecto' => '', 'area_proceso' => ''];
            $this->view('supervisor/crear', $data);
        }
    }
    
    public function ver($id){
        $solicitud = $this->solicitudModel->obtenerSolicitudPorId($id);
        // Verificar que el supervisor solo pueda ver sus propias solicitudes
        if(!$solicitud || $solicitud->id_supervisor != $_SESSION['usuario_id']){
            redirect('supervisor/index');
        }
        
        $partidas = $this->solicitudModel->obtenerPartidasPorSolicitudId($id);
        
        $data = [
            'solicitud' => $solicitud,
            'partidas' => $partidas
        ];
        
        $this->view('supervisor/ver', $data);
    }
    
    public function llegadaInspector($id_solicitud){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $solicitud = $this->solicitudModel->obtenerSolicitudPorId($id_solicitud);
            if($solicitud && $solicitud->id_supervisor == $_SESSION['usuario_id']){
                if($this->solicitudModel->registrarLlegadaInspector($id_solicitud)){
                    flash('solicitud_mensaje', 'Llegada del inspector registrada correctamente.');
                    redirect('supervisor/ver/' . $id_solicitud);
                }
            }
        }
        redirect('supervisor/index');
    }
}
