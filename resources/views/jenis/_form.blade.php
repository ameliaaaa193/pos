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

<div>
    <label>Nama Jenis</label><br>

    <input type="text"
           name="nama"
           class="form-control @error('nama') is-invalid @enderror"
           value="{{ old('nama', $jenis->nama ?? '') }}">

    @error('nama')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<button class="btn btn-success mt-3" type="submit">Simpan</button>
<a href="{{ route('jenis.index') }}" class="btn btn-secondary mt-3">Kembali</a>