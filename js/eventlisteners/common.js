//*************Request Table on click */
document.querySelector("#request-table").onclick = (event) => {
    let tableRow = event.target.parentElement;
    let row_id = (tableRow.children[0].id).split("-");
    let entity = requestsByMe[row_id[1]]
    lastClickedRow = tableRow.id;
    console.log(lastClickedRow);
     
    changeInnerHTML({
        '#requestID-preview': entity.RequestId,
        '#reques-status-preview': entity.State,
        '#time-preview': entity.TimeOfTrip,
        '#pickup-preview': entity.PickLocation,
        '#drop-preview': entity.DropLocation,
        '#purpose-preview': entity.Purpose
    });
    if(entity.State==="Scheduled"){
        document.querySelector('#request-cancel').disabled= true;
    }
    document.getElementById('request-preview-popup').style.display = 'block';
}

document.querySelector('#request-cancel').addEventListener('click', () => {
    document.getElementById('request-preview-popup').style.display = 'none';
    writeToDatabase("CancelRequest_button_requestID",()=>{deleteRow(lastClickedRow)});

});
document.querySelector('#change-password-button').addEventListener('click', () => {
    document.getElementById('change-password').style.display = 'block';
});
document.querySelector('#check-my-password-button').addEventListener('click', () => {
    checkMyPassword(document.getElementById("current-password-input").value.trim());
});

//New Request Button click
document.querySelector('#request-vehicle-button').addEventListener('click', () => {
    document.getElementById('vehicle-request-form').style.display = 'block';
});
//Change password
document.querySelector('#change-password-close').addEventListener('click', () => {
    //TODO: are you sure popup not the one below,html needed for popup
    document.getElementById('change-password').style.display = 'none';
});
document.querySelector('#change-password-cancel-button').addEventListener('click', () => {
    //TODO: are you sure popup for confirm cancelation,html needed for popup
    document.getElementById('change-password').style.display = 'none';
});

document.querySelector('#vehicle-request-form-close').addEventListener('click', () => {
    document.getElementById('cancel-request-alert').style.display = 'block';
});
document.querySelector('#request-form-close-button').addEventListener('click', () => {
    document.getElementById('cancel-request-alert').style.display = 'block';
});


document.querySelector('#request-form-submit-button').addEventListener('click', () => {
    document.getElementById('vehicle-request-form').style.display = 'none';
    let details = getValuesFromForm('#RequestAdd_form', ['date', 'time', 'pickup', 'dropoff', 'purpose'])
    changeInnerHTML({
        '#new-date': details.date,
        '#new-time': details.time,
        '#new-pickup': details.pickup,
        '#new-dropoff': details.dropoff,
        '#new-purpose': details.purpose
    });
    document.getElementById('new-request-preview-popup').style.display = 'block';
});


document.querySelector('#new-request-preview-close').addEventListener('click', () => {
    document.getElementById('cancel-request-alert').style.display = 'block';
});

document.querySelector('#request-preview-close').addEventListener('click', () => {
    document.getElementById('request-preview-popup').style.display = 'none';
});

document.querySelector('#request-preview-edit-button').addEventListener('click', () => {
    document.getElementById('new-request-preview-popup').style.display = 'none';
    document.getElementById('vehicle-request-form').style.display = 'block';
});

document.querySelector('#request-preview-confirm-button').addEventListener('click', () => {
    document.getElementById('new-request-preview-popup').style.display = 'none';
    document.getElementById('request-details-popup').style.display = 'block';
});


document.querySelector('#request-details-close').addEventListener('click', () => {
    document.getElementById('request-details-popup').style.display = 'none';
});
document.querySelector('#request-details-exit-button').addEventListener('click', () => {
    document.getElementById('request-details-popup').style.display = 'none';
});


document.querySelector('#confirm-alert-close').addEventListener('click', () => {
    document.getElementById('cancel-request-alert').style.display = 'none';
});
document.querySelector('#confirm-alert-no-button').addEventListener('click', () => {
    document.getElementById('cancel-request-alert').style.display = 'none';
});
document.querySelector('#confirm-alert-yes-button').addEventListener('click', () => {
    document.querySelectorAll('.popup').forEach((popup) => {
        popup.style.display = 'none';
    });
});