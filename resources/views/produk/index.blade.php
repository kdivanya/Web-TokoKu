@extends('layouts.app')
@section('title', 'Data Produk')

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
        display: flex;
        justify-content: space-between;
        align-items: center;
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

    .glass-header h3 {
        margin: 0;
        color: #333;
        font-weight: 700;
        font-size: 28px;
    }

    .btn-add-product {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 12px;
        padding: 12px 24px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        position: relative;
        overflow: hidden;
    }

    .btn-add-product::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .btn-add-product:hover::before {
        left: 100%;
    }

    .btn-add-product:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
        color: white;
    }

    .glass-alert {
        background: rgba(34, 197, 94, 0.15);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(34, 197, 94, 0.3);
        border-radius: 16px;
        padding: 16px 20px;
        color: #059669;
        font-weight: 500;
        margin-bottom: 25px;
        animation: slideDown 0.5s ease;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.25);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .glass-card:hover {
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    }

    .table-container {
        overflow-x: auto;
        border-radius: 20px;
    }

    .glass-table {
        width: 100%;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .glass-table thead {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.3), rgba(118, 75, 162, 0.3));
        backdrop-filter: blur(10px);
    }

    .glass-table thead th {
        padding: 18px 15px;
        font-weight: 700;
        color: #333;
        border: none;
        text-align: center;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .glass-table thead th:first-child {
        border-top-left-radius: 16px;
    }

    .glass-table thead th:last-child {
        border-top-right-radius: 16px;
    }

    .glass-table tbody tr {
        background: rgba(255, 255, 255, 0.05);
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .glass-table tbody tr:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: scale(1.01);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .glass-table tbody td {
        padding: 16px 15px;
        color: #333;
        font-weight: 500;
        border: none;
        vertical-align: middle;
    }

    .glass-table tbody tr:last-child td:first-child {
        border-bottom-left-radius: 16px;
    }

    .glass-table tbody tr:last-child td:last-child {
        border-bottom-right-radius: 16px;
    }

    .badge-stock {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 13px;
        background: rgba(34, 197, 94, 0.2);
        color: #059669;
        border: 1px solid rgba(34, 197, 94, 0.3);
    }

    .badge-stock.low {
        background: rgba(239, 68, 68, 0.2);
        color: #dc2626;
        border-color: rgba(239, 68, 68, 0.3);
    }

    .price-tag {
        font-weight: 700;
        color: #667eea;
        font-size: 15px;
    }

    .btn-action {
        border: none;
        border-radius: 10px;
        padding: 8px 16px;
        font-weight: 600;
        font-size: 13px;
        transition: all 0.3s ease;
        margin: 0 3px;
        position: relative;
        overflow: hidden;
    }

    .btn-edit {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(251, 191, 36, 0.5);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.5);
        color: white;
    }

    /* Ripple effect */
    .btn-action .ripple {
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

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .empty-state i {
        font-size: 64px;
        color: #ddd;
        margin-bottom: 20px;
    }

    .empty-state h5 {
        font-weight: 600;
        margin-bottom: 10px;
    }

    /* Search Box */
    .search-box {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        padding: 12px 20px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: all 0.3s ease;
    }

    .search-box:focus-within {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(102, 126, 234, 0.5);
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .search-box i {
        color: #667eea;
        font-size: 18px;
    }

    .search-box input {
        flex: 1;
        border: none;
        background: transparent;
        color: #333;
        font-weight: 500;
        outline: none;
    }

    .search-box input::placeholder {
        color: rgba(0, 0, 0, 0.4);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .glass-header {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .glass-table {
            font-size: 13px;
        }

        .glass-table thead th,
        .glass-table tbody td {
            padding: 12px 8px;
        }
    }
</style>

<div class="glass-header">
    <h3><i class="fas fa-box"></i> Data Produk</h3>
    <a href="/produk/create" class="btn-add-product">
        <i class="fas fa-plus"></i> Tambah Produk
    </a>
</div>

@if(session('success'))
    <div class="glass-alert">
        <i class="fas fa-check-circle" style="font-size: 20px;"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

<!-- Search Box -->
<div class="search-box">
    <i class="fas fa-search"></i>
    <input type="text" id="searchInput" placeholder="Cari produk berdasarkan nama, toko, atau harga..." onkeyup="searchTable()">
</div>

<div class="glass-card">
    <div class="table-container">
        <table class="glass-table" id="productTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Stok</th>
                    <th>Toko</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $d)
                <tr>
                    <td><strong>#{{ $d->id }}</strong></td>
                    <td><strong>{{ $d->nama }}</strong></td>
                    <td><span class="price-tag">Rp {{ number_format($d->harga, 0, ',', '.') }}</span></td>
                    <td style="text-align: left;">{{ Str::limit($d->deskripsi, 50) }}</td>
                    <td>
                        <span class="badge-stock {{ $d->stok < 10 ? 'low' : '' }}">
                            {{ $d->stok }} pcs
                        </span>
                    </td>
                    <td>{{ $d->toko }}</td>
                    <td>
                        <a href="/produk/{{ $d->id }}/edit" class="btn-action btn-edit" onclick="createRipple(event)">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        <form action="/produk/{{ $d->id }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete" onclick="return confirmDelete(event, '{{ $d->nama }}')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <i class="fas fa-box-open"></i>
                            <h5>Belum Ada Produk</h5>
                            <p>Klik tombol "Tambah Produk" untuk menambahkan produk pertama Anda</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    // Ripple effect
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

    function confirmDelete(event, productName) {
        event.preventDefault();
        const form = event.target.closest('form');
        
        if (confirm(`Apakah Anda yakin ingin menghapus produk "${productName}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
            form.submit();
        }
        
        return false;
    }

    function searchTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('productTable');
        const tr = table.getElementsByTagName('tr');

        for (let i = 1; i < tr.length; i++) {
            const row = tr[i];
            const cells = row.getElementsByTagName('td');
            let found = false;

            for (let j = 0; j < cells.length; j++) {
                const cell = cells[j];
                if (cell) {
                    const textValue = cell.textContent || cell.innerText;
                    if (textValue.toLowerCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }

            if (found) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const alert = document.querySelector('.glass-alert');
        if (alert) {
            setTimeout(() => {
                alert.style.animation = 'slideUp 0.5s ease';
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        }
    });

    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideUp {
            from {
                opacity: 1;
                transform: translateY(0);
            }
            to {
                opacity: 0;
                transform: translateY(-20px);
            }
        }
    `;
    document.head.appendChild(style);
</script>

@endsection