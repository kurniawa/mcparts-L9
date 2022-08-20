@extends('layouts/main_layout')

@section('content')

<header class="header grid-2-auto">
    <img class="w-0_8em ml-1_5em" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">
</header>

<div class="mt-1em ml-1em mr-1em pb-1em bb-0_5px-solid-grey">
    <div class="grid-2-auto">
        <div class="justify-self-left grid-2-auto b-1px-solid-grey b-radius-50px mr-1em pl-1em pr-0_4em w-11em">
            <input class="input-2 mt-0_4em mb-0_4em" type="text" placeholder="Cari...">
            <div class="justify-self-right grid-1-auto justify-items-center circle-small bg-color-orange-1">
                <img class="w-0_8em" src="img/icons/loupe.svg" alt="">
            </div>
        </div>
        <div class="div-filter-icon">

            <div class="icon-small-circle grid-1-auto justify-items-center bg-color-orange-1">
                <img class="w-0_9em" src="img/icons/sort-by-attributes.svg" alt="sort-icon">
            </div>
        </div>
    </div>
    <br>
    <button class="btn btn-primary mb-1">All</button>
    <button class="btn btn-primary mb-1">SJ Variasi</button>
    <button class="btn btn-primary mb-1">SJ Kombinasi</button>
    <button class="btn btn-primary mb-1">SJ Standar</button>
    <button class="btn btn-primary mb-1">SJ T.Sixpack</button>
    <button class="btn btn-primary mb-1">SJ Japstyle</button>
    <button class="btn btn-warning mb-1">Stiker</button>
    <button class="btn btn-warning mb-1">Tankpad</button>
    <button class="btn btn-warning mb-1">Busastang</button>
    <button class="btn btn-danger mb-1">Tipe Variasi</button>
    <button class="btn btn-danger mb-1">Tipe Ukuran</button>
    <button class="btn btn-danger mb-1">Tipe Jahit</button>
</div>

{{-- <div class="container">
    <h2>Produk Baru</h2>
    <h6>Tipe: SJ-Variasi</h6>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row mb-2">
            <div class="col">
                <div class="form-floating">
                    <input type="text" name="bahan" id="bahan" placeholder="Bahan" class="form-control">
                    <label for="bahan">Bahan</label>
                </div>
            </div>
            <div class="col"></div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="form-floating">
                    <input type="text" name="variasi_1" id="variasi_1" placeholder="Variasi 1" class="form-control">
                    <label for="variasi_1">Variasi 1</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating">
                    <input type="text" name="varian_1" id="varian_1" placeholder="Varian 1" class="form-control">
                    <label for="varian_1">Varian 1</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" style="display:none" id="div-variasi2">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-variasi2', 'div-variasi2')">X</button>
                <div class="form-floating">
                    <input type="text" name="variasi_2" id="variasi_2" placeholder="Variasi 2" class="form-control">
                    <label for="variasi_2">Variasi 2</label>
                </div>
            </div>
            <div class="col" style="display:none" id="div-varian2">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-varian2', 'div-varian2')">X</button>
                <div class="form-floating">
                    <input type="text" name="varian_2" id="varian_2" placeholder="Varian 2" class="form-control">
                    <label for="varian_2">Varian 2</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" style="display:none" id="div-ukuran">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-ukuran', 'div-ukuran')">X</button>
                <div class="form-floating">
                    <input type="text" name="ukuran" id="ukuran" placeholder="Ukuran" class="form-control">
                    <label for="ukuran">Ukuran</label>
                </div>
            </div>
            <div class="col" style="display:none" id="div-jahit">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-jahit', 'div-jahit')">X</button>
                <div class="form-floating">
                    <input type="text" name="jahit" id="jahit" placeholder="Jahit" class="form-control">
                    <label for="jahit">Jahit</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-tipe_packing">
                <label for="tipe_packing">Tipe Packing:</label>
                <select name="tipe_packing" id="tipe_packing" class="form-select">
                    <option value="colly">colly</option>
                    <option value="dus">dus</option>
                </select>
            </div>
            <div class="col" id="div-aturan_packing">
                <div class="form-floating">
                    <input type="number" name="aturan_packing" id="aturan_packing" value="150" class="form-control">
                    <label for="aturan_packing">Aturan Packing</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-harga">
                <div class="form-floating">
                    <input type="number" name="harga" id="harga" class="form-control">
                    <label for="harga">Harga</label>
                </div>
            </div>
            <div class="col"></div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-keterangan" style="display: none">
                <label for="keterangan">Keterangan:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-keterangan', 'div-keterangan')">X</button>
                <textarea name="keterangan" id="keterangan" rows="3" class="form-control" placeholder="Keterangan"></textarea>
            </div>
        </div>

        <div class="row mb-2">
            <small>(saran nama dan nama nota terinput otomatis)</small>
            <div class="col" id="div-nama">
                <div class="form-floating">
                    <input type="number" name="nama" id="nama" class="form-control">
                    <label for="nama">Nama</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-nama_nota">
                <div class="form-floating">
                    <input type="number" name="nama_nota" id="nama_nota" class="form-control">
                    <label for="nama_nota">Nama Nota</label>
                </div>
            </div>
        </div>

        <div>
            Opsi:<br>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-ukuran" onclick="showHide('div-ukuran', this.id)">+Ukuran</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-jahit" onclick="showHide('div-jahit', this.id)">+Jahit</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-variasi2" onclick="showHide('div-variasi2', this.id)">+Variasi-2</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-varian2" onclick="showHide('div-varian2', this.id)">+Varian-2</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-keterangan" onclick="showHide('div-keterangan', this.id)">+Keterangan</button>
        </div>

        <br><br>
        <div class="row">
            <div class="col text-center">
                <button type="submit" class="col btn-warning">Tambah SJ-Variasi</button>
            </div>
        </div>
    </form>
</div> --}}

