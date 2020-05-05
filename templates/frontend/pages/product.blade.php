@extends('frontend.master')
@section('css')
@endsection
@section('main')
    <section id="breadcrumbs">
        <div class="avarta"><img alt="" src="images/bread.png" class="img-fluid" width="100%" alt=""></div>
        <div class="info text-center mont">
            <div class="container">
                <h2 class=" wow fadeInUp wHighlight" data-wow-delay=".2s">Sản phẩm</h2>
                <ul class="list-inline wow fadeInUp wHighlight" data-wow-delay=".2s">
                    <li class="list-inline-item"><a title="" href="index.php">Home</a></li>
                    <li class="list-inline-item"><span>Sản phẩm</span></li>
                </ul>
            </div>
        </div>
    </section>
    @include('frontend.template.menu-left')
    <section id="popup">
        <div class="modal fade" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body">
                <button type="button" class="close"  data-dismiss="modal" style="display: none;">&times;</button>
                <div class="content-popup">
                    <div class="item">
                        <div class="prod">
                            <div class="avarta"><a title="" href="product-detail.php"><img alt="" src="images/popup.png" class="img-fluid" alt=""></a></div>
                            <div class="info mont"><h3><a title="" href="product-detail.php">Bàn Newtrend NT140A</a></h3></div>
                        </div>
                        <div class="price">
                            <del>564.000 vnđ</del><span>325.000 vnđ</span>
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
                    </div>
                    <div class="total text-right">
                        <span>Tổng giá: 325.000 vnđ</span>
                    </div>
                    <div class="form-sent">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="item">
                                    <label for="">Họ tên <span>*</span></label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="item">
                                    <label for="">Địa chỉ <span>*</span></label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="item">
                                    <label for="">Số điện thoại <span>*</span></label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="item">
                                    <label for="">Ghi chú</label>
                                    <textarea name="" id="" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="btn-sent mont text-right">
                                    <button>Mua ngay</button>
                                </div>
                            </div>
                        </div>
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
