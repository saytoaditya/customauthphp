@extends('layouts.index')
<div id="wrapper">
	<div class="main-content">
		<div>
        <form action="update" method="POST">
                             @if(Session::get('success'))
                                <div class="alert alert-success">
                                {{Session::get('success')}}
                                </div>
                            @endif
                        @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" placeholder="name" name="name" value="{{session()->get('user')['name']}}" class="form-control">
                        
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="email" placeholder="email" name="email" value="{{session()->get('user')['email']}}" class="form-control">
                    </div>  
                    
                    <button type="submit" class="btn btn-primary">UPDATE</button>
        </form>
        </div>
    </div>
</div>    





@section('content')
@stop



