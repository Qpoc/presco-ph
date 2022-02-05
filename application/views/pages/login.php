<div class="d-flex justify-content-center align-items-center text-center">
    <div class="row gy-3 rounded bg-primary shadow mt-3 col-10 col-sm-6 col-lg-3 p-3">
        <div class="col-lg-12">
            <h2 class="text-primary fw-bold">Welcome to Pres Co</h2>
        </div>
        <div class="col-lg-12">
            <h5 class="text-secondary fw-bold">Login</h5>
            <form class="row">
                <div class="col-lg-12">
                    <input id="loginUsername" type="text" class="auth-form form-control form-control-sm mt-3" placeholder="Username/Email Address">
                </div>
                <div class="col-lg-12">
                    <input id="loginPassword" type="password" class="auth-form form-control form-control-sm mt-3" placeholder="Password" autocomplete="on">
                </div>
            </form>
        </div>
        <div class="col-lg-12">
            <div class="d-flex justify-content-center align-items-center">
                <button id="btnLogin" class="btn btn-sm btn-primary mx-3" type="">Login</button>
                <a href="<?php echo base_url();?>signup"><button class="btn btn-sm btn-primary mx-3" type="">Register</button></a>
            </div>
        </div>
        <div class="col-lg-12">
            <small class="fst-italic"><a href="#" class="text-primary">Forgot Password?</a></small>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Incorrect</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Incorrect Credentials
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>