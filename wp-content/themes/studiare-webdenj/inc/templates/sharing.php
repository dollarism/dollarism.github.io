<?php



?>

<div class="post-share-btn affix" data-spy="affix">
        <a href="https://telegram.me/share/url?url=<?php the_permalink() ?>&text=<?php the_title(); ?>" target="_blank" data-tooltip="اشتراک گذاری در تلگرام">
            <i class="fa fa-paper-plane"></i>
        </a>
        <a href="http://twitter.com/home/?status=<?php the_title(); ?> - <?php the_permalink(); ?>" target="_blank" data-tooltip="اشتراک گذاری در توئیتر">
            <i class="fa fa-twitter"></i>
        </a>
        <a href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?php echo urlencode(get_permalink()); ?>" target="_blank" data-tooltip="اشتراک گذاری در فیسبوک">
            <i class="fa fa-facebook"></i>
        </a>
        <a href="https://web.whatsapp.com/send?text=<?php the_permalink(); ?>" target="_blank" data-tooltip="اشتراک گذاری در واتساپ">
            <i class="fa fa-whatsapp"></i>
        </a>

                </div>
