<!DOCTYPE html>
<html>
<head>
    <title>OpenAI Integration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">OpenAI Integration</h1>

        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Generate Text</h2>
            <textarea id="textPrompt" class="w-full p-2 border rounded" rows="4" placeholder="Enter your prompt here..."></textarea>
            <button onclick="generateText()" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Generate Text</button>
            <div id="textResult" class="mt-4 p-4 bg-white rounded shadow"></div>
        </div>

        <div>
            <h2 class="text-xl font-semibold mb-4">Generate Image</h2>
            <input type="text" id="imagePrompt" class="w-full p-2 border rounded" placeholder="Describe the image you want...">
            <button onclick="generateImage()" class="mt-2 px-4 py-2 bg-green-500 text-white rounded">Generate Image</button>
            <div id="imageResult" class="mt-4"></div>
        </div>
    </div>

    <script>
        async function generateText() {
            const prompt = document.getElementById('textPrompt').value;
            const resultDiv = document.getElementById('textResult');
            resultDiv.textContent = 'Loading...';

            try {
                const response = await fetch('/api/generate-text', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ prompt })
                });

                const data = await response.json();
                if (data.success) {
                    resultDiv.textContent = data.data;
                } else {
                    resultDiv.textContent = 'Error: ' + data.error;
                }
            } catch (error) {
                resultDiv.textContent = 'Error: ' + error.message;
            }
        }

        async function generateImage() {
            const prompt = document.getElementById('imagePrompt').value;
            const resultDiv = document.getElementById('imageResult');
            resultDiv.textContent = 'Loading...';

            try {
                const response = await fetch('/api/generate-image', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ prompt })
                });

                const data = await response.json();
                if (data.success) {
                    resultDiv.innerHTML = `<img src="${data.data}" alt="Generated image" class="mt-4 rounded shadow">`;
                } else {
                    resultDiv.textContent = 'Error: ' + data.error;
                }
            } catch (error) {
                resultDiv.textContent = 'Error: ' + error.message;
            }
        }
    </script>
</body>
</html>
