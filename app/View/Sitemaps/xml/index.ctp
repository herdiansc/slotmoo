<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url> 
        <loc><?php echo Router::url('/',true); ?></loc> 
        <changefreq>daily</changefreq> 
        <priority>1.0</priority> 
    </url> 
    <!-- static pages -->      
    <url> 
        <loc><?php echo Router::url('/',true); ?>pages/faq</loc> 
        <lastmod><?php echo $this->Time->toAtom(date('Y-m-d')); ?></lastmod> 
        <priority>0.8</priority> 
    </url> 
    <url> 
        <loc><?php echo Router::url('/',true); ?>pages/about</loc> 
        <lastmod><?php echo $this->Time->toAtom(date('Y-m-d')); ?></lastmod> 
        <priority>0.8</priority> 
    </url> 
    <url> 
        <loc><?php echo Router::url('/',true); ?>pages/terms</loc> 
        <lastmod><?php echo $this->Time->toAtom(date('Y-m-d')); ?></lastmod> 
        <priority>0.8</priority> 
    </url> 
    <!-- posts-->     
    <?php foreach ($listings as $listing):?> 
    <url> 
        <loc><?php echo Router::url('/',true).$listing['User']['slug'].'/ads/'.$listing['Listing']['id'].'/'.$listing['Listing']['slug']; ?></loc> 
        <lastmod><?php echo $this->Time->toAtom($listing['Listing']['modified']); ?></lastmod> 
        <priority>0.8</priority> 
    </url> 
    <?php endforeach; ?> 
</urlset> 
