<?php

class UserController extends \BaseController {
  private $idUser;

	public function UserController(){
    $id = Session::get("user");
    if ($id == null || $id == "") {
      $this->idUser = false;
    }
    else {
      $this->idUser = Crypt::decrypt($id);
    }
  }
	
	public function getIndex()
	{
    return Response::make('You can go and try /login or /register or /edit or /buddies');
	}
  
  public function anyLogin(){
    $user = User::whereEmail(Input::get("email"))->first();

    if( $user && Hash::check( Input::get("password"), $user->password ) ) {
      $user->save();
      Session::put("user", Crypt::encrypt($user->id));
      return View::make("home")->with("Login realizado com sucesso!");
    } else {
      return Redirect::guest("/")->with("Usuário não cadastrado!");
    }
  }
    
  public function anyRegister() {
    $user = User::whereEmail(Input::get("email"))->first();

    if( $user ) {
      return $user;
      return Redirect::guest("/")->with("Usuário já cadastrado!");
    } else {
      $user = new User;
      $user->email = Input::get("email");
      $user->password = Hash::make(Input::get("password"));
      $user->save();
      return $user;
      return Redirect::guest("/")->with("Usuário cadastrado com sucesso! Por favor, realize login!");
    }

  }
}