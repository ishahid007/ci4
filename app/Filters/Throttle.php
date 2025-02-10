<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Throttle implements FilterInterface
{
    /**
     * This is a demo implementation of using the Throttler class
     * to implement rate limiting for your application.
     *
     * @param list<string>|null $arguments
     *
     * @return ResponseInterface|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $throttler = service('throttler');
        $service   = service('response');

        // Restrict an IP address to no more than 1 request per minute across the entire site.
        if ($throttler->check(md5($request->getIPAddress()), 60, MINUTE) === false) {
            return $service->setStatusCode(429)->setJSON([
                'error' => 'Too many requests',
            ]);
        }
    }

    /**
     * We don't have anything to do here.
     *
     * @param list<string>|null $arguments
     *
     * @return void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // ...
    }
}
