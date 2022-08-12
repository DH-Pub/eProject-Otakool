@extends('be.layout.layout')
@section('title', 'Order Edit')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit order</h3>
                        </div>
                        {{-- FORM --}}
                        <form role="form" action="{{ Route('be.order.editPost', $o->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="id">Id</label>
                                    <input type="text" class="form-control" id="id" name="id" value="{{ $o->id }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <div>
                                        <label class="radio-inline px-2"><input type="radio" name="status" value="pending" {{ $o->status == 'pending' ? 'checked' : '' }}>Pending</label>
                                        <label class="radio-inline px-2"><input type="radio" name="status" value="processing" {{ $o->status == 'processing' ? 'checked' : '' }}>Processing</label>
                                        <label class="radio-inline px-2"><input type="radio" name="status" value="delivered" {{ $o->status == 'delivered' ? 'checked' : '' }}>Delivered</label>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </div>
                            </div>
                        </form>
                        {{-- END FORM --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
