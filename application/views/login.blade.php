@layout('master')

@section('title')
Login
@endsection

@section('content')
@if (Session::has('message'))
<div class="alert">
  <button type="button" class="close" data-dismiss="alert">×</button>
  {{ $message }}
</div>
@endif
<div class="row">
  <form class="form-horizontal" method="POST" action="/user/authenticate">
    <div class="control-group">
      <label class="control-label" for="inputEmail">Email</label>
      <div class="controls">
        <input type="text" id="email" name="email" placeholder="Email">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="inputPassword">Password</label>
      <div class="controls">
        <input type="password" id="password" name="password" placeholder="Password">
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
        <label class="checkbox">
          <input type="checkbox" name="remember"> Remember me
        </label>
        <button type="submit" class="btn btn-primary">Log me in</button>
      </div>
    </div>
  </form>
</div>
@endsection