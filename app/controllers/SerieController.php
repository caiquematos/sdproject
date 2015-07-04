<?php

class SerieController extends \BaseController {

	 private $idUser;

	public function SerieController(){
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
    return Response::make('You can go and try /add or /remove or /addSeason or /addEpisode or /removeSeason or /removeEpisode');
	}
  
  public function anyAdd(){
    $serie = new Serie;
    $serie->title = Input::get("title");
    $serie->synopsis = Input::get("synopsis");
    $year = date("Y", strtotime( Input::get("year") ) );
    $serie->year = $year;
    $serie->genre = Input::get("genre");
    $serie->image = Input::get("image");
    $serie->trailer = Input::get("trailer");
    $serie->rate = Input::get("rate");
    $serie->save();
    
    $season = new Season;
    $season->serie = $serie->id;
    $season->title = "Season 1";
    $season->save();
    
    return $season;
  }
  
  public function anyAddSeason() {
    $serie = Serie::find(Input::get("serie"));
    if ( $serie ) {
      $season = new Season;
      $season->serie = $serie->id;
      $season->title = Input::get("title");
      $season->save();
      return $season;
    } else {
      return Redirect::guest("/series");
    }
  }
  
  public function anyAddEpisode() {
    $season = Season::find(Input::get("season"));
    if ( $season ) {
      $episode = new Episode;
      $episode->season = $season->id;
      $episode->title = Input::get("title");
      $episode->synopsis = Input::get("synopsis");
      $episode->prome = Input::get("prome");
      $episode->save();
      return $episode;
    } else {
      return Redirect::guest("/series");
    }
  }
  
  public function anyRemove() {
    $serie = Serie::find(Input::get("serie"));
    if ( $serie ) {
      $serie->delete();
      return Redirect::guest("/series");
    } else {
      return Redirect::guest("/")->with("Tente mais tarde!");
    }
  }
  
  public function anyRemoveSeason() {
    $season = Season::find(Input::get("season"));
    if ( $season ) {
      $episodes = Episode::whereSeason($season->id)->get();
      foreach ( $episodes as $episode ) {
        $episode->delete();
      }
      $season->delete();
      return Redirect::guest("/series");
    } else {
      return Redirect::guest("/series")->with("Tente mais tarde!");
    }
  }
  
   public function anyRemoveEpisode() {
    $episode = Episode::find(Input::get("episode"));
    if ( $episode ) {
      $episode->delete();
      return Redirect::guest("/series");
    } else {
      return Redirect::guest("/series")->with("Tente mais tarde!");
    }
  }

}