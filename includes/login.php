<!-- Modal -->
<div class="modal fade" id="signIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="http://localhost/cs5200/index.php" class="" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="signInLabel">Sign In</h4>
                </div>
                <div class="modal-body">
                    <label for="username" class="sr-only">Username</label>
                    <input type="text" id="username" name="username" class="form-control input-lg" placeholder="username" required autofocus>
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" id="password" name="password" class="form-control input-lg" placeholder="password" required autofocus>
                    <!-- <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button> -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary btn-lg" type="submit">Sign in</button>
                </div>
            </form>
        </div>
    </div>
</div>
