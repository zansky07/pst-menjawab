<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Umpan Balik</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f8f8; margin: 0; padding: 0; }
        .container { width: 50%; margin: 0 auto; background-color: #fff; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 8px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input, .form-group textarea, .form-group select, .form-group button { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        .form-group textarea { height: 100px; }
        .form-group button { background-color: #ff7f50; color: #fff; border: none; cursor: pointer; font-size: 16px; }
        .form-group button:hover { background-color: #ff6347; }
        .footer { margin-top: 20px; text-align: center; font-size: 14px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Formulir Umpan Balik</h2>
        <form action="/consultation/feedback/submit" method="post">
            <div class="form-group">
                <label for="token">Token</label>
                <input type="text" id="token" name="token" value="<?= esc($token) ?>" readonly>
            </div>
            <div class="form-group">
                <label for="kendala">Apakah anda mengalami kendala saat memakai layanan kami? Jika ya, apa?</label>
                <textarea id="kendala" name="kendala"></textarea>
            </div>
            <div class="form-group">
                <label for="konsultasi">Seberapa besar kemungkinan Anda akan melakukan konsultasi lagi kepada kami di masa mendatang dalam skala 1-10?</label>
                <input type="number" id="konsultasi" name="konsultasi" min="1" max="10" required>
            </div>
            <div class="form-group">
                <label for="kesulitan">Kesulitan penggunaan website kami 1-10?</label>
                <input type="number" id="kesulitan" name="kesulitan" min="1" max="10" required>
            </div>
            <div class="form-group">
                <label for="terjawab">Apakah kebutuhan anda terjawab (Ya/Tidak)?</label>
                <select id="terjawab" name="terjawab" required>
                    <option value="Ya">Ya</option>
                    <option value="Tidak">Tidak</option>
                </select>
            </div>
            <div class="form-group">
                <label for="kepuasan">Seberapa puas anda terhadap layanan ini dalam skala 1-10?</label>
                <input type="number" id="kepuasan" name="kepuasan" min="1" max="10" required>
            </div>
            <div class="form-group">
                <label for="kritik_saran">Kritik dan Saran</label>
                <textarea id="kritik_saran" name="kritik_saran"></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Kirim</button>
            </div>
        </form>
    </div>
    <div class="footer">
        <p>Alamat Pusat Statistik Provinsi DKI Jakarta</p>
        <p>Jl. Jatinegara Tanah No. 36-38, Bali Mester, Jatinegara, Jakarta Timur 13310</p>
        <p>Phone: (021) 8196491</p>
        <p>Email: bps3171@bps.go.id</p>
    </div>
</body>
</html>
