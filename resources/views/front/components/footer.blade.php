<footer class="footer">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-5">
                    <div class="widget">
                        <img src="{{ asset('assets/logos/rayat-logo.png') }}" class="footer-logo" alt="Footer Logo" width="105" height="25">
                         <h6>Rayat Boutique &amp; Craft Limited </h6>
                         <p class="mb-1">Factory & Head Office- Dhorompur, Bogura Sadar, Bogura-5800</p>
                         <p class="mb-2">Dhaka Office- House#30, Road#11, Kallyanpur, Dhaka-1216</p>
                         <p>Help Line: +8809644776611</p>
                         <p>Help Line: +8809649776611</p>
                         <p>Mobile: +8801920776611(WhatsApp & Imo)</p>
                         <p>Email: customercare@rayat.com.bd </p>

                        <div class="social-icons mt-4">
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
                        $column = $loop->index === 1 ? '3' : '2';
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
            <p class="footer-copyright text-md">Copyright © {{ date('Y') }} {{ request()->getHttpHost() }}. All Rights Reserved.</p><!-- End .footer-copyright -->
            <figure class="footer-payments">
                <img src="{{ asset('assets/images/aamarpay.png') }}" alt="Payment methods">
            </figure><!-- End .footer-payments -->
        </div><!-- End .container -->
    </div><!-- End .footer-bottom -->
    <div class="container">
    
    </div>
</footer><!-- End .footer -->