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
                                <li class="breadcrumb-item active"> تعديل مركة
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
                                    <h4 class="card-title" id="basic-layout-form"> {{$brand->name}}  </h4>
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
                                        <form class="form" action="{{route('brands.update',$brand->id)}}" method="POST"
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
                                                                   <input type="hidden" value="{{$brand->id}}" name="id">

                                                          <img src="{{$brand->photo}}" style="width: 300px">
                                                            <input type="file"
                                                                   name="photo" value="{{$brand->photo}}"/>

                                                            @error('photo')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اسم المنتج {{__('messages.'.$brand->translation_lang)}} </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   name="brand[0][name]"
                                                                   value="{{$brand->name}}"
                                                                   >
                                                            @error("brand.0.name")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="hidden" id="name"
                                                                   class="form-control"
                                                                   name="brand[0][abbr]"
                                                                   value="{{$brand->translation_lang}}"
                                                                   >
                                                            @error("brand.0.abbr")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2"> أختر التاجر </label>
                                                            <select name="brand[0][vendor_id]" class="select2 form-control">
                                                                <optgroup label="من فضلك أختر التاجر ">
                                                                    @if($vendors && $vendors -> count() > 0)
                                                                        @foreach($vendors as $vendor)
                                                                            <option
                                                                                value="{{$vendor -> id }}">{{$vendor -> name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>

                                                            @error("brand[0][vendor_id]")
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
                                    @isset($brand->brands)
                                       @foreach ($brand->brands as $index => $translate)
                                        <li class="nav-item @if($index==0) active @endif">
                                          <a class="nav-link" id="base-tab11" data-toggle="tab" aria-controls="tab11"
                                          href="#tab11{{$index}}" aria-expanded="true">{{$translate->translation_lang}}</a>
                                        </li>
                                        @endforeach
                                        @endisset
                                      </ul>
                                      <div class="tab-content px-1 pt-1">
                                        @isset($brand->brands)
                                        @foreach ($brand->brands as $index => $translate)
                                        <div role="tabpanel" class="tab-pane @if($index==0) active @endif" id="tab11{{$index}}" aria-expanded="true" aria-labelledby="base-tab11">
                                            <form class="form" action="{{route('brands.update',$translate->id)}}" method="POST"
                                                enctype="multipart/form-data">
                                              @csrf
                                            @method('PATCH')
                                              <div class="form-body">
                                                  <h4 class="form-section"><i class="ft-home"></i> بيانات  الماركة </h4>
                                                  <div class="row">
                                                      <div class="col-md-6">
                                                          <div class="form-group">
                                                              <label for="projectinput1"> اسم الماركة {{__('messages.'.$translate->translation_lang)}} </label>
                                                              <input type="text" id="name"
                                                                     class="form-control"
                                                                     name="brand[0][name]"
                                                                     value="{{$translate->name}}"
                                                                     >
                                                              @error("brand.0.name")
                                                              <span class="text-danger">{{$message}}</span>
                                                              @enderror
                                                          </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                          <div class="form-group">
                                                              <input type="hidden" id="name"
                                                                     class="form-control"
                                                                     name="brand[0][abbr]"
                                                                     value="{{$translate->translation_lang}}"
                                                                     >
                                                              @error("brand.0.name")
                                                              <span class="text-danger">{{$message}}</span>
                                                              @enderror
                                                          </div>
                                                      </div>

                                                  </div>

                                                  <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2"> أخترالتاجر </label>
                                                            <select name="brand[{{$index}}][vendor_id]" class="select2 form-control">
                                                                <optgroup label="من فضلك أختر التاجر ">
                                                                    @if($vendors && $vendors -> count() > 0)
                                                                        @foreach($vendors as $vendor)
                                                                            <option
                                                                                value="{{$vendor -> id }}">{{$vendor -> name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>

                                                            @error("brand[{{$index}}][vendor_id]")
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
