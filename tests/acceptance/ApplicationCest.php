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
        $I->submitForm("//form[@data-aire-component='form']", [
            'initiator' => 'TEST!!! Тошкент омборидан Республика омборхоналаригача (ёки обьектларгачам)',
            'basis' => 'TEST!!!  “Ўзбектелеком” АК томонидан имзоланган шартномаларга асосан келтириладиган телекоммуникация қурилмаларини ҳамда',
            'name' => 'JAVATEST!!!  Бизнес режа асосида.',
            'specification' => 'TEST!!!  Бизнес режа асосида.',
            'separate_requirements' => 'TEST!!! Тент, контейнеровоз.',
            'other_requirements' => 'TEST!!! Тент, контейнеровоз.',
            'planned_price' => '550000000',
            'incoterms' => 'TEST!!!  Тошкент омборидан Республика омборхоналаригача (ёки обьектларгачам)',
            'info_business_plan' => 'TEST!!! САРЕХ 2022',
            'info_purchase_plan' => 'TEST!!! Планом закупок предусмотрено',
            'comment' => 'java adsada',
            'resource_id' => 22,
            'currency' => 'USD'
        ], 'draft');
        $this->id = (int)$this->grabFromUrlIdApplication($I->grabFromCurrentUrl());
    }

    public function edit(AcceptanceTester $I)
    {
        $I->am('admin');
        $I->amOnPage('/admin/login');
        $I->fillField('email', 'aziz@gmail.com');
        $I->fillField('password', 'password');
        $I->click('Войти');
        $I->amOnUrl("http://127.0.0.1:8000/ru/site/applications/$this->id/edit");
        $I->submitForm("//form[@data-aire-id='0']", [
            'initiator' => 'TEST!!! Тошкент омборидан Республика омборхоналаригача (ёки обьектларгачам)',
            'basis' => 'TEST!!!  “Ўзбектелеком” АК томонидан имзоланган шартномаларга асосан келтириладиган телекоммуникация қурилмаларини ҳамда',
            'name' => 'JAVATEST перестест!!!  Бизнес режа асосида.',
            'specification' => 'TEST!!!  Бизнес режа асосида.',
            'separate_requirements' => 'TEST!!! Тент, контейнеровоз.',
            'other_requirements' => 'TEST!!! Тент, контейнеровоз.',
            'planned_price' => '550000000',
            'incoterms' => 'TEST!!!  Тошкент омборидан Республика омборхоналаригача (ёки обьектларгачам)',
            'info_business_plan' => 'TEST!!! САРЕХ 2022',
            'info_purchase_plan' => 'TEST!!! Планом закупок предусмотрено',
            'comment' => 'java adsada',
            'resource_id' => 32,
            'currency' => 'USD'
        ], "//form[@data-aire-component='form']//button[@value=0]");
    }

    public function clone(AcceptanceTester $I)
    {
        $I->am('admin');
        $I->amOnPage('/admin/login');
        $I->fillField('email', 'aziz@gmail.com');
        $I->fillField('password', 'password');
        $I->click('Войти');

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

    public function destroy(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/login');
        $I->fillField('email', 'aziz@gmail.com');
        $I->fillField('password', 'password');
        $I->click('Войти');
        $I->amOnPage("/ru/site/applications");
        $I->amOnPage("/ru/site/applications/$this->id/destroy");
    }


    private function grabFromUrlIdApplication($url)
    {
        return trim($url, 'ru/site/applications/edit/show/clone/destroy');
    }
}
