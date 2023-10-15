
<div class="social-icons mt-4">
    @foreach($socialLinks as $socialLink)

        {{ dd($this->getMainDomain($socialLink->link)) }}
        <a href="https://www.facebook.com/rayatboutique" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
        <a href="https://twitter.com/rayatboutique" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
        <a href="https://www.instagram.com/rayatboutiquebd/" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
        <a href="https://www.youtube.com/@rayatBoutiquebd" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
        <a href="https://www.pinterest.com/rayatboutique/" class="social-icon" target="_blank" title="Pinterest"><i class="icon-pinterest"></i></a>
    @endforeach
</div><!-- End .soial-icons -->
