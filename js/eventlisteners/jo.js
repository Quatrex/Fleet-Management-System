
document.querySelector("#justify-request-table").onclick = (event) => {
  let tableRow = event.target.parentElement;
  let row_id = tableRow.children[0].id.split("-");
  let entity = requestsToJustify[row_id[1]];

  changeInnerHTML({
    "#justify-preview-requester": entity.RequestId,
    // '#justify-preview-designation':entity.designation,
    "#justify-preview-date": entity.DateOfTrip,
    "#justify-preview-time": entity.TimeOfTrip,
    "#justify-preview-pick": entity.PickLocation,
    "#justify-preview-drop": entity.DropLocation,
    "#justify-preview-purpose": entity.Purpose,
  });
  document.getElementById("request-justify-preview-popup").style.display =
    "block";
  document.getElementById('justify-request_ID').value = entity.RequestId;
  document.getElementById('deny-request_ID').value = entity.RequestId;
};

//************Denied Table ******************/
document.querySelector("#denied-table").onclick = (event) => {
  let tableRow = event.target.parentElement;
  let row_id = tableRow.children[0].id.split("-");
  request_ID = row_id;
  let entity = requestEntity[row_id[1]];
  changeInnerHTML({
    "#date-preview": entity.date,
    "#time-preview": entity.time,
    "#pickup-preview": entity.pickLocation,
    "#drop-preview": entity.dropLocation,
  });
  document.getElementById("request-details-popup").style.display = "block";
};

//***********************Request Denied Preview**************/
document
  .querySelector("#request-denied-preview-close")
  .addEventListener("click", () => {
    document.getElementById("request-denied-preview-popup").style.display =
      "none";
  });

//***********End of request Denied************/

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
    writeToDatabase('#decline-request', 'DenyJO', empID);
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
    writeToDatabase('#justify-request-comment-form', 'JustifyJO', empID);
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
