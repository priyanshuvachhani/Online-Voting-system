<?php
session_start();
// Decode the JSON received
$input = json_decode(file_get_contents("php://input"), true);

if (!$input || !isset($input['image'])) {
    echo json_encode(['success' => false, 'message' => 'No image received']);
    exit;
}

// Decode the base64 image
$imageData = $input['image'];
$imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
$a = $_SESSION['a'];
// Define the path to save the image
$filename = '../Face Recognition/abc@123.png';  // Save as a timestamped file in an 'uploads' folder

// Save the image file
if (file_put_contents($filename, $imageData)) {
    $apiKey = '9sde5bG2M-SBziWiswWVUgR8DAWV-6Ik';
$apiSecret = 'XNG2HTDPCJWpIJ0eB3g4hDNtEpkhaoAG';

$imageFilePath1 = '/abc@123.png';
$imageFilePath2 = '/abc@123.png';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api-us.faceplusplus.com/facepp/v3/compare');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, [
    'api_key' => $apiKey,
    'api_secret' => $apiSecret,
    'image_file1' => curl_file_create($imageFilePath1),
    'image_file2' => curl_file_create($imageFilePath2),
]);

$response = curl_exec($ch);
curl_close($ch);

echo $response;
echo json_encode(['success' => true, 'message' => $response]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to save image']);
}



?>