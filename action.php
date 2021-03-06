<?php
/**
 * @author Josep Cañellas <jcanell4@ioc.cat>
 */
if (!defined('DOKU_INC')) die();
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'action.php');
require_once(DOKU_PLUGIN.'ownInit/init.php');
require_once(DOKU_INC.'inc/common.php');

class action_plugin_ownInit extends DokuWiki_Action_Plugin {

    function register(Doku_Event_Handler $controller) {
        $controller->register_hook('DOKUWIKI_STARTED', 'BEFORE', $this, 'init_ownInit');
        $controller->register_hook('TPL_METAHEADER_OUTPUT', 'BEFORE', $this, 'init_header_output');
    }

    function init_ownInit(&$event, $param) {
        own_init($this->getPluginName());
    }

    function init_header_output(&$event, $param) {
        $this->loaddojo($event);
        //$this->loadjquery($event);
    }

    private function loadjquery(&$event) {
        //TO DO
    }

    private function loaddojo(&$event) {
        global $conf;
        global $INFO;
        if (isset($INFO["isDojoLoaded"]) && $INFO["isDojoLoaded"]) {
            return;
        }
        $INFO["isDojoLoaded"] = true;

        $event->data["link"][] = array ("rel" => "stylesheet",
                                        "href" => $this->getConf('dojo_theme_base')
                                                  .$this->getConf('dojo_theme')
                                                  .'/'.$this->getConf('dojo_theme')
                                                  .'.css',
                                        "media" => "screen"
        );

        $event->data["script"][] = array(
                "type" => "text/javascript",
                "_data" => "var dojoConfig = {\n".
                        "  parseOnLoad:true,\n".
                        "  async:true,\n".
                        "  baseUrl: '/iocjslib/',\n".
                        "  tlmSiblingOfDojo: false,\n".
                        "  locale: \"".hsc($conf["lang"])."\",\n".
                        "  packages: [\n".
                        "    {\"name\":\"ioc\",\"location\":\"/iocjslib/ioc\"},\n".
                        "    {\"name\":\"dojo\",\"location\":\"".$this->getConf('dojo_url_base')."dojo\"},\n".
                        "    {\"name\":\"dijit\",\"location\":\"".$this->getConf('dojo_url_base')."dijit\"},\n".
                        "    {\"name\":\"dojox\",\"location\":\"".$this->getConf('dojo_url_base')."dojox\"}\n".
                        "  ]\n".
                        "};\n"
        );

        $event->data["script"][] = array (
                "type" => "text/javascript",
                "charset" => "utf-8",
                "_data" => "",
                "src" =>  $this->getConf('dojo_url'),
        );

        $event->data["script"][] = array (
                "type" => "text/javascript",
                "charset" => "utf-8",
                "_data" => "require([\"dojo/query\",\"dojo/NodeList-dom\",\"dojo/domReady!\"], \n".
                            "function(query){\n".
                                "   query('body').addClass(\"".$this->getConf('dojo_theme')."\");\n".
                            "});\n",
        );
    }

}

