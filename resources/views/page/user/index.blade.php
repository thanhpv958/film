@extends('page.layout.main')

@if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

@section('content')
<div id="UserPage">
    <div class="container">
        <div class="user-box">
            <div class="row">
                <div class="col-12 col-md-2">
                    <div class="user-menu">
                        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="account-tab" data-toggle="tab" href="#accountTab" role="tab" aria-controls="account" aria-selected="true">
                                    {{ __('userPage.accInfo') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="film-tab" data-toggle="tab" href="#filmTab" role="tab" aria-controls="film" aria-selected="false">
                                    {{ __('userPage.journey') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-12 col-md-10">
                    <div class="tab-content">
                        <div class="tab-pane active" id="accountTab" role="tabpanel" aria-labelledby="account-tab">
                            <form action="#" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <div class="user-image">

                                            <div class="form-group">
                                                <img src="https://www.betacineplex.vn/images/default-avatar.png" alt="">
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">{{ __('userPage.uploadImg') }}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-9">
                                        <div class="user-info">
                                            <p class="txt-hello">Xin chào,
                                                <span>{{Auth::user()->name}}</span>
                                            </p>
                                            <p class="txt-description">{{ __('userPage.note') }}</p>

                                            <div class="form-group row">
                                                <label class="col-3 mt-2">Email:</label>
                                                <input type="text" class="form-control col-9" value="{{Auth::user()->email}}" disabled>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 mt-2">{{ __('userPage.name') }}: </label>
                                                <input type="text" class="form-control col-9" placeholder="{{ __('userPage.name') }}" value="{{Auth::user()->name}}">
                                            </div>
                                            <div class="form-check mt-4 mb-2">
                                                <input type="checkbox" class="form-check-input" id="ChangePassCheck">
                                                <label class="form-check-label" for="ChangePassCheck">{{ __('userPage.editPass') }}</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 mt-2">{{ __('userPage.pass') }}: </label>
                                                <input type="text" class="form-control col-9 passsword" placeholder="{{ __('userPage.pass') }}" disabled>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 mt-2">{{ __('userPage.enterPass') }}: </label>
                                                <input type="text" class="form-control col-9 passsword" placeholder="{{ __('userPage.enterPass') }}" disabled>
                                            </div>
                                        </div>

                                        <input type="submit" class="btn btn-primary mt-2" value="{{ __('userPage.updateInfo') }}">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="filmTab" role="tabpanel" aria-labelledby="film-tab">
                            <div class="user-filmtour table-responsive-md">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>{{ __('userPage.film') }}</th>
                                            <th>{{ __('userPage.theater') }}</th>
                                            <th>{{ __('userPage.calendar') }}</th>
                                            <th>{{ __('userPage.seat') }}</th>
                                            <th>{{ __('userPage.create_at') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-bordered">
                                        <tr>
                                            <td>1</td>
                                            <td>Siêu thú cuồng nộ</td>
                                            <td>Cyber Khương Đình - Hà Nội</td>
                                            <td>9:00 pm, 17/06/2018</td>
                                            <td>E1, E2, E3</td>
                                            <td>16/06/2018</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
