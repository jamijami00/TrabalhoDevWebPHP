<?php

use App\Core\BaseModel;

class CompraModel extends BaseModel
{

    public function create($compra)
    {
        try { // conexão com a base de dados
            $sql = "INSERT INTO compras(quantidade_compra, data_compra, valor_compra, id_fornecedor, id_produto, id_funcionario) VALUES (?,?,?,?,?,?)";
            $conn = CompraModel::getConexao();

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $compra->getQuantidadeCompra());
            $stmt->bindValue(2, $compra->getDataCompra());
            $stmt->bindValue(3, $compra->getValorCompra());
            $stmt->bindValue(4, $compra->getIdFornecedor());
            $stmt->bindValue(5, $compra->getIdProduto());
            $stmt->bindValue(6, $compra->getIdFuncionario());
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
            $sql = "SELECT * FROM COMPRAS WHERE id = ?";
            $conn = CompraModel::getConexao();
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
            $sql = "SELECT * FROM COMPRAS";
            $conn = CompraModel::getConexao();
            $stmt = $conn->query($sql);
            $conn = null;
            return $stmt;
        } catch (\PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function update($compra)
    {
        try {
            $sql = "UPDATE COMPRAS SET quantidade_compra=?, data_compra=?, valor_compra=?, id_fornecedor=?, id_produto=?, id_funcionario=? WHERE id = ?";
            $conn = CompraModel::getConexao();

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $compra->getQuantidadeCompra());
            $stmt->bindValue(2, $compra->getDataCompra());
            $stmt->bindValue(3, $compra->getValorCompra());
            $stmt->bindValue(4, $compra->getIdFornecedor());
            $stmt->bindValue(5, $compra->getIdProduto());
            $stmt->bindValue(6, $compra->getIdFuncionario());
            $stmt->execute();
            $conn = null;
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM COMPRAS WHERE id = ?";
            $conn = CompraModel::getConexao();

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1,$id);
            $stmt->execute();
            $conn = null;
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function getTotalCompras()
    {
        try {
            $sql = "SELECT count(*) as total FROM COMPRAS";
            $conn = CompraModel::getConexao();
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
            $sql = "SELECT * FROM COMPRAS LIMIT ?,?";
            $conn = CompraModel::getConexao();
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