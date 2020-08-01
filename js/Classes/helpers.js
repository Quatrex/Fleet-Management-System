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

//************************Change Popup InnerHTML/Value Helper Function *********/
const changeValue = (object, id) => {
	let objProps = Object.getOwnPropertyNames(object);
	for (let i = 0; i < objProps.length; i++) {
		document.querySelectorAll(`#${objProps[i]}-${id}`).forEach((tag) => {
			tag.value = object[objProps[i]];
		});
	}
};

const changeInnerHTML = (object, id) => {
	let objProps = Object.getOwnPropertyNames(object);
	for (let i = 0; i < objProps.length; i++) {
		document.querySelectorAll(`#${objProps[i]}-${id}`).forEach((tag) => {
			tag.innerHTML = object[objProps[i]];
		});
	}
};