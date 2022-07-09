<?php

use App\Core\BaseModel;

class ProdutoModel extends BaseModel
{

    public function create($produto)
    {
        try { // conexão com a base de dados
            $sql = "INSERT INTO produtos(nome_produto, descricao, preco_compra, preco_venda, quantidade_disponivel, liberado_venda, id_categoria) VALUES (?,?,?,?,?,?,?)";
            $conn = ProdutoModel::getConexao();

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $produto->getNomeProduto());
            $stmt->bindValue(2, $produto->getDescricao());
            $stmt->bindValue(3, $produto->getPrecoCompra());
            $stmt->bindValue(4, $produto->getPrecoVenda());
            $stmt->bindValue(5, $produto->getQuantidadeDisponivel());
            $stmt->bindValue(6, $produto->getLiberadoVenda());
            $stmt->bindValue(7, $produto->getIdCategoria());
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
            $sql = "SELECT * FROM PRODUTOS WHERE id = ?";
            $conn = ProdutoModel::getConexao();
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
            $sql = "SELECT * FROM PRODUTOS";
            $conn = ProdutoModel::getConexao();
            $stmt = $conn->query($sql);
            $conn = null;
            return $stmt;
        } catch (\PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function update($produto)
    {
        try {
            $sql = "UPDATE PRODUTOS SET nome_produto=?, descricao=?, preco_compra=?, preco_venda=?, quantidade_disponivel=?, liberado_venda=?, id_categoria=? WHERE id = ?";
            $conn = ProdutoModel::getConexao();

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $produto->getNomeProduto());
            $stmt->bindValue(2, $produto->getDescricao());
            $stmt->bindValue(3, $produto->getPrecoCompra());
            $stmt->bindValue(4, $produto->getPrecoVenda());
            $stmt->bindValue(5, $produto->getQuantidadeDisponivel());
            $stmt->bindValue(6, $produto->getLiberadoVenda());
            $stmt->bindValue(7, $produto->getIdCategoria());
            $stmt->execute();
            $conn = null;
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM PRODUTOS WHERE id = ?";
            $conn = ProdutoModel::getConexao();

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1,$id);
            $stmt->execute();
            $conn = null;
        } catch (PDOException $e) {
            die('Query falhou: ' . $e->getMessage());
        }
    }

    public function getTotalProdutos()
    {
        try {
            $sql = "SELECT count(*) as total FROM PRODUTOS";
            $conn = ProdutoModel::getConexao();
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
            $sql = "SELECT * FROM PRODUTOS LIMIT ?,?";
            $conn = ProdutoModel::getConexao();
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