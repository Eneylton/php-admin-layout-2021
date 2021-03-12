<?php 

namespace App\Entidy;

use \App\Db\Database;

use \PDO;


class Vaga{
    
    /** 
     * @var integer */
    public $id;

    /**
     * @var string
     */
    public $titulo;

    /**
     * @var string
     */
    public $descricao;

    /**
     * @var string(s/n)
     */
    public $ativo;

    /**
     * @var string
     */
    public $data;

    /**
     * @return boolean
     */
    public function cadastar(){

        $this-> data = date('Y-m-d H:i:s');

        $obdataBase = new Database('vagas');  
        
        $this->id = $obdataBase->insert([
          
            'titulo'       => $this->titulo, 
            'descricao'    => $this->descricao, 
            'ativo'        => $this->ativo, 
            'data'         => $this->data 

        ]);

        return true;

    }

public static function getVagas($where = null, $order = null, $limit = null){

    return (new Database ('vagas'))->select($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}

public static function getVagasUsuarios($where = null, $order = null, $limit = null){

    return (new Database ('usuarios'))->select($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}

public static function getQuantidadeVagas($where = null){

    return (new Database ('vagas'))->select($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;

}


public static function getVagasID($id){
    return (new Database ('vagas'))->select('id = ' .$id)
                                   ->fetchObject(self::class);
 
}

public function atualizar(){
    return (new Database ('vagas'))->update('id = ' .$this-> id, [

                                                'titulo'       => $this->titulo, 
                                                'descricao'    => $this->descricao, 
                                                'ativo'        => $this->ativo, 
                                                'data'         => $this->data 

    ]);
  
}

public function excluir(){
    return (new Database ('vagas'))->delete('id = ' .$this->id);
  
}

}