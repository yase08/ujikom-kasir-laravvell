@extends('layouts.dashboard')
@section('title', 'Dashboard Buy Product')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Buy</h1>
        </div>
        @if ($errors->any())
            @foreach ($errors->message as $errs)
                {{ dd($errs) }}
            @endforeach
        @endif
        @if (session('success'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    <b>Success:</b>
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if (session('fail'))
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    <b>Fail:</b>
                    Produk dengan kode
                    @foreach (session('fail') as $code)
                        <b>{{ $code }}</b>,
                    @endforeach
                    tidak tersedia
                </div>
            </div>
        @endif
        <div class="section-body">
            <form action="{{ route('sale.store') }}" method="post" class="needs-validation" novalidate>
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4>Customer Information:</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Customer Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" required>
                                <div class="invalid-feedback">
                                    please fill in the name
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Customer Phone<span class="text-danger">*</span></label>
                                <input type="number" name="phone" class="form-control" required>
                                <div class="invalid-feedback">
                                    please fill in the phone
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label>Customer Address</label>
                                <textarea name="address" class="form-control"></textarea>
                                <div class="invalid-feedback">
                                    please fill in the address
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="productInputContainer">
                    <div class="card">
                        <div class="card-body">
                            <div class="row product-input">
                                <div class="form-group col-md-6 col-12">
                                    <label for="">Product</label>
                                    <select class="form-control" name="products[]">
                                        <option disabled selected>Select Product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-12">
                                    <label>Quantity<span class="text-danger">*</span></label>
                                    <input type="number" name="quantities[]" class="form-control total-input" required>
                                    <div class="invalid-feedback">
                                        please fill in the quantity
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <button type="button" class="btn btn-primary" onclick="addProductInput()">Add Product</button>
                    <button class="btn btn-success">Buy</button>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        function addProductInput() {
            var productInputContainer = document.getElementById('productInputContainer');
            var newProductInput = productInputContainer.children[0].cloneNode(true);
            var newIndex = productInputContainer.children.length;
            newProductInput.querySelectorAll('input').forEach(function(input) {
                input.value = '';
            });
            newProductInput.querySelector('select').name = 'products[' + newIndex + ']';
            productInputContainer.appendChild(newProductInput);
        }

        function removeProductInput(button) {
            var card = button.closest('.card');
            card.remove();
        }
    </script>
@endsection