{{-- <div class="container">
    <h2>Produk Baru</h2>
    <h6>Tipe: SJ-Kombinasi</h6>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row mb-2">
            <div class="col">
                <div class="form-floating">
                    <input type="text" id="kombi" name="kombi" class="form-control" style="border-radius:5px;" placeholder="Kombinasi">
                    <label for="kombi">Kombinasi</label>
                </div>
                <input type="hidden" id="kombi_id" name="kombi_id">
                <input type="hidden" id="kombi_harga" name="kombi_harga">
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-grade_bahan">
                <label for="grade_bahan">Grade Bahan:</label>
                <select name="grade_bahan" id="grade_bahan" class="form-control">
                    <option value="A">A</option>
                    <option value="B">B</option>
                </select>
            </div>
            <div class="col"></div>
        </div>

        <div class="row mb-2">
            <div class="col" style="display:none" id="div-variasi1">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-variasi1', 'div-variasi1')">X</button>
                <div class="form-floating">
                    <input type="text" name="variasi 1" id="variasi 1" placeholder="Variasi 1" class="form-control">
                    <label for="variasi 1">Variasi 1</label>
                </div>
            </div>
            <div class="col" style="display:none" id="div-varian1">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-varian1', 'div-varian1')">X</button>
                <div class="form-floating">
                    <input type="text" name="varian_1" id="varian_1" placeholder="Varian 1" class="form-control">
                    <label for="varian_1">Varian 1</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" style="display:none" id="div-ukuran">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-ukuran', 'div-ukuran')">X</button>
                <div class="form-floating">
                    <input type="text" name="ukuran" id="ukuran" placeholder="Ukuran" class="form-control">
                    <label for="ukuran">Ukuran</label>
                </div>
            </div>
            <div class="col" style="display:none" id="div-jahit">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-jahit', 'div-jahit')">X</button>
                <div class="form-floating">
                    <input type="text" name="jahit" id="jahit" placeholder="Jahit" class="form-control">
                    <label for="jahit">Jahit</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-tipe_packing">
                <label for="tipe_packing">Tipe Packing:</label>
                <select name="tipe_packing" id="tipe_packing" class="form-select">
                    <option value="colly">colly</option>
                    <option value="dus">dus</option>
                </select>
            </div>
            <div class="col" id="div-aturan_packing">
                <div class="form-floating">
                    <input type="number" name="aturan_packing" id="aturan_packing" value="150" class="form-control">
                    <label for="aturan_packing">Aturan Packing</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-harga">
                <div class="form-floating">
                    <input type="number" name="harga" id="harga" class="form-control">
                    <label for="harga">Harga</label>
                </div>
            </div>
            <div class="col"></div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-keterangan" style="display: none">
                <label for="keterangan">Keterangan:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-keterangan', 'div-keterangan')">X</button>
                <textarea name="keterangan" id="keterangan" rows="3" class="form-control" placeholder="Keterangan"></textarea>
            </div>
        </div>

        <div class="row mb-2">
            <small>(saran nama dan nama nota terinput otomatis)</small>
            <div class="col" id="div-nama">
                <div class="form-floating">
                    <input type="number" name="nama" id="nama" class="form-control">
                    <label for="nama">Nama</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-nama_nota">
                <div class="form-floating">
                    <input type="number" name="nama_nota" id="nama_nota" class="form-control">
                    <label for="nama_nota">Nama Nota</label>
                </div>
            </div>
        </div>

        <div>
            Opsi:<br>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-ukuran" onclick="showHide('div-ukuran', this.id)">+Ukuran</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-jahit" onclick="showHide('div-jahit', this.id)">+Jahit</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-variasi1" onclick="showHide('div-variasi1', this.id)">+Variasi-1</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-varian1" onclick="showHide('div-varian1', this.id)">+Varian-1</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-keterangan" onclick="showHide('div-keterangan', this.id)">+Keterangan</button>
        </div>

        <br><br>
        <div class="row">
            <div class="col text-center">
                <button type="submit" class="col btn-warning">Tambah SJ-Kombinasi</button>
            </div>
        </div>
    </form>
</div> --}}

