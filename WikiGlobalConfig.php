<?php

if (!defined('DOKU_INC')) die();
if (!defined('DOKU_PLUGIN')) define("DOKU_PLUGIN", DOKU_INC."lib/plugins/");
require_once(DOKU_INC . 'inc/init.php');

/**
 * Description of WikiGlobalConfig
 *
 * @author josep
 */
class WikiGlobalConfig {

    public static function tplIncName() {
        
        global $conf;
        return $conf['template'];
    }
    
    public static function tplIncDir() {
        global $conf;

        if (is_callable('tpl_incdir')) {
            $ret = tpl_incdir();
        }else {
            $ret = DOKU_INC . 'lib/tpl/' . $conf['template'] . '/';
        }
        return $ret;
    }

    public static function getConf($key, $plugin="", $project=""){
        global $conf;
        if (!empty($plugin)){


            if (!empty($project) && isset($conf['plugin'][$plugin])
                && isset($conf['plugin'][$plugin]['project'])
                && isset($conf['plugin'][$plugin]['project'][$project])) {
                    // Retornem el valor del projecte
                    $ret = $conf['plugin'][$plugin]['project'][$project][$key];

            } else {
                if (!isset($conf['plugin'][$plugin])){
                    $conf['plugin'][$plugin] = self::loadPluginConf($plugin);
                }elseif(!isset($conf['plugin'][$plugin][$key])){
                    $conf['plugin'][$plugin] = array_merge(self::loadPluginConf($plugin), $conf['plugin'][$plugin]);
                }

                $ret = $conf['plugin'][$plugin][$key];
            }

        }else if(!isset ($conf[$key])) {
            $ret = self::getConf($key, "ownInit");
        }else {
            $ret = $conf[$key];
        }
        return $ret;
    }

    private static function loadPluginConf($plugin){
        $path = DOKU_PLUGIN . $plugin . '/conf/';
        $conf = array();

        if (@file_exists($path.'default.php')) {
            include($path.'default.php');
        }

        return $conf;
    }

//    private function loadlang($tpl, $plugin=array()){
//        if(!$this->confLoaded){
//            $this->confLoaded=TRUE;
//        }
//    }

}
