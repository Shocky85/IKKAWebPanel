<?php

namespace IKKA\DAO;

use IKKA\Domain\Account;

/**
 * Data Access Object for the Account type
 */
class AccountDAO extends DAO {

    //method to build a Account Object
    protected function buildDomainObject($row) {
        $account = new Account();
        //set attributes of the Object
        $account->setId($row['account_id']);
        $account->setAccountBalance($row['account_balance']);
        $account->setDescription($row['description']);
        //return the final Object
        return $account;
    }

    //method to request all accounts on the WeService
    // : GET
    public function findAll() {
        $url = '' . WSIKKANOMY . '/accounts';
        $result = getDataFromJSON($url);
        $accounts = array();
        //if find result we build Final Object
        if ($result != null) {
            foreach ($result as $row) {
                $accountId = $row['account_id'];
                $accounts[$accountId] = $this->buildDomainObject($row);
            }
        }
        return $accounts;
    }

    //method to request one account on the WeService with the ID Account
    // : GET
    public function find($id, $app) {
        $account = requestWSAuthGet(WSIKKANOMY, "/accounts/" . $id, $app);
        //if find result we build Final Object
        if ($account) {
            return $this->buildDomainObject($account);
        } else {
            throw new \Exception("No account matching id " . $id);
        }
    }

}
