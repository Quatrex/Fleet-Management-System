<script>
    const requestEntity = <?php echo json_encode($_SESSION['pendingTrips']); ?>;
    const empID = <?php echo json_encode($_SESSION['empid']); ?>;
    console.log(empID);

    function addRecord(formID, addMethod, empID) {
        let data = $(formID).serialize();
        console.log(data);
        data += `&AddMethod=${addMethod}&empID=${empID}`;
        $.ajax({
            url: "../func/save2.php",
            type: "POST",
            data: data,
            cache: false,
            success: function(result) {
                console.log(result);
                $(formID).find("input:text").val("");
                //Display the popup of success access or unsucess
            },
        });
    }

    $(document).ready(function() {
        $('#request-preview-confirm-button').on('click', function() {
            console.log("In preview confirm");

            addRecord('#submit-form', 'RequestAdd', empID);
            $('#submit-form').find('input:text').val('');

        });
        $('#vehicle-add-form-submit').on('click', function() {

            addRecord('#new-vehicle-form', 'AddVehicle', empID);
            $('#new-vehicle-form').find('input:text').val('');

        });
    });
    //*******************Justification Table *******************/
    document.querySelector("#approve-request-table").onclick = (event) => {
        let tableRow = event.target.parentElement;
        console.log(tableRow);

        document.getElementById('request-assign-preview-popup').style.display = 'block';

    };


    //**********************Request Table ***************/
    document.querySelector("#request-table").onclick = (event) => {
        let tableRow = event.target.parentElement;
        let row_id = (tableRow.children[0].id).split("-");
        let entity = requestEntity[row_id[1]]
        changeInnerHTML({
            '#date-preview': entity.dateOfTrip,
            '#time-preview': entity.timeOfTrip,
            '#pickup-preview': entity.pickLocation,
            '#drop-preview': entity.dropLocation
        });
        document.getElementById('request-preview-popup').style.display = 'block';
    };
    

    //**********************Ongoing Table ***************/
    document.querySelector("#ongoing-table").onclick = (event) => {
        let tableRow = event.target.parentElement;
        document.getElementById('ongoing-table-details-popup').style.display = 'block';

    };


    //**********************Vehicle Table ***************/
    document.querySelector("#all-vehicle-table").onclick = (event) => {
        let tableRow = event.target.parentElement;
        document.getElementById('car-profile-form').style.display = 'block';

    };

    ///Vehicle profile close//
    document.querySelector('#car-profile-form-close').addEventListener('click', () => {
        document.getElementById('car-profile-form').style.display = 'none';
    });

    document.querySelector('#confirm-vehicle-profile').addEventListener('click', () => {
        document.getElementById('car-profile-form').style.display = 'none';
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

    //Vehicle add form
    document.querySelector('#add-vehicle-button').addEventListener('click', () => {

        document.getElementById('vehicle-add-form').style.display = 'block';
    });

    document.querySelector('#vehicle-add-form-submit').addEventListener('click', () => {

        document.getElementById('vehicle-add-form').style.display = 'none';
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

    document.querySelector("#vehicle-close").onclick = (event) => {
        document.getElementById('select-vehicle-alert').style.display = 'none';
    }

    document.querySelector("#confirm-vehicle").onclick = (event) => {
        document.getElementById('select-vehicle-alert').style.display = 'none';
        document.getElementById('select-driver-alert').style.display = 'block';

    }
    document.querySelector("#go-back-driver").onclick = (event) => {
        document.getElementById('select-vehicle-alert').style.display = 'block';
        document.getElementById('select-driver-alert').style.display = 'none';

    }

    document.querySelector("#confirm-driver").onclick = (event) => {
        const driver = document.querySelector('#driver-name').innerHTML;
        const vehicle = document.querySelector('#vehicle-name').innerHTML;
        document.querySelector('#final-driver').innerHTML = driver;
        document.querySelector('#final-vehicle').innerHTML = vehicle;
        document.getElementById('select-driver-alert').style.display = 'none';
        document.getElementById('request-final-details-popup').style.display = 'block';

    }
    document.querySelector("#request-final-details-close").onclick = (event) => {
        document.getElementById('request-final-details-popup').style.display = 'none';

    }

    // document.querySelector("#vehicle-close").onclick = (event) => {
    //     document.getElementById('select-vehicle-alert').style.display = 'none';
    // }

    document.querySelector("#vehicle-table").onclick = (event) => {

        let tableRow = event.target.parentElement;
        console.log(tableRow);

        const table = document.querySelector('#vehicle-table');
        toggleBack(table, tableRow, 'vehicle-name');

    };
    document.querySelector("#driver-table").onclick = (event) => {
        let tableRow = event.target.parentElement;
        toggleBack(tableRow.parentElement, tableRow, 'driver-name');

    };

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

    //user-profile
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