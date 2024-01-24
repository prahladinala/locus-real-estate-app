<style>
  .no_data_pos{
      position: relative;
      top: 30px;
  }
  .no_data{
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column
  }
  .no_data img{
      height: 113px;
  }
  .property_data{
      text-align: center
  }
  .property_data h4 {
      font-size: 20px;
      line-height: 40px;
      margin-bottom: 10px;
      font-weight: 500;
      padding-bottom: 30px;
  }
  .property_data a{
      margin-top: 30px;
      font-size: 14px;
      padding:10px 14px;
      border-radius: 5px;
      background-color: #007BFF;
      color: #fff !important;
      display: inline-block;
  }
</style>
<div class="no_data_pos no_data">
  <img class="mb-3" src="{{ asset('public/assets/global/images/no_data_img.png') }}" />
  <div class="property_data">
      <h4>{{get_phrase('No Message Found!')}}</h4>
  </div>
</div>


