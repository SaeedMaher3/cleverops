<div class="whatsapp-chat">

    <div class="chat-sidebar">
        <div class="chat-search">
            <input type="text" placeholder="Search conversations...">
        </div>

        <div class="chat-contact active">
            <div class="chat-avatar">T</div>
            <div>
                <h4>Project Team</h4>
                <p>Workspace messages</p>
            </div>
            <span>Now</span>
        </div>
    </div>

    <div class="chat-window">

        <div class="chat-header">
            <div class="chat-avatar" id="chatHeaderAvatar">T</div>
            <div>
                <h3 id="chatHeaderName">Project Team</h3>
                <p id="chatHeaderStatus">Project workspace chat</p>
            </div>
        </div>

        <div class="chat-body" id="chatBody">
            @forelse($messages as $message)
                <div class="message {{ $message->user_id === auth()->id() ? 'sent' : 'received' }}">
                    @if($message->message)
                        <p>{{ $message->message }}</p>
                    @endif

                    @if($message->attachment_name)
                        <p>📎 {{ $message->attachment_name }}</p>
                    @endif

                    <span>
                        {{ $message->created_at->format('H:i') }}
                        @if($message->user_id === auth()->id())
                            ✓✓
                        @endif
                    </span>
                </div>
            @empty
                <div class="message received">
                    <p>No messages yet. Start the conversation 👋</p>
                    <span>Now</span>
                </div>
            @endforelse
        </div>

        <div class="chat-input">
            <button type="button" class="chat-emoji-btn" onclick="toggleEmojiBox()">😊</button>

            <input id="chatMessageInput" type="text" placeholder="Type a message">

            <button type="button" class="chat-attach-btn" onclick="document.getElementById('chatFileInput').click()">📎</button>
            <input type="file" id="chatFileInput" hidden>

            <button type="button" class="send-btn" onclick="sendChatMessageNow()">➤</button>
        </div>

        <div id="emojiBox" class="emoji-box">
            <button type="button" onclick="addEmoji('😂')">😂</button>
            <button type="button" onclick="addEmoji('🔥')">🔥</button>
            <button type="button" onclick="addEmoji('❤️')">❤️</button>
            <button type="button" onclick="addEmoji('👍')">👍</button>
            <button type="button" onclick="addEmoji('✅')">✅</button>
            <button type="button" onclick="addEmoji('👀')">👀</button>
        </div>

    </div>
</div>

<script>
const chatStoreUrl = "{{ route('projects.messages.store', $project) }}";
const chatCsrf = "{{ csrf_token() }}";

function sendChatMessageNow() {
    const input = document.getElementById('chatMessageInput');
    const fileInput = document.getElementById('chatFileInput');

    if (!input || !fileInput) return;

    const text = input.value.trim();
    const file = fileInput.files[0];

    if (text === '' && !file) return;

    const formData = new FormData();
    formData.append('message', text);

    if (file) {
        formData.append('attachment', file);
    }

    fetch(chatStoreUrl, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': chatCsrf,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) return;

        let shownText = text;

        if (file) {
            shownText = text ? text + '<br>📎 ' + file.name : '📎 ' + file.name;
        }

        appendSentMessage(shownText);

        input.value = '';
        fileInput.value = '';
    });
}

function appendSentMessage(text) {
    const chatBody = document.getElementById('chatBody');

    const time = new Date().toLocaleTimeString([], {
        hour: '2-digit',
        minute: '2-digit'
    });

    const message = document.createElement('div');
    message.className = 'message sent';
    message.innerHTML = `<p>${text}</p><span>${time} ✓✓</span>`;

    chatBody.appendChild(message);
    chatBody.scrollTop = chatBody.scrollHeight;
}

function toggleEmojiBox() {
    document.getElementById('emojiBox').classList.toggle('open');
}

function addEmoji(emoji) {
    const input = document.getElementById('chatMessageInput');
    input.value += emoji;
    input.focus();
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && e.target.id === 'chatMessageInput') {
        e.preventDefault();
        sendChatMessageNow();
    }
});
</script>