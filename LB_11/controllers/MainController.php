<?php
require_once('views/TableView.php');
require_once('views/HeaderView.php');
require_once('views/LoginView.php');
require_once('views/FormView.php');
require_once('views/FeedbackView.php');
require_once('models/Database.php');
require_once('models/Operations.php');
require_once('models/EmailSender.php');

class MainController
{
    private $user_data = null;
    private $db = null;
    private $emailer = null;

    public function __construct($db_param_array, $mail_param_array)
    {
        session_start();
        if (isset($_SESSION['user'])) {
            $this->user_data = $_SESSION['user'];
        }
        $this->db = new Database($db_param_array[0], $db_param_array[1], $db_param_array[2], $db_param_array[3]);
        $this->emailer = new EmailSender($mail_param_array[0], $mail_param_array[1], $mail_param_array[2]);

    }

    public function process(): void
    {
        //check if logout action is not performed
        if (isset($_GET['action']) && $_GET['action'] == 'logout') {
            session_destroy();
            $this->user_data = null;
            header('location: ./');
        }
        //check if user is trying to log in
        if (isset($_POST['login'])) {
            $login_result = $this->db->login($_POST['login'], $_POST['password']);
            if ($login_result) {
                $_SESSION['user'] = $login_result;
                $this->user_data = $_SESSION['user'];
            }
        }
        //if user is not logged in
        if (!isset($this->user_data)) {
            $view = new LoginView();
            echo $view->print();
        } else {
            if (isset($_POST['email'])) {
                $this->emailer->send_mail('testmailerlab@gmail.com', 'bohdanshushval@gmail.com', 'Feedback from website: ' . $_POST['subject'], 'From: ' . $_POST['email'] . ' ' . $_POST['message']);
                header('Location: index.php');
            } else if (isset($_POST['optype'])) {
                $data_array = explode(" ", $_POST['opdata']);
                switch ($_POST['optype']) {
                    case 1:
                        $new_operation = new Sum($data_array);
                        break;
                    case 2:
                        $new_operation = new Average($data_array);
                        break;
                    case 3:
                        $new_operation = new Multiplication($data_array);
                }
                $this->db->add_data($_POST['optype'], $_POST['opdata'], $new_operation->get_result());
                header('Location: index.php');
            } else if (isset($_POST['email'])) {
                $this->emailer->send_mail('testmailerlab@gmail.com', 'bohdanshushval@gmail.com', 'Feedback from website: ' . $_POST['subject'], 'From: ' . $_POST['email'] . ' ' . $_POST['message']);
                header('Location: index.php');
            } else if (!isset($_GET['action']) || $_GET['action'] == "view_all") {
                $head_view = new HeaderView();
                $head_menu = $head_view->print();
                $view = new TableView();
                $db_data = $this->db->get_all_data();
                $table_data = '';
                foreach ($db_data as $row) {
                    $table_data .= "
                    <tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["operation_name"] . "</td>
                        <td>" . $row["input_data"] . "</td>
                        <td>" . $row["output_data"] . "</td>
                        <td><a href='index.php?action=delete&delete_id=" . $row["id"] . "'>Delete</a></td>
                    </tr>";
                }
                echo $view->print($head_menu, $table_data);
            } else if ($_GET['action'] == "add_new_op") {
                $head_view = new HeaderView();
                $head_menu = $head_view->print();
                $view = new FormView();
                $db_data = $this->db->get_all_operations();
                $op_options = '';
                foreach ($db_data as $row) {
                    $op_options .= "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
                }
                echo $view->print($head_menu, $op_options);
            } else if ($_GET['action'] == "delete") {
                $this->db->delete_data_by_id($_GET['delete_id']);
                header('Location: index.php');
            } else if ($_GET['action'] == "sendmail") {
                $head_view = new HeaderView();
                $head_menu = $head_view->print();
                $view = new FeedbackView();
                echo $view->print($head_menu);
            } else if ($_GET['action'] == "getjson") {
                $view = new TableView();
                $db_data = $this->db->get_all_data();
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($db_data);
            }
        }
    }
}