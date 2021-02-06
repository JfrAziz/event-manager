<?php
include("secrets_.php");
include("mailer-templates/forgot_pwd_temp.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../src/PHPMailer/Exception.php';
require '../src/PHPMailer/PHPMailer.php';
require '../src/PHPMailer/SMTP.php';

try {
  $conn = new PDO('mysql:dbname=' . $MainDB . ';host=' . $servername . ';charset=utf8', $username, $password);

  $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  $message = $e->getMessage();
  header('Location:../public/error.html');
  die();
}
?>
<!DOCTYPE html>
<html>

<?php include_once "_partials/head.php" ?>

<body class="bg-gradient-primary">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-9 col-lg-12 col-xl-10">
        <div class="card shadow-lg o-hidden border-0 my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-6 d-none d-lg-flex">
                <div class="flex-grow-1 bg-password-image" style="background-image: url(&quot;../assets/img/front/image2.png&quot;);"></div>
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h4 class="text-dark mb-2">Forgot Your Password?</h4>
                    <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>
                  </div>
                  <form class="user" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                    <div class="form-group"><input class="form-control form-control-user" type="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email"></div><button class="btn btn-primary btn-block text-white btn-user" type="submit" name="submit">Reset Password</button>
                  </form>
                  <div class="text-center">
                    <hr>
                  </div>
                  <div class="text-center"><a class="small" href="member-login.php">Already have an account? Login!</a></div>
                  <?php
                  if (isset($_POST["submit"])) {
                    $email = $_POST['email'];
                    $check_sql = $conn->prepare('SELECT count(1) as isPresent from login where Email=:email');
                    $check_sql->bindValue(":email", $email);
                    $check_sql->execute();

                    foreach ($check_sql as $entry) {
                      $isUser =  $entry['isPresent'];
                    }
                    if ($isUser) {
                      $hash_sql = $conn->prepare('SELECT ForgotPasswordHash(:email) as link_value');
                      $hash_sql->bindValue(":email", $email);
                      $hash_sql->execute();

                      foreach ($hash_sql as $row) {
                        $key =  $row['link_value'];
                      }
                      $mail = new PHPMailer();  // create a new object
                      $mail->IsSMTP();
                      $mail->isHTML(true);
                      $mail->SMTPDebug = 0;
                      $mail->SMTPAuth = true;
                      $mail->SMTPSecure = 'ssl';
                      $mail->Host = $mailerHostname;
                      $mail->Port = 465;
                      $mail->Username = $mailerUname;
                      $mail->Password = $mailerPassword;
                      $mail->SetFrom($mailerUname, "Technical support");
                      $mail->AddBCC($email);
                      $mail->Subject = "Request For Password - Reg";
                      $link = $hostName . $forgotPwdExtension . '?gen=' . $key;
                      $mail->Body = forgot_password_mail($darkLogo, $logoHREF, $link, $reachEmail);
                      if (!$mail->Send()) {
                        echo 'Mail error: ' . $mail->ErrorInfo;
                      } else {
                        echo ('<div class="alert alert-success" role="alert" style="width:70%;margin-left:15%;margin-right:15%">
                                                    Your e-mail has been sent!
                                                    </div>');
                      }
                    } else {
                      echo ('<div class="alert alert-danger" role="alert" style="width:70%;margin-left:15%;margin-right:15%">
                                                This account does not exist!
                                                </div>');
                    }
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include_once "_partials/scripts.php" ?>
</body>

</html>