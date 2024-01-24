<style>
        .nice-select .list {
	  width: 100% !important;
   }
    .nice-select {
        width: 100% !important;
    }
    .nice-select:after {
       display: none;
    }
    .nice-select {
	  line-height: 30px;
   }
   .nice-select .option {
	 line-height: 33px;
	 min-height: 27px;
	 font-size: 14px;
   }
   .nice-select .option.selected {
	 font-weight: 500;
   }
</style>


<div class="eForm-layouts">
    <form method="POST" enctype="multipart/form-data" class="d-block ajaxForm" action="{{route('admin.mortgage_update',['id' => $mortgage->id])}}">
        @csrf
        <input type="hidden" name="id" value="{{ $mortgage->id }}">

        <div class="form-row">
            <div class="fpb-7">
                <label for="title" class="eForm-label">{{ get_phrase('Title') }}</label>
                <input type="text" class="form-control eForm-control" id="title" value="{{$mortgage->title}}" name ="title" required>
            </div>
            <div class="fpb-7">
                <label for="attribute_type" class="eForm-label">{{ get_phrase('Attribute Type') }}</label>
                <select id="attribute_type" name="attribute_type" class="form-select js-select23" required>
                    <option value="flat" @if($mortgage->attribute_type == 'flat') {{ 'selected' }} @endif>{{ get_phrase('Flat') }}</option>
                    <option value="percentage" @if($mortgage->attribute_type == 'percentage') {{ 'selected' }} @endif>{{ get_phrase('Percentage') }}</option>
                </select>
            </div>
            
           <div class="fpb-7">
                <label for="Condition" class="eForm-label">{{ get_phrase('Condition') }}</label>
                <select name="conditions"  id="" class="form-select js-select23"  required>
                    <option value="+" @if($mortgage->conditions == '+') {{ 'selected' }} @endif>{{get_phrase('Plus(+)')}}</option>
                    <option value="-" @if($mortgage->conditions == '-') {{ 'selected' }} @endif>{{get_phrase('Minus(-)')}}</option>
                </select>
           </div>
            <div class="fpb-7  pt-2">
                <button class="btn-form mt-3" type="submit">{{ get_phrase('update') }}</button>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">

    "use strict";
    $(document).ready(function() {
       $('.js-select23').niceSelect();
    });
</script>
