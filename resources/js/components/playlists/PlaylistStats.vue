<template>
    <section id="playlist-stats">
        <h1 class="header-font uc-words">{{ playlist_title }}</h1>

        <div class="grid-3-col" v-if="!loading && playlist_stats && Object.keys(playlist_stats).length > 0">
            <div class="card" v-for="stats in playlist_stats" :key="stats.player_username">
                <h2 class="card-header">{{ stats.player_username }}</h2>
                <ul>
                    <li><strong>Matches:</strong> {{ stats.matches_played }}</li>
                    <li><strong>Wins:</strong> {{ stats.top_1 }}</li>
                    <li><strong>Kills:</strong> {{ stats.kills }}</li>
                    <li><strong>Deaths:</strong> {{ stats.deaths }}</li>
                    <li><strong>K/D:</strong> {{ stats.kd }}</li>
                </ul>
            </div>
        </div>

        <div v-else-if="!loading && loaded">
            <p>
                There are no {{ $root.selected_season }} {{ playlist_type }}
                stats<template v-if="$root.selected_platform_id !== 'combined'"> for {{ $root.selected_platform_name }}</template>.
            </p>
        </div>

    </section>
</template>
<script>

    var CancelToken = axios.CancelToken;
    var source = CancelToken.source();

    export default {
        props: {
            playlist_type:{
                type: String,
                default: 'all'
            }
        },
        data() {
            return {
                loading: false,
                loaded: false,
                playlist_stats: []
            }
        },
        computed: {
           playlist_title: function() {
               if (this.playlist_type === 'all') {
                   return 'All Playlists';
               }
               return this.playlist_type;
           }
        },
        methods: {
            fetchStats: function() {
                this.loading = true;
                let url = '/api/v1/playlist_stats/';
                url += this.$root.$data.selected_platform_id + '/';
                url += this.$root.$data.selected_season + '/';
                url += this.playlist_type + '/';

                axios
                    .get(url, {
                        params: {},
                        cancelToken: source.token
                    })
                    .then(response => {
                        this.loaded = true;
                        this.loading = false;
                        if (response.data) {
                            this.playlist_stats = response.data
                        }
                    })
                    .catch(error => {
                        if (axios.isCancel(error)) {
                            console.log('Request canceled', error.message);
                        } else {
                            // handle error
                        }
                        this.loading = false;
                    });
            },
            onPlatformSeasonUpdated: function() {
                this.stopFetch();
                this.fetchStats();
            },
            stopFetch: function () {
                source.cancel();
                source = CancelToken.source();
            },
        },
        created() {
            this.$root.$on(this.$root.$data.event_platform_season_updated, () => {
                this.onPlatformSeasonUpdated();
            });
        }

    }
</script>
