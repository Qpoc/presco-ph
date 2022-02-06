<?php require("profile_navigation.php") ?>
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-primary fw-bold">Cancellation</h3>
                    <hr>
                </div>
                <div class="col-lg-12 p-3 table-responsive">
                    <table id="cancellationTable" class="table text-center">
                        <thead class="text-secondary">
                            <tr>
                                <th>Tracking No</th>
                                <th>Product</th>
                                <th>Date of Cancellation</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        prescoExecutePOST("api/BuyerController/listCancel", {
            "email" : Cookies.get('email') ?? null
        }, function(res){
            let data = [];
            res.response.forEach(tracking => {
                data.push([
                    tracking.tracking_id,
                    tracking.product_name,
                    tracking.modified_date
                ]);
            })
            $("#cancellationTable").DataTable({
                data : data,
                pageLength : 10
            });
        });
    });
</script>