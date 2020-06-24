<script>
    //*******************Justification Table *******************/
    const requestsToapprove = <?php echo json_encode($_SESSION['requestsToApprove']) ?>;
    document.querySelector("#approve-request-table").onclick = (event) => {
        let tableRow = event.target.parentElement;
        let row_id = (tableRow.children[0].id).split("-");
        let entity = requestsToapprove[row_id[1]]
        changeInnerHTML({
            '#approve-preview-requester': entity.requesterID,
            // '#approve-preview-designation':entity.designation,
            '#approve-preview-date':entity.dateOfTrip,
            '#approve-preview-time': entity.timeOfTrip,
            '#approve-preview-pick': entity.pickLocation,
            '#approve-preview-drop': entity.dropLocation,
            '#approve-preview-purpose':entity.purpose
        });
        document.getElementById('request-approve-preview-popup').style.display = 'block';

    };

    //************Denied Table ******************/
    document.querySelector("#denied-table").onclick = (event) => {
        let tableRow = event.target.parentElement;
        let row_id = (tableRow.children[0].id).split("-");
        let entity = requestEntity[row_id[1]]
        changeInnerHTML({
            '#date-preview': entity.date,
            '#time-preview': entity.time,
            '#pickup-preview': entity.pickLocation,
            '#drop-preview': entity.dropLocation
        });
        document.getElementById('request-details-popup').style.display = 'block';
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

    });
    //approve Pop Up x Button
    document.querySelector('#confirm-alert-close-approve').addEventListener('click', () => {
        document.getElementById('approve-request-alert').style.display = 'none';
        document.getElementById('request-approve-preview-popup').style.display = 'block';
    });

    //***********************approve Request End *******/



    //***********************Request Denied Preview**************/
    document.querySelector('#request-denied-preview-close').addEventListener('click', () => {
        document.getElementById('request-denied-preview-popup').style.display = 'none';
    });
</script>