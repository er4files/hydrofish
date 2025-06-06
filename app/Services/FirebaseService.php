<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Google\Cloud\Core\Timestamp;

class FirebaseService
{
    protected $database;  // Realtime Database
    protected $firestore; // Firestore client

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(config('firebase.credentials'))
            ->withDatabaseUri(config('firebase.database_url'));

        // Inisialisasi Realtime Database hanya sekali
        $this->database = $factory->createDatabase();

        // Inisialisasi Firestore hanya sekali
        $this->firestore = $factory->createFirestore()->database();
    }

    public function getSensorData()
    {
        return $this->database
            ->getReference('sensor_data')
            ->getValue();
    }

    public function getJadwalPakan()
    {
        return $this->database->getReference('jadwal_pakan')->getValue();
    }

    public function getHistoryData()
    {
        $collection = $this->firestore->collection('history');
        $documents = $collection->documents();

        $data = [];

        foreach ($documents as $document) {
            if (!$document->exists()) {
                continue;
            }

            $docData = $document->data();

            // Cek dan konversi timestamp
            if (isset($docData['timestamp']) && $docData['timestamp'] instanceof Timestamp) {
                $docData['timestamp'] = $docData['timestamp']->get()->format('Y-m-d H:i:s');
            } else {
                $docData['timestamp'] = null;
            }

            $data[] = $docData;
        }

        // Urutkan berdasarkan timestamp terbaru
        usort($data, function ($a, $b) {
            return strtotime($b['timestamp']) <=> strtotime($a['timestamp']);
        });

        return $data;
    }
}
