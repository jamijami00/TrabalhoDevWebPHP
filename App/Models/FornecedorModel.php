<?php

use App\Core\BaseModel;

class FornecedorModel extends BaseModel
{

    public function create($fornecedor)
    {
        try { // conexão com a base de dados
            $sql = "INSERT INTO FORNECEDORES(razao_social, cnpj, endereco, bairro, cidade, uf, cep, telefone, email) VALUES (?,?,?,?,?,?,?,?,?)";
            $conn = FornecedorModel::getConexao();

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $fornecedor->getRazaoSocial());
            $stmt->bindValue(2, $fornecedor->getCnpj());
            $stmt->bindValue(3, $fornecedor->getEndereco());
            $stmt->bindValue(4, $fornecedor->getBairro());
            $stmt->bindValue(5, $fornecedor->getCidade());
            $stmt->bindValue(6, $fornecedor->getUf());
            $stmt->bindValue(7, $fornecedor->getCep());
            $stmt->bindValue(8, $fornecedor->getTelefone());
            $stmt->bindValue(9, $fornecedor->getEmail());
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
            $sql = "SELECT * FROM FORNECEDORES WHERE id = ?";
            $conn = FornecedorModel::getConexao();
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
            $sql = "SELECT * FROM FORNECEDORES";
            $conn = FornecedorModel::getConexao();
            $stmt = $conn->query($sql);
            $conn = null;
            return $stmt;
        } catch (\PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function update($fornecedor)
    {
        try {
            $sql = "UPDATE FORNECEDORES SET razao_social=?, cnpj=?, endereco=?, bairro=?, cidade=?, uf=?, cep=?, telefone=?, email=? WHERE id = ?";
            $conn = FornecedorModel::getConexao();

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $fornecedor->getRazaoSocial());
            $stmt->bindValue(2, $fornecedor->getCnpj());
            $stmt->bindValue(3, $fornecedor->getEndereco());
            $stmt->bindValue(4, $fornecedor->getBairro());
            $stmt->bindValue(5, $fornecedor->getCidade());
            $stmt->bindValue(6, $fornecedor->getUf());
            $stmt->bindValue(7, $fornecedor->getCep());
            $stmt->bindValue(8, $fornecedor->getTelefone());
            $stmt->bindValue(9, $fornecedor->getEmail());
            $stmt->execute();
            $conn = null;
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM FORNECEDORES WHERE id = ?";
            $conn = FornecedorModel::getConexao();

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1,$id);
            $stmt->execute();
            $conn = null;
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function getTotalFornecedores()
    {
        try {
            $sql = "SELECT count(*) as total FROM FORNECEDORES";
            $conn = FornecedorModel::getConexao();
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
            $sql = "SELECT * FROM FORNECEDORES LIMIT ?,?";
            $conn = FornecedorModel::getConexao();
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