{{-- <div class="container">
    <h2>Produk Baru</h2>
    <h6>Tipe: SJ-Motif</h6>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row mb-2">
            <div class="col">
                <div class="form-floating">
                    <input type="text" id="motif" name="motif" class="form-control" style="border-radius:5px;" placeholder="Motif">
                    <label for="motif">Motif</label>
                </div>
                <input type="hidden" id="motif_id" name="motif_id">
                <input type="hidden" id="motif_harga" name="motif_harga">
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-grade_bahan">
                <label for="grade_bahan">Grade Bahan:</label>
                <select name="grade_bahan" id="grade_bahan" class="form-control">
                    <option value="A">A</option>
                    <option value="B">B</option>
                </select>
            </div>
            <div class="col"></div>
        </div>

        <div class="row mb-2">
            <div class="col" style="display:none" id="div-variasi1">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-variasi1', 'div-variasi1')">X</button>
                <div class="form-floating">
                    <input type="text" name="variasi 1" id="variasi 1" placeholder="Variasi 1" class="form-control">
                    <label for="variasi 1">Variasi 1</label>
                </div>
            </div>
            <div class="col" style="display:none" id="div-varian1">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-varian1', 'div-varian1')">X</button>
                <div class="form-floating">
                    <input type="text" name="varian_1" id="varian_1" placeholder="Varian 1" class="form-control">
                    <label for="varian_1">Varian 1</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" style="display:none" id="div-ukuran">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-ukuran', 'div-ukuran')">X</button>
                <div class="form-floating">
                    <input type="text" name="ukuran" id="ukuran" placeholder="Ukuran" class="form-control">
                    <label for="ukuran">Ukuran</label>
                </div>
            </div>
            <div class="col" style="display:none" id="div-jahit">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-jahit', 'div-jahit')">X</button>
                <div class="form-floating">
                    <input type="text" name="jahit" id="jahit" placeholder="Jahit" class="form-control">
                    <label for="jahit">Jahit</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-tipe_packing">
                <label for="tipe_packing">Tipe Packing:</label>
                <select name="tipe_packing" id="tipe_packing" class="form-select">
                    <option value="colly">colly</option>
                    <option value="dus">dus</option>
                </select>
            </div>
            <div class="col" id="div-aturan_packing">
                <div class="form-floating">
                    <input type="number" name="aturan_packing" id="aturan_packing" value="150" class="form-control">
                    <label for="aturan_packing">Aturan Packing</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-harga">
                <div class="form-floating">
                    <input type="number" name="harga" id="harga" class="form-control">
                    <label for="harga">Harga</label>
                </div>
            </div>
            <div class="col"></div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-keterangan" style="display: none">
                <label for="keterangan">Keterangan:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-keterangan', 'div-keterangan')">X</button>
                <textarea name="keterangan" id="keterangan" rows="3" class="form-control" placeholder="Keterangan"></textarea>
            </div>
        </div>

        <div class="row mb-2">
            <small>(saran nama dan nama nota terinput otomatis)</small>
            <div class="col" id="div-nama">
                <div class="form-floating">
                    <input type="number" name="nama" id="nama" class="form-control">
                    <label for="nama">Nama</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-nama_nota">
                <div class="form-floating">
                    <input type="number" name="nama_nota" id="nama_nota" class="form-control">
                    <label for="nama_nota">Nama Nota</label>
                </div>
            </div>
        </div>

        <div>
            Opsi:<br>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-ukuran" onclick="showHide('div-ukuran', this.id)">+Ukuran</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-jahit" onclick="showHide('div-jahit', this.id)">+Jahit</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-variasi1" onclick="showHide('div-variasi1', this.id)">+Variasi-1</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-varian1" onclick="showHide('div-varian1', this.id)">+Varian-1</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-keterangan" onclick="showHide('div-keterangan', this.id)">+Keterangan</button>
        </div>

        <br><br>
        <div class="row">
            <div class="col text-center">
                <button type="submit" class="col btn-warning">Tambah SJ-Motif</button>
            </div>
        </div>
    </form>
</div> --}}

