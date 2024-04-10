function sendMessage() {
    var userInput = document.getElementById("user-input");
    var userMessage = userInput.value.trim();

    if (userMessage !== "") {
        appendMessage(userMessage, "user");
        processUserMessage(userMessage);
        userInput.value = "";
    }
}

// Function to append a new message to the chat box
function appendMessage(message, sender) {
    var chatBox = document.getElementById("chat-box");
    var messageElement = document.createElement("div");
    messageElement.classList.add("chat-message");

    var profilePicClass = sender === "bot" ? "bot-pic" : "user-pic";
    var messageContentClass = sender === "bot" ? "bot-message" : "user-message";

    // Check if the message should be formatted as a structured list or code block
    var formattedMessage = formatBotResponse(message, sender);

    if (isCodeBlock(message)) {
        // Replace single quotes in the message with escaped single quotes for HTML display
        var escapedMessage = message.replace('```', "");
        var escapedMessage = message.replace('```', "");

        // Display as code block
        messageElement.innerHTML = `
            <img class="profile-pic ${profilePicClass}" src="img/${sender}.png" alt="${sender}">
            <div class="message-content code-block">
                <pre><code>${escapedMessage}</code></pre>
            </div>
        `;
    } else if (formattedMessage !== message) {
        // Display as structured list
        messageElement.innerHTML = `
            <img class="profile-pic ${profilePicClass}" src="img/${sender}.png" alt="${sender}">
            <div class="message-content">
                ${formattedMessage}
            </div>
        `;
    } else {
        // Display as regular text
        messageElement.innerHTML = `
            <img class="profile-pic ${profilePicClass}" src="img/${sender}.png" alt="${sender}">
            <div class="message-content">
                ${message}
            </div>
        `;
    }

    messageElement.classList.add(messageContentClass);
    chatBox.appendChild(messageElement);
    chatBox.scrollTop = chatBox.scrollHeight;
}

// Function to check if a message is a code block (e.g., C code)
function isCodeBlock(message) {
    return message.includes("```") && message.includes("```");
}



// Function to format bot's response as a structured list if applicable
function formatBotResponse(message, sender) {
    // Check if the sender is "bot" and message is in the specific format
    if (sender === "bot" && message.startsWith("**") && message.includes("**")) {
        var sections = message.split("**").filter(Boolean); // Split into sections
        var formattedMessage = '';

        sections.forEach((section, index) => {
            if (index % 2 === 0) { // Even index corresponds to section header
                formattedMessage += `<strong>${section}</strong><ul>`;
            } else { // Odd index corresponds to list of items
                var items = section.trim().split('*').filter(Boolean); // Split into items
                items.forEach(item => {
                    formattedMessage += `<li>${item.trim()}</li>`;
                });
                formattedMessage += `</ul>`;
            }
        });

        return formattedMessage;
    }

    // Default behavior: return the message as-is
    return message;
}


function processUserMessage(message) {
    // Show loading indicator
    var loadingIndicator = document.getElementById("loading-indicator");
    loadingIndicator.style.display = "block";

    fetch('generator.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ message: message })
    })
    .then(response => response.json())
    .then(data => {
        var botResponse = data.response;
        appendMessage(botResponse, "bot");

        // Hide loading indicator after receiving response
        loadingIndicator.style.display = "none";
    })
    .catch(error => {
        console.error('Error:', error);
        var botResponse = "Oops! Something went wrong. Please check your internet connection.";
        appendMessage(botResponse, "bot");

        // Hide loading indicator on error
        loadingIndicator.style.display = "none";
    });
}


document.getElementById("user-input").addEventListener("keydown", function(event) {
    if (event.keyCode === 13) {
        sendMessage();
    }
});
