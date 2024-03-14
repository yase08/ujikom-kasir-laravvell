@extends('layouts.dashboard')
@section('title', 'Dashboard Product')
@section('content')
    <section class="section">
        <section class="section-header">
            <h1>Edit Product</h1>
        </section>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('product.update', $product->id) }}" method="post" novalidate class="needs-validation">
                    @method('PATCH')
                    @csrf
                    <div class="card-header">
                        <h4>Edit Product</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Name</label>
                                <input type="text" name="name" id="name" class="form-control" required
                                    value="{{ $product->name }}">
                                <div class="invalid-feedback">
                                    please fill in the name
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Price</label>
                                <input type="text" name="price" id="price" class="form-control" required
                                    value="{{ $product->price }}">
                                <div class="invalid-feedback">
                                    please fill in the price
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Stock</label>
                                <input type="text" name="stock" id="stock" class="form-control" required
                                    value="{{ $product->stock }}">
                                <div class="invalid-feedback">
                                    please fill in the stock
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success">Update</button>
                        <a href="{{ route('product') }}" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
