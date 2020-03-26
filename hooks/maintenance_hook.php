<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Check whether the site is offline or not.
 *
 */
class Maintenance_hook
{
    public function __construct(){
        log_message('debug','Accessing maintenance hook!');
    }
    
    public function offline_check(){
        if(file_exists(APPPATH.'config/config.php')){
            include(APPPATH.'config/config.php');
            
            $url=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']==='on' ? "https":"http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            if(isset($config['maintenance_mode']) && $config['maintenance_mode'] === TRUE && $_SERVER['REMOTE_ADDR'] !='157.34.98.14')
            {
                if(($url=='http://goodlucktailors.online/vyaparsamiti/Welcome/memberlogin')||($url=='https://goodlucktailors.online/vyaparsamiti/Welcome/memberlogin'))
                {
                    include(APPPATH.'views/errors/html/maintenance.html');
                    exit();
                }
                include(APPPATH.'views/errors/html/maintenance.html');
                    exit();
            }
        }
    }
}
//isset( $_SERVER['REMOTE_ADDR']) and $_SERVER['REMOTE_ADDR'] == 'your_ip'
/*

2
3
4
$ip = $_SERVER['REMOTE_ADDR'];
$allowed = array('1.1.1.1','2.2.2.2'); // these are the IP's that are allowed to view the site.
 
if (file_exists($maintenanceFile) && !in_array($ip, $allowed)) {
    */