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
        $I->fillField("//*[@name='initiator']", 'TEST!!! Тошкент омборидан Республика омборхоналаригача (ёки обьектларгачам)');
        $I->fillField("textarea[name='purchase_basis']", 'TEST!!!  “Ўзбектелеком” АК томонидан имзоланган шартномаларга асосан келтириладиган телекоммуникация қурилмаларини ҳамда  “ЎзМобайл” филиали томонидан харид қилинган электр, қурилиш хўжалик ва бошқа турдаги маҳсулотларини Республика ҳудудий омборхоналарига ва обьектларга етказиб бериш.');
        $I->fillField("textarea[name='basis']", 'TEST!!!  Бизнес режа асосида.');
        $I->fillField("input[name='name']", '111ртнома тузиш.');
        $I->fillField("textarea[name='specification']", 'TEST!!! Тент, контейнеровоз.');
        $I->fillField("textarea[name='separate_requirements']", 'TEST!!! Тент, контейнеровоз.');
        $I->fillField("textarea[name='other_requirements']", 'TEST!!! Тент, контейнеровоз.');
        $I->fillField("input[name='planned_price']", '550000000');
        $I->fillField("textarea[name='incoterms']", 'TEST!!!  Тошкент омборидан Республика омборхоналаригача (ёки обьектларгачам)');
        $I->fillField("input[name='info_business_plan']", 'TEST!!! САРЕХ 2022');
        $I->fillField("textarea[name='info_purchase_plan']", 'TEST!!! Планом закупок предусмотрено');
        $I->fillField("textarea[name='comment']", 'java adsada');
        $I->selectOption("//form//select[@name='currency']", "USD");
//        $I->selectOption("//form//table//select", "21");
        $I->click('Сохранить и отправить');

        $this->id = (int)$this->grabFromUrlIdApplication($I->grabFromCurrentUrl());


    }

    public function edit(AcceptanceTester $I)
    {

        $I->am('admin');
        $I->amOnPage('/admin/login');
        $I->fillField('email', 'aziz@gmail.com');
        $I->fillField('password', 'password');
        $I->click('Войти');
//        $I->amOnUrl("http://127.0.0.1:8000/ru/site/applications/$this->id/edit");
//        var_dump($I->grabFromCurrentUrl());
//        $I->fillField(["//*[@name='initiator']"], 'TEST!!! Бухара омборидан Республика омборхоналаригача (ёки обьектларгачам)');
//        $I->fillField("textarea[name='purchase_basis']", 'TEST!!!  “Бухара” АК томонидан имзоланган шартномаларга асосан келтириладиган телекоммуникация қурилмаларини ҳамда  “ЎзМобайл” филиали томонидан харид қилинган электр, қурилиш хўжалик ва бошқа турдаги маҳсулотларини Республика ҳудудий омборхоналарига ва обьектларга етказиб бериш.');
//        $I->fillField("textarea[name='basis']", 'TEST!!!  Бухара Бухара Бухара.');
//        $I->fillField("input[name='name']", 'TEST!!!  Бухара.');
//        $I->fillField("textarea[name='specification']", 'TEST!!! Бухара.');
//        $I->fillField("textarea[name='separate_requirements']", 'TEST!!! Бухара.');
//        $I->fillField("textarea[name='other_requirements']", 'TEST!!! Бухара, Бухара.');
//        $I->fillField("input[name='planned_price']", '560000000');
//        $I->fillField("textarea[name='incoterms']", 'TEST!!!  Бухара ');
//        $I->fillField("input[name='info_business_plan']", 'TEST!!! Бухара 2022');
//        $I->fillField("textarea[name='info_purchase_plan']", 'TEST!!! Бухара');
//        $I->fillField("textarea[name='comment']", 'java adsada');
//        $I->grabValueFrom(['name' => 'info_business_plan']);
//        $I->checkOption("[name='with_nds']");
//        $I->click('Сохранить и отправить');
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
