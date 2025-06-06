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

    // Batasi ambil data maksimal 100 dokumen (bisa sesuaikan)
    $documents = $collection->limit(100)->documents();

    $data = [];

    foreach ($documents as $document) {
        if (!$document->exists()) {
            continue;
        }

        $docData = $document->data();

        // Cek dan konversi timestamp dengan aman
        if (isset($docData['timestamp'])) {
            $timestamp = $docData['timestamp'];

            // Bisa jadi sudah DateTimeImmutable, Timestamp, atau string
            if ($timestamp instanceof \Google\Cloud\Core\Timestamp) {
                // Ambil DateTime dari Timestamp
                $dateTime = $timestamp->get();
                if ($dateTime instanceof \DateTimeInterface) {
                    $docData['timestamp'] = $dateTime->format('Y-m-d H:i:s');
                } else {
                    $docData['timestamp'] = null;
                }
            } elseif ($timestamp instanceof \DateTimeInterface) {
                $docData['timestamp'] = $timestamp->format('Y-m-d H:i:s');
            } elseif (is_string($timestamp)) {
                // Coba parsing string timestamp
                $time = strtotime($timestamp);
                $docData['timestamp'] = $time ? date('Y-m-d H:i:s', $time) : null;
            } else {
                $docData['timestamp'] = null;
            }
        } else {
            $docData['timestamp'] = null;
        }

        $data[] = $docData;
    }

    // Urutkan berdasarkan timestamp terbaru, handling jika timestamp null
    usort($data, function ($a, $b) {
        $timeA = isset($a['timestamp']) ? strtotime($a['timestamp']) : 0;
        $timeB = isset($b['timestamp']) ? strtotime($b['timestamp']) : 0;
        return $timeB <=> $timeA;
    });

    return $data;
}

}
