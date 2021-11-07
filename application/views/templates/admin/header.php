<html>
	<head>
		<Title>Presco PH</Title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://bootswatch.com/5/flatly/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/all.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
		<link rel="stylesheet" href="<?php echo base_url();?>public/css/third_party/bootstrap-datepicker3.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>public/css/third_party/bootstrap-datepicker3.css.map">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" ></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="<?php echo base_url();?>public/js/callback/ajax.js"></script>
        <script src="<?php echo base_url();?>public/js/third_party/bootstrap-datepicker.min.js"></script>
        <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    </head>
	<body>
		<div class="row" id="admin-container">
            <div class="col-lg-12 p-3 shadow-sm">
                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                        <a class="navbar-brand text-primary fw-bold d-none d-md-block mx-3" href="<?php echo base_url();?>admin">PRES CO</a>
                        <label for="presco-navigation">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-list text-primary mt-1" viewBox="0 0 16 16" style="cursor: pointer;">
                                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                        </label>
                    </div>
                    <div class="d-flex align-items-center justify-content-end">
                        <div class="notification">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-bell-fill text-primary" viewBox="0 0 16 16">
                                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                            </svg>
                        </div>
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
                                                    <li><a class="dropdown-item text-sm" href="#">Profile</a></li>
                                                    <li><a class="dropdown-item text-sm" href="#">Settings</a></li>
                                                    <li><button class="dropdown-item text-sm" id="btnLogout" user-type="admin">Logout</button></li>';
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
            </div>

