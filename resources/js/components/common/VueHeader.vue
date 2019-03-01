<template>
    <header class="site-header">
        <div class="container">

            <nav class="header-nav">
                <a href="/"><img src="/img/logo.png" alt="Fortnite Tracker Logo" class="header-logo"></a>

                <ul class="header-main-nav">
                    <li><a class="nav-item" :class="{ 'nav-item-active': activePath === 'home'}" href="/">All</a></li>
                    <li><a class="nav-item" :class="{ 'nav-item-active': activePath === 'solos'}" href="/solos">Solos</a></li>
                    <li><a class="nav-item" :class="{ 'nav-item-active': activePath === 'duos'}" href="/duos">Duos</a></li>
                    <li><a class="nav-item" :class="{ 'nav-item-active': activePath === 'squads'}" href="/squads">Squads</a></li>
                </ul>

                <ul class="header-platform-season-nav">
                    <li class="platform-season-nav-item season-nav-item">
                        <div class="nav-selected">Lifetime <i class="fas fa-sort-down"></i></div>
                        <div class="nav-dropdown">
                            <ul>
                                <li class="nav-item">Lifetime</li>
                                <li class="nav-item">Season 7</li>
                                <li class="nav-item">Season 8</li>
                            </ul>
                        </div>
                    </li>

                    <li class="platform-season-nav-item platform-nav-item">
                        <div class="nav-selected">Playstation <i class="fas fa-sort-down"></i></div>
                        <div class="nav-dropdown">
                            <ul>
                                <li class="nav-item">PC</li>
                                <li class="nav-item">Playstation</li>
                                <li class="nav-item">Xbox</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>

        </div>
    </header>
</template>

<script>
    export default {
        props: {
            platforms: Object,
            seasons: Array
        },
        computed: {
            activePath: function () {
                let path = window.location.pathname;
                let path_array = path.split("/");

                if (path_array.length < 2) {

                    return path;
                }

                if (path_array[1] === '') {
                    return 'home'
                }

                return path_array[1];
            }
        },
        mounted() {
            console.log(window.location.pathname);
        }
    }
</script>
