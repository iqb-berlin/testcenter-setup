<?php
declare(strict_types=1);

use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Exception\HttpException;

$app->put('/session/admin', function(Request $request, Response $response) use ($app) {

    $adminDAO = new AdminDAO();

    $body = RequestBodyParser::getElements($request, [
        "name" => null,
        "password" => null
    ]);

    $token = $adminDAO->createAdminToken($body['name'], $body['password']);

    $session = $adminDAO->getAdminSession($token);

    if (($session->getAccessWorkspaceAdmin()) and ($session->getAccessSuperAdmin() == null)) {
        throw new HttpException($request, "You don't have any workspaces and are not allowed to create some.", 202);
    }

    return $response->withJson($session);
});

$app->put('/session/login', function(Request $request, Response $response) use ($app) {

    $body = RequestBodyParser::getElements($request, [
        "name" => null,
        "password" => ''
    ]);

    if (!$body['name']) {

        throw new HttpBadRequestException($request, "Authentication credentials missing.");
    }

    $potentialLogin = TesttakersFolder::searchAllForLogin($body['name'], $body['password']);

    if ($potentialLogin == null) {

        $shortPW = preg_replace('/(^.).*(.$)/m', '$1***$2', $body['password']);
        throw new HttpUnauthorizedException($request, "No Login for `{$body['name']}` with `{$shortPW}`");
    }

    $sessionDAO = new SessionDAO();

    $login = $sessionDAO->getOrCreateLogin($potentialLogin);

    if (!$login->isCodeRequired()) {

        $session = $sessionDAO->getOrCreatePersonSession($login, $body['code']);

    } else {

        $session = new Session(
            $login->getToken(),
            "{$login->getGroupName()}/{$login->getName()}",
            $login->isCodeRequired() ? ['codeRequired'] : []
        );
    }

    return $response->withJson($session);
});


$app->put('/session/person', function(Request $request, Response $response) use ($app) {

    /* @var $authToken AuthToken */
    $authToken = $request->getAttribute('AuthToken');

    $sessionDAO = new SessionDAO();

    $body = RequestBodyParser::getElements($request, [
        'code' => ''
    ]);

    $login = $sessionDAO->getLogin($authToken->getToken());

    $session = $sessionDAO->getOrCreatePersonSession($login, $body['code']);

    return $response->withJson($session);

})->add(new RequireLoginToken());


$app->get('/session', function(Request $request, Response $response) use ($app) {

    /* @var $authToken AuthToken */
    $authToken = $request->getAttribute('AuthToken');

    $sessionDAO = new SessionDAO();

    if ($authToken::type == "login") {

        $session = $sessionDAO->getLoginSession($authToken->getToken());
        return $response->withJson($session);
    }

    if ($authToken::type == "person") {

        $session = $sessionDAO->getPersonSession($authToken->getToken());
        return $response->withJson($session);
    }

    $adminDAO = new AdminDAO();

    if ($authToken::type == "admin") {

        $session = $adminDAO->getAdminSession($authToken->getToken());
        return $response->withJson($session);
    }

    throw new HttpUnauthorizedException($request);

})->add(new RequireAnyToken());
