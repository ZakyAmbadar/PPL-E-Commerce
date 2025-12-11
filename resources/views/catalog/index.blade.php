<!DOCTYPE html>
<html lang="id">
<head>
    <title>Katalog Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">

    {{-- Navbar (Tetap sama seperti sebelumnya) --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">Kmart</a>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row">
            
            {{-- SIDEBAR FILTER (SRS-05) --}}
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold">
                        <i class="fas fa-filter text-primary me-2"></i> Filter Produk
                    </div>
                    <div class="card-body">
                        <form action="{{ route('catalog.index') }}" method="GET">
                            {{-- Input Search --}}
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Pencarian</label>
                                <input type="text" name="search" class="form-control form-control-sm" 
                                       placeholder="Nama Produk / Toko..." value="{{ request('search') }}">
                            </div>

                            {{-- Dropdown Kategori --}}
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Kategori</label>
                                <select name="category" class="form-select form-select-sm">
                                    <option value="">Semua Kategori</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Dropdown Lokasi (Provinsi) --}}
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Lokasi Toko</label>
                                <select name="province" class="form-select form-select-sm">
                                    <option value="">Semua Lokasi</option>
                                    @foreach($provinces as $prov)
                                        <option value="{{ $prov->name }}" {{ request('province') == $prov->name ? 'selected' : '' }}>
                                            {{ $prov->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Dropdown Urutkan --}}
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Urutkan</label>
                                <select name="sort" class="form-select form-select-sm">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                                    <option value="rating_high" {{ request('sort') == 'rating_high' ? 'selected' : '' }}>Rating Tertinggi</option>
                                </select>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-sm">Terapkan Filter</button>
                                <a href="{{ route('catalog.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            {{-- LIST PRODUK --}}
            <div class="col-md-9">
                <div class="row">
                    @forelse($products as $product)
                        <div class="col-6 col-md-4 mb-4">
                            <div class="card h-100 shadow-sm border-0">
                                {{-- Logic Gambar --}}
                                <div style="height: 180px; overflow: hidden;">
                                    @if(is_array($product->images) && count($product->images) > 0)
                                        <img src="{{ asset('storage/' . $product->images[0]) }}" class="card-img-top w-100 h-100 object-fit-cover">
                                    @else
                                        <img src="https://via.placeholder.com/300?text=Produk" class="card-img-top w-100 h-100 object-fit-cover">
                                    @endif
                                </div>
                                
                                <div class="card-body p-3">
                                    <h6 class="card-title text-truncate">{{ $product->name }}</h6>
                                    <p class="text-danger fw-bold mb-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                    
                                    {{-- Kategori Badge --}}
                                    <span class="badge bg-secondary mb-2">{{ $product->category->name ?? 'Umum' }}</span>

                                    <div class="small text-muted mb-2">
                                        <i class="fas fa-map-marker-alt text-danger"></i> {{ $product->seller->city ?? 'Indonesia' }}
                                    </div>
                                    
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-star text-warning me-1"></i>
                                        <small>{{ number_format($product->reviews_avg_rating ?? 0, 1) }}</small>
                                    </div>
                                </div>
                                <a href="{{ route('catalog.show', $product->id) }}" class="stretched-link"></a>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <h4>Produk tidak ditemukan :(</h4>
                            <p>Coba ubah filter pencarian Anda.</p>
                        </div>
                    @endforelse
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        
        </div>
    </div>
</body>
</html>