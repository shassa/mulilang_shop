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
                                <li class="breadcrumb-item"><a href="{{route('admin.sub_categories')}}"> الاقسام </a>
                                </li>
                                <li class="breadcrumb-item active"> تعديل قسم
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
                                    <h4 class="card-title" id="basic-layout-form"> {{$category->name}}  </h4>
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
                                        <form class="form" action="{{route('admin.sub_categories.update',$category->id)}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات  القسم </h4>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">صورة القسم </label>
                                                                   <input type="hidden" value="{{$category->id}}" name="id">

                                                          <img src="{{$category->photo}}" style="width: 300px">
                                                            <input type="file"
                                                                   name="photo" value="{{$category->photo}}"/>

                                                            @error('photo')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اسم القسم {{__('messages.'.$category->translation_lang)}} </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   name="category[0][name]"
                                                                   value="{{$category->name}}"
                                                                   >
                                                            @error("category.0.name")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="hidden" id="name"
                                                                   class="form-control"
                                                                   name="category[0][abbr]"
                                                                   value="{{$category->translation_lang}}"
                                                                   >
                                                            @error("category.0.name")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"
                                                                   name="category[0][active]"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                   @if($category->active)checked @endif/>
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">الحالة </label>

                                                            @error('active')
                                                            <span class="text-danger">{{$message}}</span>
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
                                    @isset($category->subCategories)
                                       @foreach ($category->subCategories as $index => $translate)
                                        <li class="nav-item @if($index==0) active @endif">
                                          <a class="nav-link" id="base-tab11" data-toggle="tab" aria-controls="tab11"
                                          href="#tab11{{$index}}" aria-expanded="true">{{$translate->translation_lang}}</a>
                                        </li>
                                        @endforeach
                                        @endisset
                                      </ul>
                                      <div class="tab-content px-1 pt-1">
                                        @isset($category->subCategories)
                                        @foreach ($category->subCategories as $index => $translate)
                                        <div role="tabpanel" class="tab-pane @if($index==0) active @endif" id="tab11{{$index}}" aria-expanded="true" aria-labelledby="base-tab11">
                                            <form class="form" action="{{route('admin.sub_categories.update',$translate->id)}}" method="POST"
                                                enctype="multipart/form-data">
                                              @csrf

                                              <div class="form-body">
                                                  <h4 class="form-section"><i class="ft-home"></i> بيانات  القسم </h4>
                                                  <div class="row">
                                                      <div class="col-md-6">
                                                          <div class="form-group">
                                                              <label for="projectinput1"> اسم القسم {{__('messages.'.$translate->translation_lang)}} </label>
                                                              <input type="text" id="name"
                                                                     class="form-control"
                                                                     name="category[0][name]"
                                                                     value="{{$translate->name}}"
                                                                     >
                                                              @error("category.0.name")
                                                              <span class="text-danger">{{$message}}</span>
                                                              @enderror
                                                          </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                          <div class="form-group">
                                                              <input type="hidden" id="name"
                                                                     class="form-control"
                                                                     name="category[0][abbr]"
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
                                                          <div class="form-group mt-1">
                                                              <input type="checkbox"
                                                                     name="category[0][active]"
                                                                     id="switcheryColor4"
                                                                     class="switchery" data-color="success"
                                                                     @if($translate->active)checked @endif/>
                                                              <label for="switcheryColor4"
                                                                     class="card-title ml-1">الحالة </label>

                                                              @error('active')
                                                              <span class="text-danger">{{$message}}</span>
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


