<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\PostCreate' =>[
            'App\Listeners\CreatePost',
        ],

        'App\Events\PostDelete' =>[
            'App\Listeners\DeleteLike',
            'App\Listeners\DeleteImage',
            'App\Listeners\DeleteNotificationforThisPost',
            'App\Listeners\DeleteCommandForThisPost',
            'App\Listeners\DeletePost',
        ],

        'App\Events\PostLike' =>[
            'App\Listeners\LikeNotification',
            'App\Listeners\Postlikes',
        ],

        'App\Events\DeletePostLike' =>[
            'App\Listeners\DeleteLikeNotification',
            'App\Listeners\DeletePostlikes',
        ],


        'App\Events\PostCommand' =>[
            'App\Listeners\PostCommands',
            'App\Listeners\CommandNotification',
        ],

        'App\Events\DeletePostCommand' =>[
            'App\Listeners\DeleteCommandNotification',
            'App\Listeners\DeletePostCommands',
        ],

        'App\Events\AddFrindRequest' =>[
            'App\Listeners\AddFrindRequestNotification',
        ],

        'App\Events\RollBackFrindRequest' =>[
            'App\Listeners\DeleteFrindRequestNotification',
        ],
        'App\Events\CancelFrindRequest' =>[
            'App\Listeners\DeleteFrindRequestNotification',
            'App\Listeners\DeleteFrindReques',
        ],
        'App\Events\AcceptFrindRequest' =>[
            'App\Listeners\AcceptFrindRequests',
            'App\Listeners\NotificationAccepted',
            'App\Listeners\DeleteFrindRequestNotification',
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
