<!DOCTYPE html>
<html>
<head>
	<title>Vue.js CRUD Series using PHP/MySQLi</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
	<style>
		.modal{
				position: fixed;
				top:0;
				left:0;
				right:0;
				bottom:0;
				background:rgba(0,0,0,0.4);
		}

		.modalContainer{
			width:555px;
			background:#FFFFFF;
			margin: auto;
			margin-top: 44px;
		}

		.modalHeading{
			padding: 6px;
			background:#06307C;
			color: #FFFFFF;
		}

		.modalContent{
			min-height: 333px;
			padding: 44px;
		}
	</style>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="http://pure.github.io/pure/libs/pure.js"></script>
</head>
<body>
<div id="songs" style="height: 500px"> <!-- hack for jsFidle-->
  <ul>
    
      {{songs}} - <a href="#" v-on:click="deleteSong(index)">DELETE</a>
    
  </ul>
</div>
<script>
var app = new Vue({
  el: '#songs', // specify where the magic happens
  created: function() { // equals onReady
    this.getLastPlayed(); // this -> methods
  },
  data: {
    songs: [] // initialise empty data
  },
  methods: {
    getLastPlayed: function() {
      this.$http.get('http://www.everyboardy.com/realtime/clicks.php') // does a HTTP GET request
        .then(function(response) {
          this.songs = response.body // pushes the JSON parsed body to the data
        })
    },
    deleteSong: function(index) {
    	this.songs.splice(index,1);
    }
  }
  
})

setInterval(function(){
	Vue.set(app.songs,0,{ artist: "Thomas More", song: "Expect More JS" })
}, 1000)
</script>

</body>
</html>