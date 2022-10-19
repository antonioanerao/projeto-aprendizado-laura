<?php

namespace Models;

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

}

