<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\Key;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $key = getenv('JWT_SECRET');
        $header = $request->getServer('HTTP_AUTHORIZATION');
        $token = null;

        // extract the token from the header
        if (!empty($header) && preg_match('/Bearer\s(\S+)/', $header, $matches)) {
            $token = $matches[1];
        }

        // check if token is null or empty
        if (empty($token)) {
            $response = service('response');
            return $response->setStatusCode(401)->setBody('Access denied');
        }

        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));

            // You can access decoded data using $decoded->data if your payload has a "data" field
            // $decodedData = $decoded->data;

        } catch (ExpiredException $ex) {
            $response = service('response');
            return $response->setStatusCode(401)->setBody('Token has expired');
        } catch (\Exception $ex) {
            $response = service('response');
            return $response->setStatusCode(401)->setBody('Invalid token');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after the request
    }
}
