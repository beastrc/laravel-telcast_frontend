<div class="block-social-info">
    <ul class="list-inline p-0 m-0 music-play-lists">
        <li class="share">
            <span><i class="ri-share-fill"></i></span>
            <div class="share-box">
                <div class="d-flex align-items-center">
                    <a href="#!" target="_blank" class="share-ico">
                        <i class="ri-facebook-fill"></i>
                    </a>
                    <a href="#!" target="_blank" class="share-ico">
                        <i class="ri-twitter-fill"></i>
                    </a>
                    <a href="#!" target="_blank" class="share-ico">
                        <i class="ri-links-fill"></i>
                    </a>
                </div>
            </div>
        </li>
        <li class="btn-favorite @if(isFavorite($resource)) active @endif" data-id="{{ $resource->id }}" data-type="{{ urlencode(get_class($resource)) }}">
            <span><i class="ri-heart-fill"></i></span>
        </li>
        <li class="btn-list @if(isListed($resource)) active @endif" data-id="{{ $resource->id }}" data-type="{{ urlencode(get_class($resource)) }}">
            <span><i class="ri-add-line"></i></span>
        </li>
    </ul>
</div>