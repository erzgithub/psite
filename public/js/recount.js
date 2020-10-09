$(function(){
	//select voterID, count(*) from tbl_votehistory group by voterID having count(*) > 1  //display duplicated records
	//select voterID,count(*) as c from tbl_votehistory where voterID = 1 and CandidateID = 6 group by voterID having count(*) > 1
	//http://www.webveteran.com/blog/web-coding/mysql/mysql-quickly-find-duplicate-records-based-on-any-field/
	
	 LoadList();
	 function LoadList(){
		 $.ajax({
			 type:"POST",
			 url: BaseURL + "/loadrecount/loadlist",
			 async: false,
			 success:function(html){
				 $("#rcontainer").html(html);
				 recountControl();
			 }
		 });
	 }
	 
	 $("#txthost").keyup(function(){
			if(!($(this).val() == null)){
				 LoadHost($(this).val());
			}
	 });
	 
	 function LoadHost(value){
		 $.post(BaseURL + "/loadhost/loadhost/" + value, function(html){
				/*$("#h2").fadeOut(100, function(){
						$(this).html(html);
				}).fadeIn(100);*/
				$("#h2").html(html);
		 });
	 }
	 
	 function recountControl(){
		 $(".rexec").each(function(){
			$("#" + this.id).click(function(){
				var txthost = $("#txthost").val();
				if(!(txthost == 0)){
					/**/var td = $(this).closest("td");
					var col = $(td).parent().children().index(td);
					var row = $(td).parent().parent().children().index(td.parent());
					
					var hostkey = $("#filterhost").text();
			
					
					$.post(BaseURL + "/loadhost/repaintscore/" + this.id,{"hostkey": hostkey}, function(html){
						if(html == 0){
							alert("This record has already been executed");
						}else if(html == 1){
							alert("This record does not exists");
						}else{ 
							alert(html);
							$("#tblrecount tr:nth-child(" + (row + 1) + ") td:nth-child(" + (col + 3) + ")").text($("#hostfn").text());
						}
					});
				}else{ 
					alert("Please enter a name in the text field");
				}
			});
		 });
	 }
});