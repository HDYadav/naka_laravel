<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Log AS Log;

class LogBuilder{

    private static $r_id = "";
    private static $c_url = "";
    private static $s_time = "";
    public static $debug = 8;
    public static $info = 7;
    public static $notice = 6;
    public static $warning = 5;    
    public static $error = 4;
    public static $critical = 3;
    public static $alert = 2;
    public static $emergency = 1;
    private static $removableKey = ['password', 'username', 'refresh_token','auth_token']; 

    // set a unique request id 
    /**
     * Set a unique request id 
     * that would hepl us debug
     */
    private static function getRequestId() {
        if(empty(self::$r_id)){
            self::$s_time = time();
            self::$r_id = (string) round(microtime(true));
        }
        return self::$r_id;
    }

    /**
     * Function used to retun client URL
     */
    private static function getClientUrl() {
        if(empty(self::$c_url) && PHP_SAPI != 'cli'){
            self::$c_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        }
        return self::$c_url;
    }

    /**
     * Function used to return client IP
     */
    private static function getClientIP() {
        return (PHP_SAPI != 'cli') ? $_SERVER['REMOTE_ADDR'] : PHP_SAPI;
    }
    /**
     * Function used to log error in the file
     */
    protected static function log($logChannel, $logLevel, $data, $module) {       
        $service = "API";
       // $channel = strtolower($logChannel.'.'.'log'); // set the log channel name  
        $channel = $logChannel;
        $module = strtoupper($module); // set the module name name

        $arrData = [
            'c_url' => self::getClientUrl(),
            'c_ip'  => self::getClientIP(), 
            'req_id' => self::getRequestId(),
            'module' => $module,
            'controller' => str_replace("\\","_",debug_backtrace()[2]['class']),
            'function' => debug_backtrace()[2]['function'],
            'line' => debug_backtrace()[1]['line'],
            'exe_time' => time() - self::$s_time,
            'data' => $data,
        ];     
        switch($logLevel) {
            case self::$debug:
                Log::channel($channel)->debug($service,$arrData);
            break;
            case self::$info:
                Log::channel($channel)->info($service,$arrData);
                //Log::channel($channel)->info($service,['response'=> $arrData]);
                break;
            case self::$notice:
                Log::channel($channel)->notice($service,$arrData);
            break;
            case self::$warning:
                Log::channel($channel)->warning($service,$arrData);
            break;
            case self::$error:
                Log::channel($channel)->error($service,$arrData); 
                //Log::channel($logChannel.'errorlog')->error($service,$arrData);     
            break;
            case self::$critical:
                Log::channel($channel)->critical($service,$arrData);
            break;
            case self::$alert:
                Log::channel($channel)->alert($service,$arrData);
            break;
            case self::$emergency:
                Log::channel($channel)->emergency($service,$arrData);
            break;    
            default:
                Log::channel($channel)->warning($service,$arrData);
            break;
        } 
    }

    /**
     * Function for API log
     */
    public static function webLog($logLevel="", $data="", $moduleName="") {
        self::removeKeys($data);
        self::log('home', $logLevel, $data, $moduleName);
    }
 
    /**
     * Function for API log
     */
    public static function apiLog($logLevel="", $data="", $moduleName="") {
        self::removeKeys($data);
        self::log('api', $logLevel, $data, $moduleName);
    }

 
    
    
    /**
     * Function for DB log
     */
    public static function dbLog($logLevel="", $data= [], $moduleName="") {
        self::removeKeys($data);
        self::log('db', $logLevel, $data, $moduleName);
    }

    /* Function to prevent security data from geting logged*/
    private static function removeKeys(&$data)
    {        
        if (is_array($data) && count($data) !== count($data, COUNT_RECURSIVE))
        {
            foreach ($data as $key => $row)
            {
                foreach (self::$removableKey as $removableKey)
                {
                    if (is_array($row) && array_key_exists($removableKey, $row))
                    {
                        unset($data[$key][$removableKey]);
                    }
                }
            }
        }
        else
        {
            foreach (self::$removableKey as $removableKey)
            {
                if (is_array($data) && array_key_exists($removableKey, $data))
                {
                    unset($data[$removableKey]);
                }
            }
        }
    }

    /**
     * Function for batch log
     */
    public static function importbatchLog($logLevel="", $data="", $moduleName="") {
        self::removeKeys($data);
        self::log('importbatch', $logLevel, $data, $moduleName);
    }
}
?>
