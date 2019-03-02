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

                <ul class="header-platform-season-nav" v-if="$root.$data.loaded_platform_seasons">
                    <li class="platform-season-nav-item season-nav-item"
                    @mouseover="show_seasons = true" @mouseleave="show_seasons = false">
                        <div class="nav-selected"><span>{{ $root.$data.selected_season }}</span> <i class="fas fa-sort-down"></i></div>
                        <div class="nav-dropdown" :class="{show:show_seasons}">
                            <ul>
                                <li class="nav-item" v-for="season in $root.$data.seasons"
                                    @mousedown="selectSeason(season)">
                                    {{ season }}
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="platform-season-nav-item platform-nav-item"
                        @mouseover="show_platforms = true" @mouseleave="show_platforms = false">
                        <div class="nav-selected"><span>{{ $root.$data.selected_platform_name }}</span> <i class="fas fa-sort-down"></i></div>
                        <div class="nav-dropdown" :class="{show:show_platforms}">
                            <ul>
                                <li class="nav-item" v-for="(platform, platform_id) in $root.$data.platforms"
                                    @mousedown="selectPlatform(platform_id)">
                                    {{ platform }}
                                </li>
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
        data() {
            return {
                // Platform Data
                show_platforms: false,
                // Season Data
                show_seasons: false,
            }
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
        methods: {
            selectPlatform: function(platform_id) {
                this.$root.selectPlatform(platform_id);
                this.show_platforms = false;
            },
            selectSeason: function(season) {
                this.$root.selectSeason(season);
                this.show_seasons = false;
            }
        },
        mounted() {}
    }
</script>
