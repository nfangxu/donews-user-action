<?php
/**
 * Created by PhpStorm.
 * User: nfangxu
 * Date: 2018/10/9
 * Time: 17:28
 */

namespace Fangxu\UserAction;

use Fangxu\UserAction\Events\UserAction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserActionListener implements ShouldQueue
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param $event
     * @return void
     */
    public function handle(UserAction $event)
    {
        KafkaService::producer(
            env("USER_ACTION_KAFKA_TOPIC_PREFIX") . $event->topic,
            $event->data,
            env("USER_ACTION_KAFKA_URL")
        );
    }
}