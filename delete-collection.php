<?php
// Include Composer autoloader
require 'vendor/autoload.php';

// Define an array of Route53 record names
$recordNames = [
    'mongo-0.database.dawrinbox.local',
    'mongo-1.database.dawrinbox.local',
    'mongo-2.database.dawrinbox.local'
];

foreach ($recordNames as $recordName) {
    // Extract the hostname from the record name
    $hostname = explode('.', $recordName)[0];

    // Connect to MongoDB with the hostname
    $client = new MongoDB\Client("mongodb://$hostname:27017");
    echo "Connection to $recordName successful<br>";

    // Select a database
    $database = $client->selectDatabase('nameDatabase');
    echo "Database 'nameDatabase' selected for $recordName<br>";

    // Select a collection
    $collection = $database->selectCollection('nameDatabase');
    echo "Collection 'nameDatabase' selected for $recordName<br><br>";

    // Remove the documents with title "MongoDB Title"
    $deleteResult = $collection->deleteMany(['title' => 'MongoDB Title']);
    echo "Deleted " . $deleteResult->getDeletedCount() . " document(s) successfully for $recordName<br><br>";

    // Find and display the updated documents
    $cursor = $collection->find();

    // Iterate over the cursor to display the document fields
    echo "Updated document for $recordName:<br><br>";
    foreach ($cursor as $document) {
        echo $document["title"] . "<br>";
        echo $document["description"] . "<br>";
        echo $document["like"] . "<br><br>";
    }

    // Close the MongoDB connection
    $client = null;
}
?>

