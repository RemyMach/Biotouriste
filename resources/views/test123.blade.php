<div class="col-md-10 offset-md-1">
    <div class="container text-center">
        <h2>Welcome</h2>
        <p>Send FeedBack To Admin</p>
        <form action="/user/comment" method="post">
            @csrf
            <input placeholder="titre" type="text">
            </div>
            <textarea name="content" rows="8" cols="80" class="col-8" required></textarea>
            <div  class="mybtn">
                <input class="btn btn-primary mybtn" type="submit" value="Send FeedBack">
            </div>
        </form>
    </div>
</div>