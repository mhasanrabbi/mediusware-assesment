@extends('layouts.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Products</h1>
</div>


<div class="card">
    <form action="/filter" method="GET" class="card-header">
        <div class="form-row justify-content-between">
            <div class="col-md-2">
                <input type="text" value="{{ request()->input('title', old('title')) }}" name="title" placeholder="Product Title" class="form-control">
            </div>
            <div class="col-md-2">

                <select name="variant" id="" class="form-control">
                    {{-- {{dd($item->variant_id)}} --}}
                    <option value="" >--- Select A Variant ---</option>
                    @foreach($productVariants as $item)

                    <optgroup label="{{$item->variants->title}}" >
                        <option value="{{$item->variant}}"> {{  $item->variant }}</option>
                    </optgroup>

                    @endforeach
                    {{-- @foreach ($variants as $type)
                        <optgroup label="{{$type->title}}">
                            @foreach ($productVariants as $product)
                            <option value="{{$product->variant_id}}">{{$product->variant}}</option>
                            @endforeach
                        </optgroup>
                    @endforeach --}}
                </select>
            </div>

            <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Price Range</span>
                    </div>
                    <input type="text" name="price_from" aria-label="First name" placeholder="From"
                        class="form-control">
                    <input type="text" name="price_to" aria-label="Last name" placeholder="To" class="form-control">
                </div>
            </div>
            <div class="col-md-2">
                <input type="date" name="date" placeholder="Date" class="form-control">
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary float-right"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>

    <div class="card-body">
        <div class="table-response">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Variant</th>
                        <th width="150px">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $product)

                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{ $product->title }} <br> Created at : {{$product->created_at}}</td>
                        <td>{{Str::words($product->description, 10) }}</td>
                        <td>

                            {{-- {{dd($price)}} --}}
                            <dl class="row mb-0" style="height: 80px; overflow: hidden" id="variant">
                                @foreach($product->product_variant_prices as $price)

                                <dt class="col-sm-3 pb-0">
                                    @if(!empty($price->productVariantThree))
                                    {{strtoupper($price->productVariantTwo->variant) ?? ""}} /
                                    {{ucfirst($price->productVariantOne->variant) ?? ""}} /
                                    {{$price->productVariantThree->variant ?? ""}}
                                    @elseif(!empty($price->productVariantTwo))
                                    {{strtoupper($price->productVariantTwo->variant) ?? ""}} /
                                    {{ucfirst($price->productVariantOne->variant) ?? ""}}
                                    @elseif(!empty($price->productVariantOne))
                                    {{ucfirst($price->productVariantOne->variant) ?? ""}}
                                    @else
                                    No Data Available
                                    @endif
                                </dt>
                                <dd class="col-sm-9">
                                    <dl class="row mb-0">
                                        <dt class="col-sm-4 pb-0">Price : {{ number_format($price->price,2) }}</dt>
                                        <dd class="col-sm-8 pb-0">InStock : {{ number_format($price->stock,2) }}</dd>
                                    </dl>
                                </dd>
                                @endforeach
                            </dl>

                            <button onclick="$('#variant').toggleClass('h-auto')" class="btn btn-sm btn-link">Show
                                more</button>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('product.edit', 1) }}" class="btn btn-success">Edit</a>
                            </div>
                        </td>
                    </tr>

                    @endforeach

                </tbody>

            </table>
        </div>

    </div>

    <div class="card-footer">
        <div class="row justify-content-between">
            <div class="col-md-6">
                <p>
                    Showing {{($products->currentpage()-1)*$products->perpage()+1}} to
                    {{$products->currentpage()*$products->perpage()}}
                    of {{$products->total()}}
                </p>
            </div>
            <div class="col-md-2">
                {{$products->links()}}
            </div>
        </div>
    </div>
</div>

@endsection
