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
    $un = $_SESSION['to'];
    $hn = "HOTELUP" . $_SESSION['to'];
        $response = $this->db->query("(SELECT * FROM messages WHERE (username = '$un') OR (username = '$hn')
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
            VALUES (NULL, '{$username}', '{$message}', 'hotelup', NOW())");
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
if(isset($_SESSION['username']) && $_SESSION['role'] == "admin" || $_SESSION['role'] == "rec") { 
     
$chatApp = new Controller(); ?><!doctype html>
<html ng-app="ChatApp">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>HOTELUP CHAT</title>
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="images/favicon.png">
      
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
      <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.cyan-light_blue.min.css">
    <link rel="stylesheet" href="css/adminstyle.css">

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>

	<?php include 'chat_js_css.php'; ?>
	
<body ng-controller="ChatAppCtrl">

	<div id="page">
	
	<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">HOTEL TEST BANSKO</span>
          <div class="mdl-layout-spacer"></div>
          <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
            <a href="logout.php?logout-from-admin-panel" style="text-decoration: none; ">X</a>
          </button>
          <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
            <a href="logout.php?logout-from-admin-panel" style="text-decoration: none;"><li class="mdl-menu__item">Изход</li></a>
          </ul>
        </div>
      </header>
      <div class="demo-drawer mdl-layout__drawer mdl-color--teal-300 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
          <div class="demo-avatar-dropdown">
            <span>  HOTEL UP &copy; 2017</span>
            <div class="mdl-layout-spacer"></div>
            <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
            </button>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
          <?php if($_SESSION['role'] == "admin") { ?>
          <a class="mdl-navigation__link" href="admin.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Начало</a>
          <?php } ?>
          <a class="mdl-navigation__link" href="adminregister.php"><i class="material-icons" role="presentation">add_box</i>Регистрация</a>
          <a class="mdl-navigation__link" href="adminguests.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>Гости</a>
          <?php if($_SESSION['role'] == "admin") { ?>
          <a class="mdl-navigation__link" href="adminservices.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">room_service</i>Услуги</a>
          <?php } ?>
          <a style="color: white;" class="mdl-navigation__link active" href="adminchat.php"><i style="color: white;" class="mdl-color-text--blue-grey-400 material-icons" role="presentation">forum</i>Чат</a>
          <?php if($_SESSION['role'] == "admin") { ?>
          <a class="mdl-navigation__link" href="admindata.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">list</i>Общи данни</a>
          <?php } ?>
        </nav>
      </div>
      <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
            
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid mdl-typography--text-center mdl-cell--hide-tablet mdl-cell--hide-phone ">
             
              
             
            <div class="mdl-tooltip" data-mdl-for="servs">
                      <h6>Брой услуги</h6>
                </div>
          </div>
          <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--12-col">
              <div class="mdl-cell--12-col">
                  <h3 class="mdl-color--teal-300" style="padding: 10px; color: white;">Директен чат със стая номер <?php echo $_SESSION['to']; ?></h3>
                  <hr>
              </div>
               <div class="container">
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
                            <input type="text" placeholder="Type message..." autofocus="autofocus" class="mdl-textfield__input" ng-model="me.message" ng-enter="saveMessage()">
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
            </div>
        </div>
    </div>
          </div>
        </div>
      </main>
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
