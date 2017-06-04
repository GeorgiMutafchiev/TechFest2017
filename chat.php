<?php

namespace SPA_Common;
define('DB_USERNAME',       'kozle1_bebio');
define('DB_PASSWORD',       'bebio123');
define('DB_HOST',           'localhost');
define('DB_NAME',           'kozle1_hoteltestbansko');
define('CHAT_HISTORY',      '150');
define('CHAT_ONLINE_RANGE', '1');
define('ADMIN_USERNAME_PREFIX', 'adm123_');
abstract class Model
{
    public $db;
    public function __construct()
    {
        $this->db = new \mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    }
}
abstract class Controller
{
    private $_request, $_response, $_query, $_post, $_server, $_cookies;
    protected $_currentAction, $_defaultModel;
    const ACTION_POSTFIX = 'Action';
    const ACTION_DEFAULT = 'indexAction';
    public function __construct()
    {
        $this->_request  = &$_REQUEST;
        $this->_query    = &$_GET;
        $this->_post     = &$_POST;
        $this->_server   = &$_SERVER;
        $this->_cookies  = &$_COOKIE;
        $this->init();
    }
    public function init()
    {
        $this->dispatchActions();
        $this->render();
    }
    public function dispatchActions()
    {
        $action = $this->getQuery('action');
        if ($action && $action .= self::ACTION_POSTFIX) {
            if (method_exists($this, $action)) {
                $this->setResponse(
                    call_user_func(array($this, $action), array())
                );
            } else {
                $this->setHeader("HTTP/1.0 404 Not Found");
            }
        } else {
            $this->setResponse(
                call_user_func(array($this, self::ACTION_DEFAULT), array())
            );
        }
        return $this->_response;
    }
    public function render()
    {
        if ($this->_response) {
            if (is_scalar($this->_response)) {
                echo $this->_response;
            } else {
                throw new \Exception('Response content must be type scalar');
            }
            exit;
        }
    }
    public function indexAction()
    {
        return null;
    }
    public function setResponse($content)
    {
        $this->_response = $content;
    }
    public function setHeader($params)
    {
        if (! headers_sent()) {
            if (is_scalar($params)) {
                header($params);
            } else {
                foreach($params as $key => $value) {
                    header(sprintf('%s: %s', $key, $value));
                }
            }
        }
        return $this;
    }
    public function setModel($namespace)
    {
        $this->_defaultModel = $namespace;
        return $this;
    }
    public function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
        return $this;
    }
    public function setCookie($key, $value, $seconds = 3600)
    {
        $this->_cookies[$key] = $value;
        if (! headers_sent()) {
            setcookie($key, $value, time() + $seconds);
            return $this;
        }
    }
    public function getRequest($param = null, $default = null)
    {
        if ($param) {
            return isset($this->_request[$param]) ?
                $this->_request[$param] : $default;
        }
        return $this->_request;
    }
    public function getQuery($param = null, $default = null)
    {
        if ($param) {
            return isset($this->_query[$param]) ?
                $this->_query[$param] : $default;
        }
        return $this->_query;
    }
    public function getPost($param = null, $default = null)
    {
        if ($param) {
            return isset($this->_post[$param]) ?
                $this->_post[$param] : $default;
        }
        return $this->_post;
    }
    public function getServer($param = null, $default = null)
    {
        if ($param) {
            return isset($this->_server[$param]) ?
                $this->_server[$param] : $default;
        }
        return $this->_server;
    }
    public function getSession($param = null, $default = null)
    {
        if ($param) {
            return isset($this->_session[$param]) ?
                $this->_session[$param] : $default;
        }
        return $this->_session;
    }
    public function getCookie($param = null, $default = null)
    {
        if ($param) {
            return isset($this->_cookies[$param]) ?
                $this->_cookies[$param] : $default;
        }
        return $this->_cookies;
    }
    public function getModel()
    {
        if ($this->_defaultModel && class_exists($this->_defaultModel)) {
            return new $this->_defaultModel;
        }
    }
    public function sanitize($string, $quotes = ENT_QUOTES, $charset = 'utf-8')
    {
        return htmlentities($string, $quotes, $charset);
    }
}
abstract class Helper
{
}
namespace SPA_Chat;
use SPA_Common;
class Model extends SPA_Common\Model
{
    public function getMessages($limit = CHAT_HISTORY, $reverse = true)
    {
    $un = $_SESSION['hotelup'];
    $hn = "HOTELUP" . $_SESSION['hotelup'];
        $response = $this->db->query("(SELECT * FROM messages WHERE (username = '$un') OR (username = '$hn') OR (username = 'HOTELUP')
            ORDER BY `date` DESC LIMIT {$limit}) ORDER BY `date` ASC");
        $result = array();
        while($row = $response->fetch_object()) {
            $result[] = $row;
        }
        $response->free();
        return $result;
    }
    public function addMessage($username, $message, $ip)
    {
        $username = addslashes($username);
        $message = addslashes($message);
        return (bool) $this->db->query("INSERT INTO messages
            VALUES (NULL, '{$username}', '{$message}', '{$ip}', NOW())");
    }
    public function removeMessages()
    {
        return (bool) $this->db->query("TRUNCATE TABLE messages");
    }
    public function removeOldMessages($limit = CHAT_HISTORY)
    {
        return (bool) $this->db->query("DELETE FROM messages
            WHERE id NOT IN (SELECT id FROM messages
                ORDER BY date DESC LIMIT {$limit})");
    }
    public function getOnline($count = true, $timeRange = CHAT_ONLINE_RANGE)
    {
        if ($count) {
            $response = $this->db->query("SELECT count(*) as total FROM online");
            return $response->fetch_object();
        }
        $response = $this->db->query("SELECT ip FROM online");
        $result = array();
        while($row = $response->fetch_object()) {
            $result[] = $row;
        }
        $response->free(); 
        return $result;
    }
    public function updateOnline($hash, $ip)
    {
        return (bool) $this->db->query("REPLACE INTO online
            VALUES ('{$hash}', '{$ip}', NOW())") or die(mysql_error());
    }
    public function clearOffline($timeRange = CHAT_ONLINE_RANGE)
    {
        return (bool) $this->db->query("DELETE FROM online
            WHERE last_update <= (NOW() - INTERVAL {$timeRange} MINUTE)");
    }
    public function __destruct()
    {
        if ($this->db) {
            $this->db->close();
        }
    }
}
class Controller extends SPA_Common\Controller
{
    protected $_model;
    public function __construct()
    {
        $this->setModel('SPA_Chat\Model');
        parent::__construct();
    }
    public function indexAction()
    {
    }
    public function listAction()
    {
        $this->setHeader(array('Content-Type' => 'application/json'));
        $messages = $this->getModel()->getMessages();
        foreach($messages as &$message) {
            $message->me = $this->getServer('REMOTE_ADDR') === $message->ip;
        }
        return json_encode($messages);
    }
    public function saveAction()
    {
        $username = $this->getPost('username');
        $message = $this->getPost('message');
        $ip = $this->getServer('REMOTE_ADDR');
        $this->setCookie('username', $username, 9999 * 9999);
        $result = array('success' => false);
        if ($username && $message) {
            $cleanUsername = preg_replace('/^'.ADMIN_USERNAME_PREFIX.'/', '', $username);
            $result = array(
                'success' => $this->getModel()->addMessage($cleanUsername, $message, $ip)
            );
        }
        if ($this->_isAdmin($username)) {
            $this->_parseAdminCommand($message);
        }
        $this->setHeader(array('Content-Type' => 'application/json'));
        return json_encode($result);
    }
    private function _isAdmin($username) 
    {
        return preg_match('/^'.ADMIN_USERNAME_PREFIX.'/', $username);
    }
    private function _parseAdminCommand($message)
    {
        if ($message == '/clear') {
            $this->getModel()->removeMessages();
            return true;
        }
        if ($message == '/online') {
            $online = $this->getModel()->getOnline(false);
            $ipArr = array();
            foreach ($online as $item) {
                $ipArr[] = $item->ip;
            }
            $message = 'Online: ' . implode(", ", $ipArr);
            $this->getModel()->addMessage('Admin', $message, '0.0.0.0');
            return true;
        }
    }
    private function _getMyUniqueHash() 
    {
        $unique  = $this->getServer('REMOTE_ADDR');
        $unique .= $this->getServer('HTTP_USER_AGENT');
        $unique .= $this->getServer('HTTP_ACCEPT_LANGUAGE');
        return md5($unique);
    }
    public function pingAction()
    {
        $ip = $this->getServer('REMOTE_ADDR');
        $hash = $this->_getMyUniqueHash();
        $this->getModel()->updateOnline($hash, $ip);
        $this->getModel()->clearOffline();
        $this->getModel()->removeOldMessages();
        $onlines = $this->getModel()->getOnline();
        $this->setHeader(array('Content-Type' => 'application/json'));
        return json_encode($onlines);
    }
}
session_start();
     $lng = $_GET['lng'];
     if(isset($_SESSION['hotelup'])) {
     
$chatApp = new Controller(); ?><!doctype html>
<html ng-app="ChatApp">
<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $name; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="hotelup, hotel, travel, stay, money" />
	<meta name="author" content="hotelup" />

	<!-- <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet"> -->

	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>

	<?php include 'chat_js_css.php'; ?>
	
<body ng-controller="ChatAppCtrl">

		<div id="page">
    <nav class="hu-nav up black" role="navigation">
			<div class="hu-container">
				<div class="row">
					<div class="col-md-12 text-right hu-contact">
						<ul class="">
							<li><a href="#!"><i class="ti-mobile"></i><?php echo $tel; ?></a></li>
							<li><a href="services.php?lng=bg">BG</a></li>
							<li><a href="services.php?lng=en">EN</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4 col-xs-12">
						<div id="hu-logo"><a href="index.php">Hotel UP<em>.</em></a></div>
					</div>
					<div class="col-xs-8 text-right menu-1">
						<?php if($lng == "en") { ?>
							<ul>
							<?php if(!isset($_SESSION['hotelup'])) { ?>
								<a href="signin.php?lng=en"><li class="nav-login">LOGIN</li></a>
								<?php } ?>
								<a href="indexen.php"><li>Home</li></a>
								<a href="about.php?lng=en"><li>About</li></a>
								<a href="services.php?lng=en"><li>Services</li></a>
								<?php if(isset($_SESSION['hotelup'])) { ?>
								<a href="chat.php?lng=en"><li class="activeNavLink">Chat</li></a>
						<a href="https://maps.google.com?saddr=Current+Location&daddr=<?php echo $lat; ?>,<?php echo $long; ?>&language=bg"><li>Map</li></a>
						<?php } ?>
								<a href="contact.php?lng=en"><li>Contact</li></a>
							</ul>
							<?php } elseif($lng == "bg") { ?>
							<ul>
							<?php if(!isset($_SESSION['hotelup'])) { ?>
								<a href="signin.php?lng=bg"><li class="nav-login">ВХОД</li></a>
								<?php } ?>
								<a href="index.php"><li>Начало</li></a>
								<a href="about.php?lng=bg"><li>За нас</li></a>
								<a href="services.php?lng=bg"><li>Услуги</li></a>
								<?php if(isset($_SESSION['hotelup'])) { ?>
								<a href="chat.php?lng=bg"><li class="activeNavLink">Чат</li></a>
						<a href="https://maps.google.com?saddr=Current+Location&daddr=<?php echo $lat; ?>,<?php echo $long; ?>&language=bg"><li>Карта</li></a>
						<?php } ?>
								<a href="contact.php?lng=bg"><li>За контакти</li></a>
							</ul>
							<?php } ?>
					</div>
				</div>

			</div>
		</nav>

  	<!--<header id="hu-header" class="hu-cover hu-cover-xs hu-cover-smallest" role="banner" style="background-image:url(images/hotel.png);">
  		<div class="overlay"></div>
  		<div class="hu-container head-cont">
  			<div class="row">
  				<div class="col-md-8 col-md-offset-2 text-center">
  					<div class="display-t">
  						<div class="display-tc">
  							<h1 class="animate-box" data-animate-effect="fadeInUp"><?php if($lng == "en") { ?>Chat with the hotel<?php }elseif($lng == "bg") { ?>Чат с хотела<?php } ?></h1>
							<h2 class="animate-box" data-animate-effect="fadeInUp">HOTEL TEST BANSKO</h2>
  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  	</header>-->

    <div class="container chat-xs">
        <div class="box box-warning direct-chat direct-chat-warning">
            <div class="box-body">
                <div class="direct-chat-messages">
                    <div class="direct-chat-msg" ng-repeat="message in messages" ng-if="historyFromId < message.id" ng-class="{'right':!message.me}">
                        <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name" ng-class="{'pull-left':message.me, 'pull-right':!message.me}">{{ message.username }}</span>
                            <span class="direct-chat-timestamp " ng-class="{'pull-left':!message.me, 'pull-right':message.me}">{{ message.date }}</span>
                        </div>
                        <img class="direct-chat-img" src="images/logo.png" alt="">
                        <div class="direct-chat-text right">
                            <span>{{ message.message }}</span>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <form ng-submit="saveMessage()">
                        <div class="input-group">
                            <input type="text" placeholder="Type message..." autofocus="autofocus" class="form-control" ng-model="me.message" ng-enter="saveMessage()">
                            <span class="input-group-btn">
                            <button type="submit" class="btn btn-warning btn-flat">Send</button>
                            </span>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

   </div>

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="js/jquery.countTo.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>

</body>
</html>
<?php } ?>
