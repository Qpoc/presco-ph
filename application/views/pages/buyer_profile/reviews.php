<?php require("profile_navigation.php") ?>
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-primary fw-bold">Reviews</h3>
                    <hr>
                </div>
                <div class="col-lg-12">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">To be Reviewed</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">History</button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="col-lg-12 p-3 table-responsive">
                            <table class="table text-center">
                                <thead class="text-secondary">
                                    <tr>
                                        <th>Purchased</th>
                                        <th>Date of Purchased</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sweet Pea</td>
                                        <td>07/21/2021</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">Review</button>
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
                                        <th>Purchased</th>
                                        <th>Date of Purchased</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sweet Pea <p>This is My comment</p></td>
                                        <td>07/21/2021</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">Edit Review</button>
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