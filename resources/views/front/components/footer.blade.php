<footer class="footer">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="widget widget-about">
                        <img src="{{ asset('assets/images/rayatboutiqe-logo.png') }}" class="footer-logo" alt="Footer Logo" width="105" height="25">
                         <h6>Rayat Boutique &amp; Craft Limited </h6>
                         <p>Help Line-+8809644776611</p>
                         <p>Help Line-+8809649776611</p>
                         <p>Mobile-+8801920776611(WhatsApp &amp; Imo)</p>
                         <p>Email- customercare@rayat.com.bd </p>

                        <div class="social-icons">
                            <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
                            <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
                            <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
                            <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
                            <a href="#" class="social-icon" target="_blank" title="Pinterest"><i class="icon-pinterest"></i></a>
                        </div><!-- End .soial-icons -->
                    </div><!-- End .widget about-widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                @php 
                    
                    $footer_columns = \App\Models\FooterColumn::published()->get();

                @endphp


                @foreach($footer_columns as $footer_column)

                    @php
                        $column = $footer_column === 'Policies' ? '4' : '2';
                    @endphp

                    <div class="col-sm-6 col-lg-{{ $column }}">
                        <div class="widget">
                            <h4 class="widget-title">{{ $footer_column->column_title }}</h4><!-- End .widget-title -->

                            <ul class="widget-list">
                                @php 
                                    
                                    $columns_attributes = \App\Models\FooterColumnAttribute::published()->where('footer_column_id', $footer_column->id)->get();

                                @endphp

                                @foreach($columns_attributes as $columns_attribute)
                                    <li><a href="{{ $columns_attribute->link }}">{{ $columns_attribute->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
                
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .footer-middle -->

    <div class="footer-bottom">
        <div class="container">
            <p class="footer-copyright">Copyright © {{ date('Y') }} {{ request()->getHttpHost() }}. All Rights Reserved.</p><!-- End .footer-copyright -->
            <figure class="footer-payments">
                <img src="assets/images/payments.png" alt="Payment methods" width="272" height="20">
            </figure><!-- End .footer-payments -->
        </div><!-- End .container -->
    </div><!-- End .footer-bottom -->
</footer><!-- End .footer -->