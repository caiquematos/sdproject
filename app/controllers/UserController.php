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
    return Response::make('You can go and try /login or /register or /to-favorite-movie or /favorite-movies');
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
  
  public function anyToFavoriteMovie() {
    $user = User::find($this->idUser);
    $movie = Movie::find(Input::get("movie"));
    if ( $user && $movie ) {
      $favorite = new FavoriteMovie;
      $favorite->user = $user->id;
      $favorite->movie = $movie->id;
      $favorite->save();
      return $favorite;
    } else {
      return "Tente mais tarde!";
    }
  }
  
   public function anyUnfavoriteMovie() {
    $user = User::find($this->idUser);
    $movie = Movie::find(Input::get("movie"));
    if ( $user && $movie ) {
     $favorite = DB::statement("DELETE "
                . "FROM favorite_movies "
                . "WHERE user=? AND movie=? ",
                [$this->idUser, $movie->id ]);
      return Redirect::guest("/movies");
    } else {
      return "Tente mais tarde!";
    }
  }
  
  public function anyFavoriteMovies() {
    $user = User::find($this->idUser);
    if ( $user ) {
      $favorites = FavoriteMovie::whereUser($user->id)->get();
      $movies = [];
      foreach ( $favorites as $favorite ) {
        $movies[] = Movie::find($favorite->movie);
      }
      return $movies;
    } else {
      return Redirect::guest("/")->with("Tente mais tarde!");
    }
  }
  
   public function anyToFavoriteSerie() {
    $user = User::find($this->idUser);
    $serie = Serie::find(Input::get("serie"));
    if ( $user && $serie ) {
      $favorite = new FavoriteSerie;
      $favorite->user = $user->id;
      $favorite->serie = $serie->id;
      $favorite->save();
      return $favorite;
    } else {
      return "Tente mais tarde!";
    }
  }
  
  public function anyUnfavoriteSerie() {
    $user = User::find($this->idUser);
    $serie = Serie::find(Input::get("serie"));
    if ( $user && $serie ) {
      $favorite = DB::statement("DELETE "
                . "FROM favorite_series "
                . "WHERE user=? AND serie=? ",
                [$this->idUser, $serie->id ]);
      return Redirect::guest("/series");
    } else {
      return "Tente mais tarde!";
    }
  }
  
  public function anyFavoriteSeries() {
    $user = User::find($this->idUser);
    if ( $user ) {
      $favorites = FavoriteSerie::whereUser($user->id)->get();
      $series = [];
      foreach ( $favorites as $favorite ) {
        $series[] = Serie::find($favorite->serie);
      }
      return $series;
    } else {
      return Redirect::guest("/")->with("Tente mais tarde!");
    }
  }
}