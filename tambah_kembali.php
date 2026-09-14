<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Tambah Pengembalian Buku</h1>
                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>

                        <li class="breadcrumb-item">
                            Pengembalian
                        </li>

                        <li class="breadcrumb-item active">
                            Tambah
                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </section>


    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-header">

                    <a href="index.php?hal=pengembalian"
                       class="btn btn-success">

                        <i class="fas fa-arrow-left"></i>
                        Kembali

                    </a>

                </div>


                <form method="POST">

                    <div class="card-body">

                        <div class="form-group">

                            <label>
                                No Pengembalian
                            </label>

                            <div class="col-sm-10">

                                <input type="text"
                                       class="form-control"
                                       value="KB000001"
                                       readonly>

                            </div>

                        </div>


                       <div class="form-group">

                            <label>
                                Tanggal Kembali
                            </label>

                            <div class="col-sm-10">

                                <input type="date"
                                       class="form-control">

                            </div>

                        </div>


                       <div class="form-group">

                            <label>
                                No Peminjaman
                            </label>

                            <div class="col-sm-10">

                                <select class="form-control">

                                    <option value="">
                                        -- Pilih No Peminjaman --
                                    </option>

                                </select>

                            </div>

                        </div>


                    <div class="form-group">

                            <label>
                                No Anggota
                            </label>

                            <div class="col-sm-10">

                                <input type="text"
                                       class="form-control"
                                       readonly>

                            </div>

                        </div>


                    <div class="form-group">

                            <label>
                                Nama Anggota
                            </label>

                            <div class="col-sm-10">

                                <input type="text"
                                       class="form-control"
                                       readonly>

                            </div>

                        </div>


                       <div class="form-group">

                            <label>
                                Kelas
                            </label>

                            <div class="col-sm-10">

                                <input type="text"
                                       class="form-control"
                                       readonly>

                            </div>

                        </div>


                        <hr>

                        <h4>Daftar Buku Yang Dikembalikan</h4>

                        <table class="table table-bordered">

                            <thead>

                                <tr>

                                    <th width="5%">No</th>
                                    <th width="20%">Kode Copy Buku</th>
                                    <th>Judul</th>
                                    <th width="15%">Jumlah Pijaman</th>

                                </tr>

                            </thead>

                            <tbody>

                                <tr>

                                    <td align="center">1</td>

                                    <td>
                                        <select class="form-control">

                                    <option value="">
                                        -- Pilih Nocopybuku yang dipinjam --
                                    </option>

                                </select>
                                    </td>

                                    <td>
                                        Judul Buku
                                    </td>

                                    <td align="center">
                                        1
                                    </td>

          
                                </tr>

                            </tbody>

                        </table>

                    </div>


                    <div class="card-footer">

                        <button type="submit"
                                class="btn btn-primary">

                            <i class="fas fa-save"></i>
                            Simpan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </section>

</div>