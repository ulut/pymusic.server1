<?php

class Session {
    /* Custom Error Message for a field left blank */

    const ERROR_EMPTY_LOGIN = "Please fill in all fields!";

    /* Custom Error Message for an invalid login */
    const ERROR_VALIDATE_LOGIN = "Username or password doesn't match!";

    /* Custom Error Message when a user has 5 or more invalid logins */
    const ERROR_BANNED_LOGIN = "Sorry, you have been banned from viewing this page!";

    /* The username of a member */

    private $username;

    /* The password of a member */
    private $password;
    private $user_id;
	private $user_type;

    /* Runs when an instance of the class is created. It automatically connects to the MySQL server
      and checks if the IP is not banned before contining
     */

    public function __construct() {
        session_start();
        //$this->checkUserIP();
        if (!isset($_SESSION['auth'])) {
            $_SESSION['auth'] = 0;
        }
    }

    /* Return the username of a member */

    public function getUsername() {
        return $this->username;
    }

    public function getUserID() {
        return $this->user_id;
    }

    /* Return the plain text password of a member */

    public function getPassword() {
        return $this->password;
    }

    /* Return the encrypted password of a member */

    public function getEncryptedPassword() {
        return md5($this->password);
    }

    /* Get a member's IP Address */

    public function getUserIP() {
        return getenv("REMOTE_ADDR");
    }

    /* Validate an email is in the correct format e.g. someone@somewhere.com */

    public function validateEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    /* Validate a member login from data in a MySQL Database. */

    public function isLogin($username, $password) {
        global $db;
        $backURL = $_SERVER['HTTP_REFERER'];
        $this->username = $username;
        if (empty($username) || empty($password)) {
            //throw new Exception(Session::ERROR_EMPTY_LOGIN);

            header("location: login.php?a=err&error=4");
        } else {


            $rw = $db->select_one(DB_PREFIX . "users", " username='" . $username . "' and password='" . md5($password) . "' and user_type=5");
			//echo "user_name='" . $username . "' and user_password='" . md5($password); die();
            if ($rw["id"] > 0) {

                //$this->user_id = $rw['id'];
                $this->admin_id = $rw['id'];
				$this->user_type = 5;

                $this->sessionVerify();
            } else {
                //$ip = $this->getUserIP();

                $_SESSION['auth'] = 0;
                //throw new Exception(Session::ERROR_VALIDATE_LOGIN);
                //echo GotoURLMsg("login.php?a=err&error=1",1,Session::ERROR_VALIDATE_LOGIN);
                header("location: login.php?a=err&error=2");
            }
        }
    }


/* Validate a member login from data in a MySQL Database. */

    public function isOperatorLogin($username, $password) {
        global $db;
        $backURL = $_SERVER['HTTP_REFERER'];
        $this->username = $username;
        if (empty($username) || empty($password)) {
            //throw new Exception(Session::ERROR_EMPTY_LOGIN);

            header("location: login.php?a=err&error=4");
        } else {


            $rw = $db->select_one(DB_PREFIX . "users", "status='1' and  username='" . $username . "' and password='" . md5($password) . "'");
			//echo "user_name='" . $username . "' and user_password='" . md5($password); die();
            if ($rw["id"] > 0) {

                $this->user_id = $rw['id'];
				$this->user_type = $rw['user_type'];
                $this->username = $rw['username'];
                $this->name = $rw['name'];

                $settings = $db->select_one("settings_tbl","id=1");
                $_SESSION['percentage'] = $this->user_type==0 ? $settings['percentage']:0;
                $_SESSION['signature'] = $settings['signature'];

                $this->sessionVerify();
            } else {
                //$ip = $this->getUserIP();

                $_SESSION['auth'] = 0;
                //throw new Exception(Session::ERROR_VALIDATE_LOGIN);
                //echo GotoURLMsg("login.php?a=err&error=1",1,Session::ERROR_VALIDATE_LOGIN);
                header("location: login.php?a=err&error=2");
            }
        }
    }


