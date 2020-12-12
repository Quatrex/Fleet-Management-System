<?php

namespace Employee\Factory\Privileged;

use Request\Request;
use Vehicle\Vehicle;
use Vehicle\Factory\Base\VehicleFactory;
use Vehicle\Factory\LeasedVehicle\LeasedVehicleFactory;
use Vehicle\Factory\PurchasedVehicle\PurchasedVehicleFactory;
use Employee\Factory\Driver\DriverFactory;
use Employee\Factory\Driver\VPMODriverProxy;
use Report\VehicleHandoutSlip;
use Request\Factory\VPMORequest\VPMORequestFactory;
use Exception;

use function PHPSTORM_META\type;

class VPMO extends Requester
{
    private VehicleFactory $leasedVehicleFactory;
    private VehicleFactory $purchasedVehicleFactory;

    function __construct($values)
    {
        parent::__construct($values);
        $this->leasedVehicleFactory = LeasedVehicleFactory::getInstance();
        $this->purchasedVehicleFactory = PurchasedVehicleFactory::getInstance();
    }

    /**
     *
     * Returns all requests with the given state
     * 
     * @param string|array $state 'approve', 'scheduled', 'completed' or 'cancelled'.
     * Can send multiple states inside an array
     *
     * @return array{Request}
     */
    public function getRequests($state,
                                int $offset,
                                array $sort = ['CreatedDate' => 'DESC'],
                                array $search = ['' => ['All']]): array 
    {
        $states = is_array($state) ? $state : [$state];
        return VPMORequestFactory::makeRequests($states, $offset, $sort, $search);
    }

    public function getMyScheduledRequests( $state,
                                            int $offset,
                                            array $sort = ['CreatedDate' => 'DESC'],
                                            array $search = ['' => ['All']]): array 
    {
        $states = is_array($state) ? $state : [$state];
        return VPMORequestFactory::makeScheduledRequests($this->empID, $states, $offset, $sort, $search);
    }

    /**
     *
     * Returns all the vehicles
     *
     * @return array(Vehicle)
     *
     */
    public function getVehicles(
        int $offset = 0,
        array $sort = ['RegistrationNo' => 'ASC'],
        array $search = ['' => ['All']],
        bool $isAvailable = false
    ) {
        return VehicleFactory::getVehicles($offset, $sort, $search, $isAvailable);
    }

    /**
     *
     * Returns all the drivers
     *
     * @return array(Driver)
     *
     */
    public function getDrivers(
        int $offset = 0,
        array $sort = ['FirstName' => 'ASC'],
        array $search = ['' => ['All']]
    ) {
        return DriverFactory::makeDrivers($offset, $sort, $search);
    }

    /**
     *
     * change a request's state from approved to schedule
     *
     * @param $requestID,
     * @param $driver,
     * @param $vehicle
     * @return void
     *
     */
    public function scheduleRequest($requestID, $driverID, $vehicleID)
    {
        $request = VPMORequestFactory::makeRequest($requestID);
        $request->schedule($this->empID, $driverID, $vehicleID);
        $driver = DriverFactory::makeDriver($driverID);
        $driver->allocate();
        $vehicle = VehicleFactory::getVehicle($vehicleID);
        $vehicle->allocate();
    }

    /**
     *
     * change a request's state from scheduled to completed
     *
     * @param $requestID,$driver,$vehicle
     * @return void
     *
     */
    public function closeRequest($requestID)
    {
        $request = VPMORequestFactory::makeRequest($requestID);
        $request->close();
        $request->getField('vehicle')->deallocate();
        $driver = DriverFactory::makeDriver($request->getField('driver')->getField('driverId'));
        $driver->deallocate();
        $vehicle = VehicleFactory::getVehicle($request->getField('vehicle')->getField('registrationNo'));
        $vehicle->deallocate();
        return $request;
    }

    /**
     *
     * change a request's state from scheduled to completed
     *
     * @param $requestID,$driver,$vehicle
     * @return void
     *
     */
    public function cancelScheduledRequest($requestID)
    {
        $request = VPMORequestFactory::makeRequest($requestID);
        $request->cancel();
        $request->getField('vehicle')->deallocate();
        $driver = DriverFactory::makeDriver($request->getField('driver')->getField('driverId'));
        $driver->deallocate();
        $vehicle = VehicleFactory::getVehicle($request->getField('vehicle')->getField('registrationNo'));
        $vehicle->deallocate();
        return $request;
    }

    /**
     *
     * Adding a new leased vehicle to database
     *
     * @param $registrationNo, $model, $purchasedYear, $value, $fuelType, $insuranceValue, $insuranceCompany
     * @return void
     *
     */

