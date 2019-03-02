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
                    <li class="platform-season-nav-item season-nav-item"
                    @mouseover="show_seasons = true" @mouseleave="show_seasons = false">
                        <div class="nav-selected"><span>{{ selected_season }}</span> <i class="fas fa-sort-down"></i></div>
                        <div class="nav-dropdown" :class="{show:show_seasons}">
                            <ul>
                                <li class="nav-item" v-for="season in seasons"
                                    @mousedown="selectSeason(season)">
                                    {{ season }}
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="platform-season-nav-item platform-nav-item"
                        @mouseover="show_platforms = true" @mouseleave="show_platforms = false">
                        <div class="nav-selected"><span>{{ selected_platform_name }}</span> <i class="fas fa-sort-down"></i></div>
                        <div class="nav-dropdown" :class="{show:show_platforms}">
                            <ul>
                                <li class="nav-item" v-for="(platform, platform_id) in platforms"
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
        props: {
            platforms: Object,
            seasons: Array
        },
        data() {
            return {
                // Platform Data
                local_storage_platform_id: 'selected_platform_id',
                selected_platform_id: '',
                selected_platform_name: '',
                show_platforms: false,
                // Season Data
                local_storage_season: 'selected_season',
                selected_season: '',
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
            // Platform Methods
            getSelectedPlatform: function() {
                if (localStorage.getItem(this.local_storage_platform_id)) {
                    this.selectPlatform(localStorage.getItem(this.local_storage_platform_id));
                } else {
                    this.selectPlatform(Object.keys(this.platforms)[0]);
                    this.selected_season = this.seasons[0];
                }
            },
            selectPlatform: function(platform_id) {
                this.selected_platform_id = platform_id;
                this.selected_platform_name = this.platforms[platform_id];
                localStorage.setItem(this.local_storage_platform_id, platform_id);
                this.show_platforms = false;
            },

            // Season Methods
            getSelectedSeason: function() {
                if (localStorage.getItem(this.local_storage_season)) {
                    this.selected_season = localStorage.getItem(this.local_storage_season);
                } else {
                    this.selected_season = this.seasons[0];
                }
            },
            selectSeason: function(season) {
                this.selected_season = season;
                localStorage.setItem(this.local_storage_season, season);
                this.show_seasons = false;
            }
        },
        mounted() {
            this.getSelectedPlatform();
            this.getSelectedSeason();
        }
    }
</script>
