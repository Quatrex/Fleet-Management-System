
document.querySelector("#justifyRequestTable").onclick = (event) => {
  let tableRow = event.target.parentElement;
  let row_id = tableRow.children[0].id.split("-");
  let entity = requestsToJustify[row_id[1]];
  lastClickedRow = entity.RequestID;

  changeInnerHTML({
    "#justify-preview-requester": `${entity.Requester.FirstName} ${entity.Requester.LastName}`,
    '#justify-preview-designation':entity.Requester.Position,
    "#justify-preview-date": entity.DateOfTrip,
    "#justify-preview-time": entity.TimeOfTrip,
    "#justify-preview-pick": entity.PickLocation,
    "#justify-preview-drop": entity.DropLocation,
    "#justify-preview-purpose": entity.Purpose,
  });
  document.getElementById("request-justify-preview-popup").style.display =
    "block";
  document.getElementById('justify-requestID').value = entity.RequestId;
  document.getElementById('deny-requestID').value = entity.RequestId;
};

//************Justified History Table ******************/
document.querySelector("#justifiedHistoryTable").onclick = (event) => {
  let tableRow = event.target.parentElement;
  let row_id = tableRow.children[0].id.split("-");
  request_ID = row_id;
  let entity = justifiedRequests[row_id[1]];
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
  if((entity.Vehicle).hasOwnProperty('registration')){
		changeDisplay(document.querySelectorAll('.scheduled-preview'), 'show');
  }
	else{
		changeDisplay(document.querySelectorAll('.scheduled-preview'), 'hide');
    
  }
	changeDisplay([document.querySelector('#request-cancel')], 'hide');
	document.getElementById('request-preview-popup').style.display = 'block';
};


//***********************Justify Request ********************/

// PREVIEW
document
  .querySelector("#request-details-approve-button")
  .addEventListener("click", () => {
    document.getElementById("request-justify-preview-popup").style.display =
      "none";
    document.getElementById("justify-request-alert").style.display = "block";
  });

document
  .querySelector("#request-details-decline-button")
  .addEventListener("click", () => {
    document.getElementById("request-justify-preview-popup").style.display =
      "none";
    document.getElementById("cancel-request-alert-justify").style.display =
      "block";
  });

document
  .querySelector("#request-justify-preview-close")
  .addEventListener("click", () => {
    document.getElementById("request-justify-preview-popup").style.display =
      "none";
  });
//PREVIEW END

//DECLINE POPUP
//Decline Button//
document
  .querySelector("#decline-alert-decline-button")
  .addEventListener("click", () => {
    document.getElementById("cancel-request-alert-justify").style.display =
      "none";
    writeToDatabase('JODeny_form', () => { deleteRow(lastClickedRow) });
  });

//Decline Cancel Button
document
  .querySelector("#decline-alert-cancel-button")
  .addEventListener("click", () => {
    document.getElementById("cancel-request-alert-justify").style.display =
      "none";
    document.getElementById("request-justify-preview-popup").style.display =
      "block";
  });

//Decline PopUp x button
document
  .querySelector("#confirm-alert-close-decline")
  .addEventListener("click", () => {
    document.getElementById("cancel-request-alert-justify").style.display =
      "none";
    document.getElementById("request-justify-preview-popup").style.display =
      "block";
  });

//JUSTIFY POPUP//
//Cancel Button
document
  .querySelector("#justify-alert-cancel-button")
  .addEventListener("click", () => {
    document.getElementById("justify-request-alert").style.display = "none";
    document.getElementById("request-justify-preview-popup").style.display =
      "block";
  });
//Justify button
document
  .querySelector("#justify-alert-justify-button")
  .addEventListener("click", () => {
    document.getElementById("justify-request-alert").style.display = "none";
    writeToDatabase('JOJustify_form', () => { deleteRow(lastClickedRow) });
  });
//Justify Pop Up x Button
document
  .querySelector("#confirm-alert-close-approve")
  .addEventListener("click", () => {
    document.getElementById("justify-request-alert").style.display = "none";
    document.getElementById("request-justify-preview-popup").style.display =
      "block";
  });

//***********************Justify Request End *******/
