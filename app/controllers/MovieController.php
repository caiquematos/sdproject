<?php

class MovieController extends \BaseController {
  private $idUser;

	public function MovieController(){
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
    return Response::make('You can go and try /add or /remove');
	}
  
  public function anyAdd(){
    $movie = new Movie;
    $movie->url = Input::get("web_id");
    $movie->title = Input::get("title");
    $movie->synopsis = Input::get("synopsis");
    $movie->year = Input::get("year");
    $movie->image = Input::get("image");
    $movie->trailer = Input::get("trailer");
    $movie->rate = Input::get("rate");
    $movie->genre = Input::get("genre");
    $movie->save();
    return $movie;
  }
  
  public function anyRemove() {
    $movie = Movie::find(Input::get("movie"));
    if ( $movie ) {
      $movie->delete();
      return Redirect::guest("/movies");
    } else {
      return Redirect::guest("/")->with("Tente mais tarde!");
    }
  }
  
}