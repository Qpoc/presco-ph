<html>
	<head>
		<Title>Presco PH</Title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://bootswatch.com/5/flatly/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
		<link rel="stylesheet" href="<?php echo base_url();?>public/css/third_party/bootstrap-datepicker3.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>public/css/third_party/bootstrap-datepicker3.css.map">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" ></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="<?php echo base_url();?>public/js/third_party/js.cookie.min.js"></script>
        <script src="<?php echo base_url();?>public/js/callback/ajax.js"></script>
        <script src="<?php echo base_url();?>public/js/third_party/bootstrap-datepicker.min.js"></script>
        <script src="<?php echo base_url();?>public/js/var.js"></script>
        <!-- Mapbox -->
        <link href="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css" rel="stylesheet">
        <script src="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js"></script>
        <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js'></script>
        <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css' type='text/css' />
        <script>var base_url = '<?php echo base_url() ?>';</script>
    </head>
	<body>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/all.css"> 
		<nav class="navbar navbar-expand-lg shadow navbar-light bg-primary position-sticky" style="top: 0; z-index: 1000;">
            <div class="container-fluid">
                <a class="navbar-brand text-primary fw-bold d-none d-md-block" href="<?php echo base_url();?>">PRES CO</a>
                <div id="search-bar-container" class="input-group">
                    <input id="searchProductHeader" class="form-control form-control-sm" placeholder="Search">
                    <span class="input-group-text bg" id="basic-addon2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search text-primary" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </span>
                    <div id="search-bar-content" class="shadow">
                    </div>
                </div>
                <div class="basket-container" id="basketContainer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-cart-fill text-primary mx-3" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    <div class="cart-number">
                        <p class="fw-bold text-primary" id="cartNumber">0</p>
                    </div>
                    <div id="cartItems" class="cart-items bg-primary shadow-lg p-3 rounded">
                        
                    </div>
                </div>
                <div class="d-none d-lg-flex align-items-center">
                    <ul class="d-flex">
                        <li class="mx-3"><a href="<?php echo base_url();?>" class="text-primary">HOME</a></li>
                        <li class="mx-3"><a href="<?php echo base_url();?>shop" class="text-primary">SHOP</a></li>
                        <li class="mx-3"><a href="<?php echo base_url();?>faq" class="text-primary">FAQ</a></li>
                    </ul>
                </div>
                <div class="d-flex">
                    <ul>
                        <li class="nav-item dropdown mx-3">
                            <div class="profile">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-circle text-primary" viewBox="0 0 16 16" aria-expanded="false">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                    </svg>
                                <div class="profile-list bg-primary shadow-lg rounded-3">
                                    <ul class="rounded-3">
                                        <?php
                                            if (isset($_SESSION['session_id']) && isset($_SESSION['user'])) {
                                                echo '<li><a class="dropdown-item text-sm" href="#" disabled>'.$_SESSION['user'].'</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-sm" href="'.base_url().'account">My Account</a></li>
                                                <li><a class="dropdown-item text-sm" href="'.base_url().'account/order">My Orders</a></li>
                                                <li><a class="dropdown-item text-sm" href="'.base_url().'account/reviews">My Review</a></li>
                                                <li><a class="dropdown-item text-sm" href="'.base_url().'account/wishlist">My Wishlist</a></li>
                                                <li><a class="dropdown-item text-sm" href="'.base_url().'account/cancellation">My Cancellations</a></li>
                                                <li><button class="dropdown-item text-sm" id="btnLogout" user-type="employee">Logout</button></li>';
                                            }else {
                                                echo '<li><a class="dropdown-item" href="'.base_url().'login" disabled>Login</a></li>
                                                <li><a class="dropdown-item" href="'.base_url().'signup">Create an Account</a></li>';
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
   
