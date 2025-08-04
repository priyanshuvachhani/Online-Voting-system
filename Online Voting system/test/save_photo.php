<?php
// Decode the JSON received
$input = json_decode(file_get_contents("php://input"), true);

if (!$input || !isset($input['image'])) {
    echo json_encode(['success' => false, 'message' => 'No image received']);
    exit;
}

// Decode the base64 image
$imageData = $input['image'];
$imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));

// Define the path to save the image
$filename = '../image/test/image.jpg';  // Save as a timestamped file in an 'uploads' folder

// Save the image file
if (file_put_contents($filename, $imageData)) {
    echo json_encode(['success' => true, 'message' => 'Image saved successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to save image']);
}

?>
