//************************ Decorators ****************//

const BackendAccess = (method, actionCreater = {}) => (popup, object = {}, event) => {
	if (event.type == 'click') {
		Database.writeToDatabase(object, method, actionCreater);
	}
	return object;
};

const BackendAccessForPicture = (method, actionCreater = []) => (popup, object = {}, event) => {
	if (event.type == 'click') {
		data = new FormData();
		data.append('profileImage', $('#profile-pic')[0].files[0]);
		data.append('Method', method);
		$.ajax({
			url: '../func/save2.php',
			type: 'POST',
			data: data,
			mimeType: 'mutipart/FormData',
			contentType: false,
			processData: false,
			cache: false,
			success: function (returnArr) {
				console.log(returnArr);
			},
		});
	}
	return object;
};

const RemoveAllPopup = (popup, object = {}, event) => {
	document.querySelectorAll('.popup').forEach((element) => (element.style.display = 'none'));
	popup.getPrev().removeFromDOM();
	return object;
};

const DateValidator = (popup, object = {}, event) => {
	if (event.type == 'keyup') {
		let target = event.target;
		if (target.type == 'date') {
			if (target.value.length > 0) {
				let currentDate = new Date();
				let givenDate = new Date(target.value);
				if (givenDate < currentDate) {
					target.classList.add('warning-details');
					popup.popup.querySelector(`#${target.name}-error`).innerHTML =
						'Given Date is before the current date';
					popup.popup.querySelector(`#${target.name}-error`).classList = '';
					popup.popup.querySelector(`#${target.name}-error`).classList.add('text-warning');
				} else {
					target.classList.remove('warning-details');
					popup.popup.querySelector(`#${target.name}-error`).innerHTML = null;
				}
			}
		}
	}
	return object;
};
const FormValidate = (popup, object = {}, event) => {
	if (event.type == 'click') {
		let fields = popup.popup.querySelectorAll('.inputs');
		let valid = true;
		fields.forEach((field) => {
			if (field.hasAttribute('required')) {
				if (field.value.length == 0) {
					valid = false;
					field.classList.add('invalid-details');
					popup.popup.querySelector(`#${field.name}-error`).innerHTML = 'This field should be provided';
					popup.popup.querySelector(`#${field.name}-error`).classList = '';
					popup.popup.querySelector(`#${field.name}-error`).classList.add('text-danger');
				} else {
					field.classList.remove('invalid-details');
					popup.popup.querySelector(`#${field.name}-error`).innerHTML = null;
				}
			}
			if (field.type == 'text') {
				field.value = field.value.replace(/</g, '&lt;').replace(/>/g, '&gt;');
			}
		});

		return { ...object, valid: valid };
	}
	return object;
};

const ObjectCreate = (popup, object = {}, event) => {
	let obj = {};
	popup.popup.querySelectorAll(`.inputs`).forEach((element) => {
		if (element.type == 'file') {
			obj[element.name] = element.files[0];
		} else {
			obj[element.name] = element.value;
		}
	});
	if (event.type == 'keyup') {
		return { ...object, ...obj };
	} else {
		return { ...object, ...obj };
	}
};
