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

    // Batasi ambil data maksimal 100 dokumen (bisa disesuaikan)
    $documents = $collection->limit(100)->documents();

    $data = [];

    foreach ($documents as $document) {
        if (!$document->exists()) {
            continue;
        }

        $docData = $document->data();

        // Tangani timestamp dengan aman
        $timestamp = $docData['timestamp'] ?? null;

        if ($timestamp instanceof \Google\Cloud\Core\Timestamp) {
            // Konversi ke DateTime dan format
            $dateTime = $timestamp->get();
            $docData['timestamp'] = $dateTime instanceof \DateTimeInterface
                ? $dateTime->format('Y-m-d H:i:s')
                : null;
        } elseif ($timestamp instanceof \DateTimeInterface) {
            $docData['timestamp'] = $timestamp->format('Y-m-d H:i:s');
        } elseif (is_string($timestamp)) {
            $time = strtotime($timestamp);
            $docData['timestamp'] = $time ? date('Y-m-d H:i:s', $time) : null;
        } else {
            $docData['timestamp'] = null;
        }

        $data[] = $docData;
    }

    // Urutkan berdasarkan timestamp terbaru
    usort($data, function ($a, $b) {
        $timeA = isset($a['timestamp']) ? strtotime($a['timestamp']) : 0;
        $timeB = isset($b['timestamp']) ? strtotime($b['timestamp']) : 0;
        return $timeB <=> $timeA;
    });

    return $data;
}


}
