document.querySelector('#approveRequestTable').onclick = (event) => {
	let tableRow = event.target.parentElement;
	let row_id = tableRow.children[0].id.split('-');
	let entity = requestsToApprove[row_id[1]];
	lastClickedRow = tableRow.id;
	changeInnerHTML({
		'#approve-preview-requester': `${entity.Requester.FirstName} ${entity.Requester.LastName}`,
		'#approve-preview-designation': entity.Requester.Position,
		'#approve-preview-date': entity.DateOfTrip,
		'#approve-preview-time': entity.TimeOfTrip,
		'#approve-preview-pick': entity.PickLocation,
		'#approve-preview-drop': entity.DropLocation,
		'#approve-preview-purpose': entity.Purpose,
		'#approve-preview-joComment': entity.JOComment,
	});
	document.getElementById('request-approve-preview-popup').style.display = 'block';
	document.getElementById('approve-requestID').value = entity.RequestId;
	document.getElementById('CAOdeny-requestID').value = entity.RequestId;
};

//************Approved History Table ******************/
document.querySelector('#approvedHistoryTable').onclick = (event) => {
	let tableRow = event.target.parentElement;
	let row_id = tableRow.children[0].id.split('-');
	request_ID = row_id;
	let entity = approvedRequests[row_id[1]];
	changeInnerHTML({
		'#requestID-preview': entity.RequestId,
		'#status-preview': entity.Status,
		'#time-preview': entity.TimeOfTrip,
		'#date-preview': entity.DateOfTrip,
		'#pickup-preview': entity.PickLocation,
		'#drop-preview': entity.DropLocation,
		'#purpose-preview': entity.Purpose,
		'#joComment-preview': entity.JOComment,
		'#caoComment-preview': entity.CAOComment,
		'#driver-preview': `${entity.Driver.firstName} ${entity.Driver.lastName}`,
		'#vehicle-preview': entity.Vehicle.registration,
	});
	if (entity.Vehicle.hasOwnProperty('registration')) {
		changeDisplay(document.querySelectorAll('.scheduled-preview'), 'show');
	} else {
		changeDisplay(document.querySelectorAll('.scheduled-preview'), 'hide');
	}
	changeDisplay([document.querySelector('#request-cancel')], 'hide');
	document.getElementById('request-preview-popup').style.display = 'block';
};

//***********************approve Request ********************/
// Preview
document.querySelector('#request-details-approve-button').addEventListener('click', () => {
	document.getElementById('request-approve-preview-popup').style.display = 'none';
	document.getElementById('approve-request-alert').style.display = 'block';
});

document.querySelector('#request-details-decline-button').addEventListener('click', () => {
	document.getElementById('request-approve-preview-popup').style.display = 'none';
	document.getElementById('cancel-request-alert-approve').style.display = 'block';
});

document.querySelector('#request-approve-preview-close').addEventListener('click', () => {
	document.getElementById('request-approve-preview-popup').style.display = 'none';
});

//Preview End

//Decline Popup
//Decline Button
document.querySelector('#decline-alert-decline-button').addEventListener('click', () => {
	document.getElementById('cancel-request-alert-approve').style.display = 'none';
	writeToDatabase('CAODeny_form', () => {
		deleteRow(lastClickedRow);
	});
});
//Decline Cancel Button
document.querySelector('#decline-alert-cancel-button').addEventListener('click', () => {
	document.getElementById('cancel-request-alert-approve').style.display = 'none';
	document.getElementById('request-approve-preview-popup').style.display = 'block';
});
//Decline PopUp x button
document.querySelector('#confirm-alert-close-decline').addEventListener('click', () => {
	document.getElementById('cancel-request-alert-approve').style.display = 'none';
	document.getElementById('request-approve-preview-popup').style.display = 'block';
});

//approve Popup
//Cancel Button
document.querySelector('#approve-alert-cancel-button').addEventListener('click', () => {
	document.getElementById('approve-request-alert').style.display = 'none';
	document.getElementById('request-approve-preview-popup').style.display = 'block';
});
//approve button
document.querySelector('#approve-alert-approve-button').addEventListener('click', () => {
	document.getElementById('approve-request-alert').style.display = 'none';
	writeToDatabase('CAOApprove_form', () => {
		deleteRow(lastClickedRow);
	});
});
//approve Pop Up x Button
document.querySelector('#confirm-alert-close-approve').addEventListener('click', () => {
	document.getElementById('approve-request-alert').style.display = 'none';
	document.getElementById('request-approve-preview-popup').style.display = 'block';
});

//***********************approve Request End *******/
