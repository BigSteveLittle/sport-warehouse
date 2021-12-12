                        <nav class="footer__contact-nav">
                            <h2>Contact Sports Warehouse</h2>
                                <div class="social-media">
                                    <a href="https://www.facebook.com/sportswarehouse.sydney" target="_blank">
                                        <div class="social-media__link">
                                            <div class="social-media__icon">
                                                <i class="fas fa-facebook-f"></i>
                                            </div>
                                            <h3>Facebook</h3>
                                        </div>
                                    </a>
                                    <a href="https://twitter.com/sportswarehous6" target="_blank">
                                        <div class="social-media__link">
                                            <div class="social-media__icon">
                                                <i class="fas fa-twitter"></i>
                                            </div>
                                            <h3>Twitter</h3>
                                        </div>
                                    </a>
                                    <div class="contact-links">
                                        <a href="contact-sports-warehouse.php">
                                            <div class="social-media__link">
                                                <div class="social-media__icon">
                                                    <i class="fab fa-telegram-plane"></i>
                                                </div>
                                                <h3>Other</h3>
                                            </div>
                                        </a>
                                        <ul class="desktop-only">
                                            <li><a href="contact-sports-warehouse.php">Online form</a></li>
                                            <li><a href="contact-sports-warehouse.php">Email</a></li>
                                            <li><a href="contact-sports-warehouse.php">Phone</a></li>
                                            <li><a href="contact-sports-warehouse.php">Address</a></li>
                                        </ul>
                                    </div>
                                </div>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="content-wrapper">
                <p class="copyright"><small class="copyright__text">&copy; Copyright 2021 Sports Warehouse. <br>All rights reserved. <br>Website made by Awesomesauce Design. <br><a href="./administration/home.php" target="_blank">Administration Login</a></small></p>
            </div>
        </footer>
        <!-- Include jQuery library. -->
        <script
                src="https://code.jquery.com/jquery-3.6.0.js"
                integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
                crossorigin="anonymous">
        </script>
    <!-- Include slick js code.  -->
        <script src="3rd-party/slick-1.8.1/slick.min.js"></script>
    <!-- Include custom code here.  -->
        <script>
        // '$' is the reference for 'jQuery'.
        // Wait un till the page has finished loading (ie ready) before running the JS code.
        $(document).ready(function(){
            // Find '.slickjs' and activate the slideshow option.
            $('.sportswh-slide').slick({
                // setting-name: setting-value,
                autoplay: true,
                autoplaySpeed: 2000,
                speed: 500,
                fade: true,
                dots: true,
                arrows: false,
                pauseOnFocus: true,
                pauseOnHover: true,
            });
        });
        </script>
    <!-- Contact form JS code. -->
        <script src="./js/checkout-app.js"></script>
        <script src="./js/contact-app.js"></script>
    </body>
</html>