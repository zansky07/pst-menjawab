<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian - Status Reservasi</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f8f8; margin: 0; padding: 0; }
        .container { width: 50%; margin: 0 auto; background-color: #fff; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 8px; }
        .status { margin-top: 20px; padding: 20px; background-color: #ffdab9; border-radius: 8px; text-align: center; }
        .footer { margin-top: 20px; text-align: center; font-size: 14px; color: #666; }
        .button-container { margin-top: 20px; text-align: center; }
        .btn { display: inline-block; padding: 10px 20px; font-size: 16px; color: #fff; background-color: #007BFF; text-decoration: none; border-radius: 5px; border: none; cursor: pointer; }
        .btn:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hasil Pencarian</h2>
        <div class="status">
            <?php if(isset($reservation)): ?>
                <p>Nomor Token: <?= esc($token) ?></p>
                <p>Tanggal Reservasi: <?= esc($reservation['date']) ?></p>
                <p>Status Reservasi: <?= esc($reservation['status']) ?></p>
                
                <!-- Formulir untuk mengirim token -->
                <div class="button-container">
                    <form action="/konsultasi/reservasi/feedback" method="post">
                        <input type="hidden" name="token" value="<?= esc($token) ?>">
                        <button type="submit" class="btn">Beri Feedback</button>
                    </form>
                </div>
            <?php else: ?>
                <p><?= esc($error) ?></p>
            <?php endif; ?>
        </div>
    </div>
    <div class="footer">
        <p>Alamat Pusat Statistik Provinsi DKI Jakarta</p>
        <p>Jl. Jatinegara Tanah No. 36-38, Bali Mester, Jatinegara, Jakarta Timur 13310</p>
        <p>Phone: (021) 8196491</p>
        <p>Email: bps3171@bps.go.id</p>
    </div>
</body>
</html>
