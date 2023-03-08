<?php
class Postagem{

    public static function selecionaTodos(){
       $con = Connection::getConn();
        
       $sql = "SELECT * FROM postagens ORDER BY id DESC";
       $sql= $con->prepare($sql);
       $sql->execute();

        $resultado = array();
       
       while ($row = $sql->fetchobject('Postagem')) {
            $resultado[] = $row;
       }
       if (!$resultado) {
           throw new Exception("Não foi encontrado nenhum registro no banco de dados");
       }
       return $resultado;
    }

    
    public static function selecionaPorId($idPost)
    {
        $con =Connection::getConn();
        
        $sql = "SELECT * FROM postagens WHERE id=:id";
        $sql= $con->prepare($sql);
        $sql->bindValue(':id',$idPost, PDO::PARAM_INT);
       $sql->execute();

       $resultado = $sql->fetchobject();
       
       if (!$resultado) {
        throw new Exception("Não foi encontrado nenhum registro no banco de dados");
    }else {
        $resultado->comentarios = Comentario ::selecionaComentarios($resultado->id);
    }
    return $resultado;
    }

    public static function insert($dadosPost)
    {
        if (empty($dadosPost['titulo']) OR empty($dadosPost['conteudo'])) {
            throw new Exception("Preencha todos os campos");

            return false;
        }
        $con =Connection::getConn();
        $sql = "INSERT INTO postagens (titulo, conteudo) VALUES (:tit, :cont)";
        $sql= $con->prepare($sql);
        $sql->bindValue(':tit',$dadosPost['titulo']);
        $sql->bindValue(':cont',$dadosPost['conteudo']);
        $res=$sql->execute();

        if ($res == 0) {
            throw new Exception("Falha na inserção");

            return false;
        }
        return true;
        
       
    }
    public static function update($params)
    {
        $con =Connection::getConn();
        $sql = "UPDATE  postagens SET titulo =:tit , conteudo=:cont  WHERE id =:id";
        $sql= $con->prepare($sql);
        $sql->bindValue(':tit',$params['titulo']);
        $sql->bindValue(':cont',$params['conteudo']);
        $sql->bindValue(':id',$params['id']);

        $resultado=$sql->execute();
        
        if ($resultado == 0) {
            throw new Exception("Falha na altera publicaçao");

            return false;
        }
        return true;
        
       
    }
    public static function delete($id)
    {
        $con =Connection::getConn();
        $sql = "DELETE FROM postagens WHERE id =:id";
        $sql= $con->prepare($sql);
        $sql->bindValue(':id',$params['id']);

        $resultado=$sql->execute();
        
        if ($resultado == 0) {
            throw new Exception("Falha na deletar publicaçao");

            return false;
        }
        return true;
        
    }
}

?>