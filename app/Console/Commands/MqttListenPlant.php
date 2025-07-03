<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use App\Models\PlantData;

class MqttListenPlant extends Command
{
    protected $signature = 'mqtt:listen-plant';
    protected $description = 'Listen MQTT and store soil and pump status';

    public function handle()
    {
        $this->info("Listening MQTT for plant data...");

        $mqtt = new MqttClient('127.0.0.1', 1883, uniqid('laravel_plant_'));
        $mqtt->connect(new ConnectionSettings());

        $mqtt->subscribe('sensor/plant', function (string $topic, string $message) {
            $data = json_decode($message, true);

            if (isset($data['soil_moisture']) && isset($data['pump'])) {
                PlantData::create([
                    'soil_moisture' => $data['soil_moisture'],
                    'pump_status' => $data['pump'],
                ]);

                echo "Data saved: $message\n";
            } else {
                echo "Invalid message received: $message\n";
                echo "Payload: $message\n";
            }
        }, 0);

        $mqtt->loop(true);
    }
}

