//*******************Assign Table *******************/
document.querySelector('#approveRequestTable').onclick = (event) => {
	let tableRow = event.target.parentElement;
	lastClickedRow = tableRow.id;

	document.getElementById('request-assign-preview-popup').style.display = 'block';
};

//**********************Ongoing Table ***************/
document.querySelector('#ongoingTable').onclick = (event) => {
	let tableRow = event.target.parentElement;
	lastClickedRow = tableRow.id;

	document.getElementById('ongoing-table-details-popup').style.display = 'block';
};

//**********************Vehicle Table ***************/
document.querySelector('#vehicleTable').onclick = (event) => {
	let tableRow = event.target.parentElement;
	lastClickedRow = tableRow.id;
	console.log(lastClickedRow);

	let row_id = tableRow.children[0].id.split('-');
	let entity = vehicles[row_id[1]];
	lastClickedRow = tableRow.id;
	changeValue({
		'#vehicle-registrationNo': entity.registration,
		'#vehicle-registrationNoCopy': entity.registration,
		'#vehicle-model': entity.model,
		'#vehicle-purchasedYear': entity.purchasedYear,
		'#vehicle-price': entity.value,
		'#vehicle-fuelType': entity.fuelType,
		'#vehicle-currentLocation': entity.currentLocation,
		'#vehicle-insuranceCompany': entity.insuranceCompany,
		'#vehicle-insuranceValue': entity.insuranceValue,
	});
	if ('leasedCompany' in entity) {
		document.querySelectorAll('.leasedVehicleData').forEach((element) => {
			element.classList.remove = 'leasedVehicleData';
		});
		changeValue({
			'#vehicle-leasedCompany': entity.leasedCompany,
			'#vehicle-leasedValue': entity.monthlyPayment,
			'#vehicle-leasedFrom': entity.leasedPeriodFrom,
			'#vehicle-leasedTo': entity.leasedPeriodTo,
		});
	}
	document.getElementById('car-profile-form').style.display = 'block';
};

///Vehicle profile close//
document.querySelector('#car-profile-form-close').addEventListener('click', () => {
	document.getElementById('car-profile-form').style.display = 'none';
});

document.querySelector('#confirm-vehicle-profile').addEventListener('click', () => {
	writeToDatabase('UpdateVehicle_form');
	document.getElementById('car-profile-form').style.display = 'none';
	document.querySelectorAll('.vehicle-profile-input').forEach((field) => {
		field.disabled = true;
	});
});

document.querySelector('#confirm-vehicle-delete').addEventListener('click', () => {
	document.getElementById('car-profile-form').style.display = 'none';
	writeToDatabase('DeleteVehicle_button_VehicleID');
});
document.querySelector('#vehicle-profile-edit-button').addEventListener('click', () => {
	document.querySelectorAll('.vehicle-profile-input').forEach((field) => {
		field.disabled = false;
	});
});

//**********************Ongoing  **********************/
//X-button
document.querySelector('#ongoing-preview-close').addEventListener('click', () => {
	document.getElementById('ongoing-table-details-popup').style.display = 'none';
});

//close button-click
document.querySelector('#ongoing-close-button').addEventListener('click', () => {
	document.getElementById('ongoing-table-details-popup').style.display = 'none';
});
//End button
document.querySelector('#ongoing-end-button').addEventListener('click', () => {
	document.getElementById('cancel-request-alert').style.display = 'block';
});

//***********************Approve Request ********************/
// Preview
document.querySelector('#request-details-approve-button').addEventListener('click', () => {
	document.getElementById('request-assign-preview-popup').style.display = 'none';
	document.getElementById('select-vehicle-alert').style.display = 'block';
});

document.querySelector('#request-details-decline-button').addEventListener('click', () => {
	document.getElementById('request-assign-preview-popup').style.display = 'none';
});

document.querySelector('#request-approve-preview-close').addEventListener('click', () => {
	document.getElementById('request-assign-preview-popup').style.display = 'none';
});

//***********************Add Vehicle ********************/
//Vehicle add form
document.querySelector('#add-vehicle-button').addEventListener('click', () => {
	document.getElementById('vehicle-add-form').style.display = 'block';
});

document.querySelector('#vehicle-add-form-submit').addEventListener('click', () => {
	document.getElementById('vehicle-add-form').style.display = 'none';
	writeToDatabase('AddVehicle_form');
});
// //x button-click
document.querySelector('#vehicle-add-form-close').addEventListener('click', () => {
	document.getElementById('cancel-request-alert').style.display = 'block';
});

//x button-click
document.querySelector('#confirm-alert-close').addEventListener('click', () => {
	document.getElementById('cancel-request-alert').style.display = 'none';
});

//no button-click
document.querySelector('#confirm-alert-no-button').addEventListener('click', () => {
	document.getElementById('cancel-request-alert').style.display = 'none';
});

//yes button-click
document.querySelector('#confirm-alert-yes-button').addEventListener('click', () => {
	document.querySelectorAll('.popup').forEach((popup) => {
		popup.style.display = 'none';
	});
});

document.querySelector('#vehicle-close').onclick = (event) => {
	document.getElementById('select-vehicle-alert').style.display = 'none';
};

document.querySelector('#confirm-vehicle').onclick = (event) => {
	document.getElementById('select-vehicle-alert').style.display = 'none';
	document.getElementById('select-driver-alert').style.display = 'block';
};
document.querySelector('#go-back-driver').onclick = (event) => {
	document.getElementById('select-vehicle-alert').style.display = 'block';
	document.getElementById('select-driver-alert').style.display = 'none';
};

document.querySelector('#confirm-driver').onclick = (event) => {
	const driver = document.querySelector('#driver-name').innerHTML;
	const vehicle = document.querySelector('#vehicle-name').innerHTML;
	document.querySelector('#final-driver').innerHTML = driver;
	document.querySelector('#final-vehicle').innerHTML = vehicle;
	document.getElementById('select-driver-alert').style.display = 'none';
	document.getElementById('request-final-details-popup').style.display = 'block';
};
document.querySelector('#request-final-details-close').onclick = (event) => {
	document.getElementById('request-final-details-popup').style.display = 'none';
};

// document.querySelector("#vehicle-close").onclick = (event) => {
//     document.getElementById('select-vehicle-alert').style.display = 'none';
// }

document.querySelector('#vehicle-table').onclick = (event) => {
	let tableRow = event.target.parentElement;
	console.log(tableRow);

	const table = document.querySelector('#vehicle-table');
	toggleBack(table, tableRow, 'vehicle-name');
};
document.querySelector('#driver-table').onclick = (event) => {
	let tableRow = event.target.parentElement;
	toggleBack(tableRow.parentElement, tableRow, 'driver-name');
};
