<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" href="{{asset('css/expired_page.css')}}">
</head>
<body>
    <div class="main">
        <section class="signup setup_ps">
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form">
                        <h2 class="form-title">{{trans('auth.'.$portValidate->status)}}</h2>
                        <div class="contain_dummy">
                            @if($portValidate->status == 'suspend')
                            <p>{{trans('auth.YOUR_PORTAL_SUSPEND')}}</p>
                            @else
                            <p>{{trans('auth.YOUR_PORTAL_EXPIRED')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="button" name="submit" id="submit" class="form-submit" value="Let's Go"/>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>
</html>