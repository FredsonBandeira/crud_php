<?php

class HomeController 
{
    public function index(){
       try {
        //code...
        $colecPostagem = Postagem::selecionaTodos();

        $loader = new \Twig\Loader\FiLesystemLoader('app/view');
        $twig = new \Twig\Environment($loader);
        $template =$twig->load('home.html');

        $parametro = array();
        $parametro['postagens']=$colecPostagem;

        $conteudo = $template->render($parametro);
        echo $conteudo;
        
        

       } catch (Exception $e) {
       echo $e->getMessage();
       }
       
    }
}
?>