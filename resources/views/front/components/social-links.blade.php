
<div class="social-icons mt-4">
    @foreach($socialLinks as $socialLink)
        <a href="{{ $socialLink->link }}" class="social-icon" target="_blank" title="{{ $this->getMainDomain($socialLink->link) }}"><i class="icon-{{ $socialLink->name }}"></i></a>
    @endforeach
</div><!-- End .soial-icons -->
