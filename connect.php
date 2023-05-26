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

    // Connect to MongoDB with the hostname
    $client = new MongoClient("mongodb://$hostname:27017");
    echo "Connection to $recordName successful<br>";

    // Select a database
    $database = $client->nameDatabase;
    echo "Database nameDatabase Selected for $recordName<br>";

    // Create a collection
    $collection = $database->createCollection("nameDatabase");
    echo "Created collection successfully for $recordName<br>";

    // Close the MongoDB connection
    $client->close();
}
?>