    public function addPurchasedVehicle($values)
    {
        $vehicle = $this->purchasedVehicleFactory->makeNewVehicle($values);
        return $vehicle;
    }

    /**
     *
     * Adding a new purchased vehicle to database
     *
     * @param $registrationNo,$model,$purchasedYear, $value,$fuelType,$insuranceValue,$insuranceCompany, $leasedCompany, $leasedPeriodFrom, $leasedPeriodTo, $monthlyPayment
     * @return void
     *
     */
    public function addLeasedVehicle($values)
    {
        $vehicle = $this->leasedVehicleFactory->makeNewVehicle($values);
        return $vehicle;
    }

    /**
     *
     * Update vehicle data.
     *
     * @param registrationNo, fields
     * @return void
     *
     */
    public function updatePurchasedVehicleInfo($values)
    {
        $vehicle = $this->purchasedVehicleFactory->makeVehicle($values['RegistrationNo']);
        $vehicle->updateInfo($values);
        return $vehicle;
    }

    /**
     *
     * Update vehicle data.
     *
     * @param registrationNo, fields
     * @return void
     *
     */
    public function updateLeasedVehicleInfo($values)
    {
        $vehicle = $this->leasedVehicleFactory->makeVehicle($values['RegistrationNo']);
        $vehicle->updateInfo($values);
        return $vehicle;
    }

    /**
     *
     * Update vehicle's AssignedOfficer field.
     *
     * @param registrationNo, fields
     * @return void
     *
     */
    public function updateVehicleAssignedOfficer($values)
    {
        $vehicle = VehicleFactory::getVehicle($values['RegistrationNo']);
        $vehicle->updateAssignedOfficer($values);
        return $vehicle;
    }

    /**
     *
     * Update vehicle picture.
     *
     * @param imageName,registrationNo,isLeased, fields
     * @return void
     *
     */
    public function updateVehiclePicture($values)
    {
        if ($values['IsLeased']) {
            $vehicle = $this->leasedVehicleFactory->makeVehicle($values['RegistrationNo']);
        } else {
            $vehicle = $this->purchasedVehicleFactory->makeVehicle($values['RegistrationNo']);
        }
        $vehicle->updatePicture($values);
        return $vehicle;
    }

    /**
     *
     * Delete purchased vehicle data.
     *
     * @param registrationNo
     * @return void
     *
     */
    public function deletePurchasedVehicle($registrationNo)
    {
        $vehicle = $this->purchasedVehicleFactory->makeVehicle($registrationNo);
        $vehicle->delete();
        return $vehicle;
    }

    /**
     *
     * Delete leased vehicle data.
     *
     * @param registrationNo
     * @return void
     *
     */
    public function deleteLeasedVehicle($registrationNo)
    {
        $vehicle = $this->leasedVehicleFactory->makeVehicle($registrationNo);
        $vehicle->delete();
        return $vehicle;
    }

    /**
     *
     * Generate vehicle hand-out slip.
     *
     * @param requestID
     *
     */
    public function generateVehicleHandoutSlip(int $requestID): void
    {
        $request = VPMORequestFactory::makeRequest($requestID);
        $vehicleHandoutSlip = $request->generateVehicleHandoutSlip();
        $vehicleHandoutSlip->print();
    }

    /**
     *
     * update driver's AssignedVehicle
     *
     * @param driverID, registrationNo
     * @return VPMODriverProxy
     *
     */
    public function assignVehicleToDriver(string $driverID, string $registrationNo): VPMODriverProxy
    {
        $driver =  DriverFactory::makeDriver($driverID);
        $driver->assignVehicle($registrationNo);
        return $driver;
    }

    /**
     *
     * update driver's AssignedVehicle
     *
     * @param driverID, registrationNo
     * @return VPMODriverProxy
     *
     */
    public function loadAssignedRequests(array $values, string $type)
    {
        switch ($type) {
            case 'driver':
                $driver =  DriverFactory::makeDriverByValues($values);
                $driver->getField('assignedRequests');
                return $driver;
            case 'vehicle':
                if ($values['IsLeased']) {
                    $vehicle = $this->leasedVehicleFactory->makeVehicleByValues($values);
                    $vehicle->getField('assignedRequests');
                    return $vehicle;
                } else {
                    $vehicle = $this->purchasedVehicleFactory->makeVehicleByValues($values);
                    $vehicle->getField('assignedRequests');
                    return $vehicle;
                }
            default:
                throw new Exception('Invalid Parameter for type');
        }
    }
}
