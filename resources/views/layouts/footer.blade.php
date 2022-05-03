<footer class="pt-3 d-flex justify-content-center align-items-center flex-column">
    <div id="userfulLinks" class="row px-5 mx-5 mt-5">
        <div class="userFulLinksItem col-12 col-sm-6 col-lg-3" id="userfulLinkItem1">
            <p class="no-margins smallText">
                <img id="footer-logo" class="border border-light bg-light" src="{{ asset('assets/images/logo.svg') }}" alt="">
            </p>
            {{-- <p class="smallText">help@serviceadept.me</p>
            <p class="smallText">+1-111-111-1111</p> --}}
        </div>
        <div class="userFulLinksItem col-12 col-sm-6 col-lg-3" id="userfulLinkItem2">
            <p class="mediumBoldText">Service & Categories</p>
            <p class="smallText"><a href="{{ route('search', ['categories_filter' => [2]]) }}">Handy Man</a></p>
            <p class="smallText"><a href="{{ route('search', ['categories_filter' => [5]]) }}">Maid</a></p>
            <p class="smallText"><a href="{{ route('search', ['categories_filter' => [7]]) }}">AC Service</a></p>
        </div>
        <div class="userFulLinksItem col-12 col-sm-6 col-lg-3" id="userfulLinkItem3">
            <p class="mediumBoldText">Useful Links</p>
            <p class="smallText"><a href="{{ route('home') }}">Homepage</a></p>
            <p class="smallText"><a href="{{ route('team') }}" >About Us</a></p>
            {{-- <p class="smallText"><a href="">Help</a></p> --}}
            <p class="smallText"><a href="#" onclick="$('#get-help-form').show(200);">Contact Us</a></p>
        </div>
        <div class="userFulLinksItem col-12 col-sm-6 col-lg-3" id="userfulLinkItem4">
            <p class="mediumBoldText">Help & Information</p>
            <p class="smallText"><a href="">FAQ's</a></p>
            <p class="smallText"><a href="">Terms and Condition</a></p>
            <p class="smallText"><a href="">Privacy Policy</a></p>
            <p class="smallText"><a href="">Refund Policy</a></p>
        </div>
    </div>
    <div>
        <div id="sep"></div>
        <div class="copyrightContainer d-flex justify-content-center align-items-center flex-column">
            <p class="smallText no-margins">Copyright ©{{ date('Y') }} {{ config('app.name', 'Service Adept') }}. All Rights Reserved.</p>
            <p class="smallText no-margins">
                <i class="fa-solid fa-quote-left"></i>
                We Rise by Lifting Others
                <i class="fa-solid fa-quote-right"></i>
            </p>
            <div class="copyrightSocialMediaIcons">
                <i style="font-size:24px" class="fa"></i>
                <i style="font-size:24px" class="fa"></i>
                <i style="font-size:24px" class="fa"></i>
                <i style="font-size:24px" class="fa"></i>
            </div>
        </div>
    </div>
</footer>

<style>
    footer {
        background-color: black;
        color: white;
        min-height: 50vh
    }

    footer a {
        text-decoration: none;
        color: inherit;
    }

    footer a:hover {
        text-decoration: underline;
    }

    #sep {
        height: 1px;
        margin: 0 14.5vw 2vh 14.5vw;
        background-color: rgba(255, 255, 255, 0.541);
    }

    .copyrightSocialMediaIcons i {
        margin: 1vh 1vw;
        cursor: pointer;
    }

    /* -------------- */
    .color-grey {
        color: rgb(158, 158, 158);
    }


    .no-margins {
        margin: 0;
    }

    .itallic {
        font-style: italic;
    }

    .bigText {
        font-size: 1.8em;
        font-weight: bolder;
    }

    .smallText {
        font-size: 0.89em;
    }

    .mediumBoldText {
        font-weight: bold;
    }

    #footer-logo {
        width: 100%;

    }

</style>
