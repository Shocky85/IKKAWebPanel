<?php

namespace IKKA\Form\Type;

use IKKA\DAO\AccountDAO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TransactionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        //find all Accounts
        $accountChoices = array();
        $accountDao = new AccountDAO();
        $accounts = $accountDao->findAll();
        //if result, build a array K/V for select input
        if ($accounts != null) {
            foreach ($accounts as $row) {
                $accountChoices[$row->id] = $row->id;
            }
        }
        //add inputs
        $builder->add('amount', 'number');
        $builder->add('account_creditor', 'choice', array(
            'label' => 'creditors',
            'choices' => $accountChoices
        ));
        $builder->add('description', 'text');
    }

    //find the form
    public function getName() {
        return 'transaction';
    }

}
