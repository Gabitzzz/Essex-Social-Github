@include('Chatify::layouts.headLinks')
@include('layouts.navigation')


<div class="messenger pb-4">


    {{-- ----------------------Users/Groups lists side---------------------- --}}
    <div class="messenger-listView">
        {{-- Header and search bar --}}
        <div class="m-header mt-2">
            <nav>
                <a href="#">
                    <i class="fas fa-inbox"></i>
                    <span class="messenger-headTitle">MESSAGES</span>
                </a>
                <nav class="m-header-right">
{{--                    <a href="#"><i class="fas fa-cog settings-btn"></i></a>--}}
                    <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                </nav>
            </nav>
        </div>

        <div class=" contacts-container mt-24">

                <div class="mt-5 font-bold  overflow-hidden max-w-7xl sm:hidden ">

                    <h1 class="text-4xl mx-2 pb-4" style="font-family: 'Poppins', sans-serif;">
                        Messages
                    </h1>
                </div>
            {{-- Lists [Users/Group] --}}
            {{-- ---------------- [ User Tab ] ---------------- --}}
            <input type="text" class="messenger-search" placeholder="Search"/>

            <div class="@if($type ?? '' == 'user') show @endif messenger-tab users-tab app-scroll mt-4" data-view="users">

                {{-- Favorites --}}
                <div class="favorites-section">
                    <p class="messenger-title">Favorites</p>
                    <div class="messenger-favorites app-scroll-thin"></div>
                </div>

                {{-- Saved Messages --}}
                {!! view('Chatify::layouts.listItem', ['get' => 'saved']) !!}

                {{-- Contact --}}
                <div class="listOfContacts" style="width: 100%;height: calc(100% - 200px);position: relative;"></div>

            </div>

            {{-- ---------------- [ Group Tab ] ---------------- --}}
            <div class="@if($type ?? '' == 'group') show @endif messenger-tab groups-tab app-scroll" data-view="groups">
                {{-- items --}}
                <p style="text-align: center;color:grey;margin-top:30px">
                    <a target="_blank" style="color:{{$messengerColor}};"
                       href="https://chatify.munafio.com/notes#groups-feature">Click here</a> for more info!
                </p>
            </div>

            {{-- ---------------- [ Search Tab ] ---------------- --}}
            <div class="messenger-tab search-tab app-scroll"
                 app-scroll
                 data-view="search">
                {{-- items --}}
                <p class="messenger-title">Search</p>
                <div class="search-records">
                    <p class="message-hint center-el"><span>Type to search..</span></p>
                </div>
            </div>
        </div>
    </div>

    {{-- ----------------------Messaging side---------------------- --}}
    <div class="messenger-messagingView">
        {{-- header title [conversation name] amd buttons --}}
        <div class="m-header m-header-messaging mt-16 sm:mt-0">
            <nav>
                <div class="flex items-center justify-between">
                    {{-- header back button, avatar and user name --}}
                    <div style="display: inline-flex;" class="items-center">
                        <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                        <div class="avatar av-s header-avatar"
                             style="margin: -5px 10px;">
                        </div>

                        <a href="" class="user-name">{{ config('chatify.name') }}</a>
                    </div>
                    {{-- header buttons --}}
                    <div class="m-header-right item flex">
                        <a href="#" class="add-to-favorite"><i class="fas fa-star"></i></a>
                        <a href="#"><i class="fas fa-home"></i></a>
                        <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>
                    </div>
                </div>
            </nav>
        </div>
        {{-- Internet connection --}}
        <div class="internet-connection mt-16 sm:mt-0">
            <span class="ic-connected">Connected</span>
            <span class="ic-connecting">Connecting...</span>
            <span class="ic-noInternet">No internet access</span>
        </div>
        {{-- Messaging area --}}
        <div class="m-body messages-container app-scroll">
            <div class="messages">
                <p class="message-hint center-el"><span>Please select a chat to start messaging</span></p>
            </div>
            {{-- Typing indicator --}}
            <div class="typing-indicator">
                <div class="message-card typing">
                    <p>
                        <span class="typing-dots">
                            <span class="dot dot-1"></span>
                            <span class="dot dot-2"></span>
                            <span class="dot dot-3"></span>
                        </span>
                    </p>
                </div>
            </div>
            {{-- Send Message Form --}}
            @include('Chatify::layouts.sendForm')
        </div>
    </div>
    {{-- ---------------------- Info side ---------------------- --}}
    <div class="messenger-infoView app-scroll">
        {{-- nav actions --}}
        <nav>
            <a href="#"><i class="fas fa-times mt-20 lg:mt-0"></i></a>
        </nav>
        {!! view('Chatify::layouts.info')->render() !!}
    </div>
</div>

@include('Chatify::layouts.modals')
@include('Chatify::layouts.footerLinks')
