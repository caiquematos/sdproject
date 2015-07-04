<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="TVction">

    <link rel="icon" href="img/ico.png">
        
    <title>::.TVction.::</title>

    <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
      
  </head>
  
  <body>     

   <div class="navbar-fixed">
       <nav>
    <div class="nav-wrapper">
      <a href="#!" class="brand-logo"><img  src="img/ico.png"></a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
      <ul class="right hide-on-med-and-down">       
         <li class="menu"><a href="html/movies">Movies</a></li>
        <li class="menu"><a href="html/tvshows">TV Shows</a></li>
          <li class="menu"><a href="html/profile">Profile</a></li>
        <li class="active"><a href="/logout">Logout</a></li>
          <li></li>
      </ul>
      <ul class="side-nav" id="mobile-demo">
          <li class="menu"><a href="html/movies">Movies</a></li>
        <li class="menu"><a href="html/tvshows">TV Shows</a></li>
          <li class="menu"><a href="html/profile">Profile</a></li>
        <li class="active"><a href="/logout">Logout</a></li>
      </ul>
    </div>
      </nav>
</div>            

      
    </br>

  <div class="container" id="main">

    <div class="row center">
    <form  action="/user/login" method="post">
        <div class="card-panel teal #e0f7fa cyan lighten-5">
        
        <div class="input-field col s12">
          <input id="email" name="email" type="email" >
          <label for="email" data-error="wrong" data-success="right" >Email</label>
        </div>
     
        <div class="input-field col s12">
          <input id="password" name="password" type="password" class="validate">
          <label for="password">Password</label>
      </div>
      <button class="btn waves-effect waves-light green" type="submit" name="action">Submit</button></br></br>
    <!-- Modal Trigger -->
        <a class="btn waves-effect waves-light modal-trigger" type="submit" name="action" href="#modal1">Create Account</a>
      <div id="msg" name="msg" >
        <?php echo Session::get('msg'); ?>
      </div>
        </div>
      </form>
    </div>

  
  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <form action="/user/register">
      <h4 class="caption center-align">Create Account</h4>
        <div class="row">
        <div class="input-field col s12">
          <input id="username-register" name="username" type="text" >
          <label for="username" data-error="wrong" data-success="right" >Username</label>
        </div>
        <div class="input-field col s12">
          <input id="email-register" type="email" name="email" class="validate" >
          <label for="email" data-error="wrong" data-success="right" >Email</label>
        </div>
        <div class="input-field col s12">
          <input id="password-register" type="password" name="password" class="validate">
          <label for="password">Password</label>
        </div>
            <div class="input-field col s12">
          <input id="conf-password" type="password" class="validate">
          <label for="conf-password">Confirm Password</label>
        </div>
      </div>
      <button class="btn waves-effect waves-light green" type="submit" name="action">Submit</button></br></br>
      <div id="msg" name="msg" >
        <?php echo Session::get('msg'); ?>
      </div>
    </form>
    </div>
    
  </div>
      
</div>


  <footer class="page-footer #EE6E73" >
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">TVction</h5>
          <p class="grey-text text-lighten-4">Application used to catalog movies and TV shows! Your TV addiction on your hand! Enjoy!</p>


        </div>
        
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Caique | Raymundo | Thaminne</a>
      </div>
    </div>
  </footer>
      
    <script>
$(document).ready(function(){
    $('.modal-trigger').leanModal();
    $(".menu a").click(function(e){
                        e.preventDefault();
                        var href = $( this ).attr('href');
                        $("#main").load(href);
            });
    });
        
            $(".button-collapse").sideNav();
      
    </script>
    
  </body>
</html>