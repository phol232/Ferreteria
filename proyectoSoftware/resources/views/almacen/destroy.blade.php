@extends('layouts.plantilla')

@section('title','Productos')

@section('content')
    <div class="container">
        <h1 class="page-title">En esta página podrás ver todos los productos</h1>

        <!-- Container for product cards -->
        <div class="product-cards">
            <div class="product-card">
                <div class="product-title">AEA</div>
                <div class="product-body">
                    <img src="https://imgur.com/O4fpbdL.jpg" alt="Producto" class="product-image">
                    <p class="product-description">Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="product-footer">
                    <a href="#" class="add-button">Agregar</a>
                </div>
            </div>

            <!-- You can add more product cards here -->
        </div>
    </div>

    <style>
        /* General Styles */
        .container {
            width: 90%;
            margin: 0 auto;
            padding: 30px;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            text-align: center;
            font-size: 28px;
            color: #333;
            margin-bottom: 30px;
            font-weight: bold;
        }

        /* Product Card Container */
        .product-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
            gap: 20px;
            margin-top: 20px;
        }

        /* Individual Product Card */
        .product-card {
            width: 200px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* Hover Effect for Product Card */
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Product Title */
        .product-title {
            font-weight: bold;
            font-size: 1.2em;
            color: #333;
            margin-bottom: 10px;
        }

        /* Product Image */
        .product-image {
            border-radius: 8px;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

        /* Product Description */
        .product-description {
            font-size: 0.9em;
            color: #777;
            margin-top: 10px;
        }

        /* Add Button */
        .add-button {
            text-decoration: none;
            background-color: #007bff;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        /* Add Button Hover Effect */
        .add-button:hover {
            background-color: #0056b3;
        }
    </style>
@endsection


