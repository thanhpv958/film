 <!-- footer -->
 <footer id="footer">

    <!-- footer box -->
    <div class="footer-box">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-3">
                    <ul class="list-group">
                        <li>
                            <h4 class="title-widget">{{ __('home.intro') }}</h4>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-angle-double-right"></i> {{ __('home.about') }}</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-angle-double-right"></i> {{ __('home.policy') }}</a>
                        </li>
                    </ul>
                </div>

                <div class="col-6 col-md-3">
                    <ul class="list-group">
                        <li>
                            <h4 class="title-widget">{{ __('home.photo') }}</h4>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-angle-double-right"></i> {{ __('home.ticketRoom') }}</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-angle-double-right"></i> {{ __('home.filmOfM') }}</a>
                        </li>
                    </ul>
                </div>

                <div class="col-6 col-md-3">
                    <ul class="list-group">
                        <li>
                            <h4 class="title-widget">{{ __('home.support') }}</h4>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-angle-double-right"></i> {{ __('home.feedback') }}</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-angle-double-right"></i> {{ __('home.recruitment') }}</a>
                        </li>
                    </ul>
                </div>

                <div class="col-6 col-md-3">
                    <ul class="list-group">
                        <li>
                            <h4 class="title-widget">{{ __('home.connect') }}</h4>
                        </li>
                        <li>
                            <a href="http://facebook.com">
                                <i class="fab fa-facebook"></i> Facebook</a>
                        </li>
                        <li>
                            <a href="http://youtube.com">
                                <i class="fab fa-youtube"></i> Youtube</a>
                        </li>
                        <li>
                            <form action="/language" method="post">
                                @csrf
                                <select name="locale" class="language">
                                    <option value="vi">Việt Nam</option>
                                    <option value="en">English</option>
                                </select>
                                <input type="submit" value="Submit" class="btn btn-outline-secondary btn-sm">
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- footer box -->

    <!-- footer line -->
    <div class="footer-line">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- col -->
                <div class="col-12">
                    <div class="copyright">
                        <p>Công Ty Cổ Phần Phim Cyber, Tầng 5 Toà Nhà Fivestar Garden, số 460 Khương Đình, Quận
                            Thanh Xuân, Hà Nội.
                        </p>
                    </div>
                </div>
                <!-- col -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- footer line -->
</footer>
<!-- footer -->
