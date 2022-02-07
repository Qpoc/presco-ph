<?php 
// <div class="profile-img-container">
// <img src="https://scontent.fmnl2-1.fna.fbcdn.net/v/t1.6435-9/118211230_1223815944646768_8556277598618643273_n.jpg?_nc_cat=105&ccb=1-5&_nc_sid=09cbfe&_nc_eui2=AeHb5ydcdnFbKPyeSfJ6TUCWlFKCGmmGJhWUUoIaaYYmFVJSON2Ld-QnSrYMh8zJ6-uhHK1aXAwaVIcL8t7kQQ5t&_nc_ohc=waW2e24OrxoAX-0i_4N&_nc_oc=AQnOsYowu15EDUz5_tiSvhOoasQtzLvZL76zdjwSSlqX4GXJYmvzXCN9OkCUph32qPyvzPc_zljKmFoS3Fv-g42k&tn=gMGlgouJFaHG1iDU&_nc_ht=scontent.fmnl2-1.fna&oh=a80a815cc2a4906c59641b773263c7e4&oe=61AEB4FB" alt="">
// </div>
    echo '<div class="container-fluid" style="min-height: 500px;">
    <div class="row p-3">
        <div class="col-lg-3 p-3 shadow" style="min-height: 500px;">
            <div class="profile-container d-flex align-items-center justify-content-center">
                <div class="profile-name mt-3 ms-3">
                    <p class="text-primary fw-bold">John Cyrus Patungan</p>
                </div>
            </div>
            <hr>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <ul>
                    <li class="presco-nav-header">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed text-primary fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                                    </svg>
                                    <span class="mx-3">Manage Account</span>
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <ul>
                                        <li class="text-start"><a href="'.base_url().'account" class="dropdown-item">My Profile</a></li>
                                        <li class="text-start"><a href="'.base_url().'account/address" class="dropdown-item">Address</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="presco-nav-header">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button text-primary fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-minecart-loaded" viewBox="0 0 16 16">
                                        <path d="M4 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 1a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm8-1a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0 1a2 2 0 1 0 0-4 2 2 0 0 0 0 4zM.115 3.18A.5.5 0 0 1 .5 3h15a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 14 12H2a.5.5 0 0 1-.491-.408l-1.5-8a.5.5 0 0 1 .106-.411zm.987.82 1.313 7h11.17l1.313-7H1.102z"/>
                                        <path fill-rule="evenodd" d="M6 1a2.498 2.498 0 0 1 4 0c.818 0 1.545.394 2 1 .67 0 1.552.57 2 1h-2c-.314 0-.611-.15-.8-.4-.274-.365-.71-.6-1.2-.6-.314 0-.611-.15-.8-.4a1.497 1.497 0 0 0-2.4 0c-.189.25-.486.4-.8.4-.507 0-.955.251-1.228.638-.09.13-.194.25-.308.362H3c.13-.147.401-.432.562-.545a1.63 1.63 0 0 0 .393-.393A2.498 2.498 0 0 1 6 1z"/>
                                    </svg>
                                    <span class="mx-3">My Activity</span>
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample" style="">
                                <div class="accordion-body">
                                    <ul>
                                        <li class="text-start"><a href="'.base_url().'account/order" class="dropdown-item">Track My Order</a></li>
                                        <li class="text-start"><a href="'.base_url().'account/reviews" class="dropdown-item">My Review</a></li>
                                        <li class="text-start"><a href="'.base_url().'account/wishlist" class="dropdown-item">My Wishlist</a></li>
                                        <li class="text-start"><a href="'.base_url().'account/cancellation" class="dropdown-item">My Cancellation</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>';

