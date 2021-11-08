        <?php require("navigation.php") ?>
        <div class="col-lg-10 main-content">
            <div class="row gy-3 p-3">
                <div class="col-lg-12">
                    <h3 class="text-primary fw-bold">Sales</h3>
                    <hr>
                </div>
                <div class="col-lg-12">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Product with Sales</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Product with No Sales</button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="col-lg-12 p-3 table-responsive">
                            <table class="table text-center">
                                <thead class="text-secondary">
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Number of Sales</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sweet Pea</td>
                                        <td>10</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">Manage</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="col-lg-12 p-3 table-responsive">
                            <table class="table text-center">
                                <thead class="text-secondary">
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sweet Pea</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">Manage</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>