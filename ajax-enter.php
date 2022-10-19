<?php
session_start();


include('class/database.php');
class signInUp extends database
{
    protected $link;

    public function matchingFunction()
    {
        if (isset($_POST['fname'])) {
            $fname = addslashes(trim($_POST['fname']));
            $lname = addslashes(trim($_POST['lname']));
            $email = addslashes(trim($_POST['email']));
            $code = addslashes(trim($_POST['code']));

            $sql = "SELECT * from code_tbl where code = '$code'";
            $res = mysqli_query($this->link, $sql);
            if (mysqli_num_rows($res) > 0) {

                $row = mysqli_fetch_assoc($res);
                $url = 'https://app.portal.vivomeetings.com/sign-up?product=vivomeetings_free_trial';
                $status = $row['status'];
                $id = $row = $row['code_id'];

                if ($status == 'Not Used') {

                    $sqlUpdate = "UPDATE code_tbl SET `status` = 'Used' WHERE `code_id` = $id";
                    $resUpdate = mysqli_query($this->link, $sqlUpdate);

                    if ($resUpdate) {
                        $sqlInsert = "INSERT INTO `user_tbl` (`user_id`, `fname`, `lname`, `email`, `code_id`) VALUES (NULL, '$fname', '$lname', '$email', $id)";
                        $resInsert = mysqli_query($this->link, $sqlInsert);

                        if ($resInsert) {

                            $to = 'redemption@vivomeetings.com';
                            $subject = 'Redeem Code Status';
                            $from = 'info@promovivomeetings.com';

                            $headers  = "From: " . $from . "\n";
                            $headers .= "Cc: " . $from . "\n";
                            $headers .= "X-Sender: " . $from . "\n";
                            $headers .= 'X-Mailer: PHP/' . phpversion();
                            $headers .= "X-Priority: 1\n"; // Urgent message!
                            $headers .= "Return-Path: " . $from . "\n"; // Return path for errors
                            $headers .= "MIME-Version: 1.0\r\n";
                            $headers .= "Content-Type: text/html; charset=iso-8859-1\n";

                            $message = '';
                            $message .= 'First Name: ' . $fname . "\r\n" . '<br>';
                            $message .= 'Last Name: ' . $lname . "\r\n" . '<br>';
                            $message .= 'Email: ' . $email . "\r\n" . '<br>';
                            $message .= 'Code: ' . $code . "\r\n" . '<br>';

                            if (mail($to, $subject, $message, $headers)) {
                                return 1;
                            }
                        }
                    }
                } else {
                    return '<div class="alert alert-warning alert-dismissible mt-3">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>code already used</strong>
                </div>';
                }
            } else {
                return '<div class="alert alert-warning alert-dismissible mt-3">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>code not valid</strong>
            </div>';
            }
        }
    }
}
$obj = new signInUp;
echo $obj->matchingFunction();