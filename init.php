<?php
if (!defined('DOKU_INC')) die();

function own_init(){
    global $INFO;
    global $USERINFO;
    global $JSINFO;
    global $conf;
    $ownConfigLoaded = array();
    
    setOwnConfig($ownConfigLoaded);

    if(isset($USERINFO) && isset($USERINFO['grps'])){
        $conf['ns_manager_grp']=$ownConfigLoaded['ns_manager_grp'];
        $INFO['isnsmanager'] = in_array($ownConfigLoaded['ns_manager_grp'], 
                                        $USERINFO['grps']);        
    }
    $conf = array_merge($conf, $ownConfigLoaded);
    
    if(!isset($conf["notificationdir"])){
        $conf["notificationdir"]=fullpath(DOKU_INC.$conf['savedir'].'/'."notifications");
    }else{
        $conf["notificationdir"]=fullpath(DOKU_INC.$conf['savedir'].'/'.$conf["notificationdir"]);
    }
    if(!isset($conf["mdprojects"])){
        $conf["mdprojects"]=fullpath(DOKU_INC.$conf['savedir'].'/'."mdprojects");
    }else{
        $conf["mdprojects"]=fullpath(DOKU_INC.$conf['savedir'].'/'.$conf["mdprojects"]);
    }
    
//    $conf['dojo_theme']=$ownConfigLoaded['dojo_theme'];
//    $JSINFO['dojo_theme']=  $ownConfigLoaded['dojo_theme'];
//    $conf['sectokParamName']=$ownConfigLoaded['sectokParamName'];
    $JSINFO['sectokParamName']=$ownConfigLoaded['sectokParamName'];
//    $conf['storeDataParamName']=$ownConfigLoaded['storeDataParamName'];
    $JSINFO['storeDataParamName'] = $ownConfigLoaded['storeDataParamName'];
//    $conf['nsTree_html_id']=$ownConfigLoaded['nsTree_html_id'];
//    $JSINFO['nsTree']['html_id']= $ownConfigLoaded['nsTree_html_id'];
//    $conf['nsTree_html_id']=$ownConfigLoaded['nsTree_html_id'];
//    $JSINFO['nsTree']['html_id']=$ownConfigLoaded['nsTree_html_id'];
}

function setOwnConfig(& $ownConfigLoaded){
        $conf = array();
        $configFile = (dirname(__FILE__)).'/conf/default.php';
        if (@file_exists($configFile)) {
            include($configFile);
        }
        $ownConfigLoaded = $conf;    
}

?>
