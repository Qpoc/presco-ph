<?php require("navigation.php") ?>
        <div class="col-lg-10 main-content">
            <div class="row gy-3 p-3">
                <div class="col-lg-12">
                    <h3 class="text-primary fw-bold">Order</h3>
                    <hr>
                </div>
                <div class="col-lg-12 d-flex justify-content-end">
                    <button class="btn btn-sm btn-primary">Add Order</button>
                </div>
                <div class="col-lg-12 shadow p-3">
                    <div class="row gy-3">
                        <div class="col-lg-3">
                            <input type="text" class="form-control form-control-sm" placeholder="Order No.">
                        </div>
                        <div class="col-lg-3">
                            <input type="text" class="form-control form-control-sm" placeholder="Customer First Name">
                        </div>
                        <div class="col-lg-3">
                            <input type="text" class="form-control form-control-sm" placeholder="Customer Last Name">
                        </div>
                        <div class="col-lg-3">
                            <select name="" id="" class="form-select form-select-sm">
                                <option value="" disabled selected>Status</option>
                                <option value="" >Shipped</option>
                            </select>
                        </div>
                        <div class="col-lg-12 d-flex justify-content-end">
                            <button class="btn btn-sm btn-primary">Search</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 shadow p-3">
                    <table class="table table-responsive text-center">
                        <thead class="text-secondary">
                            <tr>
                                <th>Customer Name</th>
                                <th>Address</th>
                                <th>Email Address</th>
                                <th>Date Registered</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-secondary">
                    <div class="row gy-3">
                        <div class="col-lg-6">
                            <p>Product Name:</p>
                            <input id="productName" type="text" class="form-control form-control-sm" placeholder="Product Name">
                        </div>
                        <div class="col-lg-6">
                            <p>Product Image:</p>
                            <input id="productImage" type="file" class="form-control form-control-sm" placeholder="Product Image">
                        </div>
                        <div class="col-lg-12">
                            <p>Product Description:</p>
                            <textarea id="productDescription" textarea class="form-control form-control-sm" name="description" required></textarea>
                            <script>
                                    CKEDITOR.replace('description');
                            </script>
                        </div>
                        <div class="col-lg-6">
                            <p>Product Price:</p>
                            <input id="productPrice" type="text" class="form-control form-control-sm" placeholder="Product Price">
                        </div>
                        <div class="col-lg-6">
                            <p>Product Stocks:</p>
                            <input id="productStock" type="text" class="form-control form-control-sm" placeholder="Product Stocks">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm" id="btnAddProduct">Save changes</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>