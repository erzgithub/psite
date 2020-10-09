$(function(){
	 var atvc = {val1:"Yes", val2:"No"};
	 var mvpc = {val1:1, val2: 2, val3:3, val4:4, val5:5, val6:6, val7:7, val8:8, val9:9, val10:10};
	  var atvkey;
	 
	LoadATV();
	LoadMVP();
	 
	 function LoadATV(){
		$.each(atvc, function(val, text){
			$("#atv").append(new Option(text));
		 }); 
	 }
	 
	 function LoadMVP(){
		 $.each(mvpc, function(val, text){
			$("#mvp").append(new Option(text));
		 });
	 }
	 
	 //$("#atv").prop("selectedIndex", 0);
	// $("#mvp").prop("selectedIndex", 0);
	 
	 $("#atv").focus(function(){
		$(this).empty();
		LoadATV();
	 });
	 
	 $("#mvp").focus(function(){
		$(this).empty();
		LoadMVP();
	 });
	 
	 $("#btnapply").click(function(){
		 var atv = $("#atv").val();
		 var mvp = $("#mvp").val();
		
		$.post(BaseURL + "/apply/applysettings", {"atv":atv, "mvp":mvp}, function(data){
			alert(data);
		});

	 });
	 $("#btnapplyall").click(function(){
	 	$.ajax({
	 		url: BaseURL + '/apply/applyAll',
	 		success:function(data){
	 			alert(data);
	 		}
	 	});
	 });
	 
});