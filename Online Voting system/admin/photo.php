<?php
session_start();
//relod
if (isset($_SESSION['admin'])) {
    header("Location: home.php");
} elseif (isset($_SESSION['verification'])) {
    header("Location: home_verification.php");
} elseif (isset($_SESSION['manager'])) {
    header("Location: home_manager.php");
} elseif (isset($_SESSION['counter'])) {
    header("Location: home_counter.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
    header('Content-Type: application/json');

    $input = json_decode(file_get_contents("php://input"), true);
    if (!$input || !isset($input['image'])) {
        echo json_encode(['success' => false, 'message' => 'No image received']);
        exit;
    }

    $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $input['image']));



    if (isset($_SESSION['a'])) {
        $filename = '../image/Face Recognition/' . $_SESSION['a'] . '.jpg';
    } elseif (isset($_SESSION['v'])) {
        $filename = '../image/Face Recognition/' . $_SESSION['v'] . '.jpg';
    } elseif (isset($_SESSION['m'])) {
        $filename = '../image/Face Recognition/' . $_SESSION['m'] . '.jpg';
    } elseif (isset($_SESSION['c'])) {
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
        <table align="center">
            <tr>
                <td><video id="webcam" width="280px" autoplay></video></td>
            </tr>
            <tr>
                <td><button type="button" onclick="captureImage()" class="lbtn">Capture Photo</button></td>
            </tr>
            <tr>
                <td>
                    <div id="status"></div>
                </td>
            </tr>
        </table>
    </form>

    <script>
        if (localStorage.getItem("redirectCount") === null) {
            localStorage.setItem("redirectCount", "0");
        }
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