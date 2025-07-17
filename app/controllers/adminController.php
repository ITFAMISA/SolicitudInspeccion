<?php
// app/controllers/AdminController.php
class AdminController extends Controller {
    private $solicitudModel;

    public function __construct(){
        if(!checkRole('admin')){
            redirect('auth/login');
        }
        $this->solicitudModel = $this->model('Solicitud');
    }

    // Dashboard principal del admin: muestra TODAS las solicitudes del sistema
    public function index(){
        $solicitudes = $this->solicitudModel->obtenerTodasLasSolicitudes();
        $data = ['solicitudes' => $solicitudes];
        $this->view('admin/index', $data);
    }

    // Vista detallada de cualquier solicitud
    public function ver($id){
        $solicitud = $this->solicitudModel->obtenerSolicitudPorId($id);
        
        if(!$solicitud){
            redirect('admin/index');
        }

        $partidas = $this->solicitudModel->obtenerPartidasPorSolicitudId($id);
        
        // Cargar observaciones para cada partida
        foreach($partidas as $partida){
            $partida->observaciones = $this->solicitudModel->obtenerObservacionesPorPartidaId($partida->id);
        }

        $data = [
            'solicitud' => $solicitud,
            'partidas' => $partidas
        ];
        
        $this->view('admin/ver', $data);
    }

    // El admin puede actualizar el estado de cualquier partida en cualquier momento
    public function actualizarPartida($id_partida){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $estado = $_POST['estado'];
            $id_solicitud = $_POST['id_solicitud'];

            if($this->solicitudModel->actualizarEstadoPartida($id_partida, $estado)){
                flash('partida_mensaje_' . $id_partida, 'Partida actualizada por Admin.');
            }
            redirect('admin/ver/' . $id_solicitud);
        }
    }
}
