@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')
<div id="profil">
    <div class="col-md-12 text-center">
        <div class="row" style="margin:0;">
            <div class="col-xs-12 col-sm-12 col-md-6 offset-md-3 text-center">
                @if(session('messageStatus'))
                    <div class="alert alert-secondary" role="alert">
                        {{session('messageStatus')}}
                    </div>
                @endif
                @if(isset($checks->checks_waiting[0]))
                    <div class="card">
                        <h3>New Checks</h3>
                            <div class="form-group text-center">
                                <a href="#new_checks" id="See_new_checks">See</a>
                            </div>
                        <table class="table" id="new_checks" style="display: none">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name Lastname</th>
                                <th scope="col">City</th>
                                <th scope="col">Adresse</th>
                                <th scope="col">Postal Code</th>
                                <th scope="col">Decline the Check</th>
                                <th scope="col">Accept the Check</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($checks->checks_waiting as $check)
                            <tr>
                                <th scope="row">{{ $check->idCheck }}</th>
                                <td>{{ $check->user_name }} {{ $check->user_surname }}</td>
                                <td>{{ $check->seller_city }}</td>
                                <td>{{ $check->seller_adress }}</td>
                                <td>{{ $check->seller_postal_code }}</td>
                                <td><form action="{{ url('check/statusVerification/'. $check->idCheck) }}" method="post">@csrf<input type="hidden" name="status" value="decline"><button style="margin: 0" type="submit">Decline</button></form></td>
                                <td><form action="{{ url('check/statusVerification/'. $check->idCheck) }}" method="post">@csrf<input type="hidden" name="status" value="In progress"><button style="margin: 0" type="submit">Accept</button></form></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    @if(session('completeCheck'))
                        <div class="alert alert-success" role="alert">
                            {{session('completeCheck')}}
                        </div>
                    @endif
                    @if(isset($checks->checks_In_progress[0]))
                        <div class="card">
                            <h3>Checks In Progress</h3>
                            <div class="form-group text-center">
                                <a href="#checks_in_progress" id="See_checks_in_progress">See</a>
                            </div>
                            <table class="table" id="checks_in_progress" style="display: none">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name Lastname</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Adress</th>
                                    <th scope="col">Postal Code</th>
                                    <th scope="col">Complete the Check</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($checks->checks_In_progress as $check)
                                    <tr>
                                        <th scope="row">{{ $check->idCheck }}</th>
                                        <td>{{ $check->user_name }} {{ $check->user_surname }}</td>
                                        <td>{{ $check->seller_city }}</td>
                                        <td>{{ $check->seller_adress }}</td>
                                        <td>{{ $check->seller_postal_code }}</td>
                                        <td><form action="{{ url('check/showForm/' . $check->idCheck . '/' . $check->user_name . ' ' . $check->user_surname) }}" method="get">@csrf<button style="margin: 0" type="submit">Complete</button></form></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    @if(isset($checks->checks_done[0]))
                        <div class="card">
                            <h3>Checks Done</h3>
                            <div class="form-group text-center">
                                <a href="#checks_done" id="See_checks_done">See</a>
                            </div>
                            <table class="table" id="checks_done" style="display: none">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name Lastname</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Adress</th>
                                    <th scope="col">Postal Code</th>
                                    <th scope="col">Date Check</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($checks->checks_done as $check)
                                    <tr>
                                        <th scope="row">{{ $check->idCheck }}</th>
                                        <td>{{ $check->user_name }} {{ $check->user_surname }}</td>
                                        <td>{{ $check->seller_city }}</td>
                                        <td>{{ $check->seller_adress }}</td>
                                        <td>{{ $check->seller_postal_code }}</td>
                                        <td>{{ $check->check_date }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    if(document.getElementById("See_new_checks")){
        const see_new_check = document.getElementById("See_new_checks");
        const new_check = document.getElementById("new_checks");

        see_new_check.addEventListener('click', function(){
            if(new_check.style.display == 'none'){
                new_check.style.display = 'block';
                see_new_check.textContent = 'hide';
            }else{
                new_check.style.display = 'none';
                see_new_check.textContent = 'See';
            }
        });
    }

    if(document.getElementById("See_checks_done")){
        const see_checks_done = document.getElementById("See_checks_done");
        const checks_done = document.getElementById("checks_done");

        see_checks_done.addEventListener('click', function(){
            if(checks_done.style.display == 'none'){
                checks_done.style.display = 'block';
                see_checks_done.textContent = 'hide';
            }else{
                checks_done.style.display = 'none';
                see_checks_done.textContent = 'See';
            }
        });
    }

    if(document.getElementById("See_checks_in_progress")){
        const see_checks_in_progress = document.getElementById("See_checks_in_progress");
        const checks_in_progress = document.getElementById("checks_in_progress");

        see_checks_in_progress.addEventListener('click', function(){
            if(checks_in_progress.style.display == 'none'){
                checks_in_progress.style.display = 'block';
                see_checks_in_progress.textContent = 'hide';
            }else{
                checks_in_progress.style.display = 'none';
                see_checks_in_progress.textContent = 'See';
            }
        });
    }
</script>
@include('layouts.footer')
