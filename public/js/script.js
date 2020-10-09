$(function(){
	
	/*	var pathArray = location.href.split("/");
		var myProtocol = pathArray[0];
		var myHost = pathArray[2];
		var myPath = pathArray[3];
		var BaseURL = myProtocol + "//" + myHost + "/" + myPath;*/
		
		
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		var state = $("#state").text();
		var category = {val1:"First Name", val2:"Last Name", val3: "Track No" , val4: "Office Or Company"};
		var MemType = {val1:"Member", val2:"Non-member"};
		var gender = {val1:"Male", val2:"Female"};
		var wC = false;
		var Condition = null;
		var TotalRecord = $.ajax({type:"POST", url:BaseURL + "/totalrecords/gettotal", async:false}).responseText;
		
		$("#recordcount").text(TotalRecord);
		
		$.each(category, function(val, text){
			$("#cmbcategory").append(new Option(text));
		});
		
		$.each(MemType, function(val, text){
			$("#cmbindi").append(new Option(text));
		});
		
		$.each(MemType, function(val, text){
			$("#cmbins").append(new Option(text));
		});
		
	/**/	LoadChoices();
		function LoadChoices(){
			var choice = $.ajax({type:"POST", url: BaseURL + "/choices/loadchoices", async:false}).responseText;
			 var ch = JSON.parse(choice.split(","));
			 
				$("#cmbregion").empty();
				   for(var i = 0; i < ch.length; i++){
					$("#cmbregion").append(new Option(ch[i]));
				 }
		/*	  
			
			  if(!state){
				  $("#cmbclass").empty();
				  $("#cmbtn").empty();
			  }
			
			 
			 for(var i = 1; i < 4; i++){
				$("#cmbtn").append(new Option(i));
			 }  */
			$("#bsec").append($("<canvas id='blank' style='display:none; background: blue;' height='150' width='400'></canvas>"));
			/* if(state){
				$("#btnreg").attr("disabled", false);
			 }else{ 
				$("#btnreg").attr("disabled", true);
			 }*/
		}
			
		LoadGender();
		
		 $("#cmbregion").prop("selectedIndex", 0);
		 $("#cmbmember").prop("selectedIndex", 1);
		 
		 function LoadGender(){
			$.each(gender, function(val, text){
				$("#cmbgender").append(new Option(text));
			});
		 }
		 
		$("#cmbregion").focus(function(){
			$(this).empty();
			LoadChoices();
		});
		
		$("#cmbmember").focus(function(){
			$(this).empty();
			$.each(Individual, function(val, text){
				$("#cmbmember").append(new Option(text));
			});
		});
		
		$("#cmbgender").focus(function(){
			$(this).empty();
			LoadGender();
		});
		
		$("#cmbtn").focus(function(){
			$(this).empty();
			LoadChoices();
		});
		
			
		function vanishWarns(idname, warnid){
			$(idname).keyup(function(){
				$(warnid).fadeOut(1000);
			});
		}
		
		function AutoCaps(ObjName){
			/**/$(ObjName).focusout(function(){
					var s = $(this).val();
					s = s.toLowerCase().replace(/\b[a-z]/g, function(letter){
						return letter.toUpperCase();
					});
					$(this).val(s);
			});
		}
		
		/*AutoCaps("#regFN");
		AutoCaps("#regLN");
		AutoCaps("#regoffice");
		AutoCaps("#regposition");*/
		
		vanishWarns("#regFN", "#warnfn");
		vanishWarns("#regLN", "#warnln");
		vanishWarns("#regoffice", "#warnoffice");
		vanishWarns("#CompanyName", "#warnprc");
		vanishWarns("#regemail", "#warnemail");
		
		function showWarns(val, warnID){
			if(!$.trim(val).length > 0){$(warnID).fadeIn(1000);}
		}
		
		$("#cmbtn").find("option:eq(0)").attr("selected", true);
			$("#cmbclass").find("option:eq(0)").attr("selected", true);
		$("#cmbcategory").find("option:eq(0)").attr("selected", true);
		
		function Register(){
			var FN = $("#regFN").val();
			var LN = $("#regLN").val();
			var Grade = $("#reggrade").val();
			var Office = $("#regoffice").val();
			var Position = $("#regposition").val();
			var Address = $("#regaddress").val();
			var Email = $("#regemail").val();
			var TrackNo = $("#cmbtn").val();
			var Cf = $("#cmbclass").val();
			
			var canvas = $("#imageView")[0];
			var upsig = $("#us").is(":checked") ? true : false;
			var ContactNo = $("#regcontact").val();
			var PrcNo = $("#regprc").val();
			var School = $("#regschool").val();
			var Institution = $("#cmbins").val();
			var CompanyName = $("#CompanyName").val();
			var Designation = $("#regdesignation").val();
			var Educ = $("#regeduc").val();
			var Region = $("#cmbregion").val();
			var Gender = $("#cmbgender").val();
			var Individual = $("#cmbindi").val();
			var password = $("#regpassword").val();
		 
			showWarns(FN, "#warnfn");
			//showWarns(password, "#warnpassword");
			/*showWarns(Office, "#warnoffice");
			showWarns(Position, "#warnposition");*/
		 	showWarns(LN, "#warnln");
			showWarns(Email, "#warnemail");
			// alert(FN + " " + Grade + " " + ContactNo + " " +  School + Email);
			if(FN && LN && Email){
					
				/**/if(!emailReg.test(Email)){
					$("#warnemail").text("Invalid Email").fadeIn(1000);
				}else{
						if(state){
							 $.post(BaseURL + "/save/savedata", {"FN":FN, "LN":LN, "ContactNo":ContactNo, "Email":Email, "Address":Address, "Region":Region
										,"Institution":Institution, "School":School, "Password":password
										, "Gender":Gender, "Signature":canvas.toDataURL(), "Individual":Individual, "PK":state, "upsig":upsig}, function(data){
									alert(data);
									location = BaseURL + "/records";
								});
								  
						}else{
							 $.post(BaseURL + "/save/savedata", {"FN":FN, "LN":LN, "ContactNo":ContactNo, "Email":Email, "Address":Address, "Region":Region
										,"Institution":Institution, "School":School, "Password":password
										, "Gender":Gender, "Signature":canvas.toDataURL(), "Individual":Individual}, function(data){
								alert(data);
							//	$().redirect(BaseURL + "/idprint/profile", {"FN":FN, "LN":LN, "CN":CompanyName});
							});
						 
						}
						
						$("input[type=text]").val("");
						$("input[type=password]").val("");
					 
			 	}
			}
		}
		
		function UpdateRecord(){
			
		}
		
		$("#btnreg").click(function(){
			try{
				Register();
			}catch(e){
				alert(e);
			}
		});
		 
		 
		$("#btnClearSign").click(function(){
			/**/var canvas = $("#imageView")[0];
			canvas.width = canvas.width;
	
		});
		
		function myEdit(){
			$(".edit").click(function(){
			//	var td = $(this).closest("td");
				var PK = null;
				
			/*	var col = $(td).parent().children().index(td);
				var row = $(td).parent().parent().children().index(td.parent());
				
				PK = $("#members tr:nth-child(" + (row + 1) + ") td:nth-child(" + (col + 2) + ")").text(); */
				 PK = this.id;
				 $().redirect(BaseURL + "/registration",{"State":PK, "PK":PK});
			});
			
			$("img.zm").each(function(){
				$("#" + this.id).bind("mouseover", function(){
					$(this).addClass("transition");
				});
				
				$("#" + this.id).bind("mouseout", function(){
					$(this).removeClass("transition");
				});
			});
			
			$(".In").each(function(){
				$("#" + this.id).bind("click", function(){
					var id = this.id.replace("btnIn", "");
					$.post(BaseURL + "/breakout/attend/" + id,function(data){
						alert(data);
						location = BaseURL + "/records";
					});
				});
			});
			
			
			$(".Reset").each(function(){
				$("#" + this.id).bind("click", function(){
					var id = this.id.replace("btnReset", "");
				 
					$.post(BaseURL + "/breakout/Reset/" + id,function(data){
						alert(data);
						location = BaseURL + "/records";
					});
				});
			});
		}
		
		function viewID(){
			$(".vID a").click(function(){
				try{
					 var td = $(this).closest("td");
						var PK = null;
						var col = $(td).parent().children().index(td);
						var row = $(td).parent().parent().children().index(td.parent());
						
						PK = $("#members tr:nth-child(" + (row + 1) + ") td:nth-child(" + (col + 0) + ")").text();
						 $().redirect(BaseURL + "/",{"PK":PK});
				}catch(e){
					alert(e);
				}
			});
		}
		
		$("#rafflestart").click(function(){
			var counter = 5;
			var c = 0;
			var ct = true;
			$("#rcounter").text("5");
			
			
			$("#rnames").empty();
			$("#cname").unblink();
			$("#wintitle").hide();
			$("#wintitle").unblink();
			rand();
			/*var intervals = setInterval(function(){
						if(ct == true){
							$.post(BaseURL + "/randomname/randompick", function(data){
								$("#rnames").html(data);
							});
						}
					},1);*/
			
			
					
		/*	var raffletimer = setInterval(function(){	
					counter--;
					$("#rcounter").text(counter);
					if(counter == 0){
						ct = false;
						 clearInterval(intervals);
						clearInterval(raffletimer);
						$.post(BaseURL + "/randomname/randompick", function(data){
								$("#rnames").html(data);
								$.post(BaseURL + "/updateraffle/updatethis", {"ID":$.trim($("#raffleid").text())}, function(data){}); 
							});
							
						
					}
			},1000);*/
		});
		$("#wintitle").hide();
		
		 function rand(){
			var allowrand = true;
			var n = 5;
			
			(function cd(){
					$("#rcounter").text(n);
				  if(n--){
					setTimeout(cd, 1000);
				  }
				  
				  if(n < 0){
					  allowrand = false;
					clearTimeout(cd);
					 
						if(allowrand == false){
							$.post(BaseURL + "/randomname/randompick", function(data){
								$("#rnames").html(data);
								 
									setTimeout(function(){$.post(BaseURL + "/updateraffle/updatethis", {"ID":$.trim($("#raffleid").text())}, function(data){});}, 2000); 
								
								//$("#cname").css("color", "yellow"); 
							});
							$("#cname").blink({delay:400}); 
						}
						$("#wintitle").blink({delay:400});
					 $("#wintitle").show();
				  }
			})();
			
			(function loop(){
				setTimeout(loop, 1);
					if(allowrand == true){
						$.post(BaseURL + "/randomname/randompick", function(data){
									$("#rnames").html(data);
								});
					}else{ 
						//$("#rnames").hide();
						clearTimeout(loop);
					}
			})();
		 }
		
		
		$("#rafflereset").click(function(){
			$.post(BaseURL + "/updateraffle/resetraffle", function(data){alert(data);});
			$("#rcounter").text("5");
			$("#rnames").empty();
			$("#raffleid").text("");
			$("#wintitle").hide();
		});
		
		
		if(state){
			$("#btnreg").val("Update");
			$("div#sc").show();
		}
		
		$("#btnsearch").click(function(){
			/*var category = $("#cmbcategory").val();
			var search = $("#txtsearch").val();
			$().redirect(BaseURL + "/records",{"category":category, "search":search, "wc":true});*/
			 RefreshRec();
		});
		
		$("#txtsearch").keydown(function(e){
			/*if(e.which == 13){
				$("#btnsearch").trigger("click");
			}*/
		});
		
		$("#txtsearch").keyup(function(e){
			if($(this).val().length > 0){
				$("#loading").show();
				wC = 1;
				Condition = $.trim($(this).val());
				RefreshRec();
			}else{
				wC = 0;
				Condition = null;
				RefreshRec();
			}
		});
		
		RefreshRec();
		function RefreshRec(){
			$.post(BaseURL + "/showrec/showrec", {"wC":wC, "Condition": Condition},function(data){
				$("#loading").hide();
				$("#reccontainer").html(data);
					myEdit();
					viewID();
					candidateFunction();
			});
			
			TotalRecord = $.ajax({type:"POST",
							url:BaseURL + "/totalrecords/gettotal",
							data:"PK=" + $("#txtsearch").val(),
							async:false}).responseText;
			$("#recordcount").text(TotalRecord);
		}
		
		$("#btnverify").click(function(){
			 var emailverify = $("#txtemailverify").val();
			 var message;
			 if(emailverify.length > 0){
				 
					message = 	$.ajax({
									type:"POST",
									url: BaseURL + "/verifyemail/verifythis/" + emailverify + "/" + $("#verifyer").text(),
									async: false
								}).responseText;
					
					 
					if(message == 0){
						 alert("Incorrect password");
					}else{ 
						location = BaseURL + "/startvote"  + "?p=" + message;
					}
				
			 }
		});
		
		$("#txtemailverify").keypress(function(e){
			if(e.which == 13){
				$("#btnverify").trigger("click");
			}
		});
		
		$.post(BaseURL + "/pic/picsettings", function(html){
			var fname = null;
			var file = null;
			var imageid = $("#currkey").text();
			
			$("#piccontainer").html(html);
			
			$(":file").change(function(){
				file = this.files[0];
				var filename = file.name;
				var size = 0;
				var type = file.type;
				var Filter = /\.(gif|jpg|jpeg|tiff|png)$/i;
				fname = filename;
				
				if(parseInt(file.size) > 2000000){
				}else{ 
					if(!Filter.test(filename)){
						$("#BtnUp").attr("disabled", true);
					}else{ 
						$("#BtnUp").attr("disabled", false);
					}
				}
			});
			
			$("#BtnUp").click(function(){
				 var formData = new FormData();
				 formData.append("imagefile", file);
				 formData.append("imageID", imageid);
				 if(fname.length > 0){
					$.ajax({
						url: BaseURL + "/uploadpic/savepic",
						type:"POST",
						xhr: function(){
							var myXhr = $.ajaxSettings.xhr();
							if(myXhr.upload){
								myXhr.upload.addEventListener("progress",progressHandlingFunction, false);
							}
							return myXhr;
						},
						data: formData,
						success: function(e){
							completeHandlers(e)
						},
						cache:false,
						contentType: false,
						processData: false
					});
				 }
			});
		});
		 
		function completeHandlers(e){
			alert(e);
		}
		
		function bytesToSize(bytes) {var sizes = ['Bytes', 'KB', 'MB'];if (bytes == 0) return 'n/a';var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];};
	
		function progressHandlingFunction(e){
			if(e.lengthComputable){
				$('progress').attr({value:e.loaded,max:e.total});
				iBytesUploaded = e.loaded;
				iBytesTotal = e.total;
				var iPercentComplete = Math.round(e.loaded * 100 / e.total);
				var iBytesTransfered = bytesToSize(iBytesUploaded);
				$('#progress_percent').text(iPercentComplete.toString() + '%');
				$('#b_transfered').text(iBytesTransfered);
			}
		}
		
		function candidateFunction(){
			$(".sc").each(function(){
				$("#" + this.id).bind("click", function(){
					 $.post(BaseURL + "/setcandidate/setcandidate", {"currkey":this.id}, function(data){
						alert(data);
					 });
				});
			});
			
			$(".res").each(function(){
				$("#" + this.id).bind("click", function(){
					$.post(BaseURL + "/setcandidate/reset", {"currkey":this.id}, function(data){
						alert(data);
					});
				});
			});
		}
		
		
		
		
		 var atvc = {val1:"Yes", val2:"No"};
	 var mvpc = {val1:1, val2: 2, val3:3, val4:4, val5:5, val6:6, val7:7, val8:8, val9:9, val10:10};
	 
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
		var atvkey;
	/* $("#txtsearchv").keyup(function(){
		
		atvkey = $.ajax({
						type: "POST",
						url: BaseURL + "/allowtovote/granted",
						data: "key=" + $(this).val() + "&srn=" + $("#txtvsurname").val(),
						async: false,
					}).responseText;
			  
		$.post(BaseURL + "/allowtovote/getname", {"key": $(this).val(), "srn":$("#txtvsurname").val()}, function(data){
				$("#txtresult").html(data);
				atvFunctions(atvkey);
		 });
		 
	 }); */
	 
	 $("#txtID").keyup(function(){
		 var ID = $(this).val();
		/**/  atvkey = $.ajax({
						type: "POST",
						url: BaseURL + "/allowtovote/granted",
						data: {ID:ID},
						async: false,
					}).responseText;
		 
			$.post(BaseURL + "/allowtovote/getname", {"key": $(this).val(), "srn":$("#txtvsurname").val(), "ID":ID}, function(data){
					$("#txtresult").html(data);
					atvFunctions(atvkey);
			});
		 
	 });

	 
	 
		function atvFunctions(key){
			$("#btnallow").click(function(){
				 
				$.post(BaseURL + "/allowtovote/allowthis/" + key, function(data){
					alert(data);
					$("#txtsearchv").val("");
				$("#txtresult").empty();
				});
			});
			
			$("#btnvcancel").click(function(){
				$.post(BaseURL + "/allowtovote/cancelthis/" + key, function(data){
					alert(data);
					$("#txtsearchv").val("");
				$("#txtresult").empty();
				});
				
			});
		}
		
		
		
		
		
		
		 	$("#webcam").append(webcam.get_html(320, 240));
			webcam.set_api_url(BaseURL + "/capture/getimage/" + $("#part").text());
			webcam.set_quality(90);
			webcam.set_shutter_sound(false);
			webcam.set_hook("onComplete", "my_completion_handler");
			
			$("#btnConfig").click(function(){
				webcam.configure();
			});	
			
			$("#btnReset").click(function(){
				webcam.reset();
			});
			
			function take_snapshot(){
				webcam.snap();
				$("#btnreg").attr("disabled", false);
			}
			
			$("#btnCap").click(function(){
				take_snapshot();
				alert("Refresh page to see the effect")
			});
			
});

//http://www.antiyes.com/jquery-blink-plugin
 // Source: http://www.antiyes.com/jquery-blink-plugin
// http://www.antiyes.com/jquery-blink/jquery-blink.js
//http://kyokasuigetsu25.wordpress.com/2012/01/25/how-to-create-a-raffle-program/
//http://forum.jquery.com/topic/change-text-color-at-a-timed-interval
(function($) {
	var t;
    $.fn.blink = function(options) {
        var defaults = {
            delay: 500
        };
        var options = $.extend(defaults, options);

        return this.each(function() {
            var obj = $(this);
           t = setInterval(function() {
               /**/ if ($(obj).css("visibility") == "visible") {
                    $(obj).css('visibility', 'hidden');
                }
                else {
                    $(obj).css('visibility', 'visible');
                }
            }, options.delay);
        });
    }
	
	$.fn.unblink = function() 
        {
            clearInterval(t);
			var obj = $(this);
			obj.css("visibility", "visible");
        }
}(jQuery)) 