<?php
/**
 * Created by PhpStorm.
 * User: nfangxu
 * Date: 2018/10/9
 * Time: 17:30
 */

namespace Fangxu\UserAction;

use Kafka;

class KafkaService
{

    public static function producer($topic, $value, $url, $version = "0.10.0.0")
    {
        $config = Kafka\ProducerConfig::getInstance();
        $config->setMetadataRefreshIntervalMs(10000);
        $config->setMetadataBrokerList($url);
        $config->setBrokerVersion($version);
        $config->setRequiredAck(1);
        $config->setIsAsyn(false);
        $config->setProduceInterval(500);
        $producer = new Kafka\Producer(function () use ($value, $topic) {
            return [
                [
                    'topic' => $topic,
                    'value' => $value,
                    'key' => '',
                ],
            ];
        });

        $producer->success(function ($result) {
            return "success";
        });
        $producer->error(function ($errorCode) use ($topic, $value) {
            throw new UserActionException("Error: " . $errorCode);
        });
        $producer->send(true);
    }

    public static function consumer($func, $group, $topics, $url, $version = "0.10.0.0")
    {
        $config = Kafka\ConsumerConfig::getInstance();
        $config->setMetadataRefreshIntervalMs(500);
        $config->setMetadataBrokerList($url);
        $config->setGroupId($group);
        $config->setBrokerVersion($version);
        $config->setTopics([$topics]);
        $config->setOffsetReset('earliest');
        $consumer = new Kafka\Consumer();
        $consumer->start(function ($topic, $part, $message) use ($func) {
            $func($message['message']['value'], $topic, $part); // 你的接收处理逻辑
        });
    }
}