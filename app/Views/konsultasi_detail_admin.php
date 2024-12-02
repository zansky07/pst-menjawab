<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Konsultasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f2f1;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select, textarea, button {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #f04e30;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detail Konsultasi</h1>
        <form action="/admin/consultation/detail/update/<?= $konsultasi['id'] ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label>Nama Konsumen</label>
                <input type="text" value="<?= esc($konsultasi['nama_konsumen']) ?>" readonly>
            </div>
            <div class="form-group">
                <label>Alamat Email</label>
                <input type="email" value="<?= esc($konsultasi['email_konsumen']) ?>" readonly>
            </div>
            <div class="form-group">
                <label>Topik</label>
                <input type="text" value="<?= esc($konsultasi['topik']) ?>" readonly>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <input type="text" value="<?= esc($konsultasi['kategori']) ?>" readonly>
            </div>
            <div class="form-group">
                <label>Lingkup</label>
                <input type="text" value="<?= esc($konsultasi['lingkup']) ?>" readonly>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea readonly><?= esc($konsultasi['deskripsi']) ?></textarea>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status_konsultasi"> 
                    <?php $status_konsultasies = ['Pending','Disetujui', 'Ditolak', 'Selesai']; 
                    foreach ($status_konsultasies as $status_konsultasi) { 
                        $selected = ($status_konsultasi == $konsultasi['status_konsultasi']) ? 'selected' : ''; echo "<option value=\"$status_konsultasi\" $selected>$status_konsultasi</option>"; } ?>
                </select>
            </div>
            <button type="submit">Simpan</button>
            <a href="/admin/dashboard" style="display: block; text-align: center; margin-top: 10px;">Kembali</a>
        </form>
    </div>
</body>
</html>
