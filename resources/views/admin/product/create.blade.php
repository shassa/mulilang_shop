@extends('layouts.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.vendors')}}"> التجار </a>
                                </li>
                                <li class="breadcrumb-item active">إضافة منتج جديد
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">إضافة منتج جديد </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{route('products.store')}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات  المنتج </h4>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">صورة المنتج </label>

                                                            <input type="file"
                                                                   name="photo"/>

                                                            @error('photo')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                @if(activelang()->count() > 0)
                                                @foreach(activelang() as $index => $product)
                                                 <div class="row">
                                                     <div class="col-md-6">
                                                         <div class="form-group">
                                                             <label for="projectinput1"> اسم المنتج {{__('messages.'.$product->abbr)}} </label>
                                                             <input type="text" value=""
                                                                    class="form-control"
                                                                    placeholder="ادخل اسم المنتج  "
                                                                    name="product[{{$index}}][name]">
                                                             @error("product.$index.name")
                                                             <span class="text-danger">{{$message}}</span>
                                                             @enderror
                                                         </div>
                                                     </div>

                                                     <div class="col-md-6">
                                                         <div class="form-group">
                                                             <label for="projectinput1"> أختصار اللغة </label>
                                                             <input type="text" value=""
                                                                    class="form-control"
                                                                    placeholder="ادخل أختصار اللغة  "
                                                                    name="product[{{$index}}][abbr]">
                                                             @error("product.$index.abbr")
                                                             <span class="text-danger">{{$message}} </span>
                                                             @enderror
                                                         </div>
                                                     </div>
                                                 </div>

                                                 <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> سعر المنتج </label>
                                                            <input type="text" value=""
                                                                   class="form-control"
                                                                   placeholder="ادخل سعر المنتج  "
                                                                   name="product[{{$index}}][price]">
                                                            @error("product.$index.price")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2"> أختر الماركة </label>
                                                            <select name="product[{{$index}}][brand_id]" class="select2 form-control">
                                                                <optgroup label="من فضلك أختر الماركة ">
                                                                    @if($brands && $brands -> count() > 0)
                                                                        @foreach($brands->where('translation_lang',$product->abbr) as $brand)
                                                                            <option
                                                                                value="{{$brand -> id }}">{{$brand -> name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>

                                                            @error("product[{{$index}}][brand_id]")
                                                            <span class="text-danger">{{$message}} </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                 @endforeach
                                                 @endif
                                                 <div><h1>اضافه المنتج الى متجر</h1></div>
                                                 <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> كمية المنتج </label>
                                                            <input type="text" value=""
                                                                   class="form-control"
                                                                   placeholder="ادخل كميه المنتج  "
                                                                   name="quantity">
                                                            @error("quantity")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2"> أختر المتجر </label>
                                                            <select name="store_id" class="select2 form-control">
                                                                <optgroup label="من فضلك أختر المخزن ">
                                                                    @if($stores && $stores -> count() > 0)
                                                                        @foreach($stores as $store)
                                                                            <option
                                                                                value="{{$store -> id }}">{{$store -> name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>

                                                            @error("store_id")
                                                            <span class="text-danger">{{$message}} </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> حفظ
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@endsection

