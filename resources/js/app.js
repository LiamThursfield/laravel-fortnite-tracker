/**
 * Load the App dependencies
 */
require('./bootstrap');
window.Vue = require('vue');

/**
 * Register the Global Vue Components
 */
Vue.component('vue-header', require('./components/common/VueHeader.vue').default);
Vue.component('playlist-stats', require('./components/playlists/PlaylistStats.vue').default);

/**
 * Instantiate the Vue application
 */
const app = new Vue({
    el: '#app',
    data() {
        return {
            loaded_platform_seasons: false,
            event_platform_season_updated: 'platform_season_updated',

            // Platforms Data
            platforms: {},
            local_storage_platform_id: 'selected_platform_id',
            selected_platform_id: '',
            selected_platform_name: '',
            default_platforms: {
                combined: 'Combined',
                pc: 'PC',
                playstation: 'Playstation',
                xbox: 'Xbox'
            },

            // Seasons Data
            seasons: [],
            local_storage_season: 'selected_season',
            selected_season: '',
            default_seasons: [
                'Lifetime', 'Season 8', 'Season 7'
            ]
        }
    },
    methods: {
        // API Calls
        fetchPlatformSeasons: function() {
            let url = '/api/v1/platform_seasons?with_combined_platforms=true';
            axios
                .get(url)
                .then(response => {
                    if (response.data && response.data.platforms && response.data.seasons) {
                        this.platforms = response.data.platforms;
                        this.seasons = response.data.seasons;
                    } else {
                        this.loadDefaultPlatformSeasons();
                    }
                    this.onFetchedPlatformSeasons();
                })
                .catch(error => {
                    // TODO Show notification on error
                    console.log(error);
                    this.loadDefaultPlatformSeasons();
                    this.onFetchedPlatformSeasons()
                })
        },
        loadDefaultPlatformSeasons: function() {
            console.log('Loaded Default Platform Seasons');
            this.platforms = this.default_platforms;
            this.seasons = this.default_seasons;
        },
        onFetchedPlatformSeasons: function() {
            this.getSelectedPlatform();
            this.getSelectedSeason();
            this.loaded_platform_seasons = true;
            this.$emit(this.event_platform_season_updated);
        },

        // Platform Methods
        getSelectedPlatform: function() {
            if (localStorage.getItem(this.local_storage_platform_id)) {
                this.selected_platform_id = localStorage.getItem(this.local_storage_platform_id);
            } else {
                this.selected_platform_id = Object.keys(this.platforms)[0]
            }
            this.selected_platform_name = this.platforms[this.selected_platform_id];
        },
        selectPlatform: function(platform_id) {
            this.selected_platform_id = platform_id;
            this.selected_platform_name = this.platforms[platform_id];
            localStorage.setItem(this.local_storage_platform_id, platform_id);
            this.$emit(this.event_platform_season_updated);
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
            this.$emit(this.event_platform_season_updated);
        }
    },
    created() {
        this.fetchPlatformSeasons();
    }
});
