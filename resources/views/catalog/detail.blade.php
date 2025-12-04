
@extends('layouts.app')

@section('title', $product->name . ' - Detail Produk')


@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card mb-4 shadow-sm p-4">
            <div class="row g-4">
                <!-- Left: Image Gallery -->
                <div class="col-md-5">
                    <div class="mb-3">
                        @if($product->images && count($product->images) > 0)
                            <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}" class="img-fluid rounded w-100 border" style="max-height:320px;object-fit:cover;">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($product->name) }}&background=0D8ABC&color=fff" alt="{{ $product->name }}" class="img-fluid rounded w-100 border" style="max-height:320px;object-fit:cover;">
                        @endif
                    </div>
                    @if($product->images && count($product->images) > 1)
                        <div class="d-flex gap-2 overflow-auto pb-2">
                            @foreach($product->images as $img)
                                <img src="{{ asset('storage/' . $img) }}" alt="Gambar Produk" class="rounded border" style="width:60px;height:60px;object-fit:cover;">
                            @endforeach
                        </div>
                    @endif
                </div>
                <!-- Right: Product Info -->
                <div class="col-md-7">
                    <h4 class="fw-bold mb-1">{{ $product->name }}</h4>
                    <div class="mb-2">
                        <span class="badge bg-success me-1">{{ $product->category->name }}</span>
                        <span class="badge bg-info me-1">{{ $product->brand }}</span>
                        <span class="badge bg-secondary me-1">{{ $product->condition == 'new' ? 'Baru' : 'Bekas' }}</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <span class="fs-3 fw-bold text-danger me-3">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <span class="badge bg-light text-dark border">Diskon 34%</span>
                    </div>
                    <!-- Variant Selection (Capacity) -->
                    @if(isset($product->variants) && is_array($product->variants) && count($product->variants) > 0)
                    <div class="mb-3">
                        <div class="fw-semibold mb-1">Pilih kapasitas:</div>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($product->variants as $variant)
                                <button class="btn btn-outline-success btn-sm px-3 @if($variant['selected'] ?? false) active fw-bold @endif" disabled>{{ $variant['label'] }}</button>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <div class="mb-2">
                        <span class="text-muted">Stok:</span> <span class="fw-semibold">{{ $product->stock }}</span>
                        <span class="ms-3 text-muted">Berat:</span> <span class="fw-semibold">{{ $product->weight }} gram</span>
                        <span class="ms-3 text-muted">Minimal Pembelian:</span> <span class="fw-semibold">{{ $product->min_order }}</span>
                    </div>
                    <div class="mb-3">
                        <span class="text-muted">Rating:</span>
                        <span class="fw-semibold">{{ number_format($product->reviews_avg_rating, 1) }}/5</span>
                        <span class="text-muted">({{ $product->reviews_count }} ulasan)</span>
                    </div>
                    <a href="#" class="btn btn-success btn-lg px-5 py-2 fw-bold mb-2"><i class="fas fa-shopping-cart me-2"></i>Beli Sekarang</a>
                    <div class="mt-2">
                        <span class="text-muted">Penjual:</span>
                        <span class="fw-semibold">{{ $product->seller->store_name }}</span>
                        <span class="text-muted">({{ $product->seller->province }})</span>
                    </div>
                </div>
            </div>
            <!-- Tabs for Detail, Spesifikasi, Info Penting -->
            <ul class="nav nav-tabs mt-4" id="productTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="detail-tab" data-bs-toggle="tab" data-bs-target="#detail" type="button" role="tab">Detail Produk</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="spec-tab" data-bs-toggle="tab" data-bs-target="#spec" type="button" role="tab">Spesifikasi</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">Info Penting</button>
                </li>
            </ul>
            <div class="tab-content p-3 border-bottom border-start border-end bg-white" id="productTabContent">
                <div class="tab-pane fade show active" id="detail" role="tabpanel">
                    <div class="mb-2"><strong>Kondisi:</strong> {{ $product->condition == 'new' ? 'Baru' : 'Bekas' }}</div>
                    <div class="mb-2"><strong>Deskripsi:</strong> {{ $product->description }}</div>
                </div>
                <div class="tab-pane fade" id="spec" role="tabpanel">
                    <ul class="list-unstyled mb-0">
                        <li><strong>Kategori:</strong> {{ $product->category->name }}</li>
                        <li><strong>Brand:</strong> {{ $product->brand }}</li>
                        <li><strong>Berat:</strong> {{ $product->weight }} gram</li>
                        <li><strong>Stok:</strong> {{ $product->stock }}</li>
                        <li><strong>Minimal Pembelian:</strong> {{ $product->min_order }}</li>
                        <li><strong>Penjual:</strong> {{ $product->seller->store_name }}</li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="info" role="tabpanel">
                    <div class="alert alert-warning mb-2">
                        <strong>PERHATIAN:</strong><br>
                        <ul class="mb-0 ps-3">
                            <li>Pastikan memilih kapasitas yang sesuai dengan kapasitas maksimal yang didukung perangkat Anda.</li>
                            <li>Produk ini tidak dirancang untuk penggunaan di CCTV/Dashcam, untuk perangkat tersebut harap memilih tipe microSD PRO Endurance.</li>
                            <li>Harap membuat video unboxing lengkap dan jelas setelah menerima produk.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Ulasan & Ulasan Pembeli -->
        <div class="card mb-4 shadow-sm mt-4">
            <div class="card-header bg-white fw-bold fs-5"><i class="fas fa-star text-warning me-2"></i>Ulasan Pembeli</div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form method="POST" action="{{ route('catalog.review.store', $product->id) }}" class="mb-4">
                    @csrf
                    <div class="row g-2 mb-2">
                        <div class="col-md-4">
                            <input type="text" name="reviewer_name" class="form-control" placeholder="Nama" required value="{{ old('reviewer_name') }}">
                        </div>
                        <div class="col-md-4">
                            <input type="email" name="reviewer_email" class="form-control" placeholder="Email" required value="{{ old('reviewer_email') }}">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="reviewer_phone" class="form-control" placeholder="No. HP" required value="{{ old('reviewer_phone') }}">
                        </div>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-md-2">
                            <select name="rating" class="form-select" required>
                                <option value="">Rating</option>
                                @for($i=1;$i<=5;$i++)
                                    <option value="{{ $i }}" @if(old('rating')==$i) selected @endif>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="comment" class="form-control" placeholder="Tulis komentar Anda..." required value="{{ old('comment') }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                </form>
                <hr>
                @if($product->reviews_count > 0)
                    @foreach($product->reviews as $review)
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <span class="fw-semibold">{{ $review->reviewer_name ?? 'Pembeli' }}</span>
                                <span class="ms-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                </span>
                            </div>
                            <p class="mb-0">{{ $review->comment }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">Belum ada ulasan untuk produk ini.</p>
                @endif
            </div>
        </div>

        <!-- Seller Store Info -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($product->seller->store_name) }}&background=0D8ABC&color=fff" alt="{{ $product->seller->store_name }}" class="rounded-circle me-3" style="width:56px;height:56px;object-fit:cover;">
                <div>
                    <div class="fw-bold mb-1">{{ $product->seller->store_name }}</div>
                    <div class="text-muted small">Penjual Terverifikasi</div>
                </div>
                <a href="#" class="btn btn-outline-primary ms-auto">Lihat Toko</a>
            </div>
        </div>
    </div>
</div>
@endsection
