<?php

use App\Core\BaseModel;

class CategoriaModel extends BaseModel
{

    public function create($categoria)
    {
        try { // conexão com a base de dados
            $sql = "INSERT INTO categorias(nome_categoria) VALUES (?)";
            $conn = CategoriaModel::getConexao();

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $categoria->getNomeCategoria());
            $stmt->execute();
            $chaveGerada = $conn->lastInsertId();
            $conn = null;
            return $chaveGerada;
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function get($id)
    {
        try {
            $sql = "SELECT * FROM CATEGORIAS WHERE id = ?";
            $conn = CategoriaModel::getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $conn = null;
            return  $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function read()
    {
        try {
            $sql = "SELECT * FROM CATEGORIAS";
            $conn = CategoriaModel::getConexao();
            $stmt = $conn->query($sql);
            $conn = null;
            return $stmt;
        } catch (\PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function update($categoria)
    {
        try {
            $sql = "UPDATE CATEGORIAS SET nome_categoria=? WHERE id = ?";
            $conn = CategoriaModel::getConexao();

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $categoria->getNomeCategoria());
            $stmt->execute();
            $conn = null;
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM CATEGORIAS WHERE id = ?";
            $conn = CategoriaModel::getConexao();

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1,$id);
            $stmt->execute();
            $conn = null;
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function getTotalCategorias()
    {
        try {
            $sql = "SELECT count(*) as total FROM CATEGORIAS";
            $conn = CategoriaModel::getConexao();
            $stmt = $conn->query($sql)->fetch(\PDO::FETCH_ASSOC);
            $conn = null;
            return $stmt['total'];
        } catch (\PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function getRegistroPagina($offset, $numRegistrosPag)
    {
        try {
            $sql = "SELECT * FROM CATEGORIAS LIMIT ?,?";
            $conn = CategoriaModel::getConexao();
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $offset, PDO::PARAM_INT);
            $stmt->bindParam(2, $numRegistrosPag, PDO::PARAM_INT);
            $stmt->execute();
            //$stmt->debugDumpParams();  <- usando para depuração
            $conn = null;
            return $stmt;
        } catch (\PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }
}