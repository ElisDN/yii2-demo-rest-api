<?php

namespace api\tests\api;

use \api\tests\ApiTester;
use common\fixtures\PostFixture;
use common\fixtures\TokenFixture;
use common\fixtures\UserFixture;

class PostsCest
{
    public function _before(ApiTester $I)
    {
        $I->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ],
            'token' => [
                'class' => TokenFixture::className(),
                'dataFile' => codecept_data_dir() . 'token.php'
            ],
            'post' => [
                'class' => PostFixture::className(),
                'dataFile' => codecept_data_dir() . 'post.php'
            ],
        ]);
    }

    public function index(ApiTester $I)
    {
        $I->sendGET('/posts');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            ['title' => 'First Post'],
            ['title' => 'Second Post'],
            ['title' => 'Third Post'],
        ]);
        $I->seeHttpHeader('X-Pagination-Total-Count', 3);
    }

    public function indexWithAuthor(ApiTester $I)
    {
        $I->sendGET('/posts?expand=author');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            [
                'title' => 'First Post',
                'author' => [
                    'username' => 'erau',
                ],
            ]
        ]);
    }

    public function search(ApiTester $I)
    {
        $I->sendGET('/posts?s[title]=First');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            ['title' => 'First Post'],
        ]);
        $I->dontSeeResponseContainsJson([
            ['title' => 'Second Post'],
        ]);
        $I->seeHttpHeader('X-Pagination-Total-Count', 1);
    }

    public function view(ApiTester $I)
    {
        $I->sendGET('/posts/1');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            'title' => 'First Post',
        ]);
    }

    public function viewNotFound(ApiTester $I)
    {
        $I->sendGET('/posts/15');
        $I->seeResponseCodeIs(404);
    }

    public function createUnauthorized(ApiTester $I)
    {
        $I->sendPOST('/posts', [
            'title' => 'New Post',
        ]);
        $I->seeResponseCodeIs(401);
    }

    public function create(ApiTester $I)
    {
        $I->amBearerAuthenticated('token-correct');
        $I->sendPOST('/posts', [
            'title' => 'New Post',
        ]);
        $I->seeResponseCodeIs(201);
        $I->seeResponseContainsJson([
            'user_id' => 1,
            'title' => 'New Post',
        ]);
    }

    public function updateUnauthorized(ApiTester $I)
    {
        $I->sendPATCH('/posts/1', [
            'title' => 'New Title',
        ]);
        $I->seeResponseCodeIs(401);
    }

    public function update(ApiTester $I)
    {
        $I->amBearerAuthenticated('token-correct');
        $I->sendPATCH('/posts/1', [
            'title' => 'New Title',
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            'id' => 1,
            'title' => 'New Title',
        ]);
    }

    public function updateForbidden(ApiTester $I)
    {
        $I->amBearerAuthenticated('token-correct');
        $I->sendPATCH('/posts/2', [
            'title' => 'New Title',
        ]);
        $I->seeResponseCodeIs(403);
    }

    public function deleteUnauthorized(ApiTester $I)
    {
        $I->sendDELETE('/posts/1');
        $I->seeResponseCodeIs(401);
    }

    public function delete(ApiTester $I)
    {
        $I->amBearerAuthenticated('token-correct');
        $I->sendDELETE('/posts/1');
        $I->seeResponseCodeIs(204);
    }

    public function deleteForbidden(ApiTester $I)
    {
        $I->amBearerAuthenticated('token-correct');
        $I->sendDELETE('/posts/2');
        $I->seeResponseCodeIs(403);
    }
}
