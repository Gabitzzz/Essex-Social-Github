<nav class="bg-white border-b border-gray-100 sticky">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{route('home')}}">
                    <img src="{{asset('storage/logo/5.png')}}" alt="logo" class="w-20 h-20 mt-4"/>
                </a>
                <!--                         Navigation Links-->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex " style="font-family: 'Nunito', sans-serif; color: #6B7280; font-weight: 300; font-size: 14px;">
                    <a href={{route('home')}} :active="route().current('home')" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                        Home
                    </a>
                    <a href="{{route('dashboard')}}" :active="route().current('home')" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">

                        Dashboard
                    </a>
                    <a href="{{route('explore')}}" :active="route().current('home')" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">

                        Explore
                    </a>
                    <!--                        <BreezeNavLink :href="route('profile', $page.props.auth.user.username)" :active="route().current('profile')">-->
                    <!--                        </BreezeNavLink>-->
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <div class="hidden space-x-4 sm:-my-px sm:flex">
                        <a
                            class="flex items-center group bg-gray-100 p-2 border-2 border-gray-200 border-opacity-25"
                            href="route('search')" style="border-radius: 15px;">
                            <img src="{{asset('img/Tab/search.png')}}" width="25" height="25" class="inline-block" alt="search">
                        </a>

                        <a
                            class="flex items-center group bg-gray-100 p-2 border-2 border-gray-200 border-opacity-25"
                            href="route('posts.create')" style="border-radius: 15px;">
                            <img src="{{asset("img/Tab/plus.png")}}" width="25" height="25" class="inline-block" alt="search">
                        </a>

                        <a
                            class="flex items-center group bg-gray-100 p-2 border-2 border-gray-200 border-opacity-25"
                            href="route('notifications.show')" style="border-radius: 15px;">
                            <img src="{{asset('img/Tab/notification.png')}}" width="25" height="25" class="inline-block" alt="search">
                        </a>

                        <!--                            <button class="bg-gray-100 p-2 border-2 border-gray-200 border-opacity-25"-->
                        <!--                                    style="border-radius: 15px;">-->
                        <!--                                <img :src="plus" width="25" height="25" class="inline-block" alt="plus">-->
                        <!--                            </button>-->



                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class=" flex items-center sm:hidden">
                <inertia-link
                    class="flex items-center group bg-gray-100 p-2 border-2 border-gray-200 border-opacity-25"
                    :href="route('search')" style="border-radius: 15px;">
                    <img :src="search" width="25" height="25" class="inline-block" alt="search">
                </inertia-link>
            </div>
        </div>
    </div>


</nav>

<style>
    .sticky {
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        z-index: 1020;
    }
</style>
