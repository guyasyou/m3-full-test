<?php

declare(strict_types=1);


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

final class FirstCest
{
    public function _before(AcceptanceTester $I): void
    {
        // Code here will be executed before each test.
    }

    public function tryToTest(AcceptanceTester $I): void
    {
        $I->wantToTest('Google Main Page');
        $I->amGoingTo('/');
        $I->amOnPage('/');
        $I->see('Google');

        $I->pause();

        $I->wantTo('Find Drom by Google');
        $I->amOnPage('/search?q=drom.ru');
        $I->see('Дром - цены на машины');
    }
}
