@extends('be.layout.layout')
@section('title', 'Product Details')

@section('style-section')
    <style>
        img {
            height: 300px;
            width: 300px;
            display: block;
            object-fit: contain;
        }

        .product-description {
            white-space: pre-wrap;
        }
    </style>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-2 col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Product Details</h3>
                        </div>
                        <div class="card-body">
                            <table id="product" class="table table-bordered table-hover">
                                <tr>
                                    <td>Id</td>
                                    <td>{{ $p->id }}</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $p->name }}</td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td>${{ $p->price }}</td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td class="product-description">{{ $p->description }}</td>
                                </tr>
                                <tr>
                                    <td>Release Date</td>
                                    <td>{{ $p->release }}</td>
                                </tr>
                                <tr>
                                    <td>Quantity</td>
                                    <td>{{ $p->quantity }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        @switch($p->status)
                                            @case(1)
                                                Available
                                            @break

                                            @case(0)
                                                Out of Stock
                                            @break

                                            @case(-1)
                                                Hidden
                                            @break
                                        @endswitch
                                    </td>
                                </tr>
                                <tr>
                                    <td>Type</td>
                                    <td>{{ $p->type }}</td>
                                </tr>
                                <tr>
                                    <td>Tags</td>
                                    <td>{{ $p->tags }}</td>
                                </tr>
                                <tr>
                                    <td>Cover</td>
                                    <td>
                                        <img src="{{ url('images/' . $p->type . '/' . $p->folder . '/' . $p->cover) }}" class="img-fluid">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Other Images</td>
                                    <td class="row m-0">
                                        @if (isset($images))
                                            @foreach ($images as $image)
                                                <img src="{{ url('images/' . $p->type . '/' . $p->folder . '/' . $image) }}" class="img-fluid col-md-3">
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Stored Folder</td>
                                    <td>{{ $p->folder }}</td>
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td>{{ $p->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td>
                                        {{ $p->updated_at }}
                                        <div>
                                            <a class="btn btn-warning mt-2" href="{{ Route('be.product.update', $p->id) }}">Update</a>
                                            <a class="btn btn-danger btn-sm float-right" href="{{ Route('be.product.delete', $p->id) }}">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- @section('script-section')
        <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                bsCustomFileInput.init();
            });
        </script>
    @endsection --}}
