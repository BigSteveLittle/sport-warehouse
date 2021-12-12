# Sports Warehouse Static Website Plan
#### Sports Warehouse Website
Index Page [[Index - Sports Warehouse Website]]
- - - -
## HTML
* body
	* div.content-wrapper - max-width 1000px
		* header#page-header
			* div#nav-bar flexbox
				* nav#site-nav flexbox
					* button.menu-btn.mobile-only type=“checkbox” id=“menu-btn” [mobile-only]
						* label.menu-icon.mobile-only for”menu-button” [mobile-only]
							* span.nav-icon
					* ul 
						* li x 5 
							* a.mobile-only link - ‘Login’ [mobile-only]
							* a link - ‘Home’
							* a link - ‘About SW’
							* a link - ‘Contact Us’
							* a link - ‘View Products’
				* div.shopping-links - flexbox
					* a.desktop-only - ‘Login’ [desktop-only]
					* a - ‘View Cart’
					* a - ‘items’
			* a#h1-logo link
				* h1#page-header - 'Sports Warehouse'
			* nav#product-menu
				* ul
					* li x 7
		* div.slideshow.desktop-only [desktop-only]
			* section.product-overlay z-index:1 [desktop-only]
				* p.slide-info x 3 [desktop-only]
				* h2.slide-header x 3 [desktop-only]
				* button type="button" x 3 [desktop-only]
			* div.slide-image [desktop-only]
		* main#main-content
			* section.featured
				* h2 - 'Featured products'
					* article.product x 5
						* div.product-image
							* img
						* p.product-price
							* span.price - $79.95
							* span.sale - was $100.00 [sale-only]
						* h3.product-title
			* section.brands
				* h2 - 'Our brands and partnerships'
					* p.brand-promo
						* span.highlight-statement
				* ul.brand-links
					* li
						* a.brand-link
	* footer#page-footer
		* div#footer-bg - width 100%
			* div.content-wrapper - max-width 1000px - flexbox
				* nav.footer__site-nav.desktop-only [desktop-only]
					* h2 - 'Site navigation' [desktop-only]
						* ul [desktop-only]
							* li x 5 [desktop-only]
				* nav.footer__product-nav.desktop-only [desktop-only]
					* h2 - 'Product categories' [desktop-only]
						* ul [desktop-only]
							* li x 7 [desktop-only]
				* nav.footer__contact-nav
					* h2'Contact Sports Warehouse'
						* a link - icon + ‘Facebook’ 
						* a link - icon + ‘Twitter’
						* a link - icon + ‘Other’
							* ul
								* li
									* a.contact-nav__other-link x 4
		* div.content-wrapper - max-width 1000px
			* p.copyright
				* small.copyright__text

## Accessibility
* Icon only links or buttons, for screen readers use a .screen-read class to hide the text from view but remain for screen readers.

## CSS
* Mobile first -> Tablet -> Desktop.
* CSS normalisation.
* Globally set: box-sizing to border-box.
* Class .content-wrapper applied to header content and footer.
* Footer BG wrapper to extend colour across 100%.
* Product border link to have hover and active applied with drop shadow (distance: 1px, spread: 0%, size: 4px) [desktop only].
* General links text-decoration: none;.
* Use input checkbox + CSS for mobile menu.
* For BG headings and menus, border-radius for top left and bottom left rounded.
- - - -
## Colors
Logo and BG highlight [#00aced Cyan Process].
Logo, heading BG and sale price text [#ff6d0c Pumpkin].
Menu BG, brands link BG and footer contact links [#002936 Gunmetal].
Headings and link text [#ffffff White].
Product title text [#006989 Blue Sapphire].
Product price text [#595959 Davys Grey].
Shopping cart items BG [#0092ca Blue NCS].

## Fonts
**Open Sans** Google font via Adobe TypeKit
LINK: <link rel=“stylesheet” href=“https://use.typekit.net/llx6kjr.css”>
font-size: 1em;  /* 16px base paragraph text (based on 16px default) */
- - - -
font-family: 'Open Sans', arial, sans-serif;
font-weight: 400; Regular
font-style: normal;
* 1.375em/22px - product price text
* 1.125em/18px - featured and brand heading text
* 0.938em/15px - product name text
* 1em/16px - search text - product menu text - sale former price text
* 0.875em/14px - site-menu text - footer menu link text
* 0.813em/13px - items count text
* 0.75em/12px - copyright text
* 0.688em/11px - ‘WAS’ sale text
- - - -
font-family: 'Open Sans', arial, sans-serif;
font-weight: 300; Light
font-style: normal;
* 2.5em/40px - slideshow title text [desktop]
* 1.375em/22px - footer navigation heading text
* 1.125em18px - slideshow promo and button text [desktop]
* 1em/16px - base paragraph
* 0.938em/15px - social media link text
- - - -
**Font Awesome icons**
LINK: <script src=“https://kit.fontawesome.com/1ac9e13ece.js” crossorigin=“anonymous”></script>
* fa-shopping-cart - <I class=“fas fa-shopping-cart”></I>
* fa-lock - <I class=“fas fa-lock”></I>
* fa-facebook-f - <I class=“fab fa-facebook-f”></I>
* fa-twitter - <I class=“fab fa-twitter”></I>
* fa-paper-plane - <I class=“fas fa-paper-plane”></I>
- - - -
#### Sports Warehouse Website
- - - -
Index Page [[Index - Sports Warehouse Website]]
- - - -
#sportsWarehouse