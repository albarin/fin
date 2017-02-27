<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CheckOwner
{
    /**
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $model = $request->route()->parameters();
        $model = reset($model);

        if (empty($model)) {
            return $next($request);
        }

        if (!$this->modelBelongsToUser($model, $request->user())) {
            return redirect('home');
        }

        return $next($request);
    }

    /**
     * @param Model $model
     * @param User $user
     * @return bool
     */
    private function modelBelongsToUser($model, $user)
    {
        return $model->user_id === $user->id;
    }
}
