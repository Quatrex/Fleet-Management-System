//********************Helper Function to compare two objects **************//
const SimilarityCheck = (first, second) => {
	if (first === second) return true;
	let firstProps = Object.getOwnPropertyNames(first);
	let secondProps = Object.getOwnPropertyNames(second);
	for (var i = 0; i < firstProps.length; i++) {
		let prop = firstProps[i];
		if (secondProps.includes(prop)) {
			if (second[prop] != first[prop]) {
				return false;
			}
		}
	}
	return true;
};

const WindowOpen = () => {
	windowObjectReference = window.open(
		'http://www.domainname.ext/path/ImageFile.png',
		'DescriptiveWindowName',
		'resizable,scrollbars,status'
	);
};
//************************Change Popup InnerHTML/Value Helper Function *********/
const changeValue = (object, id) => {
	let objProps = Object.getOwnPropertyNames(object);
	for (let i = 0; i < objProps.length; i++) {
		document.querySelectorAll(`#${objProps[i]}-${id}`).forEach((tag) => {
			tag.value = object[objProps[i]];
		});
	}
};

const changeInnerHTML = (object, id, objectFields = {}) => {
	let objProps = Object.getOwnPropertyNames(object);
	for (let i = 0; i < objProps.length; i++) {
		document.querySelectorAll(`#${objProps[i]}-${id}`).forEach((tag) => {
			if (typeof object[objProps[i]] !== 'object') {
				tag.innerHTML = object[objProps[i]];
			} else {
				tag.innerHTML = '';
				let fields = objectFields[objProps[i]];
				fields.forEach((field) => {
					tag.innerHTML += object[objProps[i]][field];
				});
			}
		});
	}
};
