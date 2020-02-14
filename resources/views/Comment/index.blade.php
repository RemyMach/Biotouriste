@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')
<div id="profil">
    <div class="col-md-12 text-center">
        <div class="row" style="margin:0;">
            <div class="col-xs-12 col-sm-12 col-md-6 offset-md-3 text-center">
                <div class="card">
                    <div id="password">
                        <h3>Complete the check for {{ $check['user_name'] }}</h3>
                        <p><span style="color:red;">*</span><i>Required field</i></p>
                        <form class="" action="{{ url('comment/store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Date Of the Chec*</label>
                                <input type="date" name="check_date" placeholder="Actual password *">
                            </div>
                            <div class="form-group">
                                <label >Note Customer Service*</label>
                                <select class="form-control" name="check_customer_service">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Note State Place*</label>
                                <select class="form-control" name="check_state_place">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Note Quality Product*</label>
                                <select class="form-control" name="check_quality_product">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Bio Status*</label>
                                <select class="form-control" name="check_bio_status">
                                    <option>bio</option>
                                    <option>not bio</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Description of the content*</label>
                                <textarea class="form-control"  name="check_comment" rows="3"></textarea>
                            </div>
                            <input type="hidden" name="idCheck" value="{{ $check['idCheck'] }}">
                            <input type="submit" value="Submit">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
</script>
@include('layouts.footer')
