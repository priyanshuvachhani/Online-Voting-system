<!DOCTYPE html>
<html>
<head>
  <title>Face++ Token-Based Comparison</title>
</head>
<body>
  <h2>Face++ Token Comparison Demo</h2>

  <label>Image 1:</label>
  <input type="file" id="img1"><br><br>

  <label>Image 2:</label>
  <input type="file" id="img2"><br><br>

  <button onclick="compareFaces()">Compare Faces</button>

  <h3 id="result"></h3>

  <script>
    const API_KEY = "2j9J1BZIykdkMbVjbAvOgOrCacfiqyC9";
    const API_SECRET = "JrRcRkD4X3kiR61t49-bVDHQl6RxD9Ga";

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

    async function compareFaces() {
      try {
        const file1 = document.getElementById("img1").files[0];
        const file2 = document.getElementById("img2").files[0];

        if (!file1 || !file2) {
          alert("Please select both images.");
          return;
        }

        document.getElementById("result").innerText = "Detecting faces...";

        const token1 = await getFaceToken(file1);
        const token2 = await getFaceToken(file2);

        document.getElementById("result").innerText = "Comparing faces...";

        const formData = new FormData();
        formData.append("api_key", API_KEY);
        formData.append("api_secret", API_SECRET);
        formData.append("face_token1", token1);
        formData.append("face_token2", token2);

        const compareResponse = await fetch("https://api-us.faceplusplus.com/facepp/v3/compare", {
          method: "POST",
          body: formData
        });

        const compareData = await compareResponse.json();

        if (compareData.confidence !== undefined) {
          const confidence = compareData.confidence;
          document.getElementById("result").innerText =
            "✅ Confidence Score: " + confidence + "%";
        } else {
          document.getElementById("result").innerText =
            "❌ Failed to compare faces: " + (compareData.error_message || "Unknown error");
        }
      } catch (error) {
        document.getElementById("result").innerText = "⚠️ Error: " + error.message;
      }
    }
  </script>
</body>
</html>