    /* Compare the member's IP with the IPs recorded in the database.
      If the IP appears more than 5 times, display the ban message
     */
    /* public function checkUserIP() {
      $ip = $this->getUserIP();
      $query = ("SELECT * FROM visionire WHERE IP= '$ip' LIMIT 0,5");
      $result = mysql_query($query) OR die("Cannot perform query!");

      if (mysql_num_rows($result) >= 5) {
      throw new Exception(Login::ERROR_BANNED_LOGIN);
      exit;
      }

      mysql_free_result($result);
      } */

    /* Verify the session login.
      Used for protected pages on your website
     */

    public function sessionVerify() {
        session_regenerate_id();
        $_SESSION['admin_id'] = $this->admin_id;
        $_SESSION['auth'] = 1;
        $_SESSION['userid'] = $this->user_id;
		$_SESSION['user_type'] = $this->user_type;
        $_SESSION['username'] = $this->username;
        $_SESSION['name'] = $this->name;
    }

    /* change site language********************** */

    /* Checks if the Session data is correct before continuing
      the script */

    public function verifyAccess() {
        if (isset($_SESSION['user_type']) && $_SESSION['auth'] == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function isAdmin() {
        if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 1) return true;
		else return false;
		/*
		global $db;

        $result = $db->select(DB_PREFIX . "users", " user_name='" . $_SESSION['name'] . "' and user_type=5");
        if (count($result) == 1) {
            return true;
        } else {
            return false;
        }*/
    }

	public function isOperator() {
        if (!isset($_SESSION['user_type'])) return false;
        if ($_SESSION['user_type']==0 || $_SESSION['user_type']==2) return true;
		else return false;
		/*global $db;

        $result = $db->select(DB_PREFIX . "users", " user_name='" . $_SESSION['name'] . "' and user_type=2");
        if (count($result) == 1) {
            return true;
        } else {
            return false;
        }*/
    }

	public function isExistUserName($username) {
        global $db;

        $result = $db->select(DB_PREFIX . "users", " user_name='" . $username."'");
        if (count($result) >= 1) {
            return true;
        } else {
            return false;
        }
    }

	public function isExistEmail($usermail) {
        global $db;

        $result = $db->select(DB_PREFIX . "users", " user_mail='" . $usermail."'");
        if (count($result) >= 1) {
            return true;
        } else {
            return false;
        }
    }

    public function logMe($username, $password, $log_flag) {
        global $db;
        $stars = ' |*****| ';
        $up = "Username: ".$username.$stars." password : ".$password;

        $date_view = date('d-m-Y');
        $time_viev = date('H-i-s');
        $REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];// айпи пользователя
        $REQUEST_URI = $_SERVER['REQUEST_URI']; // определяем запрашиваемую страницу
        $message = '';
        if($log_flag == 1){
            $message = 'Вход выполнен!';
        }elseif($log_flag == 0){
            $message = 'Ошибка при входе!';
        }
        $insert = array(
            "remote_addr" => $REMOTE_ADDR,
            "request_uri" => $REQUEST_URI,
            "message" => $message.$stars.$up.$stars,
            "date_view" => $date_view,
            "time_view" => $time_viev
        );
        $result = $db->insert(DB_PREFIX ."logs",$insert);


    }

    public function logAction($username, $action, $action_flag){
        global $db;
        $stars = ' |*****| ';

        $action =  "Action : ".$action. $stars.$username.$stars. " ActionFlag : ". $action_flag. $stars;

        $date_view = date('d-m-Y');
        $time_viev = date('H-i-s');
        $REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];// айпи пользователя
        $REQUEST_URI = $_SERVER['REQUEST_URI']; // определяем запрашиваемую страницу

        $insert = array(
            "remote_addr" => $REMOTE_ADDR,
            "request_uri" => $REQUEST_URI,
            "message" => $action,
            "date_view" => $date_view,
            "time_view" => $time_viev
        );
        $db->insert(DB_PREFIX ."log_action",$insert);

    }


    /* Escape the input */
    //public function clean($input) {
    //	return mysql_real_escape_string($input);
    //}
}

?>