<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ApplicationCest
{
    public string $id;
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
        $I->click('Компания');
        $I->amOnPage($I->grabFromCurrentUrl());
        $I->fillField(['name' => 'initiator'],'test test');
        $I->fillField(['name' => 'purchase_basis'],'test test');
        $I->fillField(['name' => 'basis'],'test test');
        $I->fillField(['name' => 'name'],'test test');
        $I->fillField(['name' => 'specification'],'test test');
        $I->fillField(['name' => 'separate_requirements'],'test test');
        $I->fillField(['name' => 'other_requirements'],'test test');
        $I->fillField(['name' => 'planned_price'],'test test');
        $I->fillField(['name' => 'incoterms'],'test test');
        $I->fillField(['name' => 'info_business_plan'],'test test');
        $I->fillField(['name' => 'info_purchase_plan'],'test test');
        $I->fillField(['name' => 'comment'],'test test');
        $I->click('Сохранить и закрыть');
        $this->id = $this->grabFromUrlIdApplication($I->grabFromCurrentUrl());
    }
    public function clone(AcceptanceTester $I)
    {
        $I->am('admin');
        $I->amOnPage('/admin/login');
        $I->fillField('email','aziz@gmail.com');
        $I->fillField('password','password');
        $I->click('Войти');
        $I->amOnPage("/ru/site/applications/$this->id/clone");
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
    private function grabFromUrlIdApplication($url){
        return trim($url,'ru/site/applications/edit');
    }
}
