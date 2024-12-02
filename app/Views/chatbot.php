<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PST Menjawab BPS Provinsi DKI Jakarta</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header {
            background-color: #ff7f50;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
        .header img {
            width: 50px;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .chatbot-buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .chatbot-button {
            background-color: #ff7f50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
        }
        .chatbot-button:hover {
            background-color: #ff6347;
        }
        .chat-window {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            height: 300px;
            overflow-y: scroll;
            display: flex;
            flex-direction: column;
        }
        .bubble {
            background-color: #ffdab9;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 10px;
            max-width: 80%;
            align-self: flex-start;
        }
        .user-bubble {
            background-color: #d1e7dd;
            align-self: flex-end;
        }
        .contact-details {
            background-color: #ffdab9;
            padding: 20px;
            margin-top: 20px;
            text-align: center;
        }
        .contact-details p {
            margin: 5px 0;
        }
        .footer {
            background-color: #ff7f50;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }
        .social-media img {
            width: 30px;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="logo.png" alt="Logo">
        <h1>PST Menjawab BPS Provinsi DKI Jakarta</h1>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/consultation">Konsultasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/chatbot">Chatbot</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/consultation/checkReservation">Cek Reservasi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="chatbot-buttons">
            <a href="/" class="chatbot-button">Kembali</a>
            <a href="/chatbot" class="chatbot-button">Obrolan Baru</a>
        </div>
        <h2 class="text-center">ChatBot</h2>
        <div class="chat-window" id="chat-window">
            <!-- Pesan akan muncul di sini -->
        </div>
        <form id="chat-form">
            <div class="form-group">
                <input type="text" class="form-control" id="chat" name="chat" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Kirim</button>
        </form>
        <div class="contact-details">
            <h3>Badan Pusat Statistik</h3>
            <p>Provinsi DKI Jakarta</p>
            <p>Jl. Salemba Tengah No. 36-38 Paseban Senen Jakarta Pusat</p>
            <p>Phone: (021) 31928243</p>
            <p>Fax: (021) 31900245</p>
            <p>Email: bps3100@bps.go.id</p>
            <p>Website: <a href="https://www.bps.go.id">Website Badan Pusat Statistik</a></p>
        </div>
    </div>
    <div class="footer">
        <p>&copy; 2024 BPS Provinsi DKI Jakarta</p>
        <div class="social-media">
            <img src="social1.png" alt="Instagram">
            <img src="social2.png" alt="Media Sosial 2">
            <img src="social3.png" alt="Media Sosial 3">
            <img src="social4.png" alt="Media Sosial 4">
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('chat-form').addEventListener('submit', function(e) {
            e.preventDefault();

            var chat = document.getElementById('chat').value;

            var chatWindow = document.getElementById('chat-window');

            // Buat elemen bubble pesan untuk chat
            var bubbleChat = document.createElement('div');
            bubbleChat.classList.add('bubble', 'user-bubble');
            bubbleChat.innerText = chat;
            chatWindow.appendChild(bubbleChat);

            // Scroll chat window ke bawah
            chatWindow.scrollTop = chatWindow.scrollHeight;

            // Bersihkan form
            document.getElementById('chat-form').reset();
        });
    </script>
</body>
</html>
