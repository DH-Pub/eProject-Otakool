@extends('be.layout.layout')
@section('title', 'Promotion - create')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create Promotion</h3>
                        </div>

                        <form role="form" action="{{ route('be.promotion.createPost') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Input Promotion Name" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="4">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Type</label>
                                    <div>
                                        <label class="radio-inline px-2">
                                            <input type="radio" name="type" value="0" {{ old('type') == '0' ? 'checked' : '' }}>Flat price
                                        </label>
                                        <label class="radio-inline px-2">
                                            <input type="radio" name="type" value="1" {{ old('type') == '1' ? 'checked' : '' }}>Percentage
                                        </label>
                                    </div>
                                    @error('type')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" step=".01" class="form-control" id="amount" name="amount" placeholder="Input Promotion Amount" value="{{ old('amount') }}">
                                    @error('amount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    @if (Session::has('amount_err'))
                                        <div class="alert alert-danger">
                                            {{ Session::get('amount_err') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="start">Promotion Start Date</label>
                                    <input type="date" class="form-control" id="start" name="start"value="{{ old('start') }}">
                                    @error('start')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="end">Promotion End Date</label>
                                    <input type="date" class="form-control" id="end" name="end"value="{{ old('end') }}">
                                    @error('end')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="applied_products">Applied Products</label>
                                    <textarea class="form-control" name="applied_products" id="applied_products" rows="4">{{ old('applied_products') }}</textarea>

                                    @error('applied_products')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
