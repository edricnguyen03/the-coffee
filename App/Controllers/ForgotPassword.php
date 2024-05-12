
<?php
require_once './vendor/autoload.php';
// require './vendor';
use PHPMailer\PHPMailer\PHPMailer;

class ForgotPassword extends Controller
{
     public $userModel;
     public $data;

     private $otp;
     public function __construct()
     {
          $this->userModel = $this->model('UserModel');
          $this->data = [];
     }
     public function index()
     {
          $this->view('/Client/ForgotPassword');
     }


     public function guiMa()
     {
          if (isset($_POST['email'])) {
               $email = $_POST['email'];
               $user = $this->userModel->getUserByEmail($email);
               if ($user) {
                    $otp = rand(100000, 999999);
                    $subject = 'Ma xac nhan dat lai mat khau';
                    $message = 'Ma xac nhan cua ban la: ' . $otp;

                    // Load PHPMailer
                    $mail = new PHPMailer;

                    // Configure SMTP
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'thekrister123@gmail.com';
                    $mail->Password = 'sdza crva megd ifdn'; // Replace with your real password
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    // Configure email
                    $mail->setFrom('thekrister123@gmail.com', 'Your Name');
                    $mail->addAddress($email);
                    $mail->Subject = $subject;
                    $mail->Body    = $message;

                    // Send email
                    if (!$mail->send()) {
                         echo 'Message could not be sent.';
                         echo 'Mailer Error: ' . $mail->ErrorInfo;
                    } else {
                         $_SESSION['otp'] = $otp;
                         echo 'success';
                    }
               } else {
                    echo 'Email không tồn tại trong cơ sở dữ liệu!';
               }
          } else {
               echo 'Email không được để trống!';
          }
     }



     public function datLaiMatKhau()
     {
          if (isset($_POST['email']) && isset($_POST['otp'])) {
               $email = $_POST['email'];
               $otp = $_POST['otp'];
               $user = $this->userModel->getUserByEmail($email);
               if ($user) {
                    if ($otp == $_SESSION['otp']) {
                         $newPassword = '123456';
                         $this->userModel->updatePassword($user[0]['id'], $newPassword);
                         echo 'success';
                    } else {
                         echo 'Mã xác nhận không đúng !';
                    }
               } else {
                    echo 'Email không tồn tại trong cơ sở dữ liệu !';
               }
          } else {
               echo 'Email hoặc mã xác nhận không được để trống !';
          }
     }
}
