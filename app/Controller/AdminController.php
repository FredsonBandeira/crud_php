<?php

class AdminController 
{
    public function index(){

       
        $loader = new \Twig\Loader\FiLesystemLoader('app/view');
        $twig = new \Twig\Environment($loader);
        $template =$twig->load('admin.html');

        $objPostagens = Postagem::selecionaTodos();

        $parametro = array();
        $parametro['postagens']= $objPostagens;
        
        $conteudo = $template->render($parametro);
        echo $conteudo;
        
    
    }

    public  function create()
    {
        $loader = new \Twig\Loader\FiLesystemLoader('app/view');
        $twig = new \Twig\Environment($loader);
        $template =$twig->load('create.html');

        $parametro = array();
        
        $conteudo = $template->render($parametro);
        echo $conteudo;
    }
    public  function insert()
    {
        try {
            Postagem::insert($_POST);
            echo '<script> alert("Publicado com sucesso")</script>';
            echo '<script> location.href="http://localhost/crudphp/?pagina=admin&metodo=index"</script>';
            header('');

        } catch (Exception $e) {
            echo '<script> alert("'.$e->getMessage().'")</script>';
            echo '<script> location.href="http://localhost/crudphp/?pagina=admin&metodo=create"</script>';
        }
       
    }
    public function change($paramId){
        $loader = new \Twig\Loader\FiLesystemLoader('app/view');
        $twig = new \Twig\Environment($loader);
        $template =$twig->load('update.html');

        $post = Postagem::selecionaPorId($paramId);

        $parametro = array();
        $parametro['id']=$post->id;
        $parametro['titulo']=$post->titulo;
        $parametro['conteudo']=$post->conteudo;

        $conteudo = $template->render($parametro);
        echo $conteudo;
    }
    public function update()
    {
        try {
            Postagem::update($_POST);
            echo '<script> alert("Alterado com sucesso")</script>';
            echo '<script> location.href="http://localhost/crudphp/
            ?pagina=admin&metodo=index"</script>';
           
        } catch (Exception $e) {
            echo '<script> alert("'.$e->getMessage().'")</script>';
            echo '<script> location.href="http://localhost/crudphp/?
            pagina=admin&metodo=change&id='.$_POST['id'].'"</script>';
        }
        
    }

    public function delete($paramId){
        try {
            Postagem::delete($paramId);
            echo '<script> alert("Alterado com sucesso")</script>';
            echo '<script> location.href="http://localhost/crudphp/?pagina=admin&metodo=index"</script>';
           
        } catch (Exception $e) {
            echo '<script> alert("'.$e->getMessage().'")</script>';
            echo '<script> location.href="http://localhost/crudphp/?pagina=admin&metodo=index"</script>';
        }
        


    }

    


}
?>