{{-- <div class="container">
    <h2>Produk Baru</h2>
    <h6>Tipe: SJ-Japstyle</h6>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row mb-2">
            <div class="col">
                <div class="form-floating">
                    <input type="text" name="bahan" id="bahan" placeholder="Bahan" class="form-control">
                    <label for="bahan">Bahan</label>
                </div>
            </div>
            <div class="col"></div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-tipe_packing">
                <label for="tipe_packing">Tipe Packing:</label>
                <select name="tipe_packing" id="tipe_packing" class="form-select">
                    <option value="colly">colly</option>
                    <option value="dus">dus</option>
                </select>
            </div>
            <div class="col" id="div-aturan_packing">
                <div class="form-floating">
                    <input type="number" name="aturan_packing" id="aturan_packing" value="150" class="form-control">
                    <label for="aturan_packing">Aturan Packing</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-harga">
                <div class="form-floating">
                    <input type="number" name="harga" id="harga" class="form-control">
                    <label for="harga">Harga</label>
                </div>
            </div>
            <div class="col"></div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-keterangan" style="display: none">
                <label for="keterangan">Keterangan:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-keterangan', 'div-keterangan')">X</button>
                <textarea name="keterangan" id="keterangan" rows="3" class="form-control" placeholder="Keterangan"></textarea>
            </div>
        </div>

        <div class="row mb-2">
            <small>(saran nama dan nama nota terinput otomatis)</small>
            <div class="col" id="div-nama">
                <div class="form-floating">
                    <input type="number" name="nama" id="nama" class="form-control">
                    <label for="nama">Nama</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-nama_nota">
                <div class="form-floating">
                    <input type="number" name="nama_nota" id="nama_nota" class="form-control">
                    <label for="nama_nota">Nama Nota</label>
                </div>
            </div>
        </div>

        <div>
            Opsi:<br>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-keterangan" onclick="showHide('div-keterangan', this.id)">+Keterangan</button>
        </div>

        <br><br>
        <div class="row">
            <div class="col text-center">
                <button type="submit" class="col btn-warning">Tambah SJ-Japstyle</button>
            </div>
        </div>
    </form>
</div> --}}

