<?php

namespace Models;

use Models\Sql\Sql;
use Exception;

class Usuario {

    private int $id;
    private string $nome;
    private string $senha;
    private string $email;
    private int $tipoUsuario;

    /**
     * @param $id
     * @return void
     */
    public function setId($id): void {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param $nome
     * @return void
     */
    public function setNome($nome): void {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getNome(): string {
        return $this->nome;

    }

    /**
     * @param $senha
     * @return void
     */
    public function setSenha($senha): void {
        $this->senha = $senha;
    }

    /**
     * @return string
     */
    public function getSenha(): string {
        return $this->senha;
    }

    /**
     * @param $email
     * @return void
     */
    public function setEmail($email): void {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @param $tipoUsuario
     * @return void
     */
    public function setTipoUsuario($tipoUsuario): void {
        $this->tipoUsuario = $tipoUsuario;
    }

    /**
     * @return int
     */
    public function getTipoUsuario(): int {
        return $this->tipoUsuario;
    }

    /**
     * @param $id
     * @return void
     */
    public function find($id) {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM usuarios WHERE id = :ID", array(
            ":ID" => $id
        ));

        if (count($results) > 0) {
            $this->setData($results[0]);
        }
    }

    public function insert(){
        $sql = new Sql();
        $sql->select("INSERT INTO usuarios (email, nome, senha, tipoUsuario) 
            VALUES (:EMAIL, :NOME, :SENHA, :TIPOUSUARIO)
        ", array(
            ':EMAIL' => $this->getEmail(),
            ':NOME' => $this->getNome(),
            ':SENHA' => $this->getSenha(),
            ':TIPOUSUARIO' => $this->getTipoUsuario()
        ));
    }

    /**
     * @param $data
     * @return void
     */
    public function setData($data): void
    {
        $this->setId($data['id']);
        $this->setNome($data['nome']);
        $this->setEmail($data['email']);
        $this->setSenha($data['senha']);
        $this->setTipoUsuario($data['tipoUsuario']);
    }


    public function __toString(){
        return json_encode(array(
            "id"=>$this->getId(),
            "nome"=>$this->getNome(),
            "email"=>$this->getEmail(),
            "senha"=>$this->getSenha(),
            "tipoUsuario"=>$this->getTipoUsuario()

        ));
    }

}

