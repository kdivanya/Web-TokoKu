@extends('layouts.app')
@section('title', 'Tambah Produk')

@section('content')

<style>
    .glass-header {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 25px 30px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        margin-bottom: 25px;
        transition: all 0.3s ease;
    }

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

    .glass-header:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    }

    .glass-header h4 {
        margin: 0;
        color: #333;
        font-weight: 700;
        font-size: 28px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.25);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        padding: 40px;
        transition: all 0.3s ease;
    }

    .glass-card:hover {
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-label {
        display: block;
        margin-bottom: 10px;
        color: #333;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-label i {
        color: #667eea;
        font-size: 16px;
    }

    .input-group-custom {
        position: relative;
        transition: all 0.3s ease;
    }

    .input-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(102, 126, 234, 0.6);
        font-size: 18px;
        z-index: 2;
    }

    .glass-input {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 16px;
        padding: 14px 20px 14px 55px;
        color: #333;
        font-size: 15px;
        font-weight: 500;
        transition: all 0.3s ease;
        width: 100%;
        outline: none;
    }

    .glass-input.no-icon {
        padding-left: 20px;
    }

    .glass-input::placeholder {
        color: rgba(0, 0, 0, 0.4);
    }

    .glass-input:focus {
        background: rgba(255, 255, 255, 0.3);
        border-color: rgba(102, 126, 234, 0.6);
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .glass-textarea {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 16px;
        padding: 14px 20px;
        color: #333;
        font-size: 15px;
        font-weight: 500;
        transition: all 0.3s ease;
        width: 100%;
        outline: none;
        resize: vertical;
        min-height: 120px;
    }

    .glass-textarea::placeholder {
        color: rgba(0, 0, 0, 0.4);
    }

    .glass-textarea:focus {
        background: rgba(255, 255, 255, 0.3);
        border-color: rgba(102, 126, 234, 0.6);
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .btn-actions {
        display: flex;
        gap: 15px;
        margin-top: 35px;
        flex-wrap: wrap;
    }

    .btn-custom {
        border: none;
        border-radius: 14px;
        padding: 14px 32px;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-save {
        background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        flex: 1;
        justify-content: center;
    }

    .btn-save::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .btn-save:hover::before {
        left: 100%;
    }

    .btn-save:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.6);
        color: white;
    }

    .btn-back {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        color: #333;
        border: 2px solid rgba(0, 0, 0, 0.1);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 14px 24px;
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        color: #333;
    }

    .btn-custom .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: ripple-animation 0.6s ease-out;
        pointer-events: none;
    }

    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    .input-group-custom:focus-within .input-icon {
        color: #667eea;
        transform: translateY(-50%) scale(1.1);
    }

    .char-counter {
        position: absolute;
        right: 15px;
        bottom: 10px;
        font-size: 12px;
        color: rgba(0, 0, 0, 0.5);
        font-weight: 600;
    }

    .form-helper {
        font-size: 13px;
        color: rgba(0, 0, 0, 0.5);
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .form-helper i {
        font-size: 12px;
    }

    @media (max-width: 768px) {
        .glass-card {
            padding: 25px;
        }

        .btn-actions {
            flex-direction: column;
        }

        .btn-save {
            width: 100%;
        }
    }

    .btn-save.loading {
        pointer-events: none;
        opacity: 0.8;
    }

    .btn-save.loading .btn-text {
        opacity: 0;
    }

    .btn-save .spinner {
        position: absolute;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-top-color: white;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
        display: none;
    }

    .btn-save.loading .spinner {
        display: block;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>

<div class="glass-header">
    <h4>
        <i class="fas fa-plus-circle"></i>
        Tambah Produk Baru
    </h4>
</div>

<div class="glass-card">
    <form action="/produk" method="POST" id="productForm">
        @csrf

        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-tag"></i>
                Nama Produk
            </label>
            <div class="input-group-custom">
                <i class="fas fa-box input-icon"></i>
                <input type="text" name="nama" class="glass-input" placeholder="Masukkan nama produk" required>
            </div>
            <div class="form-helper">
                <i class="fas fa-info-circle"></i>
                Gunakan nama yang jelas dan mudah diingat
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-money-bill-wave"></i>
                Harga
            </label>
            <div class="input-group-custom">
                <i class="fas fa-rupiah-sign input-icon"></i>
                <input type="number" name="harga" class="glass-input" placeholder="0" required min="0" oninput="formatCurrency(this)">
            </div>
            <div class="form-helper">
                <i class="fas fa-info-circle"></i>
                Masukkan harga dalam Rupiah
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-align-left"></i>
                Deskripsi
            </label>
            <textarea name="deskripsi" class="glass-textarea" placeholder="Tulis deskripsi produk secara detail..." required maxlength="500" oninput="updateCharCount(this)"></textarea>
            <span class="char-counter" id="charCounter">0/500</span>
            <div class="form-helper">
                <i class="fas fa-info-circle"></i>
                Jelaskan detail produk dengan lengkap
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-boxes"></i>
                Stok
            </label>
            <div class="input-group-custom">
                <i class="fas fa-cubes input-icon"></i>
                <input type="number" name="stok" class="glass-input" placeholder="0" required min="0">
            </div>
            <div class="form-helper">
                <i class="fas fa-info-circle"></i>
                Jumlah unit produk yang tersedia
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-store"></i>
                Nama Toko
            </label>
            <div class="input-group-custom">
                <i class="fas fa-shopping-bag input-icon"></i>
                <input type="text" name="toko" class="glass-input" placeholder="Masukkan nama toko" required>
            </div>
            <div class="form-helper">
                <i class="fas fa-info-circle"></i>
                Nama toko tempat produk dijual
            </div>
        </div>

        <div class="btn-actions">
            <button type="submit" class="btn-custom btn-save" onclick="createRipple(event); submitForm(event)">
                <span class="btn-text">
                    <i class="fas fa-save"></i>
                    Simpan Produk
                </span>
                <div class="spinner"></div>
            </button>
            <a href="/produk" class="btn-custom btn-back" onclick="createRipple(event)">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>
    </form>
</div>

<script>
    function createRipple(event) {
        const button = event.currentTarget;
        const ripple = document.createElement('span');
        const rect = button.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = event.clientX - rect.left - size / 2;
        const y = event.clientY - rect.top - size / 2;

        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.classList.add('ripple');

        button.appendChild(ripple);
        setTimeout(() => ripple.remove(), 600);
    }

    function submitForm(event) {
        const button = event.currentTarget;
        button.classList.add('loading');
    }

    function updateCharCount(textarea) {
        const counter = document.getElementById('charCounter');
        const current = textarea.value.length;
        const max = textarea.maxLength;
        counter.textContent = `${current}/${max}`;
        
        if (current > max * 0.9) {
            counter.style.color = '#ef4444';
        } else {
            counter.style.color = 'rgba(0, 0, 0, 0.5)';
        }
    }

    function formatCurrency(input) {
    }

    document.querySelectorAll('.glass-input, .glass-textarea').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.01)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    });

    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

@endsection