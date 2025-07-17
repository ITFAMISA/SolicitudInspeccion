<?php
// app/models/Solicitud.php
class Solicitud {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    // --- Métodos para Supervisor ---

    public function obtenerSolicitudesPorSupervisor($id_supervisor){
        $this->db->query("SELECT s.*, u.nombre_completo as nombre_inspector 
                          FROM solicitudes_inspeccion s 
                          LEFT JOIN usuarios u ON s.id_inspector = u.id
                          WHERE s.id_supervisor = :id_supervisor 
                          ORDER BY s.fecha_solicitud DESC");
        $this->db->bind(':id_supervisor', $id_supervisor);
        return $this->db->resultSet();
    }

    public function crearSolicitud($data){
        $this->db->beginTransaction();
        try {
            $this->db->query('INSERT INTO solicitudes_inspeccion (id_supervisor, orden_trabajo, cliente, proyecto, area_proceso) VALUES (:id_supervisor, :orden_trabajo, :cliente, :proyecto, :area_proceso)');
            $this->db->bind(':id_supervisor', $data['id_supervisor']);
            $this->db->bind(':orden_trabajo', $data['orden_trabajo']);
            $this->db->bind(':cliente', $data['cliente']);
            $this->db->bind(':proyecto', $data['proyecto']);
            $this->db->bind(':area_proceso', $data['area_proceso']);
            $this->db->execute();
            
            $id_solicitud = $this->db->lastInsertId();

            foreach ($data['partidas'] as $partida) {
                $this->db->query('INSERT INTO partidas_inspeccion (id_solicitud, numero_dibujo, revision, marca, cantidad, descripcion) VALUES (:id, :num_dibujo, :rev, :marca, :cant, :desc)');
                $this->db->bind(':id', $id_solicitud);
                $this->db->bind(':num_dibujo', $partida['numero_dibujo']);
                $this->db->bind(':rev', $partida['revision']);
                $this->db->bind(':marca', $partida['marca']);
                $this->db->bind(':cant', $partida['cantidad']);
                $this->db->bind(':desc', $partida['descripcion']);
                $this->db->execute();
            }

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function registrarLlegadaInspector($id_solicitud){
        $this->db->query('UPDATE solicitudes_inspeccion SET fecha_llegada_inspector = NOW() WHERE id = :id');
        $this->db->bind(':id', $id_solicitud);
        return $this->db->execute();
    }

    // --- Métodos Comunes y para Inspector/Admin ---

    public function obtenerSolicitudPorId($id){
        $this->db->query('SELECT s.*, sup.nombre_completo as nombre_supervisor, insp.nombre_completo as nombre_inspector FROM solicitudes_inspeccion s JOIN usuarios sup ON s.id_supervisor = sup.id LEFT JOIN usuarios insp ON s.id_inspector = insp.id WHERE s.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function obtenerPartidasPorSolicitudId($id_solicitud){
        $this->db->query('SELECT * FROM partidas_inspeccion WHERE id_solicitud = :id_solicitud ORDER BY id ASC');
        $this->db->bind(':id_solicitud', $id_solicitud);
        return $this->db->resultSet();
    }
    
    public function obtenerObservacionesPorPartidaId($id_partida){
        $this->db->query('SELECT * FROM observaciones_partida WHERE id_partida = :id_partida ORDER BY fecha_creacion DESC');
        $this->db->bind(':id_partida', $id_partida);
        return $this->db->resultSet();
    }
    
    // --- Métodos para Inspector ---

    public function obtenerSolicitudesDisponibles(){
        $this->db->query("SELECT s.*, u.nombre_completo as nombre_supervisor 
                          FROM solicitudes_inspeccion s
                          JOIN usuarios u ON s.id_supervisor = u.id
                          WHERE s.estado = 'Pendiente'
                          ORDER BY s.fecha_solicitud ASC");
        return $this->db->resultSet();
    }

    public function obtenerSolicitudesPorInspector($id_inspector){
        $this->db->query("SELECT s.*, u.nombre_completo as nombre_supervisor 
                          FROM solicitudes_inspeccion s
                          JOIN usuarios u ON s.id_supervisor = u.id
                          WHERE s.id_inspector = :id_inspector
                          ORDER BY s.fecha_solicitud DESC");
        $this->db->bind(':id_inspector', $id_inspector);
        return $this->db->resultSet();
    }

    public function tomarSolicitud($id_solicitud, $id_inspector){
        $this->db->query('UPDATE solicitudes_inspeccion SET id_inspector = :id_inspector, estado = "Tomada", fecha_aceptada = NOW() WHERE id = :id_solicitud');
        $this->db->bind(':id_inspector', $id_inspector);
        $this->db->bind(':id_solicitud', $id_solicitud);
        return $this->db->execute();
    }
    
    public function actualizarEstadoPartida($id_partida, $estado){
        $this->db->query('UPDATE partidas_inspeccion SET estado = :estado WHERE id = :id_partida');
        $this->db->bind(':estado', $estado);
        $this->db->bind(':id_partida', $id_partida);
        return $this->db->execute();
    }

    public function agregarObservacion($id_partida, $texto, $path_evidencia = null){
        $this->db->query('INSERT INTO observaciones_partida (id_partida, texto_observacion, evidencia_path) VALUES (:id_partida, :texto, :path)');
        $this->db->bind(':id_partida', $id_partida);
        $this->db->bind(':texto', $texto);
        $this->db->bind(':path', $path_evidencia);
        return $this->db->execute();
    }

    public function terminarInspeccion($id_solicitud){
        $this->db->query('UPDATE solicitudes_inspeccion SET estado = "Completada", fecha_terminacion = NOW() WHERE id = :id');
        $this->db->bind(':id', $id_solicitud);
        return $this->db->execute();
    }
    
    // --- Métodos para Admin ---
    
    public function obtenerTodasLasSolicitudes(){
        $this->db->query("SELECT s.*, sup.nombre_completo as nombre_supervisor, insp.nombre_completo as nombre_inspector 
                          FROM solicitudes_inspeccion s 
                          JOIN usuarios sup ON s.id_supervisor = sup.id
                          LEFT JOIN usuarios insp ON s.id_inspector = insp.id
                          ORDER BY s.fecha_solicitud DESC");
        return $this->db->resultSet();
    }
}
