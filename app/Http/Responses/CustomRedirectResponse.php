<?php

namespace App\Http\Responses;

use Illuminate\Http\RedirectResponse;

class CustomRedirectResponse extends RedirectResponse
{
    /**
     * Flash a piece of data to the session.
     *
     * @param  mixed  $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function withSuccess($message = null)
    {
        return $this->withNotification('is-success', $message);
    }

    public function withWarning($message = null)
    {
        return $this->withNotification('is-warning', $message);
    }

    protected function withNotification($type, $message)
    {
        return $this
            ->with('flash_type', $type)
            ->with('flash_message', $message);
    }
}