<?php

namespace App\Http\Responses;

use Illuminate\Routing\Redirector;

class CustomRedirector extends Redirector
{
    /**
     * Create a new redirect response to the given path.
     *
     * @param  string  $path
     * @param  int     $status
     * @param  array   $headers
     * @param  bool    $secure
     * @return \Illuminate\Http\RedirectResponse
     */
    public function to($path, $status = 302, $headers = [], $secure = null)
    {
        $path = $this->generator->to($path, [], $secure);

        return $this->createRedirect($path, $status, $headers);
    }

    /**
     * Create a new redirect response.
     *
     * @param  string  $path
     * @param  int     $status
     * @param  array   $headers
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function createRedirect($path, $status, $headers)
    {
        $redirect = new CustomRedirectResponse($path, $status, $headers);

        if (isset($this->session)) {
            $redirect->setSession($this->session);
        }

        $redirect->setRequest($this->generator->getRequest());

        return $redirect;
    }
}