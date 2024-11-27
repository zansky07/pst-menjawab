<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Reservasi - BPS Provinsi DKI Jakarta</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f8f8; margin: 0; padding: 0; }
        .container { width: 50%; margin: 0 auto; background-color: #fff; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 8px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input, .form-group button { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        .form-group button { background-color: #ff7f50; color: #fff; border: none; cursor: pointer; font-size: 16px; }
        .form-group button:hover { background-color: #ff6347; }
        .footer { margin-top: 20px; text-align: center; font-size: 14px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Status Reservasi</h2>
        <form action="/konsultasi/checkStatus" method="post">
            <div class="form-group">
                <label for="token">Masukkan Token Anda</label>
                <input type="text" id="token" name="token" required>
            </div>
            <div class="form-group">
                <button type="submit">Cek Status</button>
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
