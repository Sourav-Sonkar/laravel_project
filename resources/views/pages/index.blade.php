<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <title>{{config('app.name','ATG Project')}}</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
    </head>
    <body>
        @include('navbar')
        <hr>
        <div class="container">
            @include('message')
            <form id="contact_us" method="post" action="javascript:void(0)">
                <div class="alert" id="msg_div">
                      <span id="res_message"></span>
                 </div>
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="Name" placeholder="name">
                <span class="text-danger">{{ $errors->first('name') }}</span>
              </div>
              <div class="form-group">
                <label for="email">Email Id</label>
                <input type="email" name="email" required class="form-control" id="email" placeholder="email@abc.com">
                <span class="text-danger">{{ $errors->first('email') }}</span>
              </div>      
              <div class="form-group">
                <label for="pincode">Pin Code</label>
                <input type="text" required name="pincode" class="form-control" id="phone" placeholder="eg.133001" maxlength="6">
                <span class="text-danger">{{ $errors->first('phone') }}</span>
              </div>
              <div class="form-group">
               <button type="submit" id="send_form" class="btn btn-success">Submit</button>
              </div>
            </form>
        </div>
        <script>
          $(document).ready(function(){
$('#send_form').click(function(e){
   e.preventDefault();
   $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
   $('#send_form').html('Sending...');
   $.ajax({
      url: "{{ url('api/store')}}",
      method: 'post',
      data: $('#contact_us').serialize(),
      success: function(result){
          $('#send_form').html('Submit');
          if(result.status){
              $('#res_message').html(result.mess);
              $('#msg_div').removeClass('alert-danger');
              $('#msg_div').addClass('alert-success');
              $('#msg_div').show();
              $('#res_message').show();
          }else{
              $('#res_message').html(result.mess);
              $('#msg_div').removeClass('alert-success');
              $('#msg_div').addClass('alert-danger');
              $('#msg_div').show();
              $('#res_message').show();
          }

         /* document.getElementById("contact_us").reset(); 
          setTimeout(function(){
          $('#res_message').hide();
          $('#msg_div').hide();
          },1500);*/
        
      }});
   });
});
//-----------------

   
        </script>
        </body>
</html>
