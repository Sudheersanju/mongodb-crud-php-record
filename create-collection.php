<?php
// Include Composer autoloader
require 'vendor/autoload.php';

// Define an array of Route53 record names
$recordNames = [
    'mongo-0.database.dawrinbox.local',
    'mongo-1.database.dawrinbox.local',
    'mongo-2.database.dawrinbox.local'
];

// Connect to MongoDB for each record name
foreach ($recordNames as $recordName) {
    // Extract the hostname from the record name
    $hostname = explode('.', $recordName)[0];

    // Create a new MongoDB client
    $client = new MongoDB\Client("mongodb://$hostname:27017");
    echo "Connection to $recordName successful<br>";

    // Select a database
    $database = $client->selectDatabase('nameDatabase');
    echo "Database 'nameDatabase' selected for $recordName<br>";

    // Select a collection
    $collection = $database->selectCollection('nameDatabase');
    echo "Collection 'nameDatabase' selected for $recordName<br>";

    // Create a document
    $document = [
        "title"       => "MongoDB Title",
        "description" => "database",
        "like"        => 100
    ];

    // Insert the document
    $collection->insertOne($document);
    echo "Document inserted successfully for $recordName<br>";

    // Close the MongoDB connection
    $client = null;
}
?>

