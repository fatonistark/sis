<div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
            style="background:url(<?= site_url('assets') ?>/assets/images/big/auth-bg.jpg) no-repeat center center;">
    <div class="auth-box row">
        <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(<?= site_url('assets') ?>/assets/images/big/3.jpg);">
        </div>
        <div class="col-lg-5 col-md-7 bg-white">
            <div class="p-3">
                <div class="text-center">
                    <img src="<?= site_url('assets') ?>/assets/images/big/icon.png" alt="wrapkit">
                </div>
                <h2 class="mt-3 text-center">Sign In</h2>
                <p class="text-center">Enter your username and password to access admin panel.</p>
                <form class="mt-4" id="form-login">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="text-dark" for="uname">Username</label>
                                <input class="form-control" id="uname" name="username" type="text" placeholder="Masukan Username">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="text-dark" for="pwd">Password</label>
                                <input class="form-control" id="pwd" name="password" type="password" placeholder="Masukan Password">
                            </div>
                        </div>
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-block btn-dark">Sign In</button>
                        </div>
                        <div class="col-lg-12 text-center mt-5">
                            Don't have an account? <a href="#" class="text-danger">Sign Up</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>