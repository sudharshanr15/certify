<?php

namespace Certify\Certify\core;

class View{
    private $template_root = __DIR__ . "/../templates";
    private $template_root_admin = __DIR__ . "/../templates/admin";

    public function render($page){
        $master = $this->renderMaster();
        $page = $this->renderPage($page);
        
        echo str_replace("{{content}}", $page, $master);
    }

    
    public function renderMaster(){
        ob_start();
        include $this->template_root . "/_master.php";
        return ob_get_clean();
    }
    
    public function renderPage($page){
        ob_start();
        include $this->template_root . "/$page";
        return ob_get_clean();
    }

    public function renderAdmin($page){
        $master = $this->renderAdminMaster();
        $page = $this->renderAdminPage($page);
        
        echo str_replace("{{content}}", $page, $master);
    }

    public function renderAdminMaster(){
        ob_start();
        include $this->template_root_admin . "/_master.php";
        return ob_get_clean();
    }

    public function renderAdminPage($page){
        ob_start();
        include $this->template_root_admin . "/$page";
        return ob_get_clean();
    }

}