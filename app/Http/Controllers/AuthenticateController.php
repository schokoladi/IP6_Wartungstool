<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

/**
* Die AuthenticateController-Klasse handlet alle Funktionen (Actions), welche über
* die URL 'api/authenticate' aufgerufen werden und dient dem Login bzw. der Token-
* verwaltung
* Diese Klasse wurde gemäss einem Tutorial von scotch.io [1] adaptiert
* [1] https://scotch.io/tutorials/token-based-authentication-for-angularjs-and-laravel-apps
*/
class AuthenticateController extends Controller
{

  /**
  * Mit dem Konstruktor wird diese Klasse in der Middleware registriert, welche
  * beim Seitenaufruf zwischengeschaltet wird und filtert.
  * Eine Ausnahme wird mit 'except' definiert, damit eine initiale Authentifizierung
  * möglich ist.
  */
  public function __construct()
  {
    $this->middleware('jwt.auth', ['except' => ['authenticate']]);
  }

  /**
  * Der authentifizierte Benutzer wird geholt oder ein Fehler zurückgegeben
  *
  * @return response  Fehlercode oder Benutzer als JSON-String
  * @author Ryan Chenkie
  */
  public function getAuthenticatedUser()
  {
    try {
      if (! $user = JWTAuth::parseToken()->authenticate()) {
        return response()->json(['user_not_found'], 404);
      }
    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
      return response()->json(['token_expired'], $e->getStatusCode());
    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
      return response()->json(['token_invalid'], $e->getStatusCode());
    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
      return response()->json(['token_absent'], $e->getStatusCode());
    }
    // the token is valid and we have found the user via the sub claim
    return response()->json(compact('user'));
  }

  /**
  * Die Formulardaten werden überprüft und ein Fehler oder ein generierter Token
  * zurückgegeben.
  *
  * @param  Request   Eingegebene Formularwerte
  * @return response  Fehler oder Token als JSON-String
  * @author Ryan Chenkie
  */
  public function authenticate(Request $request)
  {
    $credentials = $request->only('username', 'password');

    try {
      // verify the credentials and create a token for the user
      if (!$token = JWTAuth::attempt($credentials)) {
        return response()->json(['error' => 'invalid_credentials'], 401);
      }
    } catch (JWTException $e) {
      // something went wrong
      return response()->json(['error' => 'could_not_create_token'], 500);
    }

    // if no errors are encountered we can return a JWT
    return response()->json(compact('token'));
  }

}
