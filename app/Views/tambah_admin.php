<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">`
    <title>Tambah Admin</title>
    <link rel="icon" href="/assets/images/logo-pst.png">
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
        <h1>Tambah Admin</h1>
        <?php if (session()->getFlashdata('errors')): ?>
            <div style="color: red;">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <p><?= esc($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="/admin/manage/store" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="<?= old('username') ?>" maxlength="20" required>
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" value="<?= old('nama') ?>" maxlength="20" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= old('email') ?>" maxlength="50" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>WhatsApp</label>
                <input type="text" name="whatsapp" value="<?= old('whatsapp') ?>" maxlength="20" required>
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role" required>
                    <option value="admin" <?= old('role') == 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="superadmin" <?= old('role') == 'superadmin' ? 'selected' : '' ?>>Superadmin</option>
                </select>
            </div>
            <button type="submit">Simpan</button>
        </form>
        <a href="/admin/settings" style="display: block; text-align: center; margin-top: 10px;">Kembali</a>
    </div>
</body>
</html>
