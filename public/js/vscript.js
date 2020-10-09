$(function(){
	var ac = [];
	var currkey;
	var vp = 0;
	
	currkey = $("#curkey").text();

	$.ajax({
		type:"POST",
		url:BaseURL + "/candidate/loadlist",
		data: "currkey=" + currkey,
		async: true,
		success:function(data){
			$("#container").html(data);
			allowControls();
		}
	});
	
	function allowControls(){
		$(".btnvote").each(function(){
		//	var s = this.id.replace("v", "");
			 $("#" + this.id).bind("click", function(){
				var currid = this.id;
				
				if($(this).text() == "Vote"){
					vp = parseInt($("#vp").text());
				
						if(!(vp <= 0)){
							$(this).text("Withdraw");
							$(this).addClass("voted");
							ac.push(currid);
							updateVotePoints("Vote");
						}else{ 
							alert("Vote Exceeded");
						}
					
				}else if($(this).text() == "Cancel"){
					cancelVote(currid);
					$(this).text("Vote");
					$(this).removeClass("cancel");
					updateVotePoints("Cancel");
				}else{ 
					$(this).text("Vote");
					$(this).removeClass("voted");
					removeA(ac, currid);
					updateVotePoints("Cancel");
				}
			 });
			 
			/*  $.ajax({
				 type:"POST",
				 url: BaseURL + "/school/loadschool",
				data: "school=" + this.id,
				async:true,
				success:function(data){
					$(".school" + s).html(data);
				}
			 });*/
			 
		});	
	}
	
	function updateVotePoints(value){
		var lvp = parseInt($("#vp").text());
		
		if(value == "Cancel"){
			lvp++;
		}else{ 
			lvp--;
		}
		
		$("#vp").text(lvp);
	}
	
	function removeA(arr){
		var what, a = arguments, L = a.length, ax;
			while(L > 1 && arr.length){
				what = a[--L];
					while((ax = arr.indexOf(what)) !== -1){
						arr.splice(ax, 1);
					}
				}
			return arr;
	}
	
	$("#btnProceed").click(function(e){
		e.preventDefault();
		currkey = $("#curkey").text();
				
			$(this).hide();
			 
	/**/	$.ajax({
			type:"POST",
			url: BaseURL + "/voteexec/verifyvote",
			data: "ac=" + ac + "&currkey=" + currkey,
			async: false,
			beforeSend: function(){
				 $(this).hide();
			},
			success: function(data){
				
				switch(parseInt(data)){
					case -5:
						alert("Successfully voted " + ac.length + " candidate(s)");
						location = BaseURL + "/records";
						break;
					case -3:
						alert("Please select candidates");
						break;
					default:
						alert(data);
				}
				 
			},
			complete: function(){
				
			}
		}); 
	});
	
	function cancelVote(id){
		currkey = $("#curkey").text();
		$.post(BaseURL + "/votecancel/confirmcancel", {"currkey":currkey, "id":id}, function(data){
			alert(data);
		});
	}

});