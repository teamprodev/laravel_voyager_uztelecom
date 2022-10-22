<?php

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
        $I->fillField('email', 'aziz@gmail.com');
        $I->fillField('password', 'password');
        $I->click('Войти');
        $I->amOnPage('/ru/site/applications');
        $I->click('Создать');
        $I->click('Компания');
        $I->amOnPage($I->grabFromCurrentUrl());
        $I->fillField("//*[@name='initiator']", '123123123');
        $I->fillField("textarea[name='purchase_basis']", 'test test');
        $I->fillField("textarea[name='basis']", 'test test');
        $I->fillField("input[name='name']", 'test test');
        $I->fillField("textarea[name='specification']", 'test test');
        $I->fillField("textarea[name='separate_requirements']", 'test test');
        $I->fillField("textarea[name='other_requirements']", 'test test');
        $I->fillField("input[name='planned_price']", 'test test');
        $I->fillField("textarea[name='incoterms']", 'test test');
        $I->fillField("input[name='info_business_plan']", 'test tesqt');
        $I->fillField("textarea[name='info_purchase_plan']", 'test test');
        $I->fillField("textarea[name='comment']", 'java adsada');
        $name = $I->grabValueFrom(['name' => 'info_business_plan']);
        $I->click('Сохранить и отправить');
//        $I->submitForm('#0', [
//            'initiator' => 'davert',
//            'purchase_basis' => '123456',
//            'basis' => 'davert',
//            'name' => '123456',
//            'specification' => 'davert',
//            'separate_requirements' => '123456',
//            'other_requirements' => 'davert',
//            'planned_price' => '123456',
//            'incoterms' => 'davert',
//            'info_business_plan' => '123456',
//            'info_purchase_plan' => 'davert',
//            'comment' => '123456',
//        ]);
        $I->see('Новая');
        $I->see('java adsada');
        echo $name;
        $this->id = $this->grabFromUrlIdApplication($I->grabFromCurrentUrl());
        echo $this->id;


    }

    public function clone(AcceptanceTester $I)
    {
        $I->am('admin');
        $I->amOnPage('/admin/login');
        $I->fillField('email', 'aziz@gmail.com');
        $I->fillField('password', 'password');
        $I->click('Войти');
        $I->amOnPage("/ru/site/applications/$this->id/clone");
    }

    public function getData(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/login');
        $I->fillField('email', 'aziz@gmail.com');
        $I->fillField('password', 'password');
        $I->click('Войти');
        $I->amOnPage('/ru/site/applications');
    }

    public function draft(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/login');
        $I->fillField('email', 'aziz@gmail.com');
        $I->fillField('password', 'password');
        $I->click('Войти');
        $I->amOnPage('/ru/site/applications/drafts');
    }

    private function grabFromUrlIdApplication($url)
    {
        return trim($url, 'ru/site/applications/edit');
    }
}
