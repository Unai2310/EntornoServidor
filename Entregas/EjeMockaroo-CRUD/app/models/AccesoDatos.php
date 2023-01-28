<?php

/*
 * Acceso a datos con BD Usuarios : 
 * Usando la librería mysqli
 * Uso el Patrón Singleton :Un único objeto para la clase
 * Constructor privado, y métodos estáticos 
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    
    public static function getModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    

   // Constructor privado  Patron singleton
    private function __construct(){

        $this->dbh = new mysqli(DB_SERVER,DB_USER,DB_PASSWD,DATABASE);
         
      if ( $this->dbh->connect_error){
         die(" Error en la conexión ".$this->dbh->connect_errno);
        } 

    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            // Cierro la base de datos
            $obj->dbh->close();
            self::$modelo = null; // Borro el objeto.
        }
    }


    // Devuelvo cuantos filas tiene la tabla
    public function numClientes ():int {
      $result = $this->dbh->query("SELECT id FROM Clientes");
      $num = $result->num_rows;  
      return $num;
    } 
    

    // SELECT Devuelvo la lista de Usuarios
    public function getClientes ($primero,$cuantos):array {
        $tuser = [];
        // Crea la sentencia preparada
        $stmt_usuarios  = $this->dbh->prepare("select * from Clientes limit $primero,$cuantos");
        // Si falla termina el programa
        if ( $stmt_usuarios == false) die (__FILE__.':'.__LINE__.$this->dbh->error);
        // Ejecuto la sentencia
        $stmt_usuarios->execute();
        // Obtengo los resultados
        $result = $stmt_usuarios->get_result();
        // Si hay resultado correctos
        if ( $result ){
            // Obtengo cada fila de la respuesta como un objeto de tipo Usuario
            while ( $user = $result->fetch_object('Cliente') ){
               $tuser[]= $user;
            }
        }
        // Devuelvo el array de objetos
        return $tuser;
    }
    
      
    // SELECT Devuelvo un usuario o false
    public function getCliente (int $id) {
        $cli = false;
        
        $stmt_usuario   = $this->dbh->prepare("select * from Clientes where id =?");
        if ( $stmt_usuario == false) die ($this->dbh->error);

        // Enlazo $login con el primer ? 
        $stmt_usuario->bind_param("i",$id);
        $stmt_usuario->execute();
        $result = $stmt_usuario->get_result();
        if ( $result ){
            $cli = $result->fetch_object('Cliente');
        }
        
        return $cli;
    }

    public function existeUser (String $login) {
        $user = false;
        
        $stmt_usuario = $this->dbh->prepare("select * from User where login =?");
        if ( $stmt_usuario == false) die ($this->dbh->error);
  
        $stmt_usuario->bind_param("s",$login);
        $stmt_usuario->execute();
        $result = $stmt_usuario->get_result();
        if ( $result ){
            $user = $result->fetch_object();
        }
        
        return $user;
    }
     
    public function getClienteSiguiente($id, $clave){

        $cli = false;
        
        $stmt_usuario   = $this->dbh->prepare("select * from Clientes where ".$clave." > ? ORDER BY ".$clave." ASC limit 1");
        if ( $stmt_usuario == false) die ($this->dbh->error);

        $stmt_usuario->bind_param("s",$id);
        $stmt_usuario->execute();
        $result = $stmt_usuario->get_result();
        if ( $result ){
            $cli = $result->fetch_object('Cliente');
        }
        
        return $cli;

    }

    public function getClienteAnterior($id,$clave){

        $cli = false;
        
        $stmt_usuario   = $this->dbh->prepare("select * from Clientes where ".$clave." < ? ORDER BY ".$clave." DESC limit 1");
        if ( $stmt_usuario == false) die ($this->dbh->error);

        $stmt_usuario->bind_param("s",$id);
        $stmt_usuario->execute();
        $result = $stmt_usuario->get_result();
        if ( $result ){
            $cli = $result->fetch_object('Cliente');
        }

        return $cli;

    }

    public function getClientesOrden($clave, $primero, $cuantos) {
        $tuser = [];
        $stmt_usuarios  = $this->dbh->prepare("select * from Clientes order by $clave limit $primero,$cuantos");

        if ( $stmt_usuarios == false) die (__FILE__.':'.__LINE__.$this->dbh->error);
        $stmt_usuarios->execute();
        $result = $stmt_usuarios->get_result();
        if ( $result ){
            while ( $user = $result->fetch_object('Cliente') ){
               $tuser[]= $user;
            }
        }
        return $tuser;
    }

    public function emailRepetido($email) {

        $stmt_usuario   = $this->dbh->prepare("select * from Clientes where email =?");
        if ( $stmt_usuario == false) die ($this->dbh->error);
        
        $stmt_usuario->bind_param("s",$email);
        $stmt_usuario->execute();
        $result = $stmt_usuario->get_result();
        if ( $result ){
            $cli = $result->fetch_object('Cliente');
        }
        if (isset($cli)) {
            return true;
        } else {
            return false;
        }
    }

    public function emailRepetidoMod($email) {
        $id = "";

        $stmt_usuario = $this->dbh->prepare("select id from Clientes where email =?");
        if ( $stmt_usuario == false) die ($this->dbh->error);
        
        $stmt_usuario->bind_param("s",$email);
        $stmt_usuario->execute();
        $result = $stmt_usuario->get_result();
        if ( $result ){
            $id = $result->fetch_row();
        }

        return $id;
        
    }

    // UPDATE TODO
    public function modCliente($cli):bool{
      
        $stmt_moduser   = $this->dbh->prepare("UPDATE Clientes set first_name=?,last_name=?,email=?,".
         "gender=?, ip_address=?,telefono=? WHERE id=?");
        if ( $stmt_moduser == false) die ($this->dbh->error);

        $stmt_moduser->bind_param("ssssssi",$cli->first_name,$cli->last_name,$cli->email,
                    $cli->gender,$cli->ip_address,$cli->telefono,$cli->id);
        $stmt_moduser->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }

  
    //INSERT 
    public function addCliente($cli):bool{
       
        // El id se define automáticamente por autoincremento.
        $stmt_creauser  = $this->dbh->prepare(
            "INSERT INTO `Clientes`( `first_name`, `last_name`, `email`, `gender`, `ip_address`, `telefono`)".
            "Values(?,?,?,?,?,?)");
        if ( $stmt_creauser == false) die ($this->dbh->error);

        $stmt_creauser->bind_param("ssssss",$cli->first_name,$cli->last_name,$cli->email,
        $cli->gender,$cli->ip_address,$cli->telefono);
        $stmt_creauser->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }

    public function addUser($us):bool{
       
        // El id se define automáticamente por autoincremento.
        $stmt_creauser  = $this->dbh->prepare(
            "INSERT INTO `User`( `login`, `passwd`, `rol`)".
            "Values(?,?,?)");
        if ( $stmt_creauser == false) die ($this->dbh->error);

        $stmt_creauser->bind_param("sss",$us->login,$us->passwd,$us->rol);
        $stmt_creauser->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }

   
    //DELETE 
    public function borrarCliente(int $id):bool {
        $stmt_boruser   = $this->dbh->prepare("delete from Clientes where id =?");
        if ( $stmt_boruser == false) die ($this->dbh->error);
       
        $stmt_boruser->bind_param("i", $id);
        $stmt_boruser->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }   
    
    
     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }

    
}



