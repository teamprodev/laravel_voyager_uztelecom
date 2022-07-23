<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApplicationCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function create(AcceptanceTester $I)
    {
        $I->am('admin');
        $I->amOnPage('/admin/login');
        $I->fillField('email','aziz@gmail.com');
        $I->fillField('password','password');
        $I->click('Войти');
        $I->amOnPage('/ru/site/applications');
        $I->click('Создать');
        $I->click('Сохранить и закрыть');
    }
    public function clone(AcceptanceTester $I)
    {
        $I->am('admin');
        $I->amOnPage('/admin/login');
        $I->fillField('email','aziz@gmail.com');
        $I->fillField('password','password');
        $I->click('Войти');
        $I->amOnPage('/ru/site/applications/1/clone');
    }
    public function getData(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/login');
        $I->fillField('email','aziz@gmail.com');
        $I->fillField('password','password');
        $I->click('Войти');
        $I->amOnPage('/ru/site/applications');
    }
    public function draft(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/login');
        $I->fillField('email','aziz@gmail.com');
        $I->fillField('password','password');
        $I->click('Войти');
        $I->amOnPage('/ru/site/applications/drafts');
    }
}
