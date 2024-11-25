<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VAA Store</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link href="{{ asset('public/css/home.css') }}" rel='stylesheet' type='text/css' />
  <script src="{{ asset('public/js/home.js') }}" defer></script>

</head>

<body>
  <div id="app">
    <header>  
      <div class="logo">
          <a href="{{ url('/home') }}">        
              <img src="{{ asset('public/images/logo.png') }}" alt="Logo" class="logo">
          </a>
      </div>
      <div class="menu">
        <ul> 
            @foreach ($categories as $category)
                <li><a href="{{ route('products.category', ['category_id' => $category->category_id]) }}">{{ $category->category_name }}</a></li>
            @endforeach
            <li><a href="{{ route('allProduct') }}">ALL PRODUCTS</a></li>
        </ul>
    </div>
    
      <div class="others">
        <li class="search">
            <input placeholder="Tìm kiếm" type="text" id="search-input">
            <i class="fas fa-search"></i>
        </li>
    
        @if(session('full_name'))
        <li class="dropdown">
            <p class="dropdown-toggle">{{ session('full_name') }}</p>
            <div class="dropdown-content">
              <a href="{{ route('profile') }}">Thông tin cá nhân</a>
              <a href="">Đổi mật khẩu</a>
              <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Đăng xuất</button>
                </form>
            </div>
        </li>
        @else
            <li>
                <a class="fa fa-user" href="{{ url('/login') }}"></a>
            </li>
        @endif

    
        <li>
            <a class="fa fa-shopping-bag" href="{{ url('/carts') }}"></a>
        </li>
        <li>
            <a class="fa fa-heart" href="{{ url('/favorites') }}"></a> 
        </li>
    </div>
    </header>

    <div class="container mt-5">
    <div class="row">
      <!-- Image section -->
      <div class="col-md-6">
        <img src="{{ asset('public/' . $product->product_img) }}" class="product-image-main" alt="Product Image">
        <div class="row mt-3">
          <div class="col-3">
            <img src="https://via.placeholder.com/100" class="product-thumbnail" alt="Thumbnail 1">
          </div>
          <div class="col-3">
            <img src="https://via.placeholder.com/100" class="product-thumbnail" alt="Thumbnail 2">
          </div>
          <div class="col-3">
            <img src="https://via.placeholder.com/100" class="product-thumbnail" alt="Thumbnail 3">
          </div>
          <div class="col-3">
            <img src="https://via.placeholder.com/100" class="product-thumbnail" alt="Thumbnail 4">
          </div>
        </div>
      </div>

      <!-- Product Details section -->
      <div class="col-md-6">
        <h1 class="product-title">{{ $product->product_name }}</h1>
        <div class="product-price">{{ number_format($product->product_price, 0, ',', '.') }}đ</div>
        <div class="product-color mb-3">
          <span>Màu sắc: Kẻ Xanh tím than</span><br>
          <div class="color-option" style="background-color: #4e5b76;"></div>
          <div class="color-option" style="background-color: #333;"></div>
        </div>
        <div class="size-options mb-3">
          <label>Chọn size:</label><br>
          <button class="btn btn-outline-secondary">S</button>
          <button class="btn btn-outline-secondary">M</button>
          <button class="btn btn-outline-secondary">L</button>
          <button class="btn btn-outline-secondary" disabled>XL</button>
          <button class="btn btn-outline-secondary">XXL</button>
        </div>
        <div class="quantity mb-3">
          <label>Số lượng:</label>
          <div class="input-group" style="width: 100px;">
            <button class="btn btn-outline-secondary">-</button>
            <input type="text" class="form-control text-center" value="1">
            <button class="btn btn-outline-secondary">+</button>
          </div><br>
          <button class="btn btn-outline-secondary"><i class="far fa-heart"></i></button>
        </div>
        <button class="btn btn-outline-dark btn-buy">THÊM VÀO GIỎ</button>
        <button class="btn btn-dark btn-cart">MUA HÀNG</button>

        <div class="mt-4">
          <ul class="nav nav-tabs" id="productTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="intro-tab" data-bs-toggle="tab" data-bs-target="#intro" type="button" role="tab" aria-controls="intro" aria-selected="true">GIỚI THIỆU</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false">CHI TIẾT SẢN PHẨM</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="care-tab" data-bs-toggle="tab" data-bs-target="#care" type="button" role="tab" aria-controls="care" aria-selected="false">BẢO QUẢN</button>
            </li>
          </ul>
          <div class="tab-content" id="productTabContent">
            <div class="tab-pane fade show active" id="intro" role="tabpanel" aria-labelledby="intro-tab">
              <div class="content-section">
                <p class="content-text">{{ $product->product_description }}</p>
                <button class="toggle-btn btn btn-link"><i class="fa-solid fa-sort-down toggle-icon"></i></button>
              </div>
            </div>
            <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
              <div class="content-section">
                <p class="content-text">Chi tiết sản phẩm...</p>
                <button class="toggle-btn btn btn-link">Xem thêm</button>
              </div>
            </div>
            <div class="tab-pane fade" id="care" role="tabpanel" aria-labelledby="care-tab">
              <div class="content-section">
                <p class="content-text">Hướng dẫn bảo quản...</p>
                <button class="toggle-btn btn btn-link">Xem thêm</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="related-products mt-5">
      <h2 class="text-center mb-4">CÓ THỂ BẠN SẼ THÍCH</h2>
      <div class="row">
        @foreach ($relatedProducts as $relatedProduct)
          <div class="col-md-3">
            <div class="product-card">
              <span class="new-label">NEW</span>
              <a href="{{ route('products.detail', ['product_id' => $relatedProduct->product_id]) }}" class="product-link">
                <img src="{{ asset('public/' . $relatedProduct->product_img) }}" class="img-fluid" alt="Product 1">
                <p class="product-name mt-2">{{ $relatedProduct->product_name }}</p>
              </a>
                <p class="product-price">{{ number_format($relatedProduct->product_price, 0, ',', '.') }}đ</p>
              <div class="mt-2">
                <button class="btn btn-outline-secondary"><i class="far fa-heart"></i></button>
                <button class="btn btn-dark"><i class="fas fa-shopping-bag"></i></button>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</body><br>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h3>Liên hệ</h3>
                <p>Hotline: 1900 XXX XXX</p>
                <p>Email: xxxxxx@vaa.edu.vn</p>
                <p>Địa chỉ: 104 Nguyễn Văn Trỗi, phường 8, Phú Nhuận, Ho Chi Minh City, Vietnam</p>
            </div>
            <div class="col-md-4">
                <h3>Về chúng tôi</h3>
                <p><a href="#">Giới thiệu</a></p>
                <p><a href="#">Tuyển dụng</a></p>
                <p><a href="#">Blog</a></p>
            </div>
            <div class="col-md-4">
                <h3>Hỗ trợ</h3>
                <p><a href="#">Hướng dẫn mua hàng</a></p>
                <p><a href="#">Chính sách đổi trả</a></p>
                <p><a href="#">Câu hỏi thường gặp</a></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p>&copy; 2024 VAA Store.</p>
                <div class="social-media">
                    <a href="#"><i class="fab fa-facebook-f me-2"></i></a>
                    <a href="#"><i class="fab fa-twitter me-2"></i></a>
                    <a href="#"><i class="fab fa-instagram me-2"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
</html>