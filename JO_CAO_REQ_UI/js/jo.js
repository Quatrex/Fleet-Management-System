//*******************Justification Table *******************/
document.querySelector("#justify-request-table").onclick = (event) => {
    let tableRow = event.target.parentElement;
    document.getElementById('request-justify-preview-popup').style.display = 'block';
};


//************Denied Table ******************/
document.querySelector("#denied-table").onclick = (event) => {
    let tableRow = event.target.parentElement;
    document.getElementById('request-denied-preview-popup').style.display = 'block';
};


//**********************Request Table ***************/
document.querySelector("#request-table").onclick = (event) => {
    let tableRow = event.target.parentElement;
    document.getElementById('request-details-popup').style.display = 'block';
};


//*******************New Request*****************************
//Form
document.querySelector('#request-vehicle-button').addEventListener('click', () => {
    document.getElementById('vehicle-request-form').style.display = 'block';
});
//x button-click
document.querySelector('#vehicle-request-form-close').addEventListener('click', () => {
    document.getElementById('cancel-request-alert').style.display = 'block';
});

//close button-click
document.querySelector('#request-form-close-button').addEventListener('click', () => {
    document.getElementById('cancel-request-alert').style.display = 'block';
});
//submit button
document.querySelector('#request-form-submit-button').addEventListener('click', () => {
    document.getElementById('vehicle-request-form').style.display = 'none';
    document.getElementById('request-preview-popup-new-request').style.display = 'block';
});
//Request Preview
document.querySelector('#request-preview-edit-button-new').addEventListener('click', () => {
    document.getElementById('request-preview-popup-new-request').style.display = 'none';
    document.getElementById('vehicle-request-form').style.display = 'block';
});

//confirm button-click
document.querySelector('#request-preview-confirm-button-new').addEventListener('click', () => {
    document.getElementById('request-preview-popup-new-request').style.display = 'none';
});
document.querySelector('#request-preview-close-new').addEventListener('click', () => {
    document.getElementById('cancel-request-alert').style.display = 'block';
});

//***********************End of New Request********************************/


//******************************Request Details ***************/
document.querySelector('#request-details-close').addEventListener('click', () => {
    document.getElementById('request-details-popup').style.display = 'none';
});

//********************Request Details End *************************/


//**********************User Image*****************************
document.querySelector('.user-img').addEventListener('click', () => {
    document.getElementById('my-profile').style.display = 'block';
});
//close button-click
document.querySelector('#my-profile-close').addEventListener('click', () => {
    document.getElementById('my-profile').style.display = 'none';
});
//***********************My Profile End**************************


//***********************Justify Request ********************/
// Preview
document.querySelector('#request-details-approve-button').addEventListener('click', () => {
    document.getElementById('request-justify-preview-popup').style.display = 'none';
    document.getElementById('justify-request-alert').style.display = 'block';
});

document.querySelector('#request-details-decline-button').addEventListener('click', () => {
    document.getElementById('request-justify-preview-popup').style.display = 'none';
    document.getElementById('cancel-request-alert-justify').style.display = 'block';
});

document.querySelector('#request-justify-preview-close').addEventListener('click', () => {
    document.getElementById('request-justify-preview-popup').style.display = 'none';
});

//Preview End

//Decline Poup
//Decline Button
document.querySelector('#decline-alert-decline-button').addEventListener('click', () => {
    document.getElementById('cancel-request-alert-justify').style.display = 'none';
});
//Decline Cancel Button
document.querySelector('#decline-alert-cancel-button').addEventListener('click', () => {
    document.getElementById('cancel-request-alert-justify').style.display = 'none';
    document.getElementById('request-justify-preview-popup').style.display = 'block';
});
//Decline PopUp x button
document.querySelector('#confirm-alert-close-decline').addEventListener('click', () => {
    document.getElementById('cancel-request-alert-justify').style.display = 'none';
    document.getElementById('request-justify-preview-popup').style.display = 'block';
});
//Justify Popup
//Cancel Button
document.querySelector('#justify-alert-cancel-button').addEventListener('click', () => {
    document.getElementById('justify-request-alert').style.display = 'none';
    document.getElementById('request-justify-preview-popup').style.display = 'block';
});
//Justify button
document.querySelector('#justify-alert-justify-button').addEventListener('click', () => {
    document.getElementById('justify-request-alert').style.display = 'none';

});
//Justify Pop Up x Button
document.querySelector('#confirm-alert-close-approve').addEventListener('click', () => {
    document.getElementById('justify-request-alert').style.display = 'none';
    document.getElementById('request-justify-preview-popup').style.display = 'block';
});

//***********************Justify Request End *******/



//***********************Request Denied Preview**************/
document.querySelector('#request-denied-preview-close').addEventListener('click', () => {
    document.getElementById('request-denied-preview-popup').style.display = 'none';
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