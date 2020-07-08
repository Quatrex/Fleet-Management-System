
    //**********************Request Table ***************/
    document.querySelector("#requestTable").onclick = (event) => {
        let tableRow = event.target.parentElement;
        document.getElementById('request-details-popup').style.display = 'block';
    };

    document.querySelector("#allDriverTable").onclick = (event) => {
        let tableRow = event.target.parentElement;
        console.log("here");

        document.getElementById('driver-profile-form').style.display = 'block';
    };
    document.querySelector("#employeeTable").onclick = (event) => {
        let tableRow = event.target.parentElement;
        document.getElementById('employee-profile-form').style.display = 'block';
    };

    //Driver update profile
    document.querySelector("#driver-profile-form-close").onclick = () => {
        document.getElementById('driver-profile-form').style.display = 'none';
    };
    
    document.querySelector("#driver-profile-confirm").onclick = () => {
        document.getElementById('driver-profile-form').style.display = 'none';
    };

    //Employee profile update
    document.querySelector("#employee-profile-form-close").onclick = () => {
        document.getElementById('employee-profile-form').style.display = 'none';
    };
    
    document.querySelector("#employee-profile-confirm").onclick = () => {
        document.getElementById('employee-profile-form').style.display = 'none';
    };



    //**********************Ongoing Table ***************/
    document.querySelector("#ongoingTable").onclick = (event) => {
        let tableRow = event.target.parentElement;
        document.getElementById('ongoing-details-popup').style.display = 'block';

    };

    //**********************Ongoing  **********************/
    //X-button
    document.querySelector('#ongoing-preview-close').addEventListener('click', () => {
        document.getElementById('ongoing-details-popup').style.display = 'none';
    });

    //close button-click
    document.querySelector('#ongoing-close-button').addEventListener('click', () => {
        document.getElementById('ongoing-details-popup').style.display = 'none';
    });
    //End button
    document.querySelector('#ongoing-end-button').addEventListener('click', () => {
        document.getElementById('cancel-request-alert').style.display = 'block';

    });




    //*********************Add Driver *******************************/
    //Form
    document.querySelector('#add-driver-button').addEventListener('click', () => {

        document.getElementById('driver-add-form').style.display = 'block';
    });

    //Add employee form
    document.querySelector('#add-employee-button').addEventListener('click', () => {

        document.getElementById('employee-add-form').style.display = 'block';
    });


    document.querySelector('#employee-add-form-close').addEventListener('click', () => {

        document.getElementById('employee-add-form').style.display = 'none';
    });

    document.querySelector('#employee-add-form-confirm').addEventListener('click', () => {

        document.getElementById('employee-add-form').style.display = 'none';
    });

    //Driver adding procedure
    document.querySelector('#add-driver-button').addEventListener('click', () => {

        document.getElementById('driver-add-form').style.display = 'block';
    });

    document.querySelector('#driver-add-form-close').addEventListener('click', () => {

        document.getElementById('driver-add-form').style.display = 'none';
    });

    document.querySelector('#driver-add-form-confirm').addEventListener('click', () => {

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

    //profile
    document.querySelector('#view-profile').addEventListener('click', () => {
        document.getElementById('user-profile').style.display = 'block';
    });
    
    document.querySelector('#user-profile-form-close').addEventListener('click', () => {
        document.getElementById('user-profile').style.display = 'none';
    });
    document.querySelector('#user-profile-form-close').addEventListener('click', () => {
        document.getElementById('user-profile').style.display = 'none';
    });


    