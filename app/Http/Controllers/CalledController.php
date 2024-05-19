<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class CalledController extends Controller {

  public function index(Request $request){
    $calleds = [
      'erro iniciar',
      'erro instalação',
      'erro tela azul'
    ];

    return view('calleds.index')-> with('calleds', $calleds);
  }

  public function create(){
    return view('calleds.create');
  }
}
