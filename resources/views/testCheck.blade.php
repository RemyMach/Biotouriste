
<div class="col-md-10 offset-md-1">
    <div class="container text-center">
        <h2>Welcome</h2>
        <p>Send Check To Admin</p>
        <form action="/check/store" method="post">
            @csrf
            <div>
                <input type="date" name="check_date" placeholder="date de vérification">
            </div>
            <div>
                <input type="text" name="check_comment" placeholder="check_comment">
            </div>
            <div>
                <input type="number" name="check_customer_service" placeholder="note du service">
            </div>
            <div>
                <input type="number" name="check_state_place" placeholder="état de l'endroit">
            </div>
            <div>
                <input type="number" name="check_quality_product" placeholder="qualité du produit">
            </div>
            <div>
                <input type="text" name="check_bio_status" placeholder="si le produit est bio tapé bio">
            </div>
            <div class="mybtn">
                <input class="btn btn-primary mybtn" type="submit" value="Send Check" required>
            </div>
        </form>
        <div>
            <a href="http://localhost:8000/comment/destroy/3"></a>
        </div>
    </div>
</div>