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
    if( $user ) {
      if ( Hash::check( Input::get("password"), $user->password ) ) {
        $user->save();
        Session::put("user", Crypt::encrypt($user->id));
        return View::share("movies");
      } else {
        return Redirect::to("/")->with('msg','Password does not match!');
      }
    } else {
      return Redirect::to("/")->with('msg','User not registered!');
    }
  }
    
  public function anyRegister() {
    $user = User::whereEmail(Input::get("email"))->first();

    if( $user ) {
      return $user;
      return Redirect::guest("/")->with('msg',"User already registered!");
    } else {
      $user = new User;
      $user->username = Input::get("username");
      $user->email = Input::get("email");
      $user->password = Hash::make(Input::get("password"));
      $user->save();
      return Redirect::guest("/")->with('msg',"User registered succefully. Please, log in!");
    }

  }
  
  public function anyMarkAsWatchedMovie() {
    $user = User::find($this->idUser);
    $movie = Movie::find(Input::get("movie"));
    if ( $user && $movie ) {
      $watched = new WatchedMovie;
      $watched->user = $user->id;
      $watched->movie = $movie->id;
      $watched->save();
      return $watched;
    } else {
      return "Tente mais tarde";
    }
  }
  
  public function anyMarkAsFavoriteMovie() {
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
  
  public function anyUnmarkAsWatchedMovie() {
    $user = User::find($this->idUser);
    $movie = Movie::find(Input::get("movie"));
    if ( $user && $movie ) {
     $favorite = DB::statement("DELETE "
                . "FROM watched_movies "
                . "WHERE user=? AND movie=? ",
                [$this->idUser, $movie->id ]);
      return Redirect::guest("/movies");
    } else {
      return "Tente mais tarde!";
    }    
  }
  
   public function anyUnmarkAsFavoriteMovie() {
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
  
   public function anyMarkAsWatchedEpisode() {
    $user = User::find($this->idUser);
    $episode = Episode::find(Input::get("episode"));
    if ( $user && $episode ) {
      $watched = new WatchedEpisode;
      $watched->user = $user->id;
      $watched->episode = $episode->id;
      $watched->save();
      return $watched;
    } else {
      return "Tente mais tarde";
    }
  }
  
   public function anyMarkAsFavoriteSerie() {
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
  
  public function anyUnmarkAsFavoriteSerie() {
    $user = User::find($this->idUser);
    $serie = Serie::find(Crypt::decrypt(Input::get("serie")));
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
  
  public function anyUnmarkAsWatchedEpisode() {
    $user = User::find(Crypt::decrypt($this->idUser));
    $episode = Episode::find(Input::get("episode"));
    if ( $user && $episode ) {
      $favorite = DB::statement("DELETE "
                . "FROM watched_episodes "
                . "WHERE user=? AND episode=? ",
                [$this->idUser, $episode->id ]);
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
        $serie = Serie::find($favorite->serie);
        $serie->id = Crypt::encrypt($serie->id);
        $series[] = $serie;
      }
      return $series;
    } else {
      return Redirect::guest("/")->with("Tente mais tarde!");
    }
  }
  
   public function anyWatchedEpisodes() {
    $user = User::find($this->idUser);
    $serie = Serie::find(Input::get("serie"));
    if ( $user && $serie ) {
      $seasons = Season::whereSerie($serie->id)->get();
      foreach ($seasons as $season ) {
        $episodes[] = Episode::whereSeason($season->id)->get();
      }
      return episodes;
    } else {
      return Redirect::guest("/")->with('msg',"Tente mais tarde!");
    }
  }
}