@extends('admin.layout.app')

@section ('content')
<div class="row">
  
<div class="col-md-3"></div>
		 <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> {{ __('messages.rewards')}}</h4>
                  <!-- <p class="card-description">
                    Basic form elements
                  </p> -->
                  <form class="forms-sample" action="{{route('rewardupate')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                     @if (count($errors) > 0)
                    @if($errors->any())
                   <div class="alert alert-primary" role="alert">
                  <strong>SUCCESS : </strong>{{$errors->first()}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                  </div>
                  @endif
                 @endif
                    <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Oder Cart Value')}}</label>
                      <input type="hidden" name="reward_id"  value="{{$reward->reward_id}}">
                      <input type="text" class="form-control" name="min_cart_value"  value="{{$reward->min_cart_value}}"  id="exampleInputName1" placeholder="Minimum Cart Value">
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputName1">{{ __('messages.Reward Points')}}</label>
                      <input type="text" class="form-control" name="reward_points"value="{{$reward->reward_point}}"  id="exampleInputName1" placeholder="Rewards Points">
                    </div>
                  
                  
                    <button type="submit" class="btn btn-success mr-2">{{ __('messages.Update')}}</button>
                   
                  </form>
                </div>
              </div>
            </div>
  <div class="col-md-3"></div>

</div>
</div>
@endsection