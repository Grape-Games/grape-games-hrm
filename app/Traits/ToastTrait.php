<?php

namespace App\Traits;

trait ToastTrait
{
    public function getSuccess($message)
    {
        $this->emit('toast', 'success', $message);
    }

    public function getError($message)
    {
        $this->emit('toast', 'error', $message);
    }

    public function getException($exception)
    {
        $this->emit('toast', 'error', $exception->errorInfo[2] ?? $exception->getMessage());
    }
}
