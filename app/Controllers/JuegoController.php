<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\WarriorModel; // Asegúrate de importar el modelo

class JuegoController extends Controller
{
    public function guerreroView()
    {
        $warriorModel = new WarriorModel(); 
        $typeModel = new \App\Models\WarriorTypeModel();
        $raceModel = new \App\Models\RaceModel();
    
        // Obtener datos de la BD
        $this->data['types'] = $typeModel->findAll(); // Obtener todos los tipos de guerreros
        $this->data['races'] = $raceModel->findAll(); // Obtener todas las razas
        $this->data['warriors'] = $warriorModel->orderBy('warrior_id', 'ASC')->findAll(); // Obtener todos los guerreros
    
        return view('juego/guerreros_view', $this->data); // Pasar todos los datos a la vista
    }
    public function CrearJuego()
    {
        
        $warriorModel = new WarriorModel(); 
        $typeModel = new \App\Models\WarriorTypeModel();
        $raceModel = new \App\Models\RaceModel();
    
        // Obtener datos de la BD
        $this->data['types'] = $typeModel->findAll(); // Obtener todos los tipos de guerreros
        $this->data['races'] = $raceModel->findAll(); // Obtener todas las razas
        $this->data['warriors'] = $warriorModel->orderBy('warrior_id', 'ASC')->findAll(); // Obtener todos los guerreros
    
        return view('juego/crear_view', $this->data); // Pasar todos los datos a la vista
    }
    
}