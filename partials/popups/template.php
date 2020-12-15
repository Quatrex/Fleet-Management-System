<template id="cardTemplate">
    <div class="card request-card detail-description" style="z-index:2;">
        <div class="description">
            <h1 class="card-title Purpose">For: </h1>
            <div class="row" style="padding-left:1rem;">
                <h2 class="card-title" style="color:rgba(95,99,104,0.9);">Status: <b class="Status" style="font-weight:bold"></b></h2>
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
<template id="awaitingRequestHistoryCardTemplate">
    <div class="card request-card detail-description" style="z-index:2;">
        <div class="description">
            <h1 class="card-title Purpose">For: </h1>
            <h2 class="card-title RequesterName">By: </h2>
            <h2 class="card-title Status">Status: </h2>
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
        <div class="card text-center widthCard" style="width: 15rem;">
            <img class="VehiclePicturePath card-img-top vehicle-image mt-2" src="" alt="Vehicle Image">
            <div class="card-body">
                <h5 class="card-title Model"></h5>
                <h6 class="card-subtitle mb-2 text-muted RegistrationNo"></h6>
                <p class="card-text PurchasedYear"></p>
                <p class="card-text FuelType"></p>
            </div>
        </div>
    </div>
</template>


<template id="employeeCardTemplate">
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 detail-description" id="employeeContainer_50">
        <div class="card text-center widthCard" style="width: 15rem;"><img class="card-img-top rounded-circle user-image mt-2 ProfilePicturePath" src="../images/profilePictures/1597416665-pp.jpg" alt="Driver Image">
            <div class="card-body">
                <h5 class="card-title FirstName d-inline"></h5>
                <h5 class="card-title LastName d-inline-block"></h5>
                <h6 class="card-subtitle mb-2 text-muted Designation">Designation: </h6>
                <h6 class="card-subtitle mb-2 text-muted Position">Role: </h6>
                <p class="card-text Email"></p>
            </div>
        </div>
    </div>
</template>

<template id="driverCardTemplate">
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 detail-description">
        <div class="card text-center widthCard" style="width: 15rem;"><img class="card-img-top rounded-circle user-image mt-2 ProfilePicturePath" src="../images/driver.png" alt="Driver Image">
            <div class="card-body">
                <h5 class="card-title d-inline FirstName"></h5><h5 class="card-title d-inline LastName"></h5>
                <h6 class="card-subtitle mb-2 mt-2 d-inline text-muted ">AssignedVehicle</h6><h6 class="card-subtitle mb-2 mt-2 d-inline text-muted AssignedVehicle"></h6>
                <h6 class="card-subtitle mb-2 text-muted d-inline">Email:</h6><h6 class="card-subtitle mb-2 text-muted Email d-inline">Email:</h6>
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

<template id="selectionDriverVehicleTemplate">
    <tr role="row" class="detail-description">
        <th class="RegistrationNo"></th>
        <td class="Model"></td>
        <td class="NumOfAllocations"></td>
    </tr>
</template>

<template id="emptyPlaceholder">
    <div class="card request-card detail-description" style="z-index:2;">
        <div class="description">
            <div class="row" style="padding-left:1rem;">
                <div class="d-flex row w-100 mb-3 justify-content-center" style="color:gray"><i class="far fa-file fa-2x"></i></div>
                <div class="d-flex row w-100 justify-content-center" style="color:gray">There are no requests.</div>
            </div>
            <hr>
        </div>
    </div>
</template>

<template id="AssignedRequestToVehicleTemplate">
    <tr role="row" class="detail-description">
        <td class="DateOfTrip"></th>
        <td class="TimeOfTrip"></td>
        <td class="PickLocation"></td>
        <td class="DropLocation"></td>
    </tr>
</template>

<template id="AssignedRequestToDriverTemplate">
    <tr role="row" class="detail-description">
        <td class="DateOfTrip"></th>
        <td class="TimeOfTrip"></td>
        <td class="PickLocation"></td>
        <td class="DropLocation"></td>
    </tr>
</template>