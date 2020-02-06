@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')

<div id="profil">
    <div class="row" style="margin:0;">
        <div class="col-md-12" style="padding:0;">
            <div class="profil_banner">
                <div class="row" style="margin:0;">
                    <div class="col-md-12 text-center">
                        <h2>Admin Portal</h2>
                        <div class="line"></div>
                    </div>
                </div>
            </div>
            <div class="profil_container text-center">
                <div class="row" style="margin:0;">
                    <div class="col-md-12 text-center">
                        <h3>Create a Check For a controller</h3>
                        <form class="" action="/discountCode" method="post">
                            @csrf
                            <input type="integer" name="discount_code_amount" value="" placeholder="reduction amount %" >
                            <input type="integer" name="expiration_time" value="" placeholder="expiration time">
                            <select class="form-control" name="OneOrMultipleUser">
                                <option>Multiple</option>
                            </select>
                            <input type="integer" name="minimum_amount" placeholder="minimum amount">
                            <input type="text" name="periode_minimum_amount" placeholder="range minimum amount calcul">
                            <input type="submit" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
            <div class="profil_container text-center">
                <div class="row" style="margin:0;">
                    <div class="col-md-12 text-center">
                        <h3>Checks Not Done</h3>
                        @if(isset($error))
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endif
                        @if(isset($contacts))
                            <table class="table">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">mail</th>
                                    <th scope="col">subject</th>
                                    <th scope="col">content</th>
                                    <th scope="col">Delete the contact</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contacts as $contact)
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{ $contact->contact_email }}</td>
                                        <td>{{ $contact->contact_subject }}</td>
                                        <td>{{ $contact->contact_content }}</td>
                                        <td><form action="/contact/destroy/{{$contact->idContact}}" method="get"><button style="margin: 0" type="submit">Suppression</button></form></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
            <div class="profil_container text-center">
                <div class="row" style="margin:0;">
                    <div class="col-md-12 text-center">
                        <h3>Change password</h3>
                        <form class="" action="index.html" method="post">
                            <input type="password" name="password" value="" placeholder="New password">
                            <input type="password" name="confirm_password" value="" placeholder="Confirm new password">
                            <input type="submit" name="" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
            <div class="profil_container text-center">
                <div class="row" style="margin:0;">
                    <div class="col-md-12 text-center">
                        <h3>Order history</h3>
                        <div class="order_history">
                            <div class="col-md-12">
                                <div class="row" style="margin:0;">
                                    <div class="col-md-4 text-left">
                                        <p>Order 0001</p>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <p>Tomatoes</p>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <p>$15</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="order_history">
                            <div class="col-md-12">
                                <div class="row" style="margin:0;">
                                    <div class="col-md-4 text-left">
                                        <p>Order 0002</p>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <p>Orange</p>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <p>$6</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form class="" action="logout" method="post">
                @csrf
                <div class="form-group text-center">
                    <input type="submit" name="" value="Disconnect">
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    const x = document.getElementById("edit");
    const y = document.getElementById("info");
    function btnEdit() {
        x.style.display = (x.style.display === 'block') ? 'none':'block';
    }
</script>
@include('layouts.footer')
