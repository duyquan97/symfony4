@extends('frontend.master')
@section('css')
@endsection
@section('main')
    <section id="breadcrumbs">
        <div class="avarta"><img alt="" src="images/bread.png" class="img-fluid" width="100%" alt=""></div>
        <div class="info text-center mont">
            <div class="container">
                <h2 class=" wow fadeInUp wHighlight" data-wow-delay=".2s">Liên hệ</h2>
                <ul class="list-inline wow fadeInUp wHighlight" data-wow-delay=".2s">
                    <li class="list-inline-item"><a title="" href="index.php">Home</a></li>
                    <li class="list-inline-item"><span>Liên hệ</span></li>
                </ul>
            </div>
        </div>
    </section>
    <section id="contact">
        <div class="container">
            <div class="content">
                <div class="title-contact mont">
                    <span>Liên hệ</span>
                </div>
                <div class="list-contact">
                    <div class="row">
                        <div class="col-md-6  wow fadeInUp wHighlight" data-wow-delay=".2s">
                            <div class="item">
                                <label for="" class="mont">Họ tên</label>
                                <input type="text" placeholder="Vui lòng nhập họ tên">
                            </div>
                        </div>
                        <div class="col-md-6  wow fadeInUp wHighlight" data-wow-delay=".2s">
                            <div class="item">
                                <label for="" class="mont">Email</label>
                                <input type="text" placeholder="Vui lòng nhập địa chỉ Email">
                            </div>
                        </div>
                        <div class="col-md-6  wow fadeInUp wHighlight" data-wow-delay=".2s">
                            <div class="item">
                                <label for="" class="mont">Số điện thoại</label>
                                <input type="text" placeholder="Vui lòng nhập Số điện thoại">
                            </div>
                        </div>
                        <div class="col-md-6  wow fadeInUp wHighlight" data-wow-delay=".2s">
                            <div class="item">
                                <label for="" class="mont">Nội dung</label>
                                <textarea name="" id="" cols="30" rows="10" placeholder="Vui lòng nhập nội dung"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="btn-submit text-right mont"><button type="submit">Gửi</button></div>
                        </div>
                    </div>
                </div>
                <div class="info wow fadeInUp wHighlight" data-wow-delay=".2s">
                    <h1 class="mont">Công ty TNHH Vina TQ</h1>
                    <p>Địa chỉ: Số 486 - Đường Láng - Đống Đa - Hà Nội</p>
                    <p>Điện thoại: 0923 455 565</p>
                    <p>Email: noithatanhquyen@gmail.com</p>
                </div>
            </div>
        </div>
        <div class="maps wow zoomIn wHighlight" data-wow-delay=".2s">
            <div class="content">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.774837281826!2d105.8206953151857!3d21.00166099407813!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ade4ee3e84b5%3A0xc23f50a8e637de55!2sGCO%20GROUP!5e0!3m2!1svi!2s!4v1571026977837!5m2!1svi!2s" width="100%" height="375" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
        </div>
    </section>
@endsection
@section('js')
@endsection
