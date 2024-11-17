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
          <button id="search-button" style="background: none; border: none; cursor: pointer;">
              <i class="fas fa-search"></i>
          </button>
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
          <a class="fa fa-shopping-bag" href="#" id="cart-icon">
              <span id="cart-count" class="badge badge-danger">{{ session('cart') ? count(session('cart')) : 0 }}</span>
          </a>
      </li>
      
      
        <li>
            <a class="fa fa-heart" href="{{ url('/favorites') }}"></a> 
        </li>
    </div>
    </header>

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="public/images/slide1.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            
          </div>
        </div>
        <div class="carousel-item">
          <img src="public/images/slide2.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
          </div>
        </div>
        <div class="carousel-item">
          <img src="public/images/slide3.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    @foreach ($categories as $category)
    <div class="container mt-5">
      <h2 class="text-center">{{ $category->category_name }}</h2>
      <div class="product-slider">
        <div class="product-wrapper">
          <div class="row">
            @foreach ($category->products as $product)
              <div class="col-md-3">
                <div class="product-card">
                  <span class="new-label">NEW</span>
                  <a href="{{ route('products.detail', ['product_id' => $product->product_id]) }}" class="product-card-link">
                    <img src="{{ asset('public/images/' . $product->product_img) }}" class="img-fluid rounded-start" alt="...">
                    <p class="product-name mt-2">{{ $product->product_name }}</p>
                  </a>
                  <p class="product-price">{{ number_format($product->product_price, 0, ',', '.') }}₫</p>
                  <div class="mt-2">
                    <button class="btn btn-outline-secondary"><i class="far fa-heart"></i></button>
                    <button class="btn btn-dark add-to-cart-btn" data-product-id="{{ $product->product_id }}">
                      <i class="fas fa-shopping-bag"></i>
                  </button>                  
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
        <button class="prev btn btn-secondary">
          <i class="fas fa-chevron-left"></i>
        </button>
        <button class="next btn btn-secondary">
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>
      <div class="text-center">
        <a href="{{ route('products.category', ['category_id' => $category->category_id]) }}" class="btn btn-dark mt-3">Xem tất cả</a>
      </div>
    </div><br>
    @endforeach

    <!-- Popup giỏ hàng -->
<div id="cart-popup" class="cart-popup d-none">
  <div class="cart-popup-content">
    <div class="cart-popup-header">
      <h4>Giỏ hàng của bạn</h4>
      <button id="close-cart-popup" class="btn-close">&times;</button>
    </div>
    <div class="cart-popup-body">
      <p>Đang tải...</p> <!-- Nội dung giỏ hàng sẽ được thêm vào đây bằng AJAX -->
    </div>
    <div class="cart-popup-footer">
      <a href="{{ url('/carts') }}" class="btn btn-primary">Thanh toán</a>
    </div>
  </div>
</div>

      

  </div>
  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="add-to-cart-toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="1500">
      <div class="toast-header">
        <strong class="me-auto">Thông báo</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        Sản phẩm đã được thêm vào giỏ hàng thành công!
      </div>
    </div>
  </div>
  
  
</body>

<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h3>Liên hệ</h3>
        <p>Hotline: 1900 XXX XXX</p>
        <p>Email: xxxxxx@vaa.edu.vn</p>
        <p>Địa chỉ: 104 Nguyễn Văn Trỗi, Phường 8, Quận Phú Nhuận, TPHCM </p>
      </div>
      <div class="col-md-4">
        <h3>Về chúng tôi</h3>
        <p>Giới thiệu</p>
        <p>Tuyển dụng</p>
        <p>Blog</p>
      </div>
      <div class="col-md-4">
        <h3>Hỗ trợ</h3>
        <p>Hướng dẫn mua hàng</p>
        <p>Chính sách đổi trả</p>
        <p>Câu hỏi thường gặp</p>
      </div>
    </div>
  </div>
</footer>
</html>
<script>
  $(document).ready(function () {
    // Xử lý sự kiện khi nhấn nút thêm vào giỏ hàng
    $('.add-to-cart-btn').on('click', function (e) {
        e.preventDefault();

        var product_id = $(this).data('product-id'); // Lấy ID sản phẩm từ thuộc tính data

        $.ajax({
            url: '{{ route('addToCart') }}', // Đường dẫn đến route thêm sản phẩm vào giỏ hàng
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Thêm token CSRF
                product_id: product_id // ID sản phẩm
            },
            success: function (response) {
                if (response.status === 'success') {
                    // Cập nhật số lượng sản phẩm trong giỏ hàng
                    $('#cart-count').text(response.cart_count);
                    // Cập nhật nội dung của popup giỏ hàng
                    updateCartPopup(response.cart_items);
                    var toast = new bootstrap.Toast(document.getElementById('add-to-cart-toast'));
        toast.show();
                } else {
                    alert('Lỗi khi thêm sản phẩm vào giỏ hàng.');
                }
            },
            error: function () {
                alert('Đã xảy ra lỗi. Vui lòng thử lại.');
            }
        });
    });

    // Hàm để cập nhật nội dung của popup giỏ hàng
    function updateCartPopup(cartItems) {
    var cartContent = '<h3>Giỏ hàng của bạn</h3><ul>';
    if (cartItems.length > 0) {
        cartItems.forEach(function(item) {
            cartContent += `
                <li>
                    <img src="${item.image}" alt="${item.name}" style="width:50px; height:50px; margin-right:10px;">
                    <span>${item.name}</span> - 
                    <span>${item.price.toLocaleString()}₫</span> x 
                    <input type="number" value="${item.quantity}" min="1" data-product-id="${item.id}" class="quantity-input" style="width: 50px; margin-right: 10px;">
                    <button class="btn btn-danger remove-item" data-product-id="${item.id}">Xóa</button>
                </li>
            `;
        });
        cartContent += '</ul>';
    } else {
        cartContent += '<p>Hiện tại chưa có sản phẩm nào.</p>';
    }
    $('.cart-popup-body').html(cartContent); // Cập nhật nội dung popup giỏ hàng
}
$(document).on('click', '.remove-item', function() {
    var product_id = $(this).data('product-id');

    $.ajax({
        url: '{{ route('removeFromCart') }}', // Đường dẫn đến route xóa sản phẩm
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}', // Thêm token CSRF
            product_id: product_id // ID sản phẩm
        },
        success: function(response) {
            if (response.status === 'success') {
                $('#cart-count').text(response.cart_count);
                updateCartPopup(response.cart_items);
            } else {
                alert('Lỗi khi xóa sản phẩm khỏi giỏ hàng.');
            }
        },
        error: function() {
            alert('Đã xảy ra lỗi. Vui lòng thử lại.');
        }
    });
});
$(document).on('change', '.quantity-input', function() {
    var product_id = $(this).data('product-id');
    var quantity = $(this).val();

    $.ajax({
        url: '{{ route('updateCartQuantity') }}', // Đường dẫn đến route cập nhật số lượng
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}', // Thêm token CSRF
            product_id: product_id,
            quantity: quantity // Số lượng mới
        },
        success: function(response) {
            if (response.status === 'success') {
                $('#cart-count').text(response.cart_count);
                updateCartPopup(response.cart_items);
            } else {
                alert('Lỗi khi cập nhật số lượng sản phẩm.');
            }
        },
        error: function() {
            alert('Đã xảy ra lỗi. Vui lòng thử lại.');
        }
    });
});
});
</script>


