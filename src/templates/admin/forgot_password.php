<?php

use Certify\Certify\core\SendMail;
use Certify\Certify\models\ResetPasswordTokens;
use Certify\Certify\models\Admin;

$email = $_POST['email'] ?? null;

$alert_message = [];

if($email != null){
    $reset_password_token = new ResetPasswordTokens();
    $admin = new Admin();
    $user = $admin->getUser($email);

    if(!$user){
        $alert_message = ['result' => false, "message" => "Email address not found"];
    }else{
        $user_id = $user['id'];
        $reset_token = md5($user['id'] . time());
        $already_exist = $reset_password_token->getUserToken($user_id);
        if(count($already_exist) > 0){
            $result = $reset_password_token->updateToken($user_id, $reset_token);
        }else{
            $result = $reset_password_token->insert($user_id, $reset_token);
        }

        if($result['result'] == false){
            $alert_message = ['result' => false, "message" => "Unable to send reset link, please try again"];
        }else{
            $reset_link = "http://certify.localhost/admin/reset_password.php?user=$user_id&verify=$reset_token";
            $result = sendResetLink($email, $reset_link);
            $alert_message = $result;
        }
    }
}

function sendResetLink($email, $reset_link){
    $message = <<<EOD
    <html>
        <head>
            <title>APSCE admin password reset</title>
        </head>
        <body>
        <div class="content" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
        <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope="" itemtype="http://schema.org/ConfirmAction" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; margin: 0; border: none;">
            <tbody><tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                <td class="content-wrap" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; color: #495057; font-size: 14px; vertical-align: top; margin: 0;padding: 30px; box-shadow: 0 0.75rem 1.5rem rgba(18,38,63,.03); ;border-radius: 7px; background-color: #fff;" valign="top">
                    <meta itemprop="name" content="Confirm Email" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                    <table width="100%" cellpadding="0" cellspacing="0" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                        <tbody><tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                            <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                Reset your password by clicking on the button below
                            </td>
                        </tr>
                        <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                            <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                               <p>You have recently request for a password reset. So don't share this link to anyone. If you have not made this request then login to your page and change your password!. If you are not redirected to your browser after clicking button, copy the link below and paste it in the browser.</p>
                                <p><a href="$reset_link">$reset_link</a></p>
                            </td>
                        </tr>
                        <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                            <td class="content-block" itemprop="handler" itemscope="" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                <a href="$reset_link" itemprop="url" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #34c38f; margin: 0; border-color: #34c38f; border-style: solid; border-width: 8px 16px;">Reset Password</a>
                            </td>
                        </tr>
                        <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                            <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                <b>APSCE College</b>
                                <p>Administrator</p>
                            </td>
                        </tr>
                        <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                            <td class="content-block" style="text-align: center;font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0;" valign="top">
                                © 2023 APSCE College
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
        </tbody></table>
    </div>
        </body>
    </html>
EOD;
    $mail = new SendMail;
    $result = $mail->send($email, "Password Reset", $message, true);

    if($result['result'] == false){
        return ["result" => false, "message" => "Unable to send mail. Please try again"];
    }else{
        return ["result" => true, "message" => "Reset link sent successfully"];
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
                            <label class="form-label" for="email">Enter your email address</label>
                            <input type="email" id="email" name="email" class="form-control form-control-lg rounded-pill" required />
                        </div>
                    </div>

                  <div class="mb-5">
                    <button class="btn btn-primary btn-lg rounded-pill px-5" type="submit">Send reset password link</button>
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