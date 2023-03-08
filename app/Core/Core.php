<?php

class Core{
    public function start($urLGet)
    {
        if (isset($urLGet['metodo'])) {
            $acao  =$urLGet['metodo'];
        }else {
            $acao  ='index';
        }
        
        
        if(isset($urLGet['pagina'])){
        $controller=ucfirst($urLGet['pagina'].'Controller');
       
        }else {
            $controller= 'HomeController';
        }
        
       if (!class_exists($controller)) {
            $controller='ErroController';
       }
       
       if (isset($urLGet['id']) && $urLGet['id'] != null) {
            $id = $urLGet['id'];
       }
       else {
         $id = null;
       }
       call_user_func_array(array(new $controller, $acao), array('id' => $id));
    }
}
?>