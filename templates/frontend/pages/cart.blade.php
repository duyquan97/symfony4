@extends('frontend.master')
@section('css')
@endsection
@section('main')
    <section id="breadcrumbs">
        <div class="avarta"><img alt="" src="images/bread.png" class="img-fluid" width="100%" alt=""></div>
        <div class="info text-center mont">
            <div class="container">
                <h2 class=" wow fadeInUp wHighlight" data-wow-delay=".2s">Giỏ hàng</h2>
                <ul class="list-inline wow fadeInUp wHighlight" data-wow-delay=".2s">
                    <li class="list-inline-item"><a title="" href="index.php">Home</a></li>
                    <li class="list-inline-item"><span>Giỏ hàng</span></li>
                </ul>
            </div>
        </div>
    </section>
    <section id="cart">
        <div class="container">
            <div class="content">
                <div class="scroll-cart">
                    <div class="prod-cart">
                        <div class="item wow fadeIn wHighlight" data-wow-delay=".2s">
                            <div class="prod mont">
                                <div class="avarta"><a title="" href="product-detail.php"><img alt="" src="images/ct1.png" class="img-fluid" alt=""></a></div>
                                <h3><a title="" href="product-detail.php">Sàn Nhựa Tự Dán Keo 2036</a></h3>
                            </div>
                            <div class="quantity">
                                <span>Số lượng</span>
                                <div class="number-spinner">
                                    <span class="ns-btn">
                                        <a data-dir="up"><span class="icon-plus"><i class="fa fa-angle-up"></i></span></a>
                                    </span>
                                    <input type="text" class="pl-ns-value" value="10" maxlength="5">
                                    <span class="ns-btn">
                                        <a data-dir="dwn"><span class="icon-minus"><i class="fa fa-angle-down"></i></span></a>
                                    </span>
                                </div>
                            </div>
                            <div class="price">
                                <del>645.000 vnđ</del>
                                <span>300.000 vnđ</span>
                            </div>
                            <div class="remove"><a title="" href="javascript:0"><img alt="" src="images/remove.png" class="img-fluid" alt=""></a></div>
                        </div>
                        <div class="item wow fadeIn wHighlight" data-wow-delay=".2s">
                            <div class="prod mont">
                                <div class="avarta"><a title="" href="product-detail.php"><img alt="" src="images/ct1.png" class="img-fluid" alt=""></a></div>
                                <h3><a title="" href="product-detail.php">Sàn Nhựa Tự Dán Keo 2036</a></h3>
                            </div>
                            <div class="quantity">
                                <span>Số lượng</span>
                                <div class="number-spinner">
                                    <span class="ns-btn">
                                        <a data-dir="up"><span class="icon-plus"><i class="fa fa-angle-up"></i></span></a>
                                    </span>
                                    <input type="text" class="pl-ns-value" value="10" maxlength="5">
                                    <span class="ns-btn">
                                        <a data-dir="dwn"><span class="icon-minus"><i class="fa fa-angle-down"></i></span></a>
                                    </span>
                                </div>
                            </div>
                            <div class="price">
                                <del>645.000 vnđ</del>
                                <span>300.000 vnđ</span>
                            </div>
                            <div class="remove"><a title="" href="javascript:0"><img alt="" src="images/remove.png" class="img-fluid" alt=""></a></div>
                        </div>
                        <div class="item">
                            <div class="readmore mont"><a title="" href="product.php">Tiếp tục mua hàng</a></div>
                        </div>
                    </div>
                </div>
                <div class="info-bott">
                    <div class="row">
                        <div class="col-md-6 wow fadeInLeft wHighlight" data-wow-delay=".2s">
                            <div class="title-info mont">Thông tin đặt hàng</div>
                            <div class="list-info-left">
                                <div class="item">
                                    <label for="">Họ và tên <span>*</span></label>
                                    <input type="text" placeholder="Vui lòng nhập tên">
                                </div>
                                <div class="item">
                                    <label for="">Số điện thoại <span>*</span></label>
                                    <input type="text" placeholder="Vui lòng nhập số điện thoại">
                                </div>
                                <div class="item">
                                    <label for="">Email</label>
                                    <input type="text" placeholder="Vui lòng nhập Email">
                                </div>
                                <div class="item">
                                    <label for="">Địa chỉ cụ thể <span>*</span></label>
                                    <input type="text" placeholder="Vui lòng nhập địa chỉ của bạn">
                                </div>
                                <div class="item">
                                    <label for="">Ghi chú</label>
                                    <textarea name="" id="" cols="30" rows="10" placeholder="Vui lòng nhập nội dung"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 wow fadeInRight wHighlight" data-wow-delay=".2s">
                            <div class="title-info mont">Thanh toán</div>
                            <div class="info-buy">
                                <div class="code">
                                    <input type="text" placeholder="Nhập mã coupon">
                                </div>
                            </div>
                            <div class="xn-buy">
                                <div class="item-xn">
                                    <p>01   x   Sàn nhựa hèm khóa SPC 07</p>
                                    <p class="price">325.000 vnđ</p>
                                </div>
                                <div class="item-xn">
                                    <p>01   x   Sàn nhựa hèm khóa SPC 07</p>
                                    <p class="price">325.000 vnđ</p>
                                </div>
                                <div class="item-xn">
                                    <p>Phí giao hàng</p>
                                    <p class="price">0 vnđ</p>
                                </div>
                                <div class="item-xn">
                                    <div class="btn-xn text-right mont"><button>Xác nhận</button></div>
                                </div>
                            </div>
                            <div class="total-money">
                                <p class="mont">Tổng thanh toán</p>
                                <p>650.000 vnđ <span>Đã bao gồm VAT nếu có</span></p>
                            </div>
                            <div class="btn-buy text-right mont">
                                <button type="submit">Đặt hàng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
@endsection
