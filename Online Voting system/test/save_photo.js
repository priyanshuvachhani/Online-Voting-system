const video = document.getElementById('webcam');
navigator.mediaDevices.getUserMedia({ video: true })
    .then(stream => video.srcObject = stream)
    .catch(err => console.error("Webcam error:", err));

function captureImage() {
    const canvas = document.createElement('canvas');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0);

    // Convert the canvas image to a base64-encoded image
    const dataUrl = canvas.toDataURL('image/jpg');

    // Send the image to PHP for saving
    fetch('save_photo.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ image: dataUrl })
    })
        .then(response => response.json())
        .then(data => document.getElementById("status").innerText = data.message)
        .catch(err => console.error("Error:", err));
}