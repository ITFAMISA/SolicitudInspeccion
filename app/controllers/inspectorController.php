<?php
// app/controllers/InspectorController.php
class InspectorController extends Controller {
    private $solicitudModel;

    public function __construct(){
        if(!checkRole('inspector')){
            redirect('auth/login');
        }
        $this->solicitudModel = $this->model('Solicitud');
    }

    // Dashboard principal del inspector: muestra sus solicitudes activas
    public function index(){
        $solicitudes = $this->solicitudModel->obtenerSolicitudesPorInspector($_SESSION['usuario_id']);
        $data = ['solicitudes' => $solicitudes];
        $this->view('inspector/index', $data);
    }

    // Muestra las solicitudes pendientes que puede tomar
    public function disponibles(){
        $solicitudes = $this->solicitudModel->obtenerSolicitudesDisponibles();
        $data = ['solicitudes' => $solicitudes];
        $this->view('inspector/disponibles', $data);
    }

    // Acción para tomar una solicitud
    public function tomar($id_solicitud){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->solicitudModel->tomarSolicitud($id_solicitud, $_SESSION['usuario_id'])){
                flash('solicitud_mensaje', 'Has tomado la solicitud #' . $id_solicitud . '. Ahora está en tu panel.');
                redirect('inspector/index');
            } else {
                die('Algo salió mal.');
            }
        }
        redirect('inspector/disponibles');
    }

    // Vista principal para realizar la inspección
    public function inspeccionar($id){
        $solicitud = $this->solicitudModel->obtenerSolicitudPorId($id);
        
        // Seguridad: El inspector solo puede ver sus propias solicitudes asignadas
        if(!$solicitud || $solicitud->id_inspector != $_SESSION['usuario_id']){
            flash('solicitud_error', 'No tienes permiso para ver esa solicitud.', 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded');
            redirect('inspector/index');
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
        
        $this->view('inspector/inspeccionar', $data);
    }

    // Actualizar el estado de una partida (Completada/Rechazada)
    public function actualizarPartida($id_partida){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $estado = $_POST['estado'];
            $id_solicitud = $_POST['id_solicitud'];

            if($this->solicitudModel->actualizarEstadoPartida($id_partida, $estado)){
                flash('partida_mensaje_' . $id_partida, 'Partida actualizada.');
            }
            redirect('inspector/inspeccionar/' . $id_solicitud);
        }
    }

    // Agregar una observación a una partida
    public function agregarObservacion($id_partida){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $texto = trim($_POST['texto_observacion']);
            $id_solicitud = $_POST['id_solicitud'];
            // Lógica para subir archivo de evidencia iría aquí

            if(!empty($texto)){
                $this->solicitudModel->agregarObservacion($id_partida, $texto);
            }
            redirect('inspector/inspeccionar/' . $id_solicitud);
        }
    }

    // Finalizar toda la inspección
    public function terminar($id_solicitud){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->solicitudModel->terminarInspeccion($id_solicitud)){
                flash('solicitud_mensaje', 'Inspección #' . $id_solicitud . ' ha sido completada y cerrada.');
                redirect('inspector/index');
            }
        }
    }
}
