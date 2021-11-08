function prescoExecutePOST(url, payload, callback) {
	$.ajax({
		type: "POST",
		data: JSON.stringify(payload),
		url: base_url + url,
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
		data: payload,
		url: base_url + url,
		dataType: "json",
		cache: false,
		processData: false,
		contentType: false,
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
		url: base_url + url,
		dataType: "json",
		data: JSON.stringify(payload),
		success: function (data) {

			if (typeof callback == "function") {
				callback(data);
			}
		},
	});
}

function prescoExecuteGET(url, callback) {
	$.ajax({
		type: "GET",
		url: base_url + url,
		success: function (data) {
			
			if (typeof callback == "function") {
				callback(data);
			}
		},
	});
}
