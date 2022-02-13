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
                    <table id="categoryTable" class="table table-responsive text-center">
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
            <form id="addCategoryForm" action="#!">
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
                                <input required id="parentCategory" type="text" class="form-control form-control-sm" placeholder="Parent Category Name">
                            </div>
                            <div class="col-lg-6">
                                <p>Category:</p>
                                <input required id="category" type="text" class="form-control form-control-sm" placeholder="Category Name">
                            </div>
                            <div class="col-lg-6">
                                <p>Category Text:</p>
                                <input required id="categoryText" type="text" class="form-control form-control-sm" placeholder="Category Text">
                            </div>
                            <div class="col-lg-6">
                                <p>Category Icon:</p>
                                <input required id="categoryIcon" type="file" class="form-control form-control-sm">
                            </div>
                            <div class="col-lg-6">
                                <p>Category Background:</p>
                                <input required id="categoryBackground" type="file" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm" id="btnAddCategory">Save changes</button>
                    </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal fade" id="M_editCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form id="editCategoryForm" action="#!">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-secondary">
                        <div class="row gy-3">
                            <div class="col-lg-6">
                                <p>Parent Category:</p>
                                <input required id="parentCategoryEdit" type="text" class="form-control form-control-sm" placeholder="Parent Category Name">
                            </div>
                            <div class="col-lg-6">
                                <p>Category:</p>
                                <input required id="categoryEdit" type="text" class="form-control form-control-sm" placeholder="Category Name">
                            </div>
                            <div class="col-lg-6">
                                <p>Category Text:</p>
                                <input required id="categoryTextEdit" type="text" class="form-control form-control-sm" placeholder="Category Text">
                            </div>
                            <div class="col-lg-6">
                                <p>Category Icon:</p>
                                <input id="categoryIconEdit" type="file" class="form-control form-control-sm">
                            </div>
                            <div class="col-lg-6">
                                <p>Category Background:</p>
                                <input id="categoryBackgroundEdit" type="file" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm" id="btnEditCategory">Save changes</button>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        

        $("#editCategoryForm").submit(function(e){
            e.preventDefault();
            var formData = new FormData();
            
            formData.append("category_type", $("#parentCategoryEdit").val());
            formData.append("category_name", $("#categoryEdit").val());
            formData.append("category_type_key", $(e.target).attr("parent-category"));
            formData.append("category_name_key", $(e.target).attr("category"));
            formData.append("category_icon", $("#categoryIconEdit")[0].files[0]);
            formData.append("category_bg", $("#categoryBackgroundEdit")[0].files[0]);

            console.log(formData);

            prescoExecuteFileUpload("api/AdminController/updateCategory", formData, function (res){ 
                console.log(res);
                if (res.status == "Success") {
                    $("#toastAddToCart").html(`
                        <div id="liveToast" class="toast bg-primary shadow-lg" role="alert" aria-live="assertive" aria-atomic="true" data-bs-animation="true">
                        <div class="toast-header">
                            <strong class="me-auto text-primary">Success</strong>
                            <small>Now</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body text-secondary">
                            ${"Successfully edited, please refresh the page."} 
                        </div>
                        </div>
                    `)
                    $('.toast').toast('show');
                    getCategory();
                }
            });
        });

        $("#addCategoryForm").submit(function(e){
            e.preventDefault();
            var formData = new FormData();
            
            formData.append("category_type", $("#parentCategory").val());
            formData.append("category_name", $("#category").val());
            formData.append("category_text", $("#categoryText").val());
            formData.append("category_icon", $("#categoryIcon")[0].files[0]);
            formData.append("category_bg", $("#categoryBackground")[0].files[0]);

            prescoExecuteFileUpload("api/AdminController/addCategory", formData, function (res){ 
                if (res.status == "Success") {
                    $("#toastAddToCart").html(`
                        <div id="liveToast" class="toast bg-primary shadow-lg" role="alert" aria-live="assertive" aria-atomic="true" data-bs-animation="true">
                        <div class="toast-header">
                            <strong class="me-auto text-primary">Success</strong>
                            <small>Now</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body text-secondary">
                            ${"Successfully added, please refresh the page."} 
                        </div>
                        </div>
                    `)
                    $('.toast').toast('show');
                    getCategory();
                }
            });
        });

        getCategory();

        function getCategory() {
            prescoExecuteGET('api/ProductController/getCategory', function(res){

            let data = [];

            res.response.forEach(category => {
                data.push([
                    category.category_type,
                    category.category_name,
                    `
                        <div style"max-width: 32px; max-height: 32px;">
                            <img src="${base_url + category.category_icon}" style="max-width: 100%; max-height: 100%;" />
                        </div>
                    `,
                    `
                        <div style"max-width: 32px; max-height: 32px;">
                            <img src="${base_url + category.category_bg}" style="max-width: 100%; max-height: 100%;" />
                        </div>
                    `,
                    category.created_date,
                    `<button parent-category="${category.category_type}" category="${category.category_name}" data-bs-toggle="modal" data-bs-target="#M_editCategory" class="btn btn-sm btn-primary btnEditCategory">Edit</button>`
                ])
            });
            $("#categoryTable").DataTable().clear().destroy();
            $("#categoryTable").DataTable({
                data : data,
                pageLength: 5
            });

            $("#categoryTable").undelegate(".btnEditCategory","click").on("click", ".btnEditCategory", function(e){
                let parentCategory = $(e.target).attr("parent-category");
                let category = $(e.target).attr("category");

                $("#editCategoryForm").attr('parent-category', parentCategory);
                $("#editCategoryForm").attr('category', category);

                $("#parentCategoryEdit").val(parentCategory);
                $("#categoryEdit").val(category);

            });
            });
        }
    });
</script>