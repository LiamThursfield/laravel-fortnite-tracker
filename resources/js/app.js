/**
 * Load the App dependencies
 */
require('./bootstrap');
window.Vue = require('vue');


/**
 * Register the Global Vue Components
 */
Vue.component('vue-header', require('./components/common/VueHeader.vue').default);

/**
 * Instantiate the Vue application
 */
const app = new Vue({
    el: '#app',
    data() {
        return {
            loaded_platform_seasons: false,

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
        },

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
        }
    },
    created() {
        this.fetchPlatformSeasons();
    }
});
