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
                            <table id="reviewTable" class="table text-center">
                                <thead class="text-secondary">
                                    <tr>
                                        <th>Purchased</th>
                                        <th>Date of Purchased</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="col-lg-12 p-3 table-responsive">
                            <table id="historyReviewTable" class="table text-center">
                                <thead class="text-secondary">
                                    <tr>
                                        <th>Purchased</th>
                                        <th>Date of Purchased</th>
                                        <th>Action</th>
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
    </div>
</div>
<script>
    $(document).ready(function(){
        const payload = {
            "email" : Cookies.get("email")
        };

        var toBeReviewed = document.getElementById('pills-home-tab')
        toBeReviewed.addEventListener('shown.bs.tab', function(e){
            getProductsToReviewed();
        });

        var tabEl = document.getElementById('pills-profile-tab')
        tabEl.addEventListener('shown.bs.tab', function (e) {

            prescoExecutePOST("api/ReviewController/getHistoryReview", payload, function(res){
                console.log(res);

                let data = [];
                let rating = "";

                res.response.forEach(product => {
                    rating = "";

                    for (let index = 0; index < 5; index++) {
                        rating += index < product.rating ? `<i star-rating="${index  + 1}" class="star-rating bi bi-star-fill text-primary" style="cursor:pointer;"></i>` : `<i star-rating="${index  + 1}" class="star-rating bi bi-star text-primary" style="cursor:pointer;"></i>`
                    }

                    data.push([
                        `
                            <div class="rating-container d-flex justify-content-center align-items-center flex-column">
                                <div style="max-width: 64px; max-height: 64px;">
                                    <img src="<?php echo base_url();?>${product.image}" style="max-width: 100%; max-height:100%;"/>
                                </div>
                                <p>${product.product_name}</p>
                                <div class="star-rating-container">
                                    ${rating}
                                </div>
                                <textarea placeholder="Edit your review here (Optional)." class="form-control" style="resize: none;">${product.message}</textarea>
                            </div>
                        `,
                        product.created_date,
                        `<button feedback-id="${product.feedback_id}" transaction-id="${product.transaction_id}" product-id="${product.product_id}" transaction-id="${product.transaction_id}" product-id="${product.product_id}" class="btnReviewEdit btn btn-primary btn-sm">Edit Review</button>
                        <input type="hidden" class="starRatingEdit" value="1"/>
                        `
                    ]);
                });

                $("#historyReviewTable").DataTable().clear().destroy();

                $("#historyReviewTable").DataTable({
                    data: data,
                    pageLength: 5
                });

                $('#historyReviewTable').undelegate(".star-rating", "click").on("click", ".star-rating", function(e){
                    const star = $(e.target);
                    const rating = star.attr("star-rating");
                    const stars = star.closest(".star-rating-container").find("i");
                    star.closest(".star-rating-container").find("i").removeClass("bi-star-fill").addClass("bi-star");
                    
                    for (let index = 0; index < rating; index++) {
                        console.log(stars.eq(index).removeClass("bi-star").addClass("bi-star-fill"));
                    }
               
                    $(e.target).closest("tr").find(".starRatingEdit").val(rating);
                });

                $("#historyReviewTable").undelegate(".btnReviewEdit", "click").on("click", ".btnReviewEdit", function(e){
                    const feedbackID = $(e.target).attr("feedback-id");
                    const productID = $(e.target).attr("product-id");
                    const rating = $(e.target).closest("tr").find(".starRatingEdit").val();
                    const feedback = $(e.target).closest("tr").find("textarea").val();
                    const reviewed = 1;

                    const payload = {
                        "feedback_id" : feedbackID,
                        "rating" : rating,
                        "feedback" : feedback,
                        "email" : Cookies.get("email")
                    }

                    prescoExecutePOST("api/ReviewController/editReview", payload, function(res){
                        if (res.status == "Success") {
                            if (res.status == "Success") {
                                $("#toastAddToCart").html(toast("Review Edited", `Your review has been edited.`))
                                $('.toast').toast('show');
                            }
                        }
                    });
                });

            });
        })

        getProductsToReviewed();

        function getProductsToReviewed() { 
            prescoExecutePOST("api/ReviewController/getProductsToReview", payload, function(res){

                let data = [];

                res.response.forEach(product => {
                    data.push([
                        `
                            <div class="rating-container d-flex justify-content-center align-items-center flex-column">
                                <div style="max-width: 64px; max-height: 64px;">
                                    <img src="<?php echo base_url();?>${product.image}" style="max-width: 100%; max-height:100%;"/>
                                </div>
                                <p>${product.product_name}</p>
                                <div class="star-rating-container">
                                    <i star-rating="1" class="star-rating bi bi-star-fill text-primary" style="cursor:pointer;"></i>
                                    <i star-rating="2" class="star-rating bi bi-star text-primary" style="cursor:pointer;"></i>
                                    <i star-rating="3" class="star-rating bi bi-star text-primary" style="cursor:pointer;"></i>
                                    <i star-rating="4" class="star-rating bi bi-star text-primary" style="cursor:pointer;"></i>
                                    <i star-rating="5" class="star-rating bi bi-star text-primary" style="cursor:pointer;"></i>
                                </div>
                                <textarea placeholder="Type your review here (Optional)." class="form-control" style="resize: none;"></textarea>
                            </div>
                        `,
                        product.created_date,
                        `<button transaction-id="${product.transaction_id}" product-id="${product.product_id}" transaction-id="${product.transaction_id}" product-id="${product.product_id}" class="btnReview btn btn-primary btn-sm">Submit Review</button>
                        <input type="hidden" class="starRating" value="1"/>
                        `
                    ]);
                });

                $("#reviewTable").DataTable().clear().destroy();

                $("#reviewTable").DataTable({
                    data: data,
                    pageLength: 5
                });

                $("#reviewTable").undelegate(".star-rating", "click").on("click", ".star-rating", function(e){
                    const star = $(e.target);
                    const rating = star.attr("star-rating");
                    const stars = star.closest(".star-rating-container").find("i");
                    star.closest(".star-rating-container").find("i").removeClass("bi-star-fill").addClass("bi-star");
                    
                    for (let index = 0; index < rating; index++) {
                        console.log(stars.eq(index).removeClass("bi-star").addClass("bi-star-fill"));
                    }
                    $(e.target).closest("tr").find(".starRating").val(rating);
                });

                $("#reviewTable").undelegate(".btnReview", "click").on("click", ".btnReview" , function(e){
                    $(e.target).attr("disabled", true);
                
                    const transactionID = $(e.target).attr("transaction-id");
                    const productID = $(e.target).attr("product-id");
                    const rating = $(e.target).closest("tr").find(".starRating").val();
                    const feedback = $(e.target).closest("tr").find("textarea").val();
                    const reviewed = 1;

                    const payload = {
                        "transaction_id" : transactionID,
                        "product_id" : productID,
                        "rating" : rating,
                        "feedback" : feedback,
                        "reviewed" : reviewed,
                        "email" : Cookies.get("email")
                    }

                    prescoExecutePOST("api/ReviewController/submitReview", payload, function(res){
                        if (res.status == "Success") {
                            $("#toastAddToCart").html(toast("Review Submitted", `Your review has been submitted.`))
                            $('.toast').toast('show');
                            getProductsToReviewed();
                        }
                    });
               
                });
            });
        }

    });
</script>