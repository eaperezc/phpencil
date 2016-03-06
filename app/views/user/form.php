<form id="user-form" class="form" method="POST" action="{{ link( 'user', 'create' ) }}">
    <div class="form-group">
        <label for="input-username" class="control-label">Username</label>
        <input name="username" class="form-control" id="input-username" placeholder="Username">
    </div>
    <div class="form-group">
        <label for="input-email" class="control-label">Email</label>
        <input name="email" type="email" class="form-control" id="input-email" placeholder="Email Address">
    </div>
    <div class="row">
        <div class="form-group col-xs-6">
            <label for="input-firstname" class="control-label">First Name</label>
            <input name="firstname" class="form-control" id="input-firstname" placeholder="First Name">
        </div>
        <div class="form-group col-xs-6" style="padding-left: 0px;">
            <label for="input-lastname" class="control-label">Last Name</label>
            <input name="lastname" class="form-control" id="input-lastname" placeholder="Last Name">
        </div>
    </div>
    <div class="form-group">
        <label for="input-password" class="control-label">Password</label>
        <input name="password" type="password" class="form-control" id="input-password" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="input-rpassword" class="control-label">Repeat Password</label>
        <input name="rpassword" type="password" class="form-control" id="input-rpassword" placeholder="Repeat Password">
    </div>
</form>
