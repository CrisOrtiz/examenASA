<?php
class preguntasSql
{
    public static function  indentificarUsuario()
    {
        $query="SELECT * FROM usuario WHERE usuario=? AND password=?";
        return $query;
    }

    public static function  registrarPregunta()
    {
        $query="insert into pregunta (texto,respuesta1,valor1,respuesta2,valor2,respuesta3,valor3,idArea)values(?,?,?,?,?,?,?,?);";
        return $query;
    }

    public static function actualizarPregunta(){
        $query="update pregunta set texto=?,respuesta1=?, valor1=?, respuesta2=?, valor2=?, respuesta3=?, valor3=? where idAspirante=?;";
        return $query;
    }

    

    public static function traerDatosIdSql(){
        $query="SELECT * FROM pregunta where idPregunta=?;";
        return $query;
    }
}
?>
