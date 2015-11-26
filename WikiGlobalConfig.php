<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WikiGlobalConfig
 *
 * @author josep
 */
class WikiGlobalConfig {
    private static $instance=NULL;
    private $langLoaded;
    private $confLoaded;
    private $pluginsConfLoaded;
    private $pluginsLangLoaded;
    
    private function __construct() {
        $this->langLoaded=FALSE;
        $this->confLoaded=FALSE;
        $this->pluginsConfLoaded = array();
        $this->pluginsLangLoaded = array();
    }
    
    private static function instance(){
        if(!self::$instance){
            self::$instance= new WikiGlobalConfig();
        }
    }
    
    private function tplIncDir() {
            global $conf;
            $this->loadConf();
            
            if ( is_callable( 'tpl_incdir' ) ) {
                    $ret = tpl_incdir();
            } else {
                    $ret = DOKU_INC . 'lib/tpl/' . $conf['template'] . '/';
            }

            return $ret;
    }
    
    private function loadConf($tpl, $plugin=array()){
        if(!$this->confLoaded){
            //LOAD
            $this->confLoaded=TRUE;
        }
    }
    
    private function loadlang($tpl, $plugin=array()){
        if(!$this->confLoaded){
            //LOAD
            $this->confLoaded=TRUE;
        }
    }
    
}
