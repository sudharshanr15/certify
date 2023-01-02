<?php
use Certify\Certify\models\Admin;

$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

$loginError = false;

if($email != null && $password != null){
    $users = new Admin();
    $result = $users->getLogin($email);
    $password_result = password_verify($password, $result['password']);
    if($password_result == true){
        $_SESSION['first_name'] = $result['first_name'];
        $_SESSION['last_name'] = $result['last_name'];
        $_SESSION['email'] = $result['email'];
        header("Location: /");
    }else{
        $loginError = true;
    }
}

if(isset($_GET['logout'])){
  session_destroy();
}

if(isset($_SESSION['email'])){
  header("Location: /");
}
?>
<section class="login-section d-flex flex-column">
  <a class="navbar-brand m-3" href="/">
    <span class="nav-icon"><img src="/assets/images/certificate_dark.svg" alt=""></span>
    <span class="fs-4">APSCE</span>
  </a>
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card border border-0 shadow">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <div class="d-flex align-items-center justify-content-center h-100">
                <img src="/assets/images/login_banner.png"
                  alt="login form" class="img-fluid" />
              </div>            
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5">
                <form method="post" action="">
                  <!-- <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0">Logo</span>
                  </div> -->
                    <?php
                        if($loginError){
                            ?>
                            <div class="alert alert-primary d-flex align-items-center" role="alert">
                                <i class="bi bi-x-circle-fill fs-3 me-3"></i>
                                Email and Password is incorrect / Email does not exist. Please try again
                            </div>
                            <?php
                        }

                        if($_SESSION['register_success'] ?? false){
                          ?>
                            <div class="alert alert-primary d-flex align-items-center" role="alert">
                                <i class="bi bi-check-circle-fill fs-3 me-3"></i>
                                User registered successfully. Login to access your account.
                            </div>
                          <?php
                          unset($_SESSION['register_success']);
                        }

                        if($_SESSION['reset_success'] ?? false){
                          ?>
                            <div class="alert alert-primary d-flex align-items-center" role="alert">
                                <i class="bi bi-check-circle-fill fs-3 me-3"></i>
                                User password reset successfull. Login to access your account.
                            </div>
                          <?php
                          unset($_SESSION['reset_success']);
                        }
                    ?>

                  <h3 class="fw-bold text-center pb-4">Login to your account</h3>

                    <div class="mt-5 mb-4">
                        <div class="form-outline mb-3">
                            <label class="form-label" for="email">email</label>
                            <input type="text" id="email" name="email" class="form-control form-control-lg rounded-pill" required />
                        </div>

                        <div class="form-outline mt-3">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group position-relative">
                              <input type="password" id="password" name="password" class="form-control form-control-lg rounded-pill" required />
                              <button class="btn toggle-password input-group-text position-absolute end-0 h-100 me-2"><i class="bi bi-eye-fill fs-5"></i></button>
                            </div>
                          </div>
                    </div>

                  <div class="mb-5">
                    <button class="btn btn-primary btn-lg rounded-pill px-5" type="submit">Login</button>
                  </div>
                  <p class="mb-2 pb-lg-2"><a href="/admin/forgot_password.php">Forgot Password</a></p>
                  <p class="mb-5 pb-lg-2">Don't have an account? <a href="/admin/signup.php">Register here</a></p>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>