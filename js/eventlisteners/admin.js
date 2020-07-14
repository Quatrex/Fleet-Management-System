document.querySelector('#employeeTable').onclick = (event) => {
	let tableRow = event.target.parentElement;
	let row_id = tableRow.children[0].id.split('-');
	let entity = employees[row_id[1]];
	lastClickedRow = tableRow.id;
	changeValue({
		'.employee-employeeIDCopy': entity.empID,
		'.employee-position': entity.Position,
		'.employee-employeeID': entity.empID,
		'.employee-firstName': entity.FirstName,
		'.employee-lastName': entity.LastName,
		'.employee-designation': entity.Designation,
		'.employee-contactNo': entity.ContactNo,
		'.employee-email': entity.Email,
	});
	document.getElementById('employee-profile-form').style.display = 'block';
};

//Employee Profile
///Employee profile close//
document.querySelector('#employee-profile-form-close').addEventListener('click', () => {
	document.getElementById('employee-profile-form').style.display = 'none';
});

document.querySelector('#employee-profile-edit-button').addEventListener('click', () => {
	document.getElementById('employee-profile-form').style.display = 'none';
	document.getElementById('confirm-employee-profile').disabled = true;
	document.querySelector('#edit-confirm-tooltip').title = 'Make changes to enable';
	document.getElementById('employee-profile-edit-form').style.display = 'block';
});

document.querySelector('#employee-delete').addEventListener('click', () => {
	document.getElementById('delete-employee-alert').style.display = 'block';
});

document.querySelector('#confirm-employee-delete-button').addEventListener('click', () => {
	document.getElementById('delete-employee-alert').style.display = 'none';
	document.getElementById('employee-profile-form').style.display = 'none';
	writeToDatabase('DeleteEmployee_button_employeeID', () => {
		deleteRow(lastClickedRow);
	});
});

document.querySelector('#employee-delete-cancel-button').addEventListener('click', () => {
	document.getElementById('delete-employee-alert').style.display = 'none';
	document.getElementById('employee-profile-form').style.display = 'block';
});

//Employee Edit form
document.querySelector('#employee-profile-edit-form-close').addEventListener('click', () => {
	changeInnerHTML({
		'#cancel-alert-header': 'Cancel Update',
		'#cancel-alert-message': 'Are you sure you want cancel updates?',
	});
	document.getElementById('cancel-request-alert').style.display = 'block';
});

document.querySelector('#employee-profile-edit-cancel-button').addEventListener('click', () => {
	document.getElementById('employee-profile-edit-form').style.display = 'none';
	document.getElementById('employee-profile-form').style.display = 'block';
});

document.querySelector('#confirm-employee-profile').addEventListener('click', () => {
	if (compareValues('UpdateEmployee_form', 'EmployeeProfile_form')) {
		writeToDatabase('UpdateEmployee_form');
	}
	document.getElementById('employee-profile-edit-form').style.display = 'none';
});

document.querySelectorAll('.employee-edit').forEach((element) => 
	element.addEventListener('keyup', () => {
		if (compareValues('UpdateEmployee_form', 'EmployeeProfile_form')) {
			document.querySelector('#edit-confirm-tooltip').title = '';
			document.getElementById('confirm-employee-profile').disabled = false;
		} else {
			document.querySelector('#edit-confirm-tooltip').title = 'Make changes to enable';
			document.getElementById('confirm-employee-profile').disabled = true;
		}
	})
);

//Add employee form
document.querySelector('#add-employee-button').addEventListener('click', () => {
	document.getElementById('employee-add-form').style.display = 'block';
});

document.querySelector('#employee-add-form-close').addEventListener('click', () => {
	document.getElementById('employee-add-form').style.display = 'none';
});

document.querySelector('#employee-add-form-confirm').addEventListener('click', () => {
	document.getElementById('employee-add-form').style.display = 'none';
	writeToDatabase('AddEmployee_form');
});

//form autofill
document.querySelector('#position-select').addEventListener('change', () => {
	if ($('#position-select').val() !== 'Requester') {
		$('#employee-designation').val($('#position-select').val());
	}
});

//**********************Request Table ***************/
document.querySelector('#requestTable').onclick = (event) => {
	let tableRow = event.target.parentElement;
	document.getElementById('request-details-popup').style.display = 'block';
};

