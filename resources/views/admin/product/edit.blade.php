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
                                <li class="breadcrumb-item"><a href="{{route('admin.main_categories')}}"> الاقسام </a>
                                </li>
                                <li class="breadcrumb-item active"> تعديل منتج
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
                                    <h4 class="card-title" id="basic-layout-form"> {{$product->name}}  </h4>
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
                                        <form class="form" action="{{route('products.update',$product->id)}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')

                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات  المنتج </h4>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">صورة المنتج </label>
                                                                   <input type="hidden" value="{{$product->id}}" name="id">

                                                          <img src="{{$product->photo}}" style="width: 300px">
                                                            <input type="file"
                                                                   name="photo" value="{{$product->photo}}"/>

                                                            @error('photo')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اسم المنتج {{__('messages.'.$product->translation_lang)}} </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   name="product[0][name]"
                                                                   value="{{$product->name}}"
                                                                   >
                                                            @error("product.0.name")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="hidden" id="name"
                                                                   class="form-control"
                                                                   name="product[0][abbr]"
                                                                   value="{{$product->translation_lang}}"
                                                                   >
                                                            @error("product.0.abbr")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> سعر المنتج</label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   name="product[0][price]"
                                                                   value="{{$product->price}}"
                                                                   >
                                                            @error("category.0.price")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2"> أختر الماركة </label>
                                                            <select name="product[0][brand_id]" class="select2 form-control">
                                                                <optgroup label="من فضلك أختر الماركة ">
                                                                    @if($brands && $brands -> count() > 0)
                                                                        @foreach($brands->where('translation_lang',$product->translation_lang) as $brand)
                                                                            <option
                                                                                value="{{$brand -> id }}">{{$brand -> name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>

                                                            @error("product[0][brand_id]")
                                                            <span class="text-danger">{{$message}} </span>
                                                            @enderror
                                                        </div>
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
                                    <ul class="nav nav-tabs nav-top-border no-hover-bg">
                                    @isset($product->products)
                                       @foreach ($product->products as $index => $translate)
                                        <li class="nav-item @if($index==0) active @endif">
                                          <a class="nav-link" id="base-tab11" data-toggle="tab" aria-controls="tab11"
                                          href="#tab11{{$index}}" aria-expanded="true">{{$translate->translation_lang}}</a>
                                        </li>
                                        @endforeach
                                        @endisset
                                      </ul>
                                      <div class="tab-content px-1 pt-1">
                                        @isset($product->products)
                                        @foreach ($product->products as $index => $translate)
                                        <div role="tabpanel" class="tab-pane @if($index==0) active @endif" id="tab11{{$index}}" aria-expanded="true" aria-labelledby="base-tab11">
                                            <form class="form" action="{{route('products.update',$translate->id)}}" method="POST"
                                                enctype="multipart/form-data">
                                              @csrf
                                            @method('PATCH')
                                              <div class="form-body">
                                                  <h4 class="form-section"><i class="ft-home"></i> بيانات  المنتج </h4>
                                                  <div class="row">
                                                      <div class="col-md-6">
                                                          <div class="form-group">
                                                              <label for="projectinput1"> اسم المنتج {{__('messages.'.$translate->translation_lang)}} </label>
                                                              <input type="text" id="name"
                                                                     class="form-control"
                                                                     name="product[0][name]"
                                                                     value="{{$translate->name}}"
                                                                     >
                                                              @error("product.0.name")
                                                              <span class="text-danger">{{$message}}</span>
                                                              @enderror
                                                          </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                          <div class="form-group">
                                                              <input type="hidden" id="name"
                                                                     class="form-control"
                                                                     name="product[0][abbr]"
                                                                     value="{{$translate->translation_lang}}"
                                                                     >
                                                              @error("category.0.name")
                                                              <span class="text-danger">{{$message}}</span>
                                                              @enderror
                                                          </div>
                                                      </div>

                                                  </div>

                                                  <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> سعر المنتج</label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   name="product[0][price]"
                                                                   value="{{$product->price}}"
                                                                   >
                                                            @error("category.0.price")
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
                                                                        @foreach($brands->where('translation_lang',$translate->translation_lang) as $brand)
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

                                      @endforeach
                                      @endisset

                                            @if($product->stores()->count()>0)
                                            <div><h1>تعديل المنتج فى متجر</h1></div>
                                        <form class="form" action="{{route('products.store.update',$product->id)}}" method="POST">
                                                @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> كمية المنتج </label>
                                                        <input type="text" value=""
                                                                class="form-control"
                                                                placeholder={{$product->stores[0]->pivot->quantity}}
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

                                    </form>

                                    </div>
                                    <br>
                                    <br>
                                    @endif

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
