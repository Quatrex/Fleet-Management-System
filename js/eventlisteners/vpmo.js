//*******************Assign Table *******************/
document.querySelector('#approveRequestTable').onclick = (event) => {
	let tableRow = event.target.parentElement;
	lastClickedRow = tableRow.id;
	let row_id = tableRow.children[0].id.split('-');
	let entity = requestsToAssign[row_id[1]];
	lastClickedRow = tableRow.id;
	document.querySelectorAll('.leasedVehicleData').forEach((element) => {
		if (!element.classList.contains('d-none')) {
			element.classList.add('d-none');
		}
	});
	changeInnerHTML({
		'#vpmo-assign-requester': `${entity.Requester.FirstName} ${entity.Requester.LastName}`,
		'#vpmo-assign-designation': entity.Requester.Position,
		'.vpmo-assign-date': entity.DateOfTrip,
		'.vpmo-assign-time': entity.TimeOfTrip,
		'.vpmo-assign-pickUpLocation': entity.PickLocation,
		'.vpmo-assign-dropOffLocation': entity.DropLocation,
		'#vpmo-assign-purpose': entity.Purpose,
	});
	removeClass(document.querySelector('#selectionDriverTable').querySelectorAll('tbody > tr'), 'selected');
	removeClass(document.querySelector('#selectionVehicleTable').querySelectorAll('tbody > tr'), 'selected');
	changeInnerHTML({ '#driver-name': '', '#vehicle-name': '' });
	changeValue({ '#requestId-input': entity.RequestId });
	document.getElementById('request-assign-preview-popup').style.display = 'block';
	document.querySelector('#confirm-vehicle').disabled = true;
	document.querySelector('#confirm-driver').disabled = true;
	document.querySelector('#select-driver-tooltip').title = 'Select a driver to enable';
	document.querySelector('#select-vehicle-tooltip').title = 'Select a vehicle to enable';

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
	let row_id = tableRow.children[0].id.split('-');
	let entity = vehicles[row_id[1]];
	lastClickedRow = tableRow.id;
	document.querySelectorAll('.leasedVehicleData').forEach((element) => {
		if (!element.classList.contains('d-none')) {
			element.classList.add('d-none');
		}
	});
	changeValue({
		'.vehicle-registrationNo': entity.registration,
		'.vehicle-registrationNoCopy': entity.registration,
		'.vehicle-model': entity.model,
		'.vehicle-purchasedYear': entity.purchasedYear,
		'.vehicle-price': entity.value,
		'.vehicle-fuelType': entity.fuelType,
		'.vehicle-currentLocation': entity.currentLocation,
		'.vehicle-insuranceCompany': entity.insuranceCompany,
		'.vehicle-insuranceValue': entity.insuranceValue,
	});
	if ('leasedCompany' in entity) {
		removeClass(document.querySelectorAll('.leasedVehicleData'), 'd-none');
		changeValue({
			'.vehicle-leasedCompany': entity.leasedCompany,
			'.vehicle-leasedValue': entity.monthlyPayment,
			'.vehicle-leasedFrom': entity.leasedPeriodFrom,
			'.vehicle-leasedTo': entity.leasedPeriodTo,
		});
	}
	document.getElementById('vehicle-profile-form').style.display = 'block';
};

//Vehicle Profile
///Vehicle profile close//
document.querySelector('#vehicle-profile-form-close').addEventListener('click', () => {
	document.getElementById('vehicle-profile-form').style.display = 'none';
});

document.querySelector('#vehicle-profile-edit-form-close').addEventListener('click', () => {
	changeInnerHTML({
		'#cancel-alert-header': 'Cancel Update',
		'#cancel-alert-message': 'Are you sure you want cancel updates?',
	});
	document.getElementById('cancel-request-alert').style.display = 'block';
});

document.querySelector('#confirm-vehicle-profile').addEventListener('click', () => {
	if (compareValues('UpdateVehicle_form', 'VehicleProfile_form')) {
		writeToDatabase('UpdateVehicle_form');
	}
	// else{}
	document.getElementById('vehicle-profile-edit-form').style.display = 'none';
});

document.querySelector('#vehicle-delete').addEventListener('click', () => {
	document.getElementById('delete-vehicle-alert').style.display = 'block';
});

