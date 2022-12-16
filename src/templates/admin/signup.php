<?php
use Certify\Certify\models\Admin;

if(isset($_SESSION['email'])){
  header("Location: /");
}

$first_name = $_POST['first_name'] ?? null;
$last_name = $_POST['last_name'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;
$cpassword = $_POST['cpassword'] ?? null;

$registerError = false;

if($first_name != null && $last_name != null && $email != null && $password !== null && $cpassword != null){

    // check if password and confirm password fields are same
    if(strcmp($password, $cpassword) != 0){
        $registerError = ["result" => true, "message" => "Password and Confirm Password fields doesn't match"];
    }else{
        $users = new Admin();

        // check if email already exists
        $result = $users->getUser($email);
        if($result != false){
            $registerError = ["result" => true, "message" => "Email already exists"];
        }else{
            $password = password_hash($password, PASSWORD_DEFAULT);
            $createResult = $users->create($first_name, $last_name, $email, $password);
            if($createResult['result'] == true){
                $_SESSION['register_success'] = true;
                header("Location: /admin/login.php");
            }else{
                $registerError = true;
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
                        if($registerError || $registerError['result'] == true){
                            ?>
                            <div class="alert alert-primary d-flex align-items-center" role="alert">
                                <i class="bi bi-x-circle-fill fs-3 me-3"></i>
                                <?= $registerError['message'] ?? "Unable to create new account. Please try again" ?>
                            </div>
                            <?php
                        }
                    ?>

                  <h3 class="fw-bold text-center pb-4">Create new user account</h3>

                    <div class="mt-5 mb-4">
                        <div class="row">
                            <div class="col">
                                <div class="form-outline mb-3">
                                    <label class="form-label" for="first_name">First Name</label>
                                    <input type="text" id="first_name" name="first_name" class="form-control form-control-lg rounded-pill" value="<?= $first_name ?? null ?>" required />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline mb-3">
                                    <label class="form-label" for="last_name">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control form-control-lg rounded-pill" value="<?= $last_name ?? null ?>" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-outline mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control form-control-lg rounded-pill" value="<?= $email ?? null ?>" required />
                        </div>

                        <div class="form-outline mt-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control form-control-lg rounded-pill" value="<?= $password ?? null ?>" required />
                        </div>

                        <div class="form-outline mt-3">
                            <label class="form-label" for="cpassword">Confirm Password</label>
                            <input type="password" id="cpassword" name="cpassword" class="form-control form-control-lg rounded-pill" value="<?= $cpassword ?? null ?>" required />
                        </div>
                    </div>

                  <div class="mb-5">
                    <button class="btn btn-primary btn-lg rounded-pill px-5" type="submit">Login</button>
                  </div>

                  <p class="mb-5 pb-lg-2">Already have an account? <a href="/admin/login.php">Login here</a></p>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>