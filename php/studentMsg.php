<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>One Way Message Sender</title>
<style>
    body {
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

#message-form {
    text-align: center;
    border: 2px solid #ccc;
    border-radius: 8px;
    padding: 20px;
    max-width: 400px; /* Limit the width of the form */
}

#message-input {
    width: calc(100% - 20px); /* Adjust for padding */
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

#message-container {
    margin-top: 20px;
}


</style>
</head>
<body>

<div id="message-form">
    <h2>Send a Single Message</h2>
    <form id="send-message-form">
        <input type="text" id="message-input" placeholder="Type your message...">
        <button type="submit">Send</button>
    </form>
    <div id="message-container"></div>
</div>

<script>
    document.getElementById('send-message-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission
        var message = document.getElementById('message-input').value;
        showMessage(message);
    });

    
</script>

</body>
</html>
