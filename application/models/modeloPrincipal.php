<?php

class ModeloPrincipal extends CI_Model{

    public function getSensores(){
        $this->db->select('*');
        $query = $this->db->get('sensores');

        if($query){
            return $query->result();
        }else{
            return NULL;
        }
    }

    public function deleteSensor($id){

        //Primero borramos las mediciones del sensor
        $this->db->where('fk_sensor', $id);
        $this->db->delete('mediciones');

        //Luego borramos el sensor de la lista de sensores
        $this->db->where('id', $id);
        $query = $this->db->delete('sensores');

        return $query;
    }

    public function setSensor($id,$nombre,$descripcion){
        
        /*Creo la estructura de datos con los parametros pasados en la funcion */
        $data = array(
            'nombreSensor' => $nombre,
            'descripcion' => $descripcion
        );

        $this->db->where('id', $id);
		
        //update devuelve true si la modificacion fue exitosa o false en caso de error
        $query =  $this->db->update('sensores', $data);

        return $query;
    }

    public function addSensor($nombre, $descripcion){
        
        /*Creo la estructura de datos con los parametros pasados en la funcion */
        $data = array(
            'nombreSensor' => $nombre,
            'descripcion' => $descripcion
        );

        /*Inserto la estructura de datos en la base de datos y almaceno el resultado de la insercion para devolverlo al controlador. El insert devuelve true si la insercion fue exitosa o false en caso de error*/
        $query = $this->db->insert('sensores', $data);
        return $query;
    }

    public function addMedicion($fecha,$hora,$temperatura,$sensor){

        /*Creo la estructura de datos con los parametros pasados en la funcion */
        $data = array(
            'fecha' => $fecha,
            'hora' => $hora,
            'temperatura' => $temperatura,
            'fk_sensor' => $sensor
        );

        /*Inserto la estructura de datos en la base de datos y almaceno el resultado de la insercion para devolverlo al controlador. El insert devuelve true si la insercion fue exitosa o false en caso de error*/
        $query = $this->db->insert('mediciones', $data);
        return $query;
    }

    public function getDatosMediciones(){
        $this->db->select('s.nombreSensor, m.fecha, m.temperatura');
        $this->db->from('sensores s');
        $this->db->join('mediciones m', 's.id = m.fk_sensor');
        $this->db->order_by('m.fecha', 'DESC');
    
        $aResult = $this->db->get();
    
        if(!$aResult->num_rows() == 1)
        {
            return false;
        }
    
        return $aResult->result_array();
    }

}