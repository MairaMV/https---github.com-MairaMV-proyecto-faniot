<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

    public function cargarVista(){
        $this->load->view('vistaPrincipal');
    }

    public function recuperarSensoresDB(){

        //Cargo el modelo
        $this->load->model('modeloPrincipal','mp');

        //Recupero los datos de la BD
        $retornar = $this->mp->getSensores();

        echo json_encode($retornar);
    }

    public function eliminarSensorDB(){
        $id = $this->input->post('sensorAEliminar');

        //Cargo el modelo
        $this->load->model('modeloPrincipal','mp');

        //Eliminamos el sensor de la BD
        $retornar = $this->mp->deleteSensor($id);

        echo $retornar;
    }

    public function modificarSensorDB(){
        $id = $this->input->post('sensorAModificar'); 
        $nuevoNombre = $this->input->post('nombreModificacion');
        $nuevaDescripcion = $this->input->post('descripcionModificacion');

        //Cargo el modelo
        $this->load->model('modeloPrincipal','mp');

        //Modificamos los datos del sensor
        $retornar = $this->mp->setSensor($id,$nuevoNombre,$nuevaDescripcion);

        echo $retornar;
    }

    public function nuevoSensorDB(){
        $nombre = $this->input->post('nombre');
        $descripcion = $this->input->post('descripcion');
        
        //Cargo el modelo
        $this->load->model('modeloPrincipal','mp');

        //Damos de alta el nuevo sensor 
        $retornar = $this->mp->addSensor($nombre,$descripcion);

        echo $retornar;
    }

    public function nuevaMedicionDB(){
        $fecha = $this->input->post('fecha');
        $hora = $this->input->post('hora');
        $temperatura = $this->input->post('temperatura');
        $sensor = $this->input->post('sensor');
        
        //Cargo el modelo
        $this->load->model('modeloPrincipal','mp');

        //Damos de alta la nueva medicion del sensor 
        $retornar = $this->mp->addMedicion($fecha,$hora,$temperatura,$sensor);

        echo $retornar;
    }

    public function datosMedicionesDB(){
        //Cargo el modelo
        $this->load->model('modeloPrincipal','mp');

        //Recupero los datos de la BD
        $retornar = $this->mp->getDatosMediciones();

        echo json_encode($retornar);
    }
    
}