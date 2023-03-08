<?php
class Comentario{

    public static function selecionaComentarios($idPost){
       $con = Connection::getConn();
        
       $sql = "SELECT * FROM comentario WHERE id_postagem= :id";
       $sql= $con->prepare($sql);
       $sql->bindValue(':id',$idPost, PDO::PARAM_INT);
       $sql->execute();

        $resultado = array();
       
       while ($row = $sql->fetchobject('Comentario')) {
            $resultado[] = $row;
       }
    //    if (!$resultado) {
    //        throw new Exception("Nenhum comentario");
    //    }
       return $resultado;
    }
    public static function inserir($reqPost)
    {
        $con = Connection::getConn();
        
        $sql = "INSERT INTO comentario (nome, mensagem, id_postagem) VALUES (:nom, :msg, :idp)";
        $sql= $con->prepare($sql);
        $sql->bindValue(':nom',$reqPost['nome']);
        $sql->bindValue(':msg',$reqPost['msg']);
        $sql->bindValue(':idp',$reqPost['id']);
        $sql->execute();
 
         if($sql->rowCount()){
            return true;
         }
        
        
        throw new Exception("Falha na insercao");
        }
        
    }


?>