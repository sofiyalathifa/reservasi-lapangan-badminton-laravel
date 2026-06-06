@extends('layouts.app')

@section('content')

@php
    $lawanBicara = $chatRoom->pengirim_id == auth()->id() ? $chatRoom->penerima : $chatRoom->pengirim;
@endphp

<style>
    /* Chat container fixed fullscreen */
    .chat-container {
        position: fixed;
        top: 100px;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 40;
        display: flex;
        justify-content: center;
        align-items: stretch;
        background-color: #eae6df;
    }
    .chat-wrapper {
        width: 100%;
        max-width: 56rem;
        display: flex;
        flex-direction: column;
        height: 100%;
        background: #fff;
        border-left: 1px solid #d1d5db;
        border-right: 1px solid #d1d5db;
        overflow: hidden;
    }

    /* Header */
    .chat-header {
        padding: 10px 16px;
        background-color: #f0f2f5;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-shrink: 0;
    }
    .chat-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .chat-header .back-btn {
        color: #6b7280;
        text-decoration: none;
        display: flex;
        align-items: center;
        transition: color 0.2s;
    }
    .chat-header .back-btn:hover {
        color: #374151;
    }
    .chat-avatar {
        width: 42px;
        height: 42px;
        background: linear-gradient(135deg, #4ade80, #22d3ee);
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 18px;
        text-transform: uppercase;
        flex-shrink: 0;
    }
    .chat-user-name {
        font-weight: 700;
        color: #1f2937;
        font-size: 15px;
        line-height: 1.3;
        margin: 0;
    }
    .chat-user-status {
        font-size: 12px;
        color: #22c55e;
        margin: 0;
        font-weight: 500;
    }
    .chat-topic {
        font-size: 11px;
        background: #fff;
        padding: 4px 12px;
        border-radius: 9999px;
        border: 1px solid #e5e7eb;
        color: #6b7280;
        white-space: nowrap;
    }

    /* Chat Body */
    .chat-body {
        flex: 1;
        overflow-y: auto;
        padding: 16px 48px;
        display: flex;
        flex-direction: column;
        background-color: #efeae2;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23000000' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        min-height: 0;
    }

    /* Security notice */
    .chat-notice {
        margin: 0 auto 20px auto;
        border: 1px solid #fde68a;
        color: #92400e;
        font-size: 12px;
        padding: 6px 16px;
        border-radius: 8px;
        text-align: center;
        background-color: #fef9c3;
        max-width: 22rem;
        line-height: 1.5;
    }

    /* Message bubbles */
    .msg-row {
        display: flex;
        margin-bottom: 4px;
    }
    .msg-row-right {
        justify-content: flex-end;
    }
    .msg-row-left {
        justify-content: flex-start;
    }
    .msg-bubble {
        position: relative;
        padding: 6px 8px 20px 8px;
        border-radius: 8px;
        max-width: 65%;
        min-width: 80px;
        box-shadow: 0 1px 1px rgba(0,0,0,0.06);
        word-wrap: break-word;
    }
    .msg-mine {
        background-color: #d9fdd3;
        border-top-right-radius: 2px;
    }
    .msg-theirs {
        background-color: #ffffff;
        border-top-left-radius: 2px;
    }
    .msg-text {
        font-size: 14.5px;
        line-height: 1.45;
        margin: 0;
        color: #111b21;
    }
    .msg-meta {
        position: absolute;
        bottom: 3px;
        right: 7px;
        display: flex;
        align-items: center;
        gap: 3px;
    }
    .msg-time {
        font-size: 11px;
        color: #667781;
    }
    .msg-check {
        width: 16px;
        height: 11px;
        color: #53bdeb;
    }

    /* Footer */
    .chat-footer {
        padding: 8px 12px;
        background-color: #f0f2f5;
        border-top: 1px solid #e5e7eb;
        flex-shrink: 0;
    }
    .chat-form {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .chat-form .emoji-btn {
        color: #54656f;
        background: none;
        border: none;
        cursor: pointer;
        flex-shrink: 0;
        display: flex;
        align-items: center;
    }
    .chat-form .emoji-btn:hover {
        color: #374151;
    }
    .chat-input {
        flex: 1;
        padding: 9px 14px;
        border-radius: 8px;
        border: none;
        font-size: 15px;
        background: #fff;
        outline: none;
    }
    .chat-input:focus {
        box-shadow: none;
    }
    .chat-send-btn {
        background-color: #00a884;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        flex-shrink: 0;
        transition: background-color 0.2s;
    }
    .chat-send-btn:hover {
        background-color: #008f72;
    }

    /* Emoji Picker */
    .emoji-picker {
        display: none;
        position: absolute;
        bottom: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border-top: 1px solid #e5e7eb;
        z-index: 50;
        flex-direction: column;
        max-height: 280px;
    }
    .emoji-picker.active {
        display: flex;
    }
    .emoji-tabs {
        display: flex;
        border-bottom: 1px solid #eee;
        padding: 0;
        flex-shrink: 0;
        overflow-x: auto;
    }
    .emoji-tab {
        padding: 8px 12px;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 18px;
        border-bottom: 2px solid transparent;
        flex-shrink: 0;
        transition: background-color 0.15s;
    }
    .emoji-tab:hover {
        background-color: #f5f5f5;
    }
    .emoji-tab.active {
        border-bottom-color: #00a884;
    }
    .emoji-grid {
        display: grid;
        grid-template-columns: repeat(8, 1fr);
        gap: 2px;
        padding: 8px;
        overflow-y: auto;
        flex: 1;
    }
    .emoji-item {
        font-size: 24px;
        padding: 4px;
        border: none;
        background: none;
        cursor: pointer;
        border-radius: 6px;
        text-align: center;
        line-height: 1.3;
        transition: background-color 0.15s;
    }
    .emoji-item:hover {
        background-color: #f0f2f5;
    }

    /* Responsive */
    @media (max-width: 640px) {
        .chat-body {
            padding: 12px 16px;
        }
        .msg-bubble {
            max-width: 82%;
        }
        .chat-topic {
            display: none;
        }
        .emoji-grid {
            grid-template-columns: repeat(7, 1fr);
        }
    }
</style>

<div class="chat-container">
    <div class="chat-wrapper">

        <!-- Chat Header -->
        <div class="chat-header">
            <div class="chat-header-left">
                <a href="{{ route('komunitas.chat.index') }}" class="back-btn">
                    <svg style="width: 22px; height: 22px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <div class="chat-avatar">
                    {{ substr($lawanBicara->name, 0, 1) }}
                </div>
                <div>
                    <p class="chat-user-name">{{ $lawanBicara->name }}</p>
                    <p class="chat-user-status">online</p>
                </div>
            </div>
            <span class="chat-topic">📍 {{ $chatRoom->cariTeman->lokasi }}</span>
        </div>

        <!-- Chat Body -->
        <div class="chat-body" id="chatBox">
            <div class="chat-notice">
                🔒 Pesan dienkripsi secara end-to-end secara internal.<br>Jangan membagikan OTP atau pin Anda.
            </div>

            @foreach($chatRoom->pesanKomunitas as $msg)
                @if($msg->pengirim_id == auth()->id())
                    <div class="msg-row msg-row-right self-end">
                        <div class="msg-bubble msg-mine">
                            <p class="msg-text">{{ $msg->pesan }}</p>
                            <div class="msg-meta">
                                <span class="msg-time">{{ $msg->created_at->format('H:i') }}</span>
                                <svg class="msg-check" viewBox="0 0 16 11" fill="none"><path d="M11.071.653a.457.457 0 0 0-.304-.102.493.493 0 0 0-.381.178l-6.19 7.636-2.405-2.272a.463.463 0 0 0-.336-.136.475.475 0 0 0-.344.144.45.45 0 0 0 .012.636l2.728 2.58a.472.472 0 0 0 .67-.027l6.533-8.062a.448.448 0 0 0 .017-.575z" fill="currentColor"/><path d="M14.757.653a.457.457 0 0 0-.305-.102.493.493 0 0 0-.38.178l-6.19 7.636-1.166-1.102a.46.46 0 0 0-.063.488l.794.753a.472.472 0 0 0 .67-.027l6.533-8.062a.448.448 0 0 0 .107-.762z" fill="currentColor"/></svg>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="msg-row msg-row-left self-start">
                        <div class="msg-bubble msg-theirs">
                            <p class="msg-text">{{ $msg->pesan }}</p>
                            <div class="msg-meta">
                                <span class="msg-time">{{ $msg->created_at->format('H:i') }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Chat Footer -->
        <div class="chat-footer" style="position: relative;">
            <!-- Emoji Picker Panel -->
            <div class="emoji-picker" id="emojiPicker">
                <div class="emoji-tabs" id="emojiTabs">
                    <button class="emoji-tab active" data-category="smileys">😊</button>
                    <button class="emoji-tab" data-category="gestures">👋</button>
                    <button class="emoji-tab" data-category="hearts">❤️</button>
                    <button class="emoji-tab" data-category="animals">🐱</button>
                    <button class="emoji-tab" data-category="food">🍕</button>
                    <button class="emoji-tab" data-category="sports">⚽</button>
                    <button class="emoji-tab" data-category="objects">💡</button>
                </div>
                <div class="emoji-grid" id="emojiGrid">
                    <!-- Emojis will be populated by JS -->
                </div>
            </div>

            <form action="{{ route('komunitas.chat.send', $chatRoom->id) }}" method="POST" id="chatForm" class="chat-form">
                @csrf
                <button type="button" class="emoji-btn" id="emojiToggle">
                    <svg style="width: 26px; height: 26px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </button>
                <input type="text" name="pesan" id="pesanInput" required autocomplete="off" placeholder="Ketik pesan" class="chat-input">
                <button type="submit" class="chat-send-btn">
                    <svg style="width: 20px; height: 20px;" fill="currentColor" viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path></svg>
                </button>
            </form>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var chatBox = document.getElementById('chatBox');

        function scrollToBottom() {
            if (chatBox) {
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        }

        scrollToBottom();
        setTimeout(scrollToBottom, 200);
        setTimeout(scrollToBottom, 500);

        // ===== EMOJI PICKER =====
        var emojiData = {
            smileys: ['😀','😃','😄','😁','😆','😅','🤣','😂','🙂','😊','😇','🥰','😍','🤩','😘','😗','😚','😙','🥲','😋','😛','😜','🤪','😝','🤑','🤗','🤭','🫢','🤫','🤔','🫡','🤐','🤨','😐','😑','😶','🫥','😏','😒','🙄','😬','🤥','😌','😔','😪','🤤','😴','😷','🤒','🤕','🤢','🤮','🥴','😵','🤯','🥶','🥵','😱','😨','😰','😥','😢','😭','😤','😠','😡','🤬','💀','☠️','💩','🤡','👹','👺','👻','👽','🤖','😺','😸','😹','😻','😼','😽','🙀','😿','😾'],
            gestures: ['👋','🤚','🖐️','✋','🖖','🫱','🫲','🫳','🫴','👌','🤌','🤏','✌️','🤞','🫰','🤟','🤘','🤙','👈','👉','👆','🖕','👇','☝️','🫵','👍','👎','✊','👊','🤛','🤜','👏','🙌','🫶','👐','🤲','🤝','🙏','💪','🦾','🦿','🦵','🦶','👂','🦻','👃','👀','👁️','👅','👄','🫦','💋'],
            hearts: ['❤️','🧡','💛','💚','💙','💜','🖤','🤍','🤎','💔','❤️‍🔥','❤️‍🩹','❣️','💕','💞','💓','💗','💖','💘','💝','💟','♥️','🩷','🩵','🩶','💐','🌹','🥀','🌺','🌸','🌷','🌻','💫','⭐','🌟','✨','💥','🔥','🌈','☀️','🌤️','⛅','🌥️','☁️'],
            animals: ['🐱','🐶','🐭','🐹','🐰','🦊','🐻','🐼','🐻‍❄️','🐨','🐯','🦁','🐮','🐷','🐸','🐵','🙈','🙉','🙊','🐒','🐔','🐧','🐦','🐤','🐣','🦆','🦅','🦉','🦇','🐺','🐗','🐴','🦄','🐝','🪱','🐛','🦋','🐌','🐞','🐜','🪰','🪲','🪳','🦟','🦗','🐢','🐍','🦎','🦖','🦕','🐙','🦑','🦐','🦞','🦀','🐡','🐠','🐟','🐬','🐳','🐋','🦈','🦭','🐊'],
            food: ['🍕','🍔','🍟','🌭','🍿','🧂','🥓','🥚','🍳','🧇','🥞','🧈','🍞','🥐','🥖','🫓','🥨','🥯','🥝','🍇','🍈','🍉','🍊','🍋','🍌','🍍','🥭','🍎','🍏','🍐','🍑','🍒','🍓','🫐','🥦','🥬','🥒','🌶️','🫑','🌽','🥕','🫒','🧄','🧅','🥔','🍠','🍔','🌮','🌯','🫔','🥙','🧆','🥗','🍝','🍜','🍲','🍛','🍣','🍱','🥟','🍤','🍙','🍚','🍘','🍥','🥮','🍢','🍡','🍧','🍨','🍦','🥧','🧁','🍰','🎂','🍮','🍭','🍬','🍫','🍿','🍩','🍪','🌰','🥜','🍯','🥛','☕','🫖','🍵','🧃','🥤','🧋','🍶','🍺','🍻','🥂','🍷','🍸','🍹','🧉','🍾'],
            sports: ['⚽','🏀','🏈','⚾','🥎','🎾','🏐','🏉','🥏','🎱','🪀','🏓','🏸','🏒','🏑','🥍','🏏','🪃','🥅','⛳','🪁','🏹','🎣','🤿','🥊','🥋','🎽','🛹','🛼','🛷','⛸️','🥌','🎿','⛷️','🏂','🪂','🏋️','🤼','🤸','🤺','⛹️','🤾','🏌️','🏇','🧘','🏄','🏊','🤽','🚣','🧗','🚴','🚵','🏆','🥇','🥈','🥉','🏅','🎖️','🏵️','🎗️'],
            objects: ['💡','🔦','🕯️','🧯','💰','💵','💴','💶','💷','🪙','💸','💳','🧾','💹','📱','💻','⌨️','🖥️','🖨️','🖱️','🖲️','💽','💾','💿','📀','📸','📷','📹','🎥','📽️','🎬','📺','📻','🎙️','🎚️','🎛️','🧭','⏱️','⏲️','⏰','🕰️','📡','🔋','🪫','🔌','🔑','🗝️','🛠️','🔧','🔩','⚙️','🧰','🔗','📎','📏','📐','✂️','📌','📍','🗑️','📦','📫','📬','📭','📮','🏷️','📝','📄','📃']
        };

        var emojiPicker = document.getElementById('emojiPicker');
        var emojiGrid = document.getElementById('emojiGrid');
        var emojiToggle = document.getElementById('emojiToggle');
        var emojiTabs = document.getElementById('emojiTabs');
        var pesanInput = document.getElementById('pesanInput');

        // Render emoji grid
        function renderEmojis(category) {
            emojiGrid.innerHTML = '';
            var emojis = emojiData[category] || [];
            emojis.forEach(function(emoji) {
                var btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'emoji-item';
                btn.textContent = emoji;
                btn.addEventListener('click', function() {
                    pesanInput.value += emoji;
                    pesanInput.focus();
                });
                emojiGrid.appendChild(btn);
            });
        }

        // Toggle emoji picker
        emojiToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            emojiPicker.classList.toggle('active');
            if (emojiPicker.classList.contains('active')) {
                renderEmojis('smileys');
            }
        });

        // Tab switching
        emojiTabs.addEventListener('click', function(e) {
            var tab = e.target.closest('.emoji-tab');
            if (!tab) return;

            // Update active tab
            emojiTabs.querySelectorAll('.emoji-tab').forEach(function(t) {
                t.classList.remove('active');
            });
            tab.classList.add('active');

            renderEmojis(tab.dataset.category);
        });

        // Close picker when clicking outside
        document.addEventListener('click', function(e) {
            if (!emojiPicker.contains(e.target) && e.target !== emojiToggle && !emojiToggle.contains(e.target)) {
                emojiPicker.classList.remove('active');
            }
        });

        // ===== POLLING =====
        function pollMessages() {
            fetch("{{ route('komunitas.chat.room', $chatRoom->id) }}")
                .then(function(res) { return res.text(); })
                .then(function(html) {
                    var parser = new DOMParser();
                    var doc = parser.parseFromString(html, 'text/html');
                    var newChatBox = doc.getElementById('chatBox');

                    if (newChatBox) {
                        var currentCount = chatBox.querySelectorAll('.self-end, .self-start').length;
                        var newMessages = newChatBox.querySelectorAll('.self-end, .self-start');
                        var newCount = newMessages.length;

                        if (newCount > currentCount) {
                            for (var i = currentCount; i < newCount; i++) {
                                chatBox.appendChild(newMessages[i]);
                            }
                            scrollToBottom();
                        }
                    }
                });
        }

        setInterval(pollMessages, 5000);

        // ===== AJAX SUBMIT =====
        var form = document.getElementById('chatForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                var input = form.querySelector('input[name="pesan"]');
                if (!input.value.trim()) return;

                var formData = new FormData(form);
                input.value = '';
                input.focus();
                emojiPicker.classList.remove('active');

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                }).then(function() {
                    pollMessages();
                });
            });
        }
    });
</script>
@endsection

