<?php 
    header('Content-type: application/xml');
    include 'index.php';
    
    use cms\managers\PageManager;
    

    $pageManager = new PageManager(Page::class, 'Page');
    $pages = $pageManager->read();

// configuration
    $url_prefix = 'http://localhost:8081/';
    $W3C_datetime_format_php = 'Y-m-d\TH:i:sP';
    $null_sitemap = '<urlset><url><loc></loc></url></urlset>';
    
    foreach($pages as $key=>$page) {
        $sitemapArray[$key]['url'] = $url_prefix . htmlspecialchars($page->getTitle());
        $d = new DateTime($page->getCreation_date());
        $sitemapArray[$key]['date_updated'] = $d->format($W3C_datetime_format_php);
}
    $output = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    echo $output;


foreach($sitemapArray as $url) { ?>
<url>
        <loc><?php print $url['url'] ?></loc>
        <lastmod><?php print $url['date_updated'] ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
</url>
<?php } ?>
</urlset>