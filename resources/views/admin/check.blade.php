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
                        @if (isset($success))
                            <div class="alert alert-success" role="alert">
                                {{ $success }}
                            </div>
                        @elseif(isset($error))
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endif
                        <h3>Create a Check For a controller</h3>
                        <form class="" action="{{ url('admin/checks') }}" method="post">
                            @csrf
                            <input type="integer" name="idSeller" value="" placeholder="id of the Seller" >
                            <input type="integer" name="idController" placeholder="id of the Controller">
                            <input type="submit" value="Send">
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
                        @if(isset($checks))
                            <table class="table">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">controller</th>
                                    <th scope="col">idSeller</th>
                                    <th scope="col">Delete the Check</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($checks as $check)
                                    <tr>
                                        <th scope="row">{{ $check->idCheck }}</th>
                                        <td>{{ $check->user_name }} {{ $check->user_surname }}</td>
                                        <td>{{ $check->Sellers_idSeller }}</td>
                                        <td><form action="{{ url('check/destroy/'. $check->idCheck) }}" method="post">@csrf<button style="margin: 0" type="submit">Suppression</button></form></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
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
