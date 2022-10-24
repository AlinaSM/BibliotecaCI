<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Libro;

class Libros extends Controller{

    public function index(){
        $libro = new Libro();
        $datos['libros'] = $libro->orderBy('id', 'ASC')->findAll(); 
        $datos['cabecera'] = view('template/header'); 
        $datos['piePagina'] = view('template/footer'); 

        return view('libros/listar', $datos);
    }

    public function crear(){
        $datos['cabecera'] = view('template/header'); 
        $datos['piePagina'] = view('template/footer'); 
        return view('libros/crear', $datos);
    }

    public function guardar(){
        $validation = $this->validate([
            'nombre' => 'required|min_length[3]',
            'imagen' => [
                'uploaded[imagen]',
                'mime_in[imagen,image/jpg,image/png,image/jpeg]',
                'max_size[imagen,1024]',
            ],
        ]);

        if(!$validation){
            $session = session(); 
            $session->setFlashData('mensaje', 'Registrar todos los campos'); 
            return redirect()->back()->withInput();
        }

        if($img = $this->request->getFile('imagen')){
            $nuevoNombreImg = $img->getRandomName();
            $img->move('../public/storage/', $nuevoNombreImg);
            
            $datos = [
                'name' => $this->request->getVar('nombre'),
                'img' => $nuevoNombreImg,
            ];

            $libro = new Libro();
            $libro->insert($datos);
        }

        return $this->response->redirect(site_url('libros/listar'));
    }

    public function eliminar($id = null){
        $libro = new Libro();

        $libroDatos = $libro->where('id', $id)->first();
        
        $ruta = ('../public/storage/'.$libroDatos['img']);
        unlink($ruta);

        $libro->where('id', $id)->delete($id);

        return $this->response->redirect(site_url('libros/listar'));
    }

    public function editar($id = null){
        $libro = new Libro();
        $datos['libro'] = $libro->where('id', $id)->first();
        
        $datos['cabecera'] = view('template/header'); 
        $datos['piePagina'] = view('template/footer'); 

        return view('libros/editar', $datos);
    }

    public function actualizar(){
        
        $validation = $this->validate([
            'nombre' => 'required|min_length[3]',
        ]);

        if(!$validation){
            $session = session(); 
            $session->setFlashData('mensaje', 'Registrar todos los campos'); 
            return redirect()->back()->withInput();
        }
        
        $libro = new Libro();

        $datos = [
            'name' => $this->request->getVar('nombre'),
        ];

        $id = $this->request->getVar('id');

        $libro->update($id, $datos);

        $validation = $this->validate([
            'imagen' => [
                'uploaded[imagen]',
                'mime_in[imagen,image/jpg,image/png,image/jpeg]',
                'max_size[imagen,1024]',
            ],
        ]);

        if( $validation ){
            if($img = $this->request->getFile('imagen')){
                 //Delete image from directory
                $libroDatos = $libro->where('id', $id)->first();
                $ruta = ('../public/storage/'.$libroDatos['img']);
                unlink($ruta);
                
                //Save new image
                $nuevoNombreImg = $img->getRandomName();
                $img->move('../public/storage/', $nuevoNombreImg);
                
                $datos = [ 'img' => $nuevoNombreImg ];

                $libro = new Libro();
                $libro->update($id, $datos);
            }
        }
        

        return $this->response->redirect(site_url('libros/listar'));
    }

}