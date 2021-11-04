function prescoExecutePOST(url, payload, callback) {
	$.ajax({
		type: "POST",
		data: JSON.stringify(payload),
		url: "index.php/" + url,
		dataType: 'json',
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
		url: "index.php/" + url,
		dataType: 'json',
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
		url: url,
		success: function (data) {
			console.log(data); // predefined logic if any

			if (typeof callback == "function") {
				callback(data);
			}
		},
	});
}
