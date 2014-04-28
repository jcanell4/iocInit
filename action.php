<?php
/**
 * @author     Josep Cañellas <jcanell4@ioc.cat>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'action.php');
require_once(DOKU_PLUGIN.'ownInit/init.php');

class action_plugin_ownInit extends DokuWiki_Action_Plugin {
    function register(&$controller) {
        $controller->register_hook('DOKUWIKI_STARTED', 'BEFORE', $this, 'init_ownInit');
        $controller->register_hook('TPL_METAHEADER_OUTPUT', 'BEFORE', $this, 'init_header_output');
    }

    function init_ownInit(&$event, $param) {
//        own_init();
    }
    
    function init_header_output(&$event, $param) {
        $this->loaddojo($event);
        //$this->loadjquery($event);
    }
    
    
    private function loadjquery(&$event) {
        //TO DO
    }
    
    private function loaddojo(&$event) {
        global $INFO;
        if(isset($INFO["isDojoLoaded"])&& $INFO["isDojoLoaded"]){
            return;
        }
        
        $INFO["isDojoLoaded"]=true;
        $event->data["link"][] = array ("rel" => "stylesheet",
                                    "href" => $this->getConf('dojo_theme_base')
                                              .$this->getConf('dojo_theme')
                                              .'/'.$this->getConf('dojo_theme')
                                              .'.css', 
                                    "media" => "screen");
        $event->data["script"][] = array( 
                "type" => "text/javascript",
                "charset" => "utf-8",
                "_data" => "var dojoConfig = {\n".
                        "   parseOnLoad:true,\n".
                        "   async:true,\n".
                        "   baseUrl: '/iocjslib/',\n".
                        "   tlmSiblingOfDojo: false,\n".
                        "   packages: [\n".
                        "       {\"name\":\"ioc\",\"location\":\"/iocjslib/ioc\"},\n".
                        "       {\"name\":\"dojo\",\"location\":\"//ajax.googleapis.com/ajax/libs/dojo/1.8/dojo\"},\n".
                        "       {\"name\":\"dijit\",\"location\":\"//ajax.googleapis.com/ajax/libs/dojo/1.8/dijit\"}\n".
                        "   ]\n".
                        "};",);
        $event->data["script"][] = array (
                "type" => "text/javascript",
                "charset" => "utf-8",
                "_data" => "",
                "src" =>  $this->getConf('dojo_url'),);
    }
}        
