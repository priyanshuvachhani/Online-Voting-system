<?php
session_start();
//relod
if (isset($_SESSION['fullname']) && isset($_SESSION['acid']) && isset($_SESSION['vid'])) {
    header("Location: candidatelist.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
    header('Content-Type: application/json');

    $input = json_decode(file_get_contents("php://input"), true);
    if (!$input || !isset($input['image'])) {
        echo json_encode(['success' => false, 'message' => 'No image received']);
        exit;
    }

    $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $input['image']));



    if (isset($_SESSION['a']) && isset($_SESSION['b']) && isset($_SESSION['c']) && isset($_SESSION['d'])) {
        $filename = '../image/Face Recognition/' . $_SESSION['c'] . '.jpg';
    }



    if (file_put_contents($filename, $imageData)) {
        echo json_encode(['success' => true, 'message' => '', 'redirect' => 'photo_comparison.php']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save image']);
    }
    exit;
}
?>

<html>

<head>
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="../image/logo.jpg">
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <form method="POST" action="javascript:void(0);">
        <div class="login-box">
            <table align="center">
                <tr>
                    <td><video id="webcam" width="280px" autoplay></video></td>
                </tr>
                <tr>
                    <td><button type="button" onclick="captureImage()" class="btn">Capture Photo</button></td>
                </tr>
                <tr>
                    <td>
                        <div id="status"></div>
                    </td>
                </tr>
            </table>
        </div>
    </form>

    <script>
        const video = document.getElementById('webcam');
        navigator.mediaDevices.getUserMedia({
                video: true
            })
            .then(stream => video.srcObject = stream)
            .catch(err => console.error("Webcam error:", err));

        function captureImage() {
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);
            const dataUrl = canvas.toDataURL('image/jpeg');

            fetch(window.location.href, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        image: dataUrl
                    })
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById("status").innerText = data.message;
                    if (data.success && data.redirect) {
                        window.location.href = data.redirect;
                    }
                })
                .catch(err => {
                    console.error("Fetch error:", err);
                    document.getElementById("status").innerText = "Upload failed!";
                });
        }
    </script>
</body>

</html>