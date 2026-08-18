<style>
    .form-label {
        font-weight: 600;
        color: #374151;
        font-size: 0.9rem;
    }
    .form-control,
    .form-select {
        border-radius: 0.6rem;
        padding: 0.6rem 0.9rem;
        border: 1px solid #e5e7eb;
    }
    .form-control:focus,
    .form-select:focus {
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

<div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $user->name ?? '' ) }}">
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email"
        class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email', $user->email ?? '') }}">
    @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" name="password"
        class="form-control @error('password') is-invalid @enderror">
    @error('password')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror 
</div>

<div class="mb-3">
    <label class="form-label">Role</label>
    <select name="role_id"
            class="form-select @error('role_id') is-invalid @enderror">
        <option value="">-- Pilih Role --</option>
        @foreach($roles as $role)
        <option value="{{ $role->id }}"
            @selected(old('role_id', $user->role_id ?? '') == $role->id)>
            {{ ucfirst($role->name) }}
        </option>
        @endforeach
    </select>
    @error('role_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<button class="btn btn-success mt-3" type="submit">Simpan</button>
<a href="{{ route('admin.users') }}" class="btn btn-secondary mt-3">Kembali</a>