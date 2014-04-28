<?php
/**
 * Options for the dokuwiki_ioc plugin
 * 
 * @author     Josep Cañellas <jcanell4@ioc.cat>
 */

$meta['jquery_url']   = array('string');
$meta['dojo_theme']   = array('multichoice', '_choices' => array('claro','soria','tundra','nihilo'));
$meta['dojo_url']     = array('string');
$meta['dojo_theme_base'] = array('string');
$meta['ns_manager_grp'] = array('string');
$meta['sectokParamName'] = array('string');
$meta['nsTree_html_id'] = array('string');
$meta['storeDataParamName'] = array('string');