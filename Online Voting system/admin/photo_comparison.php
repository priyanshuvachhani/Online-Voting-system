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
?>
<html>

<head>
    <title> Login </title>
    <link rel="icon" type="image/x-icon" href="../image/logo.jpg">
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <h3 id="result"></h3>

    <script>
        onload = compareFaces;

        const API_KEY = "2j9J1BZIykdkMbVjbAvOgOrCacfiqyC9";
        const API_SECRET = "JrRcRkD4X3kiR61t49-bVDHQl6RxD9Ga";

        async function compareFaces() {
            try {
                document.getElementById("result").innerText = "Loading server images...";



                <?php if (isset($_SESSION['a'])) { ?>
                    const file1 = await urlToFile("http://localhost/Online%20Voting%20system/image/Admin/<?php echo $_SESSION['a']; ?>.jpg", "a.jpg");
                    const file2 = await urlToFile("http://localhost/Online%20Voting%20system/image/Face%20Recognition/<?php echo $_SESSION['a']; ?>.jpg", "b.jpg");
                <?php } elseif (isset($_SESSION['v'])) { ?>
                    const file1 = await urlToFile("http://localhost/Online%20Voting%20system/image/Home%20Verification/<?php echo $_SESSION['v']; ?>.jpg", "a.jpg");
                    const file2 = await urlToFile("http://localhost/Online%20Voting%20system/image/Face%20Recognition/<?php echo $_SESSION['v']; ?>.jpg", "b.jpg");
                <?php } elseif (isset($_SESSION['m'])) { ?>
                    const file1 = await urlToFile("http://localhost/Online%20Voting%20system/image/Booth%20Manager/<?php echo $_SESSION['m']; ?>.jpg", "a.jpg");
                    const file2 = await urlToFile("http://localhost/Online%20Voting%20system/image/Face%20Recognition/<?php echo $_SESSION['m']; ?>.jpg", "b.jpg");
                <?php } elseif (isset($_SESSION['c'])) { ?>
                    const file1 = await urlToFile("http://localhost/Online%20Voting%20system/image/Vote%20Counter/<?php echo $_SESSION['c']; ?>.jpg", "a.jpg");
                    const file2 = await urlToFile("http://localhost/Online%20Voting%20system/image/Face%20Recognition/<?php echo $_SESSION['c']; ?>.jpg", "b.jpg");
                <?php } ?>



                document.getElementById("result").innerText = "Detecting faces...";

                const token1 = await getFaceToken(file1);
                const token2 = await getFaceToken(file2);

                document.getElementById("result").innerText = "Comparing faces...";

                let compareData;
                while (true) {
                    try {
                        const formData = new FormData();
                        formData.append("api_key", API_KEY);
                        formData.append("api_secret", API_SECRET);
                        formData.append("face_token1", token1);
                        formData.append("face_token2", token2);

                        const compareResponse = await fetch("https://api-us.faceplusplus.com/facepp/v3/compare", {
                            method: "POST",
                            body: formData
                        });

                        compareData = await compareResponse.json();

                        if (compareData && !compareData.error_message) break;

                        throw new Error(compareData.error_message || "Unknown response error");
                    } catch (error) {
                        if (error.message.includes("Failed to fetch")) {
                            console.warn("Fetch failed, retrying...");
                            document.getElementById("result").innerText = "Comparing faces...";
                            await new Promise(resolve => setTimeout(resolve, 2000));
                        } else {
                            document.getElementById("result").innerText = "⚠️ Error: " + error.message;
                            return;
                        }
                    }
                }

                if (compareData.confidence !== undefined) {
                    const confidence = compareData.confidence;
                    //document.getElementById("result").innerText = "✅ Confidence Score: " + confidence + "%";

                    if (confidence > 85) {
                        document.getElementById("result").innerText = "✅ Confidence Score";

                        fetch('set_session.php')
                            .then(response => response.text())
                            .then(data => {
                                window.location.href = "login.php";
                            })
                            .catch(error => {
                                console.error("Error:", error);
                                window.location.href = "login.php";
                            });

                    } else {
                        document.getElementById("result").innerText = "❌ Faces is not compared";
                        window.location.href = "login.php";
                    }

                } else {
                    document.getElementById("result").innerText = "❌ Failed to compare faces: " + (compareData.error_message || "Unknown error");
                    window.location.href = "login.php";
                }
            } catch (error) {
                document.getElementById("result").innerText = "⚠️ Error: " + error.message;
                window.location.href = "photo_comparison.php";
            }
        }

        async function getFaceToken(imageFile) {
            const formData = new FormData();
            formData.append("api_key", API_KEY);
            formData.append("api_secret", API_SECRET);
            formData.append("image_file", imageFile);

            const response = await fetch("https://api-us.faceplusplus.com/facepp/v3/detect", {
                method: "POST",
                body: formData
            });

            const data = await response.json();
            if (data.faces && data.faces.length > 0) {
                return data.faces[0].face_token;
            } else {
                throw new Error("No face detected in one of the images.");
            }
        }

        async function urlToFile(url, filename) {
            const response = await fetch(url);
            const blob = await response.blob();
            const type = blob.type || "image/jpeg";
            return new File([blob], filename, {
                type
            });
        }
    </script>
</body>

</html>