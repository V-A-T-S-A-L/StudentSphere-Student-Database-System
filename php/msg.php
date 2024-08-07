<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Messaging Website</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0; /* Setting background color */
        }

        .container {
            width: 80%; /* Set width to 80% */
            max-width: 600px; /* Set a max-width to prevent the content from becoming too wide */
            border: 2px solid #333; /* Changing border color and thickness */
            border-radius: 10px;
            padding: 20px;
            background-color: #fff; /* Setting background color */
        }

        .chat-box {
            height: 400px; /* Increasing height */
            width: 100%; /* Setting width to 100% */
            overflow-y: hidden;
            border: 2px solid #666; /* Changing border color and thickness */
            border-radius: 10px;
            padding: 0px;
            margin-bottom: 20px; /* Increasing margin */
            background-color: #f9f9f9; /* Setting background color */
        }

        input[type="text"] {
            width: calc(100% - 70px);
            padding: 10px;
            border-radius: 5px;
            border: 2px solid #666; /* Changing border color and thickness */
            margin-bottom: 10px;
        }

        button {
            padding: 12px 24px; /* Increasing padding */
            background-color: #4CAF50; /* Changing button color */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease; /* Adding transition effect */
        }

        button:hover {
            background-color: #45a049; /* Changing button color on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="chat-box" id="chat-box">
            <!-- Messages will be displayed here -->
        </div>
        <input type="text" id="message-input" placeholder="Type a message...">
        <button id="send-btn">Send</button>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const messageInput = document.getElementById('message-input');
            const sendButton = document.getElementById('send-btn');
            const chatBox = document.getElementById('chat-box');

            sendButton.addEventListener('click', function() {
                const message = messageInput.value.trim();
                if (message !== '') {
                    appendMessage('You', message);
                    messageInput.value = '';
                }
            });

            function appendMessage(sender, message) {
                const messageElement = document.createElement('div');
                messageElement.classList.add('message');
                messageElement.innerHTML = `<strong>${sender}:</strong> ${message}`;
                chatBox.appendChild(messageElement);
                chatBox.scrollTop = chatBox.scrollHeight; // Auto-scroll to bottom
            }
        });
    </script>
</body>
</html>
