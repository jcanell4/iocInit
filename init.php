<?php
if (!defined('DOKU_INC')) die();

function own_init($plgName="ownInit"){
    global $INFO;
    global $USERINFO;
    global $JSINFO;
    global $conf;
    $ownConfigLoaded = array();

    setOwnConfig($ownConfigLoaded);
    if(isset($conf["plugin"][$plgName])){
        $ownConfigLoaded = array_merge($ownConfigLoaded, $conf["plugin"][$plgName]);
    }

    if(isset($USERINFO) && isset($USERINFO['grps'])){
        $conf['ns_manager_grp']=$ownConfigLoaded['ns_manager_grp'];
        $INFO['isnsmanager'] = in_array($ownConfigLoaded['ns_manager_grp'],
                                        $USERINFO['grps']);
    }
    $conf = array_merge($conf, $ownConfigLoaded);

    $conf['notificationdir']    = fullpath(DOKU_INC.$conf['savedir'].'/'.((isset($conf['notificationdir'])) ? $conf['notificationdir'] : "notifications"));
    $conf['mdprojects']         = fullpath(DOKU_INC.$conf['savedir'].'/'.((isset($conf['mdprojects'])) ? $conf['mdprojects'] : "mdprojects"));
    $conf['metaprojectdir']     = fullpath(DOKU_INC.$conf['savedir'].'/'.((isset($conf['metaprojectdir'])) ? $conf['metaprojectdir'] : "project_meta"));
    $conf['revisionprojectdir'] = fullpath(DOKU_INC.$conf['savedir'].'/'.((isset($conf['revisionprojectdir'])) ? $conf['revisionprojectdir'] : "project_attic"));

    $JSINFO['sectokParamName']=$ownConfigLoaded['sectokParamName'];
    $JSINFO['storeDataParamName'] = $ownConfigLoaded['storeDataParamName'];
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