<div class="container">
    <h2>Produk Baru</h2>
    <h6>Tipe: SJ-Standar</h6>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row mb-2">
            <div class="col">
                <div class="form-floating">
                    <input type="text" name="standar" id="standar" placeholder="Standar" class="form-control">
                    <label for="standar">Standar</label>
                </div>
            </div>
            <div class="col" id="div-bahan" style="display: none">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-bahan', 'div-bahan')">X</button>
                <div class="form-floating">
                    <input type="text" name="bahan" id="bahan" placeholder="Bahan" class="form-control">
                    <label for="bahan">Bahan</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-grade_bahan" style="display: none">
                <label for="grade_bahan">Grade Bahan:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-grade_bahan', 'div-grade_bahan')">X</button>
                <select name="grade_bahan" id="grade_bahan" class="form-control">
                    <option value="A">A</option>
                    <option value="B">B</option>
                </select>
            </div>
            <div class="col" id="div-alas" style="display: none">
                <label for="alas">Alas:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-alas', 'div-alas')">X</button>
                <select name="alas" id="alas" class="form-control">
                    <option value="Alas">Alas</option>
                </select>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-busa" style="display: none">
                <label for="busa">Busa:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-busa', 'div-busa')">X</button>
                <select name="busa" id="busa" class="form-control">
                    <option value="Busa">Busa</option>
                </select>
            </div>
            <div class="col" id="div-sayap" style="display: none">
                <label for="sayap">Sayap:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-sayap', 'div-sayap')">X</button>
                <select name="sayap" id="sayap" class="form-control">
                    <option value="Sayap Abu">Sayap Abu</option>
                    <option value="Sayap Hitam">Sayap Hitam</option>
                </select>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-tipe_packing">
                <label for="tipe_packing">Tipe Packing:</label>
                <select name="tipe_packing" id="tipe_packing" class="form-select">
                    <option value="colly">colly</option>
                    <option value="dus">dus</option>
                </select>
            </div>
            <div class="col" id="div-aturan_packing">
                <div class="form-floating">
                    <input type="number" name="aturan_packing" id="aturan_packing" value="150" class="form-control">
                    <label for="aturan_packing">Aturan Packing</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-harga">
                <div class="form-floating">
                    <input type="number" name="harga" id="harga" class="form-control">
                    <label for="harga">Harga</label>
                </div>
            </div>
            <div class="col"></div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-keterangan" style="display: none">
                <label for="keterangan">Keterangan:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-keterangan', 'div-keterangan')">X</button>
                <textarea name="keterangan" id="keterangan" rows="3" class="form-control" placeholder="Keterangan"></textarea>
            </div>
        </div>

        <div class="row mb-2">
            <small>(saran nama dan nama nota terinput otomatis)</small>
            <div class="col" id="div-nama">
                <div class="form-floating">
                    <input type="number" name="nama" id="nama" class="form-control">
                    <label for="nama">Nama</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-nama_nota">
                <div class="form-floating">
                    <input type="number" name="nama_nota" id="nama_nota" class="form-control">
                    <label for="nama_nota">Nama Nota</label>
                </div>
            </div>
        </div>

        <div>
            Opsi:<br>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-bahan" onclick="showHide('div-bahan', this.id)">+Bahan</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-grade_bahan" onclick="showHide('div-grade_bahan', this.id)">+Grade Bahan</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-alas" onclick="showHide('div-alas', this.id)">+Alas</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-busa" onclick="showHide('div-busa', this.id)">+Busa</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-sayap" onclick="showHide('div-sayap', this.id)">+Sayap</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-keterangan" onclick="showHide('div-keterangan', this.id)">+Keterangan</button>
        </div>

        <br><br>
        <div class="row">
            <div class="col text-center">
                <button type="submit" class="col btn-warning">Tambah SJ-Standar</button>
            </div>
        </div>
    </form>
