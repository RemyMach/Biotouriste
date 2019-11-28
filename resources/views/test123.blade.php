<div class="col-md-10 offset-md-1">
    <div class="container text-center">
        <h2>Welcome</h2>
        <p>Send FeedBack To Admin</p>
        <form action="/comment/store" method="post">
            @csrf
            <div>
                <input type="number" name="comment_note">
            </div>
            <div>
                <input placeholder="titre" type="text" name="comment_subject" required>
            </div>
            <textarea rows="8" cols="80" class="col-8" name="comment_content" required></textarea>
            <div  class="mybtn">
                <input class="btn btn-primary mybtn" type="submit" value="Send FeedBack" required>
            </div>
        </form>
        <div>
            <a href="http://localhost:8000/comment/destroy/3">Détruire le commentaire numéro 3</a>
        </div>
    </div>
</div>