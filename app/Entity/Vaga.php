<?php

namespace App\Entity;

use App\Db\Database;
use PDO;


class Vaga{

    /**
     * Identificador unico da vaga
     * @var integer
     */
    public $id;

    /**
     * Titulo da vaga
     * @var string
     */
    public $titulo;

    /**
     * descricao da vaga (pode conter html)
     * @var string
     */
    public $descricao;

    /**
     * define se a vaga esta ativa
     * @var string(s/n)
     */
    public $ativo;

    /**
     * data da publicacao da vaga
     * @var string
     */

    /**
     * Metodo responsavel por cadastrar uma nova vaga no banco
     * @return boolean
     */
    public function cadastrar()
    {
        //DEFINIR DATA
        $this->data = date('Y-m-d H:i:s');

        //INSERIR A VAGA NO BANCO
        $obDatabase = new Database('vagas');
        $this->id = $obDatabase->insert([
                                            'titulo' => $this->titulo,
                                            'descricao' => $this->descricao,
                                            'ativo' => $this->ativo,
                                            'data' => $this->data
                                        ]);


        //RETORNAR SUCESSO
        return true;
  }

    /**
     * Metodo responsavel por atualizar a vaga no banco
     * @return boolean
     */
    public function  atualizar()
    {
        return (new Database('vagas'))->update('id - ' .$this->id, [
                                                                            'titulo' => $this->titulo,
                                                                            'descricao' => $this->descricao,
                                                                            'ativo' => $this->ativo,
                                                                            'data' => $this->data
                                                                           ]);
  }

    /**
     * Metodo responsavel por excluir a vaga do banco
     * @return boolean
     */
    public function excluir()
    {
        return (new Database('vagas'))->delete('id = '.$this->id);
    }
    /**
     * Método responsável por obter vagas do banco de dados
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */
    public static function getVagas($where = null, $order = null, $limit = null)
    {
        return (new Database('vagas'))->select($where,$order,$limit)
                                            ->fetchAll(PDO::FETCH_CLASS,self::class);
  }

    /**
     * Metodo responsavel por buscar uma vaga com base em seu ID
     * @param integer $id
     * @return Vaga
     */
    public static function  getVaga($id){
        return (new Database('vagas'))->select('id = '.$id)
                                            ->fetchObject(self::class);
  }
}
