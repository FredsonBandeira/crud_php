<?php

class SobreController 
{
    public function index(){

     
        
        $loader = new \Twig\Loader\FiLesystemLoader('app/view');
        $twig = new \Twig\Environment($loader);
        $template =$twig->load('sobre.html');

        $parametro = array();
        
        
        $conteudo = $template->render($parametro);
        echo $conteudo;
        
        

     
       
    }
}
?>