document.querySelectorAll('.vehicle-edit').forEach((element) =>
	element.addEventListener('keyup', () => {
		if (compareValues('UpdateVehicle_form', 'VehicleProfile_form')) {
			document.querySelector('#edit-confirm-tooltip').title = '';
			document.getElementById('confirm-vehicle-profile').disabled = false;
		} else {
			document.querySelector('#edit-confirm-tooltip').title = 'Make changes to enable';
			document.getElementById('confirm-vehicle-profile').disabled = true;
		}
	})
);

document.querySelector('#confirm-vehicle-delete-button').addEventListener('click', () => {
	document.getElementById('delete-vehicle-alert').style.display = 'none';
	document.getElementById('vehicle-profile-form').style.display = 'none';
	if (document.querySelector('.leasedVehicleData').classList.contains('d-none')) {
		writeToDatabase('DeletePurchasedVehicle_button_VehicleID');
	} else {
		writeToDatabase('DeleteLeasedVehicle_button_VehicleID');
	}
});

document.querySelector('#vehicle-delete-cancel-button').addEventListener('click', () => {
	document.getElementById('delete-vehicle-alert').style.display = 'none';
	document.getElementById('vehicle-profile-form').style.display = 'block';
});

document.querySelector('#vehicle-profile-edit-button').addEventListener('click', () => {
	document.getElementById('vehicle-profile-form').style.display = 'none';
	document.getElementById('confirm-vehicle-profile').disabled = true;
	document.querySelector('#edit-confirm-tooltip').title = 'Make changes to enable';
	document.getElementById('vehicle-profile-edit-form').style.display = 'block';
});
document.querySelector('#vehicle-profile-edit-cancel-button').addEventListener('click', () => {
	document.getElementById('vehicle-profile-edit-form').style.display = 'none';
	document.getElementById('vehicle-profile-form').style.display = 'block';
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
	changeInnerHTML({
		'#cancel-alert-header': 'Cancel Adding',
		'#cancel-alert-message': 'Are you sure you to cancel?',
	});
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
	document
		.querySelector('#selectionDriverTable')
		.querySelectorAll('tbody > tr')
		.forEach((element) => {
			if (element.classList.contains('selected')) {
				document.querySelector('#confirm-driver').disabled = false;
				document.querySelector('#select-driver-tooltip').title = '';
			}
		});
	document.getElementById('select-driver-alert').style.display = 'block';
};
document.querySelector('#go-back-driver').onclick = (event) => {
	document.getElementById('select-vehicle-alert').style.display = 'block';
	document.getElementById('select-driver-alert').style.display = 'none';
};

document.querySelector('#confirm-driver').onclick = (event) => {
	const driver = document.querySelector('#driver-name').innerHTML;
	const vehicle = document.querySelector('#vehicle-name').innerHTML;
	document.querySelector('#final-driver-p').innerHTML = driver;
	document.querySelector('#final-vehicle-p').innerHTML = vehicle;
	document.getElementById('select-driver-alert').style.display = 'none';
	document.getElementById('request-final-details-popup').style.display = 'block';
	writeToDatabase('Schedule_form');
};
document.querySelector('#request-final-details-close').onclick = (event) => {
	document.getElementById('request-final-details-popup').style.display = 'none';
};

document.querySelector('#vehicle-close').onclick = (event) => {
	document.getElementById('select-vehicle-alert').style.display = 'none';
};

document.querySelector('#selectionVehicleTable').onclick = (event) => {
	let tableRow = event.target.parentElement;
	changeValue({ '#final-vehicle-input': tableRow.children[0].innerHTML.trim() });
	toggleBack(tableRow.parentElement, tableRow, 'vehicle-name');
	if (document.querySelector('#vehicle-name').innerHTML!=='') {
		document.querySelector('#confirm-vehicle').disabled = false;
		document.querySelector('#select-vehicle-tooltip').title = '';
	}else{
		document.querySelector('#confirm-vehicle').disabled = true;
		document.querySelector('#select-vehicle-tooltip').title = 'Select a vehicle to enable';
	}
};
document.querySelector('#selectionDriverTable').onclick = (event) => {
	let tableRow = event.target.parentElement;
	changeValue({ '#final-driver-input': tableRow.children[0].innerHTML.trim() });
	toggleBack(tableRow.parentElement, tableRow, 'driver-name');
	if (document.querySelector('#driver-name').innerHTML!=='') {
		document.querySelector('#confirm-driver').disabled = false;
		document.querySelector('#select-driver-tooltip').title = '';
	}else{
		document.querySelector('#confirm-driver').disabled = true;
		document.querySelector('#select-driver-tooltip').title = 'Select a driver to enable';
	}
};
