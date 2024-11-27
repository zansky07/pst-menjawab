<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Konsultasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group textarea {
            height: 100px;
        }
        .form-group button {
            padding: 10px 20px;
            background-color: #ff7f50;
            border: none;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #ff6347;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Form Konsultasi</h2>
        <form action="/konsultasi/reservasi/submit" method="post">
            <div class="form-group">
                <label for="nama">Nama Konsumen</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="email">Alamat email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="whatsapp">Nomor Whatsapp</label>
                <input type="text" id="whatsapp" name="whatsapp" required>
            </div>
            <div class="form-group">
                <label for="topik">Topik</label>
                <input type="text" id="topik" name="topik" required>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <input type="text" id="kategori" name="kategori" required>
            </div>
            <div class="form-group">
                <label for="lingkup">Lingkup</label>
                <input type="text" id="lingkup" name="lingkup" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Kirim</button>
            </div>
        </form>
        <div class="footer">
            <p>Alamat Pusat Statistik Provinsi DKI Jakarta</p>
            <p>Jl. Jatinegara Tanah No. 36-38, Bali Mester, Jatinegara, Jakarta Timur 13310</p>
            <p>Phone: (021) 8196491</p>
            <p>Email: bps3171@bps.go.id</p>
        </div>
    </div>
</body>
</html>
