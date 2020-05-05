@extends('frontend.master')
@section('css')
@endsection
@section('main')
    <section id="breadcrumbs">
        <div class="avarta"><img alt="" src="images/bread.png" class="img-fluid" width="100%" alt=""></div>
        <div class="info text-center mont">
            <div class="container">
                <h2>Sản phẩm</h2>
                <ul class="list-inline">
                    <li class="list-inline-item"><a title="" href="index.php">Home</a></li>
                    <li class="list-inline-item"><a title="" href="product.php">Sản phẩm</a></li>
                    <li class="list-inline-item"><span>Sàn nhựa dán keo 2mm mã 36</span></li>
                </ul>
            </div>
        </div>
    </section>
    <section id="product-detail">
        <div class="container">
            <div class="content">
                <div class="review">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 wow fadeInLeft wHighlight" data-wow-delay=".2s">
                            <div class="left">
                                 <div class="slider-for">
                                    <div class="carousel-item">
                                        <img class="" src="images/thumb1.png" class="img-fluid" width="100%" alt="Third slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="" src="images/thumb1.png" class="img-fluid" width="100%" alt="Third slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="" src="images/thumb1.png" class="img-fluid" width="100%" alt="Third slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="" src="images/thumb1.png" class="img-fluid" width="100%" alt="Third slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="" src="images/thumb1.png" class="img-fluid" width="100%" alt="Third slide">
                                    </div>
                                </div>
                                <!--/.Slides-->
                                <div class="slider-nav">
                                     <div class="clc active"> <img class="active" src="images/thumb5.png" width="100%" alt="Third slide"></div>
                                     <div class="clc"><img class="" src="images/thumb4.png" width="100%" alt="Third slide"></div>
                                     <div class="clc"><img class="" src="images/thumb5.png" width="100%" alt="Third slide"></div>
                                     <div class="clc"><img class="" src="images/thumb4.png" width="100%" alt="Third slide"></div>
                                     <div class="clc"><img class="" src="images/thumb5.png" width="100%" alt="Third slide"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 wow fadeInRight wHighlight" data-wow-delay=".2s">
                            <div class="right-review">
                                <h1 class="mont">Sàn Nhựa Dán Keo <br>2mm mã 36</h1>
                                <div class="price">
                                    <del>550.000 vnđ</del><span>325.000 vnđ</span>
                                </div>
                                <div class="info-review">
                                    <ul>
                                        <li>- Mã sản phẩm: SV100HL</li>
                                        <li>- Nhà cung cấp: Nội Thất Hòa Phát</li>
                                        <li>- Chất liệu: Gỗ công nghiệp</li>
                                        <li>- Bảo hành: 12 Tháng</li>
                                        <li>Bàn hình chữ nhật không kèm hộc tài liệu.</li>
                                        <li>Bàn làm việc SV100HL có 1 hộc tài liệu treo liền gồm 1 ngăn kéo và 1 ngăn cánh mở.</li>
                                        <li>Gỗ công nghiệp bề mặt Melamine có khả năng chống thấm nước, chống trầy xước, chống bám bẩn, chịu nhiệt độ cao trong điều kiện sử dụng bình thường.</li>
                                        <li>Kích thước: W100 x D600 x H750mm</li>
                                    </ul>
                                </div>
                                <div class="quantity">
                                    <span class="mont">Số lượng:</span>
                                    <div class="number-spinner">
                                      <input type="text" class="pl-ns-value" value="10" maxlength="5">
                                      <span class="ns-btn">
                                              <a data-dir="up"><span class="icon-plus"><i class="fa fa-angle-up"></i></span></a>
                                      </span>
                                      <span class="ns-btn">
                                              <a data-dir="dwn"><span class="icon-minus"><i class="fa fa-angle-down"></i></span></a>
                                      </span>
                                    </div>
                                </div>
                                <div class="like-share">
                                    <ul class="list-inline">
                                        <li class="list-inline-item"><a title="" href=""><img alt="" src="images/like1.png" class="img-fluid" alt=""></a></li>
                                        <li class="list-inline-item"><a title="" href=""><img alt="" src="images/share1.png" class="img-fluid" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="buy-cart mont">
                                    <ul class="list-inline">
                                        <li class="list-inline-item"><div class="readmore"><a title="" href="javascript:0" data-toggle="modal" data-target="#myModal">Mua hàng qua điện thoại</a></div></li>
                                        <li class="list-inline-item"><div class="readmore"><a title="" href="cart.php" class="add-cart">Thêm vào giỏ hàng</a></div></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="infomation">
                    <div class="title mont wow fadeInUp wHighlight" data-wow-delay=".2s"><h2>Giới thiệu sản phẩm</h2></div>
                    <div class="info">
                        <h3>Ghế họp lưng trung SL607</h3>
                        <p>- Tấm Compact HPL là tấm dạng cứng lõi đặc được tạo thành từ nhiều lớp Phenonic ép nén dưới nhiệt độ cao. Sản phẩm được nghiên cứu và sản xuất trên dây truyền công nghệ theo tiêu chuẩn của Mỹ. Các lớp Phenolic được nén bởi nhiệt và áp lực cao, kết hợp với nhựa tổng hợp, thêm nữa được phủ bề mặt một lớp Melamine, Lamilate chống trầy xước, có nhiều màu để lựa chọn.</p>
                        <p><img alt="" src="images/detail1.png" class="img-fluid" width="100%" alt=""></p>
                        <h3>Đặc tính</h3>
                        <p>Đặc tính nổi bật của loại chất liệu này là độ cứng, độ bền trong môi trường oxy hóa cao và ẩm ướt, chịu nước 100%, chống các nấm mốc và vi khuẩn ăn bám nên an toàn cho sức khẻo, dễ lau chùi vệ sinh bằng các chất làm sạch trong nhà vệ sinh, dễ dàng vận chuyển, lắp đặt.</p>
                        <p><img alt="" src="images/detail2.png" class="img-fluid" width="100%" alt=""></p>
                        <p>- Tấm Compact HPL siêu bền, không gian thoáng mát hiện đại, có tính thẩm mỹ cao, tận dụng diện tích. - Độ dày 12mm, kích thước khổ tấm (mm): 1220x1830, 1530x1830, 1850x3670</p>
                    </div>
                </div>
                <div class="other-sp">
                    <div class="container">
                        <div class="content">
                            <div class="title mont wow fadeInUp wHighlight" data-wow-delay=".2s"><h2>Sản phẩm liên quan</h2></div>
                            <div class="list-product other-prod">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="item text-center">
                                            <div class="avarta">
                                                <a title="" href="product-detail.php"><img alt="" src="images/sp4.png" class="img-fluid" alt=""></a>
                                                <div class="readmore"><a title="" href="product-detail.php" class="mont" data-toggle="modal" data-target="#myModal">Mua ngay</a></div>
                                                <div class="status"><a title="" href="javascript:0" class="new mont">mới</a></div>
                                            </div>
                                            <div class="info">
                                                <h3><a title="" href="product-detail.php" class="mont">Tấm ốp PVC vân đá DV-204</a></h3>
                                                <div class="price">
                                                    <del>555.000 vnđ</del><span>300.000 vnđ</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="item text-center">
                                            <div class="avarta">
                                                <a title="" href="product-detail.php"><img alt="" src="images/sp7.png" class="img-fluid" alt=""></a>
                                                <div class="readmore"><a title="" href="product-detail.php" class="mont" data-toggle="modal" data-target="#myModal">Mua ngay</a></div>
                                            </div>
                                            <div class="info">
                                                <h3><a title="" href="product-detail.php" class="mont">Tấm ốp PVC vân đá DV-204</a></h3>
                                                <div class="price">
                                                    <del>555.000 vnđ</del><span>300.000 vnđ</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="item text-center">
                                            <div class="avarta">
                                                <a title="" href="product-detail.php"><img alt="" src="images/sp1.png" class="img-fluid" alt=""></a>
                                                <div class="readmore"><a title="" href="product-detail.php" class="mont" data-toggle="modal" data-target="#myModal">Mua ngay</a></div>
                                            </div>
                                            <div class="info">
                                                <h3><a title="" href="product-detail.php" class="mont">Tấm ốp PVC vân đá DV-204</a></h3>
                                                <div class="price">
                                                    <del>555.000 vnđ</del><span>300.000 vnđ</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="item text-center">
                                            <div class="avarta">
                                                <a title="" href="product-detail.php"><img alt="" src="images/sp3.png" class="img-fluid" alt=""></a>
                                                <div class="readmore"><a title="" href="product-detail.php" class="mont" data-toggle="modal" data-target="#myModal">Mua ngay</a></div>
                                            </div>
                                            <div class="info">
                                                <h3><a title="" href="product-detail.php" class="mont">Tấm ốp PVC vân đá DV-204</a></h3>
                                                <div class="price">
                                                    <del>555.000 vnđ</del><span>300.000 vnđ</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="item text-center">
                                            <div class="avarta">
                                                <a title="" href="product-detail.php"><img alt="" src="images/sp5.png" class="img-fluid" alt=""></a>
                                                <div class="readmore"><a title="" href="product-detail.php" class="mont" data-toggle="modal" data-target="#myModal">Mua ngay</a></div>
                                                <div class="status"><a title="" href="javascript:0" class="sale mont">sale</a></div>
                                            </div>
                                            <div class="info">
                                                <h3><a title="" href="product-detail.php" class="mont">Tấm ốp PVC vân đá DV-204</a></h3>
                                                <div class="price">
                                                    <del>555.000 vnđ</del><span>300.000 vnđ</span>
                                                </div>
                                            </div>
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
