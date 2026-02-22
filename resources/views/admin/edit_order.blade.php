@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Products')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Edit Order</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Edit Product')}}</div>
            </div>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.product.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Products')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.order.update',$order->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                           
                            <div class="row">                        

                              
                              <div class="col-md-12">
                                <div class="row">
                                  <div class="col-md-4">
                                  <div class="form-group col-12">
                                    <label>Order Delivery Date <span class="text-danger">*</span></label>
                                    
                                    <select id="day" class="form-control select2" name="ordered_delivery_date" style="border: 1px solid #C1C1C1;width: 230px;height: 37px;border-radius: 5px;">
                                     <option value="{{ $order->ordered_delivery_date }}">{{ $order->ordered_delivery_date }}</option>
									</select>
                                    
                                    <script>
                                  let today = new Date(); // get Today date
                                    let dropDownMenu = document.getElementById('day');

                                    for(let i = 0; i < 6; i++){ // Looping through 7 next days
                                        let newDate = new Date()
                                        newDate.setDate(today.getDate() + i); 
                                        if(newDate.getDay() === 0){ 
                                            continue; // Eliminating the Sunday
                                        }
                                        else{ 
                                          let dayText = document.createTextNode(Intl.DateTimeFormat('en-US', {weekday: 'long', month: 'long', day: 'numeric'}).format(newDate)); // Formating the date the way you want before appending into option Element
                                          let dayOption = document.createElement('option')
                                          dayOption.append(dayText);
                                          dropDownMenu.append(dayOption);
                                        }
                                    }                                    
                                  </script>
                                    
                                </div>
                                  </div>
                                  
                                  <div class="col-md-4">
                                  <div class="form-group col-12">
                                    <label>Order Delivery Time <span class="text-danger">*</span></label>
                                    <select name="ordered_delivery_time" class="form-control select2" id="">
               <option {{ $order->ordered_delivery_time == "8:00 AM - 9:00 AM" ? 'selected' : '' }} value="8:00 AM - 9:00 AM">8:00 AM - 9:00 AM</option>
              <option {{ $order->ordered_delivery_time == "9:00 AM - 10:00 AM" ? 'selected' : '' }} value="9:00 AM - 10:00 AM">9:00 AM - 10:00 AM</option>
            <option {{ $order->ordered_delivery_time == "10:00 AM - 11:00 AM" ? 'selected' : '' }} value="10:00 AM - 11:00 AM">10:00 AM - 11:00 AM</option>
               <option {{ $order->ordered_delivery_time == "11:00 AM - 12:00 PM" ? 'selected' : '' }} value="11:00 AM - 12:00 PM">11:00 AM - 12:00 PM</option>
               <option {{ $order->ordered_delivery_time == "12:00 PM - 1:00 AM" ? 'selected' : '' }} value="12:00 PM - 1:00 AM">12:00 PM - 1:00 AM</option>
               <option {{ $order->ordered_delivery_time == "1:00 PM - 2:00 AM" ? 'selected' : '' }} value="1:00 PM - 2:00 AM">1:00 PM - 2:00 AM</option>
                                      
                <option {{ $order->ordered_delivery_time == "2:00 PM - 3:00 AM" ? 'selected' : '' }} value="2:00 PM - 3:00 AM">2:00 PM - 3:00 AM</option>
               <option {{ $order->ordered_delivery_time == "3:00 AM - 4:00 AM" ? 'selected' : '' }} value="3:00 AM - 4:00 AM">3:00 AM - 4:00 AM</option>
                 
                                      
              <option {{ $order->ordered_delivery_time == "4:00 AM - 5:00 AM" ? 'selected' : '' }} value="4:00 AM - 5:00 AM">4:00 AM - 5:00 AM</option>
               <option {{ $order->ordered_delivery_time == "5:00 AM - 6:00 AM" ? 'selected' : '' }} value="5:00 AM - 6:00 AM">5:00 AM - 6:00 AM</option>
                
                  <option {{ $order->ordered_delivery_time == "6:00 AM - 7:00 AM" ? 'selected' : '' }} value="6:00 AM - 7:00 AM">6:00 AM - 7:00 AM</option>
               <option {{ $order->ordered_delivery_time == "7:00 AM - 8:00 AM" ? 'selected' : '' }} value="7:00 AM - 8:00 AM">7:00 AM - 8:00 AM</option>
                
                                      
                                      <option {{ $order->ordered_delivery_time == "8:00 AM - 9:00 AM" ? 'selected' : '' }} value="8:00 AM - 9:00 AM">8:00 AM - 9:00 AM</option>
               <option {{ $order->ordered_delivery_time == "9:00 AM - 10:00 AM" ? 'selected' : '' }} value="9:00 AM - 10:00 AM">9:00 AM - 10:00 AM</option>
                <option {{ $order->ordered_delivery_time == "10:00 AM - 11:00 AM" ? 'selected' : '' }} value="10:00 AM - 11:00 AM">10:00 AM - 11:00 AM</option>
                                      
                                      
                                        </select>
                                    </div>
                                    
                                  </div>
                                  
                                  <div class="col-md-4">
                                  <div class="form-group col-12">
                                    <label>Order Status <span class="text-danger">*</span></label>                                    
                                    <select name="order_status" class="form-control select2" id="brand">
                                        <option {{ $order->order_status == 0 ? 'selected' : '' }} value="0">Pending</option>
                                      <option {{ $order->order_status == 1 ? 'selected' : '' }} value="1">Processing</option>
                                      <option {{ $order->order_status == 2 ? 'selected' : '' }} value="2">On The Way</option>
                                      <option {{ $order->order_status == 3 ? 'selected' : '' }} value="3">On Hold</option>
                                      <option {{ $order->order_status == 4 ? 'selected' : '' }} value="4">Complete</option>
                                      <option {{ $order->order_status == 5 ? 'selected' : '' }} value="5">Cancelled</option>
                                            
                                    </select>
                                </div>                                   
                                </div>                                    
                                  </div>                                
                                  
                                </div>
                              </div>
                          <div class="row">
                          <div class="col-md-12">
                            <div class="row">
                                                        
                                 
                              
                              
                              <div class="col-md-12">
                              
                              
                             
                              <table class="table table-centered table-nowrap mb-0" id="product_table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Image</th>
                                        <th>Product</th>                                      
                                        <th>Size</th>
                                        <th>Color</th>
                                        <th style="width: 120px;">Quantity</th>
                                        <th style="width: 150px;">Sell Price</th>
                                        <th style="width: 150px;">Discount</th>
                                        <th>Subtotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="data">
                                   <!-- @foreach($order->orderProducts as $products)-->
                                   <!--     <tr>-->
                                   <!--       <td> <img class="rounded-circle" src="{{ asset($products->product->thumb_image) }}" alt="" width="100px" height="100px"></td>-->
                                          	
                                   <!--         <td>{{ $products->product_name }}</td>-->
                                            
                                   <!--         <td>-->
                                   <!--             <input class="form-control quantity" name="quantity[]" type="number" value="{{ $products->qty }}" required min="1" data-qty="{{ $products->product->qty }}"/>-->
                                     			
                                   <!--             <input type="hidden" name="product_id[]" value="" required/>-->
                                   <!--             <input type="hidden" name="variation_id[]" value=""/>-->
                                   <!--             <input type="hidden" name="order_line_id[]" value=""/>-->
                                                
                                   <!--         </td>-->
                                   <!--       <td>-->
                                   <!--         <input type="number" class="unit_price" value="{{ $products->unit_price }}" />-->
                                   <!--       </td>-->

                                   <!--         <td class="row_total">{{$products->unit_price * $products->qty}}</td>-->
                                   <!--         <td><a class="remove btn btn-sm btn-danger"> <i class="fa fa-trash"></i></a></td>-->
                                   <!--     </tr> -->
                                   <!--@endforeach-->
                                    @foreach($order->orderProducts as $products)
                                        <tr>
                                          <td> <img class="rounded-circle" src="{{ asset('uploads/custom-images2/'.$products->product->thumb_image) }}" alt="" width="100px" height="100px"></td>
                                          	
                                            <td>{{ $products->product_name }}</td>
                                                
                                                <input type="hidden" class="variation" name="variation[]">
                                            <td>
                                                 @if($products->product->type != 'single')
                                                <select class="form-control variation_data" name="variation_data">
                                                    @foreach($products->product->variations ?? [] as $v)
                                                        <option value="{{ $v->size->id }}" {{ $v->size->title == $products->variation ? 'selected' : '' }}>
                                                            {{ $v->size->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @else
                                                {{ $products->variation }}
                                                @endif
                                            </td>

                                            <td>
                                                @if($products->product->type != 'single')
                                                <select class="form-control variation_color_id" name="variation_color_id[]">
                                                    @foreach($products->product->colorVariations ?? [] as $cvar)
                                                        <option value="{{ $cvar->color->name }}" {{ $cvar->color->name == $products->variation_color_id ? 'selected' : '' }}>
                                                            {{ $cvar->color->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @else
                                                {{ $products->variation_color_id }}
                                                @endif
                                            </td>
                                            
                                            <td>
                                                <input class="form-control quantity" name="quantity[]" type="number" value="{{ $products->qty }}" required min="1" data-qty="{{ $products->product->qty }}"/>
                                     			<input name="order_id[]" type="hidden" value="{{ $products->id }}">
                                                <input type="hidden" id="product_id" name="product_id[]" value="{{ $products->product_id }}" required/>
                                                <input type="hidden" name="variation_id[]" value=""/>
                                                <input type="hidden" name="order_product_id[]" value="{{ $products->id }}"/>
                                            </td>
                                          <td>
                                            <input type="number" class="form-control unit_price" id="unit_price" name="unit_price[]" value="{{ $products->unit_price }}" />
                                          </td>
                                          <td>
                                            <input type="number" class="form-control discount_price" name="discount_price[]" value="{{ $products->product->discount_price }}" />
                                          </td>
                                            <td class="row_total">{{$products->unit_price * $products->qty}}</td>
                                            <td><a class="remove btn btn-sm btn-danger"> <i class="fa fa-trash"></i></a></td>
                                        </tr> 
                                   @endforeach
                                  
                                  <tr style="border-top: 2px solid black;">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total Amount</td>
                                    <td><input type="text" class="total_amount" id="total_amount" value="" name="total_amount" disabled></td>
                                  </tr>
                                </tbody>
                            </table>
                              
                            
                              </div>
                              
                              
                              <div class="col-md-4">
                                <div class="form-group col-12">
                                    <label>Customer Name <span class="text-danger">*</span></label>
                                    <input type="text" id="short_name" class="form-control"  name="short_name" value="{{ $order->orderAddress->shipping_name }}">
                                </div>    
                            </div>
                              
                              <div class="col-md-4">
                                <div class="form-group col-12">
                                    <label>Customer Phone <span class="text-danger">*</span></label>
                                    <input type="text" id="shipping_phone" class="form-control"  name="shipping_phone" value="{{ $order->orderAddress->shipping_phone }}">
                                </div>    
                              </div>
                              
                              <div class="col-md-4">
                              <div class="form-group col-12">
                                    <label>Customer Address <span class="text-danger">*</span></label>
                                    <textarea name="shipping_address" id="" cols="30" rows="10" class="form-control text-area-test">{{ $order->orderAddress->shipping_address }}</textarea>
                                </div>                
                             
                              </div>
                              
                              <div class="col-md-4">
                              <div class="form-group col-12">
                                    <label>Shipping Method <span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="shipping_charge_id" id="shipping_charge">
                                        <option value="" data-charge="0">Select One</option>
                                        @foreach($shippings as $charge)
                                        <option value="{{ $charge->id }}" {{ $charge->shipping_rule==$order->shipping_method ?'selected':'' }} data-rule="{{ $charge->shipping_rule }}" data-charge="{{ $charge->shipping_fee }}"> {{ $charge->shipping_rule }} </option>
                                        @endforeach
                                    </select>
                                </div>
                              </div>
                              
                              
                              
                              <div class="col-md-4">
                               
                                  <div class="form-group col-12">
                                    <label  class="form-label"> Courier  </label>
                                    <select class="form-control" name="courier_id">
                                        <option value="" data-charge="0">Select One</option>
                                        @foreach($couriers as $courier)
                                        <option value="{{ $courier->id }}" {{ $courier->id==$order->courier_id ? 'selected' : '' }}> {{ $courier->name }} </option>
                                        @endforeach
                                    </select>
                                    </div>                               
                             
                              </div> 
                              
                              <div class="col-md-4">
                               
                                  <div class="form-group col-12">
                                <label  class="form-label">Courier Tracking ID</label>
                                <input type="text" class="form-control" value="{{ $order->courier_tracking_id}}" name="courier_tracking_id" />
                                    </div>                               
                             
                              </div>
                              
                              <div class="col-md-4">
                                <div class="form-group col-12">
                                    <label  class="form-label">Advance Amount</label>
                                    <input type="text" class="form-control" name="advance_amount" value="{{ $order->advance_amount }}" />
                                </div>                              
                             </div>
                             
                             <div class="col-md-4">
                               
                              <div class="form-group col-12">
                                    <label>Order Note</label>
                                    <textarea name="note" id="" cols="30" rows="10" class="form-control text-area-test">{{ $order->note }}</textarea>
                                </div>                 
                              </div>
                              
                             <div class="row for_redx {{ $order->courier_id != 1 ? 'd-none' : '' }}">
                             <h5 class="text-danger mt-3">These fields only for Redx Courier Service</h5>
                             <div class="col-md-3">
                                <label  class="form-label">Choose Area</label>
                             	<select class="form-control select2" id="area_select">
                                  <option value="">Select One</option>
                                  @foreach($areas as $key=>$area)
                                  <option value="{{ $area['id'] }}" {{ $order->area_id ==  $area['id'] ? 'selected' : '' }}>{{ $area['name'] }}</option>
                                  @endforeach
                                </select> 
                            </div>                            
                            <div class="col-md-3">
                                  <label  class="form-label">Area ID</label>
                                  <input type="text" readonly class="form-control" id="area_id" name="area_id" value="{{ $order->area_id}}"/>
                            </div>                          
                            <div class="col-md-3">
                                  <label  class="form-label">Area Name</label>
                                  <input type="text" readonly class="form-control" id="area_name" name="area_name" value="{{ $order->area_name}}"/>
                            </div>
                          </div>                           
                          <div class="row for_pathao {{ $order->courier_id != 2 ? 'd-none' : '' }}">
                            <h5 class="text-danger mt-3">These fields only for Pathao Courier Service</h5>                            
                            <div class="col-md-3">
                                <label  class="form-label">Choose City</label>
                             	<select class="form-control select2" id="city_select" name="city">
                                  <option value="">Select One</option>
                                  @foreach($cities as $key=>$city)
                                  <option value="{{ $city['city_id'] }}" {{ $order->city ==  $city['city_id'] ? 'selected' : '' }}>{{ $city['city_name'] }}</option>
                                  @endforeach
                                </select> 
                            </div>                           
                            <div class="col-md-3">
                                <label  class="form-label">Choose Zone</label>
                             	<select class="form-control select2" id="zone_select" name="state">
                                  <option value="{{ $order->state }}">Select One</option>
                                </select> 
                            </div>                         
                            <div class="col-md-3">
                                <label  class="form-label">Choose Area</label>
                             	<select class="form-control select2" name="area_id">
                                  <option value="{{ $order->area_id }}">Select One</option>
                                </select> 
                            </div>                                                     
                            <div class="col-md-3">
                                  <label  class="form-label">Item Weight</label>
                                  <input type="number" class="form-control" id="weight" step="0.5" min="0.5" max="10" name="weight" value="{{ $order->weight}}"/>
                            </div>
                          </div>
                        </div>
                            </div>
                          </div>
                          </div>
                                

                               
                                
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
  
  $(document).on('blur change',".quantity",function(e) {
        let current_stock=Number($(this).val());
        let stock = Number($(this).data('qty'));       
    
        if (current_stock>stock) {
            toastr.error('Product Stock Not Available');
            $(this).val(stock);
            calculateSum();
            return false;
        }
       
    });
    
    $(document).on('click', '.remove', function() {
        var delete_tr = $(this).closest('tr');
        delete_tr.remove();
        calculateSum();
    });
  
    $(document).on('blur',".quantity, .unit_price",function(e) {    
     calculateSum();    
    });
  
    $(document).on('change',"#shipping_method",function(e) {
        calculateSum();    
    });
  
  
    function calculateSum() {

        let tblrows = $("#product_table tbody tr");
        let sub_total=0;
        let row_discount=0;
        let shipping = $('#cost').val();
       // let shipping=Number(tblrows.find('td input.shipping_cost').val());
       // let shipping=Number($("#shipping_method option:selected").data('shipping'));        
        tblrows.each(function (index) {
            let tblrow = $(this);
            let qty=Number(tblrow.find('td input.quantity').val());
            let amount=Number(tblrow.find('td input.unit_price').val());
          //  let discount=Number(tblrow.find('td input.unit_discount').val());
            let row_total=Number(qty *amount);                    
            tblrow.find('td.row_total').text(row_total.toFixed(2));          
            sub_total = sub_total + row_total;              
           
            
        });
      
         
        sub_total+=shipping;
      
       // alert(Number(sub_total));
        

        $('input#total_amount').val(sub_total);
       // $('input#discount_amount').val(row_discount.toFixed(2));
       // $('input#shipping_charge').val(charge.toFixed(2));
    }
  
  
  
    $(function(){
         $(document).on('change', 'select[name="courier_id"]', function(e){
    	let courier_id = $(this).val();
    	if(courier_id == 1)
        {
          	$(document).find('div.for_redx').removeClass('d-none');
          	$(document).find('div.for_pathao').addClass('d-none');
        }    	
    	
    	else if(courier_id == 2)
        {
          	$(document).find('div.for_pathao').removeClass('d-none');
          	$(document).find('div.for_redx').addClass('d-none');
        }
    
    	else {
            $(document).find('div.for_pathao').addClass('d-none');
          	$(document).find('div.for_redx').addClass('d-none');
        }
  });
  
  $(document).on('change', '#city_select', function(e){
    let city = $(this).val();
    var url = "{{ route('admin.zonesByCity', ":city") }}";
	url = url.replace(':city', city);
    $.ajax({
        url,
        type: 'GET',
        dataType: "json",
        success: function(res){
          if(res.success)
          {
            let html = "<option value=''>Select One</option>";
            for(let i = 0; i < res.zones.length; i++)
            {
               html += "<option value='"+res.zones[i].zone_id+"' >"+res.zones[i].zone_name+"</option>";
            }
            
            $('#zone_select').html(html);
            
          }
        }
      
    });
    
  });
  
   $(document).on('change', '#zone_select', function(e){
    let zone = $(this).val();
    var url = "{{ route('admin.areasByZone', ":zone") }}";
	url = url.replace(':zone', zone);
    $.ajax({
        url,
        type: 'GET',
        dataType: "json",
        success: function(res){
          if(res.success)
          {
            let html = "<option value=''>Select One</option>";
            for(let j = 0; j < res.areas.length; j++)
            {
               html += "<option value='"+res.areas[j].area_id+"' >"+res.areas[j].area_name+"</option>";
            }
            
            $('select[name="area_id"]').html(html);
            
          }
        }
      
    });
    
  });
    });
</script>
@endsection
