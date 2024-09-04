document.addEventListener('DOMContentLoaded', function() {
    // Hide the chat window initially
    var chatWindow = document.getElementById('chat-window');
    chatWindow.style.display = 'none';

    // Add event listener for the message icon
    document.getElementById('message-icon').addEventListener('click', function() {
        // Toggle the display property of the chat window
        chatWindow.style.display = chatWindow.style.display === 'none' || chatWindow.style.display === '' ? 'flex' : 'none';
    });

    // Add event listener for the close button
    document.getElementById('close-chat').addEventListener('click', function() {
        chatWindow.style.display = 'none'; // Hide the chat window
    });

    // Add event listener for the chat form submission
    document.getElementById('chat-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the page from refreshing

        var messageInput = document.getElementById('message-input');
        var message = messageInput.value.trim();
        if (message === '') return;

        // Create a new message element
        var messageDiv = document.createElement('div');
        messageDiv.className = 'message message-sent'; // Use 'message-sent' class for sent messages
        messageDiv.innerHTML = '<div class="message-text">' + message + '</div>' +
                                '<small>' + new Date().toLocaleString() + '</small>';

        // Append the new message to the messages container
        var messagesDiv = document.getElementById('messages');
        messagesDiv.appendChild(messageDiv);
        messagesDiv.scrollTop = messagesDiv.scrollHeight; // Scroll to the bottom

        messageInput.value = ''; // Clear the input field
    });
});
