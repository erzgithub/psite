$(function(){
	 $("input[type=password]").keypress(function(e){
		if(e.which == 13){
			Login();
		}
	 });
	 
	 $("#btnlogin").click(function(){
		Login();
	 });
	 
	 function Login(){
		 var form = $("form");
		 var password = hex_sha512($("#txtpassword").val());
		 var user = $.trim($("#txtuser").val());
		 
		 if(user && password){
			 form.append("<input id='p' name='p' type='hidden'/>");
			 $("#p").val(password);
			 form.submit();
		 }else{ 
			alert("Please enter username and password");
		 }
	 }
});