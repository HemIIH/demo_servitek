<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name.')}}</title>
    <link rel="stylesheet" href="{{asset('css/expired_page.css')}}">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.js"></script> 
</head>
<body>
    <div class="main">
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="password-setup" class="signup-form" action="{{route('setup-password')}}">
                        {{ csrf_field() }}
                        <h2 class="form-title">{{trans('admin.LBL_SET_PASSWORD')}}</h2>
                        <div class="form-group ">
                            <label class="control-label text-right col-md-3">{{trans('admin.LBL_Password')}}</label>
                            <input type="password" name="password" id="password"  class="form-control" placeholder="">
                        </div>
                        <div class="form-group ">
                            <label class="control-label text-right col-md-3">{{trans('admin.LBL_Confirm_password')}}</label>
                            <input type="password" name="confirm_password" id="confirm_password"  class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-submit">{{trans('admin.Update')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>
<script type="text/javascript">
    $(function() {
          $("#password-setup").validate({
            rules: {
                password: {
                    required: true,
                    minlength:6

                },
                confirm_password:{
                    required:true,
                    equalTo: "#password",

                },
            },
            messages: {
                password: {
                    required: "{{trans('admin.LBL_password_required') }}",
                    minlength: "{{trans('admin.LBL_password_min_6') }}",
                },
                confirm_password:{
                    required: "{{trans('admin.LBL_confirm_password_required') }}",
                    equalTo: "{{trans('admin.LBL_confirm_password_not_valid') }}",
                }
             },

            errorPlacement: function(error, element) {
              error.insertAfter(element);
            },
            submitHandler: function(form) {
                form.submit();
            }
          });
        });
</script>
</html>