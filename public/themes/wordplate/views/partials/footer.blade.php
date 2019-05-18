<footer class="sticky-footer bg-dark">
    <div class="bottom-contact gradient gradient-six py-4 py-md-0">
        <div class="container">
            <div class="row d-flex flex-wrap justify-content-center align-items-center">
                <div class="col-sm col-md-auto p-4 px-md-5 text-center" >
                    <p class="footer-headline m-0">Connect with us</p>
                    <social-icons :size="35" :margin=".25" class="d-flex justify-content-center footer-social" ></social-icons>
                </div>
                <div class="col-sm col-md-auto p-4 px-md-5 text-center" >
                    <p class="footer-headline m-0">Give us a call</p>
                    <p class="footer-phone"><a href="tel:{{ get_field('phone', 'option') }}">{{ get_field('phone', 'option') }}</a></p>
                </div>
                <div class="col-sm col-md-auto p-4 px-md-5 text-center" >
                    <a class="btn btn-lg btn-outline-light" href="/partners/" >Partners</a>
                </div>
                <div class="col-sm col-md-auto col-lg-3 p-4 px-md-5 text-center" >
                    <a href="http://visitflorida.com/" target="_blank" ><img v-lazy="'/themes/wordplate/assets/images/visit-florida-logo.png'" class="img-fluid" width="189" ></a>
                </div>
            </div>    
        </div>
    </div>
    <div class="bg-secondary py-2">
        <p class="copyright text-center">&copy;{{ date('Y') }} {{ get_bloginfo() }}. All Rights&nbsp;Reserved. 
            <a style="text-decoration:underline;" href="/privacy-policy" >Privacy&nbsp;Policy</a> 
            <span class="siteby">
                <svg version="1.1" id="kma" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="14" width="20"
                    viewBox="0 0 12.5 8.7" style="enable-background:new 0 0 12.5 8.7;"
                    xml:space="preserve">
                        <path fill="#b4be35"
                    d="M6.4,0.1c0,0,0.1,0.3,0.2,0.9c1,3,3,5.6,5.7,7.2l-0.1,0.5c0,0-0.4-0.2-1-0.4C7.7,7,3.7,7,0.2,8.5L0.1,8.1 c2.8-1.5,4.8-4.2,5.7-7.2C6,0.4,6.1,0.1,6.1,0.1H6.4L6.4,0.1z"></path>
                </svg> &nbsp;<a href="https://keriganmarketing.com">Site&nbsp;by&nbsp;KMA</a>.
            </span></p>
    </div>
</footer>