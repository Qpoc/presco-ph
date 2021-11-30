<?php require("navigation.php") ?>
        <div class="col-lg-10 main-content">
            <div class="row gy-3 p-3">
                <div class="col-lg-12">
                    <h3 class="text-primary fw-bold">Category</h3>
                    <hr>
                </div>
                <div class="col-lg-12">
                    <div class="d-flex justify-content-end button-product">
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#M_addCategory" >Add Category</button>
                    </div>
                </div>
                <div class="col-lg-12 shadow p-3">
                    <table class="table table-responsive text-center">
                        <thead class="text-secondary">
                            <tr>
                                <th>Parent Category</th>
                                <th>Category</th>
                                <th>Icon</th>
                                <th>Background</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="M_addCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-secondary">
                    <div class="row gy-3">
                        <div class="col-lg-6">
                            <p>Parent Category:</p>
                            <input id="parentCategory" type="text" class="form-control form-control-sm" placeholder="Parent Category Name">
                        </div>
                        <div class="col-lg-6">
                            <p>Category:</p>
                            <input id="category" type="text" class="form-control form-control-sm" placeholder="Category Name">
                        </div>
                        <div class="col-lg-6">
                            <p>Category Icon:</p>
                            <input id="categoryIcon" type="file" class="form-control form-control-sm">
                        </div>
                        <div class="col-lg-6">
                            <p>Category Background:</p>
                            <input id="categoryBackground" type="file" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm" id="btnAddCategory">Save changes</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url();?>public/js/admin/product.js"></script>