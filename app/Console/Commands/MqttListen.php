<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use App\Models\SensorData;

class MqttListen extends Command
{
    protected $signature = 'mqtt:listen';
    protected $description = 'Listen to MQTT and save data to database';

    public function handle()
    {
        $this->info("Starting MQTT listener...");

        $mqtt = new MqttClient('127.0.0.1', 1883, 'laravelSubscriber');
        $mqtt->connect(new ConnectionSettings());

        $this->info("Connected to MQTT broker...");

        $mqtt->subscribe('sensor/dht22', function (string $topic, string $message) {
            $data = json_decode($message, true);
            if (isset($data['temperature']) && isset($data['humidity'])) {
                SensorData::create([
                    'temperature' => $data['temperature'],
                    'humidity' => $data['humidity'],
                ]);

                echo "Data saved: $message\n";
            } else {
                echo "Invalid message received: $message\n";
            }
        }, 0);

        $mqtt->loop(true);
    }

}

