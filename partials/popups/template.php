<template id="cardTemplate">
    <div class="card request-card detail-description" style="z-index:2;">
        <div class="description">
            <h1 class="card-title Purpose">For: </h1>
            <div class="row" style="padding-left:1rem;">
                <h2 class="card-title Status" style="color:rgba(95,99,104,0.9);">Status: </h2>
            </div>
            <hr>
            <div class="row justify-content-between">
                <div class="col-sm-3">
                    <p class='DateOfTrip'>On: </p>
                </div>
                <div class="col-sm-3">
                    <p class='TimeOfTrip'>At: </p>
                </div>
                <div class="col-sm-3">
                    <p class='PickLocation'>From: </p>
                </div>
                <div class="col-sm-3">
                    <p class='DropLocation'>To: </p>
                </div>
                <div class="col">
                    <p class="more"></p>
                </div>
            </div>
        </div>
    </div>
</template>

<template id="awaitingRequestCardTemplate">
    <div class="card request-card detail-description" style="z-index:2;">
        <div class="description">
            <h1 class="card-title Purpose">For: </h1>
            <h2 class="card-title RequesterName">By: </h2>
            <h2 class="card-title hidden-details Designation">Designation: </h2>
            <hr>
            <div class="row justify-content-between">
                <div class="col-sm-3">
                    <p class='DateOfTrip'>On: </p>
                    </p>
                </div>
                <div class="col-sm-3">
                    <p class='TimeOfTrip'>At: </p>
                </div>
                <div class="col-sm-3">
                    <p class='PickLocation'>From: </p>
                </div>
                <div class="col-sm-3">
                    <p class='DropLocation'>To: </p>
                </div>
                <div class="col">
                    <p class="more"></p>
                </div>
            </div>
        </div>
    </div>
</template>

<template id="vehicleCardTemplate">
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 detail-description" style="cursor: pointer;">
        <div class="card text-center" style="width: 15rem;">
            <img class="VehiclePicturePath card-img-top vehicle-image mt-2" src="" alt="Vehicle Image">
            <div class="card-body">
                <h5 class="card-title Model"></h5>
                <h6 class="card-subtitle mb-2 text-muted RegistrationNo"></h6>
                <p class="card-text PurchasedYear"></p>
                <p class="card-text">Nothing</p>
            </div>
        </div>
    </div>
</template>


<template id="employeeCardTemplate">
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 detail-description">
        <div class="  card text-center"  style="width: 15rem;"><img class="card-img-top rounded-circle user-image mt-2 ProfilePicturePath" src="../images/employee.png" alt="Driver Image">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <p class="card-text"></p>
                <p class="card-text">Empty</p>
            </div>
        </div>
    </div>
</template>

<template id="driverCardTemplate">
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 detail-description">
        <div class="card text-center" style="width: 15rem;"><img class="card-img-top rounded-circle user-image mt-2 DriverImagePath" src="../images/driver.png" alt="Driver Image">
            <div class="card-body">
                <h5 class="card-title FirstName LastName"></h5>
                <h6 class="card-subtitle mb-2 text-muted AssignedVehicle">Assigned Vehicle: </h6>
                <h6 class="card-subtitle mb-2 text-muted Email">Email:</h6>
                <!-- <p class="card-text Email"></p> -->
            </div>
        </div>
    </div>
</template>

<template id="selectionDriverTemplate">
    <tr role="row" class="detail-description">
        <th class="DriverID sorting_1"></th>
        <td class="FirstName LastName"></td>
        <td class="AssignedVehicle"></td>
        <td class="NumOfAllocations"></td>
        <td data-field="assignedRequests"><i class="fas fa-info-circle"></i></td>
    </tr>
</template>

<template id="selectionVehicleTemplate">
    <tr role="row" class="detail-description">
        <th class="RegistrationNo"></th>
        <td class="Model"></td>
        <td class="NumOfAllocations"></td>
        <td class="assignedTrips" data-field="assignedRequests"><i class="fas fa-info-circle"></i></td>
    </tr>
</template>

<template id="loaderTemplate">
    <div class="bouncybox">
        <div class="bouncy"></div>
    </div>
</template>