</div>

<div class="container">
    <h2>Produk Baru</h2>
    <h6>Tipe: SJ-T.Sixpack</h6>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row mb-2">
            <div class="col" id="div-bahan" style="display: none">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-bahan', 'div-bahan')">X</button>
                <div class="form-floating">
                    <input type="text" name="bahan" id="bahan" placeholder="Bahan" class="form-control">
                    <label for="bahan">Bahan</label>
                </div>
            </div>
            <div class="col"></div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-grade_bahan" style="display: none">
                <label for="grade_bahan">Grade Bahan:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-grade_bahan', 'div-grade_bahan')">X</button>
                <select name="grade_bahan" id="grade_bahan" class="form-control">
                    <option value="A">A</option>
                    <option value="B">B</option>
                </select>
            </div>
            <div class="col" id="div-alas" style="display: none">
                <label for="alas">Alas:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-alas', 'div-alas')">X</button>
                <select name="alas" id="alas" class="form-control">
                    <option value="Alas">Alas</option>
                </select>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-busa" style="display: none">
                <label for="busa">Busa:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-busa', 'div-busa')">X</button>
                <select name="busa" id="busa" class="form-control">
                    <option value="Busa">Busa</option>
                </select>
            </div>
            <div class="col" id="div-sayap" style="display: none">
                <label for="sayap">Sayap:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-sayap', 'div-sayap')">X</button>
                <select name="sayap" id="sayap" class="form-control">
                    <option value="Sayap Abu">Sayap Abu</option>
                    <option value="Sayap Hitam">Sayap Hitam</option>
                </select>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-tipe_packing">
                <label for="tipe_packing">Tipe Packing:</label>
                <select name="tipe_packing" id="tipe_packing" class="form-select">
                    <option value="colly">colly</option>
                    <option value="dus">dus</option>
                </select>
            </div>
            <div class="col" id="div-aturan_packing">
                <div class="form-floating">
                    <input type="number" name="aturan_packing" id="aturan_packing" value="150" class="form-control">
                    <label for="aturan_packing">Aturan Packing</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-harga">
                <div class="form-floating">
                    <input type="number" name="harga" id="harga" class="form-control">
                    <label for="harga">Harga</label>
                </div>
            </div>
            <div class="col"></div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-keterangan" style="display: none">
                <label for="keterangan">Keterangan:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-keterangan', 'div-keterangan')">X</button>
                <textarea name="keterangan" id="keterangan" rows="3" class="form-control" placeholder="Keterangan"></textarea>
            </div>
        </div>

        <div class="row mb-2">
            <small>(saran nama dan nama nota terinput otomatis)</small>
            <div class="col" id="div-nama">
                <div class="form-floating">
                    <input type="number" name="nama" id="nama" class="form-control">
                    <label for="nama">Nama</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-nama_nota">
                <div class="form-floating">
                    <input type="number" name="nama_nota" id="nama_nota" class="form-control">
                    <label for="nama_nota">Nama Nota</label>
                </div>
            </div>
        </div>

        <div>
            Opsi:<br>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-bahan" onclick="showHide('div-bahan', this.id)">+Bahan</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-grade_bahan" onclick="showHide('div-grade_bahan', this.id)">+Grade Bahan</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-alas" onclick="showHide('div-alas', this.id)">+Alas</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-busa" onclick="showHide('div-busa', this.id)">+Busa</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-sayap" onclick="showHide('div-sayap', this.id)">+Sayap</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-keterangan" onclick="showHide('div-keterangan', this.id)">+Keterangan</button>
        </div>

        <br><br>
        <div class="row">
            <div class="col text-center">
                <button type="submit" class="col btn-warning">Tambah SJ-Standar</button>
            </div>
        </div>
    </form>
</div>

@endsection
