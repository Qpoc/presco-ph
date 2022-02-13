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
                            <button class="nav-link" id="pills-no-sales-tab" data-bs-toggle="pill" data-bs-target="#pills-no-sales" type="button" role="tab" aria-controls="pills-no-sales" aria-selected="false">Product with No Sales</button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="col-lg-12 p-3 table-responsive">
                            <table id="withSalesTable" class="table text-center">
                                <thead class="text-secondary">
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Number of Sales</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-no-sales" role="tabpanel" aria-labelledby="pills-no-sales-tab">
                        <div class="col-lg-12 p-3 table-responsive">
                            <table id="withNoSalesTable" class="table text-center">
                                <thead class="text-secondary">
                                    <tr>
                                        <th>Product Name</th>
                                    </tr>
                                </thead>
                                <tbody id="withNoSalesTableBody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        showProductWithSales();
        
        const productWithSales = document.getElementById('pills-home-tab');
        const productWithNoSales = document.getElementById('pills-no-sales-tab');
        
        productWithSales.addEventListener('shown.bs.tab', function(e){
           showProductWithSales();
        })

        productWithNoSales.addEventListener('shown.bs.tab', function(e){
            prescoExecuteGET('api/AdminController/getProductNoSales', function(res){
                if (res.response instanceof Array) {
                    let data = [];

                    res.response.forEach(product => {
                        data.push([
                            product.product_name
                        ])
                        
                    });
                    $("#withNoSalesTable").DataTable().clear().destroy();

                    $("#withNoSalesTable").DataTable({
                        data : data,
                        pageLength : 5
                    })
                }
            });
        })

        function showProductWithSales() { 
            prescoExecuteGET('api/AdminController/getProductSales', function(res){
                console.log(res);
                if (res.response instanceof Array) {
                    let products = new Map();
                    let data = [];

                    res.response.forEach(product => {
                        products.has(product.product_name) ? products.set(product.product_name, products.get(product.product_name) + 1) : products.set(product.product_name, 1);
                    });


                    for (const iterator of products.keys()) {
                        data.push([
                            iterator,
                            products.get(iterator)
                        ]);
                    }

                    $("#withSalesTable").DataTable().clear().destroy();
             
                    $("#withSalesTable").DataTable({
                        data: data,
                        pageLength: 5
                    });
                }
            });
        }
    })
</script>