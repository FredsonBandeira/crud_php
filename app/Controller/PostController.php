<?php

class PostController 
{
    public function index($params){

       try {
        $postagem = Postagem::selecionaPorId($params);
        
        $loader = new \Twig\Loader\FiLesystemLoader('app/view');
        $twig = new \Twig\Environment($loader);
        $template =$twig->load('single.html');

        $parametro = array();
        $parametro['id']=$postagem->id;
        $parametro['titulo']=$postagem->titulo;
        $parametro['conteudo']=$postagem->conteudo;
       
        $parametro['comentarios']=$postagem->comentarios;

        
        $conteudo = $template->render($parametro);
        echo $conteudo;
        
        

       } catch (Exception $e) {
       echo $e->getMessage();
       }
       
    }

    public function addComent()
    { 
        try {
            Comentario::inserir($_POST);
            header('location:http://localhost/crudphp/?pagina=post&id='.$_POST['id']);
           
        } catch (Exception $e) {
            echo '<script> alert("'.$e->getMessage().'")</script>';
            echo '<script> location.href="http://localhost/crudphp/?pagina=post&id='.$_POST['id'].'"</script>';
        }
        
    }
}
?>