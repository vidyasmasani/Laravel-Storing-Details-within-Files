<!-- resources/views/tasks.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Product Form -->
        <form action="{{ url('product/edit/'.$single_product->id) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <h3>Edit Product</h3>

            <!-- Product Name -->
            <div class="form-group">

                <input type="hidden" name="id" id="product-id" value="{{$single_product->id}}">  
                
                <div class="col-sm-12">
                    Product Name : <input type="text" name="name" id="product-name" class="col-sm-2 form-control" value="{{$single_product->name}}">                    
                </div>
                <div class="col-sm-12">
                    Quantity In Stock : <input type="text" name="quantity" id="product-quantity" class="col-sm-2 form-control" value="{{$single_product->quantity}}">                
                </div>
                <div class="col-sm-12">
                    Price per item : <input type="text" name="price" id="product-price" class="col-sm-2 form-control" value="{{$single_product->price}}">
                </div>
            </div>

            <!-- Edit Product Button -->
            <div class="form-group">
                <div class="col-sm-offset-1 col-sm-12">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Update Product
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
