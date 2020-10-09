var pathArray = location.href.split("/");
		var myProtocol = pathArray[0];
		var myHost = pathArray[2];
		var myPath = pathArray[3];
		var BaseURL = myProtocol + "//" + myHost + "/" + myPath;