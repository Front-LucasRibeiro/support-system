<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController
{
  public function index()
  {
    return view('register.index');
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|email|unique:users',
      'cpf' => 'required|cpf|unique:users',
      'password' => 'required',
    ]);

    if ($validator->fails()) {

      $messages = $validator->errors()->toArray();

      foreach ($messages as $field => $errors) {
        foreach ($errors as $index => $error) {
          if ($error === 'The email has already been taken.') {
            $messages[$field][$index] = 'O email informado já existe.';
          } elseif ($error === 'The cpf has already been taken.') {
            $messages[$field][$index] = 'O cpf informado já existe.';
          } 
        }
      }

      return back()->withErrors($messages)->withInput();
    }

    $data = $request->except(['_token']);
    $data['password'] = Hash::make($data['password']);


    if (strpos($request->input('email'), '@collaborator.com') !== false) {
      $data['user_type'] = 'Colaborador';
    } else {
      $data['user_type'] = 'Cliente';
    }


    $user = User::create($data);
    Auth::login($user);

    return redirect('/chamados');
  }
}
