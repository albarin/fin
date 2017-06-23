<?php

namespace App\Http\Responses;

use Illuminate\Http\RedirectResponse;

class CustomRedirectResponse extends RedirectResponse
{
    public function withDefault($message)
    {
        return $this->withNotification('', $message);
    }

    public function withSuccess($message)
    {
        return $this->withNotification('is-success', $message);
    }

    public function withWarning($message)
    {
        return $this->withNotification('is-warning', $message);
    }

    public function withInfo($message)
    {
        return $this->withNotification('is-info', $message);
    }

    public function withDanger($message)
    {
        return $this->withNotification('is-danger', $message);
    }

    protected function withNotification($type, $message)
    {
        return $this
            ->with('flash_type', $type)
            ->with('flash_message', $message);
    }
}