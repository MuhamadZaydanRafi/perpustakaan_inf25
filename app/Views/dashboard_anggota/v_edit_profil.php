<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>

        <div class="card-body">
            <?php 
            session();
            $validation = \Config\Services::validation();
            ?>

            <?= form_open_multipart('anggota/updateprofil/' . session()->get('id_anggota')) ?>

            <div class="row">
                <!-- Email -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" 
                               name="nim" 
                               value="<?= $anggota['nim'] ?>" 
                               class="form-control <?= isset(session('errors')['nim']) ? 'is-invalid' : '' ?>">
                        <div class="invalid-feedback">
                            <?= session('errors')['nim'] ?? '' ?>
                        </div>
                    </div>
                </div>

                <!-- Password -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" 
                               name="password"
                               placeholder="Kosongkan jika tidak ingin mengganti password"
                               class="form-control <?= isset(session('errors')['password']) ? 'is-invalid' : '' ?>">
                        <div class="invalid-feedback">
                            <?= session('errors')['password'] ?? '' ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Nama Anggota -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nama Anggota</label>
                        <input type="text" 
                               name="nama_anggota" 
                               value="<?= $anggota['nama_anggota'] ?>" 
                               class="form-control <?= isset(session('errors')['nama_anggota']) ? 'is-invalid' : '' ?>">
                        <div class="invalid-feedback">
                            <?= session('errors')['nama_anggota'] ?? '' ?>
                        </div>
                    </div>
                </div>
                 <!-- Dropdown Jenis Kelamin -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input type="text" 
                               name="jenis_kelamin" 
                               value="<?= $anggota['jenis_kelamin'] ?>" 
                               class="form-control <?= isset(session('errors')['jenis_kelamin']) ? 'is-invalid' : '' ?>">
                        <div class="invalid-feedback">
                            <?= session('errors')['jenis_kelamin'] ?? '' ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Dropdown Kelas -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Kelas</label>
                        <select name="id_kelas" 
                                class="form-control <?= isset(session('errors')['id_kelas']) ? 'is-invalid' : '' ?>">
                            <option value="">-- Pilih Kelas --</option>
                            <?php foreach ($kelas as $k): ?>
                                <option value="<?= $k['id_kelas'] ?>" 
                                    <?= $anggota['id_kelas'] == $k['id_kelas'] ? 'selected' : '' ?>>
                                    <?= $k['nama_kelas'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= session('errors')['id_kelas'] ?? '' ?>
                        </div>
                    </div>
                </div>

                <!-- No HP -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" 
                               name="no_hp" 
                               value="<?= $anggota['no_hp'] ?>" 
                               class="form-control <?= isset(session('errors')['no_hp']) ? 'is-invalid' : '' ?>">
                        <div class="invalid-feedback">
                            <?= session('errors')['no_hp'] ?? '' ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Alamat Anggota</label>
                        <textarea type="text-area" 
                               name="alamat" 
                               class="form-control <?= isset(session('errors')['alamat']) ? 'is-invalid' : '' ?>"><?= $anggota['alamat'] ?></textarea>
                        <div class="invalid-feedback">
                            <?= session('errors')['alamat'] ?? '' ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Foto -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Foto</label>
                        <div>
                            <img src="<?= base_url('uploads/anggota/' . $anggota['foto']) ?>" 
                                 width="200px" class="img-thumbnail mb-2">
                        </div>
                        <input type="file" name="foto" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary btn-flat" type="submit">Simpan</button>
            <a href="<?= base_url('anggota/dashboard') ?>" class="btn btn-success btn-flat">Kembali</a>

            <?= form_close() ?>
        </div>
    </div>
</div>
