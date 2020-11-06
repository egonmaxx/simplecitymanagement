<?php 

class ApplicationApiTestsCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function tryToTestgetTranslation(ApiTester $I)
    {
        $I->wantTo('Get translation');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/gettranslation', [
          'language' => 'en']
        );
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
    }

    public function tryToGetAllCounties(ApiTester $I)
    {
        $I->wantTo('Get all counties');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGet('/counties');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
    }

    public function tryToTestGetCitiesByCountyId(ApiTester $I)
    {
        $I->wantTo('Get cities by countyId');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/citiesbycounty', [
          'countyId' => 1]
        );
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
    }

    public function tryToTestAddCityByCountyId(ApiTester $I)
    {
        $I->wantTo('Add City by countyId');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/addcitybycountyid', [
            'name' => 'TestCity',
            'countyId' => 1
            ]
        );
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
    }

    public function tryToTestDeleteCityById(ApiTester $I)
    {
        $I->wantTo('Delete city by Id');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/deletecitybyid', [
            'cityId' => '18'
            ]
        );
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
    }

    public function tryToTesUpdateCityNameById(ApiTester $I)
    {
        $I->wantTo('Delete city name by Id');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('/updatecitynamebyid', [
            'cityId' => '18',
            'name' => 'testCityModified'
            ]
        );
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
    }

}
