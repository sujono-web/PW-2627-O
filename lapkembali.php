<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mt-4">
                        <div class="card-body">
                            <h6 class="text-center font-weight-bold mb-3">
                                Laporan Peminjaman dan Pengembalian Buku
                            </h6>
                            <form method="POST">
                                <div class="row mb-5">
                                    <div class="col-md-2 text-right pt-2">
                                        <label>Periode</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="date"
                                               name="tglawal"
                                               class="form-control">
                                    </div>
                                    <div class="col-md-1 text-center pt-2">
                                        <label>S/D</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="date"
                                               name="tglakhir"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit"
                                            class="btn btn-success px-5 mr-5">
                                        Cetak
                                    </button>
                                    <a href="index.php"
                                       class="btn btn-success px-5">
                                        Keluar
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>