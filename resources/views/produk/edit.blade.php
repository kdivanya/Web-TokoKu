@extends('layouts.app')
@section('title', 'Edit Produk')

@section('content')

<div class="fade-wrapper">
    <div class="header-section">
        <h3 class="page-title">
            <i class="fas fa-edit me-2"></i>Edit Produk
        </h3>
        <p class="subtitle">
            Perbarui informasi produk <strong class="white">{{ $produk->nama }}</strong>
        </p>
    </div>

    <div class="glass-card form-card">
        <form action="/produk/{{ $produk->id }}" method="POST" id="editForm">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label-custom">
                        <i class="fas fa-tag me-2"></i>Nama Produk
                    </label>
                    <input type="text" name="nama" class="form-control-custom"
                        value="{{ $produk->nama }}" placeholder="Masukkan nama produk" required>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label-custom">
                        <i class="fas fa-dollar-sign me-2"></i>Harga
                    </label>
                    <div class="input-icon-wrapper">
                        <span class="input-icon-prefix">Rp</span>
                        <input type="number" name="harga" class="form-control-custom"
                            value="{{ $produk->harga }}" placeholder="0" required>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label-custom">
                    <i class="fas fa-align-left me-2"></i>Deskripsi
                </label>
                <textarea name="deskripsi" class="form-control-custom" rows="4"
                    placeholder="Deskripsikan produk Anda..." required>{{ $produk->deskripsi }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label-custom">
                        <i class="fas fa-cubes me-2"></i>Stok
                    </label>
                    <input type="number" name="stok" class="form-control-custom"
                        value="{{ $produk->stok }}" placeholder="Jumlah stok" required min="0">
                    <small class="stock-info">
                        @if($produk->stok <= 10)
                            <i class="fas fa-exclamation-triangle me-1"></i>Stok menipis! Pertimbangkan menambah stok.
                        @else
                            <i class="fas fa-check-circle me-1"></i>Stok tersedia
                        @endif
                    </small>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label-custom">
                        <i class="fas fa-store me-2"></i>Nama Toko
                    </label>
                    <input type="text" name="toko" class="form-control-custom"
                        value="{{ $produk->toko }}" placeholder="Masukkan nama toko" required>
                </div>
            </div>

            <div class="info-card">
                <div class="info-content">
                    <i class="fas fa-info-circle info-icon"></i>
                    <div>
                        <strong class="white d-block mb-1">Informasi Produk</strong>
                        <small class="info-text">
                            ID Produk: <strong class="white">{{ $produk->id }}</strong> |
                            Terakhir diupdate:
                            <strong class="white">
                                {{ $produk->updated_at ? $produk->updated_at->format('d M Y H:i') : 'N/A' }}
                            </strong>
                        </small>
                    </div>
                </div>
            </div>

            <div class="action-buttons">
                <button type="submit" class="btn-primary-custom">
                    <i class="fas fa-save me-2"></i>Update Produk
                </button>
                <a href="/produk" class="btn-secondary-custom">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </form>
    </div>
</div>

<style>

    body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('{{ asset('images/background.jpg') }}') center/cover;
            opacity: 0.3;
            z-index: 0;
        }

    .fade-wrapper {
        animation: fadeIn 0.6s ease-out;
    }

    .page-title {
        color: white;
        font-weight: 700;
        text-shadow: 0 0 12px rgba(255,255,255,0.1);
    }

    .subtitle {
        color: rgba(255,255,255,0.7);
        font-size: 14px;
        margin: 0;
    }

    .form-card {
        padding: 25px;
        border-radius: 16px;
        background: rgba(255,255,255,0.08);
        backdrop-filter: blur(14px);
        border: 1px solid rgba(255,255,255,0.15);
        box-shadow: 0 8px 25px rgba(0,0,0,0.25);
    }

    .form-control-custom {
        width: 100%;
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.2);
        padding: 12px 14px;
        border-radius: 10px;
        color: white;
        transition: .3s;
    }
    .form-control-custom:focus {
        border-color: rgba(102,126,234,0.7);
        box-shadow: 0 0 8px rgba(102,126,234,0.3);
        transform: translateY(-2px);
    }

    .input-icon-wrapper {
        position: relative;
    }
    .input-icon-prefix {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255,255,255,0.7);
        font-weight: 600;
    }
    .input-icon-wrapper input {
        padding-left: 48px !important;
    }

    .info-card {
        background: rgba(102,126,234,0.1);
        border: 1px solid rgba(102,126,234,0.3);
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 20px;
    }
    .info-icon {
        font-size: 24px;
        color: rgba(102,126,234,0.9);
    }

    .action-buttons {
        border-top: 1px solid rgba(255,255,255,0.1);
        padding-top: 20px;
        display: flex;
        gap: 12px;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: .7; }
    }
    .fa-exclamation-triangle {
        animation: pulse 2s infinite;
        color: rgba(255,193,7,0.9);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.form-control-custom').forEach((el, i) => {
            el.style.animation = `fadeIn 0.5s ease-out ${i * 0.08}s backwards`;
        });
    });

    document.querySelector('input[name="harga"]').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '');
    });

    document.getElementById('editForm').addEventListener('submit', function() {
        const btn = this.querySelector('button[type="submit"]');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memperbarui...';
        btn.disabled = true;
    });

    const stokInput = document.querySelector('input[name="stok"]');
    const stockInfo = document.querySelector('.stock-info');
    stokInput.addEventListener('input', function() {
        let v = parseInt(this.value) || 0;
        if (v <= 10) {
            stockInfo.innerHTML = '<i class="fas fa-exclamation-triangle me-1"></i>Stok menipis! Pertimbangkan menambah stok.';
            stockInfo.style.color = 'rgba(255,193,7,0.9)';
        } else {
            stockInfo.innerHTML = '<i class="fas fa-check-circle me-1"></i>Stok tersedia';
            stockInfo.style.color = 'rgba(25,135,84,0.9)';
        }
    });
</script>

@endsection
