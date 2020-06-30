<html>
<?php include '../partials/head.php'; ?>

<body>
    <div class="main-wrapper">
        <?php include '../partials/header.php'; ?>
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Fleet Mangement System</h4>
                                <!-- Nav tabs -->
                                <div class="default-tab">
                                    <ul class="nav nav-tabs mb-3" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#requests">Request</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#employees">Employee</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#drivers">Driver</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#trip">Trip</a>
                                        </li>

                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#contact">Contact</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade" id="requests" role="tabpanel">
                                            <input type="button" value="New Request" class="btn btn-primary" id="request-vehicle-button">
                                            <h4>Your Pending Requests</h4>
                                            <table class="table table-hover" id="request-table">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>Pending</td>
                                                        <td>2020/04/10</td>
                                                        <td>18.10</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td>Pending</td>
                                                        <td>2020/04/10</td>
                                                        <td>08.10</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">3</th>
                                                        <td>Pending</td>
                                                        <td>2020/04/10</td>
                                                        <td>13.10</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="employees" role="tabpanel">
                                            <input type="button" value="Add Employee" class="btn btn-primary" id="add-employee-button">
                                            <h4>Employees</h4>
                                            <table id="employee-table" class="table table-hover table-bordered" style="width:100%">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Position</th>
                                                        <th>Office</th>
                                                        <th>Age</th>
                                                        <th>Start date</th>
                                                        <th>Salary</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Tiger Nixon</td>
                                                        <td>System Architect</td>
                                                        <td>Edinburgh</td>
                                                        <td>61</td>
                                                        <td>2011/04/25</td>
                                                        <td>$320,800</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Garrett Winters</td>
                                                        <td>Accountant</td>
                                                        <td>Tokyo</td>
                                                        <td>63</td>
                                                        <td>2011/07/25</td>
                                                        <td>$170,750</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Bruno Nash</td>
                                                        <td>Software Engineer</td>
                                                        <td>London</td>
                                                        <td>38</td>
                                                        <td>2011/05/03</td>
                                                        <td>$163,500</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sakura Yamamoto</td>
                                                        <td>Support Engineer</td>
                                                        <td>Tokyo</td>
                                                        <td>37</td>
                                                        <td>2009/08/19</td>
                                                        <td>$139,575</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Thor Walton</td>
                                                        <td>Developer</td>
                                                        <td>New York</td>
                                                        <td>61</td>
                                                        <td>2013/08/11</td>
                                                        <td>$98,540</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Finn Camacho</td>
                                                        <td>Support Engineer</td>
                                                        <td>San Francisco</td>
                                                        <td>47</td>
                                                        <td>2009/07/07</td>
                                                        <td>$87,500</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Serge Baldwin</td>
                                                        <td>Data Coordinator</td>
                                                        <td>Singapore</td>
                                                        <td>64</td>
                                                        <td>2012/04/09</td>
                                                        <td>$138,575</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Zenaida Frank</td>
                                                        <td>Software Engineer</td>
                                                        <td>New York</td>
                                                        <td>63</td>
                                                        <td>2010/01/04</td>
                                                        <td>$125,250</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Zorita Serrano</td>
                                                        <td>Software Engineer</td>
                                                        <td>San Francisco</td>
                                                        <td>56</td>
                                                        <td>2012/06/01</td>
                                                        <td>$115,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jennifer Acosta</td>
                                                        <td>Junior Javascript Developer</td>
                                                        <td>Edinburgh</td>
                                                        <td>43</td>
                                                        <td>2013/02/01</td>
                                                        <td>$75,650</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Cara Stevens</td>
                                                        <td>Sales Assistant</td>
                                                        <td>New York</td>
                                                        <td>46</td>
                                                        <td>2011/12/06</td>
                                                        <td>$145,600</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hermione Butler</td>
                                                        <td>Regional Director</td>
                                                        <td>London</td>
                                                        <td>47</td>
                                                        <td>2011/03/21</td>
                                                        <td>$356,250</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lael Greer</td>
                                                        <td>Systems Administrator</td>
                                                        <td>London</td>
                                                        <td>21</td>
                                                        <td>2009/02/27</td>
                                                        <td>$103,500</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jonas Alexander</td>
                                                        <td>Developer</td>
                                                        <td>San Francisco</td>
                                                        <td>30</td>
                                                        <td>2010/07/14</td>
                                                        <td>$86,500</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shad Decker</td>
                                                        <td>Regional Director</td>
                                                        <td>Edinburgh</td>
                                                        <td>51</td>
                                                        <td>2008/11/13</td>
                                                        <td>$183,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Michael Bruce</td>
                                                        <td>Javascript Developer</td>
                                                        <td>Singapore</td>
                                                        <td>29</td>
                                                        <td>2011/06/27</td>
                                                        <td>$183,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Donna Snider</td>
                                                        <td>Customer Support</td>
                                                        <td>New York</td>
                                                        <td>27</td>
                                                        <td>2011/01/25</td>
                                                        <td>$112,000</td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Position</th>
                                                        <th>Office</th>
                                                        <th>Age</th>
                                                        <th>Start date</th>
                                                        <th>Salary</th>
                                                    </tr>
                                                </tfoot>
                                            </table>

                                        </div>

                                        <div class="tab-pane fade" id="drivers" role="tabpanel">
                                            <input type="button" value="Add Driver" class="btn btn-primary" id="add-driver-button">
                                            <h4>Drivers</h4>
                                            <table id="all-driver-table" class="table table-hover table-bordered" style="width:100%">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Position</th>
                                                        <th>Office</th>
                                                        <th>Age</th>
                                                        <th>Start date</th>
                                                        <th>Salary</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Tiger Nixon</td>
                                                        <td>System Architect</td>
                                                        <td>Edinburgh</td>
                                                        <td>61</td>
                                                        <td>2011/04/25</td>
                                                        <td>$320,800</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Garrett Winters</td>
                                                        <td>Accountant</td>
                                                        <td>Tokyo</td>
                                                        <td>63</td>
                                                        <td>2011/07/25</td>
                                                        <td>$170,750</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Bruno Nash</td>
                                                        <td>Software Engineer</td>
                                                        <td>London</td>
                                                        <td>38</td>
                                                        <td>2011/05/03</td>
                                                        <td>$163,500</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sakura Yamamoto</td>
                                                        <td>Support Engineer</td>
                                                        <td>Tokyo</td>
                                                        <td>37</td>
                                                        <td>2009/08/19</td>
                                                        <td>$139,575</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Thor Walton</td>
                                                        <td>Developer</td>
                                                        <td>New York</td>
                                                        <td>61</td>
                                                        <td>2013/08/11</td>
                                                        <td>$98,540</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Finn Camacho</td>
                                                        <td>Support Engineer</td>
                                                        <td>San Francisco</td>
                                                        <td>47</td>
                                                        <td>2009/07/07</td>
                                                        <td>$87,500</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Serge Baldwin</td>
                                                        <td>Data Coordinator</td>
                                                        <td>Singapore</td>
                                                        <td>64</td>
                                                        <td>2012/04/09</td>
                                                        <td>$138,575</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Zenaida Frank</td>
                                                        <td>Software Engineer</td>
                                                        <td>New York</td>
                                                        <td>63</td>
                                                        <td>2010/01/04</td>
                                                        <td>$125,250</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Zorita Serrano</td>
                                                        <td>Software Engineer</td>
                                                        <td>San Francisco</td>
                                                        <td>56</td>
                                                        <td>2012/06/01</td>
                                                        <td>$115,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jennifer Acosta</td>
                                                        <td>Junior Javascript Developer</td>
                                                        <td>Edinburgh</td>
                                                        <td>43</td>
                                                        <td>2013/02/01</td>
                                                        <td>$75,650</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Cara Stevens</td>
                                                        <td>Sales Assistant</td>
                                                        <td>New York</td>
                                                        <td>46</td>
                                                        <td>2011/12/06</td>
                                                        <td>$145,600</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hermione Butler</td>
                                                        <td>Regional Director</td>
                                                        <td>London</td>
                                                        <td>47</td>
                                                        <td>2011/03/21</td>
                                                        <td>$356,250</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lael Greer</td>
                                                        <td>Systems Administrator</td>
                                                        <td>London</td>
                                                        <td>21</td>
                                                        <td>2009/02/27</td>
                                                        <td>$103,500</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jonas Alexander</td>
                                                        <td>Developer</td>
                                                        <td>San Francisco</td>
                                                        <td>30</td>
                                                        <td>2010/07/14</td>
                                                        <td>$86,500</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shad Decker</td>
                                                        <td>Regional Director</td>
                                                        <td>Edinburgh</td>
                                                        <td>51</td>
                                                        <td>2008/11/13</td>
                                                        <td>$183,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Michael Bruce</td>
                                                        <td>Javascript Developer</td>
                                                        <td>Singapore</td>
                                                        <td>29</td>
                                                        <td>2011/06/27</td>
                                                        <td>$183,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Donna Snider</td>
                                                        <td>Customer Support</td>
                                                        <td>New York</td>
                                                        <td>27</td>
                                                        <td>2011/01/25</td>
                                                        <td>$112,000</td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Position</th>
                                                        <th>Office</th>
                                                        <th>Age</th>
                                                        <th>Start date</th>
                                                        <th>Salary</th>
                                                    </tr>
                                                </tfoot>
                                            </table>

                                        </div>
                                        <div class="tab-pane fade" id="trip" role="tabpanel">
                                            <h4>Ongoing Trips</h4>
                                            <table class="table table-hover" id="ongoing-table">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>Pending</td>
                                                        <td>2020/04/10</td>
                                                        <td>18.10</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td>Pending</td>
                                                        <td>2020/04/10</td>
                                                        <td>08.10</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">3</th>
                                                        <td>Pending</td>
                                                        <td>2020/04/10</td>
                                                        <td>13.10</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>


                                        <div class="tab-pane fade" id="contact">
                                            <?php include '../partials/contact.php' ?>
                                        </div>
                                        <!--End of Contact-->>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../partials/footer.php'; ?>
    </div>
    <?php
    include '../partials/popups/common.php';
    include '../partials/popups/admin_popup.php';
    ?>
    <script>
        const pendingRequests = <?php echo json_encode(($_SESSION['requestsByMe'])) ?>;
        const requestsToApprove = <?php echo json_encode(($_SESSION['requestsToJustify'])) ?>;
        sessionStorage.setItem('requestsToApprove', requestsToApprove);
        sessionStorage.setItem('requestsByMe', pendingRequests);
    </script>
    <script src="../js/functions.js"></script>
    <script src="../js/eventlisteners/common.js"></script>
    <script src="../js/eventlisteners/cao.js"></script>

</body>

</html>