<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Admin dan Konsultan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
        .header {
            text-align: center;
            padding: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f04e30;
            color: #fff;
        }
        .btn {
            padding: 5px 10px;
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 4px;
        }
        .btn-detail {
            background-color: #28a745;
        }
        .btn-delete {
            background-color: #dc3545;
        }
        .btn:hover {
            opacity: 0.8;
        }
        .section {
            margin-top: 40px;
        }
        .btn-add {
            background-color: #007bff;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin">Dashboard</a>
                        </li>    
                        <li class="nav-item">
                            <a class="nav-link" href="/statistik">Statistik</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/pengaturan">Pengaturan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/logout">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php if (session()->getFlashdata('message')): ?>
                <p style="color: green;"><?= session()->getFlashdata('message') ?></p>
        <?php endif; ?>
        <h1 class="header">Daftar Admin</h1>
        <a href="/admin/tambah" class="btn btn-add">Tambah Admin</a>
        <table>
            <thead>
                <tr>
                    <th>Nama Admin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($admins) && is_array($admins)): ?>
                    <?php foreach ($admins as $admin): ?>
                        <tr>
                            <td><?= esc($admin['nama']) ?></td>
                            <td>
                                <a href="/admin/detail/<?= $admin['id'] ?>" class="btn btn-detail">Detail</a>
                                <a href="/admin/delete/<?= $admin['id'] ?>" class="btn btn-delete">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">Tidak ada data admin.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        
        <div class="section">
            <h1 class="header">Daftar Konsultan</h1>
            <a href="/konsultan/tambah" class="btn btn-add">Tambah Konsultan</a>
            <table>
                <thead>
                    <tr>
                        <th>Nama Konsultan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($konsultans) && is_array($konsultans)): ?>
                        <?php foreach ($konsultans as $konsultan): ?>
                            <tr>
                                <td><?= esc($konsultan['nama']) ?></td>
                                <td>
                                    <a href="/konsultan/detail/<?= $konsultan['id'] ?>" class="btn btn-detail">Detail</a>
                                    <a href="/konsultan/delete/<?= $konsultan['id'] ?>" class="btn btn-delete">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2">Tidak ada data konsultan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
