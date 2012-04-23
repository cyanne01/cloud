<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Systemdata extends CI_Model {
    function getLoad(){
        $output = array('label' => 'label-success', 'load' => array('9.99', '9.99', '9.99'));
        
        $load = sys_getloadavg();
        
        $output['load'][0] = number_format($load[0],2);
        $output['load'][1] = number_format($load[1],2);
        $output['load'][2] = number_format($load[2],2);
        
        if ($load[0] > 1.5 || $load[1] > 1.5 || $load[2] > 1.5){
            if ($load[0] > 2.5 || $load[1] > 2.5 || $load[2] > 2.5){
                $output['label'] = 'label-important';
            } else {
                $output['label'] = 'label-warning';
            }
        }
        
        return $output;
    }
}

?>