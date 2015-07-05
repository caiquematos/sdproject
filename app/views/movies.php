<div id="popular">   
<div class="row" id="card">
</div>

<script>
var APIurl = 'http://image.tmdb.org/t/p/w500/';    
var APIkey = '?api_key=e72345bc866f8a423c6b3da9c1a9026a';    
var request = new XMLHttpRequest();

request.open('GET', 'http://api.themoviedb.org/3/movie/popular'+APIkey);

request.setRequestHeader('Accept', 'application/json');

   
    
request.onreadystatechange = function () {
  if (this.readyState === 4) {
    console.log('Status:', this.status);
    console.log('Headers:', this.getAllResponseHeaders());
    console.log('Body:', this.responseText);
    var objJson = JSON.parse(this.responseText);
    var text = "";
    
    for(var i=0;i<objJson.results.length;i++){
        if(i==0) text += '<div class="row">';
        
        text += '<div class="col s12 m3"><div class="card"><div class="card-image"><img src="'+APIurl+objJson.results[i].poster_path+APIkey+'"><span class="card-title">'+objJson.results[i].vote_average+'/10</span></div><div class="card-action"><a href="">'+objJson.results[i].original_title+' ['+objJson.results[i].release_date.substring(0,4)+']'+'</a></div></div></div>';
        if((i+1) % 4 == 0 && i > 2) text += '</div><div class="row">';
        if(i == objJson.results.length) text += ' </div>';
    }
     document.getElementById("card").innerHTML = text;
  }
};

     var arr = request.send();

</script>
</div>

<div id="year">   
<div class="row" id="card">
</div>

<script>
var APIurl = 'http://image.tmdb.org/t/p/w500/';    
var APIkey = '?api_key=e72345bc866f8a423c6b3da9c1a9026a';    
var request = new XMLHttpRequest();

request.open('GET', 'http://api.themoviedb.org/3/movie/popular'+APIkey);

request.setRequestHeader('Accept', 'application/json');

   
    
request.onreadystatechange = function () {
  if (this.readyState === 4) {
    console.log('Status:', this.status);
    console.log('Headers:', this.getAllResponseHeaders());
    console.log('Body:', this.responseText);
    var objJson = JSON.parse(this.responseText);
    var text = "";
    
    for(var i=0;i<objJson.results.length;i++){
        if(i==0) text += '<div class="row">';
        
        text += '<div class="col s12 m3"><div class="card"><div class="card-image"><img src="'+APIurl+objJson.results[i].poster_path+APIkey+'"><span class="card-title">'+objJson.results[i].vote_average+'/10</span></div><div class="card-action"><a href="">'+objJson.results[i].original_title+' ['+objJson.results[i].release_date.substring(0,4)+']'+'</a></div></div></div>';
        if((i+1) % 4 == 0 && i > 2) text += '</div><div class="row">';
        if(i == objJson.results.length) text += ' </div>';
    }
     document.getElementById("card").innerHTML = text;
  }
};

     var arr = request.send();

</script>
</div>


<div id="genre">   
<div class="row" id="card">
</div>

<script>
var APIurl = 'http://image.tmdb.org/t/p/w500/';    
var APIkey = '?api_key=e72345bc866f8a423c6b3da9c1a9026a';    
var request = new XMLHttpRequest();

request.open('GET', 'http://api.themoviedb.org/3/movie/popular'+APIkey);

request.setRequestHeader('Accept', 'application/json');

   
    
request.onreadystatechange = function () {
  if (this.readyState === 4) {
    console.log('Status:', this.status);
    console.log('Headers:', this.getAllResponseHeaders());
    console.log('Body:', this.responseText);
    var objJson = JSON.parse(this.responseText);
    var text = "";
    
    for(var i=0;i<objJson.results.length;i++){
        if(i==0) text += '<div class="row">';
        
        text += '<div class="col s12 m3"><div class="card"><div class="card-image"><img src="'+APIurl+objJson.results[i].poster_path+APIkey+'"><span class="card-title">'+objJson.results[i].vote_average+'/10</span></div><div class="card-action"><a href="">'+objJson.results[i].original_title+' ['+objJson.results[i].release_date.substring(0,4)+']'+'</a></div></div></div>';
        if((i+1) % 4 == 0 && i > 2) text += '</div><div class="row">';
        if(i == objJson.results.length) text += ' </div>';
    }
     document.getElementById("card").innerHTML = text;
  }
};

     var arr = request.send();

</script>
</div> 