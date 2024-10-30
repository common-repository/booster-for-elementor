<?php 
//Booster Addons Widgets Bundle
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_Widgets_Bundle_Free{
    
    public static function get_all_widgets(){
        return [
            [
                'name' => 'advanced heading',
                'id' => 'advanced-heading',
                'icon' => 'eicon-heading',
                'type' => 'freemium',
                'description' => esc_html__('advanced heading with a title , an optional link and unlimited styling.', 'booster-addons'),                
                'categories' => ['content','fancy'],
                'class_name' => 'ELB_Heading_Widget'
            ],
            [
                'name' => 'icon box info',
                'id' => 'icon-box',
                'icon' => 'eicon-icon-box',
                'type' => 'freemium',
                'description' => esc_html__('list your different products or services features and descriptions.', 'booster-addons'),                
                'categories' => ['content','promoting'],
                'class_name' => 'ELB_IconBox_Widget'
            ],
            [
                'name' => 'card flip',
                'id' => 'card-flip',
                'icon' => 'eicon-flip-box',
                'type' => 'freemium',
                'description' => esc_html__('a great tool to display information with its double sides feature.', 'booster-addons'),                
                'categories' => ['content','fancy','promoting'],
                'class_name' => 'ELB_CardFlip_Widget'
            ],
            [
                'name' => 'advanced button',
                'id' => 'advanced-button',
                'icon' => 'eicon-button',
                'type' => 'freemium',
                'description' => esc_html__('style your buttons with endless possibilities.', 'booster-addons'),                
                'categories' => ['content','promoting'],
                'class_name' => 'ELB_AdvancedButton_Widget'
            ],
            [
                'name' => 'image banner',
                'id' => 'image-banner',
                'icon' => 'eicon-image-rollover',
                'type' => 'freemium',
                'description' => esc_html__('make a custom space in your page around a background image.', 'booster-addons'),                
                'categories' => ['media','promoting','content'],
                'class_name' => 'ELB_ImageBanner_Widget'
            ],
            [
                'name' => 'pricing plan',
                'id' => 'pricing-plan',
                'icon' => 'eicon-product-price',
                'type' => 'freemium',
                'description' => esc_html__('Showcase your products and service plans with custom & unique styles.', 'booster-addons'),                
                'categories' => ['promoting','fancy'],
                'class_name' => 'ELB_PricingPlan_Widget'
            ],
            [
                'name' => 'testimonial',
                'id' => 'testimonial',
                'icon' => 'eicon-testimonial',
                'type' => 'freemium',
                'description' => esc_html__('a great way to display testimonials of your clients.', 'booster-addons'),                
                'categories' => ['content','slider'],
                'class_name' => 'ELB_Testimonial_Widget'
            ],
            [
                'name' => 'single icon',
                'id' => 'single-icon',
                'icon' => 'eicon-hypster',
                'type' => 'freemium',
                'description' => esc_html__('a set of customizable icons with multiple hover effects and styling.', 'booster-addons'),                
                'categories' => ['other'],
                'class_name' => 'ELB_SingleIcon_Widget'
            ],
            [
                'name' => 'interactive iconbox',
                'id' => 'interactive-iconbox',
                'icon' => 'eicon-icon-box',
                'type' => 'freemium',
                'description' => esc_html__('a modern element with an icon and title that displays a text on hover.', 'booster-addons'),                
                'categories' => ['fancy','promoting','content'],
                'class_name' => 'ELB_InteractiveIconBox_Widget'
            ],
            [
                'name' => 'iconbox action',
                'id' => 'iconbox-action',
                'icon' => 'eicon-info-box',
                'type' => 'freemium',
                'description' => esc_html__('display information with multiple styles using icons and text.', 'booster-addons'),                
                'categories' => ['fancy','promoting','content'],
                'class_name' => 'ELB_IconBoxAction_Widget'
            ],
            [
                'name' => 'modern video',
                'id' => 'modern-video',
                'icon' => 'eicon-play',
                'type' => 'freemium',
                'description' => esc_html__('display videos on your website with a modern layout.', 'booster-addons'),                
                'categories' => ['media'],
                'class_name' => 'ELB_ModernVideo_Widget'
            ],
            [
                'name' => 'scroll image',
                'id' => 'scroll-image',
                'icon' => 'eicon-scroll',
                'type' => 'premium',
                'description' => esc_html__('offers multiple ways to showcase your images using a scrolling effect.', 'booster-addons'),                
                'categories' => ['media','fancy'],
                'class_name' => 'ELB_ScrollImage_Widget'
            ],
            [
                'name' => 'business hours',
                'id' => 'business-hours',
                'icon' => 'eicon-table',
                'type' => 'premium',
                'description' => esc_html__('display your working hours with different styles.', 'booster-addons'),                
                'categories' => ['promoting','content'],
                'class_name' => 'ELB_BusinessHours_Widget'
            ],
            [
                'name' => 'list infobox',
                'id' => 'list-infobox',
                'icon' => 'eicon-editor-list-ul',
                'type' => 'freemium',
                'description' => esc_html__('make a list with a combination of icons, titles, and text.', 'booster-addons'),                
                'categories' => ['content'],
                'class_name' => 'ELB_ListInfoBox_Widget'
            ],
            [
                'name' => 'skill bar',
                'id' => 'skill-bar',
                'icon' => 'eicon-skill-bar',
                'type' => 'premium',
                'description' => esc_html__('display the level of proficiency in a skill by using percentages.', 'booster-addons'),                
                'categories' => ['fancy'],
                'class_name' => 'ELB_SkillBar_Widget'
            ],
            [
                'name' => 'counter',
                'id' => 'counter',
                'icon' => 'eicon-counter',
                'type' => 'freemium',
                'description' => esc_html__('create visual statistics about anything.', 'booster-addons'),                
                'categories' => ['content'],
                'class_name' => 'ELB_Counter_Widget'
            ],
            [
                'name' => 'modal window',
                'id' => 'modal-window',
                'icon' => 'eicon-call-to-action',
                'type' => 'freemium',
                'description' => esc_html__('display extra information as a pop-up.', 'booster-addons'),                
                'categories' => ['content'],
                'class_name' => 'ELB_ModalWindow_Widget'
            ],
            [
                'name' => 'image comparison',
                'id' => 'image-comparison',
                'icon' => 'eicon-image-before-after',
                'type' => 'premium',
                'description' => esc_html__('show a transformation using a hover effect and two images.', 'booster-addons'),                
                'categories' => ['media','fancy'],
                'class_name' => 'ELB_ImageComparison_Widget'
            ],
            [
                'name' => 'social find us',
                'id' => 'social-find-us',
                'icon' => 'eicon-social-icons',
                'type' => 'freemium',
                'description' => esc_html__('display information about you such as social media or portfolio links.', 'booster-addons'),                
                'categories' => ['promoting'],
                'class_name' => 'ELB_SocialFindUs_Widget'
            ],
            [
                'name' => 'social share',
                'id' => 'social-share',
                'icon' => 'eicon-share',
                'type' => 'freemium',
                'description' => esc_html__('add social share buttons to share the current page.', 'booster-addons'),                
                'categories' => ['promoting'],
                'class_name' => 'ELB_SocialShare_Widget'
            ],
            [ 
                'name' => 'drop caps',
                'id' => 'drop-caps',
                'icon' => 'eicon-editor-bold',
                'type' => 'freemium',
                'description' => esc_html__('style your paragraphs using the first letter.', 'booster-addons'),                
                'categories' => ['content'],
                'class_name' => 'ELB_DropCaps_Widget'
            ],
            [
                'name' => 'image swap',
                'id' => 'image-swap',
                'icon' => 'eicon-image-rollover',
                'type' => 'freemium',
                'description' => esc_html__('switch between two images using multiple hover effects and styles.', 'booster-addons'),                
                'categories' => ['media','fancy'],
                'class_name' => 'ELB_ImageSwap_Widget'
            ],
            [
                'name' => 'fullscreen content slider',
                'id' => 'fullscreen-content-slider',
                'icon' => 'eicon-post-slider',
                'type' => 'freemium',
                'description' => esc_html__('creative content and post type slider, with amazing effect and layouts.', 'booster-addons'),                
                'categories' => ['media','fancy','content','slider'],
                'class_name' => 'ELB_FullScreenContentSlider_Widget'
            ],
            [   'name' => 'animated heading',
                'id' => 'animated-heading',
                'icon' => 'eicon-animated-headline',
                'type' => 'freemium',
                'description' => esc_html__('create fancy headings using different styles and animations.', 'booster-addons'),                
                'categories' => ['fancy','content'],
                'class_name' => 'ELB_AnimatedHeading_Widget'
            ],
            [
                'name' => 'dual heading',
                'id' => 'dual-heading',
                'icon' => 'eicon-heading',
                'type' => 'premium',
                'description' => esc_html__('advanced dual heading with custom colors & styles.', 'booster-addons'),                
                'categories' => ['content','fancy'],
                'class_name' => 'ELB_DualHeading_Widget'
            ],
            [
                'name' => 'alert box',
                'id' => 'alert-box',
                'icon' => 'eicon-alert',
                'type' => 'freemium',
                'description' => esc_html__('a great way to display messages or a notice to your visitors.', 'booster-addons'),                
                'categories' => ['content'],
                'class_name' => 'ELB_AlertBox_Widget'
            ],
            [
                'name' => 'modern flip box',
                'id' => 'modern-flipbox',
                'icon' => 'eicon-flip-box',
                'type' => 'premium',
                'description' => esc_html__('element with a front and back sides that flips on hover.', 'booster-addons'),                
                'categories' => ['fancy','content','promoting'],
                'class_name' => 'ELB_ModernFlipBox_Widget'
            ],
            [
                'name' => '3D card flip',
                'id' => 'threecard-flip',
                'icon' => 'eicon-flip-box',
                'type' => 'freemium',
                'description' => esc_html__('element with front and back sides that flips on hover with 3D effects.', 'booster-addons'),                
                'categories' => ['content','promoting'],
                'class_name' => 'ELB_ThreeCardFlip_Widget'
            ],
            [
                'name' => 'layered images',
                'id' => 'layered-images',
                'icon' => 'eicon-navigator',
                'type' => 'premium',
                'description' => esc_html__('showcase your images in a unique and stylish manner.', 'booster-addons'),                
                'categories' => ['media','fancy'],
                'class_name' => 'ELB_LayeredImages_Widget'
            ],
            [
                'name' => 'radial progress',
                'id' => 'radial-progress',
                'icon' => 'eicon-counter-circle',
                'type' => 'premium',
                'description' => esc_html__('draw a circular progress indicator with percentages text display.', 'booster-addons'),                
                'categories' => ['content','fancy'],
                'class_name' => 'ELB_RadialProgress_Widget'
            ],
            [
                'name' => 'fancy icon box',
                'id' => 'fancy-iconbox',
                'icon' => 'eicon-info-box',
                'type' => 'premium',
                'description' => esc_html__('display your data in a fancy way using multiple layouts.', 'booster-addons'),                
                'categories' => ['fancy','content','promoting','media'],
                'class_name' => 'ELB_fancyIconBox_Widget'
            ],
            [
                'name' => 'image card slider',
                'id' => 'image-cardslider',
                'icon' => 'eicon-photo-library',
                'type' => 'premium',
                'description' => esc_html__('display multiple images in the same space with this slider.', 'booster-addons'),                
                'categories' => ['slider','media'],
                'class_name' => 'ELB_ImageCardSlider_Widget'
            ],
            [
                'name' => 'hover info box',
                'id' => 'hover-infobox',
                'icon' => 'eicon-info-box',
                'type' => 'premium',
                'description' => esc_html__('add style to you data with these cool hover effects.', 'booster-addons'),                
                'categories' => ['content','fancy','promoting'],
                'class_name' => 'ELB_HoverInfoBox_Widget'
            ],
            [
                'name' => 'block quotes',
                'id' => 'block-quotes',
                'icon' => 'eicon-blockquote',
                'type' => 'premium',
                'description' => esc_html__('display reviews for your clients with unique design.', 'booster-addons'),                
                'categories' => ['content'],
                'class_name' => 'ELB_BlockQuotes_Widget'
            ],
            [
                'name' => 'vertical skillbar',
                'id' => 'vertical-skillbar',
                'icon' => 'eicon-skill-bar',
                'type' => 'freemium',
                'description' => esc_html__('display your data as a percentage using a vertical bar/indicator.', 'booster-addons'),                
                'categories' => ['content'],
                'class_name' => 'ELB_VerticalSkillBar_Widget'
            ],
            [
                'name' => 'interactive carousel',
                'id' => 'interactive-carousel',
                'icon' => 'eicon-slider-3d',
                'type' => 'premium',
                'description' => esc_html__('slide your images with a modern and unique effect.', 'booster-addons'),                
                'categories' => ['slider','media','fancy'],
                'class_name' => 'ELB_InteractiveCarousel_Widget'
            ],
            [
                'name' => 'hotspot image',
                'id' => 'hotspot-image',
                'icon' => 'eicon-image-hotspot',
                'type' => 'premium',
                'description' => esc_html__('display your data on an image using hotspot information.', 'booster-addons'),                
                'categories' => ['media','fancy'],
                'class_name' => 'ELB_HotspotImage_Widget'
            ],
            [
                'name' => 'modal video',
                'id' => 'modal-video',
                'icon' => 'eicon-slider-video',
                'type' => 'premium',
                'description' => esc_html__('display your videos as a pop-up using a button click.', 'booster-addons'),                
                'categories' => ['media'],
                'class_name' => 'ELB_ModalVideo_Widget'
            ],
            [
                'name' => 'perspective card',
                'id' => 'perspective-card',
                'icon' => 'eicon-parallax',
                'type' => 'premium',
                'description' => esc_html__('display your data in a very fancy way with the perspective card.', 'booster-addons'),                
                'categories' => ['fancy','content','promoting'],
                'class_name' => 'ELB_PerspectiveCard_Widget'
            ],
            [
                'name' => 'countdown',
                'id' => 'countdown',
                'icon' => 'eicon-countdown',
                'type' => 'freemium',
                'description' => esc_html__('represent the remaining time before the start of an event.', 'booster-addons'),                
                'categories' => ['content'],
                'class_name' => 'ELB_CountDown_Widget'
            ],
            [
                'name' => 'team member',
                'id' => 'team-member',
                'icon' => 'eicon-person',
                'type' => 'premium',
                'description' => esc_html__('display your team members using multiple fancy effects and layouts.', 'booster-addons'),                
                'categories' => ['content','media'],
                'class_name' => 'ELB_TeamMember_Widget'
            ],
            [
                'name' => 'price box',
                'id' => 'price-box',
                'icon' => 'eicon-price-table',
                'type' => 'premium',
                'description' => esc_html__('put your prices on your plans using multiple style effects and combinations.', 'booster-addons'),                
                'categories' => ['promoting','content'],
                'class_name' => 'ELB_PriceBox_Widget'
            ],
            [
                'name' => 'fancy text',
                'id' => 'fancy-text',
                'icon' => 'eicon-animation-text',
                'type' => 'premium',
                'description' => esc_html__('add visual effects and animations to your page text & titles.', 'booster-addons'),                
                'categories' => ['fancy','content'],
                'class_name' => 'ELB_fancyText_Widget'
            ],
            [
                'name' => 'modern image',
                'id' => 'modern-image',
                'icon' => 'eicon-image-rollover',
                'type' => 'freemium',
                'description' => esc_html__('show content on your images with unique hover effects.', 'booster-addons'),                
                'categories' => ['media','content'],
                'class_name' => 'ELB_ModernImage_Widget'
            ],
            [
                'name' => 'modal anything',
                'id' => 'modal-anything',
                'icon' => 'eicon-call-to-action',
                'type' => 'freemium',
                'description' => esc_html__('display your data with a pop-up and anything can be used.', 'booster-addons'),                
                'categories' => ['content'],
                'class_name' => 'ELB_ModalAnything_Widget'
            ],
            [
                'name' => 'toggle content',
                'id' => 'toggle-content',
                'icon' => 'eicon-dual-button',
                'type' => 'premium',
                'description' => esc_html__('toggle between two different data areas in the same space.', 'booster-addons'),                
                'categories' => ['content'],
                'class_name' => 'ELB_ToggleContent_Widget'
            ],
            [
                'name' => 'filter images',
                'id' => 'filter-images',
                'icon' => 'eicon-gallery-masonry',
                'type' => 'premium',
                'description' => esc_html__('display images using filters that you define.', 'booster-addons'),                
                'categories' => ['media'],
                'class_name' => 'ELB_FilterImages_Widget'
            ],
            [
                'name' => 'light box gallery',
                'id' => 'lightbox-gallery',
                'icon' => 'eicon-gallery-grid',
                'type' => 'premium',
                'description' => esc_html__('display your gallery with filters and lightbox capabilities.', 'booster-addons'),                
                'categories' => ['media','slider','fancy'],
                'class_name' => 'ELB_LightBoxGallery_Widget'
            ],
            [
                'name' => 'testimonial slider',
                'id' => 'testimonial-slider',
                'icon' => 'eicon-review',
                'type' => 'premium',
                'description' => esc_html__('showcase your clients testimonials using this slider.', 'booster-addons'),                
                'categories' => ['slider','content'],
                'class_name' => 'ELB_TestimonialSlider_Widget'
            ],
            [
                'name' => 'block quotes slider',
                'id' => 'blockquotes-slider',
                'icon' => 'eicon-testimonial-carousel',
                'type' => 'premium',
                'description' => esc_html__('display reviews from your clients on your website.', 'booster-addons'),                
                'categories' => ['slider','content'],
                'class_name' => 'ELB_BlockQuotesSlider_Widget'
            ],
            [
                'name' => 'team slider',
                'id' => 'team-slider',
                'icon' => 'eicon-carousel',
                'type' => 'premium',
                'description' => esc_html__('showcase your team members in the same space using this slider.', 'booster-addons'),                
                'categories' => ['slider','content','media'],
                'class_name' => 'ELB_TeamSlider_Widget'
            ],
            [
                'name' => 'showcase image',
                'id' => 'showcase-image',
                'icon' => 'eicon-featured-image',
                'type' => 'premium',
                'description' => esc_html__('showcase your image and display some text with fancy hover effects.', 'booster-addons'),                
                'categories' => ['media','content','promoting'],
                'class_name' => 'ELB_ShowcaseImage_Widget'
            ],
            [
                'name' => 'filter showcase images',
                'id' => 'filter-showcaseimages',
                'icon' => 'eicon-gallery-masonry',
                'type' => 'premium',
                'description' => esc_html__('showcase your images using filters and display some text fancy effects.', 'booster-addons'),                
                'categories' => ['media'],
                'class_name' => 'ELB_FilterShowCaseImages_Widget'
            ],
            [
                'name' => 'filter scroll images',
                'id' => 'filter-scrollimages',
                'icon' => 'eicon-gallery-masonry',
                'type' => 'premium',
                'description' => esc_html__('display your images using a scrolling effect and filters.', 'booster-addons'),                
                'categories' => ['media'],
                'class_name' => 'ELB_FilterScrollImages_Widget'
            ],
            [
                'name' => 'testimonial group',
                'id' => 'testimonial-group',
                'icon' => 'eicon-testimonial-carousel',
                'type' => 'premium',
                'description' => esc_html__('display clients testimonials in the same space using this container.', 'booster-addons'),                
                'categories' => ['content','slider'],
                'class_name' => 'ELB_TestimonialGroup_Widget'
            ],
            [
                'name' => 'price listing',
                'id' => 'price-listing',
                'icon' => 'eicon-price-list',
                'type' => 'freemium',
                'description' => esc_html__('showcase your products in a list with a modern and simple way.', 'booster-addons'),                
                'categories' => ['promoting','content'],
                'class_name' => 'ELB_PriceListing_Widget'
            ],
            [
                'name' => 'side navigation',
                'id' => 'side-navigation',
                'icon' => 'eicon-sidebar',
                'type' => 'freemium',
                'description' => esc_html__('add side one single page navigation your pages.', 'booster-addons'),                
                'categories' => ['content'],
                'class_name' => 'ELB_SideNavigation_Widget'
            ],
            [
                'name' => 'simple images slider',
                'id' => 'simpleimages-slider',
                'icon' => 'eicon-slider-push',
                'type' => 'premium',
                'description' => esc_html__('show case images in an advanced and styling carousel slider.', 'booster-addons'),                
                'categories' => ['slider','media'],
                'class_name' => 'ELB_SimpleImagesSlider_Widget'
            ],
            [
                'name' => 'static template',
                'id' => 'static-template',
                'icon' => 'eicon-library-save',
                'type' => 'premium',
                'description' => esc_html__('insert a static elementor template to your pages.', 'booster-addons'),                
                'categories' => ['content'],
                'class_name' => 'ELB_StaticTemplate_Widget'
            ],
            [
                'name' => 'static template tabs',
                'id' => 'static-templates-tabs',
                'icon' => 'eicon-library-save',
                'type' => 'premium',
                'description' => esc_html__('insert tabs with text or static templates.', 'booster-addons'),                
                'categories' => ['content'],
                'class_name' => 'ELB_StaticTemplatesTabs_Widget'
            ],
            [
                'name' => 'creative content slider',
                'id' => 'creative-content-slider',
                'icon' => 'eicon-post-slider',
                'type' => 'premium',
                'description' => esc_html__('Amazing full screen content slider with custom animation and affects.', 'booster-addons'),                
                'categories' => ['media','fancy','content','slider'],
                'class_name' => 'ELB_CreativeContentSlider_Widget'
            ], 
            [
                'name' => 'Woo Modern Products',
                'id' => 'woomodernproduct',
                'icon' => 'eicon-woocommerce',
                'type' => 'freemium',
                'widget_type' => 'ptypes',
                'woocommerce' => true,
                'description' => esc_html__('creative WooCommerce product widget, with custom styling and hover effects.', 'booster-addons'),                
                'categories' => ['content'],
                'class_name' => 'ELB_WooModernProduct_Widget'
            ],
            [
                'name' => 'Woo List Products',
                'id' => 'woolistproduct',
                'icon' => 'eicon-woocommerce',
                'type' => 'freemium',
                'widget_type' => 'ptypes',
                'woocommerce' => true,
                'description' => esc_html__('WooCommerce products list with custom styling and product images lightbox.', 'booster-addons'),                
                'categories' => ['content'],
                'class_name' => 'ELB_WooListProduct_Widget'
            ],
            [
                'name' => 'Woo Categories',
                'id' => 'woocategories',
                'icon' => 'eicon-woocommerce',
                'type' => 'freemium',
                'widget_type' => 'ptypes',
                'woocommerce' => true,
                'description' => esc_html__('WooCommerce categories list with background images and hover effects.', 'booster-addons'),                
                'categories' => ['content'],
                'class_name' => 'ELB_WooCategories_Widget'
            ],
            [
                'name' => 'Woo Advanced Products',
                'id' => 'wooadvancedproducts',
                'icon' => 'eicon-woocommerce',
                'type' => 'premium',
                'widget_type' => 'ptypes',
                'woocommerce' => true,
                'description' => esc_html__('WooCommerce products list with advanced lightbox and filter options.', 'booster-addons'),                
                'categories' => ['content'],
                'class_name' => 'ELB_WooAdvancedProducts_Widget'
            ],
            [
                'name' => 'Woo Products Slider',
                'id' => 'wooproductslider',
                'icon' => 'eicon-woocommerce',
                'type' => 'premium',
                'widget_type' => 'ptypes',
                'woocommerce' => true,
                'description' => esc_html__('WooCommerce products slider with custom styling and settings.', 'booster-addons'),                
                'categories' => ['content'],
                'class_name' => 'ELB_WooProductSlider_Widget'
            ]     


        ];
    }
}