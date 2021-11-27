        <?php require("navigation.php") ?>
        <div class="col-lg-10 main-content">
            <div class="row gy-3 p-3">
                <div class="col-lg-12">
                    <h3 class="text-primary fw-bold">Product</h3>
                    <hr>
                </div>
                <div class="col-lg-12">
                    <div class="d-flex justify-content-end button-product">
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#M_addCategory" >Add Product</button>
                    </div>
                </div>
                <div class="col-lg-12 shadow p-3">
                    <table class="table table-responsive text-center">
                        <thead class="text-secondary">
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Stocks</th>
                                <th>Description</th>
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
                        <div class="col-lg-6">
                            <p>Category:</p>
                            <select name="category" id="category" class="form-select form-select-sm">
                                <option value="" disabled selected>Select category</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <p>Featured:</p>
                            <select name="featured" id="featured" class="form-select form-select-sm">
                                <option value="" disabled selected>Select featured</option>
                                <option value="true">Yes</option>
                                <option value="false">No</option>
                            </select>
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
<script src="<?php echo base_url();?>public/js/admin/product.js"></script>