@if(count($errors)>0)  
	@foreach($errors->all() as $value)  
    	<div class="row cl">
       		<label class="form-label col-xs-4 col-sm-3"></label>
        	<div class="formControls col-xs-5 col-sm-5" style="color: red">
		 		 {{$value}}  
       	 	</div>
       	</div>
	 @endforeach  
@endif 
