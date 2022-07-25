<?php

class BranchCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/login');
        $I->fillField('email','aziz@gmail.com');
        $I->fillField('password','password');
        $I->click('Войти');
        $I->amOnPage('/branches/view');
    }
}
