<?php

use Certify\Certify\models\ResetPasswordTokens;
use Certify\Certify\models\Admin;

$user_id = $_GET['user'] ?? null;
$token = $_GET['verify'] ?? null;
$new_password = $_POST['password'] ?? null;
$confirm_password = $_POST['confirm_password'] ?? null;

$alert_message = [];

if(isset($user_id) && isset($token) && isset($new_password)){
    if(strcmp($new_password, $confirm_password) != 0){
        $alert_message = ["result" => false, "message" => "Confirm Password doesn't match"];
    }else{
        $reset_password_token = new ResetPasswordTokens;
        $verify_token = $reset_password_token->verifyUserToken($user_id, $token);
        $user_password_reset_token = md5($user_id);
        if(!($verify_token) && ($user_password_reset_token != $token)){
            $alert_message = ["result" => false, "message" => "Invalid reset link"];
        }else{
            $password = password_hash($new_password, PASSWORD_DEFAULT);
            $user = new Admin();
            $result = $user->updatePassword($user_id, $password);
            if($result['result'] == false){
                $alert_message = ["result" => false, "message" => "Unable to reset password. Please try again"];
            }else{
                $reset_password_token->removeUserToken($user_id);
                header("Location: /admin/login.php");
                exit;
            }
        }
    }
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
                        if($alert_message){
                            ?>
                            <div class="alert alert-<?= ($alert_message['result'] == true) ? "success" : "danger" ?> d-flex align-items-center" role="alert">
                                <i class="bi <?= $alert_message['result'] == true ? "bi-check-circle-fill" : "bi-x-circle-fill" ?> fs-3 me-3"></i>
                                <?= $alert_message['message'] ?>
                            </div>
                            <?php
                        }
                    ?>

                  <h3 class="fw-bold text-center pb-4">Reset Password</h3>

                    <div class="mt-5 mb-4">
                        <div class="form-outline mb-3">
                            <label class="form-label" for="password">Enter new password</label>
                            <input type="password" id="password" name="password" class="form-control form-control-lg rounded-pill" required />
                        </div>
                        <div class="form-outline mb-3">
                            <label class="form-label" for="confirm_password">Confirm Password</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control form-control-lg rounded-pill" required />
                        </div>
                    </div>

                  <div class="mb-5">
                    <button class="btn btn-primary btn-lg rounded-pill px-5" type="submit">Reset Password</button>
                  </div>

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