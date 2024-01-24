@extends('backend.index')
@section('content')
<style>
    .note{
        font-size: 11px;
        color: #010101;
    }
    .eForm-control::placeholder{
        color: #797c8b;
    }
    .eRight{
        gap: 5px;
    }
    .eRight button{
        background: none;
        height: 25px;
        width: 25px;
        line-height: 25px;
        border: 1px solid #010101;
        color: #010101;
        border-radius: 5px;
    }
    .eRight button svg {
        height: 14px;
        margin-top: -4px;
    }
    .eRight button svg path{
        fill: #010101;

    }
    .eLayout {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #6633991c;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 5px;
    }
    .eLayout h4{
        font-size: 14px;
        color: #010101;
        text-transform: capitalize
    }
    .eLeft.e {
        max-width: 220px;
        width: 100%;
    }
    .eLayout .eLeft{
        align-items: center;
    }
    .eLayout .eLeft i{
        color: #010101;
        margin-right: 10px;
    }
    .notes {
        font-size: 12px;
        color: #010101;
        background: #797c8b30;
        border-radius: 5px;
        padding: 2px 13px;
    }
    .eAttribute{
        font-size: 20px;
        font-weight: 500;
        color: #181c32;
        margin-bottom: 10px; 
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }
    .gl{
        width: 100px;
    }
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/backend/vendors/mortgage/jquery-ui.css') }}"/>
 <!-- Mani section header and breadcrumb -->
