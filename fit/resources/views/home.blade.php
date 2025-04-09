@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="container">
            <h1>Welcome to Your Dashboard</h1>
            <p>Manage your account and explore our premium products</p>
        </div>
    </div>

    <div class="container">
        @if (session('status'))
            <div class="alert-message">
                {{ session('status') }}
            </div>
        @endif

        <div class="dashboard-content">
            <h2 class="section-title">{{ __('You are logged in!') }}</h2>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('user.profile') }}" class="action-btn">
                    <i class="fas fa-user-circle"></i> {{ __('View Profile') }}
                </a>

                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.users.index') }}" class="action-btn admin">
                        <i class="fas fa-users-cog"></i> {{ __('Manage Users') }}
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="action-btn admin">
                        <i class="fas fa-box-open"></i> {{ __('Manage Products') }}
                    </a>
                @endif
            </div>

            <!-- Available Products -->
            @if(!Auth::user()->isAdmin())
                <h2 class="section-title">Available Products</h2>
                <div class="products-grid">
                    @foreach ($products as $product)
                        <div class="product-card">
                            <div class="product-image">
                                @if ($product->image)
                                    <img src="{{ Storage::url($product->image) }}" alt="Product Image">
                                @else
                                    <img src="{{ asset('images/default.png') }}" alt="Default Image">
                                @endif
                                <span class="stock-badge {{ $product->stock > 0 ? 'in-stock' : 'out-of-stock' }}">
                                    {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                                </span>
                            </div>
                            <div class="product-info">
                                <h3>{{ $product->name }}</h3>
                                <p class="description">{{ $product->description }}</p>
                                <p class="price">₱{{ number_format($product->price, 2) }}</p>
                                <p class="stock">Stock: {{ $product->stock }}</p>

                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="add-to-cart">
                                        <i class="fas fa-cart-plus"></i> Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Arial', sans-serif;
    }
    
    .dashboard-container {
        background-color: #f5f5f5;
        color: #333;
        padding-bottom: 40px;
    }
    
    .dashboard-header {
        background-color: #1a1a1a;
        color: white;
        padding: 100px 0 60px;
        text-align: center;
        margin-bottom: 40px;
        background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1571902943202-507ec2618e8f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
    }
    
    .dashboard-header h1 {
        font-size: 48px;
        margin-bottom: 20px;
        color: #ff6b00;
    }
    
    .dashboard-header p {
        font-size: 20px;
        color: #ddd;
    }
    
    .container {
        width: 90%;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .alert-message {
        background-color: #4CAF50;
        color: white;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 30px;
        text-align: center;
    }
    
    .section-title {
        text-align: center;
        margin-bottom: 40px;
        font-size: 36px;
        color: #1a1a1a;
    }
    
    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        margin-bottom: 50px;
    }
    
    .action-btn {
        padding: 15px 25px;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        background-color: #ff6b00;
        color: white;
        border: 2px solid #ff6b00;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .action-btn:hover {
        background-color: #e05d00;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .action-btn.admin {
        background-color: #1a1a1a;
        border-color: #1a1a1a;
    }
    
    .action-btn.admin:hover {
        background-color: #333;
    }
    
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
    }
    
    .product-card {
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }
    
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }
    
    .product-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }
    
    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .product-card:hover .product-image img {
        transform: scale(1.1);
    }
    
    .stock-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
        font-size: 12px;
    }
    
    .in-stock {
        background-color: #4CAF50;
        color: white;
    }
    
    .out-of-stock {
        background-color: #f44336;
        color: white;
    }
    
    .product-info {
        padding: 20px;
        text-align: center;
    }
    
    .product-info h3 {
        margin-bottom: 10px;
        font-size: 20px;
        color: #1a1a1a;
    }
    
    .description {
        color: #666;
        margin-bottom: 15px;
        font-size: 14px;
    }
    
    .price {
        font-weight: bold;
        font-size: 18px;
        color: #ff6b00;
        margin-bottom: 10px;
    }
    
    .stock {
        color: #777;
        font-size: 14px;
        margin-bottom: 15px;
    }
    
    .add-to-cart {
        width: 100%;
        padding: 12px;
        background-color: #1a1a1a;
        color: white;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    
    .add-to-cart:hover {
        background-color: #ff6b00;
        transform: translateY(-2px);
    }
    
    @media (max-width: 768px) {
        .dashboard-header h1 {
            font-size: 36px;
        }
        
        .dashboard-header p {
            font-size: 16px;
        }
        
        .section-title {
            font-size: 28px;
        }
        
        .action-buttons {
            flex-direction: column;
            align-items: center;
        }
        
        .action-btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection