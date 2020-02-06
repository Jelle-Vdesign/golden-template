<script type="application/ld+json">
    [{
        "@context" : "http://schema.org",
        "@type" : "Organization",
        "name" : "<?php echo OWNER?>",
        "url" : "<?php echo BASE_PATH?>",
        "email" : "<?php echo $tags['contact_email'][$langID]?>",
        "logo": "<?php echo STATIC_PATH.'/images/leo-vd_logo.jpg'?>",
        "address" : {
            "@type": "PostalAddress",
            "addressCountry": "Netherlands",
            "addressLocality": "<?php echo $tags['adres_plaats'][$langID]?>",
            "postalCode": "<?php echo $tags['adres_postcode'][$langID]?>",
            "streetAddress": "<?php echo $tags['adres_straat'][$langID]?> <?php echo $tags['adres_huisnummer'][$langID]?>"
        },
        "sameAs" : [
            "<?php echo $tags['social_facebook_1'][$langID]?>",
            "<?php echo $tags['social_instagram_1'][$langID]?>"
        ]
    }]
</script>