<div class="mainSection-title">
    <div class="row">
      <div class="col-12">
        <div class="d-flex justify-content-between align-items-center flex-wrap gr-15">
          <div class="d-flex flex-column">
            <h4>{{ get_phrase('Mortgage Settings') }}</h4>
            <ul class="d-flex align-items-center eBreadcrumb-2">
              <li><a href="#">{{ get_phrase('Home') }}</a></li>
              <li><a href="#"> {{ get_phrase('Mortgage Settings') }}</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-7">
        <div class="eSection-wrap">
            <div class="eMain">
                @if(count($allmortgage))
                <h4 class="eAttribute">{{get_phrase('Attribute List:')}}</h4>
                <div class="row">
                    <div class="col-md-12 pb-3">
                        <form class="ajaxFormSubmission" id="ajaxFormSubmission" action="{{route('admin.section_sort_update')}}">
                            <div class="eForm-layouts  section-list" id="sortable">
                                @foreach($allmortgage as $mortgage)
                               <div class="eLayout draggable-item">
                                    <div class="eLeft d-flex e">
                                        <i class="bi bi-arrows-move"></i>
                                        <h4>{{$mortgage->title}}</h4>
                                    </div>
                                    <div class="eLeft d-flex gl">
                                        <h4>{{$mortgage->attribute_type}}</h4>
                                    </div>
                                    <div class="eLeft">
                                        <h4>{{$mortgage->conditions}}</h4>
                                    </div>
                                    <div class="eRight d-flex">
                                        <button type="button"  onclick="rightModal('{{ route('admin.mortgage_edit', ['id' => $mortgage->id]) }}','{{get_phrase('Edit Mortgage')}}') " >
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path opacity="1" fill="#1E3050" d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                                        </button>
                                        <button type="button" onclick="confirmModal('{{ route('admin.mortgage.delete', ['id' => $mortgage->id]) }}', 'undefined');">
                                            <svg width="14" height="17" viewBox="0 0 14 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.32812 1.71328L4.73438 2.65625H9.26562L8.67188 1.71328C8.625 1.64023 8.54688 1.59375 8.4625 1.59375H5.53438C5.45 1.59375 5.37187 1.63691 5.325 1.71328H5.32812ZM9.92188 0.830078L11.0688 2.65625H11.5H13H13.25C13.6656 2.65625 14 3.01152 14 3.45312C14 3.89473 13.6656 4.25 13.25 4.25H13V14.3438C13 15.8113 11.8812 17 10.5 17H3.5C2.11875 17 1 15.8113 1 14.3438V4.25H0.75C0.334375 4.25 0 3.89473 0 3.45312C0 3.01152 0.334375 2.65625 0.75 2.65625H1H2.5H2.93125L4.07812 0.826758C4.40312 0.312109 4.95 0 5.53438 0H8.4625C9.04688 0 9.59375 0.312109 9.91875 0.826758L9.92188 0.830078ZM2.5 4.25V14.3438C2.5 14.9314 2.94687 15.4062 3.5 15.4062H10.5C11.0531 15.4062 11.5 14.9314 11.5 14.3438V4.25H2.5ZM5 6.375V13.2812C5 13.5734 4.775 13.8125 4.5 13.8125C4.225 13.8125 4 13.5734 4 13.2812V6.375C4 6.08281 4.225 5.84375 4.5 5.84375C4.775 5.84375 5 6.08281 5 6.375ZM7.5 6.375V13.2812C7.5 13.5734 7.275 13.8125 7 13.8125C6.725 13.8125 6.5 13.5734 6.5 13.2812V6.375C6.5 6.08281 6.725 5.84375 7 5.84375C7.275 5.84375 7.5 6.08281 7.5 6.375ZM10 6.375V13.2812C10 13.5734 9.775 13.8125 9.5 13.8125C9.225 13.8125 9 13.5734 9 13.2812V6.375C9 6.08281 9.225 5.84375 9.5 5.84375C9.775 5.84375 10 6.08281 10 6.375Z" fill="#797C8B"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <input type="hidden" name="mort{{$mortgage->id}}" value="{{$mortgage->id}}">
                               </div>
                               @endforeach
                            </div>
                        </form>
                        @if(count($allmortgage))
                        <p class="notes">{{get_phrase('You can re-order the attribute by dragging and dropping each of the attributes!')}}</p>
                       @endif
                    </div>
                </div>
                @else
                <p class="text-center">{{get_phrase('No Data Here!')}}</p>
               @endif
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="eSection-wrap">
            <div class="eMain">
                <h4 class="eAttribute">{{get_phrase('Create Attribute:')}}</h4>
                <div class="row">
                    <div class="col-md-11 pb-3">
                        <div class="eForm-layouts">
                            <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{route('admin.mortgage_add')}}">
                                @csrf 
                                <div class="fpb-7">
                                    <label for="title" class="eForm-label">{{ get_phrase('Title') }}</label>
                                    <input type="text" class="form-control eForm-control" id="title" placeholder="Type your title" name ="title" required>
                                </div>
                               <div class="fpb-7">
                                    <label for="attribute_type" class="eForm-label">{{ get_phrase('Attribute Type') }}</label>
                                    <select  id="attribute_type" name="attribute_type" class="form-select eForm-select eChoice-multiple-with-remove"  required>
                                        <option value="flat">{{get_phrase('Flat')}}</option>
                                        <option value="percentage">{{get_phrase('Percentage')}}</option>
                                    </select>
                               </div>
                               <div class="fpb-7">
                                    <label for="Condition" class="eForm-label">{{ get_phrase('Condition') }}</label>
                                    <select name="conditions"  id="" class="form-select eForm-select eChoice-multiple-with-remove"  required>
                                        <option value="+">{{get_phrase('Plus(+)')}}</option>
                                        <option value="-">{{get_phrase('Minus(-)')}}</option>
                                    </select>
                                    <p class="note">{{get_phrase('This condition apply in main price!')}}</p>
                               </div>
                               <button type="submit" class="eBtn btn-primary mt-3">{{get_phrase('Save')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<script  src="{{ asset('public/assets/backend/vendors/mortgage/jquery-ui.js') }}"></script>
<script>
   

    $(document).ready(function(){
				setTimeout(function(){
					$("#sortable").sortable({
						update: function(event, ui) {
							$("#ajaxFormSubmission").submit();
						}
					});
				}, 1000);
			});

 </script>

@endsection
