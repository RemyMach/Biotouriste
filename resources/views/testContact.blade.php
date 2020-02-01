<div class="col-md-10 offset-md-1">
    <div class="container text-center">
        <h2>Welcome</h2>
        <p>Send Contact To Admin</p>
        <form action="/contact/storeForAnAnonymous" method="post">
            @csrf
            <div>
                <input type="text" name="contact_subject" placeholder="subject">
            </div>
            <div>
                <input type="email" name="contact_email" placeholder="email">
            </div>
            <div>
                <textarea name="contact_content"></textarea>
            </div>
            <div class="mybtn">
                <input class="btn btn-primary mybtn" type="submit" value="Send Check" required>
            </div>
        </form>
        <form action="contact/user" method="post">
            @csrf
            <input type="hidden" value="5" name="idUser_contacts">
            <button type="submit">Voir</button>
        </form>
    </div>
</div>