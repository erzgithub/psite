$(function(){
	 $("#btnreg").click(function(){
		var username = $("#txtuser").val();
		var password = hex_sha512($("#txtpassword").val());
		
		if(username && password){
			$.post(BaseURL + "/regsave/register", {"username": username, "password":password}, function(data){
				alert(data);
			});
		}
	 });
});