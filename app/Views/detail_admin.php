<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="logo-pst.png">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">`
    <title>Detail Admin</title>
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
        <h1>Detail Admin</h1>
        <div class="form-group">
            <label>Username</label>
            <input type="text" value="<?= esc($admin['username']) ?>" readonly>
        </div>
        <div class="form-group">
            <label>Nama</label>
            <input type="text" value="<?= esc($admin['nama']) ?>" readonly>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" value="<?= esc($admin['email']) ?>" readonly>
        </div>
        <div class="form-group">
            <label>WhatsApp</label>
            <input type="text" value="<?= esc($admin['whatsapp']) ?>" readonly>
        </div>
        <div class="form-group">
            <label>Role</label>
            <input type="text" value="<?= esc($admin['role']) ?>" readonly>
        </div>
        <a href="/admin/settings" style="display: block; text-align: center; margin-top: 10px;">Kembali</a>
    </div>
</body>
</html>
