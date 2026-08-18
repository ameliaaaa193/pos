@csrf

<style>
    label {
        font-weight: 600;
        color: #374151;
        font-size: 0.9rem;
        margin-bottom: 0.35rem;
        display: inline-block;
    }
    .form-control {
        border-radius: 0.6rem;
        padding: 0.6rem 0.9rem;
        border: 1px solid #e5e7eb;
        margin-bottom: 1rem;
    }
    .form-control:focus {
        border-color: #db2763;
        box-shadow: 0 0 0 0.2rem rgba(219, 39, 99, 0.12);
    }
    .img-thumbnail {
        border-radius: 0.6rem;
        border: 1px solid #f1e3e8;
    }
    .btn-success {
        background: #db2763;
        border: none;
        border-radius: 0.6rem;
        font-weight: 600;
        padding: 0.55rem 1.4rem;
    }
    .btn-success:hover {
        background: #b91c4f;
    }
    .btn-secondary {
        background: #f3f4f6;
        border: none;
        border-radius: 0.6rem;
        color: #374151;
        font-weight: 600;
        padding: 0.55rem 1.4rem;
    }
    .btn-secondary:hover {
        background: #e5e7eb;
        color: #1f2937;
    }
</style>

@if (!empty($produk->foto))
    <div class="mb-2">
        <label>Foto Saat Ini</label><br>
        <img src="{{ asset('storage/' . $produk->foto) }}"
             width="150"
             class="img-thumbnail">
    </div>
@endif

<div class="row">
    <div class="col">
        <div>
        <label>Gambar</label>

        <input type="file"
               name="foto"
               onchange="previewImage(this)"
               class="form-control @error('foto') is-invalid @enderror">

        @error('foto')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="col">
    <div class="mb-2">
        <label>Preview Foto</label><br>

        <img id="preview"
             class="img-thumbnail mt-2"
             style="display:none"
             width="150">
    </div>
</div>
</div>

<div>
    <label>Nama Produk</label><br>

    <input type="text"
           name="name"
           class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $produk->nama ?? '') }}">

    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div>
    <label>Harga Beli</label><br>

    <input type="number"
           name="purchase_price"
           class="form-control @error('purchase_price') is-invalid @enderror"
           value="{{ old('purchase_price', $produk->harga_beli ?? '') }}">

    @error('purchase_price')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div>
    <label>Harga Jual</label><br>

    <input type="number"
           name="selling_price"
           class="form-control @error('selling_price') is-invalid @enderror"
           value="{{ old('selling_price', $produk->harga_jual ?? '') }}">

    @error('selling_price')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div>
    <label>Stok</label><br>

    <input type="number"
           name="stock"
           class="form-control @error('stock') is-invalid @enderror"
           value="{{ old('stock', $produk->stok ?? '') }}">

    @error('stock')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<button class="btn btn-success mt-3" type="submit">Simpan</button>
<a href="{{ route('produk.index') }}" class="btn btn-secondary mt-3">Kembali</a>

<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        const file = input.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    }
</script>