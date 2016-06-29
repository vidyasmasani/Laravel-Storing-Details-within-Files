<!-- resources/views/tasks.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Product Form -->
        <form action="{{ url('product') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <h3>Add Product</h3>
            <!-- Product Name -->
            <div class="form-group">    

                <div class="col-sm-12">
                    <label for="product-name" class="col-sm-2 control-label">Product Name</label>
                    <input type="text" name="name" id="product-name" class="form-control">                    
                </div>
                <div class="col-sm-12">
                    <label for="product-quantity" class="col-sm-2 control-label">Quantity In Stock</label>
                    <input type="text" name="quantity" id="product-quantity" class="form-control">                
                </div>
                <div class="col-sm-12">
                    <label for="product-price" class="col-sm-2 control-label">Price per item</label>
                    <input type="text" name="price" id="product-price" class="form-control">
                </div>
            </div>

            <!-- Add Product Button -->
            <div class="form-group">
                <div class="col-sm-offset-1 col-sm-12">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Product
                    </button>
                </div>
            </div>
        </form>
    </div>

       <!-- Current Tasks -->
    @if (count($products) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Products
            </div>

            <div class="panel-body">
                <table class="table table-striped product-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Product Name</th>
                        <th>Quantity in stock</th>
                        <th>Price per Item</th>
                        <th>Total value number</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                   
                    
                        @foreach ($products as $product)
                            <tr>
                                <!-- Product Name -->
                                <td class="table-text">
                                    <div>{{ $product->name }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $product->quantity }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $product->price }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $product->total }}</div>
                                </td>

                                <!-- Delete Button -->
                                <td>                                
                                    <form action="{{ url('product/edit/'.$product->id) }}" method="GET">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}

                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i> Edit
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                     
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