document.querySelector('#driverTable').onclick = (event) => {
	let tableRow = event.target.parentElement;
	let row_id = tableRow.children[0].id.split('-');
	let entity = drivers[row_id[1]];
	lastClickedRow = tableRow.id;
	changeValue({
		'.driver-driverIDCopy': entity.driverId,
		'.driver-driverID': entity.driverId,
		'.driver-employedDate': entity.employedDate,
		'.driver-firstName': entity.firstName,
		'.driver-lastName': entity.lastName,
		'.driver-address': entity.address,
		'.driver-assignedVehicleID': entity.assignedVehicleID,
		'.driver-contactNo': entity.ContactNo,
		'.driver-licenseID': entity.licenseID,
		'.driver-licenseType': entity.licenseType,
		'.driver-licenseExpDate': entity.licenseExpDate,
		'.driver-email': entity.Email,
	});
	document.getElementById('driver-profile-form').style.display = 'block';
};
// //Driver update profile
// document.querySelector('#driver-profile-form-close').onclick = () => {
// 	document.getElementById('driver-profile-form').style.display = 'none';
// };

// document.querySelector('#driver-profile-confirm').onclick = () => {
// 	document.getElementById('driver-profile-form').style.display = 'none';
// };
//Driver Profile
///Driver profile close//
document.querySelector('#driver-profile-form-close').addEventListener('click', () => {
	document.getElementById('driver-profile-form').style.display = 'none';
});

document.querySelector('#driver-profile-edit-button').addEventListener('click', () => {
	document.getElementById('driver-profile-form').style.display = 'none';
	document.getElementById('confirm-driver-profile').disabled = true;
	document.querySelector('#edit-confirm-tooltip').title = 'Make changes to enable';
	document.getElementById('driver-profile-edit-form').style.display = 'block';
});

document.querySelector('#driver-delete').addEventListener('click', () => {
	document.getElementById('delete-driver-alert').style.display = 'block';
});

document.querySelector('#confirm-driver-delete-button').addEventListener('click', () => {
	document.getElementById('delete-driver-alert').style.display = 'none';
	document.getElementById('driver-profile-form').style.display = 'none';
	writeToDatabase('DeleteDriver_button_employeeID', () => {
		deleteRow(lastClickedRow);
	});
});

document.querySelector('#driver-delete-cancel-button').addEventListener('click', () => {
	document.getElementById('delete-driver-alert').style.display = 'none';
	document.getElementById('driver-profile-form').style.display = 'block';
});

//Driver Edit form
document.querySelector('#driver-profile-edit-form-close').addEventListener('click', () => {
	changeInnerHTML({
		'#cancel-alert-header': 'Cancel Update',
		'#cancel-alert-message': 'Are you sure you want cancel updates?',
	});
	document.getElementById('cancel-request-alert').style.display = 'block';
});

document.querySelector('#driver-profile-edit-cancel-button').addEventListener('click', () => {
	document.getElementById('driver-profile-edit-form').style.display = 'none';
	document.getElementById('driver-profile-form').style.display = 'block';
});

document.querySelector('#confirm-driver-profile').addEventListener('click', () => {
	if (compareValues('UpdateDriver_form', 'DriverProfile_form')) {
		writeToDatabase('UpdateDriver_form');
	}
	document.getElementById('driver-profile-edit-form').style.display = 'none';
});

document.querySelectorAll('.driver-edit').forEach((element) => 
	element.addEventListener('keyup', () => {
		if (compareValues('UpdateDriver_form', 'DriverProfile_form')) {
			document.querySelector('#edit-confirm-tooltip').title = '';
			document.getElementById('confirm-driver-profile').disabled = false;
		} else {
			document.querySelector('#edit-confirm-tooltip').title = 'Make changes to enable';
			document.getElementById('confirm-driver-profile').disabled = true;
		}
	})
);

// //*********************Add Driver *******************************/
// //Form
document.querySelector('#add-driver-button').addEventListener('click', () => {
	document.getElementById('driver-add-form').style.display = 'block';
});

// //Driver adding procedure
document.querySelector('#driver-add-form-close').addEventListener('click', () => {
	document.getElementById('driver-add-form').style.display = 'none';
});

document.querySelector('#driver-add-form-confirm').addEventListener('click', () => {
    writeToDatabase("AddDriver_form");
    document.getElementById('driver-add-form').style.display = 'none';
});

//##############          Confirm alert         ###################

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
