var app = new Vue({
	el: '#members',
	data:{
 
		members: []
	},
 
	mounted: function(){
		console.log("mounted");
		this.getAllMembers();
	},
 
	methods:{
		getAllMembers: function(){
			axios.get("api.php")
				.then(function(response){
					console.log(response);
					app.members = response.data.members;
				});
		}
	}
});