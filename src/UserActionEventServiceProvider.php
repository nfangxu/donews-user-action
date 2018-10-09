<?php
/**
 * Created by PhpStorm.
 * User: nfangxu
 * Date: 2018/10/9
 * Time: 17:24
 */

namespace Fangxu\UserAction;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class UserActionEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'Fangxu\UserAction\Events\UserActionComment' => [
            'Fangxu\UserAction\UserActionListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}