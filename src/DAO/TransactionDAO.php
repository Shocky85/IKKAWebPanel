<?php

namespace IKKA\DAO;

use IKKA\Domain\Transaction;

/**
 * Data Access Object for the Transaction type
 */
class TransactionDAO extends DAO {

    //method to build a Transaction Object
    protected function buildDomainObject($row) {
        //set attributes of the Object
        $transaction = new Transaction();
        $transaction->setId($row['transaction_id']);
        $transaction->setAmount($row['amount']);
        if (isset($row['account_receive'])) {
            $transaction->setIdCreditor($row['account_receive']);
        }
        if (isset($row['account_send'])) {
            $transaction->setIdCreditor($row['account_send']);
        }

        $transaction->setDescription($row['description']);
        //return the final Object
        return $transaction;
    }

    //method to request all transactions on the WeService
    // : GET
    public function findAll($idAccount, $app) {

        $result = requestWSAuthGet(WSIKKANOMY, "/accounts/" . $idAccount . "/transactions", $app);
        $transactions = array();
        //if result
        if ($result != null) {
            foreach ($result as $row) {
                $transactionId = $row['transaction_id'];
                $transactions[$transactionId] = $this->buildDomainObject($row);
            }
        }
        return $transactions;
    }

    //find a specific transactions
    // : GET
    public function find($id, $app) {
        $transaction = requestWSAuthGet(WSIKKANOMY, '/transactions/' . $id, $app);
        if ($transaction) {
            return $this->buildDomainObject($transaction);
        } else {
            throw new \Exception("No transaction matching id " . $id);
        }
    }

    //method called when validation of Transaction Form
    // : POST
    public function create($app) {
        //code a JSON withs variable POST and Session 
        $transactionData = json_encode(array(
            'amount' => (int) $_POST['transaction']['amount'],
            'account_creditor' => (int) $_POST['transaction']['account_creditor'],
            'account_debtor' => (int) $app['session']->get('idAccount'),
            'description' => $_POST['transaction']['description'],
        ));
        requestWS(WSIKKANOMY, "/transactions", "POST", $transactionData);
    }

}
