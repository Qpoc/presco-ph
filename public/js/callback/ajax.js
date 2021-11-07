function prescoExecutePOST(url, payload, callback) {
	$.ajax({
		type: "POST",
		data: JSON.stringify(payload),
		url: 'http://localhost/presco-ph/' + url,
		dataType: "json",
		success: function (data) {
			if (typeof callback == "function") {
				callback(data);
			}
		},
	});
}

function prescoExecuteFileUpload(url, payload, callback) {
	$.ajax({
		type: "POST",
		data: JSON.stringify(payload),
		url: 'http://localhost/presco-ph/' + url,
		ContentType: "multipart/form-data",
		dataType: "json",
		success: function (data) {
			if (typeof callback == "function") {
				callback(data);
			}
		},
	});
}

function prescoExecuteGET(url, payload, callback) {
	$.ajax({
		type: "GET",
		url: 'http://localhost/presco-ph/' + url,
		dataType: "json",
		data: JSON.stringify(payload),
		success: function (data) {
			console.log(data); // predefined logic if any

			if (typeof callback == "function") {
				callback(data);
			}
		},
	});
}

function prescoExecuteGET(url, callback) {
	$.ajax({
		type: "GET",
		url: 'http://localhost/presco-ph/' + url,
		success: function (data) {
			console.log(data); // predefined logic if any

			if (typeof callback == "function") {
				callback(data);
			}
		},
	});
}
