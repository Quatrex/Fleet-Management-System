const Database = {
	writeToDatabase: (object, method, actionCreaters = []) => {
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
				if (actionCreaters.length != 0) {
					actionCreaters.forEach((actionCreator) =>
						actionCreator.type == 'ADD'
							? actionCreator.store.dispatch({ type: actionCreator.type, payload: returnArr.object })
							: actionCreator.store.dispatch({ type: actionCreator.type, payload: object })
					);
				}
			},
		});
	},
};
