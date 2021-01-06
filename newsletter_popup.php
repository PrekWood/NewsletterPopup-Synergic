<?php

if (!defined('_PS_VERSION_')){
    exit;
}

class newsletter_popup extends Module{

    public function __construct(){
        $this->name = 'newsletter_popup';
        $this->tab = 'front_office_features';
        $this->version = '1.0';
        $this->bootstrap = true;
        $this->ps_versions_compliancy = array('min' => '1.7.1.0', 'max' => _PS_VERSION_);
        $this->need_instance = 0;
        $this->author = 'Prekas Nikos';
        $this->displayName = $this->l('Newsletter popup');
        $this->description = $this->l('A popup appears when customer comes for the first time in our site.This popup suggests him to register in our Newsletter');
        parent::__construct();
        //test
    }

    public function install()
    {
        if (!parent::install() || 
            !$this->registerHook('header'))
        {
            return false;
        }
        return true;
    }   

    public function uninstall(){
        return parent::uninstall();
    }

    public function hookHeader($params) {
        $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
        if (!isset($_COOKIE["Newsletter_Popup"]) || $_POST['email']) {
            //this makes sure that the page was not manually refreshed and therefore posted by the form
            if(!$pageWasRefreshed){
                //render assets
                $this->context->controller->registerStylesheet('popupCss',
                    'modules/' . $this->name . '/views/css/popup.css',
                    ['media' => 'all', 'priority' => 0]);
                $this->context->controller->registerJavascript('popupJs',
                    'modules/' . $this->name . '/views/js/popup.js',
                    ['position' => 'bottom', 'priority' => 0]);

                setcookie("Newsletter_Popup", true, 0, "/");
                $this->context->smarty->assign('imgPath',  $this->_path . "img/picture.jpg");
                return $this->display(__FILE__, 'views/templates/front/popup.tpl');
            }
        }
    }
}
?>