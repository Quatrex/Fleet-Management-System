const Database = {
	writeToDatabase: (object, method, actionCreater = {}) => {
		console.log('Data:');
		console.log({ ...object, Method: method });
		$.ajax({
			url: '../func/save2.php',
			type: 'POST',
			data: { ...object, Method: method },
			cache: false,
			beforeSend: function () {
				$('#overlay').fadeIn(300);
			},
			success: function (returnArr) {
				console.log(returnArr);
				$('#overlay').fadeOut(300);
				$(`#${method}_form`).trigger('reset');
				if (Object.keys(actionCreater).length != 0) {
					actionCreater.updateStores(object, returnArr.object);
				}
			},
			error: function () {
				$('#overlay').fadeOut(300);
			},
			timeout: 5000,
		});
	},
	loadContent(method, offset, actionCreater = {}, searchObject = {}) {
		var holder = { ...{ offset: offset, Method: method }, ...searchObject };
		console.log(holder);
		$.ajax({
			url: '../func/fetch.php',
			type: 'POST',
			data: holder,
			dataType: 'json',
			beforeSend: function () {
				$('#overlay').fadeIn(300);
			},
			success: function (returnArr) {
				console.log(returnArr);
				$('#overlay').fadeOut(300);
				if (Object.keys(actionCreater).length != 0) {
					actionCreater.updateStores({}, returnArr.object);
				}
			},
			error: function () {
				$('#overlay').fadeOut(300);
			},
			timeout: 10000,
		});
	},
};