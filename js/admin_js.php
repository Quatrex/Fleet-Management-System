<script>
    //**********************Request Table ***************/
    document.querySelector("#request-table").onclick = (event) => {
        let tableRow = event.target.parentElement;
        document.getElementById('request-details-popup').style.display = 'block';
    };

    document.querySelector("#all-driver-table").onclick = (event) => {
        let tableRow = event.target.parentElement;
        console.log("here");

        document.getElementById('driver-profile-form').style.display = 'block';
    };
    document.querySelector("#employee-table").onclick = (event) => {
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
    document.querySelector("#ongoing-table").onclick = (event) => {
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


    function toggleBack(table, tableRow, type) {
        const rows = table.querySelectorAll('tr');
        console.log(tableRow);
        const name = tableRow.querySelector('td').innerHTML;
        console.log(name);
        const vehicleName = document.querySelector(`#${type}`);
        rows.forEach(element => {
            if (element === tableRow) {
                element.classList.toggle('selected');
                if (element.classList.contains('selected')) {
                    vehicleName.innerHTML = name;
                } else {
                    vehicleName.innerHTML = "";
                }
            } else {
                if (element.classList.contains('selected')) {
                    element.classList.remove('selected');
                }
            }
        });
    }
    //Vehicle request procedure
    document.querySelector('#request-vehicle-button').addEventListener('click', () => {
        document.getElementById('vehicle-request-form').style.display = 'block';
    });

    document.querySelector('#request-form-close-button').addEventListener('click', () => {
        document.getElementById('cancel-request-alert').style.display = 'block';
    });


    document.querySelector('#request-form-submit-button').addEventListener('click', () => {
        document.getElementById('vehicle-request-form').style.display = 'none';
        let details = getValuesFromForm('#submit-form', ['date', 'time', 'pickup', 'dropoff'])
        changeInnerHTML({
            '#new-date': details.date,
            '#new-time': details.time,
            '#new-pickup': details.pickup,
            '#new-dropoff': details.dropoff
        });
        document.getElementById('new-request-preview-popup').style.display = 'block';
    });


    document.querySelector('#request-preview-close').addEventListener('click', () => {
        document.getElementById('cancel-request-alert').style.display = 'none';
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


    //common functions copied
    function changeInnerHTML(arg) {
        for (let key in arg) {
            document.querySelectorAll(key).forEach((tag) => {
                tag.innerHTML = arg[key];
            })
        }

    }

    function getValuesFromForm(name, values) {
        let arr = {}
        let form = document.querySelector(name);
        values.forEach((key) => {
            arr[key] = form.elements[key].value
        })
        return arr;
    }
</script>